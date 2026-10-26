<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Services\Checkout\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditController extends Controller
{
    /**
     * Show edit listing page
     */
    public function edit(Listing $listing)
    {
        $shop = Auth::user()->shop;

        // Only owner can edit
        abort_if($listing->user_id !== Auth::id(), 403);

        return view('listings.edit', [
            'listing' => $listing,
            'currency' => $shop?->currency ?? 'AED',
        ]);
    }

    /**
     * Update listing
     */
    public function update(Request $request, Listing $listing)
    {
        abort_if($listing->user_id !== Auth::id(), 403);

        $validated = $request->validate([

            'title' => 'required|max:255',

            'title_ar' => 'nullable|max:255',

            'description' => 'required',

            'price' => 'required|numeric|min:1',

            'quantity' => 'required|integer|min:1',

            'condition' => 'required',

            'price_condition' => 'required',

            // Shipping
            'shipping_method' => ShippingMethod::rules($request->user()->shop),

            'delivery_days' => 'required|integer|min:1',

            'image' => 'nullable|image|max:2048',

        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Main Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            // delete old image
            if ($listing->image) {

                Storage::disk('public')
                    ->delete('products/'.$listing->image);
            }

            $imageName = time()
                .'.'
                .$request->image->extension();

            $request->image->storeAs(
                'products',
                $imageName,
                'public'
            );

            $validated['image'] = $imageName;
        }

        /*
        |--------------------------------------------------------------------------
        | Save Listing
        |--------------------------------------------------------------------------
        */

        $listing->update($validated);

        return redirect()
            ->route('profile')
            ->with(
                'success',
                'Product updated successfully.'
            );
    }
}
