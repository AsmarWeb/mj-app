{{-- ========================================================= --}}
{{-- ADMIN DASHBOARD --}}
{{-- ========================================================= --}}

<div class="min-h-screen bg-slate-50 dark:bg-slate-950">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <header class="border-b border-slate-200 bg-white
               dark:border-slate-800 dark:bg-slate-900">

        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                {{-- Title --}}
                <div class="flex items-center gap-4">

                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center
                               rounded-2xl bg-indigo-600
                               shadow-lg shadow-indigo-200
                               dark:shadow-indigo-950/40">

                        <x-application-logo class="h-7 w-auto text-white" />

                    </div>

                    <div>

                        <div class="flex items-center gap-2">

                            <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">
                                Admin Dashboard
                            </h1>

                            <span
                                class="hidden rounded-full bg-indigo-50 px-2.5 py-1
                                       text-[10px] font-bold uppercase tracking-wider
                                       text-indigo-600 sm:inline-flex
                                       dark:bg-indigo-500/10 dark:text-indigo-400">
                                Admin
                            </span>

                        </div>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Welcome back! Here's what's happening with your platform.
                        </p>

                    </div>

                </div>


                {{-- System Status --}}
                <div
                    class="inline-flex w-fit items-center rounded-full
                           border border-emerald-200
                           bg-emerald-50 px-3.5 py-2
                           text-sm font-semibold text-emerald-700
                           dark:border-emerald-900/50
                           dark:bg-emerald-950/30
                           dark:text-emerald-400">

                    <span class="relative mr-2 flex h-2.5 w-2.5">

                        <span
                            class="absolute inline-flex h-full w-full
                                   animate-ping rounded-full
                                   bg-emerald-400 opacity-60">
                        </span>

                        <span
                            class="relative inline-flex h-2.5 w-2.5
                                   rounded-full bg-emerald-500">
                        </span>

                    </span>

                    System Online

                </div>

            </div>

        </div>

    </header>


    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">


        {{-- ===================================================== --}}
        {{-- OVERVIEW HEADER --}}
        {{-- ===================================================== --}}

        <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <p class="text-xs font-bold uppercase tracking-[0.18em] text-indigo-600 dark:text-indigo-400">
                    Overview
                </p>

                <h2 class="mt-1 text-xl font-black tracking-tight text-slate-900 dark:text-white">
                    Platform Overview
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Monitor your marketplace activity at a glance.
                </p>

            </div>

            <div class="text-xs font-medium text-slate-400">
                Live statistics
            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- STATISTICS --}}
        {{-- ===================================================== --}}

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">


            {{-- Shops --}}
            <a href="{{ route('shops.index') }}"
                class="group relative overflow-hidden rounded-2xl
                       border border-slate-200 bg-white p-6
                       shadow-sm transition-all duration-300
                       hover:-translate-y-1 hover:border-indigo-200
                       hover:shadow-xl hover:shadow-indigo-100/50
                       focus:outline-none focus:ring-2
                       focus:ring-indigo-500 focus:ring-offset-2
                       dark:border-slate-800 dark:bg-slate-900
                       dark:hover:border-indigo-500/40
                       dark:hover:shadow-none">

                <div
                    class="absolute -right-10 -top-10 h-28 w-28 rounded-full
                           bg-indigo-50 transition-transform duration-500
                           group-hover:scale-150
                           dark:bg-indigo-500/5">
                </div>

                <div class="relative">

                    <div class="flex items-start justify-between">

                        <div
                            class="flex h-12 w-12 items-center justify-center
                                   rounded-xl bg-indigo-100 text-indigo-600
                                   dark:bg-indigo-500/10 dark:text-indigo-400">

                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 21V9.75m0 0a3 3 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016A2.993 2.993 0 0 0 14.25 9.75c.896 0 1.7-.393 2.25-1.015a3 3 0 0 0 3.75.614V21M3.75 21h16.5M6 21v-3h3v3m6 0v-3h3v3M3.75 9.75l1.189-5.94A1.5 1.5 0 0 1 6.409 2.5h11.182a1.5 1.5 0 0 1 1.47 1.31l1.189 5.94" />

                            </svg>

                        </div>

                        <span
                            class="rounded-full bg-slate-100 px-2.5 py-1
                                   text-[10px] font-bold uppercase tracking-wider
                                   text-slate-500
                                   dark:bg-slate-800 dark:text-slate-400">
                            Total
                        </span>

                    </div>

                    <div class="mt-5">

                        <p class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                            {{ number_format($shopCount) }}
                        </p>

                        <div class="mt-1 flex items-center justify-between">

                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                Shops
                            </p>

                            <span
                                class="text-xs font-bold text-indigo-600
                                       opacity-0 transition
                                       group-hover:opacity-100
                                       dark:text-indigo-400">
                                View →
                            </span>

                        </div>

                    </div>

                </div>

            </a>


            {{-- Users --}}
            <a href="{{ route('user.index') }}"
                class="group relative overflow-hidden rounded-2xl
                       border border-slate-200 bg-white p-6
                       shadow-sm transition-all duration-300
                       hover:-translate-y-1 hover:border-blue-200
                       hover:shadow-xl hover:shadow-blue-100/50
                       focus:outline-none focus:ring-2
                       focus:ring-blue-500 focus:ring-offset-2
                       dark:border-slate-800 dark:bg-slate-900
                       dark:hover:border-blue-500/40
                       dark:hover:shadow-none">

                <div
                    class="absolute -right-10 -top-10 h-28 w-28 rounded-full
                           bg-blue-50 transition-transform duration-500
                           group-hover:scale-150
                           dark:bg-blue-500/5">
                </div>

                <div class="relative">

                    <div class="flex items-start justify-between">

                        <div
                            class="flex h-12 w-12 items-center justify-center
                                   rounded-xl bg-blue-100 text-blue-600
                                   dark:bg-blue-500/10 dark:text-blue-400">

                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />

                                <circle cx="9" cy="7" r="4" />

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M23 21v-2a4 4 0 0 0-3-3.87m-4-12a4 4 0 0 1 0 7.75" />

                            </svg>

                        </div>

                        <span
                            class="rounded-full bg-slate-100 px-2.5 py-1
                                   text-[10px] font-bold uppercase tracking-wider
                                   text-slate-500
                                   dark:bg-slate-800 dark:text-slate-400">
                            Total
                        </span>

                    </div>

                    <div class="mt-5">

                        <p class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                            {{ number_format($userCount) }}
                        </p>

                        <div class="mt-1 flex items-center justify-between">

                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                Users
                            </p>

                            <span
                                class="text-xs font-bold text-blue-600
                                       opacity-0 transition
                                       group-hover:opacity-100
                                       dark:text-blue-400">
                                View →
                            </span>

                        </div>

                    </div>

                </div>

            </a>


            {{-- Products --}}
            <a href="{{ route('listings.index') }}"
                class="group relative overflow-hidden rounded-2xl
                       border border-slate-200 bg-white p-6
                       shadow-sm transition-all duration-300
                       hover:-translate-y-1 hover:border-violet-200
                       hover:shadow-xl hover:shadow-violet-100/50
                       focus:outline-none focus:ring-2
                       focus:ring-violet-500 focus:ring-offset-2
                       dark:border-slate-800 dark:bg-slate-900
                       dark:hover:border-violet-500/40
                       dark:hover:shadow-none">

                <div
                    class="absolute -right-10 -top-10 h-28 w-28 rounded-full
                           bg-violet-50 transition-transform duration-500
                           group-hover:scale-150
                           dark:bg-violet-500/5">
                </div>

                <div class="relative">

                    <div class="flex items-start justify-between">

                        <div
                            class="flex h-12 w-12 items-center justify-center
                                   rounded-xl bg-violet-100 text-violet-600
                                   dark:bg-violet-500/10 dark:text-violet-400">

                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />

                            </svg>

                        </div>

                        <span
                            class="rounded-full bg-slate-100 px-2.5 py-1
                                   text-[10px] font-bold uppercase tracking-wider
                                   text-slate-500
                                   dark:bg-slate-800 dark:text-slate-400">
                            Total
                        </span>

                    </div>

                    <div class="mt-5">

                        <p class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                            {{ number_format($listingCount) }}
                        </p>

                        <div class="mt-1 flex items-center justify-between">

                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                Products
                            </p>

                            <span
                                class="text-xs font-bold text-violet-600
                                       opacity-0 transition
                                       group-hover:opacity-100
                                       dark:text-violet-400">
                                View →
                            </span>

                        </div>

                    </div>

                </div>

            </a>


            {{-- Subscribers --}}
            <a href="{{ route('subscribers.index') }}"
                class="group relative overflow-hidden rounded-2xl
                       border border-slate-200 bg-white p-6
                       shadow-sm transition-all duration-300
                       hover:-translate-y-1 hover:border-emerald-200
                       hover:shadow-xl hover:shadow-emerald-100/50
                       focus:outline-none focus:ring-2
                       focus:ring-emerald-500 focus:ring-offset-2
                       dark:border-slate-800 dark:bg-slate-900
                       dark:hover:border-emerald-500/40
                       dark:hover:shadow-none">

                <div
                    class="absolute -right-10 -top-10 h-28 w-28 rounded-full
                           bg-emerald-50 transition-transform duration-500
                           group-hover:scale-150
                           dark:bg-emerald-500/5">
                </div>

                <div class="relative">

                    <div class="flex items-start justify-between">

                        <div
                            class="flex h-12 w-12 items-center justify-center
                                   rounded-xl bg-emerald-100 text-emerald-600
                                   dark:bg-emerald-500/10 dark:text-emerald-400">

                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198A5.971 5.971 0 0 0 18 18.75c0-3.314-2.686-6-6-6s-6 2.686-6 6c0 .225.012.447.037.666A11.944 11.944 0 0 1 12 21a11.944 11.944 0 0 1-5.963-1.584M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />

                            </svg>

                        </div>

                        <span
                            class="rounded-full bg-slate-100 px-2.5 py-1
                                   text-[10px] font-bold uppercase tracking-wider
                                   text-slate-500
                                   dark:bg-slate-800 dark:text-slate-400">
                            Total
                        </span>

                    </div>

                    <div class="mt-5">

                        <p class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                            {{ number_format($subscriberCount) }}
                        </p>

                        <div class="mt-1 flex items-center justify-between">

                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                Subscribers
                            </p>

                            <span
                                class="text-xs font-bold text-emerald-600
                                       opacity-0 transition
                                       group-hover:opacity-100
                                       dark:text-emerald-400">
                                View →
                            </span>

                        </div>

                    </div>

                </div>

            </a>

        </div>


        {{-- ===================================================== --}}
        {{-- QUICK ACTIONS --}}
        {{-- ===================================================== --}}

        <div class="mt-8">

            <div class="mb-5">

                <h2 class="text-lg font-black text-slate-900 dark:text-white">
                    Quick Actions
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Quickly access the most common administration tasks.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">


                {{-- Main Admin Card --}}
                <div
                    class="relative overflow-hidden rounded-2xl
                           bg-gradient-to-br from-indigo-600
                           via-indigo-600 to-violet-700
                           p-6 text-white shadow-xl
                           shadow-indigo-200/50
                           dark:shadow-none
                           lg:col-span-2">

                    <div
                        class="absolute -right-20 -top-20 h-64 w-64
                               rounded-full bg-white/10 blur-2xl">
                    </div>

                    <div
                        class="absolute -bottom-24 -left-16 h-48 w-48
                               rounded-full bg-violet-400/20 blur-3xl">
                    </div>

                    <div class="relative flex flex-col justify-between gap-8 sm:flex-row sm:items-center">

                        <div class="max-w-xl">

                            <span
                                class="inline-flex rounded-full
                                       bg-white/10 px-3 py-1
                                       text-xs font-bold uppercase
                                       tracking-wider text-indigo-100
                                       ring-1 ring-inset ring-white/10">
                                Administration
                            </span>

                            <h3 class="mt-4 text-2xl font-black tracking-tight">
                                Manage your platform
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-indigo-100">
                                Keep your shops, users, products and subscribers
                                organized from one convenient dashboard.
                            </p>

                            <div class="mt-6 flex flex-wrap gap-3">

                                <a href="{{ route('shops.index') }}"
                                    class="inline-flex items-center gap-2 rounded-xl
                                           bg-white px-4 py-2.5 text-sm font-bold
                                           text-indigo-700 shadow-sm
                                           transition hover:bg-indigo-50">

                                    Manage Shops

                                    <span>→</span>

                                </a>

                                <a href="{{ route('user.index') }}"
                                    class="inline-flex items-center gap-2 rounded-xl
                                           bg-white/10 px-4 py-2.5 text-sm font-bold
                                           text-white ring-1 ring-inset ring-white/20
                                           transition hover:bg-white/20">

                                    Manage Users

                                    <span>→</span>

                                </a>

                            </div>

                        </div>


                        <div
                            class="hidden h-16 w-16 shrink-0 items-center
                                   justify-center rounded-2xl
                                   bg-white/10 ring-1 ring-inset
                                   ring-white/20 sm:flex">

                            <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 6h9.75M3.75 6h.75m0 0h.75M3.75 12h.75m0 0h.75m0 0h.75M3.75 18h.75m0 0h.75m0 0h.75M10.5 12h9.75m-9.75 6h9.75" />

                            </svg>

                        </div>

                    </div>

                </div>


                {{-- System Status --}}
                <div
                    class="rounded-2xl border border-slate-200
                           bg-white p-6 shadow-sm
                           dark:border-slate-800
                           dark:bg-slate-900">

                    <div class="flex h-full flex-col justify-between">

                        <div>

                            <div
                                class="flex h-12 w-12 items-center justify-center
                                       rounded-xl bg-emerald-100
                                       text-emerald-600
                                       dark:bg-emerald-500/10
                                       dark:text-emerald-400">

                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 12c0 5.591 3.824 10.29 9 11.622C17.176 22.29 21 17.591 21 12c0-1.02-.127-2.011-.364-2.957" />

                                </svg>

                            </div>

                            <h3 class="mt-5 text-base font-black text-slate-900 dark:text-white">
                                System Status
                            </h3>

                            <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">
                                Everything is ready and available.
                            </p>

                        </div>


                        <div
                            class="mt-6 flex items-center justify-between
                                   rounded-xl bg-emerald-50 px-4 py-3
                                   dark:bg-emerald-500/10">

                            <div class="flex items-center gap-2">

                                <span
                                    class="h-2.5 w-2.5 rounded-full
                                           bg-emerald-500 shadow-sm
                                           shadow-emerald-500/50">
                                </span>

                                <span
                                    class="text-sm font-bold text-emerald-700
                                           dark:text-emerald-400">
                                    Operational
                                </span>

                            </div>

                            <span class="text-xs font-medium text-emerald-600 dark:text-emerald-500">
                                Live
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- BOTTOM SUMMARY --}}
        {{-- ===================================================== --}}

        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-3">

            <div
                class="rounded-2xl border border-slate-200 bg-white
                       px-5 py-4 shadow-sm
                       dark:border-slate-800 dark:bg-slate-900">

                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                    Total Platform Records
                </p>

                <p class="mt-2 text-2xl font-black text-slate-900 dark:text-white">
                    {{ number_format($shopCount + $userCount + $listingCount + $subscriberCount) }}
                </p>

            </div>


            <div
                class="rounded-2xl border border-slate-200 bg-white
                       px-5 py-4 shadow-sm
                       dark:border-slate-800 dark:bg-slate-900">

                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                    Marketplace
                </p>

                <p class="mt-2 text-sm font-bold text-slate-900 dark:text-white">
                    {{ number_format($shopCount) }} shops
                    <span class="font-normal text-slate-400">registered</span>
                </p>

            </div>


            <div
                class="rounded-2xl border border-slate-200 bg-white
                       px-5 py-4 shadow-sm
                       dark:border-slate-800 dark:bg-slate-900">

                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                    Community
                </p>

                <p class="mt-2 text-sm font-bold text-slate-900 dark:text-white">
                    {{ number_format($userCount) }} users
                    <span class="font-normal text-slate-400">on platform</span>
                </p>

            </div>

        </div>

    </main>

</div>
