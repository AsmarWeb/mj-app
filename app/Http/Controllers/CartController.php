<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Listing;
use App\Services\Checkout\CartService;
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

        $shops = $cart->items->filter(fn ($item) => $item->listing && $item->listing->shop)
            ->groupBy(function ($item) {

                return $item->listing->shop_id;

            });

        $total = $shops->flatten(1)->sum(function ($item) {

            return $item->price * $item->quantity;

        });

        return view('cart.index', compact(
            'shops',
            'total'
        ));
    }

    public function increase(CartItem $item, CartService $carts)
    {
        $carts->increase(auth()->user(), $item);

        return back();
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

    public function add(Request $request, Listing $listing, CartService $carts)
    {
        $data = $request->validate(['quantity' => ['sometimes', 'integer', 'min:1', 'max:99']]);
        $carts->add($request->user(), $listing->id, (int) ($data['quantity'] ?? 1));

        return back()->with('success', 'Product added to cart');
    }
}
