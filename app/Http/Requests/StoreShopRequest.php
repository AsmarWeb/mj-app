<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'name' => ['required','string','max:255'],
        'location' => ['nullable','string','max:255'],

        'description' => ['nullable','string'],
        'description_ar' => ['nullable','string'],

        'phone' => ['nullable','string'],
        'whatsapp' => ['nullable','string'],

        'logo' => ['nullable','image','max:10240'],
        'banner' => ['nullable','image','max:10240'],

        'published_at' => ['nullable','date'],
        ];
    }
}
