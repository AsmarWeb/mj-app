<x-admin>
    {{-- ========================================================= --}}
    {{-- ROLES PAGE --}}
    {{-- ========================================================= --}}

    <div class="space-y-6">

        {{-- ===================================================== --}}
        {{-- PAGE HEADER --}}
        {{-- ===================================================== --}}

        <div
            class="relative overflow-hidden rounded-3xl border border-slate-200
               bg-gradient-to-br from-white via-blue-50/40 to-indigo-50
               p-6 shadow-xl shadow-slate-200/50
               dark:border-slate-800
               dark:from-slate-900 dark:via-slate-900 dark:to-indigo-950/30
               dark:shadow-none sm:p-8">

            {{-- Decorative Background --}}
            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full
                   bg-blue-500/10 blur-3xl">
            </div>

            <div
                class="absolute -bottom-20 -left-16 h-48 w-48 rounded-full
                   bg-indigo-500/10 blur-3xl">
            </div>

            <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                {{-- Title --}}
                <div>

                    <div class="mb-3 flex items-center gap-3">

                        <div
                            class="flex h-11 w-11 items-center justify-center
                               rounded-2xl bg-blue-600 text-white
                               shadow-lg shadow-blue-200
                               dark:shadow-blue-950/40">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="h-6 w-6">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.07a3.001 3.001 0 0 1-1.527 1.527A3.001 3.001 0 0 1 15 18.127a3.001 3.001 0 0 1-1.527 1.527A3.001 3.001 0 0 1 12 21a3.001 3.001 0 0 1-1.473-.346A3.001 3.001 0 0 1 9 19.654a3.001 3.001 0 0 1-1.527-1.527A3.001 3.001 0 0 1 5.946 16.6a3.001 3.001 0 0 1-1.527-1.527A3.001 3.001 0 0 1 3 12c0-1.268.63-2.39 1.593-3.07A3.001 3.001 0 0 1 6.12 7.403 3.001 3.001 0 0 1 7.647 5.876 3.001 3.001 0 0 1 9.174 4.35 3.001 3.001 0 0 1 12 3c1.268 0 2.39.63 3.07 1.593a3.001 3.001 0 0 1 1.527 1.527 3.001 3.001 0 0 1 1.527 1.527A3.001 3.001 0 0 1 19.65 9.18 3.001 3.001 0 0 1 21 12Z" />

                            </svg>

                        </div>

                        <span
                            class="text-xs font-bold uppercase tracking-[0.2em]
                               text-blue-600 dark:text-blue-400">

                            Access Management

                        </span>

                    </div>


                    <h1
                        class="text-3xl font-black tracking-tight
                           text-slate-900 dark:text-white sm:text-4xl">

                        Roles

                    </h1>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">

                        Create, manage and control the roles and permissions
                        available throughout your platform.

                    </p>

                </div>


                {{-- Count + Add --}}
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                    <span
                        class="inline-flex items-center justify-center rounded-full
                           bg-blue-100 px-4 py-2 text-sm font-bold
                           text-blue-700 ring-1 ring-inset ring-blue-200
                           dark:bg-blue-500/10
                           dark:text-blue-400
                           dark:ring-blue-500/20">

                        {{ $roleCount }} {{ Str::plural('Role', $roleCount) }}

                    </span>


                    <a href="{{ route('role.create') }}"
                        class="inline-flex items-center justify-center gap-2
                           rounded-xl bg-blue-600 px-5 py-3
                           text-sm font-bold text-white
                           shadow-lg shadow-blue-200
                           transition duration-200
                           hover:-translate-y-0.5 hover:bg-blue-700
                           focus:outline-none focus:ring-4
                           focus:ring-blue-500/20
                           dark:shadow-blue-950/30">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="h-5 w-5">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />

                        </svg>

                        {{ __('Add Role') }}

                    </a>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- FLASH MESSAGE --}}
        {{-- ===================================================== --}}

        @if (session()->has('message'))
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

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-5 w-5">

                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />

                    </svg>

                </div>

                <div>

                    <p class="font-bold">
                        {{ __('Success') }}
                    </p>

                    <p class="mt-1 text-sm">
                        {{ session('message') }}
                    </p>

                </div>

            </div>
        @endif


        {{-- ===================================================== --}}
        {{-- ROLES TABLE CARD --}}
        {{-- ===================================================== --}}

        <div
            class="overflow-hidden rounded-3xl
               border border-slate-200
               bg-white shadow-xl shadow-slate-200/50
               dark:border-slate-800
               dark:bg-slate-900
               dark:shadow-none">

            {{-- Table Header --}}
            <div
                class="border-b border-slate-100
                   px-6 py-5
                   dark:border-slate-800">

                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <h2 class="text-lg font-black text-slate-900 dark:text-white">
                            {{ __('Role Directory') }}
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            {{ __('Manage roles and their access across the platform.') }}
                        </p>

                    </div>


                    {{-- Search --}}
                    <form method="GET" action="{{ url()->current() }}" class="w-full lg:w-96">

                        <label for="table-search" class="sr-only">
                            {{ __('Search roles') }}
                        </label>

                        <div class="relative">

                            <div
                                class="pointer-events-none absolute inset-y-0 left-0
                                   flex items-center pl-4
                                   text-slate-400">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="h-5 w-5">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />

                                </svg>

                            </div>


                            <input type="search" name="search" id="table-search" value="{{ request('search') }}"
                                placeholder="{{ __('Search by role name...') }}"
                                class="w-full rounded-xl
                                   border border-slate-200
                                   bg-slate-50
                                   py-3 pl-11 pr-4
                                   text-sm text-slate-900
                                   outline-none transition
                                   placeholder:text-slate-400
                                   focus:border-blue-500
                                   focus:bg-white
                                   focus:ring-4 focus:ring-blue-500/10
                                   dark:border-slate-700
                                   dark:bg-slate-800
                                   dark:text-white
                                   dark:placeholder:text-slate-500
                                   dark:focus:border-blue-500
                                   dark:focus:bg-slate-800">

                        </div>

                    </form>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- TABLE --}}
            {{-- ================================================= --}}

            <div class="overflow-x-auto">

                <table class="w-full min-w-[700px] text-left">

                    <thead
                        class="border-b border-slate-200
                           bg-slate-50
                           dark:border-slate-800
                           dark:bg-slate-950/50">

                        <tr>

                            <th
                                class="px-6 py-4 text-xs font-bold uppercase
                                   tracking-wider text-slate-500">

                                #

                            </th>


                            <th
                                class="px-6 py-4 text-xs font-bold uppercase
                                   tracking-wider text-slate-500">

                                @include('admin.includes.sort-link', [
                                    'label' => 'Name',
                                    'attribute' => 'name',
                                ])

                            </th>


                            <th
                                class="px-6 py-4 text-xs font-bold uppercase
                                   tracking-wider text-slate-500">

                                Role ID

                            </th>


                            <th
                                class="px-6 py-4 text-right text-xs font-bold
                                   uppercase tracking-wider text-slate-500">

                                {{ __('Actions') }}

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100
                           dark:divide-slate-800">

                        @forelse ($roles as $role)
                            <tr
                                class="group transition-colors
                                   hover:bg-blue-50/40
                                   dark:hover:bg-blue-950/10">

                                {{-- ID --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    <span
                                        class="text-sm font-bold text-slate-400
                                           group-hover:text-blue-600
                                           dark:group-hover:text-blue-400">

                                        #{{ $role->id }}

                                    </span>

                                </td>


                                {{-- NAME --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0
                                               items-center justify-center
                                               rounded-xl
                                               bg-gradient-to-br
                                               from-blue-500 to-indigo-600
                                               text-sm font-black text-white
                                               shadow-sm">

                                            {{ strtoupper(substr($role->name, 0, 1)) }}

                                        </div>


                                        <div>

                                            <a href="{{ route('role.show', $role->id) }}"
                                                class="font-bold text-slate-900
                                                   transition hover:text-blue-600
                                                   dark:text-white
                                                   dark:hover:text-blue-400">

                                                {{ $role->name }}

                                            </a>

                                            <p class="mt-0.5 text-xs text-slate-400">
                                                {{ __('System role') }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- ROLE ID --}}
                                <td class="px-6 py-5">

                                    <span
                                        class="inline-flex rounded-lg
                                           bg-slate-100 px-3 py-1.5
                                           font-mono text-xs font-semibold
                                           text-slate-600
                                           dark:bg-slate-800
                                           dark:text-slate-300">

                                        ROLE-{{ $role->id }}

                                    </span>

                                </td>


                                {{-- ACTIONS --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- View --}}
                                        <a href="{{ route('role.show', $role->id) }}" title="{{ __('View role') }}"
                                            class="inline-flex h-9 w-9 items-center
                                               justify-center rounded-lg
                                               border border-slate-200
                                               bg-white text-slate-500
                                               transition
                                               hover:border-blue-200
                                               hover:bg-blue-50
                                               hover:text-blue-600
                                               dark:border-slate-700
                                               dark:bg-slate-800
                                               dark:text-slate-400
                                               dark:hover:border-blue-500/30
                                               dark:hover:bg-blue-950/30
                                               dark:hover:text-blue-400">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.8" stroke="currentColor" class="h-4 w-4">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12z" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                            </svg>

                                        </a>


                                        {{-- Edit --}}
                                        <a href="{{ route('role.edit', $role->id) }}" title="{{ __('Edit role') }}"
                                            class="inline-flex h-9 w-9 items-center
                                               justify-center rounded-lg
                                               border border-slate-200
                                               bg-white text-slate-500
                                               transition
                                               hover:border-indigo-200
                                               hover:bg-indigo-50
                                               hover:text-indigo-600
                                               dark:border-slate-700
                                               dark:bg-slate-800
                                               dark:text-slate-400
                                               dark:hover:border-indigo-500/30
                                               dark:hover:bg-indigo-950/30
                                               dark:hover:text-indigo-400">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                class="h-4 w-4">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a2.121 2.121 0 013 3l-9.9 9.9-4.137 1.034 1.034-4.137 8.316-8.109z" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 13.5V19.5A1.5 1.5 0 0118 21H6a1.5 1.5 0 01-1.5-1.5V6A1.5 1.5 0 016 4.5h6" />

                                            </svg>

                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                            class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" title="{{ __('Delete role') }}"
                                                onclick="return confirm('{{ __('Are you sure you want to delete this role?') }}')"
                                                class="inline-flex h-9 w-9 items-center
                                                   justify-center rounded-lg
                                                   border border-red-200
                                                   bg-white text-red-500
                                                   transition
                                                   hover:border-red-300
                                                   hover:bg-red-50
                                                   hover:text-red-700
                                                   focus:outline-none
                                                   focus:ring-4
                                                   focus:ring-red-500/10
                                                   dark:border-red-900/40
                                                   dark:bg-slate-800
                                                   dark:text-red-400
                                                   dark:hover:bg-red-950/30
                                                   dark:hover:text-red-300">

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

                            {{-- Empty State --}}
                            <tr>

                                <td colspan="4" class="px-6 py-20">

                                    <div
                                        class="flex flex-col items-center
                                           justify-center text-center">

                                        <div
                                            class="flex h-20 w-20 items-center
                                               justify-center rounded-3xl
                                               bg-blue-50
                                               text-blue-500
                                               dark:bg-blue-500/10
                                               dark:text-blue-400">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="h-9 w-9">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.07a3.001 3.001 0 0 1-1.527 1.527A3.001 3.001 0 0 1 15 18.127a3.001 3.001 0 0 1-1.527 1.527A3.001 3.001 0 0 1 12 21a3.001 3.001 0 0 1-1.473-.346A3.001 3.001 0 0 1 9 19.654a3.001 3.001 0 0 1-1.527-1.527A3.001 3.001 0 0 1 5.946 16.6a3.001 3.001 0 0 1-1.527-1.527A3.001 3.001 0 0 1 3 12c0-1.268.63-2.39 1.593-3.07A3.001 3.001 0 0 1 6.12 7.403 3.001 3.001 0 0 1 7.647 5.876 3.001 3.001 0 0 1 9.174 4.35 3.001 3.001 0 0 1 12 3c1.268 0 2.39.63 3.07 1.593a3.001 3.001 0 0 1 1.527 1.527 3.001 3.001 0 0 1 1.527 1.527A3.001 3.001 0 0 1 19.65 9.18 3.001 3.001 0 0 1 21 12Z" />

                                            </svg>

                                        </div>


                                        <h3
                                            class="mt-5 text-xl font-black
                                               text-slate-900
                                               dark:text-white">

                                            {{ __('No roles found') }}

                                        </h3>


                                        <p
                                            class="mt-2 max-w-md text-sm
                                               text-slate-500
                                               dark:text-slate-400">

                                            @if (request('search'))
                                                {{ __('No roles match your search. Try a different role name.') }}
                                            @else
                                                {{ __('There are no roles available yet. Create your first role to get started.') }}
                                            @endif

                                        </p>


                                        @if (request('search'))
                                            <a href="{{ url()->current() }}"
                                                class="mt-5 inline-flex items-center
                                                   rounded-xl bg-blue-600
                                                   px-5 py-3 text-sm font-bold
                                                   text-white transition
                                                   hover:bg-blue-700">

                                                {{ __('Clear Search') }}

                                            </a>
                                        @else
                                            <a href="{{ route('role.create') }}"
                                                class="mt-5 inline-flex items-center
                                                   gap-2 rounded-xl bg-blue-600
                                                   px-5 py-3 text-sm font-bold
                                                   text-white transition
                                                   hover:bg-blue-700">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="h-4 w-4">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />

                                                </svg>

                                                {{ __('Add Role') }}

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

            @if ($roles->hasPages())
                <div class="border-t border-slate-100 px-6 py-5
                       dark:border-slate-800">

                    {{ $roles->appends(request()->query())->links() }}

                </div>
            @endif

        </div>

    </div>
</x-admin>
