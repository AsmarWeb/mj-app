<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Laravel\Cashier\Http\Controllers\WebhookController;

class StripeWebhookController extends WebhookController
{
    protected function handleCustomerSubscriptionCreated(array $payload)
    {
        $response = parent::handleCustomerSubscriptionCreated($payload);

        $this->syncPlan($payload);

        return $response;
    }

    protected function handleCustomerSubscriptionUpdated(array $payload)
    {
        $response = parent::handleCustomerSubscriptionUpdated($payload);

        $this->syncPlan($payload);

        return $response;

    }

    protected function syncPlan(array $payload)
    {
        $stripeSubscription = $payload['data']['object'];

        // Find user using Stripe customer ID
        $user = User::where(
            'stripe_id',
            $stripeSubscription['customer']
        )->first();

        if (! $user) {
            return;
        }

        // Real Stripe subscription ID
        $stripeId = $stripeSubscription['id'];

        // Find Cashier subscription
        $subscription = $user->subscriptions()
            ->where('stripe_id', $stripeId)
            ->first();

        if (! $subscription) {
            return;
        }

        // Stripe price ID
        $priceId = $stripeSubscription['items']['data'][0]['price']['id'];

        // Find your plan
        $plan = Plan::where(
            'stripe_price',
            $priceId
        )->first();

        if (! $plan) {
            return;
        }

        // Delete the old free subscription
        $user->subscriptions()
            ->where('payment_provider', 'free')
            ->update([
                'status' => 'expired',
            ]);

        // Update the new Stripe subscription
        $subscription->update([
            'shop_id' => $user->shop->id,
            'plan_id' => $plan->id,
            'payment_provider' => 'stripe',
            'status' => 'active',
        ]);
    }
}
