<?php

namespace App\Livewire\Seller;

use Livewire\Component;

class SubscriptionCard extends Component
{
    public function render()
    {
        $shop = auth()->user()->shop;

        $subscription = $shop?->subscriptions()
            ->where('status','active')
            ->with('plan')
            ->latest()
            ->first();

        return view('livewire.seller.subscription-card', [
            'subscription' => $subscription,
        ]);
    }
}
