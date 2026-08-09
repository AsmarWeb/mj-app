<x-main-layout>
    @section('title', $title, 'murwaj')
    @section('description', "$description")
    @section('keywords', "$keywords")

    <x-slot name="header">
        <x-main-header />
    </x-slot>

    <div class="min-h-screen bg-white dark:bg-gray-950">

        <section class="max-w-7xl mx-auto px-6 py-10">

            {{-- ========================================================= --}}
            {{-- SECTION HEADER                                           --}}
            {{-- ========================================================= --}}
            <div
                class="relative overflow-hidden rounded-3xl
               bg-gradient-to-r from-orange-500 to-red-500
               text-white p-8 md:p-10 mb-10 shadow-xl">

                {{-- Background decoration --}}
                <div
                    class="absolute -right-20 -top-20
                   h-64 w-64 rounded-full
                   bg-white/10 blur-3xl">
                </div>

                <div
                    class="absolute -left-20 -bottom-20
                   h-64 w-64 rounded-full
                   bg-black/10 blur-3xl">
                </div>

                <div class="relative flex flex-col sm:flex-row items-center sm:items-center gap-6">

                    {{-- Section Image --}}
                    <div
                        class="w-24 h-24 md:w-28 md:h-28 shrink-0
                       rounded-3xl
                       bg-white/20
                       border border-white/20
                       backdrop-blur
                       flex items-center justify-center
                       shadow-lg">

                        @if ($section->image)
                            <img src="{{ asset('storage/section-suggest/' . $section->image) }}"
                                alt="{{ app()->getLocale() === 'ar' ? $section->name_ar ?? $section->name : $section->name }}"
                                class="w-16 h-16 md:w-20 md:h-20 object-contain">
                        @else
                            <span class="text-5xl">
                                🛍️
                            </span>
                        @endif

                    </div>


                    {{-- Section Information --}}
                    <div class="text-center sm:text-left">

                        @php
                            $sectionName =
                                app()->getLocale() === 'ar' ? $section->name_ar ?? $section->name : $section->name;
                        @endphp

                        <div
                            class="text-xs font-bold uppercase
                           tracking-[0.2em]
                           text-orange-100">
                            Murwaj Marketplace
                        </div>

                        <h1 class="mt-2 text-3xl md:text-5xl
                           font-black tracking-tight">

                            {{ $sectionName }}

                        </h1>

                        <p class="mt-3 text-orange-100">

                            {{ number_format($products->total()) }}

                            {{ $products->total() === 1 ? 'Product' : 'Products' }}

                            Available

                        </p>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- SECTION DESCRIPTION                                      --}}
            {{-- ========================================================= --}}
            <div class="mb-8">

                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">

                    <div>

                        <span
                            class="text-xs font-bold uppercase
                           tracking-[0.2em]
                           text-orange-500">
                            Explore
                        </span>

                        <h2
                            class="mt-2 text-2xl md:text-3xl
                           font-black
                           text-gray-900 dark:text-white">

                            {{ $sectionName }}

                        </h2>

                        <p class="mt-2 text-gray-500 dark:text-gray-400">

                            Browse all published products and listings
                            available in this marketplace section.

                        </p>

                    </div>

                    <a href="{{ route('explore') }}"
                        class="inline-flex items-center gap-2
                       text-sm font-bold
                       text-orange-500
                       hover:text-orange-600
                       transition">

                        ← Back to Marketplace

                    </a>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- PRODUCTS                                                 --}}
            {{-- ========================================================= --}}
            @if ($products->count())

                <div
                    class="grid
                   grid-cols-2
                   sm:grid-cols-2
                   md:grid-cols-3
                   lg:grid-cols-4
                   xl:grid-cols-5
                   gap-5 md:gap-6">

                    @foreach ($products as $product)
                        <article
                            class="group overflow-hidden
                           rounded-3xl
                           border border-gray-100
                           dark:border-gray-800
                           bg-white
                           dark:bg-gray-900
                           shadow-sm
                           hover:-translate-y-1
                           hover:shadow-2xl
                           transition-all duration-300">

                            {{-- ================================================= --}}
                            {{-- PRODUCT IMAGE                                    --}}
                            {{-- ================================================= --}}
                            <a href="{{ $product->url ?? '#' }}" class="block">

                                <div
                                    class="relative
                                   aspect-square
                                   overflow-hidden
                                   bg-gray-100
                                   dark:bg-gray-800">

                                    @if ($product->image)
                                        <img src="{{ asset('storage/products/' . $product->image) }}"
                                            alt="{{ $product->title }}"
                                            class="h-full w-full object-cover
                                           group-hover:scale-105
                                           transition duration-700">
                                    @else
                                        <div
                                            class="flex h-full w-full
                                           items-center justify-center
                                           bg-gradient-to-br
                                           from-gray-100 to-gray-200
                                           dark:from-gray-800
                                           dark:to-gray-900">

                                            <span class="text-5xl">
                                                📦
                                            </span>

                                        </div>
                                    @endif


                                    {{-- WATERMARK --}}
                                    @if (file_exists(public_path('watermark.png')))
                                        <img src="{{ asset('watermark.png') }}" alt=""
                                            class="absolute
                                           top-3 right-3
                                           h-9 w-9
                                           rounded-full
                                           border-2
                                           border-white/80
                                           shadow-lg">
                                    @endif


                                    {{-- FEATURED --}}
                                    @if ($product->featured)
                                        <span
                                            class="absolute
                                           left-3 top-3
                                           rounded-full
                                           bg-orange-500
                                           px-3 py-1.5
                                           text-[10px]
                                           font-black
                                           uppercase
                                           tracking-wider
                                           text-white
                                           shadow-lg">

                                            ★ Featured

                                        </span>
                                    @endif

                                </div>

                            </a>


                            {{-- ================================================= --}}
                            {{-- PRODUCT INFORMATION                              --}}
                            {{-- ================================================= --}}
                            <div class="p-4 md:p-5">

                                {{-- Shop --}}
                                @if ($product->shop)
                                    <a href="{{ route('shop', $product->shop->slug) }}"
                                        class="block truncate
                                       text-[10px]
                                       md:text-xs
                                       font-bold
                                       uppercase
                                       tracking-wider
                                       text-orange-500
                                       hover:text-orange-600
                                       transition">

                                        {{ $product->shop->name }}

                                    </a>
                                @else
                                    <span
                                        class="text-[10px]
                                       md:text-xs
                                       font-bold
                                       uppercase
                                       tracking-wider
                                       text-gray-400">

                                        Marketplace

                                    </span>
                                @endif


                                {{-- Product title --}}
                                <a href="{{ $product->url ?? '#' }}" class="block">

                                    <h3
                                        class="mt-2
                                       line-clamp-2
                                       text-sm md:text-base
                                       font-black
                                       leading-snug
                                       text-gray-900
                                       dark:text-white
                                       group-hover:text-orange-500
                                       transition">

                                        {{ $product->title }}

                                    </h3>

                                </a>


                                {{-- Category --}}
                                @if ($product->category)
                                    <div
                                        class="mt-2
                                       text-xs
                                       text-gray-400
                                       dark:text-gray-500
                                       truncate">

                                        {{ app()->getLocale() === 'ar'
                                            ? $product->category->category_name_ar ?? $product->category->category_name
                                            : $product->category->category_name }}

                                    </div>
                                @endif


                                {{-- Price --}}
                                <div
                                    class="mt-4
                                   flex
                                   items-center
                                   justify-between
                                   gap-3">

                                    <span
                                        class="text-lg md:text-xl
                                       font-black
                                       text-orange-500">

                                        AED {{ number_format((float) ($product->price ?? 0), 2) }}

                                    </span>


                                    <a href="{{ $product->url ?? '#' }}"
                                        class="shrink-0
                                       rounded-xl
                                       bg-gray-900
                                       dark:bg-white
                                       px-3 py-2
                                       text-[10px]
                                       md:text-xs
                                       font-black
                                       uppercase
                                       tracking-wider
                                       text-white
                                       dark:text-gray-900
                                       hover:bg-orange-500
                                       hover:text-white
                                       dark:hover:bg-orange-500
                                       dark:hover:text-white
                                       transition">

                                        View

                                    </a>

                                </div>

                            </div>

                        </article>
                    @endforeach

                </div>


                {{-- ========================================================= --}}
                {{-- PAGINATION                                               --}}
                {{-- ========================================================= --}}
                @if ($products->hasPages())
                    <div class="mt-12">

                        {{ $products->withQueryString()->links() }}

                    </div>
                @endif
            @else
                {{-- ========================================================= --}}
                {{-- EMPTY STATE                                               --}}
                {{-- ========================================================= --}}
                <div
                    class="rounded-3xl
                   border border-dashed
                   border-gray-200
                   dark:border-gray-800
                   bg-gray-50/70
                   dark:bg-gray-900/50
                   px-6 py-24
                   text-center">

                    <div
                        class="mx-auto flex h-20 w-20
                       items-center justify-center
                       rounded-3xl
                       bg-orange-50
                       dark:bg-orange-950/30">

                        <span class="text-4xl">
                            📦
                        </span>

                    </div>

                    <h2
                        class="mt-6 text-2xl md:text-3xl
                       font-black
                       text-gray-900
                       dark:text-white">

                        No Products Found

                    </h2>

                    <p
                        class="mx-auto mt-3 max-w-lg
                       text-gray-500
                       dark:text-gray-400">

                        There are currently no published products
                        available in the
                        <strong class="text-gray-700 dark:text-gray-300">
                            {{ $sectionName }}
                        </strong>
                        section.

                    </p>

                    <a href="{{ route('explore') }}"
                        class="mt-7 inline-flex items-center gap-2
                       rounded-xl
                       bg-orange-500
                       px-6 py-3
                       text-sm font-black
                       uppercase
                       tracking-wider
                       text-white
                       hover:bg-orange-600
                       transition">

                        Browse Marketplace

                        <span>→</span>

                    </a>

                </div>

            @endif

        </section>

    </div>

    <x-main-footer />


</x-main-layout>
