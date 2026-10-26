<?php

namespace App\Services\Checkout;

use Illuminate\Validation\ValidationException;

final class AedAmount
{
    public static function fils(mixed $amount): int
    {
        $value = (string) $amount;
        if (! preg_match('/^([0-9]{1,7})(?:\.([0-9]{1,2}))?$/D', $value, $parts)) {
            throw ValidationException::withMessages(['cart' => 'A product has an invalid AED price.']);
        }

        return (int) $parts[1] * 100 + (int) str_pad($parts[2] ?? '', 2, '0');
    }

    public static function decimal(int $fils): string
    {
        return intdiv($fils, 100).'.'.str_pad((string) ($fils % 100), 2, '0', STR_PAD_LEFT);
    }
}
