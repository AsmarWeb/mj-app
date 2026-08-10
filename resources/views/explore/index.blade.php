<x-main-layout>
    @section('title', 'Explore | murwaj')

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <div class="min-h-screen bg-white dark:bg-gray-950">

        {{-- =========================================================
    HERO
========================================================== --}}
        <section class="p-5 sm:p-8 md:p-10">
            <div
                class="mx-auto max-w-7xl overflow-hidden rounded-3xl
               bg-white text-black shadow-2xl
               dark:bg-gray-900 dark:text-white">

                <div class="grid grid-cols-1 gap-10 p-8 sm:p-10 lg:grid-cols-2 lg:p-14">

                    <div class="z-10 flex flex-col justify-center text-center md:text-left">

                        <span class="text-sm font-bold text-orange-500">
                            🚀 {{ __('discover.marketplace') }}
                        </span>

                        <h1
                            class="mt-4 text-4xl font-extrabold uppercase leading-tight tracking-tight
                           sm:text-5xl md:text-6xl lg:text-7xl">

                            {{ __('discover.Shopping with') }}

                            <span class="text-orange-500">
                                {{ __('discover.murwaj') }}
                            </span>

                        </h1>

                        <p class="mt-5 max-w-2xl text-base font-medium text-gray-500 dark:text-gray-400 sm:text-lg">
                            {{ __('discover.Buy and sell everything from digital products to services.') }}
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                            <a href="#section-products"
                                class="rounded-xl bg-orange-500 px-6 py-4 text-center
                              text-sm font-black uppercase tracking-widest text-white
                              transition hover:bg-orange-600">

                                {{ __('discover.explore store') }}

                            </a>

                            <a href="#creators"
                                class="rounded-xl border border-orange-500 px-6 py-4 text-center
                              text-sm font-black uppercase tracking-widest text-orange-500
                              transition hover:bg-orange-500 hover:text-white">

                                {{ __('discover.top creators') }}

                            </a>

                        </div>

                    </div>

                    <div class="relative flex min-h-[280px] items-center justify-center">

                        <div
                            class="absolute left-5 top-5 h-32 w-32 rotate-12 rounded-3xl
                           bg-orange-500 sm:h-48 sm:w-48 lg:h-64 lg:w-64">
                        </div>

                        <div
                            class="relative z-10 rounded-2xl border-b-8 border-r-8 border-slate-950
                           bg-gray-800 p-7 text-center shadow-2xl">

                            <h2 class="text-2xl font-black uppercase text-white sm:text-4xl">
                                {{ __('discover.buy') }}.
                                {{ __('discover.rent') }}.
                                {{ __('discover.booking') }}.
                            </h2>

                            <p class="mt-3 text-sm text-gray-400 sm:text-base">
                                {{ __('discover.Buy and sell everything from digital products to services.') }}
                            </p>

                        </div>

                        <div
                            class="absolute bottom-5 right-5 h-32 w-32 -rotate-12 rounded-3xl
                           bg-orange-500 sm:h-48 sm:w-48 lg:h-64 lg:w-64">
                        </div>

                    </div>

                </div>
            </div>
        </section>


        {{-- =========================================================
    AD SLOT
    No visible Advertisement text
========================================================== --}}
        <section class="mx-auto max-w-7xl px-6 py-4">
            <div
                class="min-h-[90px] overflow-hidden rounded-2xl
               border border-gray-100 bg-gray-50/50
               dark:border-gray-800 dark:bg-gray-900/30">

                {{-- Google AdSense --}}
                {{--
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-XXXXXXXXXXXX"
             data-ad-slot="XXXXXXXXXX"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>

        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        --}}

            </div>
        </section>


        {{-- =========================================================
    MARKETPLACE SECTIONS
========================================================== --}}
        <section class="mx-auto max-w-7xl px-6 py-16">

            <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">

                <div>
                    <span class="text-xs font-black uppercase tracking-[0.2em] text-orange-500">
                        {{ __('discover.explore murwaj') }}
                    </span>

                    <h2 class="mt-2 text-3xl font-black tracking-tight text-gray-900 dark:text-white md:text-4xl">
                        {{ __('discover.browse marketplace') }}
                    </h2>

                    <p class="mt-3 max-w-2xl text-gray-500 dark:text-gray-400">
                        {{ __('discover.discover products') }}
                    </p>
                </div>

            </div>


            <div class="grid grid-cols-2 gap-5 md:grid-cols-3 lg:grid-cols-5">

                @forelse ($sections as $section)
                    @php
                        $sectionName =
                            app()->getLocale() === 'ar' ? $section->name_ar ?? $section->name : $section->name;
                    @endphp

                    <a href="{{ route('explore.section', $section->slug) }}"
                        class="group relative overflow-hidden rounded-3xl
                      border border-gray-100 bg-white p-6 shadow-sm
                      transition-all duration-300
                      hover:-translate-y-1 hover:border-orange-200 hover:shadow-xl
                      dark:border-gray-800 dark:bg-gray-900 dark:hover:border-orange-900">

                        <div
                            class="absolute -right-8 -top-8 h-24 w-24 rounded-full
                            bg-orange-500/5 blur-2xl transition group-hover:bg-orange-500/10">
                        </div>

                        <div class="relative">

                            <div
                                class="mx-auto flex h-20 w-20 items-center justify-center
                                rounded-2xl border border-orange-100
                                bg-orange-50 transition group-hover:scale-105
                                dark:border-orange-900/40 dark:bg-orange-950/30">

                                @if ($section->image)
                                    <img src="{{ asset('storage/section-suggest/' . $section->image) }}"
                                        alt="{{ $sectionName }}" class="h-12 w-12 object-contain" loading="lazy">
                                @else
                                    <span class="text-2xl">🛍️</span>
                                @endif

                            </div>

                            <h3 class="mt-5 text-center text-base font-bold text-gray-900 dark:text-white">
                                {{ $sectionName }}
                            </h3>

                            <p class="mt-2 text-center text-xs leading-relaxed text-gray-500 dark:text-gray-400">

                                @switch($section->slug)
                                    @case('sales')
                                        Buy products from trusted sellers.
                                    @break

                                    @case('rental')
                                        Rent products and equipment.
                                    @break

                                    @case('real-estate')
                                        Find homes, offices and land.
                                    @break

                                    @case('auction')
                                        Bid on exclusive listings.
                                    @break

                                    @case('events')
                                        Discover local events.
                                    @break

                                    @default
                                        Explore this marketplace section.
                                @endswitch

                            </p>

                            <div class="mt-5 text-center">
                                <span
                                    class="inline-flex items-center gap-1 text-xs font-black uppercase
                                     tracking-wider text-orange-500 transition-all group-hover:gap-2">

                                    Explore
                                    <span>→</span>

                                </span>
                            </div>

                        </div>

                    </a>

                    @empty

                        <div class="col-span-full py-12 text-center">
                            <div class="text-4xl">🛍️</div>

                            <h3 class="mt-4 font-bold text-gray-900 dark:text-white">
                                No marketplace sections available
                            </h3>
                        </div>
                    @endforelse

                </div>

            </section>


            {{-- =========================================================
    CATEGORIES
========================================================== --}}
            <section class="mx-auto max-w-7xl px-6 py-16">

                <div class="mb-10 flex items-center justify-between">

                    <div>
                        <span class="text-xs font-black uppercase tracking-[0.2em] text-orange-500">
                            {{ __('discover.discover') }}
                        </span>

                        <h2 class="mt-2 text-3xl font-black text-gray-900 dark:text-white md:text-4xl">
                            {{ __('discover.explore categories') }}
                        </h2>
                    </div>

                    <a href="{{ route('categories') }}"
                        class="hidden items-center gap-2 text-sm font-bold text-gray-600
                  hover:text-orange-500 dark:text-gray-300 sm:inline-flex">

                        {{ __('discover.view all ') }}
                        <span>→</span>

                    </a>

                </div>


                <div class="grid grid-cols-2 gap-5 md:grid-cols-4 lg:grid-cols-6">

                    @forelse ($categories as $category)
                        @php
                            $categoryName =
                                app()->getLocale() === 'ar'
                                    ? $category->category_name_ar ?? $category->category_name
                                    : $category->category_name;
                        @endphp

                        <a href="{{ $category->url }}"
                            class="group rounded-2xl border border-gray-100 bg-white p-5 text-center
                      shadow-sm transition-all duration-300
                      hover:-translate-y-1 hover:border-orange-200 hover:shadow-lg
                      dark:border-gray-800 dark:bg-gray-900 dark:hover:border-orange-900">

                            <div
                                class="mx-auto flex h-20 w-20 items-center justify-center rounded-full
                            bg-gray-50 transition group-hover:bg-orange-50
                            dark:bg-gray-800 dark:group-hover:bg-orange-950/30">

                                @if ($category->image)
                                    <img src="{{ asset('storage/category-suggest/' . $category->image) }}"
                                        alt="{{ $categoryName }}"
                                        class="h-12 w-12 object-contain transition group-hover:scale-110" loading="lazy">
                                @else
                                    <span class="text-2xl">🛍️</span>
                                @endif

                            </div>

                            <h3
                                class="mt-4 text-sm font-bold text-gray-800 transition
                           group-hover:text-orange-500 dark:text-gray-200">

                                {{ $categoryName }}

                            </h3>

                        </a>

                    @empty

                        <div class="col-span-full py-12 text-center">
                            <div class="text-4xl">📂</div>

                            <h3 class="mt-4 font-bold text-gray-900 dark:text-white">
                                No categories available
                            </h3>
                        </div>
                    @endforelse

                </div>

            </section>


            {{-- =========================================================
    PRODUCTS BY SECTION
========================================================== --}}
            <section id="section-products" class="mx-auto max-w-7xl px-6 py-16">

                <div class="mb-12">

                    <span class="text-xs font-black uppercase tracking-[0.2em] text-orange-500">
                        {{ __('discover.marketplace') }}
                    </span>

                    <h2 class="mt-2 text-3xl font-black text-gray-900 dark:text-white md:text-4xl">
                        {{ __('discover.products by section') }}
                    </h2>

                    <p class="mt-3 max-w-2xl text-gray-500 dark:text-gray-400">
                        {{ __('discover.latest products') }}
                    </p>

                </div>


                <div class="space-y-20">

                    @forelse ($sections as $section)

                        @php
                            $sectionName =
                                app()->getLocale() === 'ar' ? $section->name_ar ?? $section->name : $section->name;

                            $sectionProducts = $section->listings ?? collect();
                        @endphp


                        <div>

                            {{-- SECTION HEADER --}}
                            <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                                <div class="flex items-center gap-4">

                                    <div
                                        class="flex h-14 w-14 shrink-0 items-center justify-center
                                    rounded-2xl border border-orange-100 bg-orange-50
                                    dark:border-orange-900/40 dark:bg-orange-950/30">

                                        @if ($section->image)
                                            <img src="{{ asset('storage/section-suggest/' . $section->image) }}"
                                                alt="{{ $sectionName }}" class="h-9 w-9 object-contain" loading="lazy">
                                        @else
                                            <span class="text-xl">🛍️</span>
                                        @endif

                                    </div>

                                    <div>

                                        <h3 class="text-2xl font-black text-gray-900 dark:text-white md:text-3xl">
                                            {{ $sectionName }}
                                        </h3>

                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                                            @switch($section->slug)
                                                @case('sales')
                                                    Buy products from trusted sellers.
                                                @break

                                                @case('rental')
                                                    Rent products and equipment.
                                                @break

                                                @case('real-estate')
                                                    Find homes, offices and land.
                                                @break

                                                @case('auction')
                                                    Bid on exclusive listings.
                                                @break

                                                @case('events')
                                                    Discover local events.
                                                @break

                                                @default
                                                    Explore products in this section.
                                            @endswitch

                                        </p>

                                    </div>

                                </div>


                                <a href="{{ route('explore.section', $section->slug) }}"
                                    class="inline-flex items-center gap-2 text-sm font-bold text-orange-500
                              hover:text-orange-600">

                                    {{ __('discover.view all') }}
                                    <span>→</span>

                                </a>

                            </div>


                            {{-- PRODUCTS --}}
                            @if ($sectionProducts->count())
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

                                    @foreach ($sectionProducts->take(8) as $product)
                                        <article
                                            class="group overflow-hidden rounded-3xl
                                       border border-gray-100 bg-white shadow-sm
                                       transition-all duration-300
                                       hover:-translate-y-1 hover:shadow-2xl
                                       dark:border-gray-800 dark:bg-gray-900">

                                            <div class="relative h-56 overflow-hidden bg-gray-100 dark:bg-gray-800">

                                                @if ($product->image)
                                                    <img src="{{ asset('storage/products/' . $product->image) }}"
                                                        alt="{{ $product->title }}"
                                                        class="h-full w-full object-cover transition duration-700
                                                   group-hover:scale-105"
                                                        loading="lazy">
                                                @else
                                                    <div
                                                        class="flex h-full w-full items-center justify-center
                                                    bg-gradient-to-br from-gray-100 to-gray-200
                                                    dark:from-gray-800 dark:to-gray-900">

                                                        <span class="text-4xl">🛍️</span>

                                                    </div>
                                                @endif


                                                @if (file_exists(public_path('watermark.png')))
                                                    <img src="{{ asset('watermark.png') }}" alt=""
                                                        class="absolute right-4 top-4 h-10 w-10 rounded-full
                                                   border-2 border-white/80 shadow-lg">
                                                @endif


                                                @if ($product->featured)
                                                    <span
                                                        class="absolute left-4 top-4 rounded-full bg-yellow-400
                                                   px-3 py-1.5 text-[10px] font-black uppercase
                                                   tracking-wider text-yellow-950">

                                                        ★ Featured

                                                    </span>
                                                @endif

                                            </div>


                                            <div class="p-5">

                                                @if ($product->shop)
                                                    <a href="{{ route('shop', $product->shop->slug) }}"
                                                        class="text-[10px] font-black uppercase tracking-wider
                                                   text-orange-500 hover:text-orange-600">

                                                        {{ $product->shop->name }}

                                                    </a>
                                                @endif


                                                <h4
                                                    class="mt-2 line-clamp-1 text-lg font-black
                                               text-gray-900 dark:text-white">

                                                    {{ $product->title }}

                                                </h4>


                                                <p
                                                    class="mt-2 line-clamp-2 text-sm leading-relaxed
                                              text-gray-500 dark:text-gray-400">

                                                    {{ Str::limit($product->description ?? '', 80) }}

                                                </p>


                                                <div class="mt-5 flex items-center justify-between gap-3">

                                                    <span class="text-xl font-black text-gray-900 dark:text-white">

                                                        ${{ number_format((float) ($product->price ?? 0), 2) }}

                                                    </span>


                                                    <a href="{{ $product->url ?? '#' }}"
                                                        class="rounded-xl bg-orange-500 px-4 py-2.5
                                                   text-xs font-black uppercase tracking-wider text-white
                                                   transition hover:bg-orange-600">

                                                        View

                                                    </a>

                                                </div>

                                            </div>

                                        </article>
                                    @endforeach

                                </div>
                            @else
                                <div
                                    class="rounded-3xl border border-dashed border-gray-200
                               bg-gray-50/50 px-6 py-12 text-center
                               dark:border-gray-800 dark:bg-gray-900/40">

                                    <div
                                        class="mx-auto flex h-14 w-14 items-center justify-center
                                    rounded-2xl bg-gray-100 dark:bg-gray-800">

                                        <span class="text-xl">📦</span>

                                    </div>

                                    <h4 class="mt-4 text-lg font-bold text-gray-900 dark:text-white">
                                        No products yet
                                    </h4>

                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        There are no published products in {{ $sectionName }} yet.
                                    </p>

                                </div>
                            @endif

                        </div>

                        @empty

                            <div
                                class="rounded-3xl border border-dashed border-gray-200
                        py-16 text-center dark:border-gray-800">

                                <div class="text-4xl">📦</div>

                                <h3 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">
                                    No sections available
                                </h3>

                            </div>

                        @endforelse

                    </div>

                </section>


                {{-- =========================================================
    FEATURED PRODUCTS
========================================================== --}}
                <section id="featured-products"
                    class="border-y border-gray-100 bg-gray-50/80 dark:border-gray-900 dark:bg-gray-950/50">

                    <div class="mx-auto max-w-7xl px-6 py-16">

                        <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                            <div>

                                <span class="text-xs font-black uppercase tracking-[0.2em] text-orange-500">
                                    {{ __('discover.handpicked') }}
                                </span>

                                <h2 class="mt-2 text-3xl font-black text-gray-900 dark:text-white md:text-4xl">
                                    {{ __('discover.featured products') }}
                                </h2>

                                <p class="mt-2 text-gray-500 dark:text-gray-400">
                                    {{ __('discover.quality products') }}
                                </p>

                            </div>

                            <a href="#section-products" class="text-sm font-bold text-orange-500 hover:text-orange-600">
                                {{ __('discover.view all') }} →
                            </a>

                        </div>


                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

                            @forelse ($featuredProducts as $product)
                                <article
                                    class="group overflow-hidden rounded-3xl border border-gray-100
                           bg-white shadow-sm transition hover:shadow-2xl
                           dark:border-gray-800 dark:bg-gray-900">

                                    <div class="relative h-56 overflow-hidden bg-gray-100 dark:bg-gray-800">

                                        @if ($product->image)
                                            <img src="{{ asset('storage/products/' . $product->image) }}"
                                                alt="{{ $product->title }}"
                                                class="h-full w-full object-cover transition duration-700
                                       group-hover:scale-105"
                                                loading="lazy">
                                        @else
                                            <div class="flex h-full items-center justify-center text-gray-400">
                                                No Image
                                            </div>
                                        @endif


                                        @if (file_exists(public_path('watermark.png')))
                                            <img src="{{ asset('watermark.png') }}" alt=""
                                                class="absolute right-4 top-4 h-11 w-11 rounded-full
                                       border-2 border-white/80 shadow-lg">
                                        @endif


                                        <span
                                            class="absolute left-4 top-4 rounded-full bg-black/70 px-3 py-1.5
                                   text-[10px] font-bold uppercase tracking-wider text-white">

                                            Featured

                                        </span>

                                    </div>


                                    <div class="p-5">

                                        @if ($product->shop)
                                            <a href="{{ route('shop', $product->shop->slug) }}"
                                                class="text-xs font-bold uppercase tracking-wider text-orange-500">

                                                {{ $product->shop->name }}

                                            </a>
                                        @endif


                                        <h3 class="mt-2 line-clamp-1 text-lg font-bold text-gray-900 dark:text-white">
                                            {{ $product->title }}
                                        </h3>


                                        <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                                            {{ Str::limit($product->description ?? '', 80) }}
                                        </p>


                                        <div class="mt-5 flex items-center justify-between gap-4">

                                            <span class="text-xl font-black text-gray-900 dark:text-white">
                                                ${{ number_format((float) ($product->price ?? 0), 2) }}
                                            </span>

                                            <a href="{{ $product->url ?? '#' }}"
                                                class="rounded-xl bg-orange-500 px-4 py-2.5
                                       text-xs font-bold uppercase tracking-wider text-white
                                       hover:bg-orange-600">

                                                View

                                            </a>

                                        </div>

                                    </div>

                                </article>

                            @empty

                                <div class="col-span-full py-16 text-center">

                                    <div class="text-4xl">📦</div>

                                    <h3 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">
                                        No featured products yet
                                    </h3>

                                </div>
                            @endforelse

                        </div>

                    </div>

                </section>


                {{-- =========================================================
    DIGITAL PRODUCTS
========================================================== --}}
                <section class="mx-auto max-w-7xl px-6 py-16">

                    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                        <div>

                            <span class="text-xs font-black uppercase tracking-[0.2em] text-orange-500">
                                {{ __('discover.digital marketplace') }}
                            </span>

                            <h2 class="mt-2 text-3xl font-black text-gray-900 dark:text-white md:text-4xl">
                                {{ __('discover.creative digital') }}
                            </h2>

                            <p class="mt-3 text-gray-500 dark:text-gray-400">
                                {{ __('discover.templates') }}
                            </p>

                        </div>

                        <a href="#" class="text-sm font-bold text-orange-500 hover:text-orange-600">
                            {{ __('discover.view all') }} →
                        </a>

                    </div>


                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

                        @forelse ($digitalProducts as $product)

                            @php

                                $productColors = [];

                                if (is_array($product->colors ?? null)) {
                                    $productColors = $product->colors;
                                } elseif (!empty($product->colors)) {
                                    $decodedColors = json_decode($product->colors, true);

                                    if (is_array($decodedColors)) {
                                        $productColors = $decodedColors;
                                    }
                                }

                                $digitalTitle =
                                    app()->getLocale() === 'ar'
                                        ? $product->title_ar ?? $product->title
                                        : $product->title;

                                $digitalDescription =
                                    app()->getLocale() === 'ar'
                                        ? $product->description_ar ?? $product->description
                                        : $product->description;

                            @endphp


                            <article
                                class="group overflow-hidden rounded-3xl border border-gray-100
                       bg-white shadow-sm transition hover:shadow-2xl
                       dark:border-gray-800 dark:bg-gray-900">

                                <div class="relative h-60 overflow-hidden bg-gray-100 dark:bg-gray-800">

                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $digitalTitle }}"
                                            class="h-full w-full object-cover transition duration-700
                                   group-hover:scale-110"
                                            loading="lazy">
                                    @else
                                        <div class="flex h-full items-center justify-center text-gray-400">
                                            No Image
                                        </div>
                                    @endif


                                    <div class="absolute left-4 top-4">

                                        @if ($product->type === 'pod')
                                            <span
                                                class="rounded-full bg-purple-600/90 px-3 py-1.5 text-[10px]
                                         font-bold uppercase tracking-wider text-white">

                                                Print On Demand

                                            </span>
                                        @elseif ($product->type === 'service')
                                            <span
                                                class="rounded-full bg-blue-600/90 px-3 py-1.5 text-[10px]
                                         font-bold uppercase tracking-wider text-white">

                                                Service

                                            </span>
                                        @else
                                            <span
                                                class="rounded-full bg-orange-500/95 px-3 py-1.5 text-[10px]
                                         font-bold uppercase tracking-wider text-white">

                                                Digital

                                            </span>
                                        @endif

                                    </div>


                                    @if ($product->featured)
                                        <span
                                            class="absolute right-4 top-4 rounded-full bg-white/95 px-3 py-1.5
                                   text-[10px] font-bold text-gray-900 shadow">

                                            ★ Featured

                                        </span>
                                    @endif


                                    @if ($product->is_free)
                                        <span
                                            class="absolute bottom-4 left-4 rounded-full bg-emerald-600
                                   px-3 py-1.5 text-[10px] font-bold uppercase
                                   tracking-wider text-white">

                                            Free

                                        </span>
                                    @endif

                                </div>


                                <div class="p-6">

                                    <div class="flex items-center justify-between gap-3">

                                        <span class="truncate text-[10px] font-bold uppercase tracking-wider text-orange-500">

                                            {{ $product->digitalCategory->category_name ?? 'General' }}

                                        </span>

                                        @if ($product->type === 'pod' && $product->base_product)
                                            <span class="max-w-[100px] truncate text-[10px] text-gray-400">
                                                {{ $product->base_product }}
                                            </span>
                                        @endif

                                    </div>


                                    <h3 class="mt-3 line-clamp-1 text-lg font-black text-gray-900 dark:text-white">
                                        {{ $digitalTitle }}
                                    </h3>


                                    <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                                        {{ Str::limit($digitalDescription ?? '', 90) }}
                                    </p>


                                    @if ($product->type === 'pod' && count($productColors))
                                        <div class="mt-4 flex gap-2">

                                            @foreach (array_slice($productColors, 0, 5) as $color)
                                                @if (is_string($color) && $color !== '')
                                                    <span
                                                        class="h-5 w-5 rounded-full border-2 border-white shadow
                                               ring-1 ring-gray-200"
                                                        style="background-color: {{ $color }}">
                                                    </span>
                                                @endif
                                            @endforeach

                                        </div>
                                    @endif


                                    <div class="mt-6 flex items-center justify-between gap-4">

                                        @if ($product->is_free)
                                            <span class="text-lg font-black text-emerald-600">
                                                Free
                                            </span>
                                        @else
                                            <span class="text-2xl font-black text-gray-900 dark:text-white">
                                                ${{ number_format((float) ($product->price ?? 0), 2) }}
                                            </span>
                                        @endif


                                        <a href="{{ route('digital-products.show', $product->slug) }}"
                                            class="rounded-xl bg-orange-500 px-5 py-2.5 text-xs
                                   font-bold uppercase tracking-wider text-white
                                   hover:bg-orange-600">

                                            View

                                        </a>

                                    </div>


                                    <div
                                        class="mt-5 flex justify-between border-t border-gray-100 pt-4
                               text-[11px] text-gray-400 dark:border-gray-800">

                                        <span>
                                            ↓ {{ number_format((int) ($product->downloads ?? 0)) }}
                                        </span>

                                        <span>
                                            ♥ {{ number_format((int) ($product->favorites ?? 0)) }}
                                        </span>

                                        <span>
                                            ★ {{ number_format((float) ($product->rating ?? 0), 1) }}
                                        </span>

                                    </div>

                                </div>

                            </article>

                        @empty

                            <div
                                class="col-span-full rounded-3xl border border-dashed border-gray-200
                        py-20 text-center dark:border-gray-800">

                                <div class="text-4xl">✨</div>

                                <h3 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">
                                    No digital products yet
                                </h3>

                                <p class="mx-auto mt-2 max-w-lg text-sm text-gray-500">
                                    Have a digital product?

                                    <a href="{{ route('contact') }}"
                                        class="font-semibold text-orange-500 hover:text-orange-600">

                                        Contact Us

                                    </a>

                                    and we'll help you list it.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </section>


                {{-- =========================================================
    AD SLOT
    No visible Advertisement text
========================================================== --}}
                <section class="mx-auto max-w-7xl px-6 py-4">
                    <div
                        class="min-h-[100px] rounded-2xl border border-gray-100
               bg-gray-50 dark:border-gray-800 dark:bg-gray-950">

                        {{-- Google AdSense goes here --}}

                    </div>
                </section>


                {{-- =========================================================
    TRENDING
========================================================== --}}
                <section id="trending-products" class="mx-auto max-w-7xl px-6 py-16">

                    <div class="mb-10 flex items-end justify-between">

                        <div>

                            <span class="text-xs font-black uppercase tracking-[0.2em] text-orange-500">
                                {{ __('discover.popular') }}
                            </span>

                            <h2 class="mt-2 text-3xl font-black text-gray-900 dark:text-white md:text-4xl">
                                {{ __('discover.trending') }}<span class="text-orange-500">🔥</span>
                            </h2>

                        </div>

                        <a href="#section-products" class="text-sm font-bold text-orange-500 hover:text-orange-600">
                            {{ __('discover.view all') }} →
                        </a>

                    </div>


                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

                        @forelse ($trendingProducts as $product)
                            <article
                                class="group overflow-hidden rounded-3xl border border-gray-100
                       bg-white shadow-sm transition hover:shadow-2xl
                       dark:border-gray-800 dark:bg-gray-900">

                                <div class="relative h-56 overflow-hidden bg-gray-100 dark:bg-gray-800">

                                    @if ($product->image)
                                        <img src="{{ asset('storage/products/' . $product->image) }}"
                                            alt="{{ $product->title }}"
                                            class="h-full w-full object-cover transition duration-700
                                   group-hover:scale-105"
                                            loading="lazy">
                                    @else
                                        <div class="flex h-full items-center justify-center text-gray-400">
                                            No Image
                                        </div>
                                    @endif


                                    @if (file_exists(public_path('watermark.png')))
                                        <img src="{{ asset('watermark.png') }}" alt=""
                                            class="absolute right-4 top-4 h-11 w-11 rounded-full
                                   border-2 border-white/80 shadow">
                                    @endif


                                    <span
                                        class="absolute left-4 top-4 rounded-full bg-orange-500
                               px-3 py-1.5 text-[10px] font-bold uppercase
                               tracking-wider text-white">

                                        Trending

                                    </span>

                                </div>


                                <div class="p-5">

                                    @if ($product->shop)
                                        <a href="{{ route('shop', $product->shop->slug) }}"
                                            class="text-xs font-bold uppercase tracking-wider text-orange-500">

                                            {{ $product->shop->name }}

                                        </a>
                                    @endif


                                    <h3 class="mt-2 line-clamp-1 text-lg font-bold text-gray-900 dark:text-white">
                                        {{ $product->title }}
                                    </h3>


                                    <p class="mt-2 line-clamp-2 text-sm text-gray-500 dark:text-gray-400">
                                        {{ Str::limit($product->description ?? '', 80) }}
                                    </p>


                                    <div class="mt-5 flex items-center justify-between">

                                        <span class="text-xl font-black text-gray-900 dark:text-white">
                                            ${{ number_format((float) ($product->price ?? 0), 2) }}
                                        </span>

                                        <a href="{{ $product->url ?? '#' }}"
                                            class="rounded-xl bg-gray-900 px-4 py-2.5 text-xs font-bold
                                   text-white transition hover:bg-orange-500
                                   dark:bg-white dark:text-gray-900 dark:hover:text-white">

                                            View

                                        </a>

                                    </div>

                                </div>

                            </article>

                        @empty

                            <div class="col-span-full py-16 text-center">

                                <div class="text-4xl">🔥</div>

                                <h3 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">
                                    Nothing is trending yet
                                </h3>

                            </div>
                        @endforelse

                    </div>

                </section>


                {{-- =========================================================
    TOP SELLERS
========================================================== --}}
                <section id="creators" class="border-y border-gray-100 bg-gray-50 dark:border-gray-900 dark:bg-gray-950">

                    <div class="mx-auto max-w-7xl px-6 py-16">

                        <div class="mb-10 flex items-end justify-between">

                            <div>

                                <span class="text-xs font-black uppercase tracking-[0.2em] text-orange-500">
                                    {{ __('discover.community') }}
                                </span>

                                <h2 class="mt-2 text-3xl font-black text-gray-900 dark:text-white md:text-4xl">
                                    {{ __('discover.sellers') }}
                                </h2>

                            </div>

                            <a href="#" class="text-sm font-bold text-orange-500">
                                {{ __('discover.view all') }} →
                            </a>

                        </div>


                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

                            @forelse ($shops as $shop)
                                <article
                                    class="group rounded-3xl border border-gray-100 bg-white p-6 text-center
                           transition duration-300 hover:-translate-y-1 hover:shadow-xl
                           dark:border-gray-800 dark:bg-gray-900">

                                    <div
                                        class="mx-auto h-24 w-24 overflow-hidden rounded-full
                               ring-4 ring-orange-50 dark:ring-orange-950/40">

                                        @if ($shop->logo)
                                            <img src="{{ Storage::disk('public')->url($shop->logo) }}"
                                                alt="{{ $shop->name }}" class="h-full w-full object-cover" loading="lazy">
                                        @else
                                            <div
                                                class="flex h-full w-full items-center justify-center
                                       bg-gradient-to-br from-orange-500 to-orange-700
                                       text-3xl font-black text-white">

                                                {{ strtoupper(substr($shop->name ?? 'M', 0, 1)) }}

                                            </div>
                                        @endif

                                    </div>


                                    <h3 class="mt-5 font-bold text-gray-900 dark:text-white">
                                        {{ $shop->name }}
                                    </h3>


                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $shop->type ?: 'Murwaj Seller' }}
                                    </p>


                                    <div
                                        class="mt-6 grid grid-cols-2 divide-x border-y border-gray-100
                               py-4 dark:divide-gray-800 dark:border-gray-800">

                                        <div>

                                            <div class="font-black text-gray-900 dark:text-white">
                                                {{ number_format((int) ($shop->listings_count ?? 0)) }}
                                            </div>

                                            <div class="text-[10px] uppercase tracking-wider text-gray-400">
                                                Products
                                            </div>

                                        </div>


                                        <div>

                                            <div class="font-black text-gray-900 dark:text-white">
                                                {{ number_format((float) ($shop->rating ?? 0), 1) }}★
                                            </div>

                                            <div class="text-[10px] uppercase tracking-wider text-gray-400">
                                                Rating
                                            </div>

                                        </div>

                                    </div>


                                    <a href="{{ route('shop', $shop->slug) }}"
                                        class="mt-5 inline-flex items-center gap-2 text-sm font-bold
                               text-orange-500 hover:text-orange-600">

                                        Visit Shop →

                                    </a>

                                </article>

                            @empty

                                <div class="col-span-full py-16 text-center">

                                    <div class="text-4xl">🏪</div>

                                    <h3 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">
                                        No sellers available yet
                                    </h3>

                                </div>
                            @endforelse

                        </div>

                    </div>

                </section>


                {{-- =========================================================
    SELLER CTA
========================================================== --}}
                <section class="mx-auto max-w-7xl px-6 py-20">

                    <div
                        class="relative overflow-hidden rounded-[2rem]
               bg-gradient-to-br from-gray-950 via-gray-900 to-black
               px-8 py-14 shadow-2xl md:px-16 md:py-20">

                        <div class="absolute -right-32 -top-32 h-80 w-80 rounded-full bg-orange-500/20 blur-3xl"></div>
                        <div class="absolute -bottom-40 -left-20 h-80 w-80 rounded-full bg-orange-500/10 blur-3xl"></div>

                        <div class="relative max-w-3xl">

                            <span
                                class="inline-flex rounded-full border border-orange-500/30
                       bg-orange-500/10 px-4 py-2 text-[10px] font-bold
                       uppercase tracking-[0.2em] text-orange-400">

                                {{ __('discover.grow') }}

                            </span>


                            <h2 class="mt-6 text-4xl font-black tracking-tight text-white md:text-6xl">
                                {{ __('discover.open') }}
                            </h2>


                            <p class="mt-5 max-w-xl text-lg leading-relaxed text-gray-400">
                                {{ __('discover.turn your products') }}
                            </p>


                            <a href="{{ route('shop.create', 1) }}"
                                class="mt-8 inline-flex items-center gap-3 rounded-xl
                       bg-orange-500 px-7 py-4 text-sm font-black uppercase
                       tracking-wider text-white shadow-lg shadow-orange-500/20
                       transition hover:-translate-y-0.5 hover:bg-orange-600">

                                {{ __('discover.start') }}
                                <span>→</span>

                            </a>

                        </div>

                    </div>

                </section>


                {{-- =========================================================
    NEWSLETTER
========================================================== --}}
                <section class="border-t border-gray-100 bg-gray-50 dark:border-gray-900 dark:bg-gray-950">

                    <div class="mx-auto max-w-4xl px-6 py-20 text-center">

                        <span class="text-xs font-black uppercase tracking-[0.2em] text-orange-500">
                            {{ __('discover.stay') }}
                        </span>

                        <h2 class="mt-3 text-3xl font-black text-gray-900 dark:text-white md:text-4xl">
                            {{ __('discover.join') }}
                        </h2>

                        <p class="mx-auto mt-4 max-w-xl text-gray-500 dark:text-gray-400">
                            {{ __('discover.get updates') }}
                        </p>

                        <div class="mt-8">
                            @livewire('newsletter.subscribe')
                        </div>

                    </div>

                </section>

            </div>

            <x-main-footer></x-main-footer>


        </x-main-layout>
