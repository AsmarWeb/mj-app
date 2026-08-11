<x-admin>
    <div class="min-h-screen bg-slate-100 py-10 dark:bg-slate-950">

        <div class="mx-auto max-w-4xl px-4">

            <div class="mb-6">

                <a href="{{ route('developers.index') }}" class="text-sm font-semibold text-orange-500">
                    ← Developer Management
                </a>

            </div>


            <div
                class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl dark:border-slate-800 dark:bg-slate-900">

                {{-- Header --}}
                <div class="h-36 bg-gradient-to-r from-orange-500 via-amber-500 to-orange-600"></div>


                <div class="px-6 pb-8 sm:px-10">

                    <div class="-mt-16 flex flex-col gap-5 sm:flex-row sm:items-end">

                        <img src="{{ $developer->avatar
                            ? asset('storage/' . $developer->avatar)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($developer->name) }}"
                            class="h-32 w-32 rounded-3xl border-4 border-white object-cover shadow-xl dark:border-slate-900">

                        <div class="flex-1">

                            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                                {{ $developer->name }}
                            </h1>

                            <p class="mt-1 font-semibold text-orange-500">
                                {{ $developer->role }}
                            </p>

                        </div>

                        @if ($developer->approved)
                            <span
                                class="rounded-full bg-emerald-100 px-4 py-2 text-sm font-bold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                ✓ Approved
                            </span>
                        @else
                            <span
                                class="rounded-full bg-orange-100 px-4 py-2 text-sm font-bold text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">
                                ⏳ Pending
                            </span>
                        @endif

                    </div>


                    {{-- Information --}}
                    <div class="mt-10 grid gap-6 sm:grid-cols-2">

                        <div class="rounded-2xl bg-slate-50 p-5 dark:bg-slate-950">

                            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                                Account
                            </p>

                            <p class="mt-2 font-semibold text-slate-900 dark:text-white">
                                {{ $developer->user->name ?? 'Unknown' }}
                            </p>

                            <p class="text-sm text-slate-500">
                                {{ $developer->user->email ?? 'No email' }}
                            </p>

                        </div>


                        <div class="rounded-2xl bg-slate-50 p-5 dark:bg-slate-950">

                            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                                Joined
                            </p>

                            <p class="mt-2 font-semibold text-slate-900 dark:text-white">
                                {{ $developer->created_at->format('d M Y') }}
                            </p>

                        </div>

                    </div>


                    {{-- Bio --}}
                    <div class="mt-8">

                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                            About Developer
                        </h2>

                        <p class="mt-3 leading-7 text-slate-600 dark:text-slate-300">
                            {{ $developer->bio ?: 'No biography provided.' }}
                        </p>

                    </div>


                    {{-- Social --}}
                    <div class="mt-8 flex flex-wrap gap-3">

                        @if ($developer->github)
                            <a href="{{ $developer->github }}" target="_blank" rel="noopener noreferrer"
                                class="rounded-xl bg-slate-900 px-5 py-3 font-semibold text-white hover:bg-slate-700">
                                GitHub
                            </a>
                        @endif

                        @if ($developer->linkedin)
                            <a href="{{ $developer->linkedin }}" target="_blank" rel="noopener noreferrer"
                                class="rounded-xl bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700">
                                LinkedIn
                            </a>
                        @endif

                        @if ($developer->website)
                            <a href="{{ $developer->website }}" target="_blank" rel="noopener noreferrer"
                                class="rounded-xl bg-orange-500 px-5 py-3 font-semibold text-white hover:bg-orange-600">
                                Website
                            </a>
                        @endif

                    </div>


                    {{-- Actions --}}
                    <div class="mt-10 flex flex-wrap gap-3 border-t border-slate-200 pt-8 dark:border-slate-800">

                        <a href="{{ route('developers.edit', $developer) }}"
                            class="rounded-xl bg-indigo-600 px-6 py-3 font-semibold text-white hover:bg-indigo-700">
                            Edit Developer
                        </a>


                        @if (!$developer->approved)
                            <form method="POST" action="{{ route('developers.approve', $developer) }}">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                    class="rounded-xl bg-emerald-600 px-6 py-3 font-semibold text-white hover:bg-emerald-700">
                                    Approve
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('developers.reject', $developer) }}">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                    class="rounded-xl bg-orange-500 px-6 py-3 font-semibold text-white hover:bg-orange-600">
                                    Hide Profile
                                </button>
                            </form>
                        @endif


                        <form method="POST" action="{{ route('developers.destroy', $developer) }}"
                            onsubmit="return confirm('Are you sure you want to permanently delete this developer?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="rounded-xl bg-red-600 px-6 py-3 font-semibold text-white hover:bg-red-700">
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</x-admin>
