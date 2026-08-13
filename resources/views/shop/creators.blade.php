@php
    $isArabic = app()->getLocale() === 'ar';
    $direction = $isArabic ? 'rtl' : 'ltr';

    /*
    |--------------------------------------------------------------------------
    | Localized Labels
    |--------------------------------------------------------------------------
    */

    $labels = [
        'marketplace' => $isArabic ? 'سوق الإمارات' : 'UAE Marketplace',

        'cities' => $isArabic ? 'دبي · أبوظبي · الشارقة · الإمارات' : 'Dubai · Abu Dhabi · Sharjah · UAE',

        'discover' => $isArabic ? 'اكتشف' : 'Discover',

        'creators_sellers' => $isArabic ? 'المبدعين والبائعين في الإمارات' : 'Creators & Sellers',

        'hero_text' => $isArabic
            ? 'استكشف المبدعين والمستقلين والمتاجر المحلية في جميع أنحاء الإمارات. اكتشف المنتجات والخدمات والبائعين الموثوقين في سوق إلكتروني واحد.'
            : 'Explore talented creators, freelancers and local businesses across the UAE. Find products, services and trusted sellers in one marketplace.',

        'search_placeholder' => $isArabic
            ? 'ابحث عن مبدعين، متاجر أو منتجات...'
            : 'Search creators, shops, products...',

        'search' => $isArabic ? 'بحث' : 'Search',

        'uae_sellers' => $isArabic ? 'بائعو الإمارات' : 'UAE Sellers',

        'explore_creators' => $isArabic ? 'استكشف المبدعين' : 'Explore Creators',

        'explore_text' => $isArabic
            ? 'اكتشف البائعين والمبدعين المستقلين من مختلف أنحاء الإمارات.'
            : 'Discover sellers and independent creators from across the UAE.',

        'creators' => $isArabic ? 'مبدعين' : 'creators',

        'creator' => $isArabic ? 'مبدع' : 'creator',

        'products' => $isArabic ? 'المنتجات' : 'Products',

        'rating' => $isArabic ? 'التقييم' : 'Rating',

        'view_shop' => $isArabic ? 'عرض المتجر' : 'View Shop',

        'freelance' => $isArabic ? 'مستقل' : 'Freelance',

        'local_shop' => $isArabic ? 'متجر محلي' : 'Local Shop',

        'seller' => $isArabic ? 'بائع' : 'Seller',

        'no_creators' => $isArabic ? 'لم يتم العثور على مبدعين' : 'No creators found',

        'no_creators_text' => $isArabic
            ? 'لم نتمكن من العثور على أي مبدعين يطابقون بحثك. جرّب كلمة أخرى أو استعرض جميع البائعين في الإمارات.'
            : "We couldn't find any creators matching your search. Try another keyword or explore all UAE sellers.",

        'view_all' => $isArabic ? 'عرض جميع المبدعين' : 'View All Creators',

        'ready' => $isArabic ? 'هل أنت مستعد لعرض نشاطك التجاري؟' : 'Ready to showcase your business?',

        'cta_text' => $isArabic
            ? 'أنشئ متجرك وتواصل مع العملاء في دبي وأبوظبي والشارقة وجميع أنحاء الإمارات.'
            : 'Create your shop and connect with customers across Dubai, Abu Dhabi, Sharjah and the rest of the UAE.',

        'manage_shop' => $isArabic ? 'إدارة متجرك' : 'Manage Your Shop',

        'join_marketplace' => $isArabic ? 'انضم إلى السوق' : 'Join Marketplace',

        'uae_based' => $isArabic ? 'بائعون من الإمارات' : 'UAE-based sellers',

        'freelancers_businesses' => $isArabic ? 'مستقلون ومتاجر' : 'Freelancers & businesses',

        'local_marketplace' => $isArabic ? 'سوق محلي' : 'Local marketplace',
    ];
@endphp


<x-main-layout>
    @section('title', 'Creators | murwaj')
    @section('description', "$description")
    @section('keywords', "$keywords")

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>


    <div dir="{{ $direction }}" lang="{{ $isArabic ? 'ar' : 'en' }}" class="min-h-screen bg-slate-50 dark:bg-slate-950">

        {{-- ========================================================= --}}
        {{-- HERO --}}
        {{-- ========================================================= --}}

        <section class="relative overflow-hidden">

            {{-- Background --}}
            <div
                class="absolute inset-0 bg-gradient-to-br from-orange-50 via-white to-amber-50
                       dark:from-slate-950 dark:via-slate-950 dark:to-orange-950/20">
            </div>

            <div class="absolute -right-32 -top-32 h-80 w-80 rounded-full bg-orange-400/10 blur-3xl">
            </div>

            <div class="absolute -bottom-32 -left-32 h-80 w-80 rounded-full bg-amber-400/10 blur-3xl">
            </div>


            <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">

                {{-- Badge --}}
                <div class="mb-5 flex flex-wrap items-center gap-3">

                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-orange-100 px-3.5 py-2
                               text-xs font-black uppercase tracking-wider text-orange-700
                               dark:bg-orange-500/10 dark:text-orange-400">

                        <span class="h-2 w-2 rounded-full bg-orange-500"></span>

                        {{ $labels['marketplace'] }}

                    </span>


                    <span class="text-sm font-medium text-slate-400">
                        🇦🇪 {{ $labels['cities'] }}
                    </span>

                </div>


                {{-- Heading --}}
                <div class="max-w-4xl">

                    <h1
                        class="text-4xl font-black tracking-tight text-slate-900
                               dark:text-white sm:text-5xl lg:text-6xl">

                        {{ $labels['discover'] }}

                        <span class="text-orange-500">
                            {{ $labels['creators_sellers'] }}
                        </span>

                    </h1>


                    <p
                        class="mt-5 max-w-3xl text-base leading-8 text-slate-600
                               dark:text-slate-400 sm:text-lg">
                        {{ $labels['hero_text'] }}
                    </p>

                </div>


                {{-- Search --}}
                <div class="mt-8 max-w-4xl">

                    <form action="{{ route('shop.creators') }}" method="GET">

                        <div
                            class="flex flex-col gap-3 rounded-2xl border border-slate-200
                                   bg-white p-2 shadow-xl shadow-slate-200/50
                                   sm:flex-row
                                   dark:border-slate-800 dark:bg-slate-900
                                   dark:shadow-black/20">

                            {{-- Search --}}
                            <div class="relative flex-1">

                                <div
                                    class="pointer-events-none absolute inset-y-0 start-0
                                           flex items-center ps-4 text-slate-400">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z" />
                                    </svg>

                                </div>


                                <input id="search-bar" type="search" name="q" value="{{ request('q') }}"
                                    placeholder="{{ $labels['search_placeholder'] }}" autocomplete="off"
                                    class="w-full rounded-xl border-0 bg-slate-50 py-3.5
                                           ps-12 pe-4 text-slate-900 outline-none
                                           placeholder:text-slate-400
                                           focus:ring-4 focus:ring-orange-500/10
                                           dark:bg-slate-950 dark:text-white
                                           dark:placeholder:text-slate-500">

                            </div>


                            {{-- Search Button --}}
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2
                                       rounded-xl bg-gradient-to-r from-orange-500 to-amber-500
                                       px-7 py-3.5 font-black text-white
                                       shadow-lg shadow-orange-500/20
                                       transition duration-200
                                       hover:-translate-y-0.5
                                       hover:from-orange-600 hover:to-amber-600
                                       active:translate-y-0">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z" />
                                </svg>

                                <span>
                                    {{ $labels['search'] }}
                                </span>

                            </button>

                        </div>

                    </form>

                </div>


                {{-- Features --}}
                <div
                    class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-3
                           text-sm text-slate-500 dark:text-slate-400">

                    <div class="flex items-center gap-2">
                        <span class="text-orange-500">✓</span>
                        {{ $labels['uae_based'] }}
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-orange-500">✓</span>
                        {{ $labels['freelancers_businesses'] }}
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-orange-500">✓</span>
                        {{ $labels['local_marketplace'] }}
                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- CREATORS --}}
        {{-- ========================================================= --}}

        <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="mb-7 flex flex-col gap-4
                       sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <div
                        class="mb-2 inline-flex items-center gap-2
                               text-xs font-black uppercase tracking-wider text-orange-500">

                        <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>

                        {{ $labels['uae_sellers'] }}

                    </div>


                    <h2
                        class="text-2xl font-black tracking-tight text-slate-900
                               dark:text-white sm:text-3xl">
                        {{ $labels['explore_creators'] }}
                    </h2>


                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ $labels['explore_text'] }}
                    </p>

                </div>


                {{-- Total --}}
                @if ($shops->total() > 0)
                    <div
                        class="inline-flex w-fit items-center rounded-full bg-white px-4 py-2
                               text-sm font-semibold text-slate-500 shadow-sm
                               ring-1 ring-slate-200
                               dark:bg-slate-900 dark:text-slate-400
                               dark:ring-slate-800">

                        <span class="me-2 font-black text-orange-500">
                            {{ $shops->total() }}
                        </span>

                        {{ $isArabic
                            ? ($shops->total() == 1
                                ? 'مبدع'
                                : 'مبدع')
                            : ($shops->total() == 1
                                ? $labels['creator']
                                : $labels['creators']) }}

                    </div>
                @endif

            </div>


            {{-- ========================================================= --}}
            {{-- SHOPS GRID --}}
            {{-- ========================================================= --}}

            @if ($shops->count())

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                    @foreach ($shops as $shop)
                        @php
                            /*
                            |--------------------------------------------------------------------------
                            | Localized Shop Information
                            |--------------------------------------------------------------------------
                            */

                            $shopName = $isArabic ? ($shop->name_ar ?: $shop->name) : $shop->name;

                            $sellerName = $shop->user?->name ?? ($isArabic ? 'بائع' : 'Seller');

                            $typeLabel = match ($shop->type) {
                                'freelance' => $labels['freelance'],
                                'local' => $labels['local_shop'],
                                default => $labels['seller'],
                            };

                            $typeIcon = match ($shop->type) {
                                'freelance' => '💼',
                                'local' => '🇦🇪',
                                default => '🏪',
                            };

                            $rating = number_format((float) ($shop->rating ?? 0), 1);

                            $listingsCount = (int) ($shop->listings_count ?? 0);
                        @endphp


                        <a href="{{ route('shop', $shop->slug) }}"
                            class="group relative overflow-hidden rounded-[1.75rem]
                                   border border-slate-200 bg-white shadow-sm
                                   transition-all duration-300
                                   hover:-translate-y-1
                                   hover:border-orange-200
                                   hover:shadow-2xl
                                   hover:shadow-orange-500/10
                                   dark:border-slate-800 dark:bg-slate-900
                                   dark:hover:border-orange-500/30">

                            {{-- Top Accent --}}
                            <div
                                class="h-1.5 bg-gradient-to-r
                                       from-orange-500 via-orange-400 to-amber-400">
                            </div>


                            <div class="p-6">

                                {{-- Logo --}}
                                <div class="flex justify-center">

                                    @if ($shop->logo)
                                        <div
                                            class="relative h-24 w-24 overflow-hidden rounded-2xl
                                                   border-4 border-white bg-slate-100 shadow-lg
                                                   dark:border-slate-800 dark:bg-slate-950">

                                            <img src="{{ Storage::disk('public')->url($shop->logo) }}"
                                                alt="{{ $shopName }}" loading="lazy"
                                                class="h-full w-full object-cover
                                                       transition duration-500
                                                       group-hover:scale-105">

                                        </div>
                                    @else
                                        <div
                                            class="flex h-24 w-24 items-center justify-center
                                                   rounded-2xl
                                                   bg-gradient-to-br from-orange-500 to-amber-500
                                                   text-3xl font-black text-white
                                                   shadow-lg shadow-orange-500/20">

                                            {{ strtoupper(mb_substr($shopName ?: $sellerName, 0, 1)) }}

                                        </div>
                                    @endif

                                </div>


                                {{-- Shop Info --}}
                                <div class="mt-5 text-center">

                                    {{-- Seller --}}
                                    <h3
                                        class="truncate text-lg font-black text-slate-900
                                               transition group-hover:text-orange-500
                                               dark:text-white">
                                        {{ $sellerName }}
                                    </h3>


                                    {{-- Shop Name --}}
                                    @if ($shopName)
                                        <p
                                            class="mt-1 truncate text-sm font-medium
                                                   text-slate-400">
                                            {{ $shopName }}
                                        </p>
                                    @endif


                                    {{-- Type --}}
                                    <div class="mt-3 flex justify-center">

                                        <span
                                            class="inline-flex items-center gap-1.5
                                                   rounded-full bg-orange-50 px-3 py-1
                                                   text-xs font-bold text-orange-600
                                                   dark:bg-orange-500/10
                                                   dark:text-orange-400">

                                            <span>
                                                {{ $typeIcon }}
                                            </span>

                                            <span>
                                                {{ $typeLabel }}
                                            </span>

                                        </span>

                                    </div>

                                </div>


                                {{-- Stats --}}
                                <div
                                    class="mt-6 grid grid-cols-2
                                           divide-x divide-slate-100
                                           rounded-xl bg-slate-50 py-3
                                           dark:divide-slate-800
                                           dark:bg-slate-950">

                                    {{-- Products --}}
                                    <div class="text-center">

                                        <div class="font-black text-slate-900 dark:text-white">
                                            {{ $listingsCount }}
                                        </div>

                                        <div
                                            class="mt-0.5 text-xs font-medium
                                                   text-slate-400">
                                            {{ $labels['products'] }}
                                        </div>

                                    </div>


                                    {{-- Rating --}}
                                    <div class="text-center">

                                        <div
                                            class="font-black text-slate-900
                                                   dark:text-white">

                                            {{ $rating }}

                                            <span class="text-orange-500">
                                                ★
                                            </span>

                                        </div>

                                        <div
                                            class="mt-0.5 text-xs font-medium
                                                   text-slate-400">
                                            {{ $labels['rating'] }}
                                        </div>

                                    </div>

                                </div>


                                {{-- View Shop --}}
                                <div
                                    class="mt-5 flex items-center justify-center gap-2
                                           text-sm font-black text-orange-500
                                           transition-all
                                           group-hover:gap-3">

                                    <span>
                                        {{ $labels['view_shop'] }}
                                    </span>


                                    <svg class="h-4 w-4 transition-transform
                                               {{ $isArabic ? 'rotate-180 group-hover:-translate-x-1' : 'group-hover:translate-x-1' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14m-5-5 5 5-5 5" />

                                    </svg>

                                </div>

                            </div>

                        </a>
                    @endforeach

                </div>
            @else
                {{-- ========================================================= --}}
                {{-- EMPTY STATE --}}
                {{-- ========================================================= --}}

                <div
                    class="rounded-[2rem] border border-dashed border-slate-300
                           bg-white px-6 py-16 text-center
                           dark:border-slate-700 dark:bg-slate-900">

                    <div
                        class="mx-auto flex h-20 w-20 items-center justify-center
                               rounded-2xl bg-orange-100 text-4xl
                               dark:bg-orange-500/10">
                        🔎
                    </div>


                    <h3 class="mt-6 text-xl font-black text-slate-900
                               dark:text-white">
                        {{ $labels['no_creators'] }}
                    </h3>


                    <p
                        class="mx-auto mt-2 max-w-md text-sm leading-6
                               text-slate-500 dark:text-slate-400">
                        {{ $labels['no_creators_text'] }}
                    </p>


                    @if (request('q'))
                        <a href="{{ route('shop.creators') }}"
                            class="mt-6 inline-flex items-center justify-center
                                   rounded-xl bg-orange-500 px-6 py-3
                                   font-bold text-white
                                   shadow-lg shadow-orange-500/20
                                   transition hover:bg-orange-600">
                            {{ $labels['view_all'] }}
                        </a>
                    @endif

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- PAGINATION --}}
            {{-- ========================================================= --}}

            @if ($shops->hasPages())
                <div class="mt-10 flex justify-center">

                    <div
                        class="rounded-2xl border border-slate-200 bg-white p-2
                               shadow-sm dark:border-slate-800 dark:bg-slate-900">

                        {{ $shops->withQueryString()->links() }}

                    </div>

                </div>
            @endif

        </section>


        {{-- ========================================================= --}}
        {{-- UAE CTA --}}
        {{-- ========================================================= --}}

        <section class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">

            <div
                class="relative overflow-hidden rounded-[2rem]
                       bg-gradient-to-br from-orange-500 via-orange-600 to-amber-500
                       p-7 text-white shadow-2xl shadow-orange-500/20
                       sm:p-10">

                {{-- Decorations --}}
                <div
                    class="absolute -right-20 -top-20 h-64 w-64 rounded-full
                           bg-white/10 blur-3xl">
                </div>

                <div
                    class="absolute -bottom-24 left-1/3 h-56 w-56 rounded-full
                           bg-amber-300/20 blur-3xl">
                </div>


                <div
                    class="relative flex flex-col gap-6
                           md:flex-row md:items-center md:justify-between">

                    <div class="max-w-2xl">

                        <div
                            class="mb-3 inline-flex items-center gap-2 rounded-full
                                   border border-white/20 bg-white/10 px-3 py-1.5
                                   text-xs font-black uppercase tracking-wider
                                   backdrop-blur">

                            🇦🇪

                            {{ $labels['marketplace'] }}

                        </div>


                        <h2 class="text-2xl font-black sm:text-3xl">
                            {{ $labels['ready'] }}
                        </h2>


                        <p class="mt-2 text-sm leading-6 text-white/80 sm:text-base">
                            {{ $labels['cta_text'] }}
                        </p>

                    </div>


                    @auth

                        <a href="{{ route('shop.edit') }}"
                            class="inline-flex shrink-0 items-center justify-center
                                   gap-2 rounded-xl bg-white px-6 py-3.5
                                   font-black text-orange-600 shadow-xl
                                   transition hover:-translate-y-0.5
                                   hover:bg-orange-50">

                            {{ $labels['manage_shop'] }}

                            <svg class="h-5 w-5 {{ $isArabic ? 'rotate-180' : '' }}" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14m-5-5 5 5-5 5" />

                            </svg>

                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="inline-flex shrink-0 items-center justify-center
                                   gap-2 rounded-xl bg-white px-6 py-3.5
                                   font-black text-orange-600 shadow-xl
                                   transition hover:-translate-y-0.5
                                   hover:bg-orange-50">

                            {{ $labels['join_marketplace'] }}

                            <svg class="h-5 w-5 {{ $isArabic ? 'rotate-180' : '' }}" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14m-5-5 5 5-5 5" />

                            </svg>

                        </a>

                    @endauth

                </div>

            </div>

        </section>

    </div>


    <x-main-footer></x-main-footer>

</x-main-layout>
