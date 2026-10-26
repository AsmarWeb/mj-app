@php
    /*
    |--------------------------------------------------------------------------
    | LANGUAGE / DIRECTION
    |--------------------------------------------------------------------------
    */

    $isArabic = app()->getLocale() === 'ar';
    $direction = $isArabic ? 'rtl' : 'ltr';

    /*
    |--------------------------------------------------------------------------
    | DATABASE TRANSLATION HELPERS
    |--------------------------------------------------------------------------
    | Arabic is taken from the *_ar database column when available.
    | Otherwise we fall back to the English database value.
    */

    $categoryName = $listing->category
        ? ($isArabic
            ? $listing->category->category_name_ar ?? $listing->category->category_name
            : $listing->category->category_name)
        : null;

    $subcategory = $listing->subcategory ?? null;

    $subcategoryName = $subcategory
        ? ($isArabic
            ? $subcategory->subcategory_name_ar ??
                ($subcategory->sub_category_name_ar ??
                    ($subcategory->name_ar ??
                        ($subcategory->subcategory_name ?? ($subcategory->sub_category_name ?? $subcategory->name))))
            : $subcategory->subcategory_name ?? ($subcategory->sub_category_name ?? $subcategory->name))
        : null;

    $brandName = $listing->brand
        ? ($isArabic
            ? $listing->brand->brand_name_ar ?? $listing->brand->brand_name
            : $listing->brand->brand_name)
        : null;

    $sectionName = $listing->section
        ? ($isArabic
            ? $listing->section->name_ar ?? $listing->section->name
            : $listing->section->name)
        : null;

    $shopName = $listing->shop?->name;

    $currency = $listing->shop?->currency ?? 'AED';

    $productImage = $listing->image ? Storage::url('products/' . $listing->image) : asset('images/placeholder.png');

    $productDescription = Str::limit(strip_tags($listing->description ?? ''), 160);

    /*
    |--------------------------------------------------------------------------
    | PRODUCT URL
    |--------------------------------------------------------------------------
    */

    $productUrl = url()->current();

    /*
    |--------------------------------------------------------------------------
    | AVAILABILITY
    |--------------------------------------------------------------------------
    */

    $isAvailable = ($listing->quantity ?? 0) > 0 || $listing->product_type === 'digital';

    /*
    |--------------------------------------------------------------------------
    | LOCALIZED UI LABELS
    |--------------------------------------------------------------------------
    | These use Laravel translation files if available.
    | They do not replace database-driven category/brand/etc. values.
    */

    $labels = [
        'home' => $isArabic ? 'الرئيسية' : 'Home',
        'available' => $isArabic ? 'متوفر' : 'Available',
        'out_of_stock' => $isArabic ? 'غير متوفر' : 'Out of Stock',
        'sku' => $isArabic ? 'رمز المنتج' : 'SKU',
        'reviews' => $isArabic ? 'تقييمات' : 'reviews',
        'about_product' => $isArabic ? 'عن هذا المنتج' : 'About this product',
        'digital_product' => $isArabic ? 'منتج رقمي' : 'Digital Product',
        'digital_delivery' => $isArabic
            ? 'تسليم رقمي فوري بعد نجاح عملية الدفع.'
            : 'Instant digital delivery after successful payment.',
        'buy_download' => $isArabic ? 'شراء وتحميل' : 'Buy & Download',
        'quantity' => $isArabic ? 'الكمية' : 'Quantity',
        'available_quantity' => $isArabic ? 'متوفر' : 'available',
        'sold_by' => $isArabic ? 'يباع بواسطة' : 'Sold by',
        'whatsapp_seller' => $isArabic ? 'واتساب البائع' : 'WhatsApp Seller',
        'call_seller' => $isArabic ? 'اتصل بالبائع' : 'Call Seller',
        'add_wishlist' => $isArabic ? '♡ إضافة إلى المفضلة' : '♡ Add to Wishlist',
        'wishlist_added' => $isArabic ? '♥ تمت الإضافة إلى المفضلة' : '♥ Added to Wishlist',
        'secure_payment' => $isArabic ? 'دفع آمن' : 'Secure Payment',
        'trusted_seller' => $isArabic ? 'بائع موثوق' : 'Trusted Seller',
        'fast_delivery' => $isArabic ? 'توصيل سريع' : 'Fast Delivery',
        'product_details' => $isArabic ? 'تفاصيل المنتج' : 'Product Details',
        'category' => $isArabic ? 'التصنيف' : 'Category',
        'subcategory' => $isArabic ? 'التصنيف الفرعي' : 'Subcategory',
        'brand' => $isArabic ? 'العلامة التجارية' : 'Brand',
        'product_type' => $isArabic ? 'نوع المنتج' : 'Product Type',
        'features' => $isArabic ? 'المميزات' : 'Features',
        'good_to_know' => $isArabic ? 'معلومات مهمة' : 'Good to know',
        'delivery' => $isArabic ? 'التوصيل' : 'Delivery',
        'delivery_info' => $isArabic
            ? 'معلومات التوصيل يتم تحديدها من قبل البائع.'
            : 'Delivery information is provided by the seller.',
        'secure_checkout' => $isArabic ? 'دفع آمن' : 'Secure checkout',
        'secure_checkout_info' => $isArabic
            ? 'أكمل عملية الشراء من خلال صفحة الدفع الآمنة.'
            : 'Complete your purchase through our secure checkout.',
        'marketplace_seller' => $isArabic ? 'بائع في المنصة' : 'Marketplace seller',
        'marketplace_seller_info' => $isArabic
            ? 'هذا المنتج مقدم من بائع مستقل في المنصة.'
            : 'This product is supplied by an independent marketplace seller.',
        'customer_reviews' => $isArabic ? 'تقييمات العملاء' : 'Customer Reviews',
        'customer_reviews_description' => $isArabic
            ? 'آراء العملاء حول هذا المنتج.'
            : 'What customers say about this product.',
        'based_on' => $isArabic ? 'بناءً على' : 'Based on',
        'no_reviews' => $isArabic ? 'لا توجد تقييمات بعد' : 'No reviews yet',
        'first_review' => $isArabic
            ? 'كن أول عميل يقوم بتقييم هذا المنتج.'
            : 'Be the first customer to review this product.',
        'write_review' => $isArabic ? 'اكتب تقييمًا' : 'Write a Review',
        'write_review_description' => $isArabic
            ? 'شارك تجربتك مع العملاء الآخرين.'
            : 'Share your experience with other customers.',
        'rating' => $isArabic ? 'التقييم' : 'Rating',
        'your_review' => $isArabic ? 'تقييمك' : 'Your review',
        'submit_review' => $isArabic ? 'إرسال التقييم' : 'Submit Review',
        'click_image' => $isArabic ? 'اضغط على الصورة لعرضها' : 'Click an image to view it',
        'no_product_image' => $isArabic ? 'لا توجد صورة للمنتج' : 'No product image',
        'excellent' => $isArabic ? 'ممتاز' : 'Excellent',
        'very_good' => $isArabic ? 'جيد جدًا' : 'Very Good',
        'good' => $isArabic ? 'جيد' : 'Good',
        'fair' => $isArabic ? 'مقبول' : 'Fair',
        'poor' => $isArabic ? 'ضعيف' : 'Poor',
    ];
@endphp

<x-main-layout>

    @section('title', $title ?? $listing->title)

    @section('description', $description ?? $productDescription)

    @section('keywords', implode(', ', $keywords ?? array_filter([$categoryName, $subcategoryName, $brandName,
        $listing->title, $listing->sku])))

    @section('og:title', $listing->title)
    @section('og:description', $productDescription)
    @section('og:image', $productImage)

    @section('twitter:title', $listing->title)
    @section('twitter:description', $productDescription)
    @section('twitter:image', $productImage)

    <x-slot name="header">
        <x-main-header />
    </x-slot>

    {{-- ================================================================ --}}
    {{-- PAGE --}}
    {{-- ================================================================ --}}

    <div dir="{{ $direction }}" lang="{{ app()->getLocale() }}"
        class="min-h-screen bg-white text-gray-900 dark:bg-neutral-950 dark:text-white">

        {{-- ============================================================ --}}
        {{-- BREADCRUMB --}}
        {{-- ============================================================ --}}

        <div class="border-b border-gray-200 bg-white dark:border-neutral-800 dark:bg-neutral-900">

            <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">

                <div class="flex flex-wrap items-center gap-2 text-sm text-gray-500 dark:text-gray-400">

                    <a href="{{ url('/') }}" class="transition hover:text-orange-600">
                        {{ $labels['home'] }}
                    </a>

                    @if ($categoryName)
                        <span>/</span>

                        <a href="#" class="transition hover:text-orange-600">
                            {{ $categoryName }}
                        </a>
                    @endif

                    @if ($subcategoryName)
                        <span>/</span>

                        <span class="transition hover:text-orange-600">
                            {{ $subcategoryName }}
                        </span>
                    @endif

                    @if ($brandName)
                        <span>/</span>

                        <span class="transition hover:text-orange-600">
                            {{ $brandName }}
                        </span>
                    @endif

                    <span>/</span>

                    <span class="truncate text-gray-900 dark:text-white">
                        {{ $listing->title }}
                    </span>

                </div>

            </div>

        </div>


        {{-- ============================================================ --}}
        {{-- MAIN --}}
        {{-- ============================================================ --}}

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">

            {{-- ======================================================== --}}
            {{-- PRODUCT --}}
            {{-- ======================================================== --}}

            <div class="grid gap-10 lg:grid-cols-2">


                {{-- ==================================================== --}}
                {{-- MEDIA --}}
                {{-- ==================================================== --}}

                <div>

                    <div class="lg:sticky lg:top-6">

                        <div class="grid gap-4 md:grid-cols-[88px_1fr]">


                            {{-- ================================================= --}}
                            {{-- THUMBNAILS --}}
                            {{-- ================================================= --}}

                            <div class="order-2 flex gap-3 overflow-x-auto md:order-1 md:flex-col">

                                @if ($listing->image)
                                    <button type="button"
                                        onclick="showProductImage('{{ Storage::url('products/' . $listing->image) }}')"
                                        class="product-thumbnail shrink-0 overflow-hidden rounded-xl border-2 border-orange-500 bg-white dark:bg-neutral-900">

                                        <img src="{{ Storage::url('products/' . $listing->image) }}"
                                            class="h-20 w-20 object-cover" alt="{{ $listing->title }}">

                                    </button>
                                @endif


                                @foreach ($listing->images ?? [] as $image)
                                    @if ($image)
                                        <button type="button"
                                            onclick="showProductImage('{{ Storage::url('products/' . $image) }}')"
                                            class="product-thumbnail shrink-0 overflow-hidden rounded-xl border-2 border-gray-200 bg-white transition hover:border-orange-500 dark:border-neutral-700 dark:bg-neutral-900">

                                            <img src="{{ Storage::url('products/' . $image) }}"
                                                class="h-20 w-20 object-cover" alt="{{ $listing->title }}">

                                        </button>
                                    @endif
                                @endforeach


                                @if ($listing->video)
                                    <button type="button" onclick="showProductVideo()"
                                        class="flex h-20 w-20 shrink-0 items-center justify-center rounded-xl border-2 border-gray-200 bg-black text-white transition hover:border-orange-500 dark:border-neutral-700">

                                        <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>

                                    </button>
                                @endif

                            </div>


                            {{-- ================================================= --}}
                            {{-- MAIN VIEWER --}}
                            {{-- ================================================= --}}

                            <div
                                class="relative order-1 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-neutral-800 dark:bg-neutral-900 md:order-2">

                                {{-- Availability --}}

                                <div class="absolute left-5 top-5 z-10">

                                    @if ($isAvailable)
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow">

                                            <span class="h-2 w-2 rounded-full bg-white"></span>

                                            {{ $labels['available'] }}

                                        </span>
                                    @else
                                        <span
                                            class="rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow">
                                            {{ $labels['out_of_stock'] }}
                                        </span>
                                    @endif

                                </div>


                                {{-- Main image --}}

                                @if ($listing->image)
                                    <img id="mainProductImage" src="{{ Storage::url('products/' . $listing->image) }}"
                                        alt="{{ $listing->title }}"
                                        class="h-[520px] w-full cursor-zoom-in object-contain bg-white p-4 transition dark:bg-neutral-900 sm:h-[600px]">
                                @else
                                    <div
                                        class="flex h-[520px] items-center justify-center bg-gray-100 dark:bg-neutral-800">

                                        <div class="text-center">

                                            <div class="text-7xl">
                                                📦
                                            </div>

                                            <p class="mt-3 text-gray-500">
                                                {{ $labels['no_product_image'] }}
                                            </p>

                                        </div>

                                    </div>
                                @endif


                                {{-- Video --}}

                                @if ($listing->video)
                                    <video id="mainProductVideo" controls
                                        class="hidden h-[520px] w-full bg-black object-contain sm:h-[600px]">

                                        <source src="{{ Storage::url('products/videos/' . $listing->video) }}"
                                            type="video/mp4">

                                    </video>
                                @endif

                            </div>

                        </div>


                        <p class="mt-3 text-center text-sm text-gray-500 dark:text-gray-400">
                            {{ $labels['click_image'] }}
                        </p>

                    </div>

                </div>


                {{-- ==================================================== --}}
                {{-- PRODUCT INFORMATION --}}
                {{-- ==================================================== --}}

                <div>


                    {{-- BRAND --}}

                    @if ($brandName)
                        <div class="mb-3">

                            <span class="text-sm font-semibold uppercase tracking-wide text-orange-600">
                                {{ $brandName }}
                            </span>

                        </div>
                    @endif


                    {{-- TITLE --}}

                    <h1 class="text-3xl font-black tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                        {{ $listing->title }}
                    </h1>


                    {{-- SKU / CATEGORY / SUBCATEGORY --}}

                    <div class="mt-3 flex flex-wrap items-center gap-3 text-sm text-gray-500 dark:text-gray-400">

                        @if ($listing->sku)
                            <span>
                                {{ $labels['sku'] }}: {{ $listing->sku }}
                            </span>
                        @endif


                        @if ($categoryName)
                            <span>•</span>

                            <span>
                                {{ $categoryName }}
                            </span>
                        @endif


                        @if ($subcategoryName)
                            <span>•</span>

                            <span>
                                {{ $subcategoryName }}
                            </span>
                        @endif

                    </div>


                    {{-- RATING --}}

                    <div class="mt-5 flex flex-wrap items-center gap-3">

                        <div class="text-lg text-yellow-400">
                            ★★★★★
                        </div>

                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $listing->reviews?->count() ?? 0 }}
                            {{ $labels['reviews'] }}
                        </span>

                    </div>


                    {{-- PRICE --}}

                    <div
                        class="mt-6 rounded-2xl border border-gray-200 bg-white p-5 dark:border-neutral-800 dark:bg-neutral-900">

                        <div class="flex flex-wrap items-end gap-3">

                            <span class="text-4xl font-black text-gray-900 dark:text-white">

                                {{ $currency }}
                                {{ number_format($listing->price, 2) }}

                            </span>


                            @if ($listing->price_condition)
                                <span
                                    class="mb-1 rounded-full bg-gray-100 px-3 py-1 text-sm text-gray-600 dark:bg-neutral-800 dark:text-gray-300">
                                    {{ ucfirst($listing->price_condition) }}
                                </span>
                            @endif

                        </div>

                    </div>


                    {{-- DESCRIPTION --}}

                    <div class="mt-7">

                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                            {{ $labels['about_product'] }}
                        </h2>

                        <div class="mt-3 leading-7 text-gray-600 dark:text-gray-300">
                            {!! nl2br(e($listing->description)) !!}
                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- DIGITAL PRODUCT --}}
                    {{-- ================================================= --}}

                    @if ($listing->product_type === 'digital' || $listing->digital_file)

                        <div
                            class="mt-7 rounded-2xl border border-purple-200 bg-purple-50 p-5 dark:border-purple-900/50 dark:bg-purple-950/30">

                            <div class="flex gap-4">

                                <div
                                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-purple-600 text-white">

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                    </svg>

                                </div>


                                <div>

                                    <h3 class="font-bold text-purple-900 dark:text-purple-200">
                                        {{ $labels['digital_product'] }}
                                    </h3>

                                    <p class="mt-1 text-sm text-purple-700 dark:text-purple-300">
                                        {{ $labels['digital_delivery'] }}
                                    </p>

                                </div>

                            </div>


                            <a href="{{ route('digital-products.show', $listing->slug) }}"
                                class="mt-5 block rounded-xl bg-purple-600 px-6 py-4 text-center font-bold text-white transition hover:bg-purple-700">
                                {{ $labels['buy_download'] }}
                            </a>

                        </div>
                    @else
                        {{-- ================================================= --}}
                        {{-- QUANTITY --}}
                        {{-- ================================================= --}}

                        @if (($listing->quantity ?? 0) > 0)
                            <div class="mt-7">

                                <label class="text-sm font-bold text-gray-900 dark:text-white">
                                    {{ $labels['quantity'] }}
                                </label>


                                <div
                                    class="mt-2 inline-flex items-center overflow-hidden rounded-xl border border-gray-300 bg-white dark:border-neutral-700 dark:bg-neutral-900">

                                    <button type="button" onclick="changeQuantity(-1)"
                                        class="h-12 w-12 text-xl hover:bg-gray-100 dark:hover:bg-neutral-800">
                                        −
                                    </button>


                                    <input id="productQuantity" type="number" value="1" min="1"
                                        max="{{ $listing->quantity }}"
                                        class="h-12 w-16 border-x border-gray-200 bg-transparent text-center font-bold outline-none dark:border-neutral-700 dark:text-white">


                                    <button type="button" onclick="changeQuantity(1)"
                                        class="h-12 w-12 text-xl hover:bg-gray-100 dark:hover:bg-neutral-800">
                                        +
                                    </button>

                                </div>


                                <p class="mt-2 text-sm text-gray-500">
                                    {{ $listing->quantity }}
                                    {{ $labels['available_quantity'] }}
                                </p>

                            </div>
                        @endif


                        {{-- ADD TO CART --}}

                        <div class="mt-6">

                            <livewire:add-to-cart :listing="$listing" />

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- SELLER --}}
                    {{-- ================================================= --}}

                    @if ($listing->shop)

                        <div
                            class="mt-7 rounded-2xl border border-gray-200 bg-white p-5 dark:border-neutral-800 dark:bg-neutral-900">

                            <div class="flex items-center gap-4">

                                @if ($listing->shop->logo)
                                    <img src="{{ Storage::disk('public')->url($listing->shop->logo) }}"
                                        class="h-14 w-14 rounded-full object-cover" alt="{{ $shopName }}">
                                @else
                                    <div
                                        class="flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-orange-500 to-pink-500 text-xl font-bold text-white">
                                        {{ strtoupper(substr($shopName, 0, 1)) }}
                                    </div>
                                @endif


                                <div class="flex-1">

                                    <p class="text-xs uppercase tracking-wide text-gray-500">
                                        {{ $labels['sold_by'] }}
                                    </p>


                                    <a href="{{ route('shop', $listing->shop->slug) }}"
                                        class="font-bold text-gray-900 hover:text-orange-600 dark:text-white">
                                        {{ $shopName }}
                                    </a>

                                </div>

                            </div>


                            <div class="mt-5 grid gap-3 sm:grid-cols-2">

                                @if ($listing->shop->allow_whatsapp && $listing->shop->whatsapp)
                                    <a href="https://wa.me/{{ preg_replace('/\D+/', '', $listing->shop->whatsapp) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="rounded-xl bg-green-600 px-4 py-3 text-center font-semibold text-white transition hover:bg-green-700">
                                        {{ $labels['whatsapp_seller'] }}
                                    </a>
                                @endif


                                @if ($listing->shop->phone)
                                    <a href="tel:{{ $listing->shop->phone }}"
                                        class="rounded-xl bg-blue-600 px-4 py-3 text-center font-semibold text-white transition hover:bg-blue-700">
                                        {{ $labels['call_seller'] }}
                                    </a>
                                @endif

                            </div>

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- WISHLIST --}}
                    {{-- ================================================= --}}

                    @auth

                        <form method="POST" action="{{ route('wishlist.add', $listing) }}" class="mt-4">

                            @csrf

                            <button type="submit"
                                class="w-full rounded-xl border px-5 py-3 font-semibold transition
                                {{ $inWishlist
                                    ? 'border-red-200 bg-red-50 text-red-600 dark:border-red-900 dark:bg-red-950/30'
                                    : 'border-gray-300 bg-white text-gray-700 hover:border-orange-500 hover:text-orange-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-200' }}">
                                {{ $inWishlist ? $labels['wishlist_added'] : $labels['add_wishlist'] }}
                            </button>

                        </form>

                    @endauth


                    {{-- ================================================= --}}
                    {{-- TRUST --}}
                    {{-- ================================================= --}}

                    <div class="mt-6 grid gap-3 sm:grid-cols-3">

                        <div class="rounded-xl bg-gray-100 p-4 text-center dark:bg-neutral-900">

                            <div class="text-xl">
                                🔒
                            </div>

                            <p class="mt-1 text-xs font-semibold text-gray-700 dark:text-gray-300">
                                {{ $labels['secure_payment'] }}
                            </p>

                        </div>


                        <div class="rounded-xl bg-gray-100 p-4 text-center dark:bg-neutral-900">

                            <div class="text-xl">
                                ✓
                            </div>

                            <p class="mt-1 text-xs font-semibold text-gray-700 dark:text-gray-300">
                                {{ $labels['trusted_seller'] }}
                            </p>

                        </div>


                        <div class="rounded-xl bg-gray-100 p-4 text-center dark:bg-neutral-900">

                            <div class="text-xl">
                                ⚡
                            </div>

                            <p class="mt-1 text-xs font-semibold text-gray-700 dark:text-gray-300">
                                {{ $labels['fast_delivery'] }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ======================================================== --}}
            {{-- PRODUCT DETAILS --}}
            {{-- ======================================================== --}}

            <div class="mt-14 grid gap-8 lg:grid-cols-3">


                {{-- DETAILS --}}

                <div
                    class="rounded-3xl border border-gray-200 bg-white p-7 dark:border-neutral-800 dark:bg-neutral-900 lg:col-span-2">

                    <h2 class="text-2xl font-black text-gray-900 dark:text-white">
                        {{ $labels['product_details'] }}
                    </h2>


                    <div class="mt-6 divide-y divide-gray-200 dark:divide-neutral-800">


                        @if ($listing->sku)
                            <div class="flex justify-between gap-6 py-4">

                                <span class="text-gray-500">
                                    {{ $labels['sku'] }}
                                </span>

                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ $listing->sku }}
                                </span>

                            </div>
                        @endif


                        @if ($categoryName)
                            <div class="flex justify-between gap-6 py-4">

                                <span class="text-gray-500">
                                    {{ $labels['category'] }}
                                </span>

                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ $categoryName }}
                                </span>

                            </div>
                        @endif


                        @if ($subcategoryName)
                            <div class="flex justify-between gap-6 py-4">

                                <span class="text-gray-500">
                                    {{ $labels['subcategory'] }}
                                </span>

                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ $subcategoryName }}
                                </span>

                            </div>
                        @endif


                        @if ($brandName)
                            <div class="flex justify-between gap-6 py-4">

                                <span class="text-gray-500">
                                    {{ $labels['brand'] }}
                                </span>

                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ $brandName }}
                                </span>

                            </div>
                        @endif


                        @if ($sectionName)
                            <div class="flex justify-between gap-6 py-4">

                                <span class="text-gray-500">
                                    {{ $labels['product_type'] }}
                                </span>

                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ $sectionName }}
                                </span>

                            </div>
                        @endif

                    </div>


                    {{-- FEATURES --}}

                    @if (!empty($listing->features))

                        <div class="mt-8">

                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                {{ $labels['features'] }}
                            </h3>


                            <div class="mt-4 grid gap-3 sm:grid-cols-2">

                                @foreach ($listing->features as $feature)
                                    @php
                                        /*
                                        |--------------------------------------------------------------------------
                                        | Feature can be:
                                        | - simple string
                                        | - array/object with English + Arabic values
                                        |--------------------------------------------------------------------------
                                        */

                                        if (is_array($feature)) {
                                            $featureText = $isArabic
                                                ? $feature['name_ar'] ??
                                                    ($feature['feature_ar'] ??
                                                        ($feature['name'] ?? ($feature['feature'] ?? '')))
                                                : $feature['name'] ?? ($feature['feature'] ?? '');
                                        } elseif (is_object($feature)) {
                                            $featureText = $isArabic
                                                ? $feature->name_ar ??
                                                    ($feature->feature_ar ??
                                                        ($feature->name ?? ($feature->feature ?? '')))
                                                : $feature->name ?? ($feature->feature ?? '');
                                        } else {
                                            $featureText = $feature;
                                        }
                                    @endphp

                                    @if ($featureText)
                                        <div class="flex gap-3 rounded-xl bg-gray-50 p-4 dark:bg-neutral-800">

                                            <span class="text-green-600">
                                                ✓
                                            </span>

                                            <span class="text-gray-700 dark:text-gray-300">
                                                {{ $featureText }}
                                            </span>

                                        </div>
                                    @endif
                                @endforeach

                            </div>

                        </div>

                    @endif

                </div>


                {{-- GOOD TO KNOW --}}

                <div
                    class="rounded-3xl border border-gray-200 bg-white p-7 dark:border-neutral-800 dark:bg-neutral-900">

                    <h2 class="text-xl font-black text-gray-900 dark:text-white">
                        {{ $labels['good_to_know'] }}
                    </h2>


                    <div class="mt-6 space-y-5">


                        <div class="flex gap-4">

                            <span class="text-2xl">
                                🚚
                            </span>

                            <div>

                                <h3 class="font-bold text-gray-900 dark:text-white">
                                    {{ $labels['delivery'] }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $labels['delivery_info'] }}
                                </p>

                            </div>

                        </div>


                        <div class="flex gap-4">

                            <span class="text-2xl">
                                💳
                            </span>

                            <div>

                                <h3 class="font-bold text-gray-900 dark:text-white">
                                    {{ $labels['secure_checkout'] }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $labels['secure_checkout_info'] }}
                                </p>

                            </div>

                        </div>


                        <div class="flex gap-4">

                            <span class="text-2xl">
                                🛍️
                            </span>

                            <div>

                                <h3 class="font-bold text-gray-900 dark:text-white">
                                    {{ $labels['marketplace_seller'] }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $labels['marketplace_seller_info'] }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ======================================================== --}}
            {{-- REVIEWS --}}
            {{-- ======================================================== --}}

            <section class="mt-14">

                <div class="mb-7">

                    <h2 class="text-2xl font-black text-gray-900 dark:text-white">
                        {{ $labels['customer_reviews'] }}
                    </h2>

                    <p class="mt-1 text-gray-500">
                        {{ $labels['customer_reviews_description'] }}
                    </p>

                </div>


                <div class="grid gap-6 lg:grid-cols-3">


                    {{-- SUMMARY --}}

                    <div
                        class="rounded-3xl border border-gray-200 bg-white p-7 dark:border-neutral-800 dark:bg-neutral-900">

                        <div class="text-5xl font-black text-gray-900 dark:text-white">
                            {{ number_format($listing->reviews?->avg('rating') ?? 0, 1) }}
                        </div>


                        <div class="mt-2 text-xl text-yellow-400">
                            ★★★★★
                        </div>


                        <p class="mt-2 text-sm text-gray-500">

                            {{ $labels['based_on'] }}
                            {{ $listing->reviews?->count() ?? 0 }}
                            {{ $labels['reviews'] }}

                        </p>

                    </div>


                    {{-- REVIEWS --}}

                    <div class="space-y-4 lg:col-span-2">

                        @forelse ($listing->reviews as $review)

                            <article
                                class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-neutral-800 dark:bg-neutral-900">

                                <div class="flex items-start justify-between gap-4">

                                    <div>

                                        <h3 class="font-bold text-gray-900 dark:text-white">
                                            {{ $review->user->name ?? ($isArabic ? 'عميل' : 'Customer') }}
                                        </h3>

                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ $review->created_at->diffForHumans() }}
                                        </p>

                                    </div>


                                    <div class="text-yellow-400">

                                        @for ($i = 1; $i <= 5; $i++)
                                            {{ $i <= $review->rating ? '★' : '☆' }}
                                        @endfor

                                    </div>

                                </div>


                                @if ($review->comment)
                                    <p class="mt-4 leading-7 text-gray-600 dark:text-gray-300">
                                        {{ $review->comment }}
                                    </p>
                                @endif

                            </article>

                        @empty

                            <div
                                class="rounded-2xl border border-dashed border-gray-300 p-10 text-center dark:border-neutral-700">

                                <div class="text-4xl">
                                    💬
                                </div>

                                <h3 class="mt-3 font-bold text-gray-900 dark:text-white">
                                    {{ $labels['no_reviews'] }}
                                </h3>

                                <p class="mt-1 text-gray-500">
                                    {{ $labels['first_review'] }}
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

            </section>


            {{-- ======================================================== --}}
            {{-- WRITE REVIEW --}}
            {{-- ======================================================== --}}

            @auth

                <section
                    class="mt-12 rounded-3xl border border-gray-200 bg-white p-7 dark:border-neutral-800 dark:bg-neutral-900">

                    <h2 class="text-2xl font-black text-gray-900 dark:text-white">
                        {{ $labels['write_review'] }}
                    </h2>

                    <p class="mt-1 text-gray-500">
                        {{ $labels['write_review_description'] }}
                    </p>


                    <form method="POST" action="{{ route('review.store', $listing) }}" class="mt-6 max-w-2xl">

                        @csrf


                        <label class="text-sm font-bold text-gray-900 dark:text-white">
                            {{ $labels['rating'] }}
                        </label>


                        <select name="rating"
                            class="mt-2 w-full rounded-xl border-gray-300 bg-white dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">

                            <option value="5">
                                ★★★★★ — {{ $labels['excellent'] }}
                            </option>

                            <option value="4">
                                ★★★★☆ — {{ $labels['very_good'] }}
                            </option>

                            <option value="3">
                                ★★★☆☆ — {{ $labels['good'] }}
                            </option>

                            <option value="2">
                                ★★☆☆☆ — {{ $labels['fair'] }}
                            </option>

                            <option value="1">
                                ★☆☆☆☆ — {{ $labels['poor'] }}
                            </option>

                        </select>


                        <label class="mt-5 block text-sm font-bold text-gray-900 dark:text-white">
                            {{ $labels['your_review'] }}
                        </label>


                        <textarea name="comment" rows="5"
                            class="mt-2 w-full rounded-xl border-gray-300 bg-white dark:border-neutral-700 dark:bg-neutral-900 dark:text-white"
                            placeholder="{{ $labels['your_review'] }}"></textarea>


                        <button type="submit"
                            class="mt-4 rounded-xl bg-orange-600 px-7 py-3 font-bold text-white transition hover:bg-orange-700">
                            {{ $labels['submit_review'] }}
                        </button>

                    </form>

                </section>

            @endauth

        </main>

    </div>


    {{-- ================================================================ --}}
    {{-- JAVASCRIPT --}}
    {{-- ================================================================ --}}

    <script>
        function showProductImage(src) {

            const image = document.getElementById('mainProductImage');
            const video = document.getElementById('mainProductVideo');

            if (!image) {
                return;
            }

            image.src = src;

            image.classList.remove('hidden');

            if (video) {

                video.pause();
                video.classList.add('hidden');

            }

        }


        function showProductVideo() {

            const image = document.getElementById('mainProductImage');
            const video = document.getElementById('mainProductVideo');

            if (!video) {
                return;
            }

            if (image) {
                image.classList.add('hidden');
            }

            video.classList.remove('hidden');

            video.load();

        }


        function changeQuantity(amount) {

            const input = document.getElementById('productQuantity');

            if (!input) {
                return;
            }

            let value = parseInt(input.value || 1);

            const min = parseInt(input.min || 1);

            const max = parseInt(input.max || 999999);

            value += amount;

            if (value < min) {
                value = min;
            }

            if (value > max) {
                value = max;
            }

            input.value = value;

            /*
            |--------------------------------------------------------------------------
            | Notify Livewire / other listeners
            |--------------------------------------------------------------------------
            */

            input.dispatchEvent(new Event('input', {
                bubbles: true
            }));

            input.dispatchEvent(new Event('change', {
                bubbles: true
            }));

        }
    </script>


    {{-- ================================================================ --}}
    {{-- PRODUCT SCHEMA --}}
    {{-- ================================================================ --}}

    @push('schema')
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@type": "Product",

            "name": {!! json_encode($listing->title, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!},

            "description": @json(strip_tags($listing->description ?? '')),

            "url": {!! json_encode($productUrl, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!},

            "image": [
                {!! json_encode($productImage, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!}
            ],

            "sku": {!! json_encode($listing->sku, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!},

            @if ($brandName)
            "brand": {
                "@type": "Brand",
                "name": {!! json_encode($brandName, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!}
            },
            @endif

            @if ($categoryName)
            "category": {!! json_encode($categoryName, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!},
            @endif

            "offers": {
                "@type": "Offer",

                "url": {!! json_encode($productUrl, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!},

                "price": "{{ number_format($listing->price, 2, '.', '') }}",

                "priceCurrency": {!! json_encode($currency, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!},

                "availability": "{{ $isAvailable
                    ? 'https://schema.org/InStock'
                    : 'https://schema.org/OutOfStock' }}",

                "itemCondition": "https://schema.org/NewCondition"
            }

            @if (($listing->reviews?->count() ?? 0) > 0)
            ,

            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "{{ number_format($listing->reviews->avg('rating'), 1) }}",
                "reviewCount": "{{ $listing->reviews->count() }}"
            }
            @endif
        }
        </script>
    @endpush


    <x-main-footer />

</x-main-layout>
