<x-admin>
    {{-- ========================================================= --}}
    {{-- PERMISSIONS PAGE --}}
    {{-- ========================================================= --}}

    <div class="space-y-6">

        {{-- ===================================================== --}}
        {{-- PAGE HEADER --}}
        {{-- ===================================================== --}}

        <div
            class="relative overflow-hidden rounded-3xl
               border border-red-100
               bg-gradient-to-br from-white via-red-50/40 to-rose-50
               p-6 shadow-xl shadow-red-100/40
               dark:border-slate-800
               dark:from-slate-900 dark:via-slate-900 dark:to-red-950/20
               dark:shadow-none sm:p-8">

            {{-- Decorative Glow --}}
            <div class="absolute -right-20 -top-20 h-56 w-56 rounded-full
                   bg-red-500/10 blur-3xl">
            </div>

            <div class="absolute -bottom-24 -left-20 h-56 w-56 rounded-full
                   bg-rose-500/10 blur-3xl">
            </div>

            <div class="relative">

                <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                    {{-- Title --}}
                    <div>

                        <div class="mb-3 flex items-center gap-3">

                            <div
                                class="flex h-11 w-11 items-center justify-center
                                   rounded-2xl bg-red-600 text-white
                                   shadow-lg shadow-red-200
                                   dark:shadow-red-950/40">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 12a7.5 7.5 0 01-.21 1.77l2.02 1.57-2.25 3.9-2.39-.96a7.54 7.54 0 01-3.06 1.77L13.3 22.5h-4.5l-.32-2.45a7.54 7.54 0 01-3.06-1.77l-2.39.96-2.25-3.9 2.02-1.57A7.5 7.5 0 012.6 12c0-.61.07-1.2.21-1.77L.79 8.66l2.25-3.9 2.39.96A7.54 7.54 0 018.49 3.95L8.8 1.5h4.5l.32 2.45a7.54 7.54 0 013.06 1.77l2.39-.96 2.25 3.9-2.02 1.57c.14.57.21 1.16.21 1.77z" />

                                </svg>

                            </div>

                            <span
                                class="text-xs font-bold uppercase tracking-[0.2em]
                                   text-red-600 dark:text-red-400">

                                Access Control

                            </span>

                        </div>

                        <h1
                            class="text-3xl font-black tracking-tight
                               text-slate-900 dark:text-white sm:text-4xl">

                            Permissions

                        </h1>

                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">

                            Create, manage and control permissions used throughout your platform.

                        </p>

                    </div>


                    {{-- Count + Add --}}
                    <div class="flex flex-col gap-3 sm:items-end">

                        <span
                            class="inline-flex w-fit items-center rounded-full
                               bg-red-100 px-4 py-2
                               text-sm font-bold text-red-700
                               ring-1 ring-inset ring-red-200
                               dark:bg-red-500/10
                               dark:text-red-400
                               dark:ring-red-500/20">

                            {{ $permissionCount }}

                            {{ \Illuminate\Support\Str::plural('Permission', $permissionCount) }}

                        </span>

                        <a href="{{ route('permission.create') }}"
                            class="inline-flex items-center justify-center gap-2
                               rounded-xl bg-red-600 px-5 py-3
                               text-sm font-bold text-white
                               shadow-lg shadow-red-200
                               transition duration-200
                               hover:-translate-y-0.5
                               hover:bg-red-700
                               focus:outline-none
                               focus:ring-4 focus:ring-red-500/20
                               dark:shadow-red-950/30">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />

                            </svg>

                            {{ __('Add Permission') }}

                        </a>

                    </div>

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

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />

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
        {{-- PERMISSION DIRECTORY --}}
        {{-- ===================================================== --}}

        <div
            class="overflow-hidden rounded-3xl
               border border-slate-200
               bg-white
               shadow-xl shadow-slate-200/50
               dark:border-slate-800
               dark:bg-slate-900
               dark:shadow-none">

            {{-- Directory Header --}}
            <div
                class="border-b border-slate-100
                   px-6 py-5
                   dark:border-slate-800">

                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <h2 class="text-lg font-black text-slate-900 dark:text-white">
                            Permission Directory
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Manage all available permissions and access rules.
                        </p>

                    </div>


                    {{-- Search --}}
                    <form method="GET" action="{{ url()->current() }}" class="w-full lg:w-96">

                        <label for="permission-search" class="sr-only">
                            {{ __('Search permissions') }}
                        </label>

                        <div class="relative">

                            <div
                                class="pointer-events-none absolute inset-y-0 left-0
                                   flex items-center pl-4
                                   text-slate-400">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />

                                </svg>

                            </div>

                            <input type="search" name="search" id="permission-search" value="{{ request('search') }}"
                                placeholder="{{ __('Search permissions...') }}"
                                class="w-full rounded-xl
                                   border border-slate-200
                                   bg-slate-50
                                   py-3 pl-11 pr-4
                                   text-sm text-slate-900
                                   outline-none transition
                                   placeholder:text-slate-400
                                   focus:border-red-500
                                   focus:bg-white
                                   focus:ring-4 focus:ring-red-500/10
                                   dark:border-slate-700
                                   dark:bg-slate-800
                                   dark:text-white
                                   dark:placeholder:text-slate-500
                                   dark:focus:border-red-500
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
                                class="px-6 py-4 text-xs font-bold
                                   uppercase tracking-wider
                                   text-slate-500 dark:text-slate-400">

                                #

                            </th>

                            <th
                                class="px-6 py-4 text-xs font-bold
                                   uppercase tracking-wider
                                   text-slate-500 dark:text-slate-400">

                                @include('admin.includes.sort-link', [
                                    'label' => 'Name',
                                    'attribute' => 'name',
                                ])

                            </th>

                            <th
                                class="px-6 py-4 text-right text-xs font-bold
                                   uppercase tracking-wider
                                   text-slate-500 dark:text-slate-400">

                                Actions

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                        @forelse ($permissions as $permission)
                            <tr
                                class="group transition-colors
                                   hover:bg-red-50/40
                                   dark:hover:bg-red-950/10">

                                {{-- ID --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    <span
                                        class="text-sm font-bold
                                           text-slate-400
                                           group-hover:text-red-600
                                           dark:group-hover:text-red-400">

                                        #{{ $permission->id }}

                                    </span>

                                </td>


                                {{-- Permission --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0
                                               items-center justify-center
                                               rounded-xl
                                               bg-red-100
                                               text-red-600
                                               dark:bg-red-500/10
                                               dark:text-red-400">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12l2 2 4-4" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z" />

                                            </svg>

                                        </div>

                                        <div>

                                            <a href="{{ route('permission.show', $permission->id) }}"
                                                class="font-bold text-slate-900
                                                   transition
                                                   hover:text-red-600
                                                   dark:text-white
                                                   dark:hover:text-red-400">

                                                {{ $permission->name }}

                                            </a>

                                            <p class="mt-0.5 text-xs text-slate-400">
                                                Permission #{{ $permission->id }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Actions --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- View --}}
                                        <a href="{{ route('permission.show', $permission->id) }}"
                                            title="{{ __('View permission') }}"
                                            class="inline-flex h-9 w-9 items-center
                                               justify-center rounded-lg
                                               border border-slate-200
                                               bg-white text-slate-500
                                               transition
                                               hover:border-red-200
                                               hover:bg-red-50
                                               hover:text-red-600
                                               dark:border-slate-700
                                               dark:bg-slate-800
                                               dark:text-slate-400
                                               dark:hover:border-red-900
                                               dark:hover:bg-red-950/30
                                               dark:hover:text-red-400">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12z" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                            </svg>

                                        </a>


                                        {{-- Edit --}}
                                        <a href="{{ route('permission.edit', $permission->id) }}"
                                            title="{{ __('Edit permission') }}"
                                            class="inline-flex h-9 w-9 items-center
                                               justify-center rounded-lg
                                               border border-slate-200
                                               bg-white text-slate-500
                                               transition
                                               hover:border-red-200
                                               hover:bg-red-50
                                               hover:text-red-600
                                               dark:border-slate-700
                                               dark:bg-slate-800
                                               dark:text-slate-400
                                               dark:hover:border-red-900
                                               dark:hover:bg-red-950/30
                                               dark:hover:text-red-400">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a2.121 2.121 0 013 3l-9.9 9.9-4.137 1.034 1.034-4.137 8.316-8.109z" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 13.5V19.5A1.5 1.5 0 0118 21H6a1.5 1.5 0 01-1.5-1.5V6A1.5 1.5 0 016 4.5h6" />

                                            </svg>

                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('permission.destroy', $permission->id) }}"
                                            method="POST" class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" title="{{ __('Delete permission') }}"
                                                onclick="return confirm('{{ __('Are you sure you want to delete this permission?') }}')"
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

                                <td colspan="3" class="px-6 py-20">

                                    <div class="flex flex-col items-center justify-center text-center">

                                        <div
                                            class="flex h-20 w-20 items-center
                                               justify-center rounded-3xl
                                               bg-red-50 text-red-500
                                               dark:bg-red-500/10
                                               dark:text-red-400">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12l2 2 4-4" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z" />

                                            </svg>

                                        </div>

                                        <h3
                                            class="mt-5 text-xl font-black
                                               text-slate-900 dark:text-white">

                                            {{ __('No permissions found') }}

                                        </h3>

                                        <p
                                            class="mt-2 max-w-md text-sm
                                               text-slate-500
                                               dark:text-slate-400">

                                            @if (request('search'))
                                                {{ __('No permissions match your search. Try a different keyword.') }}
                                            @else
                                                {{ __('There are no permissions available yet. Create your first permission to get started.') }}
                                            @endif

                                        </p>

                                        @if (request('search'))
                                            <a href="{{ url()->current() }}"
                                                class="mt-5 inline-flex items-center
                                                   rounded-xl bg-red-600
                                                   px-5 py-3 text-sm font-bold
                                                   text-white transition
                                                   hover:bg-red-700">

                                                {{ __('Clear Search') }}

                                            </a>
                                        @else
                                            <a href="{{ route('permission.create') }}"
                                                class="mt-5 inline-flex items-center
                                                   gap-2 rounded-xl bg-red-600
                                                   px-5 py-3 text-sm font-bold
                                                   text-white transition
                                                   hover:bg-red-700">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 9v6m3-3H9" />

                                                </svg>

                                                {{ __('Add Permission') }}

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

            @if ($permissions->hasPages())
                <div
                    class="border-t border-slate-100
                       px-6 py-5
                       dark:border-slate-800">

                    {{ $permissions->appends(request()->query())->links() }}

                </div>
            @endif

        </div>

    </div>
</x-admin>
