<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Stripe\Account;
use Stripe\AccountLink;
use Stripe\Stripe;

class StripeConnectController extends Controller
{
    public function connect()
    {
        $shop = auth()->user()->shop;

        Stripe::setApiKey(config('cashier.secret'));

        if (! $shop->stripe_account_id) {

            $account = Account::create([
                'type' => 'express',
                'country' => 'AE', // or your seller's country
                'email' => auth()->user()->email,
                'capabilities' => [
                    'card_payments' => [
                        'requested' => true,
                    ],
                    'transfers' => [
                        'requested' => true,
                    ],
                ],
            ]);

            $shop->update([
                'stripe_account_id' => $account->id,
            ]);
        }

        $accountLink = AccountLink::create([
            'account' => $shop->stripe_account_id,
            'refresh_url' => route('seller.stripe.connect'),
            'return_url' => route('seller.stripe.success'),
            'type' => 'account_onboarding',
        ]);

        return redirect($accountLink->url);
    }

    public function success()
    {
        $shop = auth()->user()->shop;

        $shop->update([
            'stripe_connected' => true,
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Stripe account connected successfully.');
    }
}
