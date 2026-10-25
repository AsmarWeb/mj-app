<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ListingIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'q' => 'sometimes|nullable|string|max:100', 'page' => 'sometimes|integer|min:1|max:10000',
            'per_page' => 'sometimes|integer|min:1|max:50',
            'sort' => ['sometimes', Rule::in(['newest', 'oldest', 'price_asc', 'price_desc'])],
            'shop_id' => 'sometimes|integer|min:1', 'category_id' => 'sometimes|integer|min:1',
            'section_id' => 'sometimes|integer|min:1', 'state_id' => 'sometimes|integer|min:1',
            'currency' => ['sometimes', 'regex:/^[A-Z]{3}$/D'],
            'city_id' => 'sometimes|integer|min:1', 'in_stock' => 'sometimes|boolean',
            'min_price' => ['sometimes', 'regex:/^[0-9]{1,8}(\.[0-9]{1,2})?$/D'],
            'max_price' => ['sometimes', 'regex:/^[0-9]{1,8}(\.[0-9]{1,2})?$/D'],
        ];
    }

    public function after(): array
    {
        return [function (Validator $validator) {
            if (! $validator->errors()->any() && $this->has(['min_price', 'max_price'])
                && (float) $this->input('min_price') > (float) $this->input('max_price')) {
                $validator->errors()->add('max_price', 'Maximum price must be at least the minimum price.');
            }
        }];
    }
}
