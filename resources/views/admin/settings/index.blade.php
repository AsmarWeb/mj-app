<x-admin>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            {{-- Page Header --}}
            <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-200">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.594 3.94a1.5 1.5 0 012.812 0l.292.732a1.5 1.5 0 001.91.83l.72-.284a1.5 1.5 0 011.947 1.947l-.284.72a1.5 1.5 0 00.83 1.91l.732.292a1.5 1.5 0 010 2.812l-.732.292a1.5 1.5 0 00-.83 1.91l.284.72a1.5 1.5 0 01-1.947 1.947l-.72-.284a1.5 1.5 0 00-1.91.83l-.292.732a1.5 1.5 0 01-2.812 0l-.292-.732a1.5 1.5 0 00-1.91-.83l-.72.284a1.5 1.5 0 01-1.947-1.947l.284-.72a1.5 1.5 0 00-.83-1.91l-.732-.292a1.5 1.5 0 010-2.812l.732-.292a1.5 1.5 0 00.83-1.91l-.284-.72a1.5 1.5 0 011.947-1.947l.72.284a1.5 1.5 0 001.91-.83l.292-.732z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                                Platform Settings
                            </h1>

                            <p class="mt-1 text-sm text-slate-500">
                                Manage your platform configuration, visibility and behaviour.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Header Controls --}}
                <div class="flex items-center gap-3">

                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-2 text-sm font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Platform Online
                    </span>

                    <a href="{{ route('settings.edit', $setting->id) }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a2.121 2.121 0 013 3l-9.9 9.9-4.137 1.034 1.034-4.137 9.35-9.209z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 13.5V19.5A1.5 1.5 0 0118 21H6a1.5 1.5 0 01-1.5-1.5V6A1.5 1.5 0 016 4.5h6" />
                        </svg>

                        Edit Settings
                    </a>
                </div>
            </div>


            {{-- Flash Message --}}
            @if (session()->has('message'))
                <div
                    class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <span class="font-medium">
                        {{ session()->get('message') }}
                    </span>
                </div>
            @endif


            {{-- Platform Status --}}
            <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 21V9.75m0 0a3 3 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016A2.993 2.993 0 0014.25 9.75c.896 0 1.7-.393 2.25-1.015a3 3 0 003.75.614V21" />
                            </svg>
                        </div>

                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Platform
                        </span>
                    </div>

                    <p class="mt-4 text-lg font-bold text-slate-900">
                        Active
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        Website is currently available.
                    </p>
                </div>


                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.38 9.38 0 002.625-.372M6.75 19.128a9.38 9.38 0 01-2.625.372 9.38 9.38 0 01-2.625-.372M15 19.128V16.5a3 3 0 00-3-3H9a3 3 0 00-3 3v2.628M15 19.128a9.38 9.38 0 01-8.25 0M15 19.128a9.38 9.38 0 002.625.372M18 9a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>

                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Users
                        </span>
                    </div>

                    <p class="mt-4 text-lg font-bold text-slate-900">
                        Registration Enabled
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        New users can create accounts.
                    </p>
                </div>


                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-100 text-violet-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 21V9.75m0 0a3 3 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016A2.993 2.993 0 0014.25 9.75c.896 0 1.7-.393 2.25-1.015a3 3 0 003.75.614V21" />
                            </svg>
                        </div>

                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Listings
                        </span>
                    </div>

                    <p class="mt-4 text-lg font-bold text-slate-900">
                        Moderation Enabled
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        Listings require platform review.
                    </p>
                </div>


                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m0 3.75h.008v.008H12V16.5Zm9-4.5a9 9 0 11-18 0 9 9 0 0118 0Z" />
                            </svg>
                        </div>

                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Security
                        </span>
                    </div>

                    <p class="mt-4 text-lg font-bold text-slate-900">
                        Protected
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        Administrative controls enabled.
                    </p>
                </div>

            </div>


            {{-- Main Settings Grid --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- General --}}
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:col-span-2">

                    <div class="border-b border-slate-200 px-6 py-5">
                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18" />
                                </svg>
                            </div>

                            <div>
                                <h2 class="font-bold text-slate-900">
                                    General Information
                                </h2>

                                <p class="text-sm text-slate-500">
                                    Basic information about your platform.
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2">

                        {{-- Logo --}}
                        <div>
                            <p class="mb-3 text-xs font-bold uppercase tracking-wider text-slate-400">
                                Logo
                            </p>

                            <div
                                class="flex h-28 items-center justify-center rounded-xl border border-dashed border-slate-300 bg-slate-50 p-4">
                                <img src="{{ asset($setting->logo) }}" class="max-h-20 max-w-full object-contain"
                                    alt="Platform Logo">
                            </div>
                        </div>


                        {{-- Favicon --}}
                        <div>
                            <p class="mb-3 text-xs font-bold uppercase tracking-wider text-slate-400">
                                Favicon
                            </p>

                            <div
                                class="flex h-28 items-center justify-center rounded-xl border border-dashed border-slate-300 bg-slate-50 p-4">
                                <img src="{{ asset($setting->favicon) }}" class="h-14 w-14 object-contain"
                                    alt="Platform Favicon">
                            </div>
                        </div>


                        {{-- Phone --}}
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Phone
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $setting->phone ?: 'Not configured' }}
                            </p>
                        </div>


                        {{-- Phone 2 --}}
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Secondary Phone
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $setting->phone2 ?: 'Not configured' }}
                            </p>
                        </div>


                        {{-- Email --}}
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Email Address
                            </p>

                            <p class="mt-2 break-all font-semibold text-slate-900">
                                {{ $setting->email ?: 'Not configured' }}
                            </p>
                        </div>


                        {{-- Address --}}
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Address
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $setting->address ?: 'Not configured' }}
                            </p>
                        </div>

                    </div>
                </div>


                {{-- Platform Controls --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="font-bold text-slate-900">
                            Platform Controls
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Control how the platform behaves.
                        </p>
                    </div>


                    <div class="divide-y divide-slate-100">

                        {{-- Maintenance Mode --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <div class="flex items-center justify-between gap-4">

                                <div>
                                    <h3 class="text-sm font-semibold text-slate-900">
                                        Maintenance Mode
                                    </h3>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Temporarily disable public access to the platform.
                                    </p>
                                </div>

                                {{-- Toggle --}}
                                <label class="relative inline-flex cursor-pointer items-center">

                                    <input type="checkbox" name="maintenance_mode" value="1"
                                        class="peer sr-only"
                                        {{ old('maintenance_mode', $setting->maintenance_mode) ? 'checked' : '' }}>

                                    <div
                                        class="h-6 w-11 rounded-full bg-slate-300
                peer-checked:bg-orange-500
                peer-focus:outline-none
                peer-focus:ring-4 peer-focus:ring-orange-200
                transition-colors duration-200
                after:absolute after:left-[2px] after:top-[2px]
                after:h-5 after:w-5 after:rounded-full
                after:border after:border-slate-300
                after:bg-white after:transition-all
                after:content-['']
                peer-checked:after:translate-x-full
                peer-checked:after:border-white">
                                    </div>

                                </label>

                            </div>

                            {{-- Current status --}}
                            <div class="mt-4">

                                @if ($setting->maintenance_mode)
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full
                bg-orange-100 px-3 py-1 text-xs font-medium text-orange-700">

                                        <span class="h-2 w-2 rounded-full bg-orange-500"></span>

                                        Maintenance is ON

                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full
                bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700">

                                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                                        Platform is LIVE

                                    </span>
                                @endif

                            </div>
                        </div>


                        {{-- Registration --}}
                        <div class="flex items-center justify-between gap-4 px-6 py-5">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    User Registration
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    Allow visitors to register.
                                </p>
                            </div>

                            <div class="relative inline-flex h-6 w-11 shrink-0 rounded-full bg-emerald-500">
                                <span class="inline-block h-6 w-6 translate-x-5 rounded-full bg-white shadow"></span>
                            </div>
                        </div>


                        {{-- Listing Approval --}}
                        <div class="flex items-center justify-between gap-4 px-6 py-5">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    Listing Approval
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    Review listings before publishing.
                                </p>
                            </div>

                            <div class="relative inline-flex h-6 w-11 shrink-0 rounded-full bg-emerald-500">
                                <span class="inline-block h-6 w-6 translate-x-5 rounded-full bg-white shadow"></span>
                            </div>
                        </div>


                        {{-- Featured Listings --}}
                        <div class="flex items-center justify-between gap-4 px-6 py-5">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    Featured Listings
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    Allow listings to be promoted.
                                </p>
                            </div>

                            <div class="relative inline-flex h-6 w-11 shrink-0 rounded-full bg-emerald-500">
                                <span class="inline-block h-6 w-6 translate-x-5 rounded-full bg-white shadow"></span>
                            </div>
                        </div>

                    </div>
                </div>


                {{-- Descriptions --}}
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:col-span-2">

                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="font-bold text-slate-900">
                            Platform Description
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Public-facing information displayed throughout the platform.
                        </p>
                    </div>

                    <div class="space-y-6 p-6">

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Short Description
                            </p>

                            <p class="mt-2 rounded-xl bg-slate-50 p-4 text-sm leading-6 text-slate-700">
                                {{ $setting->short_des ?: 'No short description configured.' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Description
                            </p>

                            <p class="mt-2 rounded-xl bg-slate-50 p-4 text-sm leading-7 text-slate-700">
                                {{ $setting->description ?: 'No description configured.' }}
                            </p>
                        </div>

                    </div>
                </div>


                {{-- Quick Control --}}
                <div
                    class="rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-700 p-6 text-white shadow-lg shadow-indigo-200">

                    <p class="text-sm font-semibold text-indigo-100">
                        Administration
                    </p>

                    <h2 class="mt-2 text-xl font-bold">
                        Platform Control Center
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-indigo-100">
                        Manage platform behaviour, users, listings, branding and public information from one place.
                    </p>

                    <a href="{{ route('settings.edit', $setting->id) }}"
                        class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white px-4 py-3 text-sm font-bold text-indigo-700 transition hover:bg-indigo-50">

                        Edit Platform Settings

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>

                    </a>
                </div>


                {{-- Social Media --}}
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:col-span-2">

                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="font-bold text-slate-900">
                            Social Media
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Manage the social profiles connected to your platform.
                        </p>
                    </div>


                    <div class="grid grid-cols-1 divide-y divide-slate-100 sm:grid-cols-2 sm:divide-x sm:divide-y-0">

                        <div class="space-y-5 p-6">

                            {{-- Facebook --}}
                            <div class="flex items-center gap-4">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                    <span class="font-bold">f</span>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-slate-900">Facebook</p>

                                    <a href="{{ $setting->facebook }}" target="_blank"
                                        class="mt-1 block truncate text-sm text-indigo-600 hover:text-indigo-700">
                                        {{ $setting->facebook ?: 'Not configured' }}
                                    </a>
                                </div>
                            </div>


                            {{-- Instagram --}}
                            <div class="flex items-center gap-4">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-pink-100 text-pink-600">
                                    <span class="text-sm font-bold">IG</span>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-slate-900">Instagram</p>

                                    <a href="{{ $setting->instagram }}" target="_blank"
                                        class="mt-1 block truncate text-sm text-indigo-600 hover:text-indigo-700">
                                        {{ $setting->instagram ?: 'Not configured' }}
                                    </a>
                                </div>
                            </div>

                        </div>


                        <div class="space-y-5 p-6">

                            {{-- Telegram --}}
                            <div class="flex items-center gap-4">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sky-100 text-sky-600">
                                    <span class="text-sm font-bold">TG</span>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-slate-900">Telegram</p>

                                    <a href="{{ $setting->telegram }}" target="_blank"
                                        class="mt-1 block truncate text-sm text-indigo-600 hover:text-indigo-700">
                                        {{ $setting->telegram ?: 'Not configured' }}
                                    </a>
                                </div>
                            </div>


                            {{-- TikTok --}}
                            <div class="flex items-center gap-4">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-900 text-white">
                                    <span class="text-xs font-bold">TT</span>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-slate-900">TikTok</p>

                                    <a href="{{ $setting->tiktok }}" target="_blank"
                                        class="mt-1 block truncate text-sm text-indigo-600 hover:text-indigo-700">
                                        {{ $setting->tiktok ?: 'Not configured' }}
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


                {{-- Security Controls --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="font-bold text-slate-900">
                            Security
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Important platform security controls.
                        </p>
                    </div>


                    <div class="space-y-4 p-6">

                        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4">
                            <div class="flex gap-3">
                                <div class="mt-0.5 text-emerald-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 12c0 4.97 3.03 9.24 7.5 11.25 4.47-2.01 7.5-6.28 7.5-11.25 0-1.07-.14-2.1-.382-3.016z" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-bold text-emerald-800">
                                        Security Status
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-emerald-700">
                                        Your administration area is protected.
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="rounded-xl border border-slate-200 p-4">
                            <p class="text-sm font-semibold text-slate-900">
                                Email Verification
                            </p>

                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-xs text-slate-500">
                                    Require verified accounts
                                </span>

                                <span
                                    class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                    Enabled
                                </span>
                            </div>
                        </div>


                        <div class="rounded-xl border border-slate-200 p-4">
                            <p class="text-sm font-semibold text-slate-900">
                                Admin Access
                            </p>

                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-xs text-slate-500">
                                    Protected routes
                                </span>

                                <span
                                    class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                    Protected
                                </span>
                            </div>
                        </div>

                    </div>
                </div>


                {{-- Map --}}
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:col-span-3">

                    <div class="border-b border-slate-200 px-6 py-5">
                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-100 text-rose-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 20.25l-5.25-3V6.75L9 3.75l6 3 5.25-3v10.5L15 17.25l-6 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 3.75v16.5m6-13.5v16.5" />
                                </svg>
                            </div>

                            <div>
                                <h2 class="font-bold text-slate-900">
                                    Platform Location
                                </h2>

                                <p class="text-sm text-slate-500">
                                    Map location displayed on the platform.
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="p-4">
                        <div class="relative h-80 overflow-hidden rounded-xl bg-slate-100">
                            <iframe class="absolute inset-0 h-full w-full" src="{{ $setting->map }}" frameborder="0"
                                style="border:0;" allowfullscreen loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</x-admin>
