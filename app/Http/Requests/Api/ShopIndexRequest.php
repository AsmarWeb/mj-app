<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'q' => 'sometimes|nullable|string|max:100', 'page' => 'sometimes|integer|min:1|max:10000',
            'per_page' => 'sometimes|integer|min:1|max:50', 'sort' => ['sometimes', Rule::in(['newest', 'oldest'])],
            'section_id' => 'sometimes|integer|min:1', 'country_id' => 'sometimes|integer|min:1',
            'state_id' => 'sometimes|integer|min:1', 'city_id' => 'sometimes|integer|min:1',
            'verified' => 'sometimes|boolean',
        ];
    }
}
