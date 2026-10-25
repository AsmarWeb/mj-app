<?php

namespace App\Services\Checkout;

use App\Models\RasloConnection;
use App\Models\Shop;
use Illuminate\Validation\Rule;

class ShippingMethod
{
    public const RASLO = 'Raslo';

    public const VALUES = ['Standard Shipping', 'Express Shipping', 'Free Shipping', 'Pickup', self::RASLO];

    public static function ready(?Shop $shop): bool
    {
        return $shop && $shop->is_active && $shop->currency === 'AED'
            && RasloConnection::where('shop_id', $shop->id)->where('enabled', true)->whereNotNull('verified_at')->exists();
    }

    public static function rules(?Shop $shop): array
    {
        return ['required', 'string', Rule::in(self::VALUES), function ($attribute, $value, $fail) use ($shop) {
            if ($value === self::RASLO && ! self::ready($shop)) {
                $fail(app()->getLocale() === 'ar'
                    ? 'فعّل ربط رسلو وتحقق منه لمتجر بعملة AED قبل اختيار توصيل رسلو.'
                    : 'Enable and verify Raslo for an AED store before selecting Raslo delivery.');
            }
        }];
    }
}
