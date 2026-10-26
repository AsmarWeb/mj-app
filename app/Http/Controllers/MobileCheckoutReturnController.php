<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MobileCheckoutReturnController extends Controller
{
    public function __invoke(Request $request, string $order, string $outcome)
    {
        // A signed navigation hint only. No order read/write or payment confirmation.
        $target = 'murwaj://checkout/result?'.http_build_query(['order_id' => $order, 'outcome' => $outcome]);

        return response()->view('checkout.mobile-return', ['target' => $target])
            ->header('Cache-Control', 'no-store, private')->header('Referrer-Policy', 'no-referrer')
            ->header('Content-Security-Policy', "default-src 'none'; style-src 'unsafe-inline'; base-uri 'none'; form-action 'none'; frame-ancestors 'none'");
    }
}
