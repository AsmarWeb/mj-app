<?php

namespace App\Services\Billing;

use App\Models\User;
use Laravel\Cashier\Cashier;

class SubscriptionGateway
{
    public function price(string $id): array
    {
        return Cashier::stripe()->prices->retrieve($id)->toArray();
    }

    public function subscription(string $id): array
    {
        return Cashier::stripe()->subscriptions->retrieve($id)->toArray();
    }

    public function subscriptions(string $customer): array
    {
        // Conservative: any non-terminal subscription prevents another checkout.
        $page = Cashier::stripe()->subscriptions->all(['customer' => $customer, 'status' => 'all', 'limit' => 100])->toArray();
        if ($page['has_more'] ?? false) {
            throw new \RuntimeException('Subscription history requires support review.');
        }

        return $page['data'];
    }

    public function customer(User $user): string
    {
        return $user->createOrGetStripeCustomer([], ['idempotency_key' => 'murwaj-member-customer-'.$user->id])->id;
    }

    public function create(array $payload, string $key): array
    {
        return Cashier::stripe()->checkout->sessions->create($payload, ['idempotency_key' => $key])->toArray();
    }

    public function session(string $id): array
    {
        return Cashier::stripe()->checkout->sessions->retrieve($id)->toArray();
    }

    public function portal(string $customer, string $returnUrl): string
    {
        return Cashier::stripe()->billingPortal->sessions->create(['customer' => $customer, 'return_url' => $returnUrl])->url;
    }
}
