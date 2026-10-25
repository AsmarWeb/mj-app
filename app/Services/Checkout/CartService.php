<?php

namespace App\Services\Checkout;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartService
{
    public function add(User $user, int $listingId, int $quantity): void
    {
        if ($quantity < 1 || $quantity > 99) {
            throw ValidationException::withMessages(['quantity' => 'Quantity must be between 1 and 99.']);
        }
        DB::transaction(function () use ($user, $listingId, $quantity) {
            User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);
            Cart::whereKey($cart->id)->lockForUpdate()->firstOrFail();
            $item = $cart->items()->where('listing_id', $listingId)->lockForUpdate()->first();
            $listing = Listing::with('shop')->whereKey($listingId)->lockForUpdate()->firstOrFail();
            $count = ($item?->quantity ?? 0) + $quantity;
            $this->validateItem($listing, $count);
            $values = ['shop_id' => $listing->shop_id, 'quantity' => $count, 'price' => AedAmount::decimal(AedAmount::fils($listing->getRawOriginal('price')))];
            if ($item) {
                $item->update($values);
            } else {
                $cart->items()->create(['listing_id' => $listing->id] + $values);
            }
        }, 3);
    }

    public function increase(User $user, CartItem $item): void
    {
        abort_unless((int) $item->cart->user_id === (int) $user->id, 403);
        $this->add($user, $item->listing_id, 1);
    }

    private function validateItem(Listing $listing, int $quantity): void
    {
        if ($quantity < 1 || $quantity > 99 || $quantity > $listing->quantity || ! $listing->active
            || $listing->status !== 'published' || ! $listing->shop?->is_active || $listing->currency !== 'AED'
            || ($listing->expires_at && $listing->expires_at->isPast()) || ($listing->published_at && $listing->published_at->isFuture())) {
            throw ValidationException::withMessages(['quantity' => 'Choose an available AED product and a quantity within stock (1–99).']);
        }
    }
}
