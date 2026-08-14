<x-main-layout>

    @php
        $isArabic = app()->getLocale() === 'ar';
    @endphp

    @section('title', __('sell.main.title') . ' | ' . ($isArabic ? 'مُروَّج.كم' : 'Murwaj'))
    @section('description', __('sell.main.subtitle'))

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    {{-- =========================================================
    HERO
    ========================================================== --}}
    <section dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
        class="flex w-full flex-col items-center justify-center px-4 py-20 text-center">

        <span
            class="mb-5 inline-flex items-center rounded-full border border-orange-200 bg-orange-50 px-4 py-2 text-sm font-semibold text-orange-600 dark:border-orange-500/20 dark:bg-orange-500/10 dark:text-orange-400">
            🚀 {{ __('sell.hero.badge') }}
        </span>

        <h1
            class="mx-auto max-w-4xl font-display text-5xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-7xl">

            {{ __('sell.main.title') }}

            <span class="relative whitespace-nowrap text-orange-500 dark:text-orange-300">

                <svg aria-hidden="true" viewBox="0 0 418 42"
                    class="absolute top-2/3 h-[0.58em] w-full fill-orange-500 dark:fill-orange-300/60
                    {{ $isArabic ? 'right-0' : 'left-0' }}"
                    preserveAspectRatio="none">

                    <path
                        d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.780 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.540-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.810 23.239-7.825 27.934-10.149 28.304-14.005 .417-4.348-3.529-6-16.878-7.066Z">
                    </path>

                </svg>

                <span class="relative">
                    {{ __('sell.hero.highlight') }}
                </span>

            </span>
        </h1>

        <p class="mx-auto mt-12 max-w-2xl text-lg leading-8 text-gray-500 dark:text-gray-300">
            {{ __('sell.main.subtitle') }}
        </p>

        {{-- Hero CTA --}}
        @if (Route::has('login'))

            @auth

                @if (!auth()->user()->shop)
                    <a href="{{ route('shop.create') }}"
                        class="mt-8 rounded-xl bg-orange-600 px-6 py-3 font-semibold text-white shadow-lg shadow-orange-600/20 transition hover:bg-orange-500 sm:mt-10">
                        {{ __('sell.card.started') }}
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}"
                    class="mt-8 rounded-xl bg-orange-600 px-6 py-3 font-semibold text-white shadow-lg shadow-orange-600/20 transition hover:bg-orange-500 sm:mt-10">
                    {{ __('sell.card.started') }}
                </a>

            @endauth

        @endif

    </section>


    {{-- =========================================================
    HOW IT WORKS
    ========================================================== --}}
    <section dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
        class="w-full border-t border-gray-100 bg-gray-50 px-4 py-20 dark:border-gray-800 dark:bg-gray-950">

        <div class="mx-auto max-w-6xl">

            {{-- Section Header --}}
            <div class="mx-auto max-w-2xl text-center">

                <span
                    class="inline-flex rounded-full bg-orange-100 px-4 py-1.5 text-sm font-semibold text-orange-600 dark:bg-orange-500/10 dark:text-orange-400">
                    {{ __('sell.how_it_works.badge') }}
                </span>

                <h2 class="mt-4 text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                    {{ __('sell.how_it_works.title') }}
                </h2>

                <p class="mt-4 leading-7 text-gray-500 dark:text-gray-400">
                    {{ __('sell.how_it_works.subtitle') }}
                </p>

            </div>


            {{-- Steps --}}
            <div class="mt-14 grid gap-6 md:grid-cols-3">

                {{-- Step 1 --}}
                <div
                    class="rounded-3xl border border-gray-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-gray-800 dark:bg-gray-900">

                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-2xl dark:bg-orange-500/10">
                        🏪
                    </div>

                    <div class="mt-6 text-sm font-bold text-orange-600 dark:text-orange-400">
                        {{ __('sell.how_it_works.step_1.number') }}
                    </div>

                    <h3 class="mt-2 text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('sell.how_it_works.step_1.title') }}
                    </h3>

                    <p class="mt-3 leading-7 text-gray-500 dark:text-gray-400">
                        {{ __('sell.how_it_works.step_1.description') }}
                    </p>

                </div>


                {{-- Step 2 --}}
                <div
                    class="rounded-3xl border border-gray-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-gray-800 dark:bg-gray-900">

                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-2xl dark:bg-blue-500/10">
                        📦
                    </div>

                    <div class="mt-6 text-sm font-bold text-blue-600 dark:text-blue-400">
                        {{ __('sell.how_it_works.step_2.number') }}
                    </div>

                    <h3 class="mt-2 text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('sell.how_it_works.step_2.title') }}
                    </h3>

                    <p class="mt-3 leading-7 text-gray-500 dark:text-gray-400">
                        {{ __('sell.how_it_works.step_2.description') }}
                    </p>

                </div>


                {{-- Step 3 --}}
                <div
                    class="rounded-3xl border border-gray-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-gray-800 dark:bg-gray-900">

                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-2xl dark:bg-emerald-500/10">
                        💰
                    </div>

                    <div class="mt-6 text-sm font-bold text-emerald-600 dark:text-emerald-400">
                        {{ __('sell.how_it_works.step_3.number') }}
                    </div>

                    <h3 class="mt-2 text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('sell.how_it_works.step_3.title') }}
                    </h3>

                    <p class="mt-3 leading-7 text-gray-500 dark:text-gray-400">
                        {{ __('sell.how_it_works.step_3.description') }}
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
    SELLER GUIDE
    ========================================================== --}}
    <section dir="{{ $isArabic ? 'rtl' : 'ltr' }}" class="w-full bg-white px-4 py-20 dark:bg-gray-900">

        <div class="mx-auto max-w-6xl">

            <div class="grid items-center gap-12 lg:grid-cols-2">

                {{-- Text --}}
                <div class="{{ $isArabic ? 'text-right' : 'text-left' }}">

                    <span class="text-sm font-bold uppercase tracking-wider text-orange-600 dark:text-orange-400">
                        {{ __('sell.seller_guide.badge') }}
                    </span>

                    <h2 class="mt-3 text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                        {{ __('sell.seller_guide.title') }}
                    </h2>

                    <p class="mt-5 leading-7 text-gray-500 dark:text-gray-400">
                        {{ __('sell.seller_guide.subtitle') }}
                    </p>


                    {{-- Guide Items --}}
                    <div class="mt-8 space-y-5">

                        @foreach (['profile', 'products', 'updates'] as $item)
                            <div class="flex gap-4">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-600 dark:bg-orange-500/10 dark:text-orange-400">
                                    ✓
                                </div>

                                <div class="min-w-0">

                                    <h3 class="font-bold text-gray-900 dark:text-white">
                                        {{ __('sell.seller_guide.items.' . $item . '.title') }}
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">
                                        {{ __('sell.seller_guide.items.' . $item . '.description') }}
                                    </p>

                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>


                {{-- Store Preview --}}
                <div
                    class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-orange-500 via-orange-600 to-amber-500 p-8 shadow-2xl">

                    <div class="absolute -right-20 -top-20 h-56 w-56 rounded-full bg-white/10 blur-2xl"></div>

                    <div class="absolute -bottom-20 -left-20 h-56 w-56 rounded-full bg-white/10 blur-2xl"></div>

                    <div class="relative">

                        <div class="flex items-center justify-between">

                            <span class="text-sm font-semibold text-white/80">
                                {{ __('sell.store_preview.store') }}
                            </span>

                            <span class="rounded-full bg-white/20 px-3 py-1 text-xs font-semibold text-white">
                                {{ __('sell.store_preview.seller') }}
                            </span>

                        </div>


                        <div class="mt-8 rounded-3xl bg-white/10 p-6 backdrop-blur-xl">

                            <div class="flex items-center gap-4">

                                <div
                                    class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white text-2xl shadow-lg">
                                    🛍️
                                </div>

                                <div class="min-w-0">

                                    <h3 class="font-bold text-white">
                                        {{ __('sell.store_preview.name') }}
                                    </h3>

                                    <p class="mt-1 text-sm text-orange-100">
                                        {{ __('sell.store_preview.description') }}
                                    </p>

                                </div>

                            </div>


                            <div class="mt-8 grid grid-cols-2 gap-3">

                                <div class="rounded-2xl bg-white/10 p-4">

                                    <p class="text-xs text-orange-100">
                                        {{ __('sell.store_preview.products') }}
                                    </p>

                                    <p class="mt-1 text-2xl font-bold text-white">
                                        +
                                    </p>

                                </div>

                                <div class="rounded-2xl bg-white/10 p-4">

                                    <p class="text-xs text-orange-100">
                                        {{ __('sell.store_preview.customers') }}
                                    </p>

                                    <p class="mt-1 text-2xl font-bold text-white">
                                        ↗
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
    FINAL CTA
    ========================================================== --}}
    <section dir="{{ $isArabic ? 'rtl' : 'ltr' }}" class="w-full px-4 py-20">

        <div
            class="mx-auto max-w-5xl overflow-hidden rounded-[2rem] bg-gray-950 px-6 py-14 text-center shadow-2xl dark:bg-black sm:px-12">

            <span class="text-4xl">✨</span>

            <h2 class="mt-5 text-3xl font-bold text-white sm:text-4xl">
                {{ __('sell.cta.title') }}
            </h2>

            <p class="mx-auto mt-4 max-w-xl leading-7 text-gray-400">
                {{ __('sell.cta.subtitle') }}
            </p>


            {{-- CTA Button --}}
            @auth

                @if (!auth()->user()->shop)
                    <a href="{{ route('shop.create') }}"
                        class="mt-8 inline-flex rounded-xl bg-orange-600 px-6 py-3 font-semibold text-white transition hover:bg-orange-500">
                        🚀 {{ __('sell.cta.button') }}
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}"
                    class="mt-8 inline-flex rounded-xl bg-orange-600 px-6 py-3 font-semibold text-white transition hover:bg-orange-500">
                    🚀 {{ __('sell.cta.button') }}
                </a>

            @endauth

        </div>

    </section>


    <x-main-footer></x-main-footer>

</x-main-layout>
