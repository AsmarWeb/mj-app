<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Listing;
use App\Services\Checkout\CartService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddToCart extends Component
{
    public Listing $listing;

    public $quantity = 1;

    public bool $added = false;

    public function mount(Listing $listing)
    {
        $this->listing = $listing;

        if (Auth::check()) {
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id(),
            ]);

            $this->added = $cart->items()
                ->where('listing_id', $listing->id)
                ->exists();
        }
    }

    public function add()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate(['quantity' => ['required', 'integer', 'min:1', 'max:99']]);
        app(CartService::class)->add(Auth::user(), $this->listing->id, (int) $this->quantity);

        $this->added = true;

        $this->dispatch('cart-updated');

        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Added to Basket',
            'message' => $this->listing->title,
        ]);
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
