<div
    class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-orange-50/40 px-4 py-12 text-slate-900 dark:from-slate-950 dark:via-slate-900 dark:to-orange-950/20 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-4xl">

        {{-- UAE Accent --}}
        <div class="mb-8 flex justify-center">
            <div
                class="inline-flex items-center gap-3 rounded-full border border-orange-200 bg-white/80 px-5 py-2.5 shadow-sm backdrop-blur dark:border-orange-500/20 dark:bg-slate-900/80">
                <span class="text-xl">🇦🇪</span>

                <span class="text-xs font-bold uppercase tracking-[0.2em] text-orange-600 dark:text-orange-400">
                    UAE Business Community
                </span>
            </div>
        </div>


        {{-- Main Card --}}
        <div
            class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-2xl shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/30">

            {{-- Luxury Background --}}
            <div class="absolute inset-x-0 top-0 h-48 bg-gradient-to-br from-orange-500 via-orange-600 to-amber-500">
            </div>

            <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute -left-20 top-20 h-64 w-64 rounded-full bg-amber-300/10 blur-3xl"></div>

            {{-- Success Icon --}}
            <div class="relative flex justify-center pt-12">

                <div
                    class="flex h-24 w-24 items-center justify-center rounded-[1.75rem] border-8 border-white bg-emerald-500 shadow-2xl dark:border-slate-900">

                    <svg class="h-11 w-11 text-white" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12l4 4L19 6" />

                    </svg>

                </div>

            </div>


            {{-- Success Message --}}
            <div class="relative px-6 pb-10 pt-8 text-center sm:px-10">

                <span
                    class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-4 py-2 text-xs font-bold uppercase tracking-wider text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">

                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                    Successfully Created

                </span>


                <h1 class="mt-5 text-3xl font-black tracking-tight text-slate-900 dark:text-white sm:text-5xl">
                    🎉 Your shop is ready!
                </h1>

                <p class="mx-auto mt-4 max-w-2xl text-base leading-7 text-slate-500 dark:text-slate-400 sm:text-lg">
                    Congratulations! Your shop has been created successfully
                    and is ready to become part of the UAE's growing digital business community.
                </p>

            </div>


            {{-- Shop Information --}}
            <div
                class="mx-5 mb-5 rounded-[1.5rem] border border-slate-200 bg-slate-50/80 p-5 sm:mx-8 sm:p-7 dark:border-slate-800 dark:bg-slate-950/60">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                    {{-- Logo --}}
                    <div class="shrink-0">

                        <div
                            class="rounded-2xl border border-white bg-white p-1.5 shadow-lg dark:border-slate-800 dark:bg-slate-900">

                            <img src="{{ $shop->logo ? Storage::url($shop->logo) : asset('images/default-shop.png') }}"
                                alt="{{ $shop->name }}" class="h-24 w-24 rounded-xl object-cover sm:h-28 sm:w-28">

                        </div>

                    </div>


                    {{-- Details --}}
                    <div class="min-w-0 flex-1">

                        <div class="flex flex-wrap items-center gap-3">

                            <h2 class="truncate text-2xl font-black text-slate-900 dark:text-white sm:text-3xl">
                                {{ $shop->name }}
                            </h2>

                            <span
                                class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">
                                Verified Shop
                            </span>

                        </div>


                        <div class="mt-3 flex flex-wrap gap-x-5 gap-y-2 text-sm">

                            <p class="font-semibold text-orange-600 dark:text-orange-400">
                                {{ ucfirst($shop->type) }}
                            </p>

                            @if ($shop->location)
                                <p class="flex items-center gap-1.5 text-slate-500 dark:text-slate-400">
                                    <span>📍</span>
                                    {{ $shop->location }}
                                </p>
                            @endif

                        </div>

                    </div>

                </div>


                {{-- Description --}}
                @if ($shop->description)
                    <div class="mt-6 border-t border-slate-200 pt-6 dark:border-slate-800">

                        <p class="text-sm font-bold uppercase tracking-wider text-slate-400">
                            About the shop
                        </p>

                        <p class="mt-2 leading-7 text-slate-600 dark:text-slate-300">
                            {{ $shop->description }}
                        </p>

                    </div>
                @endif

            </div>


            {{-- Success Footer --}}
            <div
                class="border-t border-slate-200 bg-gradient-to-r from-orange-50 to-amber-50 px-6 py-6 dark:border-slate-800 dark:from-orange-500/5 dark:to-amber-500/5 sm:px-10">

                <div class="flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500/10 text-lg">
                            🇦🇪
                        </div>

                        <div>

                            <p class="font-bold text-slate-900 dark:text-white">
                                Welcome to the community
                            </p>

                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                Your business journey starts here.
                            </p>

                        </div>

                    </div>


                    <div
                        class="flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-2 text-sm font-bold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">

                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                        Shop Created

                    </div>

                </div>

            </div>

        </div>


        {{-- Bottom Message --}}
        <div class="mt-8 text-center">

            <p class="text-sm text-slate-400 dark:text-slate-500">
                Thank you for choosing {{ config('app.name') }}.
            </p>

            <p class="mt-1 text-xs font-medium text-orange-500">
                Proudly connecting businesses across the UAE 🇦🇪
            </p>

        </div>

    </div>

</div>
