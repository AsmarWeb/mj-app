<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotReservedUsername implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(stripos($value, 'admin') !== false || stripos($value, 'moderator') !== false){
            $fail('The username can not contain "admin" or "moderator" (case-insenstive).');
        }
    }
}
