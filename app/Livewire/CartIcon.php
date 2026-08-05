<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartIcon extends Component
{
    public $count = 0;

    protected $listeners = ['cart-updated' => 'refreshCart'];

    public function mount()
    {
        $this->refreshCart();
    }

    public function refreshCart()
    {
        $this->count = Auth::check() && Auth::user()->cart
            ? Auth::user()->cart->items()->sum('quantity')
            : 0;
    }

    public function render()
    {
        return view('livewire.cart-icon');
    }
}
