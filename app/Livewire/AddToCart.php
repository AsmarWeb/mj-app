<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Listing;
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

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $item = $cart->items()->where('listing_id', $this->listing->id)->first();

        if ($item) {
            $item->increment('quantity', $this->quantity);
        } else {
            $cart->items()->create([

                'listing_id' => $this->listing->id,

                'shop_id' => $this->listing->shop_id,

                'price' => $this->listing->price,

                'quantity' => $this->quantity,
            ]);
        }

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
