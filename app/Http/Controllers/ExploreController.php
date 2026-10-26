<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\DigitalProduct;
use App\Models\Listing;
use App\Models\Section;
use App\Models\Shop;
use App\Models\Wishlist;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        /*
    |--------------------------------------------------------------------------
    | Main listings
    |--------------------------------------------------------------------------
    */
        $query = Listing::query()->active()
            ->with(['shop', 'section'])
            ->where('status', 'published');

        if ($request->filled('section')) {
            $query->whereHas('section', function ($q) use ($request) {
                $q->where('slug', $request->section)
                    ->where('status', 'active');
            });
        }

        $listings = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        /*
    |--------------------------------------------------------------------------
    | Sections + products inside every section
    |--------------------------------------------------------------------------
    |
    | This is important for:
    |
    |     $section->listings
    |
    | in the Blade view.
    |
    */
        $sections = Section::query()
            ->where('status', 'active')
            ->with([
                'listings' => function ($query) {
                    $query->active()
                        ->with('shop')
                        ->latest()
                        ->take(8);
                },
            ])
            ->take(5)
            ->get();

        /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */
        $categories = Category::query()
            ->where('status', 'active')
            ->take(12)
            ->get();

        /*
    |--------------------------------------------------------------------------
    | Digital products
    |--------------------------------------------------------------------------
    */
        $digitalProducts = DigitalProduct::query()
            ->where('status', 'published')
            ->latest()
            ->take(8)
            ->get();

        /*
    |--------------------------------------------------------------------------
    | Featured products
    |--------------------------------------------------------------------------
    */
        $featuredProducts = Listing::query()->active()
            ->with(['shop', 'section'])
            ->where('status', 'published')
            ->where('featured', true)
            ->latest()
            ->take(12)
            ->get();

        /*
    |--------------------------------------------------------------------------
    | Trending products
    |--------------------------------------------------------------------------
    */
        $trendingProducts = Listing::query()->active()
            ->with(['shop', 'section'])
            ->where('status', 'published')
            ->latest()
            ->take(8)
            ->get();

        /*
    |--------------------------------------------------------------------------
    | Shops
    |--------------------------------------------------------------------------
    */
        $shops = Shop::query()->publicCatalog()
            ->with('user')
            ->withCount([
                'listings' => function ($query) {
                    $query->active();
                },
            ])
            ->take(8)
            ->get();

        return view('explore.index', [
            'listings' => $listings,
            'sections' => $sections,
            'categories' => $categories,
            'digitalProducts' => $digitalProducts,
            'featuredProducts' => $featuredProducts,
            'trendingProducts' => $trendingProducts,
            'shops' => $shops,
        ]);
    }

    public function section($section)
    {
        $section = Section::where('slug', $section)
            ->where('status', 'active')
            ->firstOrFail();

        $products = Listing::active()->whereHas('section', function ($query) use ($section) {
            $query->where('id', $section->id);
        })
            ->with([
                'shop',
                'section',
                'category',
                'subcategories',
                'brand',
            ])
            ->where('status', 'published')
            ->where('active', true)
            ->latest()
            ->paginate(24)
            ->withQueryString();

        $sectionName = app()->getLocale() === 'ar'
            ? ($section->name_ar ?? $section->name)
            : $section->name;

        $title = $sectionName.' | murwaj';

        $description = "Browse all {$sectionName} products, services and listings on Murwaj Marketplace.";

        $keywords = $sectionName;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

        return view('pages.section', compact(
            'title',
            'description',
            'keywords',
            'section',
            'products'
        ));
    }

    public function category($category)
    {
        $category = Category::where('slug', $category)->where('status', 'active')->firstOrFail();

        $products = Listing::active()->whereHas('category', function ($query) use ($category) {
            $query->where('slug', $category->slug);
        })
            ->with([
                'shop',
                'section',
                'category',
                'subcategories',
                'brand',
            ])
            ->where('status', 'published')
            ->where('active', true)
            ->latest()
            ->paginate(24);

        $categoryName = app()->getLocale() === 'ar'
            ? ($category->category_name_ar ?? $category->category_name)
            : $category->category_name;

        $title = $categoryName.' | murwaj';
        $description = "Browse all {$category->category_name} products on murwaj Marketplace.";
        $keywords = $category->category_name;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

        return view('pages.category')->with(compact('title', 'description', 'keywords', 'category', 'products'));
    }

    public function show(
        $shop,
        $section,
        $category,
        $subcategories,
        $brand,
        $listing
    ) {
        // =========================================================
        // FIND LISTING
        // =========================================================

        $listingModel = Listing::active()->with(['shop', 'section', 'category', 'subcategory', 'brand'])
            ->where('slug', $listing)->firstOrFail();

        // Match the existing canonical URL, including placeholders for optional relations.
        abort_unless($shop === ($listingModel->shop?->slug ?? 'shop')
            && $section === ($listingModel->section?->slug ?? 'section')
            && $category === ($listingModel->category?->slug ?? 'category')
            && $subcategories === ($listingModel->subcategory?->slug ?? 'all'), 404);

        $listingModel->load(['reviews' => fn ($q) => $q->where('approved', true)->with('user')]);

        // =========================================================
        // CHECK BRAND
        // =========================================================

        /*
    |--------------------------------------------------------------------------
    | Existing database brand
    |--------------------------------------------------------------------------
    */

        if ($listingModel->brand_id) {

            if (
                ! $listingModel->brand ||
                $listingModel->brand->slug !== $brand
            ) {
                abort(404);
            }

            /*
    |--------------------------------------------------------------------------
    | Local brand
    |--------------------------------------------------------------------------
    */
        } elseif (filled($listingModel->local_brand_name)) {

            $localBrandSlug = Str::slug(
                $listingModel->local_brand_name
            );

            if ($localBrandSlug !== $brand) {
                abort(404);
            }

            /*
    |--------------------------------------------------------------------------
    | Unbranded
    |--------------------------------------------------------------------------
    */
        } else {

            if ($brand !== 'unbranded') {
                abort(404);
            }
        }

        // =========================================================
        // WISHLIST
        // =========================================================

        $inWishlist = false;

        if (auth()->check()) {

            $inWishlist = Wishlist::where('user_id', auth()->id())
                ->where('listing_id', $listingModel->id)
                ->exists();
        }

        // =========================================================
        // CART
        // =========================================================

        $inCart = false;

        if (auth()->check()) {

            $inCart = CartItem::whereHas('cart', function ($query) {

                $query->where('user_id', auth()->id());
            })
                ->where('listing_id', $listingModel->id)
                ->exists();
        }

        // =========================================================
        // SEO
        // =========================================================

        $title = $listingModel->title;

        $description = $listingModel->description;

        $keywords = $listingModel->keywords;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

        // =========================================================
        // VIEW
        // =========================================================

        return view(
            'listings.show',
            [
                'listing' => $listingModel,
                'title' => $title,
                'description' => $description,
                'keywords' => $keywords,
                'inWishlist' => $inWishlist,
                'inCart' => $inCart,
            ]
        );
    }

    public function uae(Request $request)
    {

        /*
    |--------------------------------------------------------------------------
    | Local & Traditional Products in UAE
    |--------------------------------------------------------------------------
    */

        $category = Category::query()
            ->where('slug', 'local-traditional-products')
            ->where('status', 'active')
            ->firstOrFail();

        /*
    |--------------------------------------------------------------------------
    | Subcategories
    |--------------------------------------------------------------------------
    */

        $subcategories = $category->subcategories()
            ->where('status', 'active')
            ->orderBy('id')
            ->get();

        /*
    |--------------------------------------------------------------------------
    | UAE Products
    |--------------------------------------------------------------------------
    */

        $query = Listing::query()->active()
            ->with([
                'shop',
                'section',
                'category',
                'subcategories',
                'brand',
            ])
            ->where('status', 'published')
            ->where('active', true)
            ->whereHas('category', function ($q) use ($category) {
                $q->where('id', $category->id);
            });

        /*
    |--------------------------------------------------------------------------
    | Filter by subcategory
    |--------------------------------------------------------------------------
    |
    | Example:
    | /uae?subcategory=dates-date-products
    |
    */

        if ($request->filled('subcategory')) {

            $query->whereHas('subcategories', function ($q) use ($request, $category) {

                $q->where('slug', $request->subcategory)
                    ->where('category_id', $category->id)
                    ->where('status', 'active');
            });
        }

        /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

        $products = $query
            ->latest()
            ->paginate(24)
            ->withQueryString();

        /*
    |--------------------------------------------------------------------------
    | UAE SEO
    |--------------------------------------------------------------------------
    */

        $categoryName = app()->getLocale() === 'ar'
            ? ($category->category_name_ar ?? $category->category_name)
            : $category->category_name;

        $title = app()->getLocale() === 'ar'
            ? 'الإمارات | مُروَّج.كم'
            : 'UAE | murwaj';

        $description = app()->getLocale() === 'ar'
            ? 'اكتشف المنتجات المحلية والتقليدية في الإمارات، بما في ذلك التمور والعطور والعود والبخور والقهوة العربية والهدايا والتذكارات والحرف اليدوية.'
            : 'Discover local and traditional products in the UAE, including dates, perfumes, oud, bakhoor, Arabic coffee, gifts, souvenirs and traditional handicrafts.';

        $keywords = app()->getLocale() === 'ar'
            ? 'المنتجات المحلية في الإمارات, المنتجات التقليدية في الإمارات, هدايا الإمارات, التمور, العود, البخور, القهوة العربية, الحرف اليدوية'
            : 'UAE local products, traditional products UAE, UAE gifts, dates, oud, bakhoor, Arabic coffee, Emirati handicrafts';

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

        /*
    |--------------------------------------------------------------------------
    | UAE Page
    |--------------------------------------------------------------------------
    */

        return view('pages.uae', compact(
            'title',
            'description',
            'keywords',
            'category',
            'subcategories',
            'products'
        ));
    }
}
