<x-main-layout>

    <x-slot name="header">
        <x-main-header />
    </x-slot>

    <div
        class="min-h-screen bg-slate-50 text-slate-900 transition-colors duration-300
           dark:bg-slate-950 dark:text-white">

        {{-- Hero --}}
        <section
            class="relative overflow-hidden border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">

            {{-- Background decoration --}}
            <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
                <div
                    class="absolute -right-32 -top-32 h-96 w-96 rounded-full bg-orange-500/10 blur-3xl
                       dark:bg-orange-500/10">
                </div>

                <div
                    class="absolute -bottom-40 -left-32 h-96 w-96 rounded-full bg-orange-400/10 blur-3xl
                       dark:bg-orange-400/5">
                </div>
            </div>

            <div class="relative mx-auto max-w-7xl px-6 py-16 sm:px-8 lg:px-8">

                <div class="mx-auto max-w-3xl text-center">

                    {{-- Badge --}}
                    <div
                        class="mb-5 inline-flex items-center gap-2 rounded-full border border-orange-200
                           bg-orange-50 px-4 py-2 text-sm font-semibold text-orange-600
                           dark:border-orange-500/20 dark:bg-orange-500/10 dark:text-orange-400">

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7.5A2.5 2.5 0 015.5 5h13A2.5 2.5 0 0121 7.5v9a2.5 2.5 0 01-2.5 2.5h-13A2.5 2.5 0 013 16.5v-9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9h18M7 15h3" />
                        </svg>

                        {{ __('Marketplace Directory') }}
                    </div>

                    <h1 class="text-4xl font-black tracking-tight text-slate-900 sm:text-5xl dark:text-white">
                        {{ __('Sitemap') }}
                    </h1>

                    <p
                        class="mx-auto mt-5 max-w-2xl text-base leading-7 text-slate-600 sm:text-lg
                          dark:text-slate-400">

                        {{ __('Quickly explore the marketplace, discover shops, browse categories and find products.') }}

                    </p>

                </div>

            </div>
        </section>


        {{-- Main Content --}}
        <main class="mx-auto max-w-7xl px-6 py-12 sm:px-8 lg:px-8">

            {{-- Main navigation cards --}}
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

                {{-- Marketplace --}}
                <div
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm
                       transition duration-300 hover:-translate-y-1 hover:border-orange-200 hover:shadow-lg
                       dark:border-slate-800 dark:bg-slate-900 dark:hover:border-orange-500/30">

                    <div
                        class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl
                           bg-orange-50 text-orange-500
                           dark:bg-orange-500/10 dark:text-orange-400">

                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18l-2 13H5L3 7z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7a4 4 0 018 0M9 11h.01M15 11h.01" />
                        </svg>
                    </div>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                        {{ __('Marketplace') }}
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        {{ __('Explore the main areas of the marketplace.') }}
                    </p>

                    <ul class="mt-5 space-y-2">

                        <li>
                            <a href="{{ route('home') }}"
                                class="group/link flex items-center justify-between rounded-lg px-3 py-2
                                   text-sm font-medium text-slate-600 transition
                                   hover:bg-orange-50 hover:text-orange-600
                                   dark:text-slate-300 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">

                                {{ __('Home') }}

                                <span class="opacity-0 transition group-hover/link:opacity-100">→</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('explore') }}"
                                class="group/link flex items-center justify-between rounded-lg px-3 py-2
                                   text-sm font-medium text-slate-600 transition
                                   hover:bg-orange-50 hover:text-orange-600
                                   dark:text-slate-300 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">

                                {{ __('Marketplace') }}

                                <span class="opacity-0 transition group-hover/link:opacity-100">→</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('categories') }}"
                                class="group/link flex items-center justify-between rounded-lg px-3 py-2
                                   text-sm font-medium text-slate-600 transition
                                   hover:bg-orange-50 hover:text-orange-600
                                   dark:text-slate-300 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">

                                {{ __('Categories') }}

                                <span class="opacity-0 transition group-hover/link:opacity-100">→</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('countries') }}"
                                class="group/link flex items-center justify-between rounded-lg px-3 py-2
                                   text-sm font-medium text-slate-600 transition
                                   hover:bg-orange-50 hover:text-orange-600
                                   dark:text-slate-300 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">

                                {{ __('Countries') }}

                                <span class="opacity-0 transition group-hover/link:opacity-100">→</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('plans.index') }}"
                                class="group/link flex items-center justify-between rounded-lg px-3 py-2
                                   text-sm font-medium text-slate-600 transition
                                   hover:bg-orange-50 hover:text-orange-600
                                   dark:text-slate-300 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">

                                {{ __('Pricing') }}

                                <span class="opacity-0 transition group-hover/link:opacity-100">→</span>
                            </a>
                        </li>

                    </ul>
                </div>


                {{-- Categories --}}
                <div
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm
                       transition duration-300 hover:-translate-y-1 hover:border-orange-200 hover:shadow-lg
                       dark:border-slate-800 dark:bg-slate-900 dark:hover:border-orange-500/30">

                    <div
                        class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl
                           bg-orange-50 text-orange-500
                           dark:bg-orange-500/10 dark:text-orange-400">

                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 6.5A2.5 2.5 0 016.5 4h4A2.5 2.5 0 0113 6.5v4a2.5 2.5 0 01-2.5 2.5h-4A2.5 2.5 0 014 10.5v-4zM11 17.5a2.5 2.5 0 012.5-2.5h4a2.5 2.5 0 012.5 2.5v0a2.5 2.5 0 01-2.5 2.5h-4a2.5 2.5 0 01-2.5-2.5z" />
                        </svg>
                    </div>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                        {{ __('Categories') }}
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        {{ __('Browse products by category.') }}
                    </p>

                    <ul class="mt-5 max-h-72 space-y-1 overflow-y-auto pr-2">

                        @forelse ($categories as $category)
                            <li>
                                <a href="{{ route('discover.category', $category->slug) }}"
                                    class="flex items-center justify-between rounded-lg px-3 py-2 text-sm
                                       font-medium text-slate-600 transition
                                       hover:bg-orange-50 hover:text-orange-600
                                       dark:text-slate-300 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">

                                    <span class="truncate">
                                        {{ $category->category_name }}
                                    </span>

                                    <span class="text-slate-300 dark:text-slate-600">
                                        →
                                    </span>

                                </a>
                            </li>

                        @empty

                            <li class="px-3 py-2 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('No categories available.') }}
                            </li>
                        @endforelse

                    </ul>
                </div>


                {{-- Shops --}}
                <div
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm
                       transition duration-300 hover:-translate-y-1 hover:border-orange-200 hover:shadow-lg
                       dark:border-slate-800 dark:bg-slate-900 dark:hover:border-orange-500/30">

                    <div
                        class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl
                           bg-orange-50 text-orange-500
                           dark:bg-orange-500/10 dark:text-orange-400">

                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10l2-5h14l2 5" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 10v9h16v-9M8 19v-5h8v5M3 10h18" />
                        </svg>
                    </div>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                        {{ __('Shops') }}
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        {{ __('Discover sellers and businesses.') }}
                    </p>

                    <ul class="mt-5 max-h-72 space-y-1 overflow-y-auto pr-2">

                        @forelse ($shops as $shop)
                            <li>
                                <a href="{{ route('shop', $shop->slug) }}"
                                    class="flex items-center justify-between rounded-lg px-3 py-2 text-sm
                                       font-medium text-slate-600 transition
                                       hover:bg-orange-50 hover:text-orange-600
                                       dark:text-slate-300 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">

                                    <span class="truncate">
                                        {{ $shop->name }}
                                    </span>

                                    <span class="text-slate-300 dark:text-slate-600">
                                        →
                                    </span>

                                </a>
                            </li>

                        @empty

                            <li class="px-3 py-2 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('No shops available.') }}
                            </li>
                        @endforelse

                    </ul>
                </div>


                {{-- Countries --}}
                <div
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm
                       transition duration-300 hover:-translate-y-1 hover:border-orange-200 hover:shadow-lg
                       dark:border-slate-800 dark:bg-slate-900 dark:hover:border-orange-500/30">

                    <div
                        class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl
                           bg-orange-50 text-orange-500
                           dark:bg-orange-500/10 dark:text-orange-400">

                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">

                            <circle cx="12" cy="12" r="9" />

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 12h18M12 3c2.5 2.7 3.5 5.7 3.5 9s-1 6.3-3.5 9c-2.5-2.7-3.5-5.7-3.5-9S9.5 5.7 12 3z" />

                        </svg>
                    </div>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                        {{ __('Browse by Country') }}
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        {{ __('Find marketplace listings by country.') }}
                    </p>

                    <ul class="mt-5 max-h-72 space-y-1 overflow-y-auto pr-2">

                        @forelse ($countries as $country)
                            <li>
                                <a href="{{ route('countries') }}"
                                    class="flex items-center justify-between rounded-lg px-3 py-2 text-sm
                                       font-medium text-slate-600 transition
                                       hover:bg-orange-50 hover:text-orange-600
                                       dark:text-slate-300 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">

                                    <span class="flex min-w-0 items-center gap-2">

                                        <span class="text-lg">
                                            {{ $country->flag ?? '🌎' }}
                                        </span>

                                        <span class="truncate">
                                            {{ $country->name }}
                                        </span>

                                    </span>

                                    @if (isset($country->shops_count))
                                        <span
                                            class="rounded-full bg-slate-100 px-2 py-0.5 text-xs text-slate-500
                                               dark:bg-slate-800 dark:text-slate-400">

                                            {{ $country->shops_count }}

                                        </span>
                                    @endif

                                </a>
                            </li>

                        @empty

                            <li class="px-3 py-2 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('No countries available.') }}
                            </li>
                        @endforelse

                    </ul>
                </div>

            </div>


            {{-- Latest Products --}}
            <section
                class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm
                   dark:border-slate-800 dark:bg-slate-900">

                <div
                    class="flex flex-col gap-4 border-b border-slate-200 px-6 py-6 sm:flex-row sm:items-center
                       sm:justify-between dark:border-slate-800">

                    <div>

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl
                                   bg-orange-50 text-orange-500 dark:bg-orange-500/10 dark:text-orange-400">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 7h18M5 7v12h14V7M8 7V5a4 4 0 018 0v2" />

                                </svg>

                            </div>

                            <div>

                                <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                                    {{ __('Latest Products') }}
                                </h2>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('Recently added products from the marketplace.') }}
                                </p>

                            </div>

                        </div>

                    </div>

                    <a href="{{ route('explore') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-4 py-2.5
                           text-sm font-semibold text-white shadow-sm transition
                           hover:bg-orange-600 hover:shadow-md">

                        {{ __('Explore Marketplace') }}

                        <span>→</span>

                    </a>

                </div>


                <div class="p-6">

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

                        @forelse ($products as $product)
                            <a href="{{ $product->url }}"
                                class="group rounded-xl border border-slate-200 p-4 transition
                                   hover:-translate-y-1 hover:border-orange-300 hover:shadow-md
                                   dark:border-slate-800 dark:hover:border-orange-500/30">

                                <div
                                    class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl
                                       bg-orange-50 text-orange-500
                                       dark:bg-orange-500/10 dark:text-orange-400">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 7h18M5 7v12h14V7M8 7V5a4 4 0 018 0v2" />

                                    </svg>

                                </div>

                                <h3
                                    class="truncate font-semibold text-slate-900 transition
                                       group-hover:text-orange-600 dark:text-white dark:group-hover:text-orange-400">

                                    {{ $product->name }}

                                </h3>

                                @if ($product->shop)
                                    <p class="mt-1 truncate text-sm text-slate-500 dark:text-slate-400">
                                        {{ $product->shop->name }}
                                    </p>
                                @endif

                            </a>

                        @empty

                            <div class="col-span-full py-10 text-center">

                                <div
                                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-full
                                       bg-slate-100 text-slate-400
                                       dark:bg-slate-800 dark:text-slate-500">

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0l-2 4H6l-2-4m16 0H4" />

                                    </svg>

                                </div>

                                <p class="mt-4 font-medium text-slate-700 dark:text-slate-300">
                                    {{ __('No products available.') }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-500">
                                    {{ __('Check back soon for new listings.') }}
                                </p>

                            </div>
                        @endforelse

                    </div>

                </div>

            </section>


            {{-- Helpful Links --}}
            <section
                class="mt-8 rounded-2xl border border-orange-200 bg-gradient-to-r from-orange-50 to-amber-50 p-6
                   dark:border-orange-500/20 dark:from-orange-500/10 dark:to-amber-500/5">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-start gap-4">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl
                               bg-orange-500 text-white shadow-sm">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 18h.01M12 14v-4m9 2a9 9 0 11-18 0 9 9 0 0118 0z" />

                            </svg>

                        </div>

                        <div>

                            <h2 class="font-bold text-slate-900 dark:text-white">
                                {{ __('Need help?') }}
                            </h2>

                            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                                {{ __('Visit our contact page if you need assistance navigating the marketplace.') }}
                            </p>

                        </div>

                    </div>

                    <a href="{{ route('contact') }}"
                        class="inline-flex shrink-0 items-center justify-center rounded-xl bg-orange-500 px-5 py-2.5
                           text-sm font-semibold text-white shadow-sm transition
                           hover:bg-orange-600">

                        {{ __('Contact Us') }}

                    </a>

                </div>

            </section>

        </main>

    </div>

    <x-main-footer />
</x-main-layout>
