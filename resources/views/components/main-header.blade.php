<!-- PRIMARY HEADER -->
<header x-data="{ open: false }"
    class="border-b border-gray-100 backdrop-blur-sm dark:bg-gray-900/70 dark:border-gray-700 shadow-sm xl:fixed xl:w-full xl:top-0 xl:left-0 xl:z-30">

    <div class="max-w-7xl mx-auto px-4">
        <div class="flex h-16 items-center justify-between">

            <!-- LEFT SIDE -->
            <div class="flex items-center">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center">
                    <img width="100" src="{{ asset('storage/setting-suggest/' . $setting->logo) }}" alt="murwaj"
                        class="h-9 w-auto">
                </a>

                <!-- Local Time -->
                <div
                    class="hidden sm:flex items-center gap-2 ml-6 border border-gray-200 rounded-full px-4 py-1.5 text-xs text-gray-600 dark:text-gray-200">
                    <span>Local Time</span>
                    <span class="w-1 h-1 bg-black rounded-full"></span>
                    <span id="clock">12:32:04 pm</span>
                </div>


                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center ml-10 space-x-8">

                    <a href="{{ route('explore') }}"
                        class="text-gray-700 dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 transition">
                        {{ __('header.main.discover') }}
                    </a>

                    <a href="{{ route('services') }}"
                        class="text-gray-700 dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 transition">
                        {{ __('header.main.services') }}
                    </a>

                    <a href="{{ route('about') }}"
                        class="text-gray-700 dark:text-gray-200 hover:text-orange-600 dark:hover:text-orange-400 transition">
                        {{ __('header.main.about') }}
                    </a>

                </nav>

            </div>



            <!-- DESKTOP ACTIONS -->
            <div class="hidden md:flex items-center gap-5">


                <!-- AI Button -->
                <div class="relative inline-flex group">

                    <div
                        class="absolute opacity-70 -inset-px bg-gradient-to-r from-[#44BCFF] via-[#FF44EC] to-[#FF675E] rounded-xl blur-lg group-hover:opacity-100 transition">
                    </div>

                    <a href="{{ route('bot') }}"
                        class="relative px-3 py-2 text-gray-700 dark:text-gray-200 hover:text-orange-600 transition">
                        Ask AI
                    </a>

                </div>



                <!-- Sell -->
                <a href="{{ route('sell') }}" class="text-gray-700 dark:text-gray-200 hover:text-orange-600 transition">
                    {{ __('header.main.sell') }}
                </a>



                <!-- Cart -->
                @auth
                    <livewire:cart-icon />
                @endauth




                <!-- Theme Toggle -->
                <button type="button" x-data @click="darkMode = !darkMode"
                    class="h-9 w-9 rounded-lg border border-gray-200/40 dark:border-gray-700/40 bg-gray-100/20 dark:bg-gray-800/20 flex items-center justify-center">


                    <!-- Sun -->
                    <svg class="hidden dark:block w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">

                        <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75z" />
                        <path d="M12 7.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9z" />

                    </svg>


                    <!-- Moon -->
                    <svg class="dark:hidden w-5 h-5 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">

                        <path fill-rule="evenodd"
                            d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98A10.5 10.5 0 1110.347 1.88a.75.75 0 01-.819-.162z"
                            clip-rule="evenodd" />

                    </svg>


                </button>



                <!-- Language Dropdown -->
                <x-dropdown align="right" width="60">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center px-3 py-2 rounded-md border border-gray-200/40 dark:border-gray-700/40 bg-gray-100/20 dark:bg-gray-800/20 text-gray-600 dark:text-white">

                            {{ __('header.locale') }}

                            <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="m19.5 8.25-7.5 7.5-7.5-7.5" />

                            </svg>

                        </button>

                    </x-slot>


                    <x-slot name="content">

                        <div class="w-60">

                            <x-dropdown-link href="{{ route('locale', 'en') }}">
                                {{ __('translation.english') }}
                            </x-dropdown-link>


                            <x-dropdown-link href="{{ route('locale', 'ar') }}">
                                {{ __('translation.arabic') }}
                            </x-dropdown-link>


                        </div>

                    </x-slot>

                </x-dropdown>

                {{-- Teams --}}
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())

                    <div class="relative">

                        <x-dropdown align="right" width="60">

                            <x-slot name="trigger">

                                <button
                                    class="inline-flex items-center px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700 text-sm text-gray-600 dark:text-white">

                                    {{ Auth::user()->currentTeam->name }}

                                    <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="m19.5 8.25-7.5 7.5-7.5-7.5" />

                                    </svg>

                                </button>

                            </x-slot>


                            <x-slot name="content">

                                <div class="w-60">

                                    <div class="px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>


                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>


                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan



                                    @if (Auth::user()->allTeams()->count() > 1)

                                        <div class="border-t my-2"></div>

                                        <div class="px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>


                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach

                                    @endif


                                </div>

                            </x-slot>

                        </x-dropdown>

                    </div>

                @endif




                {{-- User --}}
                @if (Route::has('login'))

                    @auth

                        <x-dropdown align="right" width="48">

                            <x-slot name="trigger">

                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex rounded-full">

                                        <img class="h-9 w-9 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">

                                    </button>
                                @else
                                    <button
                                        class="inline-flex items-center px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-white">

                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="m19.5 8.25-7.5 7.5-7.5-7.5" />

                                        </svg>

                                    </button>
                                @endif

                            </x-slot>



                            <x-slot name="content">

                                <div class="px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>



                                @if (Auth::user()->hasRole('superadministrator|administrator'))
                                    <x-dropdown-link href="{{ route('admin.dashboard') }}">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>
                                @elseif(Auth::user()->hasRole('seller'))
                                    <x-dropdown-link href="{{ route('dashboard') }}">
                                        {{ __('My Dashboard') }}
                                    </x-dropdown-link>


                                    <x-dropdown-link href="{{ route('profile') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                @else
                                    <x-dropdown-link href="{{ route('profile') }}">
                                        {{ __('My Profile') }}
                                    </x-dropdown-link>
                                @endif



                                <div class="border-t my-2"></div>



                                <form method="POST" action="{{ route('logout') }}">

                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">

                                        {{ __('Log Out') }}

                                    </x-dropdown-link>

                                </form>


                            </x-slot>


                        </x-dropdown>
                    @else
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg">

                            {{ __('header.user.login') }}

                        </a>


                    @endauth

                @endif


            </div>




            {{-- Mobile Button --}}
            <div class="flex md:hidden items-center gap-3">


                @auth
                    <livewire:cart-icon />
                @endauth


                <button @click="open=!open"
                    class="p-2 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800">

                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />


                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>


            </div>


        </div>

    </div>




    {{-- Mobile Menu --}}

    <div x-show="open" x-transition class="md:hidden border-t bg-white dark:bg-gray-900 px-5 py-5">


        <nav class="flex flex-col gap-4">


            <a href="{{ route('explore') }}" class="text-gray-700 dark:text-gray-200">

                {{ __('header.main.discover') }}

            </a>


            <a href="{{ route('services') }}" class="text-gray-700 dark:text-gray-200">

                {{ __('header.main.services') }}

            </a>


            <a href="{{ route('about') }}" class="text-gray-700 dark:text-gray-200">

                {{ __('header.main.about') }}

            </a>



        </nav>




        <div class="border-t my-5"></div>




        <div class="flex justify-between items-center">


            <button @click="darkMode=!darkMode" class="h-9 w-9 rounded-lg border">

                🌙

            </button>



            <a href="{{ route('bot') }}"
                class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-400 via-pink-400 to-red-400 text-white">

                Ask AI

            </a>


        </div>




        <a href="{{ route('sell') }}"
            class="block mt-5 text-center px-5 py-3 rounded-lg bg-yellow-400 hover:bg-yellow-500">

            {{ __('header.main.sell') }}

        </a>




        <div class="mt-5">


            <x-dropdown align="right" width="60">


                <x-slot name="trigger">

                    <button class="w-full px-4 py-2 border rounded-md text-gray-700 dark:text-white">

                        {{ __('header.locale') }}

                    </button>


                </x-slot>



                <x-slot name="content">

                    <x-dropdown-link href="{{ route('locale', 'en') }}">
                        {{ __('translation.english') }}
                    </x-dropdown-link>


                    <x-dropdown-link href="{{ route('locale', 'ar') }}">
                        {{ __('translation.arabic') }}
                    </x-dropdown-link>


                </x-slot>


            </x-dropdown>


        </div>




        <div class="mt-5">


            <input type="text" placeholder="Search"
                class="w-full rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-700">


        </div>


    </div>


</header>
