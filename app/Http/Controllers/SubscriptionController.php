<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display subscription plans.
     */
    public function index()
    {
        $user = auth()->user();

        /*
         * Get all active paid plans.
         */
        $plans = Plan::query()
            ->where('is_active', true)
            ->where('is_free', false)
            ->orderByDesc('is_popular')
            ->orderBy('price')
            ->get();

        /*
         * Get the user's current active default subscription.
         *
         * Only active/trialing subscriptions count as current.
         */
        $subscription = $user->subscriptions()
            ->where('type', 'default')
            ->whereIn('stripe_status', ['active', 'trialing'])
            ->latest('created_at')
            ->first();

        /*
         * The subscription is the source of truth.
         *
         * Get the exact plan attached to subscription.plan_id.
         */
        $currentPlan = null;

        if ($subscription && $subscription->plan_id) {
            $currentPlan = Plan::find($subscription->plan_id);
        }

        return view('plans.index', [
            'plans' => $plans,
            'subscription' => $subscription,
            'currentPlan' => $currentPlan,
        ]);
    }


    /**
     * Checkout / change subscription.
     */
    public function checkout(Request $request, Plan $plan)
    {
        $user = auth()->user();

        /*
         * User must create a shop first.
         */
        if (!$user->shop()->exists()) {
            return redirect()
                ->route('shop.create')
                ->with(
                    'error',
                    'Please create your shop before choosing a subscription plan.'
                );
        }

        /*
         * Make sure the selected plan is available.
         */
        if (!$plan->is_active || $plan->is_free) {
            return redirect()
                ->route('plans.index')
                ->with(
                    'error',
                    'This plan is not available.'
                );
        }

        /*
         * Get the current active default subscription.
         */
        $subscription = $user->subscriptions()
            ->where('type', 'default')
            ->whereIn('stripe_status', ['active', 'trialing'])
            ->latest('created_at')
            ->first();

        /*
         * EXISTING ACTIVE STRIPE SUBSCRIPTION
         *
         * Change the existing Stripe subscription instead of
         * creating a second subscription.
         */
        if (
            $subscription &&
            $subscription->payment_provider === 'stripe' &&
            in_array(
                $subscription->stripe_status,
                ['active', 'trialing'],
                true
            )
        ) {
            /*
             * User is already on this exact plan.
             */
            if (
                $subscription->plan_id &&
                (int) $subscription->plan_id === (int) $plan->id
            ) {
                return redirect()
                    ->route('plans.index')
                    ->with(
                        'error',
                        'You are already on the ' . $plan->name . ' plan.'
                    );
            }

            /*
             * Get the Cashier subscription.
             */
            $cashierSubscription = $user->subscription('default');

            if (!$cashierSubscription) {
                return redirect()
                    ->route('plans.index')
                    ->with(
                        'error',
                        'Your Stripe subscription could not be found.'
                    );
            }

            /*
             * Stripe subscription change.
             */
            try {
                $cashierSubscription->swap(
                    $plan->stripe_price
                );

                /*
                 * Keep the local subscription synchronized.
                 */
                $subscription->update([
                    'plan_id' => $plan->id,
                    'stripe_price' => $plan->stripe_price,
                    'payment_provider' => 'stripe',
                ]);

                return redirect()
                    ->route('plans.index')
                    ->with(
                        'success',
                        'Your subscription has been changed to ' . $plan->name . '.'
                    );
            } catch (\Throwable $e) {
                report($e);

                return redirect()
                    ->route('plans.index')
                    ->with(
                        'error',
                        'Unable to change your subscription. Please try again.'
                    );
            }
        }

        /*
         * FREE USER
         *
         * Create a new Stripe Checkout session.
         */
        session([
            'selected_plan_id' => $plan->id,
        ]);

        return $user
            ->newSubscription(
                'default',
                $plan->stripe_price
            )
            ->checkout([
                'success_url' => route('subscription.success'),
                'cancel_url' => route('plans.index'),
            ]);
    }


    /**
     * Stripe checkout success.
     */
    public function success()
    {
        $user = auth()->user();

        $selectedPlanId = session('selected_plan_id');

        if ($selectedPlanId) {
            $subscription = $user->subscriptions()
                ->where('type', 'default')
                ->latest('created_at')
                ->first();

            if ($subscription) {
                $subscription->update([
                    'plan_id' => $selectedPlanId,
                    'payment_provider' => 'stripe',
                ]);
            }
        }

        session()->forget('selected_plan_id');

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Your payment was received. Your subscription is being activated.'
            );
    }
}
