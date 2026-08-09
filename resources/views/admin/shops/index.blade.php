<x-admin>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        {{-- ========================================================= --}}
        {{-- PAGE HEADER --}}
        {{-- ========================================================= --}}

        <div
            class="relative mb-8 overflow-hidden rounded-[2rem]
               border border-orange-100
               bg-gradient-to-br from-white via-orange-50/60 to-amber-50
               p-6 shadow-xl shadow-orange-100/40
               dark:border-slate-800
               dark:from-slate-950 dark:via-slate-900 dark:to-orange-950/20
               dark:shadow-none sm:p-8">

            {{-- Decorative glow --}}
            <div
                class="pointer-events-none absolute -right-20 -top-20 h-64 w-64
                   rounded-full bg-orange-400/10 blur-3xl">
            </div>

            <div
                class="pointer-events-none absolute -bottom-24 -left-20 h-64 w-64
                   rounded-full bg-amber-400/10 blur-3xl">
            </div>

            <div class="relative">

                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <div class="mb-3 flex items-center gap-3">

                            <span
                                class="inline-flex h-11 w-11 items-center justify-center
                                   rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500
                                   text-xl text-white shadow-lg shadow-orange-200
                                   dark:shadow-orange-950/40">
                                🏪
                            </span>

                            <span
                                class="text-xs font-bold uppercase tracking-[0.2em]
                                   text-orange-600 dark:text-orange-400">
                                Marketplace Management
                            </span>

                        </div>

                        <h1
                            class="text-3xl font-black tracking-tight
                               text-slate-900 dark:text-white sm:text-4xl">
                            All Shops
                        </h1>

                        <p
                            class="mt-2 max-w-2xl text-sm leading-6
                               text-slate-500 dark:text-slate-400">
                            Manage, verify, edit and monitor every shop on your marketplace.
                        </p>

                    </div>

                    {{-- Shop Count + Add --}}
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                        <span
                            class="inline-flex items-center justify-center rounded-full
                               border border-orange-200 bg-orange-50 px-4 py-2
                               text-sm font-bold text-orange-700
                               dark:border-orange-500/20
                               dark:bg-orange-500/10 dark:text-orange-400">

                            {{ $shopCount }}
                            {{ Str::plural('Shop', $shopCount) }}

                        </span>

                        <a href="{{ route('shops.create') }}"
                            class="inline-flex items-center justify-center gap-2
                               rounded-xl bg-gradient-to-r from-orange-600 to-amber-500
                               px-5 py-3 text-sm font-bold text-white
                               shadow-lg shadow-orange-200
                               transition duration-200
                               hover:-translate-y-0.5 hover:from-orange-700 hover:to-amber-600
                               dark:shadow-orange-950/30">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            Add Shop

                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- FLASH MESSAGE --}}
        {{-- ========================================================= --}}

        @if (session('message'))
            <div
                class="mb-6 flex items-start gap-3 rounded-2xl
                   border border-emerald-200 bg-emerald-50 p-5
                   text-emerald-800 shadow-sm
                   dark:border-emerald-900/50
                   dark:bg-emerald-950/30 dark:text-emerald-300">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center
                       rounded-full bg-emerald-500 font-bold text-white">
                    ✓
                </div>

                <div>
                    <p class="font-bold">Success</p>

                    <p class="mt-1 text-sm">
                        {{ session('message') }}
                    </p>
                </div>

            </div>
        @endif


        {{-- ========================================================= --}}
        {{-- SEARCH / FILTERS --}}
        {{-- ========================================================= --}}

        <div
            class="mb-6 rounded-[1.5rem]
               border border-slate-200 bg-white p-5 shadow-sm
               dark:border-slate-800 dark:bg-slate-900 sm:p-6">

            <form method="GET" action="{{ url()->current() }}">

                <div class="grid grid-cols-1 gap-4 lg:grid-cols-[1fr_220px_auto]">

                    {{-- Search --}}
                    <div>

                        <label for="shop-search"
                            class="mb-2 block text-xs font-bold uppercase tracking-wider
                               text-slate-500 dark:text-slate-400">
                            Search Shops
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

                            <input type="search" name="search" id="shop-search" value="{{ request('search') }}"
                                placeholder="Shop, owner, slug or location..." autocomplete="off"
                                class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 py-3 pl-11 pr-4
                                   text-sm text-slate-900 outline-none transition
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


                    {{-- Verification --}}
                    <div>

                        <label for="verified"
                            class="mb-2 block text-xs font-bold uppercase tracking-wider
                               text-slate-500 dark:text-slate-400">
                            Verification
                        </label>

                        <select name="verified" id="verified"
                            class="w-full rounded-xl border border-slate-200
                               bg-slate-50 px-4 py-3
                               text-sm font-medium text-slate-700 outline-none transition
                               focus:border-orange-500
                               focus:bg-white
                               focus:ring-4 focus:ring-orange-500/10
                               dark:border-slate-700
                               dark:bg-slate-800 dark:text-slate-200
                               dark:focus:border-orange-500">

                            <option value="">All Shops</option>

                            <option value="1" @selected(request('verified') === '1')>
                                Verified
                            </option>

                            <option value="0" @selected(request('verified') === '0')>
                                Not Verified
                            </option>

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="flex items-end gap-2">

                        <button type="submit"
                            class="inline-flex h-[46px] flex-1 items-center justify-center
                               gap-2 rounded-xl
                               bg-gradient-to-r from-orange-600 to-amber-500
                               px-6 text-sm font-bold text-white
                               shadow-lg shadow-orange-200 transition
                               hover:from-orange-700 hover:to-amber-600
                               dark:shadow-orange-950/30">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                            </svg>

                            Search

                        </button>

                        @if (request()->filled('search') || request()->filled('verified'))
                            <a href="{{ url()->current() }}"
                                class="inline-flex h-[46px] items-center justify-center
                                   rounded-xl border border-slate-200 bg-white px-4
                                   text-sm font-semibold text-slate-600 transition
                                   hover:bg-slate-50
                                   dark:border-slate-700
                                   dark:bg-slate-800 dark:text-slate-300
                                   dark:hover:bg-slate-700">

                                Clear

                            </a>
                        @endif

                    </div>

                </div>

            </form>

        </div>


        {{-- ========================================================= --}}
        {{-- SHOP DIRECTORY --}}
        {{-- ========================================================= --}}

        <div
            class="overflow-hidden rounded-[1.5rem]
               border border-slate-200 bg-white
               shadow-xl shadow-slate-200/50
               dark:border-slate-800 dark:bg-slate-900
               dark:shadow-none">

            {{-- Header --}}
            <div
                class="flex flex-col gap-3 border-b border-slate-100
                   px-6 py-5 sm:flex-row sm:items-center sm:justify-between
                   dark:border-slate-800">

                <div>

                    <h2 class="text-lg font-black text-slate-900 dark:text-white">
                        Shop Directory
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">

                        @if (request('search'))
                            Results for
                            <span class="font-semibold text-orange-600 dark:text-orange-400">
                                "{{ request('search') }}"
                            </span>
                        @elseif (request('verified') === '1')
                            Showing verified shops
                        @elseif (request('verified') === '0')
                            Showing unverified shops
                        @else
                            All registered shops
                        @endif

                    </p>

                </div>

                <div class="text-sm text-slate-500 dark:text-slate-400">

                    Showing

                    <span class="font-bold text-slate-900 dark:text-white">
                        {{ $shops->firstItem() ?? 0 }}
                    </span>

                    –

                    <span class="font-bold text-slate-900 dark:text-white">
                        {{ $shops->lastItem() ?? 0 }}
                    </span>

                    of

                    <span class="font-bold text-slate-900 dark:text-white">
                        {{ $shops->total() }}
                    </span>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- TABLE --}}
            {{-- ===================================================== --}}

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1250px] text-left">

                    <thead
                        class="border-b border-slate-200 bg-slate-50
                           dark:border-slate-800 dark:bg-slate-950/60">

                        <tr>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                #
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Owner
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Shop
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Slug
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Location
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Logo
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Status
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Published
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                        @forelse ($shops as $shop)
                            <tr
                                class="group transition-colors
                                   hover:bg-orange-50/40
                                   dark:hover:bg-orange-950/10">

                                {{-- ID --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    <span
                                        class="text-sm font-bold text-slate-400
                                           transition group-hover:text-orange-600">
                                        #{{ $shop->id }}
                                    </span>

                                </td>


                                {{-- OWNER --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center
                                               rounded-full bg-gradient-to-br
                                               from-orange-400 to-amber-500
                                               text-sm font-black text-white shadow-sm">

                                            {{ strtoupper(substr($shop->user?->name ?? 'U', 0, 1)) }}

                                        </div>

                                        <div class="min-w-0">

                                            <p class="truncate font-semibold text-slate-900 dark:text-white">
                                                {{ $shop->user?->name ?? 'Unknown User' }}
                                            </p>

                                            @if ($shop->user?->email)
                                                <p class="truncate text-xs text-slate-400">
                                                    {{ $shop->user->email }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- SHOP --}}
                                <td class="px-6 py-5">

                                    <a href="{{ route('shops.show', $shop->id) }}"
                                        class="font-bold text-slate-900 transition
                                           hover:text-orange-600
                                           dark:text-white
                                           dark:hover:text-orange-400">

                                        {{ $shop->name }}

                                    </a>

                                </td>


                                {{-- SLUG --}}
                                <td class="px-6 py-5">

                                    <span
                                        class="inline-flex rounded-lg bg-slate-100 px-3 py-1.5
                                           font-mono text-xs font-medium text-slate-600
                                           dark:bg-slate-800 dark:text-slate-300">

                                        /{{ $shop->slug }}

                                    </span>

                                </td>


                                {{-- LOCATION --}}
                                <td class="px-6 py-5">

                                    <div
                                        class="flex max-w-[180px] items-center gap-2
                                           text-sm text-slate-600 dark:text-slate-300">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 shrink-0 text-orange-500" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17.657 16.657L13.414 21.9a2 2 0 01-2.828 0l-4.243-5.243a8 8 0 1111.314 0z" />

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                                        </svg>

                                        <span class="truncate">
                                            {{ $shop->location ?: 'Not specified' }}
                                        </span>

                                    </div>

                                </td>


                                {{-- LOGO --}}
                                <td class="px-6 py-5">

                                    <div
                                        class="h-12 w-12 overflow-hidden rounded-xl
                                           border border-slate-200 bg-slate-100
                                           shadow-sm
                                           dark:border-slate-700 dark:bg-slate-800">

                                        @if ($shop->logo)
                                            <img src="{{ Storage::disk('public')->url($shop->logo) }}"
                                                alt="{{ $shop->name }}" class="h-full w-full object-cover">
                                        @else
                                            <div
                                                class="flex h-full w-full items-center justify-center
                                                   bg-gradient-to-br from-orange-400 to-amber-500
                                                   text-lg font-black text-white">

                                                {{ strtoupper(substr($shop->name ?? 'S', 0, 1)) }}

                                            </div>
                                        @endif

                                    </div>

                                </td>


                                {{-- VERIFICATION --}}
                                <td class="px-6 py-5">

                                    @if ($shop->verified)
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full
                                               bg-orange-50 px-3 py-1.5
                                               text-xs font-bold text-orange-700
                                               ring-1 ring-inset ring-orange-200
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

                                            Verified

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full
                                               bg-slate-100 px-3 py-1.5
                                               text-xs font-semibold text-slate-500
                                               ring-1 ring-inset ring-slate-200
                                               dark:bg-slate-800
                                               dark:text-slate-400
                                               dark:ring-slate-700">

                                            <span class="h-2 w-2 rounded-full bg-slate-400"></span>

                                            Not Verified

                                        </span>
                                    @endif

                                </td>


                                {{-- PUBLISHED --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    @if ($shop->published_at)
                                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">
                                            {{ $shop->published_at->format('M d, Y') }}
                                        </p>

                                        <p class="text-xs text-slate-400">
                                            {{ $shop->published_at->diffForHumans() }}
                                        </p>
                                    @else
                                        <span
                                            class="inline-flex rounded-full bg-slate-100 px-3 py-1
                                               text-xs font-semibold text-slate-500
                                               dark:bg-slate-800 dark:text-slate-400">
                                            Not published
                                        </span>
                                    @endif

                                </td>


                                {{-- ACTIONS --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- View --}}
                                        <a href="{{ route('shops.show', $shop->id) }}"
                                            class="inline-flex items-center justify-center
                                               rounded-lg border border-slate-200
                                               bg-white px-3 py-2
                                               text-xs font-bold text-slate-600
                                               transition
                                               hover:border-orange-200
                                               hover:bg-orange-50
                                               hover:text-orange-600
                                               dark:border-slate-700
                                               dark:bg-slate-800
                                               dark:text-slate-300
                                               dark:hover:bg-orange-950/30
                                               dark:hover:text-orange-400">
                                            View
                                        </a>


                                        {{-- Edit --}}
                                        <a href="{{ route('shops.edit', $shop->id) }}"
                                            class="inline-flex items-center justify-center
                                               rounded-lg border border-slate-200
                                               bg-white px-3 py-2
                                               text-xs font-bold text-slate-600
                                               transition
                                               hover:border-orange-200
                                               hover:bg-orange-50
                                               hover:text-orange-600
                                               dark:border-slate-700
                                               dark:bg-slate-800
                                               dark:text-slate-300
                                               dark:hover:bg-orange-950/30
                                               dark:hover:text-orange-400">
                                            Edit
                                        </a>


                                        {{-- Verify / Unverify --}}
                                        @if ($shop->verified)
                                            <form action="{{ route('admin.shops.unverify', $shop) }}" method="POST">
                                                @csrf

                                                <button type="submit"
                                                    onclick="return confirm('Remove verification from {{ addslashes($shop->name) }}?')"
                                                    class="inline-flex items-center justify-center
                                                       rounded-lg bg-slate-900 px-3 py-2
                                                       text-xs font-bold text-white transition
                                                       hover:bg-red-600
                                                       dark:bg-slate-700
                                                       dark:hover:bg-red-600">
                                                    Unverify
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.shops.verify', $shop) }}" method="POST">
                                                @csrf

                                                <button type="submit"
                                                    class="inline-flex items-center justify-center
                                                       rounded-lg bg-orange-600 px-3 py-2
                                                       text-xs font-bold text-white
                                                       shadow-sm transition
                                                       hover:bg-orange-700">
                                                    Verify
                                                </button>
                                            </form>
                                        @endif


                                        {{-- Delete --}}
                                        <form action="{{ route('shops.destroy', $shop->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete {{ addslashes($shop->name) }}?')"
                                                class="inline-flex items-center justify-center
                                                   rounded-lg border border-red-200
                                                   bg-red-50 px-3 py-2
                                                   text-xs font-bold text-red-600
                                                   transition
                                                   hover:bg-red-600 hover:text-white
                                                   dark:border-red-900/40
                                                   dark:bg-red-950/20
                                                   dark:text-red-400
                                                   dark:hover:bg-red-600
                                                   dark:hover:text-white">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="px-6 py-20">

                                    <div class="flex flex-col items-center justify-center text-center">

                                        <div
                                            class="flex h-20 w-20 items-center justify-center
                                               rounded-3xl bg-orange-50 text-4xl
                                               dark:bg-orange-500/10">
                                            🏪
                                        </div>

                                        <h3
                                            class="mt-5 text-xl font-black
                                               text-slate-900 dark:text-white">
                                            No shops found
                                        </h3>

                                        <p
                                            class="mt-2 max-w-md text-sm
                                               text-slate-500 dark:text-slate-400">

                                            @if (request('search'))
                                                No shops match
                                                <strong>"{{ request('search') }}"</strong>.
                                                Try another search.
                                            @elseif (request('verified') === '1')
                                                There are no verified shops.
                                            @elseif (request('verified') === '0')
                                                There are no unverified shops.
                                            @else
                                                There are no shops registered on the marketplace yet.
                                            @endif

                                        </p>

                                        @if (request('search') || request('verified') !== null)
                                            <a href="{{ url()->current() }}"
                                                class="mt-5 rounded-xl
                                                   bg-orange-600 px-5 py-3
                                                   text-sm font-bold text-white
                                                   transition hover:bg-orange-700">
                                                Clear Filters
                                            </a>
                                        @endif

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ========================================================= --}}
            {{-- PAGINATION --}}
            {{-- ========================================================= --}}

            @if ($shops->hasPages())
                <div class="border-t border-slate-100 px-6 py-5
                       dark:border-slate-800">

                    {{ $shops->withQueryString()->links() }}

                </div>
            @endif

        </div>

    </div>
</x-admin>
