<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Page;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DiscoverController extends Controller
{
    public function discover()
    {

        $title = 'murwaj';
        $description = 'murwaj is an online marketplace that connects buyers and sellers of a wide range of products, including electronics, fashion, home goods, and more. With a user-friendly interface and secure payment options, Murwaj makes it easy for customers to find and purchase the products they need while providing sellers with a platform to reach a large audience.';
        $keywords = 'murwaj.com. buy electronics, computers, apparel, fashion accessories, shoes, watches, furniture, home and kitchen goods, beauty, personal care, grocery, gourmet food.';

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

        $categories = Category::where('status', 'active')->get();
        $listings = Listing::latest()
        ->paginate(10);

        $shops = Shop::with('user')->latest()
        ->paginate(3); 

        $topCreators = Shop::withCount('listing')
        ->with('user')
        ->orderByDesc('listings_count')
        ->orderByDesc('rating')
        ->take(4)
        ->get();


        return view('pages.discover')->with(compact('title', 'description', 'keywords', 'categories', 'listings','shops','topCreators'));
    }  

    public function category(Category $category)
    {
        $title = $category->category_name;
        $description = $category->description;
        $keywords = $category->keywords;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

        return view('pages.category')->with(compact('title', 'description', 'keywords', 'category'));
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

        $title = $listing->title;
        $description = $listing->description;
        $keywords = $listing->keywords;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

        return view('listings.show', compact('listing', 'title', 'description', 'keywords'));
    }
}
