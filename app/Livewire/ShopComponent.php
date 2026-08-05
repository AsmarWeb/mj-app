<?php

namespace App\Livewire;

use App\Models\Shop;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ShopComponent extends Component
{
    #[Computed()]
    public function shops()
    {
        return Shop::published()
            ->with('author')
            ->orderBy('published_at')
            ->get()
            ->take(1);
    }

    public function render()
    {
        return view('livewire.shop-component');
    }
}
