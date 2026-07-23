<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Account;
use Stripe\AccountLink;
use Stripe\Exception\ApiErrorException;

class ConnectController extends Controller
{

    public function createAccount(Request $request)
    {
        $shop = $request->user()->shop;

        if (! $shop) {
            return redirect()->route('shop.create', 1);
        }


        Stripe::setApiKey(
            config('cashier.secret')
        );


        try {


            if (!$shop->stripe_account_id) {


                $account = Account::create([

                    'type' => 'express',

                    'country' => 'AE',

                    'email' => $request->user()->email,

                ]);


                $shop->update([

                    'stripe_account_id' => $account->id,

                ]);

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

        Stripe::setApiKey(
            config('cashier.secret')
        );


        if (!$accountId) {

            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Stripe account was not created.'
                );

        }


        try {


            $link = AccountLink::create([

                'account' => $accountId,

                'refresh_url' => route('connect.refresh'),

                'return_url' => route('connect.success'),

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


        Stripe::setApiKey(
            config('cashier.secret')
        );


        try {


            $account = Account::retrieve(
                $shop->stripe_account_id
            );


            $shop->update([

                'stripe_connected' =>
                    $account->details_submitted,

            ]);


            return redirect()
                ->route('shop.dashboard')
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