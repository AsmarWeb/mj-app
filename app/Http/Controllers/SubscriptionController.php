<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PlanCheckoutAttempt;
use App\Services\Billing\PlanCheckout;
use App\Services\Billing\SubscriptionGateway;
use App\Services\Billing\SubscriptionSync;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscription = $request->user()->subscriptions()->entitled()->with('plan')
            ->orderByRaw("CASE WHEN payment_provider = 'stripe' THEN 0 ELSE 1 END")->latest('id')->first();

        return view('plans.index', [
            // is_popular does not exist in the plans schema.
            'plans' => Plan::where('is_active', true)->where('is_free', false)->orderBy('price')->get(),
            'subscription' => $subscription, 'currentPlan' => $subscription?->plan,
            'freePlan' => Plan::where('is_active', true)->where('is_free', true)->where('price', 0)->first(),
            'hasStripeCustomer' => filled($request->user()->stripe_id),
        ]);
    }

    public function checkout(Request $request, Plan $plan, PlanCheckout $checkout)
    {
        if (! $request->user()->shop()->exists()) {
            return redirect()->route('shop.create', 1)->with('error', 'Create your shop before subscribing.');
        }
        try {
            return redirect()->away($checkout->start($request->user(), $plan));
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            // Do not expose credentials/provider payloads through error pages or flashed input.
            return back()->withErrors(['billing' => 'Billing is unavailable. Retry the same plan later; do not start another payment.']);
        }
    }

    public function portal(Request $request, SubscriptionGateway $gateway)
    {
        abort_unless($request->user()->shop && $request->user()->stripe_id, 403);
        try {
            $url = $gateway->portal($request->user()->stripe_id, route('plans.index'));
            if (! str_starts_with($url, 'https://billing.stripe.com/')) {
                throw new \RuntimeException('Unexpected billing destination.');
            }

            return redirect()->away($url);
        } catch (\Throwable $e) {
            return back()->withErrors(['billing' => 'Cannot open billing management. Please contact support.']);
        }
    }

    public function success(Request $request, SubscriptionGateway $gateway, PlanCheckout $checkout, SubscriptionSync $sync)
    {
        // A redirect or selected_plan_id session value never grants a paid plan.
        $request->session()->forget('selected_plan_id');
        $attempt = PlanCheckoutAttempt::where('user_id', $request->user()->id)->first();
        if ($attempt && $request->filled('session_id')) {
            try {
                $request->validate(['session_id' => 'required|string|max:255|regex:/^cs_[A-Za-z0-9_]+$/D']);
                $session = $gateway->session($request->string('session_id')->toString());
                $checkout->assertSession($attempt, $session);
                if (($session['status'] ?? null) === 'complete' && is_string($session['subscription'] ?? null)) {
                    $sync->sync($session['subscription'], $session['customer']);
                }
            } catch (\Throwable $e) {
                return redirect()->route('plans.index')->withErrors(['billing' => 'Payment confirmation is pending. The signed Stripe webhook will update membership; do not pay again.']);
            }
        }

        return redirect()->route('plans.index')->with('success', 'Membership refreshed. Paid access requires confirmed Stripe subscription status.');
    }
}
