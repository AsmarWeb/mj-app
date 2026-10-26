<?php

namespace Tests\Feature;

use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ListingCategoryController;
use App\Http\Controllers\ShopCountryController;
use App\Livewire\AddToCart;
use App\Livewire\SearchResults;
use App\Models\Category;
use App\Models\Country;
use App\Models\Listing;
use App\Models\Section;
use App\Models\Shop;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class PublicCatalogWebTest extends TestCase
{
    use RefreshDatabase;

    private function shop(array $values = []): Shop
    {
        return Shop::create($values + ['name' => 'Store '.Str::random(8), 'name_ar' => 'متجر',
            'user_id' => User::factory()->create()->id, 'is_active' => true, 'is_completed' => true,
            'currency' => 'AED', 'published_at' => now()->subDay()]);
    }

    private function listing(Shop $shop, array $values = []): Listing
    {
        return Listing::forceCreate($values + ['shop_id' => $shop->id, 'title' => 'Product '.Str::random(8),
            'title_ar' => 'منتج', 'slug' => 'product-'.Str::random(12), 'price' => '12.50', 'quantity' => 3, 'image' => 'test.jpg',
            'price_condition' => 'fixed', 'condition' => 'new', 'active' => true, 'status' => 'published',
            'published_at' => now()->subDay(), 'expires_at' => now()->addDay()]);
    }

    public function test_guest_can_render_public_product_and_store_in_both_languages(): void
    {
        $shop = $this->shop();
        $product = $this->listing($shop);
        foreach (['en', 'ar'] as $locale) {
            $this->withSession(['locale' => $locale])->get($product->url)->assertOk()->assertSee($product->title);
            $this->get(route('shop', $shop->slug))->assertOk()->assertSee($locale === 'ar' ? $product->title_ar : $product->title);
        }
        $this->withSession(['locale' => 'en'])->get(route('shop.creators'))->assertOk()->assertSee($shop->name);
    }

    public function test_hidden_products_are_missing_from_web_api_and_sitemaps(): void
    {
        $shop = $this->shop();
        $visible = $this->listing($shop);
        $hidden = [];
        foreach ([['status' => 'draft'], ['active' => false], ['published_at' => null],
            ['published_at' => now()->addDay()], ['expires_at' => now()], ['deleted_at' => now()]] as $values) {
            $hidden[] = $this->listing($shop, $values);
        }
        $explore = $this->get('/explore')->assertOk();
        $store = $this->get(route('shop', $shop->slug))->assertOk();
        $sitemap = $this->get('/sitemap-products.xml')->assertOk();
        foreach ($hidden as $product) {
            $this->get($product->url)->assertNotFound();
            $this->getJson('/api/v1/listings/'.$product->slug)->assertNotFound();
            $explore->assertDontSee($product->title);
            $store->assertDontSee($product->title);
            $sitemap->assertDontSee($product->slug);
        }
        $explore->assertSee($visible->title);
        $store->assertSee($visible->title);
        $sitemap->assertSee($visible->slug);
    }

    public function test_hidden_stores_hide_products_from_public_entry_points(): void
    {
        foreach ([['is_active' => false], ['is_completed' => false], ['published_at' => null],
            ['published_at' => now()->addDay()], ['deleted_at' => now()]] as $values) {
            $shop = $this->shop();
            DB::table('shops')->where('id', $shop->id)->update($values);
            $product = $this->listing($shop);
            $this->get(route('shop', $shop->slug))->assertNotFound();
            $this->get($product->url)->assertNotFound();
            $this->get('/')->assertOk()->assertDontSee($shop->name);
            $this->get('/creators')->assertOk()->assertDontSee($shop->name);
            $this->get('/explore')->assertOk()->assertDontSee($shop->name)->assertDontSee($product->title);
            $this->get('/sitemap-shops.xml')->assertOk()->assertDontSee($shop->slug);
            $this->get('/sitemap-products.xml')->assertOk()->assertDontSee($product->slug);
        }
    }

    public function test_search_honors_q_and_never_exposes_hidden_matches(): void
    {
        $shop = $this->shop();
        $visible = $this->listing($shop, ['title' => 'needle public']);
        $hidden = $this->listing($shop, ['title' => 'needle draft', 'status' => 'draft']);
        $this->get('/search?q=needle')->assertOk()->assertSee($visible->title)->assertDontSee($hidden->title);
        Livewire::test(SearchResults::class)->set('search', 'needle')
            ->assertSee($visible->title)->assertDontSee($hidden->title);
    }

    public function test_guest_write_actions_and_seller_tools_remain_protected(): void
    {
        $shop = $this->shop();
        $product = $this->listing($shop);
        foreach (['/cart/add/'.$product->id, '/wishlist/add/'.$product->id, '/shops/'.$shop->id.'/follow', '/checkout'] as $path) {
            $this->post($path)->assertRedirect(route('login'));
        }
        $this->get('/shop/edit')->assertRedirect(route('login'));
        $this->get('/seller/raslo')->assertRedirect(route('login'));
        Livewire::test(AddToCart::class, ['listing' => $product])->call('add')->assertRedirect(route('login'));
        $this->assertDatabaseCount('carts', 0);
    }

    public function test_optional_product_relations_have_working_urls_and_wrong_path_is_rejected(): void
    {
        $product = $this->listing($this->shop());
        $this->get($product->url)->assertOk();
        $this->get(str_replace('/category/', '/wrong-category/', $product->url))->assertNotFound();
    }

    public function test_public_product_respects_phone_flag_and_review_approval(): void
    {
        $shop = $this->shop(['phone' => '+971509999999', 'allow_phone' => false]);
        $product = $this->listing($shop);
        $product->reviews()->create(['user_id' => $shop->user_id, 'rating' => 5, 'comment' => 'Unapproved private text', 'approved' => false]);
        $product->reviews()->create(['user_id' => User::factory()->create()->id, 'rating' => 4, 'comment' => 'Approved public text', 'approved' => true]);
        $this->get($product->url)->assertOk()->assertDontSee($shop->phone)
            ->assertDontSee('Unapproved private text')->assertSee('Approved public text');
        $shop->update(['allow_phone' => true]);
        $this->get($product->url)->assertOk()->assertSee($shop->phone);
    }

    public function test_section_and_category_pages_use_public_listing_scope(): void
    {
        $section = Section::forceCreate(['name' => 'Local', 'name_ar' => 'محلي', 'slug' => 'local', 'status' => 'active']);
        $category = Category::forceCreate(['category_name' => 'Local goods', 'category_name_ar' => 'منتجات',
            'section_name' => 'Local', 'slug' => 'local-traditional-products', 'section_id' => $section->id, 'status' => 'active']);
        $shop = $this->shop();
        $visible = $this->listing($shop, ['category_id' => $category->id, 'section_id' => $section->id]);
        $hidden = $this->listing($shop, ['category_id' => $category->id, 'section_id' => $section->id, 'expires_at' => now()->subDay()]);
        foreach (['/explore/section/local', '/explore/category/local-traditional-products', '/uae'] as $path) {
            $this->get($path)->assertOk()->assertSee($visible->title)->assertDontSee($hidden->title);
        }
    }

    public function test_sitemap_index_references_the_actual_product_sitemap(): void
    {
        $this->get('/sitemap.xml')->assertOk()->assertSee('sitemap-products.xml')->assertDontSee('sitemap-listings.xml');
    }

    public function test_public_creators_search_does_not_match_private_owner_email(): void
    {
        $shop = $this->shop();
        $this->get('/creators?q='.urlencode($shop->user->email))->assertOk()->assertDontSee($shop->name);
    }

    public function test_malformed_search_input_does_not_break_guest_page(): void
    {
        $this->get('/search?q[]=invalid')->assertOk();
    }

    public function test_country_previews_and_counts_exclude_hidden_stores(): void
    {
        $country = Country::forceCreate(['name' => 'UAE', 'name_ar' => 'الإمارات', 'code' => 'AE', 'phone_code' => '971', 'slug' => 'uae']);
        $visible = $this->shop(['country_id' => $country->id]);
        $hidden = $this->shop(['country_id' => $country->id, 'is_active' => false, 'verified' => true]);
        $this->get('/countries')->assertOk()->assertSee($visible->name)->assertDontSee($hidden->name);
        $rows = app(ShopCountryController::class)->index()->getData()['countries'];
        $this->assertSame(1, $rows->first()->shops_count);
        $this->assertSame(0, $rows->first()->verified_shops_count);
    }

    public function test_product_with_real_category_paths_is_public_and_hidden_section_collections_are_filtered(): void
    {
        $section = Section::forceCreate(['name' => 'Goods', 'name_ar' => 'منتجات', 'slug' => 'goods', 'status' => 'active']);
        $category = Category::forceCreate(['category_name' => 'Gifts', 'category_name_ar' => 'هدايا',
            'section_name' => 'Goods', 'slug' => 'gifts', 'section_id' => $section->id, 'status' => 'active']);
        $subcategory = SubCategory::forceCreate(['subcategory_name' => 'Cards', 'subcategory_name_ar' => 'بطاقات',
            'slug' => 'cards', 'category_id' => $category->id, 'category_name' => 'Gifts', 'status' => 'active']);
        $shop = $this->shop();
        $visible = $this->listing($shop, ['section_id' => $section->id, 'category_id' => $category->id, 'subcategory_id' => $subcategory->id]);
        $hidden = $this->listing($shop, ['section_id' => $section->id, 'category_id' => $category->id, 'status' => 'draft']);
        $this->get($visible->url)->assertOk();
        $this->get('/explore')->assertOk()->assertSee($visible->title)->assertDontSee($hidden->title);
        $rows = app(ExploreController::class)->index(request())->getData()['sections'];
        $ids = $rows->first()->listings->modelKeys();
        $this->assertContains($visible->id, $ids);
        $this->assertNotContains($hidden->id, $ids);
        $this->get('/categories')->assertOk();
        $categories = app(ListingCategoryController::class)->index()->getData()['categories'];
        $this->assertSame(1, $categories->first()->listings_count);
    }
}
