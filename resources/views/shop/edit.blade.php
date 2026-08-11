<x-app-layout>

    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

            <div class="mb-8">

                <div class="mb-4 flex flex-wrap items-center gap-3">

                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-orange-100 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">

                        <span class="h-2 w-2 rounded-full bg-orange-500"></span>

                        UAE Marketplace

                    </span>

                    <span class="text-sm text-slate-400">
                        🇦🇪 Dubai · Abu Dhabi · Sharjah · UAE
                    </span>

                </div>

                <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                    Edit Your Shop
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400 sm:text-base">
                    Keep your shop information, contact details and marketplace preferences up to date.
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
                            Changes saved successfully
                        </p>

                        <p class="mt-1 text-sm text-green-700/80 dark:text-green-300/70">
                            {{ session('success') }}
                        </p>
                    </div>

                </div>
            @endif


            {{-- ========================================================= --}}
            {{-- VALIDATION SUMMARY --}}
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
                                Please check the information below.
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
                                    Shop Information
                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Tell customers about your business.
                                </p>

                            </div>

                        </div>

                    </div>



                    <div class="space-y-6 p-6 sm:p-8">


                        {{-- Shop Arabic Name --}}
                        <div dir="rtl">

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
                                value="{{ old('name_ar', $shop?->name_ar) }}" placeholder="مثال: متجر دبي"
                                dir="rtl" lang="ar" autocomplete="organization"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-right text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-500">

                            @error('name_ar')
                                <p class="mt-2 text-right text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Shop Name --}}
                        <div>

                            <label class="font-bold text-slate-700 dark:text-slate-300">
                                Shop Name
                            </label>

                            <input type="text" name="name" value="{{ old('name', $shop->name) }}"
                                placeholder="e.g. Dubai Mobile Store"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            @error('name')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Description --}}
                        <div>

                            <label class="font-bold text-slate-700 dark:text-slate-300">
                                Shop Description
                            </label>

                            <textarea name="description" rows="6"
                                placeholder="Tell customers what your shop sells, where you're located and what makes your business special..."
                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 leading-7 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">{{ old('description', $shop->description) }}</textarea>

                            @error('description')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- CONTACT --}}
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
                                    Contact Details
                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Give UAE customers convenient ways to contact you.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div class="grid gap-6 md:grid-cols-2">

                            {{-- Phone --}}
                            <div>

                                <label class="font-bold text-slate-700 dark:text-slate-300">
                                    Phone Number
                                </label>

                                <div class="relative mt-2">

                                    <span
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sm font-black text-orange-500">
                                        🇦🇪 +971
                                    </span>

                                    <input id="phone" type="tel" name="phone"
                                        value="{{ old('phone', auth()->user()->phone) }}" autocomplete="tel"
                                        placeholder="50 123 4567"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-20 pr-4 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                </div>

                                @error('phone')
                                    <p class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- WhatsApp --}}
                            <div>

                                <label class="font-bold text-slate-700 dark:text-slate-300">
                                    WhatsApp Number
                                </label>

                                <div class="relative mt-2">

                                    <span
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sm font-black text-green-500">
                                        WhatsApp
                                    </span>

                                    <input type="tel" name="whatsapp"
                                        value="{{ old('whatsapp', $shop->whatsapp ?? auth()->user()->phone) }}"
                                        placeholder="971501234567"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-24 pr-4 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                </div>

                                @error('whatsapp')
                                    <p class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>


                        {{-- Contact Preferences --}}
                        <div
                            class="mt-6 rounded-2xl border border-orange-100 bg-orange-50/70 p-5 dark:border-orange-500/10 dark:bg-orange-500/5">

                            <div class="mb-4">

                                <h3 class="font-black text-slate-900 dark:text-white">
                                    Contact Options
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    Choose which contact methods customers can see.
                                </p>

                            </div>


                            <div class="space-y-3">

                                <label
                                    class="flex cursor-pointer items-center justify-between rounded-xl bg-white p-4 transition hover:shadow-sm dark:bg-slate-900">

                                    <div class="flex items-center gap-3">

                                        <span
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-lg dark:bg-orange-500/10">
                                            📞
                                        </span>

                                        <div>

                                            <p class="font-bold text-slate-800 dark:text-slate-200">
                                                Show phone number
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                Allow customers to call you
                                            </p>

                                        </div>

                                    </div>

                                    <input type="checkbox" name="allow_phone" value="1"
                                        {{ old('allow_phone', $shop->allow_phone) ? 'checked' : '' }}
                                        class="h-5 w-5 rounded border-slate-300 text-orange-600 focus:ring-orange-500">

                                </label>


                                <label
                                    class="flex cursor-pointer items-center justify-between rounded-xl bg-white p-4 transition hover:shadow-sm dark:bg-slate-900">

                                    <div class="flex items-center gap-3">

                                        <span
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-100 text-lg dark:bg-green-500/10">
                                            💬
                                        </span>

                                        <div>

                                            <p class="font-bold text-slate-800 dark:text-slate-200">
                                                Show WhatsApp
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                Let customers message you on WhatsApp
                                            </p>

                                        </div>

                                    </div>

                                    <input type="checkbox" name="allow_whatsapp" value="1"
                                        {{ old('allow_whatsapp', $shop->allow_whatsapp) ? 'checked' : '' }}
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
                                    Currency Preferences
                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Choose the currency displayed for your shop and products.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div class="grid gap-6 md:grid-cols-2">

                            <div>

                                <label class="font-bold text-slate-700 dark:text-slate-300">
                                    Shop Currency
                                </label>

                                <select name="currency" id="currency"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                    <option value="AED"
                                        {{ old('currency', $shop->currency ?? 'AED') === 'AED' ? 'selected' : '' }}>
                                        🇦🇪 AED — United Arab Emirates Dirham
                                    </option>

                                    <option value="USD"
                                        {{ old('currency', $shop->currency ?? 'AED') === 'USD' ? 'selected' : '' }}>
                                        🇺🇸 USD — US Dollar
                                    </option>

                                    <option value="EUR"
                                        {{ old('currency', $shop->currency ?? 'AED') === 'EUR' ? 'selected' : '' }}>
                                        🇪🇺 EUR — Euro
                                    </option>

                                    <option value="GBP"
                                        {{ old('currency', $shop->currency ?? 'AED') === 'GBP' ? 'selected' : '' }}>
                                        🇬🇧 GBP — British Pound
                                    </option>

                                    <option value="SAR"
                                        {{ old('currency', $shop->currency ?? 'AED') === 'SAR' ? 'selected' : '' }}>
                                        🇸🇦 SAR — Saudi Riyal
                                    </option>

                                    <option value="KWD"
                                        {{ old('currency', $shop->currency ?? 'AED') === 'KWD' ? 'selected' : '' }}>
                                        🇰🇼 KWD — Kuwaiti Dinar
                                    </option>

                                    <option value="QAR"
                                        {{ old('currency', $shop->currency ?? 'AED') === 'QAR' ? 'selected' : '' }}>
                                        🇶🇦 QAR — Qatari Riyal
                                    </option>

                                    <option value="BHD"
                                        {{ old('currency', $shop->currency ?? 'AED') === 'BHD' ? 'selected' : '' }}>
                                        🇧🇭 BHD — Bahraini Dinar
                                    </option>

                                    <option value="OMR"
                                        {{ old('currency', $shop->currency ?? 'AED') === 'OMR' ? 'selected' : '' }}>
                                        🇴🇲 OMR — Omani Rial
                                    </option>

                                </select>

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
                                            UAE Marketplace
                                        </p>

                                        <p class="mt-1 text-sm leading-6 text-orange-800/70 dark:text-orange-300/70">
                                            AED is the default currency for UAE sellers. You can change it if you
                                            primarily sell to customers using another currency.
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
                                    Shop Logo
                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Use a clear image that represents your business.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div class="flex flex-col gap-6 sm:flex-row sm:items-center">

                            @if ($shop->logo)
                                <div
                                    class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-1 shadow-sm dark:border-slate-700 dark:bg-slate-950">

                                    <img src="{{ asset('storage/' . $shop->logo) }}" alt="{{ $shop->name }}"
                                        class="h-28 w-28 rounded-xl object-cover">

                                </div>
                            @else
                                <div
                                    class="flex h-28 w-28 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 text-4xl text-white shadow-lg shadow-orange-500/20">
                                    🏪
                                </div>
                            @endif


                            <div class="flex-1">

                                <label class="font-bold text-slate-700 dark:text-slate-300">
                                    Upload New Logo
                                </label>

                                <input type="file" name="logo" accept="image/jpeg,image/png,image/webp"
                                    class="mt-3 block w-full cursor-pointer rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm text-slate-600 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-300">

                                <p class="mt-2 text-xs text-slate-400">
                                    JPG, PNG or WebP. A square image is recommended.
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
                                    Shop Type
                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Choose how you operate your business.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 sm:p-8">

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            What type of shop is this?
                        </label>

                        <div class="mt-4 grid gap-4 sm:grid-cols-2">

                            {{-- Freelance --}}
                            <label class="group relative cursor-pointer">

                                <input type="radio" name="type" value="freelance" class="peer sr-only"
                                    {{ old('type', $shop?->type) === 'freelance' ? 'checked' : '' }}>

                                <div
                                    class="relative rounded-2xl border-2 border-slate-200 bg-slate-50 p-5 transition-all duration-300
                hover:-translate-y-0.5 hover:border-orange-300 hover:shadow-lg
                peer-checked:border-orange-500
                peer-checked:bg-gradient-to-br peer-checked:from-orange-50 peer-checked:to-amber-50
                peer-checked:shadow-xl peer-checked:shadow-orange-500/10
                dark:border-slate-700 dark:bg-slate-800
                dark:hover:border-orange-500/50
                dark:peer-checked:border-orange-500
                dark:peer-checked:from-orange-500/10 dark:peer-checked:to-amber-500/5">

                                    <div class="flex items-start justify-between gap-4">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white text-2xl shadow-sm
                            dark:bg-slate-900">
                                                💼
                                            </div>

                                            <div>

                                                <h3 class="font-black text-slate-900 dark:text-white">
                                                    Freelance
                                                </h3>

                                                <p class="mt-1 text-sm leading-5 text-slate-500 dark:text-slate-400">
                                                    For independent professionals and freelancers.
                                                </p>

                                            </div>

                                        </div>


                                        <div
                                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full border-2 border-slate-300
                        peer-checked:border-orange-500 peer-checked:bg-orange-500
                        dark:border-slate-600">

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


                            {{-- Local --}}
                            <label class="group relative cursor-pointer">

                                <input type="radio" name="type" value="local" class="peer sr-only"
                                    {{ old('type', $shop?->type) === 'local' ? 'checked' : '' }}>

                                <div
                                    class="relative rounded-2xl border-2 border-slate-200 bg-slate-50 p-5 transition-all duration-300
                hover:-translate-y-0.5 hover:border-orange-300 hover:shadow-lg
                peer-checked:border-orange-500
                peer-checked:bg-gradient-to-br peer-checked:from-orange-50 peer-checked:to-amber-50
                peer-checked:shadow-xl peer-checked:shadow-orange-500/10
                dark:border-slate-700 dark:bg-slate-800
                dark:hover:border-orange-500/50
                dark:peer-checked:border-orange-500
                dark:peer-checked:from-orange-500/10 dark:peer-checked:to-amber-500/5">

                                    <div class="flex items-start justify-between gap-4">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white text-2xl shadow-sm
                            dark:bg-slate-900">
                                                🇦🇪
                                            </div>

                                            <div>

                                                <h3 class="font-black text-slate-900 dark:text-white">
                                                    Local Shop
                                                </h3>

                                                <p class="mt-1 text-sm leading-5 text-slate-500 dark:text-slate-400">
                                                    For physical businesses serving customers locally.
                                                </p>

                                            </div>

                                        </div>


                                        <div
                                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full border-2 border-slate-300
                        peer-checked:border-orange-500 peer-checked:bg-orange-500
                        dark:border-slate-600">

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

                    <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>

                    <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <div
                                class="mb-2 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-xs font-bold uppercase tracking-wider backdrop-blur">

                                🇦🇪 UAE Marketplace

                            </div>

                            <h3 class="text-2xl font-black">
                                Ready to save your changes?
                            </h3>

                            <p class="mt-2 max-w-xl text-sm leading-6 text-white/80">
                                Your updated shop information will be reflected across the marketplace.
                            </p>

                        </div>


                        <button type="submit"
                            class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-white px-8 py-4 font-black text-orange-600 shadow-xl transition hover:-translate-y-0.5 hover:bg-orange-50">

                            Save Changes

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
