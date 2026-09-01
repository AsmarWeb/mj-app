<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListingResource;
use App\Models\Listing;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListingController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $listings = Listing::query()
            ->with([
                'shop',
                'category',
                'section',
                'brand',
                'subcategory',
                'state',
                'city',
            ])
            ->active()
            ->get();

        return ListingResource::collection($listings);
    }

    public function show(string $slug): ListingResource
    {
        $listing = Listing::query()
            ->with([
                'shop',
                'category',
                'section',
                'brand',
                'subcategory',
                'state',
                'city',
            ])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        return new ListingResource($listing);
    }
}
