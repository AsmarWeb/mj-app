<x-admin>
    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="relative mb-8 overflow-hidden rounded-[2rem]
           border border-orange-100
           bg-gradient-to-br from-white via-orange-50/50 to-amber-50
           p-6 shadow-xl shadow-orange-100/40
           dark:border-slate-800
           dark:from-slate-900 dark:via-slate-900 dark:to-orange-950/20
           dark:shadow-none sm:p-8">

        {{-- Decorative glow --}}
        <div class="absolute -right-20 -top-20 h-56 w-56 rounded-full
               bg-orange-400/10 blur-3xl">
        </div>

        <div class="absolute -bottom-24 -left-20 h-56 w-56 rounded-full
               bg-amber-400/10 blur-3xl">
        </div>

        <div class="relative">

            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                {{-- Title --}}
                <div>

                    <div class="mb-3 flex items-center gap-3">

                        <span
                            class="inline-flex h-11 w-11 items-center justify-center
                               rounded-2xl bg-orange-500
                               text-white shadow-lg shadow-orange-200
                               dark:shadow-orange-950/40">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />

                                <circle cx="9" cy="7" r="4" />

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />

                            </svg>

                        </span>

                        <span
                            class="text-xs font-bold uppercase tracking-[0.2em]
                               text-orange-600 dark:text-orange-400">

                            User Management

                        </span>

                    </div>

                    <h1
                        class="text-3xl font-black tracking-tight
                           text-slate-900 dark:text-white sm:text-4xl">

                        All Users

                    </h1>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">

                        Manage accounts, permissions and user activity across your marketplace.

                    </p>

                </div>


                {{-- Count + Add User --}}
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                    <span
                        class="inline-flex items-center justify-center rounded-full
                           bg-orange-100 px-4 py-2 text-sm font-bold
                           text-orange-700 ring-1 ring-inset ring-orange-200
                           dark:bg-orange-500/10
                           dark:text-orange-400
                           dark:ring-orange-500/20">

                        {{ $users->total() }}
                        {{ Str::plural('User', $users->total()) }}

                    </span>

                    <a href="{{ route('user.create') }}"
                        class="inline-flex items-center justify-center gap-2
                           rounded-xl bg-orange-600 px-5 py-3
                           text-sm font-bold text-white
                           shadow-lg shadow-orange-200
                           transition duration-200
                           hover:-translate-y-0.5 hover:bg-orange-700
                           dark:shadow-orange-950/30">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />

                        </svg>

                        {{ __('Add User') }}

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- FLASH MESSAGE --}}
    {{-- ========================================================= --}}

    @if (session()->has('message'))
        <div
            class="mb-6 flex items-start gap-3 rounded-2xl
               border border-emerald-200
               bg-emerald-50 p-5
               text-emerald-800
               shadow-sm
               dark:border-emerald-900/50
               dark:bg-emerald-950/30
               dark:text-emerald-300">

            <div
                class="flex h-9 w-9 shrink-0 items-center justify-center
                   rounded-full bg-emerald-500 text-white">

                ✓

            </div>

            <div>

                <p class="font-bold">
                    Success
                </p>

                <p class="mt-1 text-sm">
                    {{ session('message') }}
                </p>

            </div>

        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- USERS DIRECTORY --}}
    {{-- ========================================================= --}}

    <div
        class="overflow-hidden rounded-[1.5rem]
           border border-slate-200
           bg-white shadow-xl shadow-slate-200/50
           dark:border-slate-800
           dark:bg-slate-900
           dark:shadow-none">

        {{-- ===================================================== --}}
        {{-- TABLE HEADER / SEARCH --}}
        {{-- ===================================================== --}}

        <div class="border-b border-slate-100 px-6 py-5
               dark:border-slate-800 sm:px-7">

            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                {{-- Heading --}}
                <div>

                    <h2 class="text-lg font-black text-slate-900 dark:text-white">

                        User Directory

                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">

                        @if (request('search'))
                            Search results for

                            <span class="font-semibold text-orange-600 dark:text-orange-400">
                                "{{ request('search') }}"
                            </span>
                        @else
                            Manage all registered marketplace users.
                        @endif

                    </p>

                </div>


                {{-- Search --}}
                <form method="GET" action="{{ url()->current() }}" class="w-full lg:w-[360px]">

                    <label for="table-search" class="sr-only">
                        {{ __('Search users') }}
                    </label>

                    <div class="relative">

                        {{-- Search Icon --}}
                        <div
                            class="pointer-events-none absolute inset-y-0 left-0
                               flex items-center pl-4 text-slate-400">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />

                            </svg>

                        </div>


                        <input type="search" name="search" id="table-search" value="{{ request('search') }}"
                            placeholder="{{ __('Search by name or email...') }}"
                            class="w-full rounded-xl border border-slate-200
                               bg-slate-50 py-3 pl-11 pr-24
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
                               dark:focus:border-orange-500
                               dark:focus:bg-slate-800">


                        {{-- Search Button --}}
                        <button type="submit"
                            class="absolute right-1.5 top-1/2
                               -translate-y-1/2
                               rounded-lg bg-orange-600
                               px-3 py-1.5 text-xs font-bold text-white
                               transition hover:bg-orange-700">

                            Search

                        </button>

                    </div>

                </form>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- TABLE --}}
        {{-- ===================================================== --}}

        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px] text-left">

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
                            @include('admin.includes.sort-link', [
                                'label' => 'Name',
                                'attribute' => 'name',
                            ])
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            @include('admin.includes.sort-link', [
                                'label' => 'Email',
                                'attribute' => 'email',
                            ])
                        </th>

                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                    @forelse ($users as $user)
                        <tr
                            class="group transition-colors
                               hover:bg-orange-50/40
                               dark:hover:bg-orange-950/10">

                            {{-- ID --}}
                            <td class="whitespace-nowrap px-6 py-5">

                                <span
                                    class="text-sm font-bold text-slate-400
                                       transition group-hover:text-orange-600
                                       dark:group-hover:text-orange-400">

                                    #{{ $user->id }}

                                </span>

                            </td>


                            {{-- NAME --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    {{-- Avatar --}}
                                    <div
                                        class="flex h-11 w-11 shrink-0 items-center
                                           justify-center rounded-full
                                           bg-gradient-to-br
                                           from-orange-400 to-amber-500
                                           text-sm font-black text-white
                                           shadow-sm">

                                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}

                                    </div>


                                    <div class="min-w-0">

                                        <a href="{{ route('user.show', $user->id) }}"
                                            class="block truncate font-bold
                                               text-slate-900 transition
                                               hover:text-orange-600
                                               dark:text-white
                                               dark:hover:text-orange-400">

                                            {{ $user->name }}

                                        </a>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            User #{{ $user->id }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- EMAIL --}}
                            <td class="px-6 py-5">

                                <span
                                    class="text-sm font-medium
                                       text-slate-600
                                       dark:text-slate-300">

                                    {{ $user->email }}

                                </span>

                            </td>


                            {{-- STATUS --}}
                            <td class="whitespace-nowrap px-6 py-5">

                                @if (isset($user->is_banned) && $user->is_banned)
                                    <span
                                        class="inline-flex items-center gap-2
                                           rounded-full
                                           bg-red-50 px-3 py-1.5
                                           text-xs font-bold text-red-700
                                           ring-1 ring-inset ring-red-200
                                           dark:bg-red-500/10
                                           dark:text-red-400
                                           dark:ring-red-500/20">

                                        <span class="h-2 w-2 rounded-full bg-red-500"></span>

                                        Banned

                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-2
                                           rounded-full
                                           bg-emerald-50 px-3 py-1.5
                                           text-xs font-bold text-emerald-700
                                           ring-1 ring-inset ring-emerald-200
                                           dark:bg-emerald-500/10
                                           dark:text-emerald-400
                                           dark:ring-emerald-500/20">

                                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                                        Active

                                    </span>
                                @endif

                            </td>


                            {{-- ACTIONS --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- View --}}
                                    <a href="{{ route('user.show', $user->id) }}" title="{{ __('View user') }}"
                                        class="inline-flex h-9 w-9 items-center justify-center
                                           rounded-lg border border-slate-200
                                           bg-white text-slate-500
                                           transition
                                           hover:border-orange-200
                                           hover:bg-orange-50
                                           hover:text-orange-600
                                           dark:border-slate-700
                                           dark:bg-slate-800
                                           dark:text-slate-400
                                           dark:hover:border-orange-900
                                           dark:hover:bg-orange-950/30
                                           dark:hover:text-orange-400">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.8" stroke="currentColor" class="h-4 w-4">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12z" />

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                        </svg>

                                    </a>


                                    {{-- Edit --}}
                                    <a href="{{ route('user.edit', $user->id) }}" title="{{ __('Edit user') }}"
                                        class="inline-flex h-9 w-9 items-center justify-center
                                           rounded-lg border border-slate-200
                                           bg-white text-slate-500
                                           transition
                                           hover:border-indigo-200
                                           hover:bg-indigo-50
                                           hover:text-indigo-600
                                           dark:border-slate-700
                                           dark:bg-slate-800
                                           dark:text-slate-400
                                           dark:hover:bg-indigo-950/30
                                           dark:hover:text-indigo-400">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.8" stroke="currentColor" class="h-4 w-4">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a2.121 2.121 0 013 3l-9.9 9.9-4.137 1.034 1.034-4.137 8.316-8.109z" />

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 13.5V19.5A1.5 1.5 0 0118 21H6a1.5 1.5 0 01-1.5-1.5V6A1.5 1.5 0 016 4.5h6" />

                                        </svg>

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                        class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" title="{{ __('Delete user') }}"
                                            onclick="return confirm('{{ __('Are you sure you want to delete this user?') }}')"
                                            class="inline-flex h-9 w-9 items-center justify-center
                                               rounded-lg border
                                               border-red-200
                                               bg-red-50
                                               text-red-500
                                               transition
                                               hover:bg-red-600
                                               hover:text-white
                                               dark:border-red-900/40
                                               dark:bg-red-950/20
                                               dark:text-red-400
                                               dark:hover:bg-red-600
                                               dark:hover:text-white">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                class="h-4 w-4">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 7h12M9 7V4h6v3m-8 0l.75 13h8.5L17 7M10 11v6m4-6v6" />

                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        {{-- EMPTY STATE --}}
                        <tr>

                            <td colspan="5" class="px-6 py-20">

                                <div class="flex flex-col items-center justify-center text-center">

                                    <div
                                        class="flex h-20 w-20 items-center justify-center
                                           rounded-3xl
                                           bg-orange-50
                                           text-orange-500
                                           dark:bg-orange-500/10
                                           dark:text-orange-400">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />

                                        </svg>

                                    </div>


                                    <h3
                                        class="mt-5 text-xl font-black
                                           text-slate-900
                                           dark:text-white">

                                        {{ __('No users found') }}

                                    </h3>


                                    <p
                                        class="mt-2 max-w-md text-sm
                                           text-slate-500
                                           dark:text-slate-400">

                                        @if (request('search'))
                                            No users match your search.
                                            Try a different name or email.
                                        @else
                                            There are no users registered yet.
                                        @endif

                                    </p>


                                    @if (request('search'))
                                        <a href="{{ url()->current() }}"
                                            class="mt-5 rounded-xl
                                               bg-orange-600 px-5 py-3
                                               text-sm font-bold text-white
                                               transition hover:bg-orange-700">

                                            Clear Search

                                        </a>
                                    @endif

                                </div>

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- ===================================================== --}}
        {{-- PAGINATION --}}
        {{-- ===================================================== --}}

        @if ($users->hasPages())
            <div class="border-t border-slate-100 px-6 py-5
                   dark:border-slate-800">

                {{ $users->appends(request()->query())->links() }}

            </div>
        @endif

    </div>
</x-admin>
