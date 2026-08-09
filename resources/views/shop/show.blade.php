<x-main-layout>
    @section('title', $title)
    @section('description', $description)
    @section('keywords', $keywords)

    <x-slot name="header">
        <x-main-header />
    </x-slot>

    <div
        class="min-h-screen bg-[#faf8f5] text-slate-900 transition-colors duration-300 dark:bg-[#0b0b0c] dark:text-white">

        {{-- ========================================================= --}}
        {{-- SHOP HERO --}}
        {{-- ========================================================= --}}

        <section class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 lg:py-10">

            <div
                class="relative overflow-hidden rounded-[2rem] border border-black/5 bg-white shadow-[0_20px_70px_-30px_rgba(0,0,0,0.25)] dark:border-white/10 dark:bg-[#151516]">

                {{-- Banner --}}
                <div class="relative h-64 overflow-hidden sm:h-80 lg:h-[26rem]">


                    <img src="{{ $shop->banner ? asset('storage/' . $shop->banner) : asset('shop-banner.jpg') }}"
                        alt="{{ $shop->name }}"
                        class="h-full w-full object-cover transition duration-700 hover:scale-[1.02]">

                    {{-- Luxury overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-black/10"></div>

                    {{-- Official Store Badge --}}
                    <div class="absolute right-5 top-5 sm:right-8 sm:top-8">

                        <span
                            class="inline-flex items-center gap-2 rounded-full
               border border-white/20
               bg-black/30
               px-4 py-2.5
               text-xs font-bold uppercase tracking-[0.18em]
               text-white
               shadow-xl shadow-black/20
               backdrop-blur-xl">

                            <span class="flex h-2.5 w-2.5 items-center justify-center">
                                <span
                                    class="absolute h-2.5 w-2.5 rounded-full bg-orange-400 opacity-40 animate-ping"></span>
                                <span
                                    class="relative h-2 w-2 rounded-full bg-orange-400 shadow-[0_0_10px_rgba(251,146,60,0.8)]"></span>
                            </span>

                            Official Store

                        </span>

                    </div>

                </div>


                {{-- Shop information --}}
                <div class="relative px-5 pb-7 sm:px-8 lg:px-10">

                    <div class="-mt-14 flex flex-col gap-6 md:-mt-16 md:flex-row md:items-end">

                        {{-- Logo --}}
                        <div
                            class="relative h-28 w-28 shrink-0 overflow-hidden rounded-[1.75rem] border-[6px] border-white bg-white shadow-2xl dark:border-[#151516] dark:bg-[#1c1c1e] sm:h-32 sm:w-32">

                            @if ($shop->logo)
                                <img src="{{ asset('storage/' . $shop->logo) }}" alt="{{ $shop->name }}"
                                    class="h-full w-full object-cover">
                            @else
                                <div
                                    class="flex h-full w-full items-center justify-center bg-gradient-to-br from-orange-500 via-orange-600 to-amber-700 text-5xl font-black text-white">
                                    {{ strtoupper(substr($shop->name, 0, 1)) }}
                                </div>
                            @endif

                        </div>


                        {{-- Shop details --}}
                        <div class="min-w-0 flex-1">

                            <div class="flex flex-wrap items-center gap-3">

                                <h1
                                    class="bg-gradient-to-r from-amber-200 via-yellow-400 to-orange-500
       bg-clip-text text-3xl font-black tracking-tight text-transparent
       dark:from-amber-100 dark:via-yellow-300 dark:to-orange-400
       sm:text-4xl">
                                    {{ $shop->name }}
                                </h1>



                                @if ($shop->verified)
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full
               bg-orange-50 px-4 py-2
               text-xs font-bold tracking-wide text-orange-700
               ring-1 ring-inset ring-orange-200
               shadow-sm shadow-orange-100
               dark:bg-orange-500/10
               dark:text-orange-400
               dark:ring-orange-500/20">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                            viewBox="0 0 20 20" aria-hidden="true">

                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-7.5 7.5a1 1 0 01-1.414 0l-3-3a1 1 0 011.414-1.414L8.5 12.086l6.793-6.793a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />

                                        </svg>

                                        Verified

                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full
               bg-slate-100 px-4 py-2
               text-xs font-semibold tracking-wide text-slate-500
               ring-1 ring-inset ring-slate-200
               dark:bg-slate-800
               dark:text-slate-400
               dark:ring-slate-700">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                            aria-hidden="true">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 8v4m0 4h.01M10.29 3.86L1.82 18A2 2 0 003.53 21h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />

                                        </svg>

                                        Not Verified

                                    </span>
                                @endif


                            </div>



                            @if ($shop->slug)
                                <p
                                    class="mt-3 text-sm font-semibold tracking-wide text-orange-600 dark:text-orange-400 sm:text-base">
                                    {{ '@' . $shop->slug }}
                                </p>
                            @endif


                            {{-- Stats --}}
                            <div class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-3 text-sm">

                                <span
                                    class="inline-flex items-center gap-1.5 font-semibold text-slate-700 dark:text-slate-200">
                                    <span class="text-orange-500">★</span>
                                    {{ number_format($shop->rating ?? 5, 1) }}
                                </span>

                                <span class="text-slate-300 dark:text-slate-700">•</span>

                                <span class="text-slate-500 dark:text-slate-400">
                                    {{ $products->total() }} Products
                                </span>

                                <span class="text-slate-300 dark:text-slate-700">•</span>

                                <span class="text-slate-500 dark:text-slate-400">
                                    ♥ {{ number_format($shop->followers_count) }} Followers
                                </span>

                                @if ($shop->city)
                                    <span class="text-slate-300 dark:text-slate-700">•</span>

                                    <span class="text-slate-500 dark:text-slate-400">
                                        📍 {{ $shop->city->name }}
                                    </span>
                                @endif

                            </div>

                        </div>


                        {{-- Follow --}}
                        <div class="w-full md:w-auto">

                            @auth

                                @if (auth()->id() !== $shop->user_id)
                                    @php
                                        $following = auth()->user()->followedShops->contains($shop->id);
                                    @endphp

                                    <form action="{{ route('shops.follow', $shop) }}" method="POST">
                                        @csrf

                                        <button type="submit"
                                            class="{{ $following
                                                ? 'border border-slate-200 bg-slate-100 text-slate-800 hover:bg-slate-200 dark:border-white/10 dark:bg-white/10 dark:text-white dark:hover:bg-white/15'
                                                : 'bg-gradient-to-r from-orange-500 to-amber-500 text-white shadow-lg shadow-orange-500/20 hover:from-orange-600 hover:to-amber-600' }}
                                        inline-flex w-full items-center justify-center gap-2 rounded-2xl px-7 py-3.5 text-sm font-extrabold transition duration-200 md:w-auto">
                                            {{ $following ? '✓ Following' : '+ Follow Shop' }}
                                        </button>

                                    </form>
                                @endif

                            @endauth


                            @guest

                                <a href="{{ route('login') }}"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-orange-500 to-amber-500 px-7 py-3.5 text-sm font-extrabold text-white shadow-lg shadow-orange-500/20 transition hover:from-orange-600 hover:to-amber-600 md:w-auto">
                                    + Follow Shop
                                </a>

                            @endguest

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- SHOP NAVIGATION --}}
        {{-- ========================================================= --}}

        <section
            class="sticky top-16 z-30 border-y border-slate-200/80 bg-[#faf8f5]/90 backdrop-blur-xl dark:border-white/10 dark:bg-[#0b0b0c]/90">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <nav class="flex gap-2 overflow-x-auto py-3">

                    <a href="#products"
                        class="whitespace-nowrap rounded-xl bg-slate-950 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-orange-600 dark:bg-white dark:text-slate-950 dark:hover:bg-orange-500 dark:hover:text-white">
                        Products
                    </a>

                    <a href="#reviews"
                        class="whitespace-nowrap rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-orange-200 hover:bg-orange-50 hover:text-orange-600 dark:border-white/10 dark:bg-white/5 dark:text-slate-300 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">
                        Reviews
                    </a>

                    <a href="#about"
                        class="whitespace-nowrap rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-orange-200 hover:bg-orange-50 hover:text-orange-600 dark:border-white/10 dark:bg-white/5 dark:text-slate-300 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">
                        About
                    </a>

                </nav>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- PRODUCTS --}}
        {{-- ========================================================= --}}

        <section id="products" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">


            {{-- Categories --}}
            @if ($categories->count())

                <div class="mb-12">

                    <div class="mb-5 flex items-end justify-between gap-4">

                        <div>

                            <p
                                class="text-xs font-black uppercase tracking-[0.2em] text-orange-600 dark:text-orange-400">
                                Explore
                            </p>

                            <h2 class="mt-1 text-2xl font-black text-slate-950 dark:text-white">
                                Shop Categories
                            </h2>

                        </div>

                    </div>


                    <div class="flex flex-wrap gap-3">

                        @foreach ($categories as $category)
                            <span
                                class="rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:-translate-y-0.5 hover:border-orange-200 hover:bg-orange-50 hover:text-orange-700 dark:border-white/10 dark:bg-white/5 dark:text-slate-300 dark:hover:border-orange-500/30 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">
                                {{ $category->category_name ?? $category->name }}
                            </span>
                        @endforeach

                    </div>

                </div>

            @endif


            {{-- Product heading --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <p class="text-xs font-black uppercase tracking-[0.2em] text-orange-600 dark:text-orange-400">
                        Collection
                    </p>

                    <h2 class="mt-1 text-3xl font-black tracking-tight text-slate-950 dark:text-white sm:text-4xl">
                        {{ $shop->name }} Products
                    </h2>

                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                        {{ $products->total() }} premium products available
                    </p>

                </div>

            </div>


            {{-- Product grid --}}
            <div class="grid grid-cols-2 gap-4 sm:gap-6 md:grid-cols-3 lg:grid-cols-4">

                @forelse ($products as $product)
                    <article
                        class="group overflow-hidden rounded-[1.5rem] border border-slate-200/80 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-orange-200 hover:shadow-[0_20px_50px_-25px_rgba(249,115,22,0.35)] dark:border-white/10 dark:bg-[#151516] dark:hover:border-orange-500/30">

                        {{-- Image --}}
                        <div class="relative aspect-[4/4.5] overflow-hidden bg-slate-100 dark:bg-[#202022]">

                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}"
                                loading="lazy"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

                            <div class="absolute inset-x-0 top-0 flex items-start justify-between p-3">

                                @if ($product->product_type == 'digital')
                                    <span
                                        class="rounded-full bg-purple-600 px-3 py-1.5 text-[10px] font-black uppercase tracking-wide text-white shadow-lg">
                                        Digital
                                    </span>
                                @else
                                    <span></span>
                                @endif

                                <span
                                    class="rounded-full bg-black/30 px-3 py-1.5 text-xs font-semibold text-white backdrop-blur-md">
                                    View
                                </span>

                            </div>

                        </div>


                        {{-- Content --}}
                        <div class="p-4 sm:p-5">

                            <h3 class="line-clamp-1 text-base font-extrabold text-slate-900 dark:text-white sm:text-lg">
                                {{ $product->title }}
                            </h3>

                            <p
                                class="mt-2 line-clamp-2 min-h-[2.5rem] text-xs leading-5 text-slate-500 dark:text-slate-400 sm:text-sm">
                                {{ Str::limit($product->description, 70) }}
                            </p>


                            <div class="mt-5 flex items-center justify-between gap-2">

                                <div>

                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Price
                                    </p>

                                    <span class="text-lg font-black text-orange-600 dark:text-orange-400 sm:text-xl">
                                        {{ $shop->currency }}
                                        {{ number_format($product->price, 2) }}
                                    </span>

                                </div>


                                <a href="{{ $product->url }}"
                                    class="rounded-xl bg-slate-950 px-4 py-2.5 text-xs font-bold text-white transition hover:bg-orange-600 dark:bg-white dark:text-slate-950 dark:hover:bg-orange-500 dark:hover:text-white">
                                    View
                                </a>

                            </div>

                        </div>

                    </article>

                @empty

                    <div class="col-span-full">

                        <div
                            class="rounded-[2rem] border border-dashed border-slate-300 bg-white px-6 py-20 text-center dark:border-white/10 dark:bg-[#151516]">

                            <div
                                class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 text-2xl dark:bg-orange-500/10">
                                🛍️
                            </div>

                            <h3 class="mt-5 text-2xl font-black text-slate-900 dark:text-white">
                                No products yet
                            </h3>

                            <p class="mx-auto mt-2 max-w-md text-sm text-slate-500 dark:text-slate-400">
                                This shop is preparing something special. Check back soon for new products.
                            </p>

                        </div>

                    </div>
                @endforelse

            </div>


            {{-- Pagination --}}
            @if ($products->hasPages())
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @endif

        </section>


        {{-- ========================================================= --}}
        {{-- REVIEWS --}}
        {{-- ========================================================= --}}

        <section id="reviews"
            class="border-y border-slate-200/80 bg-white/60 dark:border-white/10 dark:bg-[#111112]">

            <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">

                <div class="mb-8">

                    <p class="text-xs font-black uppercase tracking-[0.2em] text-orange-600 dark:text-orange-400">
                        Customer Experience
                    </p>

                    <h2 class="mt-1 text-3xl font-black text-slate-950 dark:text-white">
                        What customers say
                    </h2>

                </div>

                <livewire:shop-review :shop="$shop" />

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- ABOUT --}}
        {{-- ========================================================= --}}

        <section id="about" class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">

            <div class="grid gap-8 lg:grid-cols-[1.4fr_1fr]">


                {{-- About card --}}
                <div
                    class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-7 shadow-sm sm:p-9 dark:border-white/10 dark:bg-[#151516]">

                    <div
                        class="absolute -right-20 -top-20 h-48 w-48 rounded-full bg-orange-200/30 blur-3xl dark:bg-orange-500/10">
                    </div>

                    <div class="relative">

                        <p class="text-xs font-black uppercase tracking-[0.2em] text-orange-600 dark:text-orange-400">
                            Our Story
                        </p>

                        <h2 class="mt-2 text-3xl font-black text-slate-950 dark:text-white">
                            About {{ $shop->name }}
                        </h2>

                        <p class="mt-6 text-base leading-8 text-slate-600 dark:text-slate-300">
                            {{ $shop->description }}
                        </p>


                        {{-- Shop details --}}
                        <div class="mt-8 grid gap-4 sm:grid-cols-2">

                            <div class="rounded-2xl bg-slate-50 p-5 dark:bg-white/5">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Location
                                </p>

                                <p class="mt-2 font-bold text-slate-900 dark:text-white">
                                    {{ $shop->city->name ?? 'Not available' }}
                                    {{ $shop->state->name ?? '' }}
                                </p>

                            </div>


                            <div class="rounded-2xl bg-slate-50 p-5 dark:bg-white/5">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Member Since
                                </p>

                                <p class="mt-2 font-bold text-slate-900 dark:text-white">
                                    {{ $shop->created_at ? $shop->created_at->format('F Y') : 'Not available' }}
                                </p>

                            </div>


                            <div class="rounded-2xl bg-slate-50 p-5 dark:bg-white/5">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Store Views
                                </p>

                                <p class="mt-2 font-bold text-slate-900 dark:text-white">
                                    {{ number_format($shop->views) }}
                                </p>

                            </div>


                            <div class="rounded-2xl bg-slate-50 p-5 dark:bg-white/5">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Followers
                                </p>

                                <p class="mt-2 font-bold text-slate-900 dark:text-white">
                                    {{ number_format($shop->followers_count) }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Trust card --}}
                <div
                    class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-slate-950 via-slate-900 to-orange-950 p-7 text-white shadow-xl sm:p-9">

                    <div class="absolute -right-20 -top-20 h-56 w-56 rounded-full bg-orange-500/20 blur-3xl"></div>

                    <div class="relative">

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-500 text-2xl shadow-lg shadow-orange-500/20">
                            ✦
                        </div>

                        <h3 class="mt-7 text-2xl font-black">
                            Shop with confidence
                        </h3>

                        <p class="mt-3 text-sm leading-7 text-slate-300">
                            Discover products from {{ $shop->name }} with a premium shopping experience designed
                            around trust and transparency.
                        </p>


                        <div class="mt-8 space-y-4">

                            @if ($shop->verified)
                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-full
                   bg-orange-500/10 text-orange-400
                   ring-1 ring-inset ring-orange-400/20
                   shadow-sm shadow-orange-500/10">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                            viewBox="0 0 20 20" aria-hidden="true">

                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-7.5 7.5a1 1 0 01-1.414 0l-3-3a1 1 0 011.414-1.414L8.5 12.086l6.793-6.793a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />

                                        </svg>

                                    </div>

                                    <span class="text-sm font-semibold tracking-wide text-white">
                                        Verified Seller
                                    </span>

                                </div>
                            @else
                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-full
                   bg-white/5 text-slate-400
                   ring-1 ring-inset ring-white/10">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                            aria-hidden="true">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 8v4m0 4h.01M10.29 3.86L1.82 18A2 2 0 003.53 21h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />

                                        </svg>

                                    </div>

                                    <span class="text-sm font-medium tracking-wide text-slate-400">
                                        Not Verified
                                    </span>

                                </div>
                            @endif



                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 text-orange-400">
                                    ★
                                </div>

                                <span class="text-sm font-semibold">
                                    Customer reviews
                                </span>

                            </div>


                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 text-orange-400">
                                    🔒
                                </div>

                                <span class="text-sm font-semibold">
                                    Secure marketplace
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

    <x-main-footer />

</x-main-layout>
