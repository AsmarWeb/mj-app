<?php

return [
    // Used only when creating missing seed plans. Existing operator settings are retained.
    'basic_price' => env('MEMBERSHIP_BASIC_STRIPE_PRICE') ?: null,
    'pro_price' => env('MEMBERSHIP_PRO_STRIPE_PRICE') ?: null,
];
