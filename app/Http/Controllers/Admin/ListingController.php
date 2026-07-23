<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;

class ListingController extends Controller
{

    /**
     * Display listings.
     */
    public function index(Request $request)
    {
        $listings = Listing::query()
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('slug', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();


        SEOMeta::setTitle('Listings');


        return view('admin.listings.index', compact('listings'));
    }


}