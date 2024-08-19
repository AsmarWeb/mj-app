<?php

namespace App\View\Components\Admin;

use App\Models\Listing;
use App\Models\Shop;
use App\Models\Subscriber;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dashboard extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $userCount = User::count();
        $shopCount = Shop::count();
        $listingCount = Listing::count();
        $subscriberCount = Subscriber::count();
        return view('components.admin.dashboard', [
            'userCount' => $userCount,
            'shopCount' => $shopCount,
            'listingCount' => $listingCount,
            'subscriberCount' => $subscriberCount
        ]);
    }
}
