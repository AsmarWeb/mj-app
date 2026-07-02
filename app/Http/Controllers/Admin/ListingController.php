<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $listings = Listing::query()
            ->where('title', 'like', "%{$search}%")->paginate(5);
        return view('admin.listings.index', compact('listings'));
    }

    public function show(Listing $listing)
    {
        $title = $listing->title;
        $description = $listing->description;
        $keywords = $listing->keywords;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

        return view('listings.show', compact('listing', 'title', 'description', 'keywords'));
    }
}
