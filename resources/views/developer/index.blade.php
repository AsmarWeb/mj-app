<x-app-layout>

    <div
        class="min-h-screen bg-slate-50 text-slate-900 transition-colors duration-300
        dark:bg-slate-950 dark:text-white">

        {{-- Background decoration --}}
        <div class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute -left-40 -top-40 h-96 w-96 rounded-full bg-orange-500/10 blur-3xl"></div>
            <div class="absolute -right-40 top-1/3 h-96 w-96 rounded-full bg-amber-500/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 h-80 w-80 rounded-full bg-orange-400/5 blur-3xl"></div>
        </div>


        {{-- ========================================================= --}}
        {{-- Hero --}}
        {{-- ========================================================= --}}

        <section
            class="relative overflow-hidden border-b border-slate-200
            bg-white dark:border-slate-800 dark:bg-slate-950">

            <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-24">

                <div class="grid items-center gap-12 lg:grid-cols-2">

                    {{-- Hero content --}}
                    <div>

                        <div
                            class="inline-flex items-center gap-2 rounded-full border
                            border-orange-200 bg-orange-50 px-4 py-2
                            text-sm font-semibold text-orange-600
                            dark:border-orange-500/20 dark:bg-orange-500/10
                            dark:text-orange-400">

                            <span class="relative flex h-2.5 w-2.5">
                                <span
                                    class="absolute inline-flex h-full w-full animate-ping
                                    rounded-full bg-orange-400 opacity-60">
                                </span>

                                <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-orange-500">
                                </span>
                            </span>

                            {{ __('Meet the team') }}

                        </div>


                        <h1 class="mt-7 text-4xl font-black tracking-tight sm:text-5xl lg:text-6xl">

                            {{ __('Building the future of') }}

                            <span
                                class="bg-gradient-to-r from-orange-500 to-amber-400
                                bg-clip-text text-transparent">

                                {{ config('app.name') }}

                            </span>

                        </h1>


                        <p
                            class="mt-6 max-w-xl text-lg leading-8 text-slate-600
                            dark:text-slate-400">

                            {{ __('Meet the people behind the platform who are designing, building and improving the experience for our growing community.') }}

                        </p>


                        {{-- Hero buttons --}}
                        <div class="mt-8 flex flex-wrap gap-4">

                            @auth

                                @if ($myDeveloper)
                                    {{-- Existing developer --}}
                                    <a href="{{ route('developer.show', $myDeveloper->user->username) }}"
                                        class="inline-flex items-center gap-2 rounded-xl
                                        bg-orange-500 px-6 py-3.5 text-sm font-bold
                                        text-white shadow-lg shadow-orange-500/20
                                        transition hover:-translate-y-0.5 hover:bg-orange-600">

                                        {{ __('View My Profile') }}

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5
                                                                        c4.477 0 8.268 2.943 9.542 7
                                                                        -1.274 4.057-5.065 7-9.542 7
                                                                        -4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>

                                    </a>
                                @else
                                    {{-- User does not have a developer profile --}}
                                    <a href="{{ route('developer.join') }}"
                                        class="inline-flex items-center gap-2 rounded-xl
                                        bg-orange-500 px-6 py-3.5 text-sm font-bold
                                        text-white shadow-lg shadow-orange-500/20
                                        transition hover:-translate-y-0.5 hover:bg-orange-600">

                                        {{ __('Join our developer team') }}

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>

                                    </a>
                                @endif
                            @else
                                {{-- Guest --}}
                                <a href="{{ route('login') }}"
                                    class="inline-flex items-center gap-2 rounded-xl
                                    bg-orange-500 px-6 py-3.5 text-sm font-bold
                                    text-white shadow-lg shadow-orange-500/20
                                    transition hover:-translate-y-0.5 hover:bg-orange-600">

                                    {{ __('Join our developer team') }}

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>

                                </a>

                            @endauth


                            <a href="{{ route('home') }}"
                                class="inline-flex items-center gap-2 rounded-xl
                                border border-slate-300 bg-white px-6 py-3.5
                                text-sm font-bold text-slate-700
                                transition hover:border-orange-300 hover:text-orange-500
                                dark:border-slate-700 dark:bg-slate-900
                                dark:text-slate-200 dark:hover:border-orange-500">

                                {{ __('Explore platform') }}

                            </a>

                        </div>


                        {{-- Stats --}}
                        <div class="mt-10 flex flex-wrap gap-8">

                            <div>
                                <p class="text-2xl font-black text-slate-900 dark:text-white">
                                    {{ $developers->count() }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    {{ __('Team members') }}
                                </p>
                            </div>


                            <div class="h-12 w-px bg-slate-200 dark:bg-slate-800"></div>


                            <div>
                                <p class="text-2xl font-black text-orange-500">
                                    {{ config('app.name') }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    {{ __('Built with passion') }}
                                </p>
                            </div>

                        </div>

                    </div>


                    {{-- Hero visual --}}
                    <div class="relative hidden lg:block">

                        <div class="relative mx-auto max-w-md">

                            <div class="absolute inset-0 rounded-[3rem] bg-orange-500/20 blur-3xl"></div>

                            <div
                                class="relative overflow-hidden rounded-[2rem]
                                border border-slate-200 bg-slate-50 p-8
                                shadow-2xl shadow-orange-950/10
                                dark:border-slate-800 dark:bg-slate-900">

                                <div class="flex items-center justify-between">

                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-widest text-orange-500">
                                            {{ __('Developer Team') }}
                                        </p>

                                        <h3 class="mt-2 text-2xl font-bold">
                                            {{ config('app.name') }}
                                        </h3>
                                    </div>

                                    <div
                                        class="flex h-12 w-12 items-center justify-center
                                        rounded-2xl bg-orange-500 text-white
                                        shadow-lg shadow-orange-500/30">

                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 9.4l-9 5.2M12 3v18M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>

                                    </div>

                                </div>


                                {{-- Team avatars --}}
                                <div class="mt-10 flex items-center">

                                    @foreach ($developers->take(5) as $developer)
                                        <div class="-ml-2 first:ml-0">

                                            <img src="{{ $developer->avatar ? asset('storage/' . $developer->avatar) : asset('images/default-avatar.png') }}"
                                                alt="{{ $developer->name }}"
                                                class="h-12 w-12 rounded-full border-4
                                                border-slate-50 object-cover
                                                dark:border-slate-900">

                                        </div>
                                    @endforeach


                                    @if ($developers->count() > 5)
                                        <div
                                            class="-ml-2 flex h-12 w-12 items-center
                                            justify-center rounded-full border-4
                                            border-slate-50 bg-orange-100 text-xs
                                            font-bold text-orange-600
                                            dark:border-slate-900
                                            dark:bg-orange-500/20
                                            dark:text-orange-400">

                                            +{{ $developers->count() - 5 }}

                                        </div>
                                    @endif

                                </div>


                                <div
                                    class="mt-8 rounded-2xl border border-slate-200
                                    bg-white p-5 dark:border-slate-800
                                    dark:bg-slate-950">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center
                                            rounded-xl bg-emerald-500/10
                                            text-emerald-500">

                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>

                                        </div>

                                        <div>
                                            <p class="text-sm font-bold">
                                                {{ __('Building together') }}
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                {{ __('One improvement at a time.') }}
                                            </p>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- Team --}}
        {{-- ========================================================= --}}

        <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">

            <div class="mx-auto max-w-2xl text-center">

                <p class="text-sm font-bold uppercase tracking-[0.2em] text-orange-500">
                    {{ __('The people behind the platform') }}
                </p>

                <h2 class="mt-3 text-3xl font-black tracking-tight sm:text-4xl">
                    {{ __('Meet our developers') }}
                </h2>

                <p class="mt-4 text-slate-600 dark:text-slate-400">
                    {{ __('A talented group of people turning ideas into useful experiences for our community.') }}
                </p>

            </div>


            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                @forelse ($developers as $developer)

                    <article
                        class="group relative overflow-hidden rounded-3xl border
                        border-slate-200 bg-white p-7 shadow-sm
                        transition duration-300
                        hover:-translate-y-1 hover:border-orange-200
                        hover:shadow-xl hover:shadow-orange-950/10
                        dark:border-slate-800 dark:bg-slate-900
                        dark:hover:border-orange-500/30">

                        <div
                            class="absolute inset-x-0 top-0 h-1
                            bg-gradient-to-r from-orange-500 to-amber-400
                            opacity-0 transition group-hover:opacity-100">
                        </div>


                        <div class="flex justify-center">

                            <div class="relative">

                                <div
                                    class="absolute -inset-1 rounded-full
                                    bg-gradient-to-r from-orange-500 to-amber-400
                                    opacity-0 blur transition
                                    group-hover:opacity-60">
                                </div>

                                <img src="{{ $developer->avatar ? asset('storage/' . $developer->avatar) : asset('images/default-avatar.png') }}"
                                    alt="{{ $developer->name }}" loading="lazy"
                                    class="relative h-28 w-28 rounded-full
                                    border-4 border-white object-cover shadow-lg
                                    dark:border-slate-900">

                            </div>

                        </div>


                        <div class="mt-6 text-center">

                            <h3 class="text-xl font-black text-slate-900 dark:text-white">
                                {{ $developer->name }}
                            </h3>

                            <p class="mt-1 text-sm font-semibold text-orange-500">
                                {{ $developer->role }}
                            </p>

                            @if ($developer->bio)
                                <p
                                    class="mt-4 line-clamp-4 text-sm leading-6
                                    text-slate-500 dark:text-slate-400">

                                    {{ $developer->bio }}

                                </p>
                            @endif

                        </div>


                        {{-- Social links --}}
                        @if ($developer->github || $developer->linkedin)
                            <div class="mt-3 flex justify-center gap-3">

                                @if ($developer->github)
                                    <a href="{{ $developer->github }}" target="_blank" rel="noopener noreferrer"
                                        class="rounded-xl border border-slate-200 px-4 py-2
                                        text-sm font-semibold text-slate-700
                                        transition hover:bg-slate-900 hover:text-white
                                        dark:border-slate-700 dark:text-slate-300">

                                        GitHub

                                    </a>
                                @endif


                                @if ($developer->linkedin)
                                    <a href="{{ $developer->linkedin }}" target="_blank" rel="noopener noreferrer"
                                        class="rounded-xl bg-blue-600 px-4 py-2
                                        text-sm font-semibold text-white
                                        transition hover:bg-blue-700">

                                        LinkedIn

                                    </a>
                                @endif

                            </div>
                        @endif

                    </article>

                @empty

                    <div class="sm:col-span-2 lg:col-span-3">

                        <div
                            class="rounded-3xl border border-dashed border-slate-300
                            bg-white px-6 py-16 text-center
                            dark:border-slate-700 dark:bg-slate-900">

                            <div
                                class="mx-auto flex h-14 w-14 items-center justify-center
                                rounded-2xl bg-orange-500/10 text-orange-500">

                                <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                                </svg>

                            </div>

                            <h3 class="mt-5 text-lg font-bold">
                                {{ __('Our team is growing') }}
                            </h3>

                            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Be the next developer to join the journey.') }}
                            </p>


                            @auth

                                @if ($myDeveloper)
                                    <a href="{{ route('developer.show', $myDeveloper->user->username) }}"
                                        class="mt-6 inline-flex rounded-xl
                                        bg-orange-500 px-5 py-2.5
                                        text-sm font-bold text-white
                                        transition hover:bg-orange-600">

                                        {{ __('View My Profile') }}

                                    </a>
                                @else
                                    <a href="{{ route('developer.join') }}"
                                        class="mt-6 inline-flex rounded-xl
                                        bg-orange-500 px-5 py-2.5
                                        text-sm font-bold text-white
                                        transition hover:bg-orange-600">

                                        {{ __('Join the team') }}

                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                    class="mt-6 inline-flex rounded-xl
                                    bg-orange-500 px-5 py-2.5
                                    text-sm font-bold text-white
                                    transition hover:bg-orange-600">

                                    {{ __('Join the team') }}

                                </a>

                            @endauth

                        </div>

                    </div>

                @endforelse

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- CTA --}}
        {{-- ========================================================= --}}

        <section class="mx-auto max-w-7xl px-6 pb-16 lg:px-8 lg:pb-24">

            <div
                class="relative overflow-hidden rounded-[2rem]
                bg-gradient-to-br from-orange-500 via-orange-600 to-amber-500
                px-6 py-12 text-center shadow-2xl shadow-orange-900/20
                sm:px-12">

                <div
                    class="pointer-events-none absolute -right-20 -top-20
                    h-64 w-64 rounded-full bg-white/10 blur-3xl">
                </div>

                <div
                    class="pointer-events-none absolute -bottom-20 -left-20
                    h-64 w-64 rounded-full bg-black/10 blur-3xl">
                </div>


                <div class="relative">

                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-orange-100">
                        {{ __('Ready to build?') }}
                    </p>

                    <h2 class="mt-3 text-3xl font-black text-white sm:text-4xl">
                        {{ __('Your next great idea could start here.') }}
                    </h2>

                    <p class="mx-auto mt-4 max-w-2xl text-orange-50">
                        {{ __('Join the developer team and help us make the marketplace faster, smarter and better.') }}
                    </p>


                    @auth

                        @if ($myDeveloper)
                            <a href="{{ route('developer.show', $myDeveloper->user->username) }}"
                                class="mt-8 inline-flex items-center gap-2 rounded-xl
                                bg-white px-6 py-3.5 text-sm font-bold
                                text-orange-600 shadow-lg transition
                                hover:-translate-y-0.5 hover:bg-orange-50">

                                {{ __('View My Profile') }}

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>

                            </a>
                        @else
                            <a href="{{ route('developer.join') }}"
                                class="mt-8 inline-flex items-center gap-2 rounded-xl
                                bg-white px-6 py-3.5 text-sm font-bold
                                text-orange-600 shadow-lg transition
                                hover:-translate-y-0.5 hover:bg-orange-50">

                                {{ __('Join Developer Team') }}

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>

                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="mt-8 inline-flex items-center gap-2 rounded-xl
                            bg-white px-6 py-3.5 text-sm font-bold
                            text-orange-600 shadow-lg transition
                            hover:-translate-y-0.5 hover:bg-orange-50">

                            {{ __('Join Developer Team') }}

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>

                        </a>

                    @endauth

                </div>

            </div>

        </section>

    </div>


</x-app-layout>
