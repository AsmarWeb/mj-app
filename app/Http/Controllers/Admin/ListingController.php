<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
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
}
