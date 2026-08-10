<footer class="border-t border-gray-200 bg-white dark:border-gray-800 dark:bg-slate-950">

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

        {{-- =========================================================
             TOP FOOTER
        ========================================================== --}}
        <div class="grid gap-10 lg:grid-cols-4">

            {{-- Brand / About --}}
            <div class="lg:col-span-1">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="inline-flex items-center">
                    @if (!empty($setting->logo))
                        <img src="{{ asset($setting->logo) }}" alt="{{ config('app.name', 'murwaj') }}"
                            class="h-12 w-auto object-contain">
                    @else
                        <span class="text-2xl font-bold text-orange-500">
                            {{ config('app.name', 'murwaj') }}
                        </span>
                    @endif
                </a>

                {{-- Description --}}
                <p class="mt-4 max-w-sm text-sm leading-6 text-gray-500 dark:text-gray-400">
                    {{ app()->getLocale() == 'ar'
                        ? $setting->short_des_ar ?? ($setting->short_des ?? 'سوق إلكتروني في الإمارات للتسوق والبيع بسهولة وأمان.')
                        : $setting->short_des ?? 'A UAE marketplace connecting buyers and sellers in one convenient place.' }}
                </p>


                {{-- UAE Identity --}}
                <div
                    class="mt-6 inline-flex items-center gap-3 rounded-xl border
                           border-orange-100 bg-orange-50 px-4 py-3
                           dark:border-orange-900/40 dark:bg-orange-950/20">

                    {{-- UAE Flag --}}
                    <div class="flex h-6 w-9 overflow-hidden rounded-sm shadow-sm">

                        <span class="w-1/4 bg-red-600"></span>

                        <div class="flex w-3/4 flex-col">
                            <span class="h-1/3 bg-green-600"></span>
                            <span class="h-1/3 bg-white"></span>
                            <span class="h-1/3 bg-black"></span>
                        </div>

                    </div>

                    <div class="leading-tight">

                        <p class="text-xs font-bold text-gray-900 dark:text-white">
                            {{ app()->getLocale() == 'ar' ? 'منصة في الإمارات' : 'UAE Marketplace' }}
                        </p>

                        <p class="mt-0.5 text-[11px] text-gray-500 dark:text-gray-400">
                            {{ app()->getLocale() == 'ar' ? 'نخدم العملاء في دولة الإمارات' : 'Serving customers across the UAE' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 QUICK LINKS
            ====================================================== --}}
            <div>

                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900 dark:text-white">
                    {{ __('footer.main.quicklinks') }}
                </h3>

                <ul class="mt-5 space-y-3">

                    <li>
                        <a href="{{ route('home') }}"
                            class="text-sm text-gray-500 transition hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                            {{ __('footer.main.home') }}
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}"
                            class="text-sm text-gray-500 transition hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                            {{ __('footer.main.contact') }}
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('sitemap.page') }}"
                            class="text-sm text-gray-500 transition hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                            {{ __('footer.main.sitemap') }}
                        </a>
                    </li>

                    {{-- Add these only if the routes exist --}}
                    @if (Route::has('listings.index'))
                        <li>
                            <a href="{{ route('explore') }}"
                                class="text-sm text-gray-500 transition hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                                {{ __('footer.main.browselistings') }}
                            </a>
                        </li>
                    @endif

                    @if (Route::has('login'))
                        <li>
                            <a href="{{ route('login') }}"
                                class="text-sm text-gray-500 transition hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                                {{ __('login.login') }}
                            </a>
                        </li>
                    @endif

                </ul>

            </div>


            {{-- =====================================================
                 CUSTOMER / SELLER
            ====================================================== --}}
            <div>

                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900 dark:text-white">
                    {{ __('footer.main.marketplace') }}
                </h3>

                <ul class="mt-5 space-y-3">

                    @if (Route::has('posts.index'))
                        <li>
                            <a href="{{ route('posts.index') }}"
                                class="text-sm text-gray-500 transition hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                                {{ __('footer.main.findproducts') }}
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}"
                                class="text-sm text-gray-500 transition hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                                {{ __('footer.main.createaccount') }}
                            </a>
                        </li>
                    @endif

                    @if (Route::has('login'))
                        <li>
                            <a href="{{ route('login') }}"
                                class="text-sm text-gray-500 transition hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                                {{ __('footer.main.sellerlogin') }}
                            </a>
                        </li>
                    @endif

                    @if (Route::has('contact'))
                        <li>
                            <a href="{{ route('contact') }}"
                                class="text-sm text-gray-500 transition hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                                {{ __('footer.main.help&support') }}
                            </a>
                        </li>
                    @endif

                </ul>

            </div>


            {{-- =====================================================
                 UAE CONTACT
            ====================================================== --}}
            <div>

                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900 dark:text-white">
                    {{ __('footer.main.contactUs') }}
                </h3>

                <div class="mt-5 space-y-4">

                    {{-- UAE Phone --}}
                    @if ($setting->phone)
                        <a href="tel:{{ $setting->phone }}" class="group flex items-start gap-3">

                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg
                                       bg-orange-50 text-orange-500
                                       dark:bg-orange-950/30 dark:text-orange-400">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372a1.5 1.5 0 0 0-1.06-1.432l-3.47-1.157a1.5 1.5 0 0 0-1.62.582l-.76 1.013a1.5 1.5 0 0 1-1.73.498 12.04 12.04 0 0 1-7.02-7.02 1.5 1.5 0 0 1 .498-1.73l1.013-.76a1.5 1.5 0 0 0 .582-1.62L7.077 3.31A1.5 1.5 0 0 0 5.645 2.25H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />

                                </svg>

                            </span>

                            <span>
                                <span class="block text-xs text-gray-400">
                                    {{ __('footer.main.uaephone') }}
                                </span>

                                <span
                                    class="mt-1 block text-sm font-medium text-gray-700 group-hover:text-orange-500 dark:text-gray-300 dark:group-hover:text-orange-400">
                                    {{ $setting->phone }}
                                </span>
                            </span>

                        </a>
                    @endif


                    {{-- Second Phone --}}
                    @if ($setting->phone2)
                        <a href="tel:{{ $setting->phone2 }}" class="group flex items-start gap-3">

                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg
                                       bg-orange-50 text-orange-500
                                       dark:bg-orange-950/30 dark:text-orange-400">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 5.25A2.25 2.25 0 0 1 5.25 3h1.5a1.5 1.5 0 0 1 1.455 1.136l.67 2.68a1.5 1.5 0 0 1-.75 1.69l-1.25.625a12.05 12.05 0 0 0 7.994 7.994l.625-1.25a1.5 1.5 0 0 1 1.69-.75l2.68.67A1.5 1.5 0 0 1 21 17.25v1.5A2.25 2.25 0 0 1 18.75 21C10.051 21 3 13.949 3 5.25Z" />

                                </svg>

                            </span>

                            <span>
                                <span class="block text-xs text-gray-400">
                                    {{ __('footer.main.secondphone') }}
                                </span>

                                <span
                                    class="mt-1 block text-sm font-medium text-gray-700 group-hover:text-orange-500 dark:text-gray-300 dark:group-hover:text-orange-400">
                                    {{ $setting->phone2 }}
                                </span>
                            </span>

                        </a>
                    @endif


                    {{-- Email --}}
                    @if ($setting->email)
                        <a href="mailto:{{ $setting->email }}" class="group flex items-start gap-3">

                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg
                                       bg-orange-50 text-orange-500
                                       dark:bg-orange-950/30 dark:text-orange-400">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0-8.69 5.71a2.25 2.25 0 0 1-2.47 0L2.25 6.75" />

                                </svg>

                            </span>

                            <span>
                                <span class="block text-xs text-gray-400">
                                    {{ __('footer.main.email') }}
                                </span>

                                <span
                                    class="mt-1 block break-all text-sm font-medium text-gray-700 group-hover:text-orange-500 dark:text-gray-300 dark:group-hover:text-orange-400">
                                    {{ $setting->email }}
                                </span>
                            </span>

                        </a>
                    @endif


                    {{-- Address --}}
                    @if ($setting->address)
                        <div class="flex items-start gap-3">

                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg
                                       bg-orange-50 text-orange-500
                                       dark:bg-orange-950/30 dark:text-orange-400">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />

                                </svg>

                            </span>

                            <span>
                                <span class="block text-xs text-gray-400">
                                    {{ __('footer.main.location') }}
                                </span>

                                <span class="mt-1 block text-sm text-gray-600 dark:text-gray-300">
                                    {{ $setting->address }}
                                </span>
                            </span>

                        </div>
                    @endif

                </div>

            </div>

        </div>


        {{-- =========================================================
             TRUST / UAE INFORMATION
        ========================================================== --}}
        <div
            class="mt-10 grid gap-4 border-y border-gray-200 py-6
                   sm:grid-cols-2 lg:grid-cols-4
                   dark:border-gray-800">

            {{-- UAE --}}
            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                           bg-orange-50 text-orange-500
                           dark:bg-orange-950/30 dark:text-orange-400">

                    🇦🇪

                </div>

                <div>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                        {{ __('UAE Based') }}
                    </p>

                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ __('Serving customers across the UAE') }}
                    </p>
                </div>

            </div>


            {{-- Secure --}}
            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                           bg-orange-50 text-orange-500
                           dark:bg-orange-950/30 dark:text-orange-400">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3 4.5 6v5.5c0 4.75 3.1 8.45 7.5 9.5 4.4-1.05 7.5-4.75 7.5-9.5V6L12 3Z" />

                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4" />

                    </svg>

                </div>

                <div>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                        {{ __('Secure Platform') }}
                    </p>

                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ __('Your information matters') }}
                    </p>
                </div>

            </div>


            {{-- Support --}}
            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                           bg-orange-50 text-orange-500
                           dark:bg-orange-950/30 dark:text-orange-400">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 10a6 6 0 0 0-12 0v4a2 2 0 0 0 2 2h1v-5H6m12-1v4a2 2 0 0 1-2 2h-1v-5h3Z" />

                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19h6" />

                    </svg>

                </div>

                <div>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                        {{ __('Customer Support') }}
                    </p>

                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ __('We are here to help') }}
                    </p>
                </div>

            </div>


            {{-- Arabic / English --}}
            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                           bg-orange-50 text-sm font-bold text-orange-500
                           dark:bg-orange-950/30 dark:text-orange-400">

                    ع

                </div>

                <div>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                        {{ __('Arabic & English') }}
                    </p>

                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ __('Built for UAE users') }}
                    </p>
                </div>

            </div>

        </div>


        {{-- =========================================================
             LEGAL + SOCIAL
        ========================================================== --}}
        <div class="flex flex-col gap-6 pt-8 md:flex-row md:items-center md:justify-between">

            {{-- Legal --}}
            <div class="flex flex-wrap items-center gap-x-6 gap-y-3">

                <a href="{{ route('terms.show') }}"
                    class="text-sm text-gray-500 transition hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                    {{ __('footer.main.terms') }}
                </a>

                <a href="{{ route('policy.show') }}"
                    class="text-sm text-gray-500 transition hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                    {{ __('footer.main.policy') }}
                </a>

                <a href="{{ route('sitemap.page') }}"
                    class="text-sm text-gray-500 transition hover:text-orange-500 dark:text-gray-400 dark:hover:text-orange-400">
                    {{ __('footer.main.sitemap') }}
                </a>

            </div>


            {{-- Social --}}
            <div class="flex items-center gap-2">

                @if ($setting->facebook)
                    <a href="{{ $setting->facebook }}" target="_blank" rel="noopener noreferrer"
                        aria-label="Facebook"
                        class="flex h-9 w-9 items-center justify-center rounded-lg
                               bg-gray-100 text-gray-600 transition
                               hover:bg-orange-500 hover:text-white
                               dark:bg-gray-800 dark:text-gray-300
                               dark:hover:bg-orange-500 dark:hover:text-white">

                        <span class="text-xs font-bold">f</span>

                    </a>
                @endif


                @if ($setting->instagram)
                    <a href="{{ $setting->instagram }}" target="_blank" rel="noopener noreferrer"
                        aria-label="Instagram"
                        class="flex h-9 w-9 items-center justify-center rounded-lg
                               bg-gray-100 text-gray-600 transition
                               hover:bg-orange-500 hover:text-white
                               dark:bg-gray-800 dark:text-gray-300
                               dark:hover:bg-orange-500 dark:hover:text-white">

                        <span class="text-xs font-bold">ig</span>

                    </a>
                @endif


                @if ($setting->telegram)
                    <a href="{{ $setting->telegram }}" target="_blank" rel="noopener noreferrer"
                        aria-label="Telegram"
                        class="flex h-9 w-9 items-center justify-center rounded-lg
                               bg-gray-100 text-gray-600 transition
                               hover:bg-orange-500 hover:text-white
                               dark:bg-gray-800 dark:text-gray-300
                               dark:hover:bg-orange-500 dark:hover:text-white">

                        <span class="text-xs font-bold">tg</span>

                    </a>
                @endif

            </div>

        </div>


        {{-- =========================================================
             UAE REGISTRATION / LICENCE
        ========================================================== --}}
        @if (!empty($setting->license_number))
            <div
                class="mt-8 rounded-xl border border-gray-200 bg-gray-50 px-5 py-4
                       dark:border-gray-800 dark:bg-gray-900/50">

                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-lg
                                   bg-orange-100 text-orange-600
                                   dark:bg-orange-900/30 dark:text-orange-400">

                            ✓

                        </div>

                        <div>

                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ __('UAE Registered Business') }}
                            </p>

                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ __('Registration / Licence No.') }}:
                                {{ $setting->license_number }}
                            </p>

                        </div>

                    </div>

                    @if (!empty($setting->license_authority))
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $setting->license_authority }}
                        </span>
                    @endif

                </div>

            </div>
        @endif


        {{-- =========================================================
             BOTTOM
        ========================================================== --}}
        <div
            class="mt-8 flex flex-col gap-3 border-t border-gray-200 pt-6
                   text-center sm:flex-row sm:items-center sm:justify-between
                   sm:text-left dark:border-gray-800">

            <p class="text-xs text-gray-500 dark:text-gray-400">
                © {{ date('Y') }}
                {{ app()->getLocale() == 'ar' ? $setting->copyright_ar ?? $setting->copyright : $setting->copyright }}
            </p>

            <p class="text-xs text-gray-400 dark:text-gray-500">
                {{ app()->getLocale() == 'ar' ? 'صُنع بعناية في الإمارات 🇦🇪' : 'Made with care in the UAE 🇦🇪' }}
            </p>

        </div>

    </div>

</footer>
