<x-app-layout>

    <div
        class="min-h-screen bg-slate-50 py-10 text-slate-900 transition-colors duration-300
           dark:bg-slate-950 dark:text-white">

        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            {{-- ========================================================= --}}
            {{-- Back --}}
            {{-- ========================================================= --}}

            <div class="mb-6">
                <a href="{{ url()->previous() }}"
                    class="group inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold
                       text-slate-500 transition-all duration-200
                       hover:bg-orange-50 hover:text-orange-600
                       dark:text-slate-400 dark:hover:bg-orange-500/10 dark:hover:text-orange-400">

                    <svg class="h-4 w-4 transition-transform group-hover:-translate-x-0.5" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />

                    </svg>

                    Back
                </a>
            </div>


            {{-- ========================================================= --}}
            {{-- Developer Profile --}}
            {{-- ========================================================= --}}

            <section
                class="overflow-hidden rounded-[2rem] border border-slate-200
                   bg-white shadow-2xl shadow-slate-200/50
                   dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/30">

                {{-- Cover --}}
                <div class="relative h-52 overflow-hidden sm:h-64">

                    {{-- Main gradient --}}
                    <div
                        class="absolute inset-0 bg-gradient-to-br
                           from-orange-400 via-orange-500 to-amber-600">
                    </div>

                    {{-- Glow --}}
                    <div
                        class="absolute -right-24 -top-32 h-96 w-96 rounded-full
                           bg-white/20 blur-3xl">
                    </div>

                    <div
                        class="absolute -bottom-40 -left-24 h-96 w-96 rounded-full
                           bg-orange-950/20 blur-3xl">
                    </div>

                    {{-- Pattern --}}
                    <div class="absolute inset-0 opacity-[0.08]"
                        style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 24px 24px;">
                    </div>

                    {{-- Cover label --}}
                    <div class="absolute left-5 top-5 sm:left-8 sm:top-8">

                        <span
                            class="inline-flex items-center gap-2 rounded-full
                               border border-white/20 bg-white/10
                               px-4 py-2 text-[11px] font-black uppercase
                               tracking-[0.18em] text-white backdrop-blur-xl">

                            <span class="h-2 w-2 rounded-full bg-emerald-300 shadow-sm shadow-emerald-200"></span>

                            Developer Profile

                        </span>

                    </div>

                    {{-- Decorative mark --}}
                    <div
                        class="absolute bottom-6 right-6 hidden select-none text-7xl
                           font-black tracking-tighter text-white/10 sm:block">

                        DEV

                    </div>

                </div>


                {{-- Profile content --}}
                <div class="px-5 pb-8 sm:px-8 lg:px-10">

                    {{-- ================================================= --}}
                    {{-- Header --}}
                    {{-- ================================================= --}}

                    <div class="-mt-20 flex flex-col gap-6 sm:-mt-24 lg:flex-row lg:items-end">

                        {{-- Avatar --}}
                        <div class="relative shrink-0">

                            <div
                                class="rounded-[1.75rem] border border-white/80
                                   bg-white p-1.5 shadow-2xl
                                   dark:border-slate-800 dark:bg-slate-900">

                                <img src="{{ $developer->avatar
                                    ? asset('storage/' . $developer->avatar)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($developer->name) . '&background=f97316&color=fff&size=256' }}"
                                    alt="{{ $developer->name }}"
                                    class="h-32 w-32 rounded-2xl bg-slate-100 object-cover
                                       sm:h-40 sm:w-40 dark:bg-slate-800">

                            </div>

                            {{-- Active --}}
                            <div class="absolute bottom-2 right-2 flex h-9 w-9
                                   items-center justify-center rounded-full
                                   border-4 border-white bg-emerald-500
                                   shadow-lg dark:border-slate-900"
                                title="Active Developer">

                                <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" stroke-width="3"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12l4 4L19 6" />

                                </svg>

                            </div>

                        </div>


                        {{-- Identity --}}
                        <div class="min-w-0 flex-1">

                            <div class="flex flex-wrap items-center gap-3">

                                <h1
                                    class="max-w-full truncate text-3xl font-black
                                       tracking-tight text-slate-900
                                       dark:text-white sm:text-4xl">

                                    {{ $developer->name }}

                                </h1>

                                <span
                                    class="inline-flex shrink-0 items-center gap-1.5
                                       rounded-full bg-orange-100 px-3 py-1.5
                                       text-xs font-bold text-orange-700
                                       dark:bg-orange-500/10 dark:text-orange-400">

                                    <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>

                                    Developer

                                </span>

                            </div>


                            {{-- Role --}}
                            @if ($developer->role)
                                <p class="mt-2 text-lg font-bold text-orange-600 dark:text-orange-400">
                                    {{ $developer->role }}
                                </p>
                            @endif


                            {{-- Username --}}
                            @if ($developer->user?->username)
                                <a href="{{ route('developer.show', ['username' => $developer->user->username]) }}"
                                    class="group mt-2 inline-flex items-center gap-2 rounded-xl
                                       border border-slate-200 bg-slate-50 px-3 py-1.5
                                       text-sm font-semibold text-slate-600
                                       transition-all duration-200
                                       hover:border-orange-200 hover:bg-orange-50
                                       hover:text-orange-600
                                       dark:border-slate-700 dark:bg-slate-800
                                       dark:text-slate-400 dark:hover:border-orange-500/20
                                       dark:hover:bg-orange-500/10 dark:hover:text-orange-400">

                                    <span
                                        class="flex h-5 w-5 items-center justify-center
                                           rounded-md bg-orange-500/10 text-xs
                                           font-black text-orange-500">

                                        @

                                    </span>

                                    <span>
                                        {{ $developer->user->username }}
                                    </span>

                                    <svg class="h-3.5 w-3.5 opacity-40 transition
                                           group-hover:translate-x-0.5 group-hover:opacity-100"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />

                                    </svg>

                                </a>
                            @endif

                        </div>


                        {{-- Action --}}
                        <div class="shrink-0">

                            @auth

                                @if (auth()->id() === $developer->user_id && $developer->user?->username)
                                    <a href="{{ route('developer.show', ['username' => $developer->user->username]) }}"
                                        class="inline-flex w-full items-center justify-center gap-2
                                           rounded-xl bg-orange-500 px-6 py-3.5
                                           text-sm font-bold text-white
                                           shadow-lg shadow-orange-500/20
                                           transition-all duration-200
                                           hover:-translate-y-0.5 hover:bg-orange-600
                                           hover:shadow-xl hover:shadow-orange-500/25
                                           sm:w-auto">

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5
                                                                           c4.477 0 8.268 2.943 9.542 7
                                                                           -1.274 4.057-5.065 7-9.542 7
                                                                           -4.477 0-8.268-2.943-9.542-7z" />

                                            <circle cx="12" cy="12" r="3" />

                                        </svg>

                                        My Profile

                                    </a>
                                @else
                                    <a href="{{ route('developer.join') }}"
                                        class="inline-flex w-full items-center justify-center gap-2
                                           rounded-xl bg-orange-500 px-6 py-3.5
                                           text-sm font-bold text-white
                                           shadow-lg shadow-orange-500/20
                                           transition-all duration-200
                                           hover:-translate-y-0.5 hover:bg-orange-600
                                           hover:shadow-xl hover:shadow-orange-500/25
                                           sm:w-auto">

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H6
                                                                           a4 4 0 00-4 4v2" />

                                            <circle cx="9" cy="7" r="4" />

                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 8v6M22 11h-6" />

                                        </svg>

                                        Join Community

                                    </a>
                                @endif
                            @else
                                <a href="{{ route('developer.join') }}"
                                    class="inline-flex w-full items-center justify-center gap-2
                                       rounded-xl bg-orange-500 px-6 py-3.5
                                       text-sm font-bold text-white
                                       shadow-lg shadow-orange-500/20
                                       transition-all duration-200
                                       hover:-translate-y-0.5 hover:bg-orange-600
                                       sm:w-auto">

                                    Join Community

                                </a>

                            @endauth

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- Bio --}}
                    {{-- ================================================= --}}

                    @if ($developer->bio)
                        <div
                            class="mt-8 max-w-3xl rounded-2xl border border-orange-100
                               bg-orange-50/70 p-5
                               dark:border-orange-500/10 dark:bg-orange-500/5">

                            <div class="flex gap-4">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center
                                       justify-center rounded-xl
                                       bg-orange-500/10 text-orange-500">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8M8 14h5M21 12a9 9 0 11-18 0
                                           9 9 0 0118 0z" />

                                    </svg>

                                </div>

                                <p class="text-sm leading-7 text-slate-600 dark:text-slate-300">
                                    {{ $developer->bio }}
                                </p>

                            </div>

                        </div>
                    @endif


                    {{-- ================================================= --}}
                    {{-- Stats --}}
                    {{-- ================================================= --}}

                    <div class="mt-8 grid gap-4 sm:grid-cols-3">

                        <div
                            class="rounded-2xl border border-slate-200 bg-slate-50 p-5
                               transition hover:border-orange-200 hover:shadow-sm
                               dark:border-slate-800 dark:bg-slate-950
                               dark:hover:border-orange-500/20">

                            <p class="text-[11px] font-black uppercase tracking-[0.18em] text-slate-400">
                                Role
                            </p>

                            <p class="mt-2 font-bold text-slate-900 dark:text-white">
                                {{ $developer->role ?: 'Developer' }}
                            </p>

                        </div>


                        <div
                            class="rounded-2xl border border-slate-200 bg-slate-50 p-5
                               transition hover:border-orange-200 hover:shadow-sm
                               dark:border-slate-800 dark:bg-slate-950
                               dark:hover:border-orange-500/20">

                            <p class="text-[11px] font-black uppercase tracking-[0.18em] text-slate-400">
                                Community
                            </p>

                            <p class="mt-2 font-bold text-slate-900 dark:text-white">
                                {{ config('app.name') }} Developers
                            </p>

                        </div>


                        <div
                            class="rounded-2xl border border-slate-200 bg-slate-50 p-5
                               transition hover:border-emerald-200 hover:shadow-sm
                               dark:border-slate-800 dark:bg-slate-950">

                            <p class="text-[11px] font-black uppercase tracking-[0.18em] text-slate-400">
                                Status
                            </p>

                            <p class="mt-2 flex items-center gap-2 font-bold text-emerald-600 dark:text-emerald-400">

                                <span
                                    class="h-2.5 w-2.5 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/50"></span>

                                Active

                            </p>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- Social Links --}}
            {{-- ========================================================= --}}

            @if ($developer->github || $developer->linkedin || $developer->website)

                <section class="mt-12">

                    <div class="mb-6">

                        <span class="text-[11px] font-black uppercase tracking-[0.2em] text-orange-500">
                            Connect
                        </span>

                        <h2 class="mt-2 text-2xl font-black text-slate-900 dark:text-white">
                            Find {{ $developer->name }} online
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Explore projects, professional experience and personal work.
                        </p>

                    </div>


                    <div class="grid gap-4 md:grid-cols-3">

                        {{-- GitHub --}}
                        @if ($developer->github)
                            <a href="{{ $developer->github }}" target="_blank" rel="noopener noreferrer nofollow"
                                class="group rounded-2xl border border-slate-200
                                   bg-white p-6 shadow-sm transition-all duration-300
                                   hover:-translate-y-1 hover:border-slate-300
                                   hover:shadow-xl
                                   dark:border-slate-800 dark:bg-slate-900
                                   dark:hover:border-slate-700">

                                <div class="flex items-center justify-between">

                                    <div
                                        class="flex h-12 w-12 items-center justify-center
                                           rounded-xl bg-slate-900 text-white
                                           dark:bg-white dark:text-slate-900">

                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">

                                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.5.5.092.682-.217.682-.483
                                               0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.342-3.369-1.342
                                               -.454-1.157-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608
                                               1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088
                                               2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951
                                               0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65
                                               0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004
                                               1.705.115 2.504.337 1.909-1.296 2.747-1.026 2.747-1.026
                                               .546 1.378.202 2.397.1 2.65.64.7 1.595 1.028 2.688
                                               0 3.847-2.338 4.695-4.566 4.943.359.309.678.92.678 1.855
                                               0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482
                                               A10.019 10.019 0 0022 12.017C22 6.484 17.523 2 12 2Z"
                                                clip-rule="evenodd" />

                                        </svg>

                                    </div>

                                    <span class="text-slate-400 transition group-hover:text-orange-500">
                                        ↗
                                    </span>

                                </div>

                                <h3 class="mt-5 text-lg font-bold text-slate-900 dark:text-white">
                                    GitHub
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                                    View repositories, projects and contributions.
                                </p>

                            </a>
                        @endif


                        {{-- LinkedIn --}}
                        @if ($developer->linkedin)
                            <a href="{{ $developer->linkedin }}" target="_blank" rel="noopener noreferrer nofollow"
                                class="group rounded-2xl border border-slate-200
                                   bg-white p-6 shadow-sm transition-all duration-300
                                   hover:-translate-y-1 hover:border-blue-200
                                   hover:shadow-xl
                                   dark:border-slate-800 dark:bg-slate-900">

                                <div class="flex items-center justify-between">

                                    <div
                                        class="flex h-12 w-12 items-center justify-center
                                           rounded-xl bg-[#0A66C2] text-white">

                                        <span class="text-lg font-black">
                                            in
                                        </span>

                                    </div>

                                    <span class="text-slate-400 transition group-hover:text-blue-500">
                                        ↗
                                    </span>

                                </div>

                                <h3 class="mt-5 text-lg font-bold text-slate-900 dark:text-white">
                                    LinkedIn
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                                    Explore professional experience and achievements.
                                </p>

                            </a>
                        @endif


                        {{-- Website --}}
                        @if ($developer->website)
                            <a href="{{ $developer->website }}" target="_blank" rel="noopener noreferrer nofollow"
                                class="group rounded-2xl border border-slate-200
                                   bg-white p-6 shadow-sm transition-all duration-300
                                   hover:-translate-y-1 hover:border-orange-300
                                   hover:shadow-xl
                                   dark:border-slate-800 dark:bg-slate-900">

                                <div class="flex items-center justify-between">

                                    <div
                                        class="flex h-12 w-12 items-center justify-center
                                           rounded-xl bg-orange-500/10 text-orange-500">

                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                                            viewBox="0 0 24 24">

                                            <circle cx="12" cy="12" r="9" />

                                            <path stroke-linecap="round"
                                                d="M3 12h18M12 3c2.5 2.5 3.5 5.5 3.5 9s-1 6.5-3.5 9c-2.5-2.5-3.5-5.5-3.5-9S9.5 5.5 12 3Z" />

                                        </svg>

                                    </div>

                                    <span class="text-slate-400 transition group-hover:text-orange-500">
                                        ↗
                                    </span>

                                </div>

                                <h3 class="mt-5 text-lg font-bold text-slate-900 dark:text-white">
                                    Portfolio
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                                    Visit the developer's portfolio and latest work.
                                </p>

                            </a>
                        @endif

                    </div>

                </section>

            @endif


            {{-- ========================================================= --}}
            {{-- Community CTA --}}
            {{-- ========================================================= --}}

            <section class="relative mt-12 overflow-hidden rounded-[2rem]">

                <div
                    class="absolute inset-0 bg-gradient-to-br
                       from-orange-500 via-orange-600 to-amber-500">
                </div>

                <div
                    class="absolute -right-20 -top-20 h-72 w-72 rounded-full
                       bg-white/10 blur-3xl">
                </div>

                <div
                    class="absolute -bottom-32 -left-20 h-80 w-80 rounded-full
                       bg-black/10 blur-3xl">
                </div>

                <div class="relative p-7 text-white sm:p-10">

                    <span
                        class="inline-flex rounded-full border border-white/20
                           bg-white/10 px-3 py-1 text-xs font-bold
                           uppercase tracking-wider text-white/90">

                        Developer Community

                    </span>

                    <h2 class="mt-5 text-3xl font-black tracking-tight sm:text-4xl">
                        Build {{ config('app.name') }} together.
                    </h2>

                    <p class="mt-4 max-w-3xl text-base leading-7 text-white/85 sm:text-lg">
                        Connect with developers, share ideas, improve the platform
                        and build better experiences for the community.
                    </p>

                    <div class="mt-8 grid gap-4 md:grid-cols-3">

                        <div class="rounded-2xl border border-white/15 bg-white/10 p-5 backdrop-blur-sm">
                            <div class="text-2xl">💻</div>

                            <h3 class="mt-3 font-bold">
                                Developers
                            </h3>

                            <p class="mt-1 text-sm text-white/75">
                                Meet and collaborate with talented builders.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-white/15 bg-white/10 p-5 backdrop-blur-sm">
                            <div class="text-2xl">🚀</div>

                            <h3 class="mt-3 font-bold">
                                Innovation
                            </h3>

                            <p class="mt-1 text-sm text-white/75">
                                Help improve features and experiences.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-white/15 bg-white/10 p-5 backdrop-blur-sm">
                            <div class="text-2xl">🌍</div>

                            <h3 class="mt-3 font-bold">
                                Community
                            </h3>

                            <p class="mt-1 text-sm text-white/75">
                                Learn, share knowledge and grow together.
                            </p>
                        </div>

                    </div>

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- Share Profile --}}
            {{-- ========================================================= --}}

            @if ($developer->user?->username)

                @php
                    $developerUrl = route('developer.show', [
                        'username' => $developer->user->username,
                    ]);
                @endphp

                <section
                    class="mt-12 rounded-[2rem] border border-slate-200
                       bg-white p-6 shadow-sm
                       dark:border-slate-800 dark:bg-slate-900 sm:p-8">

                    <div class="flex flex-col gap-6">

                        <div>

                            <span class="text-[11px] font-black uppercase tracking-[0.2em] text-orange-500">
                                Share
                            </span>

                            <h2 class="mt-2 text-2xl font-black text-slate-900 dark:text-white">
                                Share this developer
                            </h2>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Share the developer's unique profile URL.
                            </p>

                        </div>


                        {{-- URL --}}
                        <div class="flex flex-col gap-3 sm:flex-row">

                            <div class="relative min-w-0 flex-1">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0
                                       flex items-center pl-4">

                                    <svg class="h-5 w-5 text-orange-500" fill="none" stroke="currentColor"
                                        stroke-width="1.8" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.828 10.172a4 4 0 010 5.656l-2 2a4 4 0 01-5.656-5.656l1-1" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.172 13.828a4 4 0 010-5.656l2-2a4 4 0 015.656 5.656l-1 1" />

                                    </svg>

                                </div>

                                <input readonly value="{{ $developerUrl }}" id="developerLink"
                                    aria-label="Developer profile URL"
                                    class="w-full rounded-xl border border-slate-200
                                       bg-slate-50 py-3.5 pl-11 pr-4
                                       text-sm font-medium text-slate-600
                                       outline-none transition
                                       focus:border-orange-400
                                       focus:ring-2 focus:ring-orange-500/10
                                       dark:border-slate-700 dark:bg-slate-950
                                       dark:text-slate-300">

                            </div>


                            <button type="button" id="copyDeveloperLink"
                                class="inline-flex items-center justify-center gap-2
                                   rounded-xl bg-orange-500 px-6 py-3.5
                                   text-sm font-bold text-white
                                   shadow-lg shadow-orange-500/20
                                   transition-all duration-200
                                   hover:-translate-y-0.5 hover:bg-orange-600
                                   focus:outline-none focus:ring-2
                                   focus:ring-orange-500 focus:ring-offset-2
                                   dark:focus:ring-offset-slate-900">

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">

                                    <rect width="14" height="14" x="5" y="5" rx="2" />

                                    <path d="M9 5V3h10a2 2 0 0 1 2 2v10h-2" />

                                </svg>

                                <span id="copyDeveloperText">
                                    Copy Link
                                </span>

                            </button>

                        </div>


                        {{-- Username --}}
                        <div
                            class="flex items-center gap-4 rounded-2xl
                               border border-orange-100 bg-orange-50 p-4
                               dark:border-orange-500/10
                               dark:bg-orange-500/5">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center
                                   justify-center rounded-xl bg-orange-500
                                   text-lg font-black text-white">

                                @

                            </div>

                            <div class="min-w-0">

                                <p class="text-[11px] font-black uppercase tracking-wider text-slate-400">
                                    Username
                                </p>

                                <p class="mt-0.5 truncate font-bold text-orange-600 dark:text-orange-400">
                                    {{ '@' . $developer->user->username }}
                                </p>

                            </div>

                            <a href="{{ $developerUrl }}"
                                class="ml-auto hidden shrink-0 rounded-lg px-3 py-2
                                   text-xs font-bold text-orange-600
                                   transition hover:bg-orange-100
                                   sm:inline-flex dark:text-orange-400
                                   dark:hover:bg-orange-500/10">

                                View Profile

                            </a>

                        </div>

                    </div>

                </section>


                {{-- ===================================================== --}}
                {{-- Luxury Developer Business Card --}}
                {{-- ===================================================== --}}

                <section class="mt-8">

                    <div class="mb-5">

                        <span class="text-[11px] font-black uppercase tracking-[0.2em] text-orange-500">
                            Developer Identity
                        </span>

                        <h2 class="mt-2 text-2xl font-black text-slate-900 dark:text-white">
                            Premium Business Card
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            A distinctive digital identity for the {{ config('app.name') }} developer community.
                        </p>

                    </div>


                    {{-- BUSINESS CARD --}}
                    <div
                        class="group relative isolate overflow-hidden rounded-[2rem]
                           border border-slate-800 bg-[#09090b]
                           shadow-2xl shadow-slate-900/30">

                        {{-- Luxury orange glow --}}
                        <div
                            class="absolute -right-32 -top-32 h-80 w-80 rounded-full
                               bg-orange-500/20 blur-3xl">
                        </div>

                        <div
                            class="absolute -bottom-40 -left-20 h-96 w-96 rounded-full
                               bg-amber-500/10 blur-3xl">
                        </div>

                        {{-- Fine grid --}}
                        <div class="absolute inset-0 opacity-[0.035]"
                            style="background-image: linear-gradient(rgba(255,255,255,.8) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.8) 1px, transparent 1px); background-size: 32px 32px;">
                        </div>

                        {{-- Orange accent --}}
                        <div
                            class="absolute left-0 top-0 h-full w-1
                               bg-gradient-to-b from-orange-400
                               via-orange-500 to-amber-500">
                        </div>


                        <div class="relative p-6 sm:p-8 lg:p-10">

                            {{-- Top --}}
                            <div class="flex items-start justify-between gap-6">

                                <div>

                                    <div
                                        class="inline-flex items-center gap-2
                                           text-[10px] font-black uppercase
                                           tracking-[0.25em] text-orange-400">

                                        <span class="h-1.5 w-1.5 rounded-full bg-orange-400"></span>

                                        {{ config('app.name') }}

                                    </div>

                                    <p class="mt-2 text-[10px] font-bold uppercase tracking-[0.2em] text-white/35">
                                        Developer Network
                                    </p>

                                </div>


                                <div
                                    class="hidden rounded-full border border-white/10
                                       bg-white/[0.04] px-3 py-1.5 text-[10px]
                                       font-bold uppercase tracking-[0.18em]
                                       text-white/40 sm:block">

                                    DEVELOPER ID

                                </div>

                            </div>


                            {{-- Main card --}}
                            <div class="mt-10 flex flex-col gap-8 sm:flex-row sm:items-center">

                                {{-- Avatar --}}
                                <div class="relative shrink-0">

                                    <div
                                        class="rounded-[1.5rem] border border-white/10
                                           bg-white/[0.05] p-1.5 shadow-2xl">

                                        <img src="{{ $developer->avatar
                                            ? asset('storage/' . $developer->avatar)
                                            : 'https://ui-avatars.com/api/?name=' . urlencode($developer->name) . '&background=f97316&color=fff&size=256' }}"
                                            alt="{{ $developer->name }}"
                                            class="h-28 w-28 rounded-[1.15rem]
                                               object-cover sm:h-36 sm:w-36">

                                    </div>

                                    <span
                                        class="absolute -bottom-2 -right-2 flex h-8 w-8
                                           items-center justify-center rounded-full
                                           border-4 border-[#09090b] bg-emerald-500">

                                        <svg class="h-3.5 w-3.5 text-white" fill="none" stroke="currentColor"
                                            stroke-width="3" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12l4 4L19 6" />

                                        </svg>

                                    </span>

                                </div>


                                {{-- Identity --}}
                                <div class="min-w-0 flex-1">

                                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-orange-400">
                                        {{ $developer->role ?: 'Developer' }}
                                    </p>

                                    <h3
                                        class="mt-2 text-3xl font-black tracking-tight
                                           text-white sm:text-4xl">

                                        {{ $developer->name }}

                                    </h3>


                                    <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2">

                                        <span class="text-sm font-semibold text-white/45">
                                            {{ '@' . ($developer->user?->username ?? 'username') }}
                                        </span>

                                        <span class="hidden h-1 w-1 rounded-full bg-white/20 sm:block"></span>

                                        <span class="text-xs font-medium text-white/35">
                                            Active Developer
                                        </span>

                                    </div>

                                </div>


                                {{-- Monogram --}}
                                <div
                                    class="hidden h-20 w-20 shrink-0 items-center justify-center
                                       rounded-2xl border border-orange-400/20
                                       bg-orange-500/10 text-3xl font-black
                                       text-orange-400 sm:flex">

                                    {{ strtoupper(substr($developer->name, 0, 1)) }}

                                </div>

                            </div>


                            {{-- Divider --}}
                            <div class="my-8 h-px bg-white/10"></div>


                            {{-- Bottom --}}
                            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                                <div class="min-w-0">

                                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-white/30">
                                        Profile
                                    </p>

                                    <p class="mt-1 truncate text-sm font-semibold text-white/70">
                                        {{ $developerUrl }}
                                    </p>

                                </div>


                                <div class="flex items-center gap-2">

                                    @if ($developer->github)
                                        <a href="{{ $developer->github }}" target="_blank"
                                            rel="noopener noreferrer nofollow" aria-label="GitHub"
                                            class="flex h-10 w-10 items-center justify-center
                                               rounded-xl border border-white/10
                                               bg-white/[0.04] text-white/60
                                               transition hover:border-white/20
                                               hover:bg-white/10 hover:text-white">

                                            <svg class="h-4.5 w-4.5" fill="currentColor" viewBox="0 0 24 24">

                                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.5.5.092.682-.217.682-.483
                                                   0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.342-3.369-1.342
                                                   -.454-1.157-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608
                                                   1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088
                                                   2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951
                                                   0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65
                                                   0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004
                                                   1.705.115 2.504.337 1.909-1.296 2.747-1.026 2.747-1.026
                                                   .546 1.378.202 2.397.1 2.65.64.7 1.595 1.028 2.688
                                                   0 3.847-2.338 4.695-4.566 4.943.359.309.678.92.678 1.855
                                                   0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482
                                                   A10.019 10.019 0 0022 12.017C22 6.484 17.523 2 12 2Z"
                                                    clip-rule="evenodd" />

                                            </svg>

                                        </a>
                                    @endif


                                    @if ($developer->linkedin)
                                        <a href="{{ $developer->linkedin }}" target="_blank"
                                            rel="noopener noreferrer nofollow" aria-label="LinkedIn"
                                            class="flex h-10 w-10 items-center justify-center
                                               rounded-xl border border-white/10
                                               bg-white/[0.04] text-sm font-black
                                               text-white/60 transition
                                               hover:border-blue-400/30
                                               hover:bg-blue-500/10
                                               hover:text-blue-400">

                                            in

                                        </a>
                                    @endif


                                    @if ($developer->website)
                                        <a href="{{ $developer->website }}" target="_blank"
                                            rel="noopener noreferrer nofollow" aria-label="Portfolio Website"
                                            class="flex h-10 w-10 items-center justify-center
                                               rounded-xl border border-white/10
                                               bg-white/[0.04] text-white/60
                                               transition hover:border-orange-400/30
                                               hover:bg-orange-500/10
                                               hover:text-orange-400">

                                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor"
                                                stroke-width="1.8" viewBox="0 0 24 24">

                                                <circle cx="12" cy="12" r="9" />

                                                <path stroke-linecap="round"
                                                    d="M3 12h18M12 3c2.5 2.5 3.5 5.5 3.5 9s-1 6.5-3.5 9c-2.5-2.5-3.5-5.5-3.5-9S9.5 5.5 12 3Z" />

                                            </svg>

                                        </a>
                                    @endif

                                </div>

                            </div>


                            {{-- Card footer --}}
                            <div
                                class="mt-7 flex flex-col gap-2 border-t border-white/5
                                   pt-5 sm:flex-row sm:items-center sm:justify-between">

                                <p class="text-[9px] font-bold uppercase tracking-[0.2em] text-white/25">
                                    {{ config('app.name') }} Developer Community
                                </p>

                                <p class="text-[9px] font-bold uppercase tracking-[0.2em] text-orange-400/70">
                                    Verified Profile
                                </p>

                            </div>

                        </div>

                    </div>

                </section>

            @endif


            <div class="h-12"></div>

        </div>

    </div>


    {{-- =============================================================== --}}
    {{-- Copy Developer Profile URL --}}
    {{-- =============================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const button = document.getElementById('copyDeveloperLink');
            const input = document.getElementById('developerLink');
            const text = document.getElementById('copyDeveloperText');

            if (!button || !input || !text) {
                return;
            }

            const originalText = 'Copy Link';

            button.addEventListener('click', async function() {

                try {

                    if (navigator.clipboard && window.isSecureContext) {

                        await navigator.clipboard.writeText(input.value);

                    } else {

                        input.focus();
                        input.select();
                        input.setSelectionRange(0, input.value.length);

                        const copied = document.execCommand('copy');

                        if (!copied) {
                            throw new Error('Copy command failed.');
                        }

                    }

                    text.textContent = 'Copied!';

                    button.classList.remove(
                        'bg-orange-500',
                        'hover:bg-orange-600'
                    );

                    button.classList.add(
                        'bg-emerald-500',
                        'hover:bg-emerald-600'
                    );

                    setTimeout(function() {

                        text.textContent = originalText;

                        button.classList.remove(
                            'bg-emerald-500',
                            'hover:bg-emerald-600'
                        );

                        button.classList.add(
                            'bg-orange-500',
                            'hover:bg-orange-600'
                        );

                    }, 2000);

                } catch (error) {

                    console.error('Unable to copy developer URL:', error);

                    text.textContent = 'Copy failed';

                    setTimeout(function() {
                        text.textContent = originalText;
                    }, 2000);

                }

            });

        });
    </script>

</x-app-layout>
