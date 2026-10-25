<?php

namespace App\Services\Billing;

use App\Models\Plan;
use App\Models\PlanCheckoutAttempt;
use App\Models\User;
use App\Services\Checkout\AedAmount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class PlanCheckout
{
    public function start(User $user, Plan $plan): string
    {
        if (! $plan->is_active || $plan->is_free || (float) $plan->price <= 0 || ! preg_match('/^price_[A-Za-z0-9]+$/D', (string) $plan->stripe_price)) {
            throw ValidationException::withMessages(['billing' => 'This paid plan is not configured for checkout.']);
        }
        $gateway = app(SubscriptionGateway::class);
        $price = $gateway->price($plan->stripe_price);
        if (($price['id'] ?? null) !== $plan->stripe_price || ($price['active'] ?? false) !== true
            || ($price['type'] ?? null) !== 'recurring' || ($price['currency'] ?? null) !== strtolower(config('cashier.currency'))
            || ($price['unit_amount'] ?? null) !== AedAmount::fils($plan->getRawOriginal('price'))
            || ($price['recurring']['interval'] ?? null) !== ($plan->billing_period === 'yearly' ? 'year' : 'month')
            || ($price['recurring']['interval_count'] ?? null) !== 1) {
            throw ValidationException::withMessages(['billing' => 'The Stripe price does not match this plan amount, currency or billing period. Contact support.']);
        }
        $attempt = DB::transaction(function () use ($user, $plan, $gateway) {
            $locked = User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            abort_unless($locked->shop()->exists(), 403);
            $customer = $gateway->customer($locked);
            foreach ($gateway->subscriptions($customer) as $subscription) {
                if (! in_array($subscription['status'], ['canceled', 'incomplete_expired'], true)) {
                    throw ValidationException::withMessages(['billing' => 'An existing Stripe subscription requires attention. Use Manage billing instead of creating another.']);
                }
            }
            $old = PlanCheckoutAttempt::where('user_id', $locked->id)->lockForUpdate()->first();
            if ($old) {
                // Reconcile a known expired session before replacing it. Unknown outcomes fail closed.
                if ($old->stripe_session_id) {
                    $session = $gateway->session($old->stripe_session_id);
                    $this->assertSession($old, $session);
                    if (($session['status'] ?? null) === 'expired') {
                        $old->delete();
                        $old = null;
                    }
                }
                if ($old && (int) $old->plan_id !== (int) $plan->id) {
                    throw ValidationException::withMessages(['billing' => 'Another plan checkout is pending. Resume it or wait for confirmed expiry.']);
                }
                if ($old) {
                    return $old;
                }
            }
            $token = (string) Str::uuid();
            $expires = now()->addHour();

            return PlanCheckoutAttempt::create(['user_id' => $locked->id, 'plan_id' => $plan->id, 'token' => $token,
                'expires_at' => $expires, 'payload' => [
                    'mode' => 'subscription', 'customer' => $customer,
                    'line_items' => [['price' => $plan->stripe_price, 'quantity' => 1]],
                    'subscription_data' => ['metadata' => ['type' => 'default', 'plan_id' => (string) $plan->id]],
                    'client_reference_id' => $token, 'expires_at' => $expires->timestamp,
                    'success_url' => route('subscription.success').'?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('plans.index'),
                ]]);
        }, 3);
        if (! $attempt->stripe_session_id && $attempt->expires_at->isPast()) {
            throw ValidationException::withMessages(['billing' => 'An uncertain checkout has expired locally. Contact support to reconcile it before another attempt.']);
        }
        // Persisted token/payload survive network failures and concurrent clicks.
        $session = $attempt->stripe_session_id ? $gateway->session($attempt->stripe_session_id)
            : $gateway->create($attempt->payload, 'murwaj-plan-'.$attempt->token);
        $this->assertSession($attempt, $session);
        $attempt->update(['stripe_session_id' => $session['id']]);
        if (($session['status'] ?? null) !== 'open' || ! is_string($session['url'] ?? null)
            || ! str_starts_with($session['url'], 'https://checkout.stripe.com/')) {
            throw ValidationException::withMessages(['billing' => 'Checkout is closed. Refresh your membership or use Manage billing.']);
        }

        return $session['url'];
    }

    public function assertSession(PlanCheckoutAttempt $attempt, array $session): void
    {
        if (! str_starts_with($session['id'] ?? '', 'cs_') || ($session['mode'] ?? null) !== 'subscription'
            || ($session['customer'] ?? null) !== $attempt->payload['customer']
            || ($session['client_reference_id'] ?? null) !== $attempt->token
            || ($attempt->stripe_session_id && $attempt->stripe_session_id !== $session['id'])) {
            throw new RuntimeException('Subscription checkout identity mismatch.');
        }
    }
}
