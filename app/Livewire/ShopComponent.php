<?php

namespace App\Livewire;

use App\Models\Listing;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Computed;

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
        $listings = Listing::latest();
        return view('livewire.shop-component', ['listings' => $listings]);
    }
}
