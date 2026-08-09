<x-admin>


    {{-- ========================================================= --}}
    {{-- LISTINGS MANAGEMENT --}}
    {{-- ========================================================= --}}

    <div class="space-y-6">

        {{-- ===================================================== --}}
        {{-- PAGE HEADER --}}
        {{-- ===================================================== --}}

        <div
            class="relative overflow-hidden rounded-[2rem]
               border border-orange-100
               bg-gradient-to-br from-white via-orange-50/40 to-amber-50
               p-6 shadow-xl shadow-orange-100/40
               dark:border-slate-800
               dark:from-slate-900 dark:via-slate-900 dark:to-orange-950/20
               dark:shadow-none sm:p-8">

            {{-- Decorative Glow --}}
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full
                   bg-orange-400/10 blur-3xl">
            </div>

            <div class="absolute -bottom-24 -left-20 h-64 w-64 rounded-full
                   bg-amber-400/10 blur-3xl">
            </div>

            <div class="relative">

                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    {{-- Title --}}
                    <div>

                        <div class="mb-3 flex items-center gap-3">

                            <div
                                class="flex h-11 w-11 items-center justify-center
                                   rounded-2xl bg-orange-600 text-white
                                   shadow-lg shadow-orange-200
                                   dark:shadow-orange-950/40">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 7.5h18M5.25 7.5v10.875A1.875 1.875 0 007.125 20.25h9.75a1.875 1.875 0 001.875-1.875V7.5M8.25 7.5V5.625A1.875 1.875 0 0110.125 3.75h3.75a1.875 1.875 0 011.875 1.875V7.5M9 11.25v5.25m6-5.25v5.25" />

                                </svg>

                            </div>

                            <span
                                class="text-xs font-bold uppercase tracking-[0.2em]
                                   text-orange-600 dark:text-orange-400">

                                Marketplace Management

                            </span>

                        </div>

                        <h1
                            class="text-3xl font-black tracking-tight
                               text-slate-900 dark:text-white sm:text-4xl">

                            Listings

                        </h1>

                        <p
                            class="mt-2 max-w-2xl text-sm leading-6
                               text-slate-500 dark:text-slate-400">

                            Manage, feature, edit and remove marketplace listings
                            from one central dashboard.

                        </p>

                    </div>


                    {{-- Header Controls --}}
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                        <span
                            class="inline-flex items-center justify-center rounded-full
                               bg-orange-100 px-4 py-2
                               text-sm font-bold text-orange-700
                               ring-1 ring-inset ring-orange-200
                               dark:bg-orange-500/10
                               dark:text-orange-400
                               dark:ring-orange-500/20">

                            {{ $listings->total() }}

                            {{ \Illuminate\Support\Str::plural('Listing', $listings->total()) }}

                        </span>

                        <a href="{{ route('admin.create') }}"
                            class="inline-flex items-center justify-center gap-2
                               rounded-xl bg-orange-600 px-5 py-3
                               text-sm font-bold text-white
                               shadow-lg shadow-orange-200
                               transition duration-200
                               hover:-translate-y-0.5
                               hover:bg-orange-700
                               focus:outline-none
                               focus:ring-4 focus:ring-orange-500/20
                               dark:shadow-orange-950/30">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />

                            </svg>

                            Add Listing

                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- FLASH MESSAGE --}}
        {{-- ===================================================== --}}

        @if (session('success'))
            <div
                class="flex items-start gap-3 rounded-2xl
                   border border-emerald-200
                   bg-emerald-50 p-5
                   text-emerald-800 shadow-sm
                   dark:border-emerald-900/50
                   dark:bg-emerald-950/30
                   dark:text-emerald-300">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center
                       rounded-full bg-emerald-500 text-white">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />

                    </svg>

                </div>

                <div>

                    <p class="font-bold">
                        Success
                    </p>

                    <p class="mt-1 text-sm">
                        {{ session('success') }}
                    </p>

                </div>

            </div>
        @endif


        {{-- ===================================================== --}}
        {{-- LISTING MANAGEMENT CARD --}}
        {{-- ===================================================== --}}

        <div
            class="overflow-hidden rounded-[1.5rem]
               border border-slate-200
               bg-white
               shadow-xl shadow-slate-200/50
               dark:border-slate-800
               dark:bg-slate-900
               dark:shadow-none">

            {{-- ================================================= --}}
            {{-- FILTER BAR --}}
            {{-- ================================================= --}}

            <div
                class="border-b border-slate-100
                   px-6 py-5
                   dark:border-slate-800">

                <form method="GET" action="{{ route('listings.index') }}">

                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-[1fr_180px_180px_180px_auto]">

                        {{-- Search --}}
                        <div>

                            <label for="listing-search"
                                class="mb-2 block text-xs font-bold uppercase
                                   tracking-wider text-slate-500
                                   dark:text-slate-400">

                                Search Listings

                            </label>

                            <div class="relative">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0
                                       flex items-center pl-4 text-slate-400">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />

                                    </svg>

                                </div>

                                <input type="search" name="search" id="listing-search" value="{{ request('search') }}"
                                    placeholder="Search title or slug..."
                                    class="w-full rounded-xl
                                       border border-slate-200
                                       bg-slate-50
                                       py-3 pl-11 pr-4
                                       text-sm text-slate-900
                                       outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-orange-500
                                       focus:bg-white
                                       focus:ring-4 focus:ring-orange-500/10
                                       dark:border-slate-700
                                       dark:bg-slate-800
                                       dark:text-white
                                       dark:placeholder:text-slate-500
                                       dark:focus:border-orange-500">

                            </div>

                        </div>


                        {{-- Status --}}
                        <div>

                            <label for="status"
                                class="mb-2 block text-xs font-bold uppercase
                                   tracking-wider text-slate-500
                                   dark:text-slate-400">

                                Status

                            </label>

                            <select name="status" id="status"
                                class="w-full rounded-xl
                                   border border-slate-200
                                   bg-slate-50
                                   px-4 py-3
                                   text-sm font-medium text-slate-700
                                   outline-none transition
                                   focus:border-orange-500
                                   focus:bg-white
                                   focus:ring-4 focus:ring-orange-500/10
                                   dark:border-slate-700
                                   dark:bg-slate-800
                                   dark:text-slate-200">

                                <option value="">All Status</option>

                                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>
                                    Published
                                </option>

                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>
                                    Draft
                                </option>

                                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>
                                    Expired
                                </option>

                                <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>
                                    Archived
                                </option>

                            </select>

                        </div>


                        {{-- Active --}}
                        <div>

                            <label for="active"
                                class="mb-2 block text-xs font-bold uppercase
                                   tracking-wider text-slate-500
                                   dark:text-slate-400">

                                Activity

                            </label>

                            <select name="active" id="active"
                                class="w-full rounded-xl
                                   border border-slate-200
                                   bg-slate-50
                                   px-4 py-3
                                   text-sm font-medium text-slate-700
                                   outline-none transition
                                   focus:border-orange-500
                                   focus:bg-white
                                   focus:ring-4 focus:ring-orange-500/10
                                   dark:border-slate-700
                                   dark:bg-slate-800
                                   dark:text-slate-200">

                                <option value="">All Listings</option>

                                <option value="1" {{ request('active') === '1' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ request('active') === '0' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>


                        {{-- Featured --}}
                        <div>

                            <label for="featured"
                                class="mb-2 block text-xs font-bold uppercase
                                   tracking-wider text-slate-500
                                   dark:text-slate-400">

                                Featured

                            </label>

                            <select name="featured" id="featured"
                                class="w-full rounded-xl
                                   border border-slate-200
                                   bg-slate-50
                                   px-4 py-3
                                   text-sm font-medium text-slate-700
                                   outline-none transition
                                   focus:border-orange-500
                                   focus:bg-white
                                   focus:ring-4 focus:ring-orange-500/10
                                   dark:border-slate-700
                                   dark:bg-slate-800
                                   dark:text-slate-200">

                                <option value="">All</option>

                                <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>
                                    Featured
                                </option>

                                <option value="0" {{ request('featured') === '0' ? 'selected' : '' }}>
                                    Not Featured
                                </option>

                            </select>

                        </div>


                        {{-- Filter Button --}}
                        <div class="flex items-end gap-2">

                            <button type="submit"
                                class="inline-flex h-[46px] w-full
                                   items-center justify-center gap-2
                                   rounded-xl bg-orange-600 px-5
                                   text-sm font-bold text-white
                                   shadow-lg shadow-orange-200
                                   transition
                                   hover:bg-orange-700
                                   focus:outline-none
                                   focus:ring-4 focus:ring-orange-500/20
                                   dark:shadow-orange-950/30">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />

                                </svg>

                                Filter

                            </button>

                        </div>

                    </div>


                    {{-- Clear Filters --}}
                    @if (request()->hasAny(['search', 'status', 'active', 'featured']))
                        <div class="mt-4">

                            <a href="{{ route('listings.index') }}"
                                class="text-sm font-semibold text-orange-600
                                   hover:text-orange-700
                                   dark:text-orange-400">

                                Clear all filters

                            </a>

                        </div>
                    @endif

                </form>

            </div>


            {{-- ================================================= --}}
            {{-- DIRECTORY HEADER --}}
            {{-- ================================================= --}}

            <div
                class="flex flex-col gap-2
                   border-b border-slate-100
                   px-6 py-5
                   sm:flex-row sm:items-center sm:justify-between
                   dark:border-slate-800">

                <div>

                    <h2 class="text-lg font-black text-slate-900 dark:text-white">
                        Listing Directory
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">

                        @if (request('search'))
                            Results for
                            <span class="font-semibold text-orange-600 dark:text-orange-400">
                                "{{ request('search') }}"
                            </span>
                        @else
                            Manage all marketplace listings
                        @endif

                    </p>

                </div>

                <div class="text-sm text-slate-500 dark:text-slate-400">

                    Showing

                    <span class="font-bold text-slate-900 dark:text-white">
                        {{ $listings->firstItem() ?? 0 }}
                    </span>

                    –

                    <span class="font-bold text-slate-900 dark:text-white">
                        {{ $listings->lastItem() ?? 0 }}
                    </span>

                    of

                    <span class="font-bold text-slate-900 dark:text-white">
                        {{ $listings->total() }}
                    </span>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- TABLE --}}
            {{-- ================================================= --}}

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1200px] text-left">

                    <thead
                        class="border-b border-slate-200
                           bg-slate-50
                           dark:border-slate-800
                           dark:bg-slate-950/50">

                        <tr>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                #
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Image
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Listing
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Status
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Featured
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                                Controls
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                        @forelse ($listings as $listing)
                            <tr
                                class="group transition-colors
                                   hover:bg-orange-50/40
                                   dark:hover:bg-orange-950/10">

                                {{-- ID --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    <span
                                        class="text-sm font-bold text-slate-400
                                           group-hover:text-orange-600
                                           dark:group-hover:text-orange-400">

                                        #{{ $listing->id }}

                                    </span>

                                </td>


                                {{-- IMAGE --}}
                                <td class="px-6 py-5">

                                    <div
                                        class="h-16 w-16 overflow-hidden rounded-xl
                                           border border-slate-200
                                           bg-slate-100 shadow-sm
                                           dark:border-slate-700
                                           dark:bg-slate-800">

                                        @if ($listing->image)
                                            <img src="{{ Storage::url('products/' . $listing->image) }}"
                                                alt="{{ $listing->title }}"
                                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                                        @else
                                            <div
                                                class="flex h-full w-full items-center
                                                   justify-center text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.5">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 16.5l4.5-4.5 3 3 4.5-5.25L21 15" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 19.5h15A1.5 1.5 0 0021 18V6a1.5 1.5 0 00-1.5-1.5h-15A1.5 1.5 0 003 6v12a1.5 1.5 0 001.5 1.5z" />

                                                </svg>

                                            </div>
                                        @endif

                                    </div>

                                </td>


                                {{-- LISTING --}}
                                <td class="px-6 py-5">

                                    <div>

                                        <a href="{{ route('listings.edit', $listing->id) }}"
                                            class="font-bold text-slate-900
                                               transition
                                               hover:text-orange-600
                                               dark:text-white
                                               dark:hover:text-orange-400">

                                            {{ $listing->title }}

                                        </a>

                                        <div class="mt-1">

                                            <span
                                                class="rounded-lg
                                                   bg-slate-100 px-2.5 py-1
                                                   font-mono text-xs
                                                   text-slate-500
                                                   dark:bg-slate-800
                                                   dark:text-slate-400">

                                                /{{ $listing->slug }}

                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- STATUS --}}
                                <td class="px-6 py-5">

                                    <div class="flex flex-col items-start gap-2">

                                        {{-- Active --}}
                                        @if ($listing->active)
                                            <span
                                                class="inline-flex items-center gap-2
                                                   rounded-full
                                                   bg-emerald-50 px-3 py-1.5
                                                   text-xs font-bold
                                                   text-emerald-700
                                                   ring-1 ring-inset
                                                   ring-emerald-200
                                                   dark:bg-emerald-500/10
                                                   dark:text-emerald-400
                                                   dark:ring-emerald-500/20">

                                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                                                Active

                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-2
                                                   rounded-full
                                                   bg-red-50 px-3 py-1.5
                                                   text-xs font-bold
                                                   text-red-700
                                                   ring-1 ring-inset
                                                   ring-red-200
                                                   dark:bg-red-500/10
                                                   dark:text-red-400
                                                   dark:ring-red-500/20">

                                                <span class="h-2 w-2 rounded-full bg-red-500"></span>

                                                Inactive

                                            </span>
                                        @endif


                                        {{-- Publication Status --}}
                                        @switch($listing->status)
                                            @case('published')
                                                <span
                                                    class="inline-flex items-center rounded-full
                                                       bg-blue-50 px-3 py-1.5
                                                       text-xs font-bold text-blue-700
                                                       ring-1 ring-inset ring-blue-200
                                                       dark:bg-blue-500/10
                                                       dark:text-blue-400
                                                       dark:ring-blue-500/20">

                                                    Published

                                                </span>
                                            @break

                                            @case('draft')
                                                <span
                                                    class="inline-flex items-center rounded-full
                                                       bg-slate-100 px-3 py-1.5
                                                       text-xs font-bold text-slate-600
                                                       ring-1 ring-inset ring-slate-200
                                                       dark:bg-slate-800
                                                       dark:text-slate-400
                                                       dark:ring-slate-700">

                                                    Draft

                                                </span>
                                            @break

                                            @case('expired')
                                                <span
                                                    class="inline-flex items-center rounded-full
                                                       bg-amber-50 px-3 py-1.5
                                                       text-xs font-bold text-amber-700
                                                       ring-1 ring-inset ring-amber-200
                                                       dark:bg-amber-500/10
                                                       dark:text-amber-400
                                                       dark:ring-amber-500/20">

                                                    Expired

                                                </span>
                                            @break

                                            @case('archived')
                                                <span
                                                    class="inline-flex items-center rounded-full
                                                       bg-slate-100 px-3 py-1.5
                                                       text-xs font-bold text-slate-600
                                                       ring-1 ring-inset ring-slate-200
                                                       dark:bg-slate-800
                                                       dark:text-slate-400
                                                       dark:ring-slate-700">

                                                    Archived

                                                </span>
                                            @break

                                            @default
                                                <span
                                                    class="inline-flex items-center rounded-full
                                                       bg-slate-100 px-3 py-1.5
                                                       text-xs font-bold text-slate-500
                                                       dark:bg-slate-800
                                                       dark:text-slate-400">

                                                    {{ ucfirst($listing->status ?? 'Unknown') }}

                                                </span>
                                        @endswitch

                                    </div>

                                </td>


                                {{-- FEATURED --}}
                                <td class="px-6 py-5">

                                    @if ($listing->featured)
                                        <span
                                            class="inline-flex items-center gap-2
                                               rounded-full
                                               bg-orange-50 px-3 py-1.5
                                               text-xs font-bold
                                               text-orange-700
                                               ring-1 ring-inset
                                               ring-orange-200
                                               dark:bg-orange-500/10
                                               dark:text-orange-400
                                               dark:ring-orange-500/20">

                                            <span
                                                class="flex h-4 w-4 items-center justify-center
                                                   rounded-full bg-orange-500 text-white">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                    fill="currentColor" viewBox="0 0 20 20">

                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-7.5 7.5a1 1 0 01-1.414 0l-3-3a1 1 0 011.414-1.414L8.5 12.086l6.793-6.793a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />

                                                </svg>

                                            </span>

                                            Featured

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2
                                               rounded-full
                                               bg-slate-100 px-3 py-1.5
                                               text-xs font-semibold
                                               text-slate-500
                                               ring-1 ring-inset
                                               ring-slate-200
                                               dark:bg-slate-800
                                               dark:text-slate-400
                                               dark:ring-slate-700">

                                            <span class="h-2 w-2 rounded-full bg-slate-400"></span>

                                            Not Featured

                                        </span>
                                    @endif

                                </td>


                                {{-- CONTROLS --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Feature / Unfeature --}}
                                        @if ($listing->featured)
                                            <form action="{{ route('listings.unfeatured', $listing->id) }}"
                                                method="POST">

                                                @csrf

                                                <button type="submit" title="Remove from featured"
                                                    onclick="return confirm('Remove this listing from featured?')"
                                                    class="inline-flex items-center gap-2
                                                       rounded-lg
                                                       bg-slate-900 px-3 py-2
                                                       text-xs font-bold text-white
                                                       transition
                                                       hover:bg-red-600
                                                       focus:outline-none
                                                       focus:ring-4
                                                       focus:ring-red-500/20
                                                       dark:bg-slate-700
                                                       dark:hover:bg-red-600">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M5 12h14" />

                                                    </svg>

                                                    Unfeature

                                                </button>

                                            </form>
                                        @else
                                            <form action="{{ route('listings.featured', $listing->id) }}"
                                                method="POST">

                                                @csrf

                                                <button type="submit" title="Feature listing"
                                                    class="inline-flex items-center gap-2
                                                       rounded-lg
                                                       bg-orange-600 px-3 py-2
                                                       text-xs font-bold text-white
                                                       shadow-sm
                                                       transition
                                                       hover:bg-orange-700
                                                       focus:outline-none
                                                       focus:ring-4
                                                       focus:ring-orange-500/20">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 3l2.78 5.63 6.22.9-4.5 4.39 1.06 6.2L12 17.2l-5.56 2.92 1.06-6.2L3 9.53l6.22-.9L12 3z" />

                                                    </svg>

                                                    Feature

                                                </button>

                                            </form>
                                        @endif


                                        {{-- Edit --}}
                                        <a href="{{ route('listings.edit', $listing->id) }}" title="Edit listing"
                                            class="inline-flex h-9 w-9 items-center
                                               justify-center rounded-lg
                                               border border-slate-200
                                               bg-white text-slate-500
                                               transition
                                               hover:border-orange-200
                                               hover:bg-orange-50
                                               hover:text-orange-600
                                               dark:border-slate-700
                                               dark:bg-slate-800
                                               dark:text-slate-400
                                               dark:hover:bg-orange-950/30
                                               dark:hover:text-orange-400">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a2.121 2.121 0 013 3l-9.9 9.9-4.137 1.034 1.034-4.137 8.316-8.109z" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 13.5V19.5A1.5 1.5 0 0118 21H6a1.5 1.5 0 01-1.5-1.5V6A1.5 1.5 0 016 4.5h6" />

                                            </svg>

                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('listings.destroy', $listing->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" title="Delete listing"
                                                onclick="return confirm('Are you sure you want to delete this listing?')"
                                                class="inline-flex h-9 w-9 items-center
                                                   justify-center rounded-lg
                                                   border border-red-200
                                                   bg-red-50 text-red-600
                                                   transition
                                                   hover:bg-red-600
                                                   hover:text-white
                                                   focus:outline-none
                                                   focus:ring-4
                                                   focus:ring-red-500/20
                                                   dark:border-red-900/40
                                                   dark:bg-red-950/20
                                                   dark:text-red-400
                                                   dark:hover:bg-red-600
                                                   dark:hover:text-white">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.8">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 7h12M9 7V4h6v3m-8 0l.75 13h8.5L17 7M10 11v6m4-6v6" />

                                                </svg>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                            @empty

                                {{-- Empty State --}}
                                <tr>

                                    <td colspan="6" class="px-6 py-20">

                                        <div class="flex flex-col items-center justify-center text-center">

                                            <div
                                                class="flex h-20 w-20 items-center justify-center
                                               rounded-3xl bg-orange-50
                                               text-orange-500
                                               dark:bg-orange-500/10
                                               dark:text-orange-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 16.5l4.5-4.5 3 3 4.5-5.25L21 15" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 19.5h15A1.5 1.5 0 0021 18V6a1.5 1.5 0 00-1.5-1.5h-15A1.5 1.5 0 003 6v12a1.5 1.5 0 001.5 1.5z" />

                                                </svg>

                                            </div>

                                            <h3
                                                class="mt-5 text-xl font-black
                                               text-slate-900 dark:text-white">

                                                No listings found

                                            </h3>

                                            <p
                                                class="mt-2 max-w-md text-sm
                                               text-slate-500
                                               dark:text-slate-400">

                                                @if (request()->hasAny(['search', 'status', 'active', 'featured']))
                                                    No listings match your current filters.
                                                    Try changing your search or filters.
                                                @else
                                                    There are no listings available yet.
                                                    Create your first listing to get started.
                                                @endif

                                            </p>

                                            @if (request()->hasAny(['search', 'status', 'active', 'featured']))
                                                <a href="{{ route('listings.index') }}"
                                                    class="mt-5 inline-flex items-center
                                                   rounded-xl bg-orange-600
                                                   px-5 py-3
                                                   text-sm font-bold text-white
                                                   transition hover:bg-orange-700">

                                                    Clear Filters

                                                </a>
                                            @else
                                                <a href="{{ route('admin.create') }}"
                                                    class="mt-5 inline-flex items-center gap-2
                                                   rounded-xl bg-orange-600
                                                   px-5 py-3
                                                   text-sm font-bold text-white
                                                   transition hover:bg-orange-700">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 9v6m3-3H9" />

                                                    </svg>

                                                    Add Listing

                                                </a>
                                            @endif

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- ================================================= --}}
                {{-- PAGINATION --}}
                {{-- ================================================= --}}

                @if ($listings->hasPages())
                    <div
                        class="border-t border-slate-100
                       px-6 py-5
                       dark:border-slate-800">

                        {{ $listings->appends(request()->query())->links() }}

                    </div>
                @endif

            </div>

        </div>

    </x-admin>
