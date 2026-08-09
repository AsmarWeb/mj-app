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

class ExploreController extends Controller
{

public function index(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | Main listings
    |--------------------------------------------------------------------------
    */
    $query = Listing::query()
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
                $query->where('status', 'published')
                    ->with('shop')
                    ->latest()
                    ->take(8);
            }
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
    $featuredProducts = Listing::query()
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
    $trendingProducts = Listing::query()
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
    $shops = Shop::query()
        ->with('user')
        ->withCount([
            'listings' => function ($query) {
                $query->where('status', 'published');
            }
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

    $products = Listing::whereHas('section', function ($query) use ($section) {
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

    $title = $sectionName . ' | murwaj';

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
        $category = Category::where('slug', $category)->firstOrFail();

        $products = Listing::whereHas('category', function ($query) use ($category) {
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

        $title = $categoryName . ' | murwaj';
        $description = "Browse all {$category->category_name} products on murwaj Marketplace.";
        $keywords = $category->category_name;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

        return view('pages.category')->with(compact('title', 'description', 'keywords', 'category', 'products'));
    }

    public function show($shop, $section, $category, $subcategories, $brand, $listing)
    {
        $listing = Listing::where('slug', $listing)
            ->whereHas('shop', function ($query) use ($shop) {
                $query->where('slug', $shop);
            })
            ->whereHas('section', function ($query) use ($section) {
                $query->where('slug', $section);
            })
            ->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            })
            ->whereHas('subcategories', function ($query) use ($subcategories) {
                $query->where('slug', $subcategories);
            })
            ->whereHas('brand', function ($query) use ($brand) {
                $query->where('slug', $brand);
            })
            ->with([
                'shop',
                'section',
                'category',
                'subcategories',
                'brand',
            ])
            ->firstOrFail();

        $inWishlist = false;

        if (auth()->check()) {
            $inWishlist = Wishlist::where('user_id', auth()->id())
                ->where('listing_id', $listing->id)
                ->exists();
        }

        $inCart = false;

        if (auth()->check()) {

            $inCart = CartItem::whereHas('cart', function ($query) {

                $query->where('user_id', auth()->id());

            })
                ->where('listing_id', $listing->id)
                ->exists();
        }

        $title = $listing->title;
        $description = $listing->description;
        $keywords = $listing->keywords;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

        return view('listings.show', compact('listing', 'title', 'description', 'keywords', 'inWishlist', 'inCart'));
    }
}
