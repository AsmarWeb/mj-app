<x-app-layout>

    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">

        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

            {{-- ========================================================= --}}
            {{-- HEADER --}}
            {{-- ========================================================= --}}

            <div class="mb-8">

                <div class="mb-4 flex flex-wrap items-center gap-3">

                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-orange-100 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">

                        <span class="h-2 w-2 rounded-full bg-orange-500"></span>

                        <span lang="en">UAE Marketplace</span>
                        <span class="text-orange-400">•</span>
                        <span dir="rtl" lang="ar">سوق الإمارات</span>

                    </span>

                    <span class="text-sm text-slate-400" lang="en">
                        🇦🇪 Dubai · Abu Dhabi · Sharjah · UAE
                    </span>

                    <span class="text-sm text-slate-400" dir="rtl" lang="ar">
                        🇦🇪 دبي · أبوظبي · الشارقة · الإمارات
                    </span>

                </div>

                <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                    <span lang="en">Edit Your Shop</span>
                    <span class="mx-2 text-slate-300">|</span>
                    <span dir="rtl" lang="ar">تعديل متجرك</span>
                </h1>

                <p class="mt-2 max-w-3xl text-sm leading-7 text-slate-500 dark:text-slate-400">
                    <span lang="en">
                        Keep your shop information, contact details and marketplace preferences up to date.
                    </span>
                    <br>
                    <span dir="rtl" lang="ar">
                        حافظ على تحديث معلومات متجرك وبيانات الاتصال وتفضيلات السوق.
                    </span>
                </p>

            </div>


            {{-- ========================================================= --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ========================================================= --}}

            @if (session('success'))
                <div
                    class="mb-8 flex items-start gap-4 rounded-2xl border border-green-200 bg-gradient-to-r from-green-50 to-emerald-50 p-5 text-green-800 shadow-lg shadow-green-100/50 dark:border-green-500/20 dark:from-green-500/10 dark:to-emerald-500/5 dark:text-green-300">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-500 text-white shadow-lg shadow-green-500/20">
                        ✓
                    </div>

                    <div>

                        <p class="font-bold">
                            <span lang="en">Changes saved successfully</span>
                            <span class="mx-1">—</span>
                            <span dir="rtl" lang="ar">تم حفظ التغييرات بنجاح</span>
                        </p>

                        <p class="mt-1 text-sm text-green-700/80 dark:text-green-300/70">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>
            @endif


            {{-- ========================================================= --}}
            {{-- VALIDATION --}}
            {{-- ========================================================= --}}

            @if ($errors->any())

                <div
                    class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-5 text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-300">

                    <div class="flex items-start gap-3">

                        <span
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-500 font-bold text-white">
                            !
                        </span>

                        <div class="flex-1">

                            <p class="font-bold">
                                <span lang="en">Please check the information below.</span>
                                <span class="mx-1">—</span>
                                <span dir="rtl" lang="ar">يرجى التحقق من المعلومات أدناه.</span>
                            </p>

                            <ul class="mt-3 list-disc space-y-1 pl-5 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- FORM --}}
            {{-- ========================================================= --}}

            <form action="{{ route('shop.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">

                @csrf
                @method('PUT')


                {{-- ========================================================= --}}
                {{-- SHOP INFORMATION --}}
                {{-- ========================================================= --}}

                <div
                    class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                    <div
                        class="border-b border-slate-100 bg-gradient-to-r from-orange-50 to-amber-50 px-6 py-5 dark:border-slate-800 dark:from-orange-500/5 dark:to-amber-500/5">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-500 text-xl shadow-lg shadow-orange-500/20">
                                🏪
                            </div>

                            <div>

                                <h2 class="text-xl font-black text-slate-900 dark:text-white">
                                    <span lang="en">Shop Information</span>
                                    <span class="mx-1 text-slate-300">|</span>
                                    <span dir="rtl" lang="ar">معلومات المتجر</span>
                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    <span lang="en">Tell customers about your business.</span>
                                    <br>
                                    <span dir="rtl" lang="ar">أخبر العملاء عن نشاطك التجاري.</span>
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="space-y-6 p-6 sm:p-8">


                        {{-- ================================================= --}}
                        {{-- ARABIC SHOP NAME --}}
                        {{-- ================================================= --}}

                        <div dir="rtl" lang="ar">

                            <div class="flex items-center justify-between gap-3">

                                <label for="name_ar" class="font-bold text-slate-700 dark:text-slate-300">

                                    اسم المتجر

                                </label>

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">

                                    🇦🇪 العربية

                                </span>

                            </div>

                            <input type="text" id="name_ar" name="name_ar"
                                value="{{ old('name_ar', $shop?->name_ar) }}" placeholder="مثال: متجر دبي للهواتف"
                                dir="rtl" lang="ar" autocomplete="organization"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-right text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-500">

                            @error('name_ar')
                                <p class="mt-2 text-right text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- ================================================= --}}
                        {{-- ENGLISH SHOP NAME --}}
                        {{-- ================================================= --}}

                        <div dir="ltr" lang="en">

                            <label for="name" class="font-bold text-slate-700 dark:text-slate-300">

                                Shop Name
                                <span class="mx-1 text-slate-300">|</span>
                                <span dir="rtl" lang="ar">اسم المتجر</span>

                            </label>

                            <input type="text" id="name" name="name" value="{{ old('name', $shop?->name) }}"
                                placeholder="e.g. Dubai Mobile Store" dir="ltr" lang="en"
                                autocomplete="organization"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            @error('name')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- ================================================= --}}
                        {{-- DESCRIPTION --}}
                        {{-- ================================================= --}}

                        <div>

                            <label for="description" class="font-bold text-slate-700 dark:text-slate-300">

                                <span lang="en">Shop Description</span>
                                <span class="mx-1 text-slate-300">|</span>
                                <span dir="rtl" lang="ar">وصف المتجر</span>

                            </label>

                            <textarea id="description" name="description" rows="6"
                                placeholder="Tell customers what your shop sells, where you're located and what makes your business special... | أخبر العملاء بما يبيعه متجرك وموقعك وما يميز نشاطك التجاري..."
                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 leading-7 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">{{ old('description', $shop?->description) }}</textarea>

                            @error('description')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- CONTACT DETAILS --}}
                {{-- ========================================================= --}}

                <div
                    class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                    <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 text-xl text-white shadow-lg shadow-green-500/20">
                                📱
                            </div>

                            <div>

                                <h2 class="text-xl font-black text-slate-900 dark:text-white">
                                    <span lang="en">Contact Details</span>
                                    <span class="mx-1 text-slate-300">|</span>
                                    <span dir="rtl" lang="ar">بيانات الاتصال</span>
                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    <span lang="en">Give UAE customers convenient ways to contact you.</span>
                                    <br>
                                    <span dir="rtl" lang="ar">وفّر للعملاء في الإمارات طرقًا سهلة للتواصل
                                        معك.</span>
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div class="grid gap-6 md:grid-cols-2">


                            {{-- PHONE --}}
                            <div dir="ltr" lang="en">

                                <label for="phone" class="font-bold text-slate-700 dark:text-slate-300">

                                    Phone Number
                                    <span class="mx-1 text-slate-300">|</span>
                                    <span dir="rtl" lang="ar">رقم الهاتف</span>

                                </label>

                                <div class="relative mt-2">

                                    <span
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sm font-black text-orange-500">
                                        🇦🇪 +971
                                    </span>

                                    <input id="phone" type="tel" name="phone"
                                        value="{{ old('phone', auth()->user()->phone) }}" autocomplete="tel"
                                        placeholder="50 123 4567" dir="ltr" lang="en"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-20 pr-4 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                </div>

                                @error('phone')
                                    <p class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- WHATSAPP --}}
                            <div dir="ltr" lang="en">

                                <label for="whatsapp" class="font-bold text-slate-700 dark:text-slate-300">

                                    WhatsApp Number
                                    <span class="mx-1 text-slate-300">|</span>
                                    <span dir="rtl" lang="ar">رقم الواتساب</span>

                                </label>

                                <div class="relative mt-2">

                                    <span
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sm font-black text-green-500">
                                        WhatsApp
                                    </span>

                                    <input id="whatsapp" type="tel" name="whatsapp"
                                        value="{{ old('whatsapp', $shop?->whatsapp ?? auth()->user()->phone) }}"
                                        autocomplete="tel" placeholder="971501234567" dir="ltr" lang="en"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-24 pr-4 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                </div>

                                @error('whatsapp')
                                    <p class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>


                        {{-- CONTACT OPTIONS --}}
                        <div
                            class="mt-6 rounded-2xl border border-orange-100 bg-orange-50/70 p-5 dark:border-orange-500/10 dark:bg-orange-500/5">

                            <div class="mb-4">

                                <h3 class="font-black text-slate-900 dark:text-white">
                                    <span lang="en">Contact Options</span>
                                    <span class="mx-1 text-slate-300">|</span>
                                    <span dir="rtl" lang="ar">خيارات الاتصال</span>
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    <span lang="en">Choose which contact methods customers can see.</span>
                                    <br>
                                    <span dir="rtl" lang="ar">اختر طرق الاتصال التي يمكن للعملاء
                                        رؤيتها.</span>
                                </p>

                            </div>


                            <div class="space-y-3">


                                {{-- PHONE OPTION --}}
                                <label
                                    class="flex cursor-pointer items-center justify-between rounded-xl bg-white p-4 transition hover:shadow-sm dark:bg-slate-900">

                                    <div class="flex items-center gap-3">

                                        <span
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-lg dark:bg-orange-500/10">
                                            📞
                                        </span>

                                        <div>

                                            <p class="font-bold text-slate-800 dark:text-slate-200">
                                                <span lang="en">Show phone number</span>
                                                <span class="mx-1 text-slate-300">|</span>
                                                <span dir="rtl" lang="ar">إظهار رقم الهاتف</span>
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                <span lang="en">Allow customers to call you</span>
                                                <span class="mx-1">|</span>
                                                <span dir="rtl" lang="ar">السماح للعملاء بالاتصال بك</span>
                                            </p>

                                        </div>

                                    </div>

                                    <input type="checkbox" name="allow_phone" value="1"
                                        {{ old('allow_phone', $shop?->allow_phone) ? 'checked' : '' }}
                                        class="h-5 w-5 rounded border-slate-300 text-orange-600 focus:ring-orange-500">

                                </label>


                                {{-- WHATSAPP OPTION --}}
                                <label
                                    class="flex cursor-pointer items-center justify-between rounded-xl bg-white p-4 transition hover:shadow-sm dark:bg-slate-900">

                                    <div class="flex items-center gap-3">

                                        <span
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-100 text-lg dark:bg-green-500/10">
                                            💬
                                        </span>

                                        <div>

                                            <p class="font-bold text-slate-800 dark:text-slate-200">
                                                <span lang="en">Show WhatsApp</span>
                                                <span class="mx-1 text-slate-300">|</span>
                                                <span dir="rtl" lang="ar">إظهار الواتساب</span>
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                <span lang="en">Let customers message you on WhatsApp</span>
                                                <span class="mx-1">|</span>
                                                <span dir="rtl" lang="ar">السماح للعملاء بمراسلتك عبر
                                                    الواتساب</span>
                                            </p>

                                        </div>

                                    </div>

                                    <input type="checkbox" name="allow_whatsapp" value="1"
                                        {{ old('allow_whatsapp', $shop?->allow_whatsapp) ? 'checked' : '' }}
                                        class="h-5 w-5 rounded border-slate-300 text-orange-600 focus:ring-orange-500">

                                </label>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- CURRENCY --}}
                {{-- ========================================================= --}}

                <div
                    class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                    <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 text-xl text-white shadow-lg shadow-orange-500/20">
                                💰
                            </div>

                            <div>

                                <h2 class="text-xl font-black text-slate-900 dark:text-white">
                                    <span lang="en">Currency Preferences</span>
                                    <span class="mx-1 text-slate-300">|</span>
                                    <span dir="rtl" lang="ar">تفضيلات العملة</span>
                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    <span lang="en">Choose the currency displayed for your shop and
                                        products.</span>
                                    <br>
                                    <span dir="rtl" lang="ar">اختر العملة التي سيتم عرضها لمتجرك
                                        ومنتجاتك.</span>
                                </p>

                            </div>

                        </div>

                    </div>

                    @php
                        $hasListings = $shop?->listings()->exists();
                        $currentCurrency = old('currency', $shop?->currency ?? 'AED');
                    @endphp

                    <div class="p-6 sm:p-8">

                        <div class="grid gap-6 md:grid-cols-2">

                            <div>

                                <label for="currency" class="font-bold text-slate-700 dark:text-slate-300">

                                    <span lang="en">Shop Currency</span>
                                    <span class="mx-1 text-slate-300">|</span>
                                    <span dir="rtl" lang="ar">عملة المتجر</span>

                                </label>

                                <select name="currency" id="currency" {{ $hasListings ? 'disabled' : '' }}
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                    <option value="AED" {{ $currentCurrency === 'AED' ? 'selected' : '' }}>
                                        🇦🇪 AED — United Arab Emirates Dirham | الدرهم الإماراتي
                                    </option>

                                    <option value="USD" {{ $currentCurrency === 'USD' ? 'selected' : '' }}>
                                        🇺🇸 USD — US Dollar | الدولار الأمريكي
                                    </option>

                                    <option value="EUR" {{ $currentCurrency === 'EUR' ? 'selected' : '' }}>
                                        🇪🇺 EUR — Euro | اليورو
                                    </option>

                                    <option value="GBP" {{ $currentCurrency === 'GBP' ? 'selected' : '' }}>
                                        🇬🇧 GBP — British Pound | الجنيه الإسترليني
                                    </option>

                                    <option value="SAR" {{ $currentCurrency === 'SAR' ? 'selected' : '' }}>
                                        🇸🇦 SAR — Saudi Riyal | الريال السعودي
                                    </option>

                                    <option value="KWD" {{ $currentCurrency === 'KWD' ? 'selected' : '' }}>
                                        🇰🇼 KWD — Kuwaiti Dinar | الدينار الكويتي
                                    </option>

                                    <option value="QAR" {{ $currentCurrency === 'QAR' ? 'selected' : '' }}>
                                        🇶🇦 QAR — Qatari Riyal | الريال القطري
                                    </option>

                                    <option value="BHD" {{ $currentCurrency === 'BHD' ? 'selected' : '' }}>
                                        🇧🇭 BHD — Bahraini Dinar | الدينار البحريني
                                    </option>

                                    <option value="OMR" {{ $currentCurrency === 'OMR' ? 'selected' : '' }}>
                                        🇴🇲 OMR — Omani Rial | الريال العماني
                                    </option>

                                </select>

                                @if ($hasListings)
                                    <input type="hidden" name="currency" value="{{ $currentCurrency }}">

                                    <p class="mt-2 text-xs text-amber-600 dark:text-amber-400">
                                        Currency cannot be changed after products have been added.
                                        |
                                        <span dir="rtl">
                                            لا يمكن تغيير العملة بعد إضافة المنتجات.
                                        </span>
                                    </p>
                                @endif

                                @error('currency')
                                    <p class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            <div
                                class="flex items-center rounded-2xl border border-orange-100 bg-gradient-to-br from-orange-50 to-amber-50 p-5 dark:border-orange-500/10 dark:from-orange-500/5 dark:to-amber-500/5">

                                <div class="flex items-start gap-3">

                                    <span class="text-2xl">
                                        🇦🇪
                                    </span>

                                    <div>

                                        <p class="font-bold text-orange-900 dark:text-orange-300">
                                            <span lang="en">UAE Marketplace</span>
                                            <span class="mx-1">|</span>
                                            <span dir="rtl" lang="ar">سوق الإمارات</span>
                                        </p>

                                        <p class="mt-1 text-sm leading-6 text-orange-800/70 dark:text-orange-300/70">
                                            <span lang="en">
                                                AED is the default currency for UAE sellers. You can change it if you
                                                primarily sell to customers using another currency.
                                            </span>
                                            <br>
                                            <span dir="rtl" lang="ar">
                                                الدرهم الإماراتي هو العملة الافتراضية للبائعين في الإمارات. يمكنك
                                                تغييرها
                                                إذا كنت تبيع بشكل أساسي للعملاء الذين يستخدمون عملة أخرى.
                                            </span>
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- LOGO --}}
                {{-- ========================================================= --}}

                <div
                    class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                    <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-900 text-xl text-white shadow-lg dark:bg-orange-500">
                                🖼️
                            </div>

                            <div>

                                <h2 class="text-xl font-black text-slate-900 dark:text-white">
                                    <span lang="en">Shop Logo</span>
                                    <span class="mx-1 text-slate-300">|</span>
                                    <span dir="rtl" lang="ar">شعار المتجر</span>
                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    <span lang="en">Use a clear image that represents your business.</span>
                                    <br>
                                    <span dir="rtl" lang="ar">استخدم صورة واضحة تمثل نشاطك التجاري.</span>
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div class="flex flex-col gap-6 sm:flex-row sm:items-center">

                            @if ($shop?->logo)
                                <div
                                    class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-1 shadow-sm dark:border-slate-700 dark:bg-slate-950">

                                    <img src="{{ asset('storage/' . $shop->logo) }}"
                                        alt="{{ $shop?->name }} | {{ $shop?->name_ar }}"
                                        class="h-28 w-28 rounded-xl object-cover">

                                </div>
                            @else
                                <div
                                    class="flex h-28 w-28 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 text-4xl text-white shadow-lg shadow-orange-500/20">
                                    🏪
                                </div>
                            @endif


                            <div class="flex-1">

                                <label for="logo" class="font-bold text-slate-700 dark:text-slate-300">

                                    <span lang="en">Upload New Logo</span>
                                    <span class="mx-1 text-slate-300">|</span>
                                    <span dir="rtl" lang="ar">رفع شعار جديد</span>

                                </label>

                                <input id="logo" type="file" name="logo"
                                    accept="image/jpeg,image/png,image/webp"
                                    class="mt-3 block w-full cursor-pointer rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm text-slate-600 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-300">

                                <p class="mt-2 text-xs text-slate-400">
                                    <span lang="en">JPG, PNG or WebP. A square image is recommended.</span>
                                    <span class="mx-1">|</span>
                                    <span dir="rtl" lang="ar">JPG أو PNG أو WebP. يفضل استخدام صورة
                                        مربعة.</span>
                                </p>

                                @error('logo')
                                    <p class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- SHOP TYPE --}}
                {{-- ========================================================= --}}

                <div
                    class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                    <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 text-xl text-white shadow-lg shadow-orange-500/20">
                                🏷️
                            </div>

                            <div>

                                <h2 class="text-xl font-black text-slate-900 dark:text-white">
                                    <span lang="en">Shop Type</span>
                                    <span class="mx-1 text-slate-300">|</span>
                                    <span dir="rtl" lang="ar">نوع المتجر</span>
                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    <span lang="en">Choose how you operate your business.</span>
                                    <br>
                                    <span dir="rtl" lang="ar">اختر طبيعة وطريقة عمل نشاطك التجاري.</span>
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 sm:p-8">

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            <span lang="en">What type of shop is this?</span>
                            <span class="mx-1 text-slate-300">|</span>
                            <span dir="rtl" lang="ar">ما نوع هذا المتجر؟</span>
                        </label>


                        <div class="mt-4 grid gap-4 sm:grid-cols-2">


                            {{-- FREELANCE --}}
                            <label class="group relative cursor-pointer">

                                <input type="radio" name="type" value="freelance" class="peer sr-only"
                                    {{ old('type', $shop?->type) === 'freelance' ? 'checked' : '' }}>

                                <div
                                    class="relative rounded-2xl border-2 border-slate-200 bg-slate-50 p-5 transition-all duration-300
                                    hover:-translate-y-0.5 hover:border-orange-300 hover:shadow-lg
                                    peer-checked:border-orange-500
                                    peer-checked:bg-gradient-to-br
                                    peer-checked:from-orange-50
                                    peer-checked:to-amber-50
                                    peer-checked:shadow-xl
                                    peer-checked:shadow-orange-500/10
                                    dark:border-slate-700
                                    dark:bg-slate-800
                                    dark:hover:border-orange-500/50
                                    dark:peer-checked:border-orange-500
                                    dark:peer-checked:from-orange-500/10
                                    dark:peer-checked:to-amber-500/5">

                                    <div class="flex items-start justify-between gap-4">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white text-2xl shadow-sm dark:bg-slate-900">
                                                💼
                                            </div>

                                            <div>

                                                <h3 class="font-black text-slate-900 dark:text-white">
                                                    <span lang="en">Freelance</span>
                                                    <span class="mx-1 text-slate-300">|</span>
                                                    <span dir="rtl" lang="ar">عمل حر</span>
                                                </h3>

                                                <p class="mt-1 text-sm leading-5 text-slate-500 dark:text-slate-400">
                                                    <span lang="en">
                                                        For independent professionals and freelancers.
                                                    </span>
                                                    <br>
                                                    <span dir="rtl" lang="ar">
                                                        للمحترفين المستقلين وأصحاب الأعمال الحرة.
                                                    </span>
                                                </p>

                                            </div>

                                        </div>


                                        <div
                                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full border-2 border-slate-300 peer-checked:border-orange-500 peer-checked:bg-orange-500 dark:border-slate-600">

                                            <svg class="hidden h-3.5 w-3.5 text-white peer-checked:block"
                                                fill="none" stroke="currentColor" stroke-width="3"
                                                viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m5 12 4 4L19 6" />

                                            </svg>

                                        </div>

                                    </div>

                                </div>

                            </label>


                            {{-- LOCAL --}}
                            <label class="group relative cursor-pointer">

                                <input type="radio" name="type" value="local" class="peer sr-only"
                                    {{ old('type', $shop?->type) === 'local' ? 'checked' : '' }}>

                                <div
                                    class="relative rounded-2xl border-2 border-slate-200 bg-slate-50 p-5 transition-all duration-300
                                    hover:-translate-y-0.5 hover:border-orange-300 hover:shadow-lg
                                    peer-checked:border-orange-500
                                    peer-checked:bg-gradient-to-br
                                    peer-checked:from-orange-50
                                    peer-checked:to-amber-50
                                    peer-checked:shadow-xl
                                    peer-checked:shadow-orange-500/10
                                    dark:border-slate-700
                                    dark:bg-slate-800
                                    dark:hover:border-orange-500/50
                                    dark:peer-checked:border-orange-500
                                    dark:peer-checked:from-orange-500/10
                                    dark:peer-checked:to-amber-500/5">

                                    <div class="flex items-start justify-between gap-4">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white text-2xl shadow-sm dark:bg-slate-900">
                                                🇦🇪
                                            </div>

                                            <div>

                                                <h3 class="font-black text-slate-900 dark:text-white">
                                                    <span lang="en">Local Shop</span>
                                                    <span class="mx-1 text-slate-300">|</span>
                                                    <span dir="rtl" lang="ar">متجر محلي</span>
                                                </h3>

                                                <p class="mt-1 text-sm leading-5 text-slate-500 dark:text-slate-400">
                                                    <span lang="en">
                                                        For physical businesses serving customers locally.
                                                    </span>
                                                    <br>
                                                    <span dir="rtl" lang="ar">
                                                        للأنشطة التجارية الفعلية التي تخدم العملاء محليًا.
                                                    </span>
                                                </p>

                                            </div>

                                        </div>


                                        <div
                                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full border-2 border-slate-300 peer-checked:border-orange-500 peer-checked:bg-orange-500 dark:border-slate-600">

                                            <svg class="hidden h-3.5 w-3.5 text-white peer-checked:block"
                                                fill="none" stroke="currentColor" stroke-width="3"
                                                viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m5 12 4 4L19 6" />

                                            </svg>

                                        </div>

                                    </div>

                                </div>

                            </label>

                        </div>


                        @error('type')
                            <p class="mt-3 text-sm font-medium text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- SAVE --}}
                {{-- ========================================================= --}}

                <div
                    class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-orange-500 via-orange-600 to-amber-500 p-6 text-white shadow-2xl shadow-orange-500/20 sm:p-8">

                    <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-3xl">
                    </div>

                    <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <div
                                class="mb-2 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-xs font-bold uppercase tracking-wider backdrop-blur">

                                🇦🇪
                                <span lang="en">UAE Marketplace</span>
                                <span>•</span>
                                <span dir="rtl" lang="ar">سوق الإمارات</span>

                            </div>

                            <h3 class="text-2xl font-black">

                                <span lang="en">Ready to save your changes?</span>

                                <span class="mx-1">|</span>

                                <span dir="rtl" lang="ar">
                                    هل أنت مستعد لحفظ التغييرات؟
                                </span>

                            </h3>

                            <p class="mt-2 max-w-xl text-sm leading-7 text-white/80">

                                <span lang="en">
                                    Your updated shop information will be reflected across the marketplace.
                                </span>

                                <br>

                                <span dir="rtl" lang="ar">
                                    ستظهر معلومات متجرك المحدثة في جميع أنحاء السوق.
                                </span>

                            </p>

                        </div>


                        <button type="submit"
                            class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-white px-8 py-4 font-black text-orange-600 shadow-xl transition hover:-translate-y-0.5 hover:bg-orange-50">

                            <span lang="en">Save Changes</span>

                            <span class="text-orange-300">|</span>

                            <span dir="rtl" lang="ar">حفظ التغييرات</span>

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-5-5 5 5-5 5" />

                            </svg>

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
