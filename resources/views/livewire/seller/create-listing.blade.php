<div class="mx-auto max-w-7xl px-4 py-8">

    {{-- ========================================================= --}}
    {{-- FLASH MESSAGES --}}
    {{-- ========================================================= --}}

    @if (session()->has('success'))
        <div
            class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-700 dark:border-green-500/20 dark:bg-green-500/10 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div
            class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400">
            {{ session('error') }}
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- LISTING LIMIT --}}
    {{-- ========================================================= --}}

    @if (!$canCreate)

        <div
            class="relative mb-8 overflow-hidden rounded-[2rem] border border-amber-200 bg-gradient-to-br from-amber-50 via-white to-orange-50 p-6 shadow-xl shadow-amber-100/50 dark:border-amber-500/20 dark:from-amber-500/10 dark:via-slate-900 dark:to-orange-500/5 dark:shadow-black/20">

            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-amber-400/10 blur-3xl"></div>

            <div class="relative">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

                    <div>

                        <div
                            class="mb-3 inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-amber-700 dark:bg-amber-500/10 dark:text-amber-400">

                            <span class="h-2 w-2 rounded-full bg-amber-500"></span>

                            {{ __('Listing Limit') }}

                        </div>

                        <h2 class="text-2xl font-black text-amber-900 dark:text-white sm:text-3xl">
                            {{ __('You have reached your listing limit') }}
                        </h2>

                        @if ($plan)
                            <p class="mt-3 max-w-2xl leading-7 text-amber-800/80 dark:text-slate-300">
                                {{ __('Your') }}
                                <strong>{{ $plan->name }}</strong>
                                {{ __('plan allows') }}
                                <strong>{{ $plan->listing_limit }}</strong>
                                {{ \Illuminate\Support\Str::plural('published product', $plan->listing_limit) }}.
                                {{ __('You have already used') }}
                                <strong>{{ $usedListings }}</strong>.
                            </p>
                        @endif

                    </div>

                    <div class="text-4xl">
                        🇦🇪
                    </div>

                </div>

                <a href="{{ route('plans.index') }}"
                    class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-500/20 transition hover:-translate-y-0.5 hover:from-orange-600 hover:to-amber-600">

                    {{ __('Upgrade Plan') }}

                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-5-5 5 5-5 5" />
                    </svg>

                </a>

            </div>
        </div>
    @else
        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="mb-8">

            <div class="mb-4 flex flex-wrap items-center gap-3">

                <span
                    class="inline-flex items-center gap-2 rounded-full bg-orange-100 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">

                    <span class="h-2 w-2 rounded-full bg-orange-500"></span>

                    {{ __('UAE Marketplace') }}

                </span>

                <span class="text-sm text-slate-400">
                    🇦🇪 Dubai · Abu Dhabi · Sharjah · UAE
                </span>

            </div>

            <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                {{ __('Create a New Product') }}
            </h1>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400 sm:text-base">
                {{ __('Add your product details, pricing, delivery options and media to reach customers across the UAE.') }}
            </p>

        </div>


        {{-- ========================================================= --}}
        {{-- FORM --}}
        {{-- ========================================================= --}}

        <form wire:submit="save" class="space-y-8">

            {{-- ===================================================== --}}
            {{-- BASIC INFORMATION --}}
            {{-- ===================================================== --}}

            <div
                class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                <div
                    class="border-b border-slate-100 bg-gradient-to-r from-orange-50 to-amber-50 px-6 py-5 dark:border-slate-800 dark:from-orange-500/5 dark:to-amber-500/5">

                    <div class="flex items-center gap-4">

                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-500 text-xl shadow-lg shadow-orange-500/20">
                            ✨
                        </div>

                        <div>
                            <h2 class="text-xl font-black text-slate-900 dark:text-white">
                                {{ __('Basic Information') }}
                            </h2>

                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Tell customers what you are selling.') }}
                            </p>
                        </div>

                    </div>
                </div>

                <div class="p-6 sm:p-8">

                    <div class="grid gap-6 md:grid-cols-2">

                        {{-- ENGLISH TITLE --}}
                        <div>

                            <label class="font-bold text-slate-700 dark:text-slate-300">
                                {{ __('Product Title') }}
                                <span class="text-xs font-normal text-slate-400">
                                    / English
                                </span>
                            </label>

                            <input type="text" wire:model.live="title" placeholder="e.g. iPhone 16 Pro Max"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            @error('title')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror

                        </div>


                        {{-- ARABIC TITLE --}}
                        <div dir="rtl">

                            <label class="font-bold text-slate-700 dark:text-slate-300">
                                {{ __('Product Title') }}
                                <span class="text-xs font-normal text-slate-400">
                                    / العربية
                                </span>
                            </label>

                            <input type="text" wire:model.live="title_ar" placeholder="مثال: آيفون 16 برو ماكس"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-right text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            @error('title_ar')
                                <p class="mt-2 text-left text-sm text-red-500">{{ $message }}</p>
                            @enderror

                        </div>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="mt-6">

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            {{ __('Description') }}
                        </label>

                        <textarea rows="6" wire:model="description"
                            placeholder="{{ __('Describe your product, condition, features and important details...') }}"
                            class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 leading-7 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"></textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- KEYWORDS --}}
                    <div class="mt-6">

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            {{ __('Keywords') }}
                        </label>

                        <div class="mt-2 flex flex-col gap-2 sm:flex-row">

                            <input type="text" wire:model="keyword" wire:keydown.enter.prevent="addKeyword"
                                placeholder="{{ __('e.g. Dubai, Apple, New, Smartphone') }}"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            <button type="button" wire:click="addKeyword"
                                class="rounded-xl bg-orange-500 px-6 py-3 font-bold text-white shadow-lg shadow-orange-500/20 transition hover:bg-orange-600">
                                {{ __('Add') }}
                            </button>

                        </div>

                        @if (count($keywords))
                            <div class="mt-4 flex flex-wrap gap-2">

                                @foreach ($keywords as $index => $tag)
                                    <span wire:key="keyword-{{ $index }}"
                                        class="inline-flex items-center gap-2 rounded-full border border-orange-100 bg-orange-50 px-4 py-2 text-sm font-semibold text-orange-700 dark:border-orange-500/20 dark:bg-orange-500/10 dark:text-orange-400">

                                        #{{ $tag }}

                                        <button type="button" wire:click="removeKeyword({{ $index }})"
                                            class="font-bold text-orange-400 transition hover:text-red-500">
                                            ×
                                        </button>

                                    </span>
                                @endforeach

                            </div>
                        @endif

                    </div>

                </div>
            </div>


            {{-- ===================================================== --}}
            {{-- PRICING --}}
            {{-- ===================================================== --}}

            <div
                class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800">

                    <h2 class="text-xl font-black text-slate-900 dark:text-white">
                        {{ __('Pricing & Inventory') }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('Set your price and available quantity.') }}
                    </p>

                </div>

                <div class="grid gap-6 p-6 sm:p-8 md:grid-cols-3">

                    {{-- PRICE --}}
                    <div>

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            {{ __('Price') }}
                        </label>

                        <div class="relative mt-2">

                            {{-- Currency --}}
                            <span
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sm font-black text-orange-500">
                                {{ $currency }}
                            </span>

                            <input type="number" step="0.01" min="1" wire:model="price" placeholder="0.00"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-14 pr-4 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                        </div>

                        {{-- Currency information --}}
                        <p class="mt-2 text-xs text-slate-400">
                            <span lang="en">
                                Product price is in your shop currency:
                                <strong class="text-orange-500">
                                    {{ $currency }}
                                </strong>
                            </span>

                            <span class="mx-1">|</span>

                            <span dir="rtl" lang="ar">
                                سعر المنتج بعملة متجرك:
                                <strong class="text-orange-500">
                                    {{ $currency }}
                                </strong>
                            </span>
                        </p>

                        @error('price')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- QUANTITY --}}
                    <div>

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            {{ __('Quantity') }}
                        </label>

                        <input type="number" min="1" wire:model="quantity"
                            placeholder="{{ __('Available quantity') }}"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                        @error('quantity')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- PRICE TYPE --}}
                    <div>

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            {{ __('Price Type') }}
                        </label>

                        <select wire:model="price_condition"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            <option value="fixed">
                                {{ __('Fixed Price') }}
                            </option>

                            <option value="negotiable">
                                {{ __('Negotiable') }}
                            </option>

                        </select>

                    </div>

                </div>
            </div>


            {{-- ===================================================== --}}
            {{-- CATEGORY --}}
            {{-- ===================================================== --}}

            <div
                class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800 sm:px-8">

                    <h2 class="text-2xl font-black text-slate-900 dark:text-white">
                        {{ __('Choose Category') }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('Help customers find your product quickly.') }}
                    </p>

                </div>

                <div class="space-y-8 p-6 sm:p-8">

                    {{-- ================================================= --}}
                    {{-- STEP 1 - SECTION --}}
                    {{-- ================================================= --}}

                    <div>

                        <div class="mb-4 flex items-center gap-3">

                            <span
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-500 text-sm font-black text-white">
                                1
                            </span>

                            <h3 class="font-bold text-slate-700 dark:text-slate-300">
                                {{ __('Select Section') }}
                            </h3>

                        </div>

                        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

                            @foreach ($sections as $section)
                                @php
                                    $sectionName =
                                        app()->getLocale() === 'ar'
                                            ? $section->name_ar ?? $section->name
                                            : $section->name ?? $section->name_ar;
                                @endphp

                                <button type="button" wire:click="$set('section_id', {{ $section->id }})"
                                    wire:key="section-{{ $section->id }}"
                                    class="rounded-2xl border p-5 text-left transition-all duration-300
                                    {{ (int) $section_id === (int) $section->id
                                        ? 'scale-[1.02] border-orange-500 bg-gradient-to-br from-orange-500 to-amber-500 text-white shadow-xl shadow-orange-500/20'
                                        : 'border-slate-200 bg-slate-50 hover:-translate-y-1 hover:border-orange-400 hover:shadow-lg dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200' }}">

                                    <div class="mb-3 text-3xl">
                                        📂
                                    </div>

                                    <div class="font-bold">
                                        {{ $sectionName }}
                                    </div>

                                </button>
                            @endforeach

                        </div>

                        @error('section_id')
                            <p class="mt-3 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- ================================================= --}}
                    {{-- STEP 2 - CATEGORY --}}
                    {{-- ================================================= --}}

                    @if ($section_id)

                        <div>

                            <div class="mb-4 flex items-center gap-3">

                                <span
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-500 text-sm font-black text-white">
                                    2
                                </span>

                                <h3 class="font-bold text-slate-700 dark:text-slate-300">
                                    {{ __('Select Category') }}
                                </h3>

                            </div>

                            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

                                @forelse ($categories->where('section_id', $section_id) as $category)
                                    @php
                                        $categoryName =
                                            app()->getLocale() === 'ar'
                                                ? $category->category_name_ar ?? $category->category_name
                                                : $category->category_name ?? $category->category_name_ar;
                                    @endphp

                                    <button type="button" wire:click="$set('category_id', {{ $category->id }})"
                                        wire:key="category-{{ $category->id }}"
                                        class="rounded-2xl border p-5 text-left transition-all
                                        {{ (int) $category_id === (int) $category->id
                                            ? 'scale-[1.02] border-orange-500 bg-gradient-to-br from-orange-500 to-amber-500 text-white shadow-xl shadow-orange-500/20'
                                            : 'border-slate-200 bg-slate-50 hover:-translate-y-1 hover:border-orange-400 hover:shadow-lg dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200' }}">

                                        <div class="mb-3 text-3xl">
                                            📦
                                        </div>

                                        <div class="font-bold">
                                            {{ $categoryName }}
                                        </div>

                                    </button>

                                @empty

                                    <div
                                        class="col-span-full rounded-xl border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500 dark:border-slate-700">
                                        {{ __('No categories available for this section.') }}
                                    </div>
                                @endforelse

                            </div>

                            @error('category_id')
                                <p class="mt-3 text-sm text-red-500">{{ $message }}</p>
                            @enderror

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- STEP 3 - SUBCATEGORY --}}
                    {{-- ================================================= --}}

                    @if ($category_id)

                        <div>

                            <div class="mb-4 flex items-center gap-3">

                                <span
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-500 text-sm font-black text-white">
                                    3
                                </span>

                                <h3 class="font-bold text-slate-700 dark:text-slate-300">
                                    {{ __('Select Subcategory') }}
                                </h3>

                            </div>

                            <div class="flex flex-wrap gap-3">

                                @forelse ($subcategories->where('category_id', $category_id) as $subcategory)
                                    @php
                                        $subcategoryName =
                                            app()->getLocale() === 'ar'
                                                ? $subcategory->subcategory_name_ar ?? $subcategory->subcategory_name
                                                : $subcategory->subcategory_name ?? $subcategory->subcategory_name_ar;
                                    @endphp

                                    <button type="button"
                                        wire:click="$set('subcategory_id', {{ $subcategory->id }})"
                                        wire:key="subcategory-{{ $subcategory->id }}"
                                        class="rounded-full border px-5 py-3 font-semibold transition-all
                                        {{ (int) $subcategory_id === (int) $subcategory->id
                                            ? 'border-orange-500 bg-orange-500 text-white shadow-lg shadow-orange-500/20'
                                            : 'border-slate-200 bg-slate-50 hover:border-orange-400 hover:bg-orange-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200' }}">

                                        {{ $subcategoryName }}

                                    </button>

                                @empty

                                    <div
                                        class="w-full rounded-xl border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500 dark:border-slate-700">
                                        {{ __('No subcategories available for this category.') }}
                                    </div>
                                @endforelse

                            </div>

                            @error('subcategory_id')
                                <p class="mt-3 text-sm text-red-500">{{ $message }}</p>
                            @enderror

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- STEP 4 - BRAND --}}
                    {{-- ================================================= --}}

                    @if ($subcategory_id)

                        <div>

                            <div class="mb-4 flex items-center gap-3">

                                <span
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-500 text-sm font-black text-white">
                                    4
                                </span>

                                <div>
                                    <h3 class="font-bold text-slate-700 dark:text-slate-300">
                                        {{ app()->getLocale() === 'ar' ? 'اختر العلامة التجارية' : 'Select Brand' }}
                                    </h3>

                                    <p class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ app()->getLocale() === 'ar'
                                            ? 'اختر علامة موجودة أو أضف علامة تجارية محلية.'
                                            : 'Choose an existing brand or add your local brand.' }}
                                    </p>
                                </div>

                            </div>


                            {{-- ============================================= --}}
                            {{-- BRAND OPTIONS --}}
                            {{-- ============================================= --}}

                            <div class="flex flex-wrap gap-3">

                                {{-- EXISTING BRANDS --}}
                                @foreach ($brands->where('subcategory_id', $subcategory_id) as $brand)
                                    @php
                                        $brandName =
                                            app()->getLocale() === 'ar'
                                                ? $brand->brand_name_ar ?? $brand->brand_name
                                                : $brand->brand_name ?? $brand->brand_name_ar;
                                    @endphp

                                    <button type="button" wire:click="selectBrand({{ (int) $brand->id }})"
                                        wire:key="brand-{{ $brand->id }}"
                                        class="rounded-full border px-5 py-3 font-semibold transition-all
                    {{ $brand_type === 'existing' && (int) $brand_id === (int) $brand->id
                        ? 'border-orange-500 bg-orange-500 text-white shadow-lg shadow-orange-500/20'
                        : 'border-slate-200 bg-slate-50 hover:border-orange-400 hover:bg-orange-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200' }}">

                                        {{ $brandName }}

                                    </button>
                                @endforeach


                                {{-- ============================================= --}}
                                {{-- LOCAL BRAND --}}
                                {{-- ============================================= --}}

                                <button type="button" wire:click="useLocalBrand"
                                    class="rounded-full border px-5 py-3 font-semibold transition-all
                {{ $brand_type === 'local'
                    ? 'border-orange-500 bg-orange-500 text-white shadow-lg shadow-orange-500/20'
                    : 'border-slate-200 bg-slate-50 hover:border-orange-400 hover:bg-orange-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200' }}">

                                    {{ app()->getLocale() === 'ar' ? 'علامة تجارية محلية' : 'Local Brand' }}

                                </button>


                                {{-- ============================================= --}}
                                {{-- UNBRANDED --}}
                                {{-- ============================================= --}}

                                <button type="button" wire:click="selectUnbranded"
                                    class="rounded-full border px-5 py-3 font-semibold transition-all
                {{ $brand_type === 'unbranded'
                    ? 'border-orange-500 bg-slate-950 text-white dark:bg-orange-500'
                    : 'border-slate-200 bg-slate-50 hover:border-orange-400 hover:bg-orange-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200' }}">

                                    {{ app()->getLocale() === 'ar' ? 'بدون علامة تجارية' : 'Unbranded' }}

                                </button>

                            </div>


                            {{-- ============================================= --}}
                            {{-- LOCAL BRAND FORM --}}
                            {{-- ============================================= --}}

                            @if ($brand_type === 'local')

                                <div
                                    class="mt-6 rounded-2xl border border-orange-200 bg-orange-50/60 p-5 dark:border-orange-500/20 dark:bg-orange-500/5">

                                    <div class="mb-5">

                                        <div class="flex items-center gap-2">

                                            <div
                                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-orange-500 text-white">
                                                🏷️
                                            </div>

                                            <h4 class="font-black text-slate-900 dark:text-white">
                                                {{ app()->getLocale() === 'ar' ? 'بيانات العلامة التجارية المحلية' : 'Local Brand Information' }}
                                            </h4>

                                        </div>

                                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                                            {{ app()->getLocale() === 'ar'
                                                ? 'أدخل اسم علامتك التجارية باللغتين.'
                                                : 'Enter your local brand name in English and Arabic.' }}
                                        </p>

                                    </div>


                                    <div class="grid gap-5 md:grid-cols-2">

                                        {{-- ENGLISH --}}
                                        <div>

                                            <label class="font-bold text-slate-700 dark:text-slate-300">
                                                {{ __('English Brand Name') }}
                                            </label>

                                            <input type="text" wire:model.live="local_brand_name" dir="ltr"
                                                autocomplete="off" placeholder="Example: Desert Rose"
                                                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                            @error('local_brand_name')
                                                <p class="mt-2 text-sm text-red-500">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>


                                        {{-- ARABIC --}}
                                        <div dir="rtl">

                                            <label class="font-bold text-slate-700 dark:text-slate-300">
                                                {{ __('اسم العلامة التجارية بالعربية') }}
                                            </label>

                                            <input type="text" wire:model.live="local_brand_name_ar"
                                                dir="rtl" autocomplete="off" placeholder="مثال: وردة الصحراء"
                                                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-right text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                            @error('local_brand_name_ar')
                                                <p class="mt-2 text-left text-sm text-red-500">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    {{-- PREVIEW --}}
                                    @if (filled($local_brand_name) || filled($local_brand_name_ar))

                                        <div
                                            class="mt-5 rounded-xl border border-orange-200 bg-white p-4 dark:border-orange-500/20 dark:bg-slate-950">

                                            <p class="text-[10px] font-bold uppercase tracking-wider text-orange-500">
                                                {{ __('Brand Preview') }}
                                            </p>

                                            @if (filled($local_brand_name))
                                                <p class="mt-1 text-base font-black text-slate-900 dark:text-white">
                                                    {{ $local_brand_name }}
                                                </p>
                                            @endif

                                            @if (filled($local_brand_name_ar))
                                                <p class="mt-0.5 text-sm font-semibold text-slate-500 dark:text-slate-400"
                                                    dir="rtl">
                                                    {{ $local_brand_name_ar }}
                                                </p>
                                            @endif

                                        </div>

                                    @endif

                                </div>

                            @endif


                            {{-- ============================================= --}}
                            {{-- SELECTED EXISTING BRAND --}}
                            {{-- ============================================= --}}

                            @if ($brand_type === 'existing' && filled($brand_id))

                                @php
                                    $selectedBrand = $brands->firstWhere('id', (int) $brand_id);
                                @endphp

                                @if ($selectedBrand)
                                    <div
                                        class="mt-5 rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800">

                                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                            {{ __('Selected Brand') }}
                                        </p>

                                        <p class="mt-1 text-base font-black text-slate-900 dark:text-white">

                                            {{ app()->getLocale() === 'ar'
                                                ? $selectedBrand->brand_name_ar ?? $selectedBrand->brand_name
                                                : $selectedBrand->brand_name ?? $selectedBrand->brand_name_ar }}

                                        </p>

                                    </div>
                                @endif

                            @endif


                            {{-- ============================================= --}}
                            {{-- UNBRANDED MESSAGE --}}
                            {{-- ============================================= --}}

                            @if ($brand_type === 'unbranded')
                                <div
                                    class="mt-5 rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-200 dark:bg-slate-700">
                                            📦
                                        </div>

                                        <div>

                                            <p class="font-bold text-slate-900 dark:text-white">
                                                {{ __('Unbranded Product') }}
                                            </p>

                                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                                {{ __('This product will be displayed without a brand.') }}
                                            </p>

                                        </div>

                                    </div>

                                </div>
                            @endif


                            {{-- ERROR --}}
                            @error('brand_id')
                                <p class="mt-3 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    @endif

                </div>
            </div>


            {{-- ===================================================== --}}
            {{-- FEATURES --}}
            {{-- ===================================================== --}}

            <div
                class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20 sm:p-8">

                <h2 class="text-xl font-black text-slate-900 dark:text-white">
                    {{ __('Product Features') }}
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Highlight the features customers should know about.') }}
                </p>

                <div class="mt-5 flex flex-col gap-2 sm:flex-row">

                    <input type="text" wire:model="feature" wire:keydown.enter.prevent="addFeature"
                        placeholder="{{ __('Example: 128GB Storage') }}"
                        class="flex-1 rounded-xl border border-slate-200 bg-slate-50 p-3.5 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                    <button type="button" wire:click="addFeature"
                        class="rounded-xl bg-orange-500 px-6 py-3 font-bold text-white shadow-lg shadow-orange-500/20 transition hover:bg-orange-600">
                        {{ __('Add Feature') }}
                    </button>

                </div>

                @if (count($features))

                    <div class="mt-5 flex flex-wrap gap-3">

                        @foreach ($features as $index => $feature)
                            <div wire:key="feature-{{ $index }}"
                                class="inline-flex items-center rounded-full border border-orange-100 bg-orange-50 px-4 py-2 font-semibold text-orange-700 dark:border-orange-500/20 dark:bg-orange-500/10 dark:text-orange-400">

                                {{ $feature }}

                                <button type="button" wire:click="removeFeature({{ $index }})"
                                    class="ml-3 text-orange-400 hover:text-red-500">
                                    ✕
                                </button>

                            </div>
                        @endforeach

                    </div>

                @endif

            </div>


            {{-- ===================================================== --}}
            {{-- SHIPPING --}}
            {{-- ===================================================== --}}

            <div
                class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20 sm:p-8">

                <div class="mb-6">

                    <h2 class="text-xl font-black text-slate-900 dark:text-white">
                        {{ __('Delivery & Shipping') }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('Configure how customers can receive their orders.') }}
                    </p>

                </div>

                <div class="grid gap-6 md:grid-cols-2">

                    {{-- SHIPPING METHOD --}}
                    <div>

                        <label for="shipping_method" class="mb-2 block font-bold text-slate-700 dark:text-slate-300">
                            {{ __('Shipping Method') }}
                        </label>

                        <select id="shipping_method" wire:model="shipping_method"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            <option value="">
                                {{ __('Select shipping method') }}
                            </option>

                            <option value="Raslo" @disabled(!\App\Services\Checkout\ShippingMethod::ready(auth()->user()?->shop))>{{ app()->getLocale()==='ar'?'رسلو · توصيل داخل الإمارات':'Raslo · UAE delivery' }}</option>
                                    <option value="Standard Shipping">
                                {{ __('Standard UAE Delivery') }}
                            </option>

                            <option value="Express Shipping">
                                {{ __('Express UAE Delivery') }}
                            </option>

                            <option value="Free Shipping">
                                {{ __('Free Shipping') }}
                            </option>

                            <option value="Pickup">
                                {{ __('Local Pickup') }}
                            </option>

                        </select>
                        <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ app()->getLocale()==='ar'?'اختر رسلو لإرسال طلبات هذا المنتج تلقائيًا بعد تأكيد الدفع. يتطلب ربطًا مفعّلًا ومتحققًا منه وعملة AED. طرق الشحن الأخرى ينظمها المتجر.':'Choose Raslo to forward this product’s orders automatically after confirmed payment. Requires an enabled, verified AED connection. Other methods are fulfilled by the store.' }}</p>
                        <a href="{{ route('raslo.settings') }}" class="mt-2 inline-block font-bold text-orange-600 underline">{{ app()->getLocale()==='ar'?'إعداد ربط رسلو ومتابعة الطلبات':'Set up Raslo & manage deliveries' }}</a>


                        @error('shipping_method')
                            <span class="mt-2 block text-sm text-red-500">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- DELIVERY DAYS --}}
                    <div>

                        <label class="mb-2 block font-bold text-slate-700 dark:text-slate-300">
                            {{ __('Delivery Time') }}
                        </label>

                        <div class="relative">

                            <input type="number" min="1" wire:model="delivery_days" placeholder="2"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 pr-20 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-sm font-semibold text-slate-400">
                                {{ __('Days') }}
                            </span>

                        </div>

                        @error('delivery_days')
                            <span class="mt-2 block text-sm text-red-500">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>

                <div
                    class="mt-5 flex items-center gap-3 rounded-xl border border-orange-100 bg-orange-50 p-4 text-sm text-orange-800 dark:border-orange-500/10 dark:bg-orange-500/5 dark:text-orange-300">

                    <span class="text-xl">🇦🇪</span>

                    <p>
                        {{ __('Offer convenient delivery options for customers throughout the UAE.') }}
                    </p>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- IMAGES --}}
            {{-- ===================================================== --}}

            <div
                class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20 sm:p-8">

                <div class="mb-6">

                    <h2 class="text-xl font-black text-slate-900 dark:text-white">
                        {{ __('Product Images') }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('High-quality images help your product stand out.') }}
                    </p>

                </div>

                <div class="grid gap-8 md:grid-cols-2">

                    {{-- MAIN IMAGE --}}
                    <div>

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            {{ __('Main Image') }}
                        </label>

                        <input type="file" wire:model="image" accept="image/jpeg,image/png,image/webp"
                            class="mt-3 block w-full cursor-pointer rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm dark:border-slate-700 dark:bg-slate-950">

                        <div wire:loading wire:target="image" class="mt-2 text-sm text-orange-500">
                            {{ __('Uploading...') }}
                        </div>

                        @error('image')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                        @if ($image)
                            <div
                                class="mt-4 overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700">

                                <img src="{{ $image->temporaryUrl() }}" class="h-64 w-full object-cover"
                                    alt="{{ __('Product image') }}">

                            </div>
                        @endif

                    </div>


                    {{-- GALLERY --}}
                    <div>

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            {{ __('Gallery Images') }}
                        </label>

                        <input type="file" wire:model="images" multiple accept="image/jpeg,image/png,image/webp"
                            class="mt-3 block w-full cursor-pointer rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm dark:border-slate-700 dark:bg-slate-950">

                        <div wire:loading wire:target="images" class="mt-2 text-sm text-orange-500">
                            {{ __('Uploading...') }}
                        </div>

                        @error('images.*')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                        @if (count($images))

                            <div class="mt-4 grid grid-cols-3 gap-3">

                                @foreach ($images as $index => $img)
                                    <div wire:key="image-preview-{{ $index }}"
                                        class="overflow-hidden rounded-xl border border-slate-200 dark:border-slate-700">

                                        <img src="{{ $img->temporaryUrl() }}" class="h-28 w-full object-cover"
                                            alt="{{ __('Gallery image') }}">

                                    </div>
                                @endforeach

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- VIDEO --}}
            {{-- ===================================================== --}}

            <div
                class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20 sm:p-8">

                <h2 class="text-xl font-black text-slate-900 dark:text-white">
                    {{ __('Product Video') }}
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Add a short video to showcase your product.') }}
                </p>

                <input type="file" wire:model="video" accept="video/mp4,video/webm,video/quicktime"
                    class="mt-5 w-full rounded-xl border border-slate-200 bg-slate-50 p-3 dark:border-slate-700 dark:bg-slate-950">

                <div wire:loading wire:target="video" class="mt-2 text-sm text-orange-500">
                    {{ __('Uploading...') }}
                </div>

                @error('video')
                    <p class="mt-2 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror

                @if ($video)
                    <video class="mt-5 w-full max-w-xl rounded-2xl shadow-lg" controls preload="metadata">

                        <source src="{{ $video->temporaryUrl() }}">

                    </video>
                @endif

                <p class="mt-3 text-sm text-slate-400">
                    {{ __('Recommended: MP4 · 15–60 seconds · Maximum 50 MB.') }}
                </p>

            </div>


            {{-- ===================================================== --}}
            {{-- PUBLISH --}}
            {{-- ===================================================== --}}

            <div
                class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-orange-500 via-orange-600 to-amber-500 p-6 text-white shadow-2xl shadow-orange-500/20 sm:p-8">

                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>

                <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <div
                            class="mb-2 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-xs font-bold uppercase tracking-wider backdrop-blur">

                            🇦🇪 {{ __('UAE Marketplace') }}

                        </div>

                        <h3 class="text-2xl font-black">
                            {{ __('Ready to publish?') }}
                        </h3>

                        <p class="mt-2 max-w-xl text-sm leading-6 text-white/80">
                            {{ __('Your product will be published immediately and made available to customers.') }}
                        </p>

                    </div>

                    <button type="submit" wire:loading.attr="disabled" wire:target="save"
                        class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-white px-8 py-4 font-black text-orange-600 shadow-xl transition hover:-translate-y-0.5 hover:bg-orange-50 disabled:cursor-not-allowed disabled:opacity-60">

                        <span wire:loading.remove wire:target="save">
                            {{ __('Publish Product') }}
                        </span>

                        <span wire:loading wire:target="save">
                            {{ __('Publishing...') }}
                        </span>

                        <svg wire:loading.remove wire:target="save" class="h-5 w-5" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-5-5 5 5-5 5" />

                        </svg>

                    </button>

                </div>

            </div>

        </form>

    @endif

</div>
