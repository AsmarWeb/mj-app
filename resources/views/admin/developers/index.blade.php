<x-admin>
    <div class="min-h-screen bg-slate-100 py-10 dark:bg-slate-950">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-orange-500">
                        Administration
                    </p>

                    <h1 class="mt-1 text-3xl font-bold text-slate-900 dark:text-white">
                        Developer Management
                    </h1>

                    <p class="mt-2 text-slate-500 dark:text-slate-400">
                        Review, approve and manage platform developers.
                    </p>
                </div>

            </div>


            {{-- Success message --}}
            @if (session('success'))
                <div
                    class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">
                    {{ session('success') }}
                </div>
            @endif


            {{-- Statistics --}}
            <div class="mb-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                {{-- Total --}}
                <div
                    class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                Total Developers
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-white">
                                {{ $totalDevelopers }}
                            </p>
                        </div>

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                            👨‍💻
                        </div>

                    </div>

                </div>


                {{-- Pending --}}
                <div
                    class="rounded-3xl border border-orange-200 bg-orange-50 p-6 shadow-sm dark:border-orange-900/40 dark:bg-orange-950/20">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-orange-700 dark:text-orange-400">
                                Pending Applications
                            </p>

                            <p class="mt-2 text-3xl font-bold text-orange-700 dark:text-orange-300">
                                {{ $pendingDevelopers }}
                            </p>
                        </div>

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-600 dark:bg-orange-500/10 dark:text-orange-400">
                            ⏳
                        </div>

                    </div>

                </div>


                {{-- Approved --}}
                <div
                    class="rounded-3xl border border-emerald-200 bg-emerald-50 p-6 shadow-sm dark:border-emerald-900/40 dark:bg-emerald-950/20">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-emerald-700 dark:text-emerald-400">
                                Approved
                            </p>

                            <p class="mt-2 text-3xl font-bold text-emerald-700 dark:text-emerald-300">
                                {{ $approvedDevelopers }}
                            </p>
                        </div>

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                            ✓
                        </div>

                    </div>

                </div>

            </div>


            {{-- Search --}}
            <div
                class="mb-6 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                <form method="GET" class="flex flex-col gap-3 md:flex-row">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search developer, role or email..."
                        class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:ring-orange-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                    <select name="status"
                        class="rounded-xl border-slate-300 bg-white px-4 py-3 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <option value="">All Developers</option>
                        <option value="pending" @selected(request('status') === 'pending')>
                            Pending
                        </option>
                        <option value="approved" @selected(request('status') === 'approved')>
                            Approved
                        </option>
                    </select>

                    <button type="submit"
                        class="rounded-xl bg-slate-900 px-6 py-3 font-semibold text-white transition hover:bg-orange-500 dark:bg-orange-500 dark:hover:bg-orange-600">
                        Search
                    </button>

                </form>

            </div>


            {{-- Developer list --}}
            <div
                class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="border-b border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-950">

                            <tr>

                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Developer
                                </th>

                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Role
                                </th>

                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Status
                                </th>

                                <th
                                    class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                            @forelse($developers as $developer)
                                <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">

                                    {{-- Developer --}}
                                    <td class="whitespace-nowrap px-6 py-5">

                                        <div class="flex items-center gap-4">

                                            <img src="{{ $developer->avatar
                                                ? asset('storage/' . $developer->avatar)
                                                : 'https://ui-avatars.com/api/?name=' . urlencode($developer->name) }}"
                                                class="h-12 w-12 rounded-2xl object-cover" alt="{{ $developer->name }}">

                                            <div>

                                                <p class="font-semibold text-slate-900 dark:text-white">
                                                    {{ $developer->name }}
                                                </p>

                                                <p class="text-sm text-slate-500">
                                                    {{ $developer->user->email ?? 'No email' }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Role --}}
                                    <td class="px-6 py-5 text-sm text-slate-600 dark:text-slate-300">
                                        {{ $developer->role }}
                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-5">

                                        @if ($developer->approved)
                                            <span
                                                class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                                ✓ Approved
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">
                                                ⏳ Pending
                                            </span>
                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td class="px-6 py-5">

                                        <div class="flex justify-end gap-2">

                                            <a href="{{ route('developers.show', $developer) }}"
                                                class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200">
                                                View
                                            </a>

                                            <a href="{{ route('developers.edit', $developer) }}"
                                                class="rounded-lg bg-indigo-100 px-3 py-2 text-sm font-semibold text-indigo-700 hover:bg-indigo-200 dark:bg-indigo-500/10 dark:text-indigo-400">
                                                Edit
                                            </a>


                                            @if (!$developer->approved)
                                                <form method="POST"
                                                    action="{{ route('developers.approve', $developer) }}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit"
                                                        class="rounded-lg bg-emerald-100 px-3 py-2 text-sm font-semibold text-emerald-700 hover:bg-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-400">
                                                        Approve
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST"
                                                    action="{{ route('developers.reject', $developer) }}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit"
                                                        class="rounded-lg bg-orange-100 px-3 py-2 text-sm font-semibold text-orange-700 hover:bg-orange-200 dark:bg-orange-500/10 dark:text-orange-400">
                                                        Hide
                                                    </button>
                                                </form>
                                            @endif


                                            <form method="POST" action="{{ route('developers.destroy', $developer) }}"
                                                onsubmit="return confirm('Delete this developer permanently?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="rounded-lg bg-red-100 px-3 py-2 text-sm font-semibold text-red-700 hover:bg-red-200 dark:bg-red-500/10 dark:text-red-400">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="px-6 py-16 text-center">

                                        <div class="text-4xl">
                                            👨‍💻
                                        </div>

                                        <p class="mt-4 font-semibold text-slate-900 dark:text-white">
                                            No developers found
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Try changing your search or filter.
                                        </p>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                @if ($developers->hasPages())
                    <div class="border-t border-slate-200 px-6 py-4 dark:border-slate-800">
                        {{ $developers->links() }}
                    </div>
                @endif

            </div>

        </div>

    </div>
</x-admin>
