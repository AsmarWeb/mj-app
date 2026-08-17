@php
    $isArabic = app()->getLocale() === 'ar';

    /*
    |--------------------------------------------------------------------------
    | Direction
    |--------------------------------------------------------------------------
    */

    $direction = $isArabic ? 'rtl' : 'ltr';
    $textAlign = $isArabic ? 'text-right' : 'text-left';

    /*
    |--------------------------------------------------------------------------
    | Localized Labels
    |--------------------------------------------------------------------------
    */

    $labels = [
        // Page
        'basket_badge' => $isArabic ? 'سلة التسوق' : 'Shopping Basket',

        'basket_title' => $isArabic ? 'سلة مشترياتك' : 'Your Basket',

        'basket_description' => $isArabic
            ? 'راجع منتجاتك قبل الانتقال إلى إتمام الطلب.'
            : 'Review your items before continuing to checkout.',

        'continue_shopping' => $isArabic ? 'متابعة التسوق' : 'Continue Shopping',

        // Alerts
        'success' => $isArabic ? 'تم بنجاح' : 'Success',

        'something_wrong' => $isArabic ? 'حدث خطأ ما' : 'Something went wrong',

        'check_following' => $isArabic ? 'يرجى التحقق من التالي:' : 'Please check the following:',

        // Shop
        'shop' => $isArabic ? 'المتجر' : 'Shop',

        'sold_by' => $isArabic ? 'يباع بواسطة' : 'Sold by',

        'contact_shop' => $isArabic ? 'تواصل مع المتجر' : 'Contact Shop',

        // Product
        'each' => $isArabic ? 'للقطعة' : 'each',

        'item' => $isArabic ? 'منتج' : 'item',

        'items' => $isArabic ? 'منتجات' : 'items',

        'remove' => $isArabic ? 'إزالة' : 'Remove',

        'remove_confirm' => $isArabic
            ? 'هل أنت متأكد أنك تريد إزالة هذا المنتج من السلة؟'
            : 'Are you sure you want to remove this item?',

        // Totals
        'shop_total' => $isArabic ? 'إجمالي المتجر' : 'Shop Total',

        'order_summary' => $isArabic ? 'ملخص الطلب' : 'Order Summary',

        'subtotal' => $isArabic ? 'المجموع الفرعي' : 'Subtotal',

        'shipping' => $isArabic ? 'الشحن' : 'Shipping',

        'calculated_checkout' => $isArabic ? 'يُحسب عند إتمام الطلب' : 'Calculated at checkout',

        'total' => $isArabic ? 'الإجمالي' : 'Total',

        'before_shipping' => $isArabic ? 'قبل الشحن والضرائب' : 'Before shipping and taxes',

        'proceed_checkout' => $isArabic ? 'المتابعة إلى إتمام الطلب' : 'Proceed to Checkout',

        // Trust
        'shopping_confidence' => $isArabic ? 'تسوق بثقة' : 'Shopping with confidence',

        'secure_checkout' => $isArabic ? 'إتمام طلب آمن' : 'Secure checkout',

        'secure_checkout_text' => $isArabic
            ? 'بيانات إتمام طلبك محمية وآمنة.'
            : 'Your checkout information is protected.',

        'multiple_shops' => $isArabic ? 'عدة متاجر' : 'Multiple shops',

        'multiple_shops_text' => $isArabic
            ? 'يمكن أن تحتوي سلتك على منتجات من عدة بائعين.'
            : 'Items can come from different marketplace sellers.',

        'seller_support' => $isArabic ? 'دعم البائع' : 'Seller support',

        'seller_support_text' => $isArabic
            ? 'يمكنك التواصل مع المتاجر المشاركة عبر واتساب.'
            : 'Contact participating sellers through WhatsApp.',

        // Empty basket
        'empty_title' => $isArabic ? 'سلتك فارغة' : 'Your basket is empty',

        'empty_description' => $isArabic
            ? 'يبدو أنك لم تضف أي منتجات بعد. استكشف سوق مُروَّج.كم وابحث عن شيء يناسبك.'
            : 'Looks like you haven’t added anything yet. Explore مُروَّج.كم and find something you like.',

        'explore_marketplace' => $isArabic ? 'استكشف السوق' : 'Explore Marketplace',

        // Brand
        'brand' => $isArabic ? 'مُروَّج.كم' : 'Murwaj.com',
    ];

    /*
    |--------------------------------------------------------------------------
    | Helper For Product Titles
    |--------------------------------------------------------------------------
    */

    $getListingTitle = function ($listing) use ($isArabic) {
        if ($isArabic) {
            return $listing->title_ar ?? $listing->title;
        }

        return $listing->title;
    };
@endphp


<x-main-layout>

    <x-slot name="header">
        <x-main-header />
    </x-slot>


    <div dir="{{ $direction }}" class="min-h-screen bg-gray-50 dark:bg-gray-950">

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">


            {{-- =====================================================
                ALERTS
            ====================================================== --}}

            @if (session('success'))
                <div
                    class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-green-800 dark:border-green-900/50 dark:bg-green-950/30 dark:text-green-300">

                    <div
                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/50">
                        ✓
                    </div>

                    <div class="{{ $textAlign }}">
                        <p class="font-bold">
                            {{ $labels['success'] }}
                        </p>

                        <p class="mt-1 text-sm">
                            {{ session('success') }}
                        </p>
                    </div>

                </div>
            @endif


            @if (session('error'))
                <div
                    class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 text-red-800 dark:border-red-900/50 dark:bg-red-950/30 dark:text-red-300">

                    <div
                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/50">
                        !
                    </div>

                    <div class="{{ $textAlign }}">

                        <p class="font-bold">
                            {{ $labels['something_wrong'] }}
                        </p>

                        <p class="mt-1 text-sm">
                            {{ session('error') }}
                        </p>

                    </div>

                </div>
            @endif


            @if ($errors->any())

                <div
                    class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5 text-red-800 dark:border-red-900/50 dark:bg-red-950/30 dark:text-red-300">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 font-bold dark:bg-red-900/50">
                            !
                        </div>

                        <div class="{{ $textAlign }}">

                            <p class="font-bold">
                                {{ $labels['check_following'] }}
                            </p>

                        </div>

                    </div>


                    <ul class="mt-3 list-inside list-disc space-y-1 text-sm">

                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- =====================================================
                PAGE HEADER
            ====================================================== --}}

            <div class="mb-8">

                <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">

                    <div class="{{ $textAlign }}">

                        <div
                            class="mb-3 inline-flex items-center gap-2 rounded-full bg-orange-100 px-3 py-1.5 text-sm font-semibold text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">

                            <span>🛒</span>

                            {{ $labels['basket_badge'] }}

                        </div>


                        <h1 class="text-3xl font-black tracking-tight text-gray-900 dark:text-white sm:text-4xl">

                            {{ $labels['basket_title'] }}

                        </h1>


                        <p class="mt-2 text-gray-500 dark:text-gray-400">

                            {{ $labels['basket_description'] }}

                        </p>

                    </div>


                    @if (isset($shops) && $shops->count())
                        <a href="{{ route('explore') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-orange-300 hover:text-orange-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-orange-500 dark:hover:text-orange-400">

                            <span>
                                {{ $isArabic ? '→' : '←' }}
                            </span>

                            {{ $labels['continue_shopping'] }}

                        </a>
                    @endif

                </div>

            </div>


            {{-- =====================================================
                CART
            ====================================================== --}}

            @if (isset($shops) && $shops->count())


                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">


                    {{-- =================================================
                        PRODUCTS
                    ================================================== --}}

                    <div class="space-y-6 lg:col-span-2">

                        @foreach ($shops as $shopId => $items)
                            @php

                                $shop = $items->first()->listing?->shop;

                                $shopTotal = $items->sum(function ($item) {
                                    return $item->price * $item->quantity;
                                });

                                $shopName = $shop ? ($isArabic ? ($shop->name_ar ?: $shop->name) : $shop->name) : '';

                                $currency = $shop->currency ?? 'AED';

                            @endphp


                            @if ($shop)
                                <div
                                    class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">


                                    {{-- SHOP HEADER --}}

                                    <div
                                        class="flex flex-col gap-4 border-b border-gray-100 bg-gray-50/80 p-5 dark:border-gray-800 dark:bg-gray-800/40 sm:flex-row sm:items-center sm:justify-between">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-red-500 font-black text-white shadow-sm">

                                                {{ strtoupper(mb_substr($shopName, 0, 1)) }}

                                            </div>


                                            <div class="{{ $textAlign }}">

                                                <p
                                                    class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">

                                                    {{ $labels['shop'] }}

                                                </p>

                                                <h2 class="font-bold text-gray-900 dark:text-white">

                                                    {{ $shopName }}

                                                </h2>

                                            </div>

                                        </div>


                                        @if ($shop->allow_whatsapp && $shop->whatsapp)
                                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $shop->whatsapp) }}"
                                                target="_blank" rel="noopener noreferrer"
                                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-green-500 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-green-600">

                                                <span>💬</span>

                                                {{ $labels['contact_shop'] }}

                                            </a>
                                        @endif

                                    </div>


                                    {{-- ITEMS --}}

                                    <div class="p-5">

                                        @foreach ($items as $item)
                                            @if ($item->listing)
                                                @php
                                                    $listingTitle = $getListingTitle($item->listing);
                                                @endphp


                                                <div
                                                    class="flex flex-col gap-5 border-b border-gray-100 py-5 first:pt-0 last:border-b-0 last:pb-0 dark:border-gray-800 sm:flex-row">


                                                    {{-- IMAGE --}}

                                                    <a href="{{ $item->listing->url }}" class="shrink-0">

                                                        @if ($item->listing->image)
                                                            <img src="{{ asset('storage/products/' . $item->listing->image) }}"
                                                                alt="{{ $listingTitle }}"
                                                                class="h-28 w-28 rounded-2xl object-cover ring-1 ring-gray-200 dark:ring-gray-700">
                                                        @else
                                                            <div
                                                                class="flex h-28 w-28 items-center justify-center rounded-2xl bg-gray-100 text-4xl dark:bg-gray-800">

                                                                📦

                                                            </div>
                                                        @endif

                                                    </a>


                                                    {{-- DETAILS --}}

                                                    <div class="min-w-0 flex-1 {{ $textAlign }}">

                                                        <a href="{{ $item->listing->url }}"
                                                            class="line-clamp-2 text-lg font-bold text-gray-900 transition hover:text-orange-600 dark:text-white dark:hover:text-orange-400">

                                                            {{ $listingTitle }}

                                                        </a>


                                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                                                            {{ $labels['sold_by'] }}

                                                            {{ $shopName }}

                                                        </p>


                                                        <p
                                                            class="mt-2 text-sm font-semibold text-gray-700 dark:text-gray-300">

                                                            {{ $currency }}
                                                            {{ number_format($item->price, 2) }}

                                                            <span class="font-normal text-gray-400">

                                                                {{ $labels['each'] }}

                                                            </span>

                                                        </p>


                                                        {{-- QUANTITY --}}

                                                        <div class="mt-4 flex flex-wrap items-center gap-4">

                                                            <div
                                                                class="inline-flex items-center overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">


                                                                {{-- DECREASE --}}

                                                                <form method="POST"
                                                                    action="{{ route('cart.decrease', $item->id) }}">

                                                                    @csrf

                                                                    <button type="submit"
                                                                        aria-label="{{ $isArabic ? 'تقليل الكمية' : 'Decrease quantity' }}"
                                                                        class="flex h-10 w-10 items-center justify-center text-lg font-bold text-gray-600 transition hover:bg-gray-100 hover:text-orange-600 dark:text-gray-300 dark:hover:bg-gray-800">

                                                                        −

                                                                    </button>

                                                                </form>


                                                                {{-- QUANTITY --}}

                                                                <span
                                                                    class="flex h-10 min-w-[42px] items-center justify-center border-x border-gray-200 px-2 text-sm font-bold text-gray-900 dark:border-gray-700 dark:text-white">

                                                                    {{ $item->quantity }}

                                                                </span>


                                                                {{-- INCREASE --}}

                                                                <form method="POST"
                                                                    action="{{ route('cart.increase', $item->id) }}">

                                                                    @csrf

                                                                    <button type="submit"
                                                                        aria-label="{{ $isArabic ? 'زيادة الكمية' : 'Increase quantity' }}"
                                                                        class="flex h-10 w-10 items-center justify-center text-lg font-bold text-gray-600 transition hover:bg-gray-100 hover:text-orange-600 dark:text-gray-300 dark:hover:bg-gray-800">

                                                                        +

                                                                    </button>

                                                                </form>

                                                            </div>


                                                            <span class="text-sm text-gray-500 dark:text-gray-400">

                                                                {{ $item->quantity }}

                                                                {{ $item->quantity == 1 ? $labels['item'] : $labels['items'] }}

                                                            </span>

                                                        </div>

                                                    </div>


                                                    {{-- PRICE --}}

                                                    <div
                                                        class="flex flex-row items-center justify-between gap-4 sm:flex-col sm:items-end">

                                                        <p class="text-lg font-black text-gray-900 dark:text-white">

                                                            {{ $currency }}

                                                            {{ number_format($item->price * $item->quantity, 2) }}

                                                        </p>


                                                        <form method="POST"
                                                            action="{{ route('cart.destroy', $item->id) }}">

                                                            @csrf

                                                            @method('DELETE')

                                                            <button type="submit"
                                                                onclick="return confirm(@js($labels['remove_confirm']))"
                                                                class="text-sm font-semibold text-red-500 transition hover:text-red-700 dark:text-red-400">

                                                                {{ $labels['remove'] }}

                                                            </button>

                                                        </form>

                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach


                                        {{-- SHOP TOTAL --}}

                                        <div
                                            class="mt-5 flex items-center justify-between rounded-2xl bg-gray-50 p-4 dark:bg-gray-800/60">

                                            <span class="font-semibold text-gray-600 dark:text-gray-300">

                                                {{ $labels['shop_total'] }}

                                            </span>


                                            <span class="text-lg font-black text-gray-900 dark:text-white">

                                                {{ $currency }}

                                                {{ number_format($shopTotal, 2) }}

                                            </span>

                                        </div>

                                    </div>

                                </div>
                            @endif
                        @endforeach

                    </div>


                    {{-- =================================================
                        ORDER SUMMARY
                    ================================================== --}}

                    <div class="lg:col-span-1">

                        <div class="sticky top-6 space-y-5">


                            {{-- SUMMARY --}}

                            <div
                                class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">

                                <h2 class="text-xl font-black text-gray-900 dark:text-white {{ $textAlign }}">

                                    {{ $labels['order_summary'] }}

                                </h2>


                                <div class="mt-6 space-y-4">

                                    <div class="flex justify-between text-sm">

                                        <span class="text-gray-500 dark:text-gray-400">

                                            {{ $labels['subtotal'] }}

                                        </span>

                                        <span class="font-semibold text-gray-900 dark:text-white">

                                            {{ $currency }} {{ number_format($total, 2) }}

                                        </span>

                                    </div>


                                    <div class="flex justify-between text-sm">

                                        <span class="text-gray-500 dark:text-gray-400">

                                            {{ $labels['shipping'] }}

                                        </span>

                                        <span class="font-semibold text-green-600">

                                            {{ $labels['calculated_checkout'] }}

                                        </span>

                                    </div>


                                    <div class="border-t border-gray-100 pt-4 dark:border-gray-800">

                                        <div class="flex items-end justify-between gap-4">

                                            <div class="{{ $textAlign }}">

                                                <p class="font-bold text-gray-900 dark:text-white">

                                                    {{ $labels['total'] }}

                                                </p>

                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">

                                                    {{ $labels['before_shipping'] }}

                                                </p>

                                            </div>


                                            <p class="text-2xl font-black text-orange-600">

                                                {{ $currency }} {{ number_format($total, 2) }}

                                            </p>

                                        </div>

                                    </div>

                                </div>


                                {{-- CHECKOUT --}}

                                <a href="{{ route('checkout') }}"
                                    class="mt-6 flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4 text-center font-bold text-white shadow-lg shadow-orange-500/20 transition hover:from-orange-600 hover:to-red-600 hover:shadow-orange-500/30">

                                    {{ $labels['proceed_checkout'] }}

                                    <span>
                                        {{ $isArabic ? '←' : '→' }}
                                    </span>

                                </a>


                                <a href="{{ route('explore') }}"
                                    class="mt-3 flex w-full items-center justify-center rounded-xl px-4 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">

                                    {{ $labels['continue_shopping'] }}

                                </a>

                            </div>


                            {{-- =================================================
                                TRUST INFORMATION
                            ================================================== --}}

                            <div
                                class="rounded-3xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">

                                <h3 class="font-bold text-gray-900 dark:text-white {{ $textAlign }}">

                                    {{ $labels['shopping_confidence'] }}

                                </h3>


                                <div class="mt-4 space-y-4">


                                    {{-- Secure --}}

                                    <div class="flex gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-green-100 dark:bg-green-500/10">

                                            🔒

                                        </div>


                                        <div class="{{ $textAlign }}">

                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">

                                                {{ $labels['secure_checkout'] }}

                                            </p>

                                            <p class="text-xs text-gray-500 dark:text-gray-400">

                                                {{ $labels['secure_checkout_text'] }}

                                            </p>

                                        </div>

                                    </div>


                                    {{-- Multiple Shops --}}

                                    <div class="flex gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-500/10">

                                            📦

                                        </div>


                                        <div class="{{ $textAlign }}">

                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">

                                                {{ $labels['multiple_shops'] }}

                                            </p>

                                            <p class="text-xs text-gray-500 dark:text-gray-400">

                                                {{ $labels['multiple_shops_text'] }}

                                            </p>

                                        </div>

                                    </div>


                                    {{-- Seller Support --}}

                                    <div class="flex gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-orange-100 dark:bg-orange-500/10">

                                            💬

                                        </div>


                                        <div class="{{ $textAlign }}">

                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">

                                                {{ $labels['seller_support'] }}

                                            </p>

                                            <p class="text-xs text-gray-500 dark:text-gray-400">

                                                {{ $labels['seller_support_text'] }}

                                            </p>

                                        </div>

                                    </div>


                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            @else
                {{-- =====================================================
                    EMPTY BASKET
                ====================================================== --}}

                <div
                    class="mx-auto max-w-2xl rounded-[2rem] border border-gray-200 bg-white px-6 py-16 text-center shadow-sm dark:border-gray-800 dark:bg-gray-900">

                    <div
                        class="mx-auto flex h-24 w-24 items-center justify-center rounded-3xl bg-orange-100 text-5xl dark:bg-orange-500/10">

                        🛒

                    </div>


                    <h2 class="mt-7 text-3xl font-black text-gray-900 dark:text-white">

                        {{ $labels['empty_title'] }}

                    </h2>


                    <p class="mx-auto mt-3 max-w-md leading-7 text-gray-500 dark:text-gray-400">

                        {{ $labels['empty_description'] }}

                    </p>


                    <a href="{{ route('explore') }}"
                        class="mt-8 inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-orange-500 to-red-500 px-7 py-4 font-bold text-white shadow-lg shadow-orange-500/20 transition hover:from-orange-600 hover:to-red-600">

                        {{ $labels['explore_marketplace'] }}

                        <span>
                            {{ $isArabic ? '←' : '→' }}
                        </span>

                    </a>

                </div>

            @endif

        </div>

    </div>


    <x-main-footer />

</x-main-layout>
