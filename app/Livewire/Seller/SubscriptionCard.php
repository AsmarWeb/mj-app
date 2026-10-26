<?php

namespace App\Livewire\Seller;

use Livewire\Component;

class SubscriptionCard extends Component
{
    public function render()
    {
        $shop = auth()->user()->shop;

        $subscription = $shop?->subscriptions()
            ->entitled()
            ->orderByRaw("CASE WHEN payment_provider = 'stripe' THEN 0 ELSE 1 END")
            ->with('plan')
            ->latest()
            ->first();

        return view('livewire.seller.subscription-card', [
            'subscription' => $subscription,
        ]);
    }
}
