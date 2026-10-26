<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Catalog\PublicFields;
use App\Services\Checkout\AedAmount;
use App\Services\Checkout\CartService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CustomerCartController extends Controller
{
    public function show(Request $request)
    {
        return $this->snapshot($request);
    }

    public function add(Request $request, CartService $carts)
    {
        $data = $request->validate(['listing_id' => ['required', 'integer', 'min:1'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99']]);
        $carts->add($request->user(), $data['listing_id'], $data['quantity'], true);

        return $this->snapshot($request, 201);
    }

    public function update(Request $request, string $item, CartService $carts)
    {
        $data = $request->validate(['quantity' => ['required', 'integer', 'min:1', 'max:99']]);
        $carts->setQuantity($request->user(), (int) $item, $data['quantity']);

        return $this->snapshot($request);
    }

    public function remove(Request $request, string $item, CartService $carts)
    {
        $carts->remove($request->user(), (int) $item);

        return response()->noContent();
    }

    public function clear(Request $request, CartService $carts)
    {
        $carts->clear($request->user());

        return response()->noContent();
    }

    private function snapshot(Request $request, int $status = 200)
    {
        $cart = $request->user()->cart()->first();
        $items = $cart?->items()->orderBy('id')->with(['listing' => fn ($q) => $q->active()->with('shop')])->limit(101)->get() ?? collect();
        if ($items->count() > 100) {
            throw ValidationException::withMessages(['cart' => 'This basket exceeds the 100-line mobile limit. Manage it on the website.']);
        }
        $subtotal = 0;
        $unavailable = false;
        $rows = $items->map(function ($item) use (&$subtotal, &$unavailable) {
            $listing = $item->listing;
            $unit = null;
            if ($listing && $listing->currency === 'AED') {
                try {
                    $unit = AedAmount::fils($listing->getRawOriginal('price'));
                } catch (ValidationException $error) {
                    // Invalid legacy prices are unavailable, not silently replaced by cart snapshots.
                }
            }
            $quantity = (int) $item->quantity;
            $available = $listing && $unit > 0 && $quantity >= 1 && $quantity <= 99 && $quantity <= $listing->quantity;
            $unavailable = $unavailable || ! $available;
            if ($available) {
                $subtotal += $unit * $quantity;
            }

            return ['id' => $item->id, 'quantity' => $quantity, 'available' => (bool) $available,
                'unit_price' => $unit === null ? null : AedAmount::decimal($unit),
                'line_total' => $available ? AedAmount::decimal($unit * $quantity) : null,
                'product' => $listing ? ['id' => $listing->id, 'slug' => $listing->slug,
                    'title' => $listing->title, 'title_ar' => $listing->title_ar,
                    'image_url' => PublicFields::media($listing->image, 'products/'),
                    'currency' => $listing->currency, 'quantity_in_stock' => (int) $listing->quantity,
                    'shipping_method' => $listing->shipping_method,
                    'shop' => ['id' => $listing->shop->id, 'name' => $listing->shop->name, 'slug' => $listing->shop->slug]] : null];
        });

        return response()->json(['data' => ['items' => $rows, 'lines_count' => $rows->count(),
            'total_quantity' => (int) $items->sum('quantity'), 'currency' => 'AED',
            'subtotal' => $unavailable ? null : AedAmount::decimal($subtotal),
            'has_unavailable_items' => $unavailable]], $status);
    }
}
