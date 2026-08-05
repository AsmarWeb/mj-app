<?php

namespace App\Http\Controllers;

use App\Models\Plan;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = Plan::where('is_active', true)
            ->where('is_free', false)
            ->get();

        return view('plans.index', compact('plans'));
    }

    public function checkout(Plan $plan)
    {
        $user = auth()->user();

        // Store the selected plan so we know what to apply after payment

        session([
            'selected_plan_id' => $plan->id,
        ]);

        $subscription = $user->subscriptions()
            ->where('type', 'default')
            ->latest()
            ->first();

        // User is on Free plan (local subscription)
        if ($subscription && $subscription->payment_provider === 'free') {

            // Do NOT use swap()
            // Create a new Stripe subscription

            // Create real Stripe subscription
            return $user
                ->newSubscription('default', $plan->stripe_price)
                ->checkout([
                    'success_url' => route('subscription.success'),
                    'cancel_url' => route('plans.index'),
                ]);
        }

        // User already has Stripe subscription
        if ($subscription && $subscription->payment_provider === 'stripe') {

            $user->subscription('default')
                ->swap($plan->stripe_price);

            return redirect()
                ->route('shop.dashboard')
                ->with('success', 'Plan updated.');
        }

        // No subscription exists
        return $user
            ->newSubscription('default', $plan->stripe_price)
            ->checkout([
                'success_url' => route('subscription.success'),
                'cancel_url' => route('plans.index'),
            ]);
    }

    public function success()
    {
        session()->forget('selected_plan_id');

        return redirect()
            ->route('shop.dashboard')
            ->with('success', 'Your payment was received. Your subscription is being activated.');
    }
}
