<!-- Require css -->
<style>
    .scroll-hidden::-webkit-scrollbar {
        height: 0px;
        background: transparent;
        /* make scrollbar transparent */
    }
</style>

<nav x-data="{ isOpen: false }"
    class="border-b border-gray-100 backdrop-blur-sm dark:bg-gray-900/70 dark:border-gray-700 xl:fixed xl:w-full xl:top-0 xl:left-0 xl:z-30">
    <div class="container px-6 py-3 mx-auto">
        <div class="flex items-center justify-between">
            <div class="flex items-center">

                <a href="{{ route('home') }}">
                    <img class="w-auto h-6 sm:h-7" src="{{ $setting->logo }}" alt="">
                </a>

                <div class="hidden mx-auto md:block">
                    <div class="flex flex-col md:flex-row md:mx-2.5">
                        <a class="my-2 text-sm leading-5 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 hover:underline md:mx-4 md:my-0"
                            href="#">Explore</a>
                        <a class="my-2 text-sm leading-5 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 hover:underline md:mx-4 md:my-0"
                            href="{{ route('demo') }}">{{ __('header.main.demo') }}</a>
                        <a class="my-2 text-sm leading-5 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 hover:underline md:mx-4 md:my-0"
                            href="{{ route('services') }}">{{ __('header.main.services') }}</a>
                        <a class="my-2 text-sm leading-5 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 hover:underline md:mx-4 md:my-0"
                            href="{{ route('about') }}">{{ __('header.main.about') }}</a>
                    </div>
                </div>

                <!-- Search input on desktop screen -->
                <div class="hidden mx-9 md:block">
                    <div class="relative">
                        {{-- <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>

                    <input type="text"
                        class="w-full py-2 pl-10 pr-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-blue-300"
                        placeholder="Search"> --}}
                        <form class="flex flex-col md:flex-row gap-2">
                            <select id="pricingType" name="pricingType"
                                class="w-36 h-10 border-2 border-gray-500 focus:outline-none focus:border-gray-600 dark:focus:border-gray-300 focus:ring-gray-300 text-gray-700 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
                                <option value="All" selected="">All</option>
                                <option value="Freemium">Freemium</option>
                                <option value="Free">Free</option>
                                <option value="Paid">Paid</option>
                            </select>
                            <div class="flex">
                                <input type="text" placeholder="Search for anything"
                                    class="w-full md:w-80 px-3 h-10 rounded-l border-2 text-gray-700 bg-white dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:border-gray-600 dark:focus:border-gray-400 focus:ring-gray-400">
                                <button type="submit"
                                    class="bg-orange-500 hover:bg-orange-600 focus:bg-orange-600 text-white rounded-r px-2 md:px-3 py-0 md:py-1">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M14.795 13.408l5.204 5.204a1 1 0 01-1.414 1.414l-5.204-5.204a7.5 7.5 0 111.414-1.414zM8.5 14A5.5 5.5 0 103 8.5 5.506 5.506 0 008.5 14z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="hidden mx-auto md:block">
                    <div class="flex items-center justify-center">
                        <button id="theme-toggle" type="button" x-cloak x-on:click="darkMode = !darkMode;"
                            class="group flex max-w-[2.25rem] border border-gray-200/40 dark:border-gray-700/40 bg-gray-100/20 dark:bg-gray-800/20 rounded-lg h-9 w-9 items-center justify-center">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor"
                                class="relative hidden w-5 h-5 text-white duration-300 dark:inline-block group-hover:rotate-180">
                                <path
                                    d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z">
                                </path>
                            </svg>
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor"
                                class="relative w-4 h-4 text-gray-700 duration-500 group-hover:text-gray-900 group-hover:rotate-[360deg] dark:hidden">
                                <path fill-rule="evenodd"
                                    d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z"
                                    clip-rule="evenodd">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="hidden mx-auto md:block">
                    <div class="flex items-center justify-center px-2">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md border-gray-200/40 text-gray-500 dark:text-white dark:border-gray-700/40 bg-gray-100/20 dark:bg-gray-800/20 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">

                                        {{ __('header.locale') }}

                                        {{-- <svg  xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                            </svg> --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="ms-2 -me-0.5 h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802" />
                                        </svg>

                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Lang -->
                                    <x-dropdown-link href="{{ route('locale', 'en') }}">
                                        {{ __('translation.english') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('locale', 'ar') }}">
                                        {{ __('translation.arabic') }}
                                    </x-dropdown-link>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>

                <div class="hidden mx-auto md:block">
                    @if (Route::has('login'))
                        @auth
                            <div class="flex items-center justify-center px-2">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <button
                                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                <img class="h-8 w-8 rounded-full object-cover"
                                                    src="{{ Auth::user()->profile_photo_url }}"
                                                    alt="{{ Auth::user()->name }}" />
                                            </button>
                                        @else
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                    {{ Auth::user()->name }}

                                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </span>
                                        @endif
                                    </x-slot>

                                    <x-slot name="content">
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Account') }}
                                        </div>
                                        @if (Auth::check() && Auth::user()->hasRole('superadministrator|administrator'))
                                            <x-dropdown-link href="{{ route('admin.dashboard') }}">
                                                {{ __('Dashboard') }}
                                            </x-dropdown-link>
                                        @else
                                            <x-dropdown-link href="{{ route('profile', [Auth::user()->username]) }}">
                                                {{ __('My Profile') }}
                                            </x-dropdown-link>

                                            <x-dropdown-link href="{{ route('dashboard', [Auth::user()->username]) }}">
                                                {{ __('My Shop') }}
                                            </x-dropdown-link>

                                            <x-dropdown-link href="{{ route('profile.show') }}">
                                                {{ __('Edit Profile') }}
                                            </x-dropdown-link>
                                        @endif
                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                                {{ __('API Tokens') }}
                                            </x-dropdown-link>
                                        @endif

                                        <div class="border-t border-gray-200"></div>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf

                                            <x-dropdown-link href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @else
                            <button
                                class="inline-flex items-center px-3 py-2 border border-gray-200/40 text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-white dark:border-gray-700/40 bg-gray-100/20 dark:bg-gray-800/20 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                <a href="{{ route('register') }}" class="mx-1 text-sm text-gray-600 dark:text-white">
                                    {{ __('header.user.login') }}
                                </a>

                                {{-- <svg class="w-6 h-6 mx-1 fill-gray-600 dark:fill-white" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 384 512">
                                <path
                                    d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z" />
                            </svg> --}}
                            </button>
                        @endif
                    @endauth
                </div>


            </div>

            <!-- Mobile menu button -->
            <div class="flex lg:hidden">
                <button x-cloak @click="isOpen = !isOpen" type="button"
                    class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400"
                    aria-label="toggle menu">
                    <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                    </svg>

                    <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']"
            class="absolute inset-x-0 z-20 w-full px-5 py-2 transition-all duration-300 ease-in-out bg-white top-24 dark:bg-gray-800 md:mt-0 md:p-0 md:top-0 md:relative md:bg-transparent md:w-auto md:opacity-100 md:translate-x-0 md:hidden md:items-center">
            <div class="flex flex-col md:flex-row md:mx-1">
                <a class="my-2 text-sm leading-5 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 hover:underline md:mx-4 md:my-0"
                    href="{{ route('demo') }}">{{ __('header.main.demo') }}</a>
                <a class="my-2 text-sm leading-5 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 hover:underline md:mx-4 md:my-0"
                    href="{{ route('services') }}">{{ __('header.main.services') }}</a>
                <a class="my-2 text-sm leading-5 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 hover:underline md:mx-4 md:my-0"
                    href="{{ route('about') }}">{{ __('header.main.about') }}</a>
                <a class="my-2 text-sm leading-5 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 hover:underline md:mx-4 md:my-0"
                    href="#">Explore</a>
            </div>

            <div class="flex items-center justify-center px-5 py-2 my-2">
                <button id="theme-toggle" type="button" x-cloak x-on:click="darkMode = !darkMode;"
                    class="group flex max-w-[2.25rem] border border-gray-200/40 dark:border-gray-700/40 bg-gray-100/20 dark:bg-gray-800/20 rounded-lg h-9 w-9 items-center justify-center">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor"
                        class="relative hidden w-5 h-5 text-white duration-300 dark:inline-block group-hover:rotate-180">
                        <path
                            d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z">
                        </path>
                    </svg>
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor"
                        class="relative w-4 h-4 text-gray-700 duration-500 group-hover:text-gray-900 group-hover:rotate-[360deg] dark:hidden">
                        <path fill-rule="evenodd"
                            d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="flex items-center justify-center my-2">
                <x-dropdown align="right" width="60">
                    <x-slot name="trigger">
                        <span class="rounded-md">
                            <button type="button"
                                class="inline-flex items-center px-3 py-2 border border-gray-200/40 text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-white dark:border-gray-700/40 bg-gray-100/20 dark:bg-gray-800/20 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">

                                {{ __('header.locale') }}

                                {{-- <svg  xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                            </svg> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="ms-2 -me-0.5 h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802" />
                                </svg>

                            </button>
                        </span>
                    </x-slot>

                    <x-slot name="content">
                        <div class="w-60">
                            <!-- Lang -->
                            <x-dropdown-link href="{{ route('locale', 'en') }}">
                                {{ __('translation.english') }}
                            </x-dropdown-link>

                            <x-dropdown-link href="{{ route('locale', 'ar') }}">
                                {{ __('translation.arabic') }}
                            </x-dropdown-link>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <hr class="border-gray-200 dark:border-gray-700 my-2">

            @if (Route::has('login'))
                @auth
                    <div class="flex items-center justify-center -mx-1 px-5 py-2 my-2">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>
                                @if (Auth::check() && Auth::user()->hasRole('superadministrator|administrator'))
                                    <x-dropdown-link href="{{ route('admin.dashboard') }}">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>
                                @else
                                    <x-dropdown-link href="{{ route('profile', [Auth::user()->username]) }}">
                                        {{ __('My Profile') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('dashboard', [Auth::user()->username]) }}">
                                        {{ __('My Shop') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Edit Profile') }}
                                    </x-dropdown-link>
                                @endif
                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <button
                        class="w-full px-5 py-3 transition-colors duration-300 bg-gray-100 rounded-md dark:bg-gray-800 md:w-auto md:mx-6 hover:bg-gray-200 dark:hover:bg-gray-700">
                        <div class="flex items-center justify-center -mx-1">
                            <a href="{{ route('register') }}" class="mx-1 text-sm text-gray-600 dark:text-white">
                                {{ __('header.user.login') }}
                            </a>

                            {{-- <svg class="w-6 h-6 mx-1 fill-gray-600 dark:fill-white" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 384 512">
                    <path
                        d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z" />
                </svg> --}}
                        </div>
                    </button>
                @endif
            @endauth

            <!-- Search input on mobile screen -->
            <div class="my-4 md:hidden">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>

                    <input type="text"
                        class="w-full py-2 pl-10 pr-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-blue-300"
                        placeholder="Search">
                </div>
            </div>
        </div>


        <div class="py-3 mt-3 -mx-3 overflow-y-auto whitespace-nowrap scroll-hidden md:hidden">
            @foreach ($categories as $category)
                @if (count($category['subcategories']) > 0)
                    @if (app()->getLocale() == 'ar')
                        <a class="mx-4 text-sm text-right leading-5 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 hover:underline md:my-0"
                            href="#">
                            {{ $category->category_name_ar }}
                        </a>
                    @else
                        <a class="mx-4 text-sm leading-5 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 hover:underline md:my-0"
                            href="#">

                            {{ $category->category_name }}
                        </a>
                    @endif
                @endif
            @endforeach
        </div>

        <div class="mt-4 flex items-center justify-between">
            <div class="flex gap-x-2 py-1 px-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 dark:text-gray-200"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-medium dark:text-gray-200">Dubai</span>
            </div>

            <div class="flex gap-x-5 overflow-y-auto whitespace-nowrap scroll-hidden">
                <span
                    class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400">Best
                    seller</span>
                <span
                    class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400">New
                    Releases</span>
                <span
                    class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400">Books</span>
                <span
                    class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400">Computers</span>
                <span
                    class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400">Fashion</span>
                <span
                    class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400">Health</span>
                <span
                    class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400">Pharmacy</span>
                <span
                    class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400">Toys
                    &
                    Games</span>
            </div>

            <span
                class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400">Becoma
                a
                seller</span>
        </div>
    </div>
</nav>
