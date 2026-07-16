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
}
