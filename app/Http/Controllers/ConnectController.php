<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Account;
use Stripe\AccountLink;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class ConnectController extends Controller
{
    public function createAccount(Request $request)
    {
        $user = $request->user();

        $shop = $user->shop;

        if (! $shop) {

            return redirect()
                ->route('shop.create', 1)
                ->with('error', 'Please create your shop first.');

        }

        Stripe::setApiKey(
            config('cashier.secret')
        );

        try {

            if (! $shop->stripe_account_id) {

                $account = Account::create([

                    'type' => 'express',

                    'country' => 'AE',

                    'email' => $user->email,

                ]);

                // Save manually to avoid fillable problems

                $shop->stripe_account_id = $account->id;

                $shop->save();

                // Reload database value

                $shop->refresh();

            }

            if (! $shop->stripe_account_id) {

                return back()->with(
                    'error',
                    'Stripe account was not created.'
                );

            }

            return $this->onboarding(
                $shop->stripe_account_id
            );

        } catch (ApiErrorException $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );

        }

    }

    public function onboarding($accountId)
    {

        if (! $accountId) {

            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Missing Stripe account ID.'
                );

        }

        Stripe::setApiKey(
            config('cashier.secret')
        );

        try {

            $link = AccountLink::create([

                'account' => $accountId,

                'refresh_url' => route(
                    'connect.refresh'
                ),

                'return_url' => route(
                    'connect.success'
                ),

                'type' => 'account_onboarding',

            ]);

            return redirect(
                $link->url
            );

        } catch (ApiErrorException $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );

        }

    }

    public function success(Request $request)
    {

        $shop = $request->user()->shop;

        if (! $shop || ! $shop->stripe_account_id) {

            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Stripe account not found.'
                );

        }

        Stripe::setApiKey(
            config('cashier.secret')
        );

        try {

            $account = Account::retrieve(
                $shop->stripe_account_id
            );

            $shop->stripe_connected =
                $account->details_submitted;

            $shop->save();

            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    'Stripe connected successfully.'
                );

        } catch (ApiErrorException $e) {

            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    $e->getMessage()
                );

        }

    }

    public function refresh()
    {

        return redirect()
            ->route('connect.create');

    }
}
