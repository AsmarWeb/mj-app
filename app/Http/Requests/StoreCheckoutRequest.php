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
        if (! is_string($this->input('recipient_phone'))) {
            return;
        }
        $phone = strtr($this->input('recipient_phone'), array_combine(
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
            'recipient_phone' => ['required', 'string', 'regex:/^\+971[0-9]{8,9}$/D'],
            'emirate' => ['required', Rule::in(['abu_dhabi', 'dubai', 'sharjah', 'ajman', 'umm_al_quwain', 'ras_al_khaimah', 'fujairah'])],
            'city' => ['required', 'string', 'max:120'],
            'area' => ['required', 'string', 'max:120'],
            'address_line' => ['required', 'string', 'min:5', 'max:500'],
            'building' => ['required', 'string', 'max:120'],
            'unit' => ['nullable', 'string', 'max:60'],
            'landmark' => ['nullable', 'string', 'max:200'],
            'delivery_notes' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        if (app()->getLocale() !== 'ar') {
            return ['recipient_phone.regex' => 'Enter a valid UAE phone, such as 050 123 4567 or +971501234567.',
                'address_line.min' => 'Add at least 5 characters of street and address details.'];
        }

        return ['required' => 'حقل :attribute مطلوب.', 'string' => 'أدخل نصًا صالحًا في :attribute.',
            'max.string' => 'يجب ألا يتجاوز :attribute عدد :max حرفًا.', 'integer' => 'اختر قيمة صحيحة لحقل :attribute.',
            'recipient_phone.regex' => 'أدخل رقم هاتف إماراتيًا صحيحًا مثل 0501234567 أو ‎+971501234567.',
            'emirate.in' => 'اختر إحدى إمارات الدولة من القائمة.', 'shop_id.exists' => 'اختر متجرًا متاحًا من السلة.',
            'address_line.min' => 'أضف 5 أحرف على الأقل لتوضيح الشارع والعنوان.'];
    }

    public function attributes(): array
    {
        return app()->getLocale() === 'ar' ? ['shop_id' => 'المتجر', 'recipient_name' => 'اسم المستلم',
            'recipient_phone' => 'هاتف المستلم', 'emirate' => 'الإمارة', 'city' => 'المدينة', 'area' => 'المنطقة',
            'address_line' => 'العنوان', 'building' => 'المبنى', 'unit' => 'الوحدة', 'landmark' => 'المعلم القريب',
            'delivery_notes' => 'تعليمات التوصيل'] : [];
    }
}
