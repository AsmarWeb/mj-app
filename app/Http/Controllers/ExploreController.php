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
        $query = Listing::query()->where('status', 'published');

    if ($request->filled('section')) {

        $query->whereHas('section', function ($q) use ($request) {

            $q->where('slug', $request->section);

        });

    }

    $listings = $query->latest()->paginate(20);

    $digitalProducts = DigitalProduct::where('status','published')
    ->latest()
    ->take(8)
    ->get();

    return view('explore.index',[
        'listings' => $listings,
        'digitalProducts' => $digitalProducts,
        
        'sections' => Section::where('status', 'active')->take(5)->get(),

        'categories'=>Category::where('status','active')
            ->take(12)
            ->get(),

        'featuredProducts'=>Listing::with('shop')
            ->where('featured',true)
            ->latest()
            ->take(12)
            ->get(),


        'trendingProducts'=>Listing::latest()
            ->take(8)
            ->get(),


        'shops'=>Shop::with('user')
            ->take(8)
            ->get(),
    ]);
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

    $title = $category->category_name;
    $description = "Browse all {$category->category_name} products on murwaj Marketplace.";
    $keywords = $category->category_name;

    SEOMeta::setTitle($title);
    SEOMeta::setDescription($description);
    SEOMeta::setKeywords($keywords);

        return view('pages.category')->with(compact('title', 'description', 'keywords', 'category','products'));
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
            'brand'
        ])
        
        ->firstOrFail();

        $inWishlist = false;

        if (auth()->check()) {
        $inWishlist = Wishlist::where('user_id', auth()->id())
            ->where('listing_id', $listing->id)
            ->exists();
        }

        $inCart = false;
    
        if(auth()->check()) {

        $inCart = CartItem::whereHas('cart', function($query){

            $query->where('user_id', auth()->id());

        })
        ->where('listing_id',$listing->id)
        ->exists();
        }

        $title = $listing->title;
        $description = $listing->description;
        $keywords = $listing->keywords;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

        return view('listings.show', compact('listing', 'title', 'description', 'keywords','inWishlist','inCart'));
    }
}
