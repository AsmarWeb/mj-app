@php
    $ar = app()->getLocale() === 'ar';
    $label = fn ($a, $e) => $ar ? $a : $e;
    $emirates = ['abu_dhabi' => ['أبوظبي', 'Abu Dhabi'], 'dubai' => ['دبي', 'Dubai'], 'sharjah' => ['الشارقة', 'Sharjah'], 'ajman' => ['عجمان', 'Ajman'], 'umm_al_quwain' => ['أم القيوين', 'Umm Al Quwain'], 'ras_al_khaimah' => ['رأس الخيمة', 'Ras Al Khaimah'], 'fujairah' => ['الفجيرة', 'Fujairah']];
@endphp
<x-main-layout>
<main dir="{{ $ar ? 'rtl' : 'ltr' }}" class="min-h-screen bg-[#faf7f2] px-4 py-8 text-slate-950 dark:bg-slate-950 dark:text-white sm:py-12">
    <div class="mx-auto max-w-6xl">
        <a href="{{ route('cart.index') }}" class="text-sm font-bold text-orange-700 dark:text-orange-300">{{ $label('العودة للسلة', 'Back to basket') }}</a>
        <header class="my-7 sm:my-10">
            <p class="text-xs font-bold uppercase tracking-widest text-orange-700 dark:text-orange-300">{{ $label('خطوة واحدة أقرب لطلبك', 'One step closer to your order') }}</p>
            <h1 class="mt-3 text-3xl font-black sm:text-4xl">{{ $label('إلى أين نوصّل طلبك؟', 'Where shall we deliver?') }}</h1>
            <p class="mt-3 max-w-2xl leading-7 text-slate-600 dark:text-slate-300">{{ $label('أدخل عنوانًا واضحًا داخل الإمارات، وراجع المتجر قبل الانتقال إلى الدفع الآمن.', 'Add a clear UAE address and review your store before secure payment.') }}</p>
            <ol class="mt-6 flex flex-wrap gap-3 text-xs font-bold sm:text-sm" aria-label="{{ $label('مراحل الطلب','Order steps') }}">
                <li aria-current="step" class="rounded-full bg-slate-900 px-4 py-2 text-white dark:bg-white dark:text-slate-950">1 · {{ $label('العنوان والمتجر','Address & store') }}</li>
                <li class="rounded-full border border-slate-300 px-4 py-2">2 · {{ $label('الدفع الآمن','Secure payment') }}</li>
                <li class="rounded-full border border-slate-300 px-4 py-2">3 · {{ $label('متابعة الطلب','Follow your order') }}</li>
            </ol>
        </header>
        @if($errors->any())
            <section role="alert" tabindex="-1" class="mb-6 rounded-2xl border border-red-300 bg-red-50 p-5 text-red-900">
                <h2 class="font-bold">{{ $label('راجع البيانات التالية للمتابعة','Review these details to continue') }}</h2>
                <ul class="mt-2 list-inside list-disc text-sm">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </section>
        @endif
        @if(session('success'))<p role="status" class="mb-6 rounded-xl bg-emerald-100 p-4 text-emerald-950">{{ session('success') }}</p>@endif
        @foreach($pendingOrders as $pending)
            <section class="mb-6 rounded-2xl border border-orange-300 bg-orange-50 p-5 text-slate-950">
                <h2 class="font-bold">{{ $label('جلسة دفع غير مكتملة', 'Pending checkout') }} · {{ $pending->order_number }}</h2>
                <p class="my-3 text-sm">{{ $label('تابع الدفع أو ألغِ الجلسة قبل تعديل طلب هذا المتجر.','Resume payment or cancel this session before changing this store’s order.') }}</p>
                <div class="flex flex-wrap gap-3">
                    <form method="POST" action="{{ route('checkout.resume', $pending) }}">@csrf<button class="rounded-xl bg-orange-700 px-4 py-3 font-bold text-white">{{ $label('متابعة الدفع','Resume payment') }}</button></form>
                    <form method="POST" action="{{ route('checkout.cancel', $pending) }}">@csrf<button class="rounded-xl border border-slate-400 px-4 py-3 font-bold">{{ $label('إلغاء جلسة الدفع','Cancel checkout') }}</button></form>
                </div>
            </section>
        @endforeach
        <div class="grid items-start gap-6 lg:grid-cols-3">
            <form method="POST" action="{{ route('checkout.store') }}" class="min-w-0 space-y-6 lg:col-span-2">
                @csrf
                <fieldset class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:p-7">
                    <legend class="rounded-full bg-orange-100 px-4 py-2 text-sm font-bold text-orange-950">01 · {{ $label('المتجر والمنتجات','Store & products') }}</legend>
                    <p class="mb-4 mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $label('لكل متجر عملية دفع مستقلة. تبقى منتجات المتاجر الأخرى في السلة.','Each store has its own payment. Other stores’ items stay in your basket.') }}</p>
                    <div class="space-y-3">
                    @foreach($shops as $shopId => $items)
                        @php
                            $shop = $items->first()->listing->shop;
                            $summary = $shippingSummaries[$shopId];
                            $raslo = $summary['raslo'];
                        @endphp
                        <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-slate-300 p-4 focus-within:ring-2 focus-within:ring-orange-500 dark:border-slate-600">
                            <input type="radio" name="shop_id" value="{{ $shopId }}" required @disabled(!$summary['available']) class="mt-1 text-orange-700 focus:ring-orange-500" @checked((int) old('shop_id', $selectedShop ?: ($shops->count() === 1 ? $shopId : 0)) === (int) $shopId)>
                            <span class="min-w-0 flex-1">
                                <strong class="block break-words">{{ $ar && $shop->name_ar ? $shop->name_ar : $shop->name }}</strong>
                                <span class="mt-1 block text-xs font-bold text-emerald-700 dark:text-emerald-300">{{ $raslo ? $label('توصيل رسلو','Raslo delivery') : $label('الشحن أو الاستلام بتنظيم المتجر','Shipping or pickup arranged by store') }}</span>
                                @foreach($items as $item)<span class="mt-2 block break-words text-sm text-slate-600 dark:text-slate-300">{{ $item->listing->title }} × {{ $item->quantity }} · {{ $item->listing->price }} AED {{ $label('للوحدة','each') }}</span>@endforeach
                                @if(!$summary['available'])
                                    <span class="mt-3 block text-sm font-bold text-red-700 dark:text-red-300">{{ $summary['mixed'] ? $label('افصل منتجات رسلو عن طرق الشحن الأخرى في السلة.','Separate Raslo products from other shipping methods in the basket.') : $label('الدفع غير متاح لهذا المتجر حاليًا. راجع الأسعار وتفعيل الربط مع المتجر.','Checkout is unavailable for this store. Check product prices and delivery availability with the store.') }}</span>
                                @endif
                                <span class="mt-3 block border-t border-slate-200 pt-3 font-bold">{{ $label('إجمالي المنتجات','Product total') }}: {{ $summary['total'] ?? '—' }} AED</span>
                            </span>
                        </label>
                    @endforeach
                    </div>
                </fieldset>
                <fieldset class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:p-7">
                    <legend class="rounded-full bg-orange-100 px-4 py-2 text-sm font-bold text-orange-950">02 · {{ $label('بيانات المستلم','Recipient details') }}</legend>
                    <div class="mt-2 grid gap-5 sm:grid-cols-2">
                        <x-checkout-field name="recipient_name" :label="$label('اسم المستلم','Recipient name')" required autocomplete="shipping name" :default="auth()->user()->name" />
                        <x-checkout-field name="recipient_phone" :label="$label('رقم هاتف إماراتي','UAE phone number')" type="tel" required autocomplete="shipping tel" maxlength="30" placeholder="050 123 4567" :default="auth()->user()->phone" />
                    </div>
                    <p class="mt-3 text-xs text-slate-500 dark:text-slate-400">{{ $label('يمكن إدخال الرقم بصيغة 05 أو ‎+971، بما فيها الأرقام العربية.','Use 05 or +971 format. Arabic digits are supported.') }}</p>
                </fieldset>
                <fieldset class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:p-7">
                    <legend class="rounded-full bg-orange-100 px-4 py-2 text-sm font-bold text-orange-950">03 · {{ $label('العنوان داخل الإمارات','UAE delivery address') }}</legend>
                    <div class="mt-2 grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="emirate" class="mb-2 block text-sm font-bold">{{ $label('الإمارة','Emirate') }} <span aria-hidden="true">*</span></label>
                            <select id="emirate" name="emirate" required autocomplete="shipping address-level1" aria-invalid="{{ $errors->has('emirate')?'true':'false' }}" @error('emirate') aria-describedby="emirate-error" @enderror class="w-full rounded-xl border-slate-300 bg-slate-50 px-4 py-3.5 focus:border-orange-500 focus:ring-orange-500 dark:border-slate-600 dark:bg-slate-950">
                                <option value="">{{ $label('اختر الإمارة','Choose emirate') }}</option>
                                @foreach($emirates as $value => $names)<option value="{{ $value }}" @selected(old('emirate') === $value)>{{ $names[$ar?0:1] }}</option>@endforeach
                            </select>
                            @error('emirate')<p id="emirate-error" class="mt-2 text-sm text-red-700 dark:text-red-300">{{ $message }}</p>@enderror
                        </div>
                        <x-checkout-field name="city" :label="$label('المدينة','City')" required autocomplete="shipping address-level2" :placeholder="$label('مثل دبي','e.g. Dubai')" />
                        <x-checkout-field name="area" :label="$label('المنطقة أو الحي','Area or neighbourhood')" required autocomplete="shipping address-level3" :placeholder="$label('مثل البرشاء 1','e.g. Al Barsha 1')" />
                        <x-checkout-field name="building" :label="$label('اسم المبنى أو رقم الفيلا','Building name or villa number')" required :placeholder="$label('مثل مبنى النور','e.g. Al Noor Building')" />
                        <x-checkout-field name="address_line" :label="$label('الشارع والعنوان التفصيلي','Street and detailed address')" required maxlength="500" autocomplete="shipping address-line1" class="sm:col-span-2" :placeholder="$label('اسم الشارع ورقمه وتفاصيل الوصول','Street name, number and access details')" />
                        <x-checkout-field name="unit" :label="$label('الشقة أو الطابق (اختياري)','Apartment or floor (optional)')" maxlength="60" autocomplete="shipping address-line2" />
                        <x-checkout-field name="landmark" :label="$label('معلم قريب (اختياري)','Nearby landmark (optional)')" maxlength="200" />
                        <div class="sm:col-span-2">
                            <label for="delivery_notes" class="mb-2 block text-sm font-bold">{{ $label('تعليمات التوصيل (اختياري)','Delivery instructions (optional)') }}</label>
                            <textarea id="delivery_notes" name="delivery_notes" maxlength="500" rows="3" class="w-full rounded-xl border-slate-300 bg-slate-50 px-4 py-3 dark:border-slate-600 dark:bg-slate-950">{{ old('delivery_notes') }}</textarea>
                            @error('delivery_notes')<p class="mt-2 text-sm text-red-700 dark:text-red-300">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </fieldset>
                <div class="rounded-2xl bg-slate-900 p-5 text-white">
                    <p class="mb-4 text-sm leading-6">{{ $label('راجع عنوانك قبل الدفع. يتم إرسال المنتجات المحدد لها رسلو بعد تأكيد الدفع؛ طرق الشحن الأخرى يتولاها المتجر.','Review your address before paying. Raslo products are forwarded after payment confirmation; other shipping methods are managed by the store.') }}</p>
                    <button class="w-full rounded-xl bg-orange-600 px-5 py-4 font-bold text-white transition hover:bg-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-300">{{ $label('المتابعة إلى الدفع الآمن','Continue to secure payment') }} ↗</button>
                </div>
            </form>
            <aside class="space-y-5 lg:sticky lg:top-6">
                <section class="rounded-3xl bg-[#163d32] p-6 text-white">
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-200">{{ $label('عنوان واضح، توصيل أسهل','Clear address. Smoother delivery.') }}</span>
                    <h2 class="mt-3 text-2xl font-bold">{{ $label('كل التفاصيل تصنع الفرق','The details make a difference') }}</h2>
                    <p class="mt-4 text-sm leading-7 text-emerald-50">{{ $label('أضف المبنى والوحدة ومعلمًا قريبًا ليسهل الوصول إليك. نستخدم بيانات المستلم لتنفيذ الطلب ومشاركتها مع جهة التوصيل عند الحاجة.','Include your building, unit and a landmark. Recipient details are used to fulfill your order and shared with the delivery provider when needed.') }}</p>
                </section>
                <section class="rounded-3xl border border-slate-200 bg-white p-6 dark:border-slate-700 dark:bg-slate-900">
                    <h2 class="font-bold">{{ $label('قبل أن تدفع','Before you pay') }}</h2>
                    <ul class="mt-4 space-y-4 text-sm leading-6 text-slate-600 dark:text-slate-300">
                        <li>{{ $label('لا تُحصّل رسوم توصيل ضمن مبلغ الدفع الحالي. راجع ترتيبات ورسوم الشحن مع المتجر قبل الدفع.','No delivery charge is collected in this checkout. Confirm shipping arrangements and any fees with the store before paying.') }}</li>
                        <li>{{ $label('لا يتم إنشاء توصيل لطلب غير مدفوع. لا حاجة للعودة من صفحة الدفع لإثبات الدفع.','Unpaid orders are not sent for delivery. Payment confirmation does not depend on returning from checkout.') }}</li>
                        <li>{{ $label('تابع طلبات رسلو من «توصيل طلباتي» بجوار تعديل الملف الشخصي. تتحدث الحالة بعد وصول تحديث رسلو.','Follow Raslo orders in My deliveries beside Edit Profile. Status changes after updates arrive from Raslo.') }}</li>
                    </ul>
                </section>
            </aside>
        </div>
    </div>
</main>
</x-main-layout>
