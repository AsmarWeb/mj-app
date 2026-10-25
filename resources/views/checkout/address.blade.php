@php
    $ar = app()->getLocale() === 'ar';
    $label = fn ($arabic, $english) => $ar ? $arabic : $english;
    $emirates = ['abu_dhabi' => ['أبوظبي', 'Abu Dhabi'], 'dubai' => ['دبي', 'Dubai'], 'sharjah' => ['الشارقة', 'Sharjah'], 'ajman' => ['عجمان', 'Ajman'], 'umm_al_quwain' => ['أم القيوين', 'Umm Al Quwain'], 'ras_al_khaimah' => ['رأس الخيمة', 'Ras Al Khaimah'], 'fujairah' => ['الفجيرة', 'Fujairah']];
    $fields = ['recipient_name' => ['اسم المستلم', 'Recipient name'], 'recipient_phone' => ['هاتف المستلم', 'UAE phone'], 'city' => ['المدينة', 'City'], 'area' => ['المنطقة', 'Area'], 'address_line' => ['الشارع والعنوان التفصيلي', 'Street and full address'], 'building' => ['المبنى أو الفيلا', 'Building or villa'], 'unit' => ['الشقة (اختياري)', 'Unit (optional)'], 'landmark' => ['معلم قريب (اختياري)', 'Landmark (optional)'], 'delivery_notes' => ['ملاحظات التوصيل (اختياري)', 'Delivery notes (optional)']];
@endphp
<x-main-layout>
    <main dir="{{ $ar ? 'rtl' : 'ltr' }}" class="mx-auto max-w-3xl px-4 py-12 text-gray-900 dark:text-gray-100">
        <a href="{{ route('cart.index') }}" class="text-orange-600">{{ $label('العودة للسلة', 'Back to basket') }}</a>
        <h1 class="mt-5 text-3xl font-bold">{{ $label('المتجر وعنوان المستلم', 'Store and delivery address') }}</h1>
        <p class="my-4 text-gray-600 dark:text-gray-300">{{ $label('لكل متجر عملية دفع مستقلة. تبقى منتجات المتاجر الأخرى في السلة.', 'Each store has its own payment. Other stores’ items stay in your basket.') }}</p>
        <p class="mb-6 text-sm text-gray-600 dark:text-gray-300">{{ $label('رسوم الشحن لهذا الطلب: 0.00 درهم. تُؤكَّد ترتيبات التوصيل مع المتجر.', 'Shipping charge: AED 0.00. Delivery arrangements are confirmed with the store.') }}</p>
        @if ($errors->any())
            <div role="alert" class="mb-6 rounded-xl border border-red-300 bg-red-50 p-4 text-red-800"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif
        @if(session('success'))<p role="status" class="my-4 text-green-700">{{ session('success') }}</p>@endif
        @foreach($pendingOrders as $pending)
            <section class="my-6 rounded-xl border border-orange-300 p-4">
                <h2 class="font-bold">{{ $label('جلسة دفع غير مكتملة', 'Pending checkout') }} · {{ $pending->order_number }}</h2>
                <p class="my-2">{{ $label('يمكنك متابعة الدفع أو إلغاء الجلسة قبل تعديل الطلب.', 'Resume payment or cancel the session before changing this store’s order.') }}</p>
                <div class="flex flex-wrap gap-3">
                    <form method="POST" action="{{ route('checkout.resume', $pending) }}">@csrf<button class="rounded-xl bg-orange-600 px-4 py-3 text-white">{{ $label('متابعة الدفع', 'Resume payment') }}</button></form>
                    <form method="POST" action="{{ route('checkout.cancel', $pending) }}">@csrf<button class="rounded-xl border border-gray-300 px-4 py-3">{{ $label('إلغاء جلسة الدفع', 'Cancel checkout') }}</button></form>
                </div>
            </section>
        @endforeach
        <form method="POST" action="{{ route('checkout.store') }}" class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-900">
            @csrf
            <fieldset class="space-y-3">
                <legend class="mb-3 font-semibold">{{ $label('اختر المتجر', 'Choose a store') }}</legend>
                @foreach ($shops as $shopId => $items)
                    @php($shop = $items->first()->listing->shop)
                    <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4 dark:border-gray-700">
                        <input type="radio" name="shop_id" value="{{ $shopId }}" required @checked((int) old('shop_id', $selectedShop ?: ($shops->count() === 1 ? $shopId : 0)) === (int) $shopId)>
                        <span><strong>{{ $ar && $shop->name_ar ? $shop->name_ar : $shop->name }}</strong>
                            @foreach ($items as $item)<span class="block text-sm">{{ $item->listing->title }} × {{ $item->quantity }} · {{ $item->listing->price }} AED</span>@endforeach
                        </span>
                    </label>
                @endforeach
            </fieldset>
            <label class="block"><span>{{ $label('الإمارة', 'Emirate') }}</span>
                <select name="emirate" required class="mt-2 w-full rounded-xl border-gray-300 bg-transparent">
                    <option value="">{{ $label('اختر الإمارة', 'Choose emirate') }}</option>
                    @foreach ($emirates as $value => $names)<option value="{{ $value }}" @selected(old('emirate') === $value)>{{ $names[$ar ? 0 : 1] }}</option>@endforeach
                </select>
            </label>
            @foreach ($fields as $name => $names)
                <label class="block"><span>{{ $names[$ar ? 0 : 1] }}</span>
                    <input name="{{ $name }}" type="{{ $name === 'recipient_phone' ? 'tel' : 'text' }}" value="{{ old($name, $name === 'recipient_name' ? auth()->user()->name : ($name === 'recipient_phone' ? auth()->user()->phone : '')) }}" @required(!in_array($name, ['unit', 'landmark', 'delivery_notes'])) maxlength="{{ in_array($name, ['address_line', 'delivery_notes']) ? 500 : ($name === 'landmark' ? 200 : ($name === 'unit' ? 60 : 120)) }}" class="mt-2 w-full rounded-xl border-gray-300 bg-transparent">
                </label>
            @endforeach
            <button class="w-full rounded-xl bg-orange-600 px-5 py-4 font-bold text-white">{{ $label('الانتقال إلى الدفع الآمن', 'Continue to secure payment') }}</button>
        </form>
    </main>
</x-main-layout>
