<title>Page Not Found | {{ config('app.name') }}</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<div
    class="relative min-h-screen overflow-hidden bg-slate-50 text-slate-900
           dark:bg-slate-950 dark:text-white">

    {{-- =============================================================== --}}
    {{-- Background --}}
    {{-- =============================================================== --}}

    <div class="pointer-events-none absolute inset-0 overflow-hidden">

        <div
            class="absolute -left-40 -top-40 h-[30rem] w-[30rem]
                   rounded-full bg-orange-400/10 blur-3xl
                   dark:bg-orange-500/10">
        </div>

        <div
            class="absolute -bottom-40 -right-40 h-[32rem] w-[32rem]
                   rounded-full bg-amber-400/10 blur-3xl
                   dark:bg-amber-500/10">
        </div>

        <div class="absolute inset-0 opacity-[0.035] dark:opacity-[0.025]"
            style="background-image: radial-gradient(circle at 1px 1px, currentColor 1px, transparent 0); background-size: 26px 26px;">
        </div>

    </div>


    {{-- =============================================================== --}}
    {{-- Main --}}
    {{-- =============================================================== --}}

    <main class="relative flex min-h-screen items-center justify-center px-5 py-12 sm:px-6">

        <div class="w-full max-w-4xl">


            {{-- ======================================================= --}}
            {{-- Brand --}}
            {{-- ======================================================= --}}

            <div class="mb-8 flex flex-col items-center text-center">

                <div
                    class="mb-5 flex h-16 w-16 items-center justify-center
                           rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500
                           text-white shadow-xl shadow-orange-500/20">

                    <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 3.75h4.5M12 3.75v2.25m-6.364.386l1.59 1.59M4.5 12H2.25m3.386 6.364l1.59-1.59M12 18v2.25m6.364-3.886l-1.59-1.59M19.5 12h2.25m-3.386-5.614l-1.59 1.59" />

                        <circle cx="12" cy="12" r="4.25" />

                    </svg>

                </div>


                <span
                    class="inline-flex items-center gap-2 rounded-full
                           border border-orange-200 bg-orange-50 px-4 py-2
                           text-xs font-bold uppercase tracking-[0.18em]
                           text-orange-600
                           dark:border-orange-500/20
                           dark:bg-orange-500/10
                           dark:text-orange-400">

                    <span class="h-2 w-2 rounded-full bg-orange-500"></span>

                    404 · Page Not Found

                </span>

            </div>


            {{-- ======================================================= --}}
            {{-- Main Card --}}
            {{-- ======================================================= --}}

            <section
                class="overflow-hidden rounded-[2rem]
                       border border-slate-200 bg-white
                       shadow-2xl shadow-slate-200/60
                       dark:border-slate-800 dark:bg-slate-900
                       dark:shadow-black/30">


                {{-- =================================================== --}}
                {{-- Hero --}}
                {{-- =================================================== --}}

                <div
                    class="relative overflow-hidden
                           bg-gradient-to-br from-orange-500
                           via-orange-600 to-amber-500
                           px-6 py-12 text-center
                           sm:px-10 sm:py-16">

                    {{-- Decorative shapes --}}
                    <div
                        class="absolute -right-24 -top-24 h-72 w-72
                               rounded-full bg-white/10 blur-3xl">
                    </div>

                    <div
                        class="absolute -bottom-32 -left-20 h-80 w-80
                               rounded-full bg-black/10 blur-3xl">
                    </div>

                    <div class="absolute inset-0 opacity-[0.08]"
                        style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 24px 24px;">
                    </div>


                    <div class="relative">

                        {{-- 404 --}}
                        <div
                            class="select-none text-[7rem] font-black
                                   leading-none tracking-[-0.08em]
                                   text-white sm:text-[9rem]">

                            404

                        </div>


                        <div
                            class="mx-auto mt-5 flex h-20 w-20 items-center
                                   justify-center rounded-[1.5rem]
                                   border border-white/20
                                   bg-white/10 shadow-2xl
                                   backdrop-blur-md">

                            <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" stroke-width="1.7"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0Z" />

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 5.25-7.5 10.5-7.5 10.5S4.5 15.75 4.5 10.5a7.5 7.5 0 1115 0Z" />

                            </svg>

                        </div>


                        <h1
                            class="mt-7 text-3xl font-black tracking-tight
                                   text-white sm:text-4xl">

                            This page has wandered off.

                        </h1>


                        <p
                            class="mx-auto mt-4 max-w-2xl text-base
                                   leading-7 text-white/85 sm:text-lg">

                            The page you're looking for doesn't exist,
                            may have moved, or the link might be incorrect.

                        </p>

                    </div>

                </div>


                {{-- =================================================== --}}
                {{-- Content --}}
                {{-- =================================================== --}}

                <div class="px-6 py-8 sm:px-10 sm:py-10">


                    {{-- UAE Message --}}
                    <div
                        class="rounded-2xl border border-orange-100
                               bg-orange-50/70 p-5
                               dark:border-orange-500/10
                               dark:bg-orange-500/5">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-12 w-12 shrink-0
                                       items-center justify-center
                                       rounded-xl bg-white text-2xl
                                       shadow-sm dark:bg-slate-900">

                                🇦🇪

                            </div>

                            <div class="min-w-0">

                                <p class="font-bold text-slate-900 dark:text-white">
                                    Looking for something in the UAE?
                                </p>

                                <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">
                                    No worries — let's get you back to where you need to be.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Arabic --}}
                    <div class="mt-5 rounded-2xl border border-slate-200
                               bg-slate-50 p-5 text-center
                               dark:border-slate-800 dark:bg-slate-950"
                        dir="rtl">

                        <p class="text-base font-bold text-slate-800 dark:text-white sm:text-lg">
                            عذراً، الصفحة غير موجودة
                        </p>

                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">
                            الصفحة التي تبحث عنها غير موجودة أو ربما تم نقلها.
                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- Navigation --}}
                    {{-- ================================================= --}}

                    <div class="mt-7 grid gap-3 sm:grid-cols-2">


                        {{-- Go Back --}}
                        <button type="button" onclick="goBack()"
                            class="group inline-flex items-center
                                   justify-center gap-2 rounded-xl
                                   border border-slate-200 bg-white
                                   px-5 py-3.5 text-sm font-bold
                                   text-slate-700 shadow-sm
                                   transition duration-200
                                   hover:-translate-y-0.5
                                   hover:border-orange-200
                                   hover:bg-orange-50
                                   hover:text-orange-600
                                   dark:border-slate-700
                                   dark:bg-slate-900
                                   dark:text-slate-200
                                   dark:hover:border-orange-500/30
                                   dark:hover:bg-orange-500/10
                                   dark:hover:text-orange-400">

                            <svg class="h-5 w-5 transition-transform
                                       duration-200
                                       group-hover:-translate-x-1"
                                fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />

                            </svg>

                            Go Back

                        </button>


                        {{-- Take Me Home --}}
                        <a href="{{ url('/') }}"
                            class="group inline-flex items-center
                                   justify-center gap-2 rounded-xl
                                   bg-orange-500 px-5 py-3.5
                                   text-sm font-bold text-white
                                   shadow-lg shadow-orange-500/20
                                   transition duration-200
                                   hover:-translate-y-0.5
                                   hover:bg-orange-600">

                            Take Me Home

                            <svg class="h-5 w-5 transition-transform
                                       duration-200
                                       group-hover:translate-x-1
                                       rtl:rotate-180"
                                fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 5.25L20.25 12l-6.75 6.75M20.25 12H3.75" />

                            </svg>

                        </a>

                    </div>


                    {{-- Secondary Actions --}}
                    <div
                        class="mt-4 flex flex-col items-center
                                justify-center gap-3 sm:flex-row">

                        <button type="button" onclick="window.location.reload()"
                            class="inline-flex items-center justify-center
                                   gap-2 rounded-xl px-5 py-3
                                   text-sm font-semibold
                                   text-slate-500 transition
                                   hover:bg-slate-100 hover:text-orange-600
                                   dark:text-slate-400
                                   dark:hover:bg-slate-800
                                   dark:hover:text-orange-400">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992V4.356m-1.5 4.992a9 9 0 10.5 7.5" />

                            </svg>

                            Refresh Page

                        </button>


                        @if (isset($setting) && $setting->phone)
                            <span class="hidden h-5 w-px bg-slate-200 sm:block dark:bg-slate-700"></span>

                            <a href="tel:{{ $setting->phone }}"
                                class="inline-flex items-center justify-center
                                       gap-2 rounded-xl px-5 py-3
                                       text-sm font-semibold
                                       text-slate-500 transition
                                       hover:bg-slate-100
                                       hover:text-orange-600
                                       dark:text-slate-400
                                       dark:hover:bg-slate-800
                                       dark:hover:text-orange-400">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372a1.5 1.5 0 00-1.06-1.432l-3.47-1.157a1.5 1.5 0 00-1.62.582l-.76 1.013a1.5 1.5 0 01-1.73.498 12.04 12.04 0 01-7.02-7.02 1.5 1.5 0 01.498-1.73l1.013-.76a1.5 1.5 0 00.582-1.62L7.077 3.31A1.5 1.5 0 005.645 2.25H4.5A2.25 2.25 0 002.25 4.5v2.25z" />

                                </svg>

                                Contact Us

                            </a>
                        @endif

                    </div>


                    {{-- Fun Message --}}
                    <div class="mt-8 text-center">

                        <p class="text-sm text-slate-400 dark:text-slate-500">
                            Even the best roads sometimes have a wrong turn. 🧭
                        </p>

                        <p class="mt-1 text-sm font-medium text-orange-500">
                            Let's get you back on track.
                        </p>

                    </div>

                </div>


                {{-- =================================================== --}}
                {{-- Footer --}}
                {{-- =================================================== --}}

                <div
                    class="border-t border-slate-200
                           bg-slate-50 px-6 py-5 text-center
                           dark:border-slate-800
                           dark:bg-slate-950">

                    <p class="text-xs text-slate-400 dark:text-slate-600">

                        &copy; {{ date('Y') }}
                        {{ config('app.name') }}.
                        All rights reserved.

                    </p>

                </div>

            </section>

        </div>

    </main>

</div>


<script>
    function goBack() {
        if (window.history.length > 1) {
            window.history.back();
        } else {
            window.location.href = "{{ url('/') }}";
        }
    }
</script>
