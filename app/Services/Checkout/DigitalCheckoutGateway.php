<?php

namespace App\Services\Checkout;

use Stripe\StripeClient;

class DigitalCheckoutGateway
{
    private function client(): StripeClient
    {
        return new StripeClient(['api_key' => config('services.stripe.secret'), 'max_network_retries' => 2]);
    }

    public function create(array $payload, string $key): array
    {
        return $this->client()->checkout->sessions->create($payload, ['idempotency_key' => $key])->toArray();
    }

    public function retrieve(string $id): array
    {
        return $this->client()->checkout->sessions->retrieve($id)->toArray();
    }
}
