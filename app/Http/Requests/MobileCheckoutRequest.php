<?php

namespace App\Http\Requests;

class MobileCheckoutRequest extends StoreCheckoutRequest
{
    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();
        $this->merge(['request_key' => $this->header('Idempotency-Key')]);
    }

    public function rules(): array
    {
        return parent::rules() + ['request_key' => ['required', 'uuid']];
    }
}
