<header x-data="{
    mobileOpen: false,
    darkMode: document.documentElement.classList.contains('dark')
}" x-init="$watch('mobileOpen', value => {
    document.body.classList.toggle('overflow-hidden', value)
})"
    class="sticky top-0 z-50 w-full border-b border-gray-200/80 backdrop-blur-xl dark:border-gray-800 dark:bg-gray-950/95">

    {{-- =========================
    DESKTOP / MAIN HEADER
========================== --}}
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="flex h-16 items-center justify-between gap-6">

            {{-- LEFT --}}
            <div class="flex min-w-0 items-center">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex shrink-0 items-center transition hover:opacity-80">
                    <img src="{{ asset('storage/setting-suggest/' . $setting->logo) }}" alt="murwaj"
                        class="h-9 w-auto max-w-[130px] object-contain">
                </a>


                {{-- Desktop Navigation --}}
                <nav class="ml-10 hidden items-center gap-7 lg:flex">

                    <a href="{{ route('explore') }}"
                        class="text-sm font-medium text-gray-700 transition hover:text-orange-600 dark:text-gray-200 dark:hover:text-orange-400">
                        {{ __('header.main.discover') }}
                    </a>

                    <a href="{{ route('services') }}"
                        class="text-sm font-medium text-gray-700 transition hover:text-orange-600 dark:text-gray-200 dark:hover:text-orange-400">
                        {{ __('header.main.services') }}
                    </a>

                    <a href="{{ route('posts.index') }}"
                        class="text-sm font-medium text-gray-700 transition hover:text-orange-600 dark:text-gray-200 dark:hover:text-orange-400">
                        {{ __('header.main.posts') }}
                    </a>

                    <a href="{{ route('about') }}"
                        class="text-sm font-medium text-gray-700 transition hover:text-orange-600 dark:text-gray-200 dark:hover:text-orange-400">
                        {{ __('header.main.about') }}
                    </a>

                </nav>

            </div>


            {{-- =========================
            RIGHT ACTIONS
        ========================== --}}
            <div class="flex items-center gap-2 sm:gap-3">

                {{-- Local Time --}}
                <div
                    class="hidden xl:flex items-center gap-2 rounded-full border border-gray-200 bg-gray-50 px-3 py-1.5 text-xs text-gray-500 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                    <span>Local Time</span>

                    <span class="text-gray-300 dark:text-gray-600">•</span>

                    <span id="clock">--:--:--</span>
                </div>


                {{-- Ask AI --}}
                <a href="{{ route('bot') }}" class="group relative hidden sm:inline-flex">
                    <span
                        class="absolute -inset-0.5 rounded-xl bg-gradient-to-r from-blue-500 via-pink-500 to-orange-500 opacity-50 blur transition duration-300 group-hover:opacity-90"></span>

                    <span
                        class="relative inline-flex items-center gap-2 rounded-xl bg-white px-3 py-2 text-sm font-semibold text-gray-800 dark:bg-gray-950 dark:text-white">
                        <svg class="h-4 w-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.5 3.5l1.2 3.3L14 8l-3.3 1.2L9.5 12.5l-1.2-3.3L5 8l3.3-1.2L9.5 3.5zM17 12l.8 2.2L20 15l-2.2.8L17 18l-.8-2.2L14 15l2.2-.8L17 12z" />
                        </svg>

                        Ask AI
                    </span>
                </a>


                {{-- Sell --}}
                <a href="{{ route('sell') }}"
                    class="hidden rounded-xl bg-orange-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-700 hover:shadow-md sm:inline-flex">
                    {{ __('header.main.sell') }}
                </a>


                {{-- Cart --}}
                @auth
                    <div class="shrink-0">
                        <livewire:cart-icon />
                    </div>
                @endauth


                {{-- Theme Toggle --}}
                <button type="button"
                    @click="
                    darkMode = !darkMode;
                    document.documentElement.classList.toggle('dark', darkMode);
                    localStorage.setItem('theme', darkMode ? 'dark' : 'light');
                "
                    class="hidden h-9 w-9 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-700 transition hover:bg-gray-100 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 sm:flex"
                    aria-label="Toggle dark mode">

                    {{-- Moon --}}
                    <svg x-show="!darkMode" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>

                    {{-- Sun --}}
                    <svg x-show="darkMode" x-cloak class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4" stroke-width="1.8" />
                        <path stroke-width="1.8" stroke-linecap="round"
                            d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.65 17.65l1.42 1.42M2 12h2M20 12h2M4.93 19.07l1.42-1.42M17.65 6.35l1.42-1.42" />
                    </svg>

                </button>


                {{-- Language --}}
                <div class="hidden sm:block">

                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">

                            <button
                                class="inline-flex items-center gap-1 rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">

                                {{ __('header.locale') }}

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>

                            </button>

                        </x-slot>


                        <x-slot name="content">

                            <x-dropdown-link href="{{ route('locale', 'en') }}">
                                🇬🇧 {{ __('translation.english') }}
                            </x-dropdown-link>

                            <x-dropdown-link href="{{ route('locale', 'ar') }}">
                                🇦🇪 {{ __('translation.arabic') }}
                            </x-dropdown-link>

                        </x-slot>

                    </x-dropdown>

                </div>


                {{-- USER --}}
                @if (Route::has('login'))

                    @auth

                        <div class="hidden sm:block">

                            <x-dropdown align="right" width="56">

                                <x-slot name="trigger">

                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button
                                            class="flex rounded-full ring-2 ring-transparent transition hover:ring-orange-500">
                                            <img class="h-9 w-9 rounded-full object-cover"
                                                src="{{ Auth::user()->profile_photo_url }}"
                                                alt="{{ Auth::user()->name }}">
                                        </button>
                                    @else
                                        <button
                                            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm font-medium text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200">

                                            <span
                                                class="flex h-6 w-6 items-center justify-center rounded-full bg-orange-100 text-xs font-bold text-orange-600 dark:bg-orange-900/30 dark:text-orange-400">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </span>

                                            <span class="hidden lg:block max-w-[100px] truncate">
                                                {{ Auth::user()->name }}
                                            </span>

                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>

                                        </button>
                                    @endif

                                </x-slot>


                                <x-slot name="content">

                                    <div class="px-4 py-3">

                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ Auth::user()->name }}
                                        </p>

                                        <p class="mt-0.5 truncate text-xs text-gray-500">
                                            {{ Auth::user()->email }}
                                        </p>

                                    </div>


                                    <div class="border-t dark:border-gray-700"></div>


                                    @if (Auth::user()->hasRole('superadministrator|administrator'))
                                        <x-dropdown-link href="{{ route('admin.dashboard') }}">
                                            ⚙️ {{ __('Dashboard') }}
                                        </x-dropdown-link>
                                    @elseif(Auth::user()->hasRole('seller'))
                                        <x-dropdown-link href="{{ route('dashboard') }}">
                                            📊 {{ __('My Dashboard') }}
                                        </x-dropdown-link>

                                        <x-dropdown-link href="{{ route('profile') }}">
                                            👤 {{ __('Profile') }}
                                        </x-dropdown-link>
                                    @else
                                        <x-dropdown-link href="{{ route('profile') }}">
                                            👤 {{ __('My Profile') }}
                                        </x-dropdown-link>
                                    @endif


                                    <div class="my-1 border-t dark:border-gray-700"></div>


                                    <form method="POST" action="{{ route('logout') }}">

                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            🚪 {{ __('Log Out') }}
                                        </x-dropdown-link>

                                    </form>

                                </x-slot>

                            </x-dropdown>

                        </div>
                    @else
                        <a href="{{ route('register') }}"
                            class="hidden rounded-xl bg-orange-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-orange-700 sm:inline-flex">
                            {{ __('header.user.login') }}
                        </a>

                    @endauth

                @endif


                {{-- MOBILE MENU BUTTON --}}
                <button type="button" @click="mobileOpen = true"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-700 transition hover:bg-gray-100 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 lg:hidden"
                    aria-label="Open menu">

                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                </button>

            </div>

        </div>

    </div>


    {{-- =========================
    MOBILE OVERLAY
========================== --}}
    <div x-show="mobileOpen" x-cloak x-transition.opacity @click="mobileOpen = false"
        class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm lg:hidden"></div>


    {{-- =========================
    MOBILE SIDEBAR
========================== --}}
    <aside x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed right-0 top-0 z-50 flex h-screen w-[88%] max-w-sm flex-col bg-white shadow-2xl dark:bg-gray-950 lg:hidden">

        {{-- Sidebar Header --}}
        <div
            class="flex h-16 shrink-0 items-center justify-between border-b border-gray-200 px-5 dark:border-gray-800">

            <a href="{{ route('home') }}" @click="mobileOpen = false" class="flex items-center">
                <img src="{{ asset('storage/setting-suggest/' . $setting->logo) }}" alt="murwaj"
                    class="h-8 w-auto max-w-[120px]">
            </a>


            <button type="button" @click="mobileOpen = false"
                class="flex h-9 w-9 items-center justify-center rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

        </div>


        {{-- Sidebar Content --}}
        <div class="flex-1 overflow-y-auto px-5 py-6">

            {{-- User Card --}}
            @auth

                <div class="mb-6 rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 p-4 text-white shadow-lg">

                    <div class="flex items-center gap-3">

                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                                class="h-12 w-12 rounded-full object-cover ring-2 ring-white/50">
                        @else
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-full bg-white/20 text-lg font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif

                        <div class="min-w-0">

                            <p class="font-bold truncate">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-orange-100 truncate">
                                {{ Auth::user()->email }}
                            </p>

                        </div>

                    </div>

                </div>

            @endauth


            {{-- Search --}}
            <form action="{{ route('search') }}" method="GET" class="mb-6">

                <div class="relative">

                    <svg class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                    </svg>

                    <input type="search" name="q" placeholder="Search marketplace..."
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 py-3 pl-11 pr-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:border-gray-800 dark:bg-gray-900 dark:text-white">

                </div>

            </form>


            {{-- Main Navigation --}}
            <div class="space-y-1">

                <p class="mb-3 px-3 text-xs font-bold uppercase tracking-wider text-gray-400">
                    Marketplace
                </p>


                <a href="{{ route('explore') }}" @click="mobileOpen = false"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-700 transition hover:bg-orange-50 hover:text-orange-600 dark:text-gray-200 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-900">
                        🔎
                    </span>

                    {{ __('header.main.discover') }}
                </a>


                <a href="{{ route('services') }}" @click="mobileOpen = false"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-700 transition hover:bg-orange-50 hover:text-orange-600 dark:text-gray-200 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-900">
                        🛠️
                    </span>

                    {{ __('header.main.services') }}
                </a>


                <a href="{{ route('posts.index') }}" @click="mobileOpen = false"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-700 transition hover:bg-orange-50 hover:text-orange-600 dark:text-gray-200 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-900">
                        📰
                    </span>

                    {{ __('header.main.posts') }}
                </a>


                <a href="{{ route('about') }}" @click="mobileOpen = false"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium text-gray-700 transition hover:bg-orange-50 hover:text-orange-600 dark:text-gray-200 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-900">
                        ℹ️
                    </span>

                    {{ __('header.main.about') }}
                </a>

            </div>


            {{-- Actions --}}
            <div class="mt-7 space-y-3">

                <p class="mb-3 px-3 text-xs font-bold uppercase tracking-wider text-gray-400">
                    Quick Actions
                </p>


                {{-- AI --}}
                <a href="{{ route('bot') }}" @click="mobileOpen = false"
                    class="flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 px-4 py-3 font-semibold text-white shadow-lg">
                    ✨ Ask AI
                </a>


                {{-- Sell --}}
                <a href="{{ route('sell') }}" @click="mobileOpen = false"
                    class="flex items-center justify-center gap-2 rounded-xl bg-orange-600 px-4 py-3 font-semibold text-white transition hover:bg-orange-700">
                    🏪 {{ __('header.main.sell') }}
                </a>


                @auth

                    <a href="{{ route('profile') }}" @click="mobileOpen = false"
                        class="flex items-center justify-center gap-2 rounded-xl border border-gray-200 px-4 py-3 font-medium text-gray-700 dark:border-gray-800 dark:text-gray-200">
                        👤 My Profile
                    </a>
                @else
                    <a href="{{ route('register') }}" @click="mobileOpen = false"
                        class="flex items-center justify-center rounded-xl border border-orange-500 px-4 py-3 font-semibold text-orange-600 dark:text-orange-400">
                        {{ __('header.user.login') }}
                    </a>

                @endauth

            </div>


            {{-- Preferences --}}
            <div class="mt-7 border-t border-gray-200 pt-6 dark:border-gray-800">

                <p class="mb-3 px-3 text-xs font-bold uppercase tracking-wider text-gray-400">
                    Preferences
                </p>


                {{-- Dark Mode --}}
                <button type="button"
                    @click="
                    darkMode = !darkMode;
                    document.documentElement.classList.toggle('dark', darkMode);
                    localStorage.setItem('theme', darkMode ? 'dark' : 'light');
                "
                    class="flex w-full items-center justify-between rounded-xl px-4 py-3 text-left text-gray-700 transition hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-900">

                    <span class="flex items-center gap-3">

                        <span class="text-lg">
                            <span x-show="!darkMode">🌙</span>
                            <span x-show="darkMode" x-cloak>☀️</span>
                        </span>

                        <span>
                            <span x-show="!darkMode">Dark Mode</span>
                            <span x-show="darkMode" x-cloak>Light Mode</span>
                        </span>

                    </span>


                    <span class="h-6 w-11 rounded-full bg-gray-200 p-1 dark:bg-orange-600">
                        <span class="block h-4 w-4 rounded-full bg-white shadow transition-transform"
                            :class="darkMode ? 'translate-x-5' : 'translate-x-0'"></span>
                    </span>

                </button>


                {{-- Language --}}
                <div class="mt-2">

                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">

                            <button
                                class="flex w-full items-center justify-between rounded-xl px-4 py-3 text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-900">

                                <span class="flex items-center gap-3">
                                    🌐
                                    {{ __('header.locale') }}
                                </span>

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>

                            </button>

                        </x-slot>


                        <x-slot name="content">

                            <x-dropdown-link href="{{ route('locale', 'en') }}">
                                🇬🇧 {{ __('translation.english') }}
                            </x-dropdown-link>

                            <x-dropdown-link href="{{ route('locale', 'ar') }}">
                                🇦🇪 {{ __('translation.arabic') }}
                            </x-dropdown-link>

                        </x-slot>

                    </x-dropdown>

                </div>

            </div>


            {{-- Logout --}}
            @auth

                <div class="mt-6 border-t border-gray-200 pt-6 dark:border-gray-800">

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                            class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left font-medium text-red-600 transition hover:bg-red-50 dark:hover:bg-red-950/20">
                            🚪
                            {{ __('Log Out') }}
                        </button>

                    </form>

                </div>

            @endauth

        </div>


        {{-- Sidebar Footer --}}
        <div class="shrink-0 border-t border-gray-200 px-5 py-4 dark:border-gray-800">

            <div class="flex items-center justify-between text-xs text-gray-400">

                <span>© {{ date('Y') }} murwaj</span>

                <span id="mobile-clock">--:--</span>

            </div>

        </div>

    </aside>

</header>

{{-- Clock --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {

        function updateClock() {

            const now = new Date();

            const time = now.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            const clock = document.getElementById('clock');
            const mobileClock = document.getElementById('mobile-clock');

            if (clock) {
                clock.textContent = time;
            }

            if (mobileClock) {
                mobileClock.textContent = time;
            }
        }

        updateClock();

        setInterval(updateClock, 1000);

    });
</script>

{{-- Theme initialization --}}

<script>
    (function() {

        const savedTheme = localStorage.getItem('theme');

        if (
            savedTheme === 'dark' ||
            (
                !savedTheme &&
                window.matchMedia('(prefers-color-scheme: dark)').matches
            )
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

    })();
</script>
