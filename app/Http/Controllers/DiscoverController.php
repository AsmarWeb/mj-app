<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Page;
use App\Models\Shop;
use Illuminate\Http\Request;

class DiscoverController extends Controller
{
    public function discover()
    {
        $shop = Shop::where('user_id', auth()->id())->firstOrFail();


        $title = 'murwaj';
        $description = 'murwaj is an online marketplace that connects buyers and sellers of a wide range of products, including electronics, fashion, home goods, and more. With a user-friendly interface and secure payment options, Murwaj makes it easy for customers to find and purchase the products they need while providing sellers with a platform to reach a large audience.';
        $keywords = 'murwaj.com. buy electronics, computers, apparel, fashion accessories, shoes, watches, furniture, home and kitchen goods, beauty, personal care, grocery, gourmet food.';

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

        $categories = Category::where('status', 'active')->get();
        $listings = Listing::where('shop_id', $shop->id)
        ->where('user_id', auth()->id())
        ->latest()
        ->paginate(10);

        return view('pages.discover')->with(compact('title', 'description', 'keywords', 'categories', 'listings'));
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
}
