@php
    $isArabic = app()->getLocale() === 'ar';

    /*
    |--------------------------------------------------------------------------
    | Localized Search Data
    |--------------------------------------------------------------------------
    */

    $labels = [
        'search_placeholder' => $isArabic
            ? 'ابحث عن المنتجات والمتاجر والمنتجات الرقمية...'
            : 'Search listings, shops, digital products...',

        'marketplace_listings' => $isArabic ? 'منتجات السوق' : 'Marketplace Listings',

        'digital_products' => $isArabic ? 'المنتجات الرقمية' : 'Digital Products',

        'results' => $isArabic ? 'نتيجة' : 'Results',

        'product' => $isArabic ? 'منتج' : 'Product',

        'products' => $isArabic ? 'منتجات' : 'Products',

        'listing' => $isArabic ? 'إعلان' : 'Listing',

        'digital' => $isArabic ? 'رقمي' : 'Digital',

        'pod' => $isArabic ? 'طباعة عند الطلب' : 'POD',

        'price' => $isArabic ? 'السعر' : 'Price',

        'view' => $isArabic ? 'عرض' : 'View',

        'no_listings' => $isArabic ? 'لا توجد منتجات في السوق' : 'No marketplace listings found',

        'no_listings_text' => $isArabic
            ? 'لم يتم العثور على أي منتجات تطابق بحثك حالياً.'
            : 'No marketplace listings matched your search.',

        'no_digital' => $isArabic ? 'لا توجد منتجات رقمية' : 'No digital products found',

        'no_digital_text' => $isArabic
            ? 'لم يتم العثور على أي منتجات رقمية تطابق بحثك حالياً.'
            : 'No digital products matched your search.',

        'nothing_matched' => $isArabic ? 'لم يتم العثور على نتائج' : 'Nothing matched your search',

        'nothing_matched_text' => $isArabic
            ? 'لم نتمكن من العثور على منتجات أو إعلانات تطابق'
            : 'No listings or digital products matched',

        'search_web' => $isArabic ? 'البحث على الويب' : 'Search the Web',

        'marketplace' => $isArabic ? 'سوق مُروَّج.كم' : 'murwaj Marketplace',

        'explore' => $isArabic ? 'استكشف المنتجات والخدمات' : 'Explore products and services',

        'search_results' => $isArabic ? 'نتائج البحث' : 'Search Results',

        'shop' => $isArabic ? 'المتجر' : 'Shop',

        'seller' => $isArabic ? 'البائع' : 'Seller',

        'supplier' => $isArabic ? 'المورد' : 'Supplier',
    ];

    /*
    |--------------------------------------------------------------------------
    | Direction
    |--------------------------------------------------------------------------
    */

    $direction = $isArabic ? 'rtl' : 'ltr';
@endphp


<div dir="{{ $direction }}" class="min-h-screen bg-slate-50 dark:bg-slate-950">

    {{-- =============================================================== --}}
    {{-- HERO / SEARCH --}}
    {{-- =============================================================== --}}

    <section class="relative overflow-hidden">

        {{-- Background --}}
        <div
            class="absolute inset-0 bg-gradient-to-br
            from-orange-50 via-white to-amber-50
            dark:from-slate-950 dark:via-slate-950 dark:to-orange-950/20">
        </div>

        <div class="absolute -right-32 -top-32 h-80 w-80 rounded-full
            bg-orange-400/10 blur-3xl">
        </div>

        <div class="absolute -bottom-32 -left-32 h-80 w-80 rounded-full
            bg-amber-400/10 blur-3xl">
        </div>


        <div class="relative mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

            {{-- Marketplace badge --}}
            <div class="mb-5 flex flex-wrap items-center gap-3">

                <span
                    class="inline-flex items-center gap-2 rounded-full
                    bg-orange-100 px-3.5 py-2
                    text-xs font-black uppercase tracking-wider
                    text-orange-700
                    dark:bg-orange-500/10 dark:text-orange-400">

                    <span class="h-2 w-2 rounded-full bg-orange-500"></span>

                    {{ $labels['marketplace'] }}

                </span>

                <span class="text-sm font-medium text-slate-400">
                    🇦🇪
                    {{ $isArabic ? 'دبي · أبوظبي · الشارقة · الإمارات' : 'Dubai · Abu Dhabi · Sharjah · UAE' }}
                </span>

            </div>


            {{-- Heading --}}
            <div class="max-w-3xl">

                <h1
                    class="text-3xl font-black tracking-tight
                    text-slate-900 dark:text-white
                    sm:text-4xl lg:text-5xl">

                    {{ $isArabic ? 'ابحث في سوق مُروَّج.كم' : 'Search the Murwaj Marketplace' }}

                    <span class="text-orange-500">
                        {{ $isArabic ? 'واكتشف المزيد' : 'Discover More' }}
                    </span>

                </h1>

                <p class="mt-4 max-w-2xl text-base leading-7
                    text-slate-600 dark:text-slate-400">

                    {{ $isArabic
                        ? 'اكتشف المنتجات والخدمات والمتاجر والمنتجات الرقمية من البائعين والمبدعين في الإمارات.'
                        : 'Discover products, services, shops and digital products from sellers and creators across the UAE.' }}

                </p>

            </div>


            {{-- Search --}}
            <div class="mt-8 max-w-4xl">

                <div
                    class="flex flex-col gap-3 rounded-2xl
                    border border-slate-200 bg-white p-2
                    shadow-xl shadow-slate-200/50
                    sm:flex-row
                    dark:border-slate-800
                    dark:bg-slate-900
                    dark:shadow-black/20">

                    <div class="relative flex-1">

                        <div
                            class="pointer-events-none absolute inset-y-0
                            {{ $isArabic ? 'right-0 pr-4' : 'left-0 pl-4' }}
                            flex items-center text-slate-400">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z" />

                            </svg>

                        </div>


                        <input wire:model.live.debounce.500ms="search" type="search"
                            placeholder="{{ $labels['search_placeholder'] }}" autocomplete="off"
                            class="w-full rounded-xl border-0
                            bg-slate-50 py-3.5
                            {{ $isArabic ? 'pr-12 pl-4 text-right' : 'pl-12 pr-4 text-left' }}
                            text-slate-900 outline-none
                            placeholder:text-slate-400
                            focus:ring-4 focus:ring-orange-500/10
                            dark:bg-slate-950
                            dark:text-white
                            dark:placeholder:text-slate-500">

                    </div>

                </div>

            </div>


            {{-- Quick information --}}
            <div
                class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-3
                text-sm text-slate-500 dark:text-slate-400">

                <div class="flex items-center gap-2">
                    <span class="text-orange-500">✓</span>
                    {{ $isArabic ? 'بائعون من الإمارات' : 'UAE-based sellers' }}
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-orange-500">✓</span>
                    {{ $isArabic ? 'منتجات رقمية' : 'Digital products' }}
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-orange-500">✓</span>
                    {{ $isArabic ? 'سوق محلي موثوق' : 'Trusted local marketplace' }}
                </div>

            </div>

        </div>

    </section>


    {{-- =============================================================== --}}
    {{-- SEARCH RESULTS --}}
    {{-- =============================================================== --}}

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">


        {{-- =========================================================== --}}
        {{-- MARKETPLACE LISTINGS --}}
        {{-- =========================================================== --}}

        <section class="mb-14">

            <div class="mb-7 flex flex-col gap-4
                sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <div
                        class="mb-2 inline-flex items-center gap-2
                        text-xs font-black uppercase tracking-wider
                        text-orange-500">

                        <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>

                        {{ $labels['marketplace'] }}

                    </div>

                    <h2
                        class="text-2xl font-black tracking-tight
                        text-slate-900 dark:text-white sm:text-3xl">

                        {{ $labels['marketplace_listings'] }}

                    </h2>

                    <p class="mt-1 text-sm text-slate-500
                        dark:text-slate-400">

                        {{ $isArabic
                            ? 'تصفح أحدث المنتجات والإعلانات المتاحة في السوق.'
                            : 'Browse the latest products and listings available in the marketplace.' }}

                    </p>

                </div>


                <div
                    class="inline-flex w-fit items-center rounded-full
                    bg-white px-4 py-2
                    text-sm font-semibold text-slate-500
                    shadow-sm ring-1 ring-slate-200
                    dark:bg-slate-900
                    dark:text-slate-400
                    dark:ring-slate-800">

                    <span class="me-2 font-black text-orange-500">
                        {{ $listings->total() }}
                    </span>

                    {{ $labels['results'] }}

                </div>

            </div>


            @if ($listings->count())

                <div
                    class="grid gap-6
                    sm:grid-cols-2
                    lg:grid-cols-3
                    xl:grid-cols-4">

                    @foreach ($listings as $listing)
                        <article
                            class="group relative overflow-hidden
                            rounded-[1.75rem]
                            border border-slate-200
                            bg-white shadow-sm
                            transition-all duration-300
                            hover:-translate-y-1
                            hover:border-orange-200
                            hover:shadow-2xl
                            hover:shadow-orange-500/10
                            dark:border-slate-800
                            dark:bg-slate-900
                            dark:hover:border-orange-500/30">


                            {{-- Orange top border --}}
                            <div
                                class="h-1.5 bg-gradient-to-r
                                from-orange-500 via-orange-400 to-amber-400">
                            </div>


                            {{-- Image --}}
                            <a href="{{ $listing->url }}" class="block overflow-hidden">

                                <img src="{{ $listing->image ? asset('storage/products/' . $listing->image) : asset('images/no-image.png') }}"
                                    alt="{{ $listing->title }}" loading="lazy"
                                    class="h-56 w-full object-cover
                                    transition duration-500
                                    group-hover:scale-105">

                            </a>


                            <div class="p-5">


                                {{-- Title --}}
                                <h3
                                    class="line-clamp-2 text-lg font-black
                                    text-slate-900 dark:text-white">

                                    {{ $listing->title }}

                                </h3>


                                {{-- Shop --}}
                                @if ($listing->shop)
                                    <p
                                        class="mt-2 truncate text-sm
                                        font-medium text-slate-400">

                                        🏪
                                        {{ $isArabic ? ($listing->shop->name_ar ?: $listing->shop->name) : $listing->shop->name }}

                                    </p>
                                @endif


                                {{-- Price --}}
                                <div class="mt-5 flex items-center justify-between gap-3">

                                    <span
                                        class="text-2xl font-black
                                        text-orange-600 dark:text-orange-400">

                                        {{ $listing->currency ?? 'AED' }}
                                        {{ number_format((float) $listing->price, 2) }}

                                    </span>


                                    <span
                                        class="rounded-full
                                        bg-orange-50 px-3 py-1
                                        text-xs font-bold
                                        text-orange-600
                                        dark:bg-orange-500/10
                                        dark:text-orange-400">

                                        {{ $labels['listing'] }}

                                    </span>

                                </div>


                                {{-- View --}}
                                <a href="{{ $listing->url }}"
                                    class="mt-5 flex items-center
                                    justify-center gap-2
                                    text-sm font-black
                                    text-orange-500
                                    transition-all
                                    group-hover:gap-3">

                                    {{ $labels['view'] }}

                                    <svg class="h-4 w-4
                                        {{ $isArabic ? 'rotate-180' : '' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14m-5-5 5 5-5 5" />

                                    </svg>

                                </a>

                            </div>

                        </article>
                    @endforeach

                </div>


                {{-- Pagination --}}
                <div class="mt-10 flex justify-center">

                    {{ $listings->links() }}

                </div>
            @else
                <div
                    class="rounded-[2rem]
                    border border-dashed border-slate-300
                    bg-white px-6 py-16 text-center
                    dark:border-slate-700
                    dark:bg-slate-900">

                    <div
                        class="mx-auto flex h-20 w-20
                        items-center justify-center
                        rounded-2xl
                        bg-orange-100 text-4xl
                        dark:bg-orange-500/10">

                        📦

                    </div>

                    <h3 class="mt-6 text-xl font-black
                        text-slate-900 dark:text-white">

                        {{ $labels['no_listings'] }}

                    </h3>

                    <p
                        class="mx-auto mt-2 max-w-md
                        text-sm leading-6
                        text-slate-500 dark:text-slate-400">

                        {{ $labels['no_listings_text'] }}

                    </p>

                </div>

            @endif

        </section>


        {{-- =========================================================== --}}
        {{-- DIGITAL PRODUCTS --}}
        {{-- =========================================================== --}}

        <section>

            <div class="mb-7 flex flex-col gap-4
                sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <div
                        class="mb-2 inline-flex items-center gap-2
                        text-xs font-black uppercase tracking-wider
                        text-blue-500">

                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>

                        {{ $labels['digital'] }}

                    </div>

                    <h2
                        class="text-2xl font-black tracking-tight
                        text-slate-900 dark:text-white sm:text-3xl">

                        {{ $labels['digital_products'] }}

                    </h2>

                    <p class="mt-1 text-sm text-slate-500
                        dark:text-slate-400">

                        {{ $isArabic
                            ? 'اكتشف المنتجات الرقمية والمنتجات القابلة للتحميل.'
                            : 'Discover digital products and downloadable resources.' }}

                    </p>

                </div>


                <div
                    class="inline-flex w-fit items-center rounded-full
                    bg-white px-4 py-2
                    text-sm font-semibold text-slate-500
                    shadow-sm ring-1 ring-slate-200
                    dark:bg-slate-900
                    dark:text-slate-400
                    dark:ring-slate-800">

                    <span class="me-2 font-black text-blue-500">
                        {{ $digitalProducts->count() }}
                    </span>

                    {{ $labels['results'] }}

                </div>

            </div>


            @if ($digitalProducts->count())

                <div
                    class="grid gap-6
                    sm:grid-cols-2
                    lg:grid-cols-3
                    xl:grid-cols-4">

                    @foreach ($digitalProducts as $product)
                        <article
                            class="group relative overflow-hidden
                            rounded-[1.75rem]
                            border border-slate-200
                            bg-white shadow-sm
                            transition-all duration-300
                            hover:-translate-y-1
                            hover:border-blue-200
                            hover:shadow-2xl
                            hover:shadow-blue-500/10
                            dark:border-slate-800
                            dark:bg-slate-900
                            dark:hover:border-blue-500/30">


                            {{-- Blue accent --}}
                            <div
                                class="h-1.5 bg-gradient-to-r
                                from-blue-500 to-cyan-400">
                            </div>


                            {{-- Image --}}
                            <a href="{{ $product->url }}" class="block overflow-hidden">

                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}"
                                    alt="{{ $product->title }}" loading="lazy"
                                    class="h-56 w-full object-cover
                                    transition duration-500
                                    group-hover:scale-105">

                            </a>


                            <div class="p-5">

                                <h3
                                    class="line-clamp-2 text-lg font-black
                                    text-slate-900 dark:text-white">

                                    {{ $product->title }}

                                </h3>


                                @if ($product->supplier)
                                    <p
                                        class="mt-2 truncate text-sm
                                        font-medium text-slate-400">

                                        🏢
                                        {{ $product->supplier->company }}

                                    </p>
                                @endif


                                <div class="mt-5 flex items-center justify-between gap-3">

                                    <span
                                        class="text-2xl font-black
                                        text-orange-600
                                        dark:text-orange-400">

                                        {{ $product->currency ?? 'AED' }}
                                        {{ number_format((float) $product->price, 2) }}

                                    </span>


                                    @if ($product->type === 'digital')
                                        <span
                                            class="rounded-full
                                            bg-blue-100 px-3 py-1
                                            text-xs font-bold
                                            text-blue-700
                                            dark:bg-blue-500/10
                                            dark:text-blue-400">

                                            {{ $labels['digital'] }}

                                        </span>
                                    @else
                                        <span
                                            class="rounded-full
                                            bg-green-100 px-3 py-1
                                            text-xs font-bold
                                            text-green-700
                                            dark:bg-green-500/10
                                            dark:text-green-400">

                                            {{ $labels['pod'] }}

                                        </span>
                                    @endif

                                </div>


                                {{-- View --}}
                                <a href="{{ $product->url }}"
                                    class="mt-5 flex items-center
                                    justify-center gap-2
                                    text-sm font-black
                                    text-blue-500
                                    transition-all
                                    group-hover:gap-3">

                                    {{ $labels['view'] }}

                                    <svg class="h-4 w-4
                                        {{ $isArabic ? 'rotate-180' : '' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14m-5-5 5 5-5 5" />

                                    </svg>

                                </a>

                            </div>

                        </article>
                    @endforeach

                </div>
            @else
                <div
                    class="rounded-[2rem]
                    border border-dashed border-slate-300
                    bg-white px-6 py-16 text-center
                    dark:border-slate-700
                    dark:bg-slate-900">

                    <div
                        class="mx-auto flex h-20 w-20
                        items-center justify-center
                        rounded-2xl
                        bg-blue-100 text-4xl
                        dark:bg-blue-500/10">

                        💻

                    </div>

                    <h3 class="mt-6 text-xl font-black
                        text-slate-900 dark:text-white">

                        {{ $labels['no_digital'] }}

                    </h3>

                    <p
                        class="mx-auto mt-2 max-w-md
                        text-sm leading-6
                        text-slate-500 dark:text-slate-400">

                        {{ $labels['no_digital_text'] }}

                    </p>

                </div>

            @endif

        </section>


        {{-- =========================================================== --}}
        {{-- GLOBAL EMPTY STATE --}}
        {{-- =========================================================== --}}

        @if ($listings->total() == 0 && $digitalProducts->count() == 0)

            <section
                class="mt-16 overflow-hidden
                rounded-[2rem]
                bg-gradient-to-br
                from-orange-500 via-orange-600 to-amber-500
                p-8 text-center text-white
                shadow-2xl shadow-orange-500/20
                sm:p-14">

                <div
                    class="mx-auto flex h-20 w-20
                    items-center justify-center
                    rounded-2xl bg-white/10
                    text-5xl backdrop-blur">

                    🔍

                </div>


                <h2 class="mt-6 text-2xl font-black sm:text-3xl">

                    {{ $labels['nothing_matched'] }}

                </h2>


                @if ($search)
                    <p
                        class="mx-auto mt-3 max-w-xl
                        text-sm leading-6 text-white/80 sm:text-base">

                        {{ $labels['nothing_matched_text'] }}

                        <strong class="text-white">
                            "{{ $search }}"
                        </strong>

                    </p>
                @else
                    <p
                        class="mx-auto mt-3 max-w-xl
                        text-sm leading-6 text-white/80 sm:text-base">

                        {{ $isArabic
                            ? 'ابدأ بالبحث عن منتج أو متجر أو خدمة لاكتشاف ما يناسبك.'
                            : 'Start searching for a product, shop or service to discover what you need.' }}

                    </p>
                @endif


                @if ($globalSearchUrl)
                    <a href="{{ $globalSearchUrl }}" target="_blank" rel="noopener noreferrer"
                        class="mt-8 inline-flex items-center
                        gap-2 rounded-xl bg-white
                        px-6 py-3.5
                        font-black text-orange-600
                        shadow-xl transition
                        hover:-translate-y-0.5
                        hover:bg-orange-50">

                        {{ $labels['search_web'] }}

                        <svg class="h-5 w-5 {{ $isArabic ? 'rotate-180' : '' }}" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14m-5-5 5 5-5 5" />

                        </svg>

                    </a>
                @endif

            </section>

        @endif

    </main>

</div>
