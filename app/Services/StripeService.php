<?php

namespace App\Services;

use Stripe\Stripe;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(
            config('cashier.secret')
        );
    }
}
