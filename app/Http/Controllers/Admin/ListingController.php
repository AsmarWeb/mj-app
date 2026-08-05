<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display all listings.
     */
    public function index(Request $request)
    {
        $listings = Listing::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', "%{$request->search}%")
                        ->orWhere('title_ar', 'like', "%{$request->search}%")
                        ->orWhere('slug', 'like', "%{$request->search}%")
                        ->orWhere('sku', 'like', "%{$request->search}%");
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        SEOMeta::setTitle('Listings');

        return view('admin.listings.index', compact('listings'));
    }

    /**
     * Feature a listing.
     */
    public function featured(Listing $listing)
    {
        $listing->update([
            'featured' => true,
            'featured_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Listing featured successfully.');
    }

    /**
     * Remove featured status.
     */
    public function unfeatured(Listing $listing)
    {
        $listing->update([
            'featured' => false,
            'featured_at' => null,
        ]);

        return redirect()->back()->with('success', 'Listing removed from featured.');
    }
}
