<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        $phone = strtr((string) $this->input('recipient_phone'), array_combine(
            preg_split('//u', '٠١٢٣٤٥٦٧٨٩', -1, PREG_SPLIT_NO_EMPTY), str_split('0123456789')
        ));
        $phone = preg_replace('/[\s()\-]+/u', '', $phone);
        if (str_starts_with($phone, '00971')) {
            $phone = '+'.substr($phone, 2);
        }
        if (preg_match('/^0[0-9]{8,9}$/D', $phone)) {
            $phone = '+971'.substr($phone, 1);
        }
        $this->merge(['recipient_phone' => $phone]);
    }

    public function rules(): array
    {
        return [
            'shop_id' => ['required', 'integer', 'exists:shops,id'],
            'recipient_name' => ['required', 'string', 'max:120'],
            'recipient_phone' => ['required', 'regex:/^\+971[0-9]{8,9}$/D'],
            'emirate' => ['required', Rule::in(['abu_dhabi', 'dubai', 'sharjah', 'ajman', 'umm_al_quwain', 'ras_al_khaimah', 'fujairah'])],
            'city' => ['required', 'string', 'max:120'],
            'area' => ['required', 'string', 'max:120'],
            'address_line' => ['required', 'string', 'max:500'],
            'building' => ['required', 'string', 'max:120'],
            'unit' => ['nullable', 'string', 'max:60'],
            'landmark' => ['nullable', 'string', 'max:200'],
            'delivery_notes' => ['nullable', 'string', 'max:500'],
        ];
    }
}
