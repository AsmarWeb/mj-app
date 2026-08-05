<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Listing;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()
            ->cart()
            ->with([
                'items.listing.shop',
            ])
            ->first();

        if (! $cart) {
            return view('cart.index', [
                'shops' => collect(),
                'total' => 0,
            ]);
        }

        $shops = $cart->items
            ->groupBy(function ($item) {

                return $item->listing->shop_id;

            });

        $total = $cart->items->sum(function ($item) {

            return $item->price * $item->quantity;

        });

        return view('cart.index', compact(
            'shops',
            'total'
        ));
    }

    public function increase(CartItem $item)
    {
        abort_unless(
            $item->cart->user_id == auth()->id(),
            403
        );

        if ($item->quantity >= $item->listing->quantity) {
            return back()->with('error', 'Maximum available stock reached.');
        }
        $item->increment('quantity');
    }

    public function decrease(CartItem $item)
    {
        abort_unless(
            $item->cart->user_id == auth()->id(),
            403
        );

        if ($item->quantity > 1) {
            $item->decrement('quantity');
        }

        return back();
    }

    public function destroy(CartItem $item)
    {
        abort_unless(
            $item->cart->user_id == auth()->id(),
            403
        );

        $item->delete();

        return back()->with('success', 'Item removed from basket.');
    }

    public function add(Request $request, Listing $listing)
    {
        $user = auth()->user();

        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
        ]);

        $item = $cart->items()
            ->where('listing_id', $listing->id)
            ->first();

        if ($item) {

            $newQuantity = $item->quantity + ($request->quantity ?? 1);

            if ($newQuantity > $listing->quantity) {

                return back()->with(
                    'error',
                    'Not enough stock available.'
                );

            }

            $item->update([
                'quantity' => $newQuantity,
            ]);

        } else {

            $cart->items()->create([

                'listing_id' => $listing->id,

                'shop_id' => $listing->shop_id,

                'quantity' => $request->quantity ?? 1,

                'price' => $listing->price,

            ]);

        }

        return back()->with(
            'success',
            'Product added to cart'
        );
    }
}
