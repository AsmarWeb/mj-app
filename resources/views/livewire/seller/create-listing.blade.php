<div class="max-w-7xl mx-auto py-8 px-4">

    @if (!$canCreate)


        {{-- ========================================================= --}}
        {{-- Listing Limit --}}
        {{-- ========================================================= --}}

        <div
            class="relative mb-8 overflow-hidden rounded-[2rem] border border-amber-200 bg-gradient-to-br from-amber-50 via-white to-orange-50 p-6 shadow-xl shadow-amber-100/50 dark:border-amber-500/20 dark:from-amber-500/10 dark:via-slate-900 dark:to-orange-500/5 dark:shadow-black/20 sm:p-8">

            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-amber-400/10 blur-3xl"></div>

            <div class="relative">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

                    <div>

                        <div
                            class="mb-3 inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-amber-700 dark:bg-amber-500/10 dark:text-amber-400">

                            <span class="h-2 w-2 rounded-full bg-amber-500"></span>

                            Listing Limit

                        </div>

                        <h2 class="text-2xl font-black text-amber-900 dark:text-white sm:text-3xl">
                            You've reached your listing limit
                        </h2>

                        <p class="mt-3 max-w-2xl leading-7 text-amber-800/80 dark:text-slate-300">

                            Your <strong>{{ $plan->name }}</strong> plan allows
                            <strong>{{ $plan->listing_limit }}</strong>
                            published {{ Str::plural('product', $plan->listing_limit) }}.

                            You have already used
                            <strong>{{ $usedListings }}</strong>.

                        </p>

                    </div>

                    <div class="text-4xl">
                        🇦🇪
                    </div>

                </div>


                <a href="{{ route('plans.index') }}"
                    class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-500/20 transition hover:-translate-y-0.5 hover:from-orange-600 hover:to-amber-600">

                    Upgrade Plan

                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-5-5 5 5-5 5" />
                    </svg>

                </a>

            </div>

        </div>
    @else
        {{-- ========================================================= --}}
        {{-- Header --}}
        {{-- ========================================================= --}}

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
                Create a New Product
            </h1>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400 sm:text-base">
                Add your product details, pricing, delivery options and media
                to reach customers across the UAE.
            </p>

        </div>


        <form wire:submit="save" class="space-y-8">


            {{-- ========================================================= --}}
            {{-- BASIC INFORMATION --}}
            {{-- ========================================================= --}}

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
                                Basic Information
                            </h2>

                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                Tell customers what you're selling.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-6 sm:p-8">

                    <div class="grid gap-6 md:grid-cols-2">

                        {{-- English Title --}}
                        <div>

                            <label class="font-bold text-slate-700 dark:text-slate-300">
                                Product Title
                                <span class="text-xs font-normal text-slate-400">
                                    / English
                                </span>
                            </label>

                            <input type="text" wire:model.defer="title" wire:model.live="title"
                                placeholder="e.g. iPhone 16 Pro Max"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            @error('title')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Arabic Title --}}
                        <div dir="rtl">

                            <label class="font-bold text-slate-700 dark:text-slate-300">
                                عنوان المنتج
                                <span class="text-xs font-normal text-slate-400">
                                    / Arabic
                                </span>
                            </label>

                            <input type="text" wire:model.defer="title_ar" placeholder="مثال: آيفون 16 برو ماكس"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-right text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            @error('title_ar')
                                <p class="mt-2 text-left text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Description --}}
                    <div class="mt-6">

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            Description
                        </label>

                        <textarea rows="6" wire:model.defer="description" wire:model.live="description"
                            placeholder="Describe your product, condition, features and important details..."
                            class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 leading-7 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"></textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Keywords --}}
                    <div class="mt-6">

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            Keywords
                        </label>

                        <div class="mt-2 flex flex-col gap-2 sm:flex-row">

                            <input wire:model="keyword"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                placeholder="e.g. Dubai, Apple, New, Smartphone">

                            <button type="button" wire:click="addKeyword"
                                class="rounded-xl bg-orange-500 px-6 py-3 font-bold text-white shadow-lg shadow-orange-500/20 transition hover:bg-orange-600">

                                Add

                            </button>

                        </div>


                        <div class="mt-4 flex flex-wrap gap-2">

                            @foreach ($keywords as $index => $tag)
                                <span
                                    class="inline-flex items-center gap-2 rounded-full border border-orange-100 bg-orange-50 px-4 py-2 text-sm font-semibold text-orange-700 dark:border-orange-500/20 dark:bg-orange-500/10 dark:text-orange-400">

                                    #{{ $tag }}

                                    <button type="button" wire:click="removeKeyword({{ $index }})"
                                        class="font-bold text-orange-400 transition hover:text-red-500">

                                        ×

                                    </button>

                                </span>
                            @endforeach

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- PRICING --}}
            {{-- ========================================================= --}}

            <div
                class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800">

                    <h2 class="text-xl font-black text-slate-900 dark:text-white">
                        Pricing & Inventory
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Set your UAE-friendly price and available quantity.
                    </p>

                </div>


                <div class="grid gap-6 p-6 sm:p-8 md:grid-cols-3">

                    {{-- Price --}}
                    <div>

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            Price
                        </label>

                        <div class="relative mt-2">

                            <span
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sm font-black text-orange-500">
                                AED
                            </span>

                            <input type="number" step="0.01" wire:model.defer="price" wire:model.live="price"
                                placeholder="0.00"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-14 pr-4 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                        </div>

                    </div>


                    {{-- Quantity --}}
                    <div>

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            Quantity
                        </label>

                        <input type="number" min="1" wire:model.defer="quantity"
                            placeholder="Available quantity"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                    </div>


                    {{-- Price Type --}}
                    <div>

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            Price Type
                        </label>

                        <select wire:model.defer="price_condition"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            <option value="fixed">
                                Fixed Price
                            </option>

                            <option value="negotiable">
                                Negotiable
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- CATEGORIES --}}
            {{-- ========================================================= --}}

            <div
                class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800 sm:px-8">

                    <h2 class="text-2xl font-black text-slate-900 dark:text-white">
                        Choose Category
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Help UAE customers find your product quickly.
                    </p>

                </div>


                <div class="space-y-8 p-6 sm:p-8">

                    {{-- SECTION --}}
                    <div>

                        <div class="mb-4 flex items-center gap-3">

                            <span
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-500 text-sm font-black text-white">
                                1
                            </span>

                            <h3 class="font-bold text-slate-700 dark:text-slate-300">
                                Select Section
                            </h3>

                        </div>


                        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

                            @foreach ($sections as $section)
                                <button type="button" wire:click="$set('section_id', {{ $section->id }})"
                                    class="rounded-2xl border p-5 text-left transition-all duration-300
                            {{ $section_id == $section->id
                                ? 'scale-[1.02] border-orange-500 bg-gradient-to-br from-orange-500 to-amber-500 text-white shadow-xl shadow-orange-500/20'
                                : 'border-slate-200 bg-slate-50 hover:-translate-y-1 hover:border-orange-400 hover:shadow-lg dark:border-slate-700 dark:bg-slate-800' }}">

                                    <div class="mb-3 text-3xl">
                                        📂
                                    </div>

                                    <div class="font-bold">
                                        {{ $section->name }}
                                    </div>

                                </button>
                            @endforeach

                        </div>

                    </div>


                    {{-- CATEGORY --}}
                    @if ($section_id)

                        <div>

                            <div class="mb-4 flex items-center gap-3">

                                <span
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-500 text-sm font-black text-white">
                                    2
                                </span>

                                <h3 class="font-bold text-slate-700 dark:text-slate-300">
                                    Select Category
                                </h3>

                            </div>


                            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

                                @foreach ($categories->where('section_id', $section_id) as $category)
                                    <button type="button" wire:click="$set('category_id', {{ $category->id }})"
                                        class="rounded-2xl border p-5 text-left transition-all
                                {{ $category_id == $category->id
                                    ? 'scale-[1.02] border-orange-500 bg-gradient-to-br from-orange-500 to-amber-500 text-white shadow-xl shadow-orange-500/20'
                                    : 'border-slate-200 bg-slate-50 hover:-translate-y-1 hover:border-orange-400 dark:border-slate-700 dark:bg-slate-800' }}">

                                        <div class="mb-3 text-3xl">
                                            📦
                                        </div>

                                        <div class="font-bold">
                                            {{ $category->category_name }}
                                        </div>

                                    </button>
                                @endforeach

                            </div>

                        </div>

                    @endif


                    {{-- SUBCATEGORY --}}
                    @if ($category_id)

                        <div>

                            <div class="mb-4 flex items-center gap-3">

                                <span
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-500 text-sm font-black text-white">
                                    3
                                </span>

                                <h3 class="font-bold text-slate-700 dark:text-slate-300">
                                    Select Subcategory
                                </h3>

                            </div>


                            <div class="flex flex-wrap gap-3">

                                @foreach ($subcategories->where('category_id', $category_id) as $subcategory)
                                    <button type="button"
                                        wire:click="$set('subcategory_id', {{ $subcategory->id }})"
                                        class="rounded-full border px-5 py-3 font-semibold transition
                                {{ $subcategory_id == $subcategory->id
                                    ? 'border-orange-500 bg-orange-500 text-white shadow-lg shadow-orange-500/20'
                                    : 'border-slate-200 bg-slate-50 hover:border-orange-400 hover:bg-orange-50 dark:border-slate-700 dark:bg-slate-800' }}">

                                        {{ $subcategory->subcategory_name }}

                                    </button>
                                @endforeach

                            </div>

                        </div>

                    @endif


                    {{-- BRAND --}}
                    @if ($subcategory_id)

                        <div>

                            <div class="mb-4 flex items-center gap-3">

                                <span
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-500 text-sm font-black text-white">
                                    4
                                </span>

                                <h3 class="font-bold text-slate-700 dark:text-slate-300">
                                    Select Brand
                                </h3>

                            </div>


                            <div class="flex flex-wrap gap-3">

                                @foreach ($brands as $brand)
                                    <button type="button" wire:click="$set('brand_id', {{ $brand->id }})"
                                        class="rounded-full border px-5 py-3 font-semibold transition-all
                                {{ $brand_id == $brand->id
                                    ? 'border-orange-500 bg-slate-950 text-white dark:bg-orange-500'
                                    : 'border-slate-200 bg-slate-50 hover:border-orange-400 dark:border-slate-700 dark:bg-slate-800' }}">

                                        {{ $brand->brand_name }}

                                    </button>
                                @endforeach

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- FEATURES --}}
            {{-- ========================================================= --}}

            <div
                class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20 sm:p-8">

                <h2 class="text-xl font-black text-slate-900 dark:text-white">
                    Product Features
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Highlight the features customers should know about.
                </p>


                <div class="mt-5 flex flex-col gap-2 sm:flex-row">

                    <input type="text" wire:model="feature"
                        class="flex-1 rounded-xl border border-slate-200 bg-slate-50 p-3.5 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                        placeholder="Example: 128GB Storage">

                    <button type="button" wire:click="addFeature"
                        class="rounded-xl bg-orange-500 px-6 py-3 font-bold text-white shadow-lg shadow-orange-500/20 transition hover:bg-orange-600">

                        Add Feature

                    </button>

                </div>


                <div class="mt-5 flex flex-wrap gap-3">

                    @foreach ($features as $index => $feature)
                        <div
                            class="inline-flex items-center rounded-full border border-orange-100 bg-orange-50 px-4 py-2 font-semibold text-orange-700 dark:border-orange-500/20 dark:bg-orange-500/10 dark:text-orange-400">

                            {{ $feature }}

                            <button type="button" wire:click="removeFeature({{ $index }})"
                                class="ml-3 text-orange-400 hover:text-red-500">

                                ✕

                            </button>

                        </div>
                    @endforeach

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- SHIPPING --}}
            {{-- ========================================================= --}}

            <div
                class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20 sm:p-8">

                <div class="mb-6">

                    <h2 class="text-xl font-black text-slate-900 dark:text-white">
                        Delivery & Shipping
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Configure how customers across the UAE can receive their orders.
                    </p>

                </div>


                <div class="grid gap-6 md:grid-cols-2">

                    {{-- Shipping Method --}}
                    <div>

                        <label class="mb-2 block font-bold text-slate-700 dark:text-slate-300">
                            Shipping Method
                        </label>

                        <select wire:model="shipping_method"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            <option value="">
                                Select shipping method
                            </option>

                            <option value="Standard Shipping">
                                Standard UAE Delivery
                            </option>

                            <option value="Express Shipping">
                                Express UAE Delivery
                            </option>

                            <option value="Free Shipping">
                                Free Shipping
                            </option>

                            <option value="Pickup">
                                Local Pickup
                            </option>

                        </select>

                        @error('shipping_method')
                            <span class="mt-2 block text-sm text-red-500">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Delivery Days --}}
                    <div>

                        <label class="mb-2 block font-bold text-slate-700 dark:text-slate-300">
                            Delivery Time
                        </label>

                        <div class="relative">

                            <input type="number" min="1" wire:model="delivery_days" placeholder="Example: 2"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 pr-20 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-sm font-semibold text-slate-400">
                                Days
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

                    <span class="text-xl">
                        🇦🇪
                    </span>

                    <p>
                        Offer convenient delivery options for customers throughout the UAE.
                    </p>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- IMAGES --}}
            {{-- ========================================================= --}}

            <div
                class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20 sm:p-8">

                <div class="mb-6">

                    <h2 class="text-xl font-black text-slate-900 dark:text-white">
                        Product Images
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        High-quality images help your product stand out.
                    </p>

                </div>


                <div class="grid gap-8 md:grid-cols-2">

                    {{-- Main Image --}}
                    <div>

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            Main Image
                        </label>

                        <input type="file" wire:model="image" wire:model.live="image"
                            class="mt-3 block w-full cursor-pointer rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm dark:border-slate-700 dark:bg-slate-950">

                        @if ($image)
                            <div
                                class="mt-4 overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700">

                                <img src="{{ $image->temporaryUrl() }}" class="h-64 w-full object-cover">

                            </div>
                        @endif

                    </div>


                    {{-- Gallery --}}
                    <div>

                        <label class="font-bold text-slate-700 dark:text-slate-300">
                            Gallery Images
                        </label>

                        <input type="file" wire:model="images" multiple
                            class="mt-3 block w-full cursor-pointer rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm dark:border-slate-700 dark:bg-slate-950">


                        <div class="mt-4 grid grid-cols-3 gap-3">

                            @foreach ($images as $img)
                                <div class="overflow-hidden rounded-xl border border-slate-200 dark:border-slate-700">

                                    <img src="{{ $img->temporaryUrl() }}" class="h-28 w-full object-cover">

                                </div>
                            @endforeach

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- VIDEO --}}
            {{-- ========================================================= --}}

            <div
                class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20 sm:p-8">

                <h2 class="text-xl font-black text-slate-900 dark:text-white">
                    Product Video
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Add a short video to showcase your product.
                </p>


                <input type="file" wire:model="video" accept="video/mp4,video/webm,video/quicktime"
                    class="mt-5 w-full rounded-xl border border-slate-200 bg-slate-50 p-3 dark:border-slate-700 dark:bg-slate-950">


                @error('video')
                    <p class="mt-2 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror


                @if ($video)
                    <video class="mt-5 w-full max-w-xl rounded-2xl shadow-lg" controls>

                        <source src="{{ $video->temporaryUrl() }}">

                    </video>
                @endif


                <p class="mt-3 text-sm text-slate-400">
                    Recommended: MP4 · 15–60 seconds.
                </p>

            </div>


            {{-- ========================================================= --}}
            {{-- PUBLISH --}}
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
                            Ready to publish?
                        </h3>

                        <p class="mt-2 max-w-xl text-sm leading-6 text-white/80">
                            Your product will be published immediately and made available to customers.
                        </p>

                    </div>


                    <button type="submit"
                        class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-white px-8 py-4 font-black text-orange-600 shadow-xl transition hover:-translate-y-0.5 hover:bg-orange-50">

                        Publish Product

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-5-5 5 5-5 5" />

                        </svg>

                    </button>

                </div>

            </div>

        </form>

    @endif

</div>
