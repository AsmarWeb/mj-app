<?php

namespace App\Services\Checkout;

use Stripe\StripeClient;

class StripeCheckoutGateway
{
    private function client(): StripeClient
    {
        return new StripeClient(['api_key' => config('cashier.secret'), 'max_network_retries' => 2]);
    }

    public function accountReady(string $account): bool
    {
        $result = $this->client()->accounts->retrieve($account);

        return $result->charges_enabled && $result->payouts_enabled;
    }

    public function create(array $payload, string $key): array
    {
        return $this->client()->checkout->sessions->create($payload, ['idempotency_key' => $key])->toArray();
    }

    public function expire(string $session): array
    {
        return $this->client()->checkout->sessions->expire($session)->toArray();
    }

    public function retrieve(string $session): array
    {
        return $this->client()->checkout->sessions->retrieve($session)->toArray();
    }
}
