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
    public function add(User $user, int $listingId, int $quantity, bool $publicOnly = false): void
    {
        if ($quantity < 1 || $quantity > 99) {
            throw ValidationException::withMessages(['quantity' => 'Quantity must be between 1 and 99.']);
        }
        DB::transaction(function () use ($user, $listingId, $quantity, $publicOnly) {
            User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);
            Cart::whereKey($cart->id)->lockForUpdate()->firstOrFail();
            $item = $cart->items()->where('listing_id', $listingId)->lockForUpdate()->first();
            if ($publicOnly && $cart->items()->count() >= ($item ? 101 : 100)) {
                throw ValidationException::withMessages(['cart' => 'A mobile basket can contain up to 100 product lines.']);
            }
            $listing = Listing::with('shop')->when($publicOnly, fn ($q) => $q->active())
                ->whereKey($listingId)->lockForUpdate()->firstOrFail();
            $count = ($item?->quantity ?? 0) + $quantity;
            $this->validateItem($listing, $count);
            if ($publicOnly && AedAmount::fils($listing->getRawOriginal('price')) < 1) {
                throw ValidationException::withMessages(['listing_id' => 'Choose a product with a positive price.']);
            }
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

    public function setQuantity(User $user, int $itemId, int $quantity): void
    {
        DB::transaction(function () use ($user, $itemId, $quantity) {
            User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            $cart = $user->cart()->lockForUpdate()->firstOrFail();
            if ($cart->items()->count() > 100) {
                throw ValidationException::withMessages(['cart' => 'This basket exceeds the mobile limit. Remove items before updating quantities.']);
            }
            $item = $cart->items()->whereKey($itemId)->lockForUpdate()->firstOrFail();
            $listing = Listing::active()->with('shop')->whereKey($item->listing_id)->lockForUpdate()->firstOrFail();
            $this->validateItem($listing, $quantity);
            if (AedAmount::fils($listing->getRawOriginal('price')) < 1) {
                throw ValidationException::withMessages(['quantity' => 'Choose a product with a positive price.']);
            }
            $item->update(['quantity' => $quantity, 'shop_id' => $listing->shop_id,
                'price' => AedAmount::decimal(AedAmount::fils($listing->getRawOriginal('price')))]);
        }, 3);
    }

    public function remove(User $user, int $itemId): void
    {
        DB::transaction(function () use ($user, $itemId) {
            User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            $cart = $user->cart()->lockForUpdate()->firstOrFail();
            $cart->items()->whereKey($itemId)->lockForUpdate()->firstOrFail()->delete();
        }, 3);
    }

    public function clear(User $user): void
    {
        DB::transaction(function () use ($user) {
            User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            $cart = $user->cart()->lockForUpdate()->first();
            $cart?->items()->delete();
        }, 3);
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
