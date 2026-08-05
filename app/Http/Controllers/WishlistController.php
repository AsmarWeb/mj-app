<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class WishlistController extends Controller
{
    public function add(Listing $listing)
    {
        $wishlist = auth()->user()
            ->wishlists()
            ->where('listing_id', $listing->id)
            ->first();

        if ($wishlist) {

            $wishlist->delete();

            return back()->with(
                'success',
                'Removed from wishlist'
            );

        }

        auth()->user()
            ->wishlists()
            ->create([
                'listing_id' => $listing->id,
            ]);

        return back()->with(
            'success',
            'Added to wishlist'
        );
    }
}
