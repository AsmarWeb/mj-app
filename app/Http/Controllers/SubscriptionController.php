<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

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

    return $user
        ->newSubscription('default', $plan->stripe_price)
        ->checkout([
            'success_url' => route('subscription.success'),
            'cancel_url' => route('plans.index'),
        ]);
    }

    public function success()
    {
    $user = auth()->user();
    $shop = $user->shop;

    $plan = Plan::find(session('selected_plan_id'));

    if (! $plan) {
        return redirect()->route('plans.index')
            ->with('error', 'Unable to determine the selected plan.');
    }

    $subscription = $shop->subscriptions()
        ->where('status', 'active')
        ->latest()
        ->first();

    if ($subscription) {
        $subscription->update([
            'plan_id'       => $plan->id,
            'stripe_price'  => $plan->stripe_price,
            'status'        => 'active',
        ]);
    }

    session()->forget('selected_plan_id');

    return redirect()->route('shop.dashboard')
        ->with('success', 'Your subscription has been upgraded successfully.');
    }
}
