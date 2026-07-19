<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
use App\Models\Shop;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
    return view('explore.index',[

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
}
