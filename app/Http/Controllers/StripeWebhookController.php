<?php

namespace App\Http\Controllers;

use App\Services\Billing\SubscriptionSync;
use App\Services\Checkout\DigitalCheckoutService;
use App\Services\Checkout\PhysicalCheckoutService;
use Illuminate\Http\Request;
use Laravel\Cashier\Http\Controllers\WebhookController;

class StripeWebhookController extends WebhookController
{
    public function handleWebhook(Request $request)
    {
        abort_unless(filled(config('cashier.webhook.secret')), 503, 'Webhook signing is not configured.');

        return parent::handleWebhook($request);
    }

    protected function handleCheckoutSessionCompleted(array $payload)
    {
        $session = $payload['data']['object'];
        if (($session['mode'] ?? null) === 'subscription' && is_string($session['subscription'] ?? null)
            && is_string($session['customer'] ?? null)) {
            app(SubscriptionSync::class)->sync($session['subscription'], $session['customer']);
        } elseif (app(DigitalCheckoutService::class)->accepts($session)) {
            app(DigitalCheckoutService::class)->synchronize($session, $payload['type'] ?? null);
        } else {
            app(PhysicalCheckoutService::class)->synchronize($session);
        }

        return response('OK', 200);
    }

    protected function handleCheckoutSessionAsyncPaymentSucceeded(array $payload)
    {
        return $this->handleCheckoutSessionCompleted($payload);
    }

    protected function handleCheckoutSessionAsyncPaymentFailed(array $payload)
    {
        return $this->handleCheckoutSessionCompleted($payload);
    }

    protected function handleCheckoutSessionExpired(array $payload)
    {
        return $this->handleCheckoutSessionCompleted($payload);
    }

    protected function handleCustomerSubscriptionCreated(array $payload)
    {
        return $this->syncSubscription($payload);
    }

    protected function handleCustomerSubscriptionUpdated(array $payload)
    {
        return $this->syncSubscription($payload);
    }

    protected function handleCustomerSubscriptionDeleted(array $payload)
    {
        return $this->syncSubscription($payload);
    }

    private function syncSubscription(array $payload)
    {
        $data = $payload['data']['object'];
        app(SubscriptionSync::class)->sync($data['id'], $data['customer']);

        return response('OK', 200);
    }
}
