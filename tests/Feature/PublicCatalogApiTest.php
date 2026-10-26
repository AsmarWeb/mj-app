<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Listing;
use App\Models\Shop;
use App\Models\State;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class PublicCatalogApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['catalog_api.rate_limit' => 60]);
    }

    private function shop(array $values = []): Shop
    {
        $shop = Shop::create(array_merge(['name' => 'Public '.Str::random(8), 'name_ar' => 'متجر رسلو',
            'user_id' => User::factory()->create()->id, 'is_active' => true, 'is_completed' => true,
            'currency' => 'AED', 'published_at' => now()->subDay()], $values));
        // The legacy model mutator rewrites publication dates; use raw DB state to test visibility.
        foreach (['published_at', 'deleted_at'] as $field) {
            if (array_key_exists($field, $values)) {
                DB::table('shops')->where('id', $shop->id)->update([$field => $values[$field]]);
            }
        }

        return $shop->fresh();
    }

    private function listing(Shop $shop, array $values = []): Listing
    {
        return Listing::forceCreate(array_merge(['shop_id' => $shop->id, 'title' => 'Product '.Str::random(8), 'title_ar' => 'منتج إماراتي',
            'slug' => 'product-'.Str::random(12), 'price' => '12.50', 'quantity' => 3, 'image' => 'test.jpg',
            'price_condition' => 'fixed', 'condition' => 'new', 'active' => true, 'status' => 'published',
            'published_at' => now()->subDay(), 'expires_at' => now()->addDay()], $values));
    }

    public function test_published_products_are_available_on_v1_and_legacy_routes(): void
    {
        $listing = $this->listing($this->shop());
        foreach (['/api/v1', '/api'] as $base) {
            $this->getJson($base.'/listings')->assertOk()->assertJsonPath('data.0.id', $listing->id)->assertJsonPath('data.0.shop.id', $listing->shop_id)
                ->assertJsonStructure(['data', 'links', 'meta'])->assertHeader('X-API-Version', '1');
            $this->getJson($base.'/listings/'.$listing->slug)->assertOk()->assertJsonPath('data.id', $listing->id);
        }
    }

    public function test_hidden_product_states_are_absent_from_every_public_entry_point(): void
    {
        $shop = $this->shop();
        $visible = $this->listing($shop);
        $hidden = [];
        foreach ([['status' => 'draft'], ['status' => 'expired'], ['status' => 'archived'], ['active' => false],
            ['published_at' => null], ['published_at' => now()->addDay()], ['expires_at' => now()], ['deleted_at' => now()]] as $values) {
            $hidden[] = $this->listing($shop, $values);
        }
        foreach (['/api/v1', '/api'] as $base) {
            $this->getJson($base.'/listings')->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $visible->id);
            $this->getJson($base.'/shops/'.$shop->slug)->assertJsonCount(1, 'data.listings');
            foreach ($hidden as $row) {
                $this->getJson($base.'/listings/'.$row->slug)->assertNotFound();
            }
        }
        $this->getJson('/api/v1/shops/'.$shop->slug.'/listings')->assertJsonCount(1, 'data');
    }

    public function test_hidden_shops_hide_their_products_and_cannot_be_discovered_by_direct_slug(): void
    {
        foreach ([['is_active' => false], ['is_completed' => false], ['published_at' => null],
            ['published_at' => now()->addDay()], ['deleted_at' => now()]] as $values) {
            $shop = $this->shop($values);
            $listing = $this->listing($shop);
            foreach (['/api/v1', '/api'] as $base) {
                $this->getJson($base.'/shops/'.$shop->slug)->assertNotFound();
                $this->getJson($base.'/listings/'.$listing->slug)->assertNotFound();
            }
            $this->getJson('/api/v1/shops/'.$shop->slug.'/listings')->assertNotFound();
        }
        $this->getJson('/api/v1/shops')->assertJsonCount(0, 'data');
        $this->getJson('/api/v1/listings')->assertJsonCount(0, 'data');
    }

    public function test_shop_detail_has_a_bounded_safe_preview_and_paginated_store_products(): void
    {
        $shop = $this->shop(['phone' => 'PRIVATE PHONE', 'allow_phone' => false, 'allow_whatsapp' => false,
            'stripe_account_id' => 'acct_PRIVATE']);
        $other = $this->shop();
        for ($i = 0; $i < 13; $i++) {
            $this->listing($shop);
        }
        $this->listing($other);
        $this->listing($shop, ['status' => 'draft', 'title' => 'SECRET DRAFT']);
        $response = $this->getJson('/api/v1/shops/'.$shop->slug)->assertOk()->assertJsonCount(10, 'data.listings')
            ->assertDontSee('SECRET DRAFT')->assertDontSee('acct_PRIVATE')->assertDontSee('PRIVATE PHONE');
        $row = $response->json('data.listings.0');
        foreach (['user_id', 'updated_by', 'deleted_by', 'status', 'shop', 'shop_id'] as $field) {
            $this->assertArrayNotHasKey($field, $row);
        }
        $this->assertArrayNotHasKey('phone', $response->json('data'));
        $this->assertArrayNotHasKey('whatsapp', $response->json('data'));
        $this->getJson('/api/v1/shops/'.$shop->slug.'/listings?per_page=5&shop_id='.$other->id)
            ->assertJsonCount(5, 'data')->assertJsonPath('meta.total', 13);
    }

    public function test_lists_paginate_with_stable_order_and_do_not_echo_unknown_query_parameters(): void
    {
        $shop = $this->shop();
        $ids = [];
        for ($i = 0; $i < 5; $i++) {
            $ids[] = $this->listing($shop)->id;
        }
        $this->getJson('/api/v1/listings?per_page=2&sort=oldest&secret=DO_NOT_ECHO')
            ->assertJsonCount(2, 'data')->assertJsonPath('meta.total', 5)->assertJsonPath('data.0.id', $ids[0])->assertDontSee('DO_NOT_ECHO');
        $this->getJson('/api/v1/listings?per_page=2&sort=oldest&page=2')->assertJsonPath('data.0.id', $ids[2]);
        $this->shop();
        $this->shop();
        $this->getJson('/api/shops?per_page=1')->assertJsonCount(1, 'data')->assertJsonPath('meta.total', 3);
    }

    public function test_product_search_filters_arabic_and_sorts_string_prices_numerically(): void
    {
        $shop = $this->shop();
        $category = Category::create(['category_name' => 'Test', 'category_name_ar' => 'تجربة', 'section_name' => 'Test section', 'slug' => 'test']);
        $cheap = $this->listing($shop, ['price' => '2.00', 'title' => '100% cotton', 'category_id' => $category->id]);
        $this->listing($shop, ['price' => '10.00', 'quantity' => 0]);
        $this->listing($shop, ['price' => '100.00', 'title_ar' => 'قميص فاخر']);
        $this->getJson('/api/v1/listings?sort=price_asc')->assertJsonPath('data.0.price', '2.00')->assertJsonPath('data.2.price', '100.00');
        $this->getJson('/api/v1/listings?min_price=2&max_price=10&in_stock=1')->assertJsonCount(1, 'data');
        $this->getJson('/api/v1/listings?category_id='.$category->id)->assertJsonPath('data.0.id', $cheap->id)->assertJsonCount(1, 'data');
        $this->getJson('/api/v1/listings?q='.urlencode('قميص'))->assertJsonCount(1, 'data');
        $this->getJson('/api/v1/listings?q='.urlencode('%'))->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $cheap->id);
        $this->getJson('/api/v1/listings?q='.urlencode("' OR 1=1 --"))->assertJsonCount(0, 'data');
    }

    public function test_invalid_queries_and_missing_records_return_json_even_without_accept_header(): void
    {
        foreach (['per_page=51', 'per_page=0', 'page=-1', 'sort=RAND()', 'q[]=bad', 'shop_id=-3',
            'min_price=-1', 'max_price=1.234', 'min_price=20&max_price=10'] as $query) {
            $this->get('/api/v1/listings?'.$query)->assertUnprocessable()->assertHeader('Content-Type', 'application/json');
        }
        $this->get('/api/v1/shops/missing')->assertNotFound()->assertHeader('Content-Type', 'application/json');
        $this->get('/api/user')->assertUnauthorized()->assertHeader('Content-Type', 'application/json');
    }

    public function test_taxonomy_resources_use_explicit_fields_and_media_paths_are_safe(): void
    {
        $shop = $this->shop();
        $category = Category::create(['category_name' => 'Test', 'category_name_ar' => 'تجربة', 'section_name' => 'Test section', 'slug' => 'test', 'code' => 'PRIVATE CODE']);
        $listing = $this->listing($shop, ['category_id' => $category->id, 'image' => '../private.txt',
            'video' => 'https://evil.example/a.mp4', 'images' => ['safe photo.jpg', '../secret', 'x%2f..']]);
        $response = $this->getJson('/api/v1/listings/'.$listing->slug)->assertOk()
            ->assertJsonPath('data.image_url', null)->assertJsonPath('data.video_url', null)
            ->assertJsonCount(1, 'data.images')->assertDontSee('PRIVATE CODE');
        $this->assertSame(['id', 'name', 'name_ar', 'slug'], array_keys($response->json('data.category')));
        $this->assertStringContainsString('safe%20photo.jpg', $response->json('data.image_urls.0'));
    }

    public function test_rate_budget_is_shared_by_legacy_and_v1_and_returns_retry_after(): void
    {
        for ($i = 0; $i < 60; $i++) {
            $this->getJson($i % 2 ? '/api/shops' : '/api/v1/shops')->assertOk();
        }
        $this->get('/api/v1/listings')->assertStatus(429)->assertHeader('Retry-After')->assertHeader('Content-Type', 'application/json');
    }

    public function test_listing_serialization_does_not_query_each_product_rating(): void
    {
        $shop = $this->shop();
        for ($i = 0; $i < 10; $i++) {
            $this->listing($shop);
        }
        DB::enableQueryLog();
        $this->getJson('/api/v1/listings')->assertOk()->assertJsonCount(10, 'data');
        $queries = DB::getQueryLog();
        DB::disableQueryLog();
        $standaloneReviews = array_filter($queries, fn ($q) => preg_match('/^select avg\(/i', $q['query']) && str_contains($q['query'], 'reviews'));
        $this->assertCount(0, $standaloneReviews);
        $this->assertLessThan(18, count($queries));
    }

    public function test_default_and_max_page_size_are_bounded_and_owners_cannot_bypass_visibility(): void
    {
        $shop = $this->shop();
        for ($i = 0; $i < 55; $i++) {
            $this->listing($shop);
        }
        $draft = $this->listing($shop, ['status' => 'draft']);
        $this->getJson('/api/v1/listings')->assertJsonCount(20, 'data')->assertJsonPath('meta.total', 55);
        $this->getJson('/api/v1/listings?per_page=50')->assertJsonCount(50, 'data');
        $this->actingAs($shop->user)->getJson('/api/v1/listings/'.$draft->slug)->assertNotFound();
        $this->getJson('/api/shops/'.$shop->slug)->assertHeader('X-API-Deprecated', 'true')->assertHeader('Cache-Control', 'no-store, private');
    }

    public function test_approved_rating_aggregate_and_currency_filter_are_consistent(): void
    {
        $shop = $this->shop(['currency' => 'AED']);
        $product = $this->listing($shop);
        $product->reviews()->create(['user_id' => $shop->user_id, 'rating' => 4, 'approved' => true]);
        $product->reviews()->create(['user_id' => $shop->user_id, 'rating' => 2, 'approved' => true]);
        $product->reviews()->create(['user_id' => $shop->user_id, 'rating' => 1, 'approved' => false]);
        $this->listing($this->shop(['currency' => 'USD']));
        $this->getJson('/api/v1/listings?currency=AED')->assertJsonCount(1, 'data')->assertJsonPath('data.0.rating', 3)
            ->assertJsonPath('data.0.currency', 'AED');
        $this->getJson('/api/v1/listings?currency=bad')->assertUnprocessable();
    }

    public function test_shop_search_and_verified_filter_and_public_openapi_document(): void
    {
        $shop = $this->shop(['name' => '100% Emirati store', 'verified' => true]);
        $this->shop(['name' => 'Another store', 'verified' => false]);
        $this->getJson('/api/v1/shops?verified=1&q='.urlencode('%'))->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $shop->id);
        $response = $this->get('/api/v1/openapi.json')->assertOk()->assertHeader('Content-Type', 'application/json');
        $spec = json_decode(file_get_contents($response->baseResponse->getFile()->getPathname()), true, 512, JSON_THROW_ON_ERROR);
        $this->assertSame('3.0.3', $spec['openapi']);
        $this->assertArrayHasKey('/shops/{slug}/listings', $spec['paths']);
    }

    public function test_product_location_filters_use_the_store_location_not_nonexistent_listing_columns(): void
    {
        $country = Country::forceCreate(['name' => 'UAE', 'name_ar' => 'الإمارات', 'code' => 'AE', 'phone_code' => '971', 'slug' => 'uae']);
        $state = State::create(['country_id' => $country->id, 'name' => 'Dubai', 'name_ar' => 'دبي']);
        $city = City::forceCreate(['state_id' => $state->id, 'name' => 'Dubai city', 'name_ar' => 'مدينة دبي']);
        $shop = $this->shop(['country_id' => $country->id, 'state_id' => $state->id, 'city_id' => $city->id]);
        $product = $this->listing($shop);
        $this->listing($this->shop());
        $this->getJson('/api/v1/listings?state_id='.$state->id.'&city_id='.$city->id)
            ->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $product->id)
            ->assertJsonPath('data.0.state.name', 'Dubai')->assertJsonPath('data.0.city.name_ar', 'مدينة دبي');
        $this->getJson('/api/v1/shops?country_id='.$country->id.'&city_id='.$city->id)->assertJsonCount(1, 'data');
    }

    public function test_future_shop_publication_is_preserved_until_the_publication_time(): void
    {
        $shop = $this->shop();
        $shop->update(['published_at' => now()->addHour()]);
        $this->assertTrue($shop->fresh()->published_at->isFuture());
        $this->getJson('/api/v1/shops/'.$shop->slug)->assertNotFound();
        $this->travel(2)->hours();
        $this->getJson('/api/v1/shops/'.$shop->slug)->assertOk();
        $shop->update(['published_at' => null]);
        $this->getJson('/api/v1/shops/'.$shop->slug)->assertNotFound();
        $this->travelBack();
    }
}
