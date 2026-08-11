<x-admin>
    <div class="min-h-screen bg-slate-100 py-10 dark:bg-slate-950">

        <div class="mx-auto max-w-4xl px-4">

            <div class="mb-8">

                <a href="{{ route('developers.index') }}"
                    class="text-sm font-semibold text-orange-500 hover:text-orange-600">
                    ← Back to Developers
                </a>

                <h1 class="mt-3 text-3xl font-bold text-slate-900 dark:text-white">
                    Edit Developer
                </h1>

            </div>


            @if ($errors->any())

                <div class="mb-6 rounded-2xl bg-red-50 p-5 text-red-700 dark:bg-red-950/30 dark:text-red-300">

                    <ul class="list-disc space-y-1 pl-5">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <form method="POST" action="{{ route('developers.update', $developer) }}" enctype="multipart/form-data"
                class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">

                @csrf
                @method('PUT')


                {{-- Avatar --}}
                <div class="mb-8 flex items-center gap-5">

                    <img src="{{ $developer->avatar
                        ? asset('storage/' . $developer->avatar)
                        : 'https://ui-avatars.com/api/?name=' . urlencode($developer->name) }}"
                        class="h-24 w-24 rounded-2xl object-cover">

                    <div class="flex-1">

                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                            Profile Image
                        </label>

                        <input type="file" name="avatar" accept="image/*"
                            class="mt-2 block w-full rounded-xl border border-slate-300 p-3 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                    </div>

                </div>


                {{-- Name --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                        Full Name
                    </label>

                    <input type="text" name="name" value="{{ old('name', $developer->name) }}" required
                        class="mt-2 w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                </div>


                {{-- Role --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                        Developer Role
                    </label>

                    <input type="text" name="role" value="{{ old('role', $developer->role) }}" required
                        class="mt-2 w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                </div>


                {{-- Bio --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                        Biography
                    </label>

                    <textarea name="bio" rows="6"
                        class="mt-2 w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white">{{ old('bio', $developer->bio) }}</textarea>

                </div>


                {{-- Social --}}
                <div class="grid gap-6 md:grid-cols-3">

                    <div>

                        <label class="text-sm font-semibold">
                            GitHub
                        </label>

                        <input type="url" name="github" value="{{ old('github', $developer->github) }}"
                            class="mt-2 w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                    </div>


                    <div>

                        <label class="text-sm font-semibold">
                            LinkedIn
                        </label>

                        <input type="url" name="linkedin" value="{{ old('linkedin', $developer->linkedin) }}"
                            class="mt-2 w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                    </div>


                    <div>

                        <label class="text-sm font-semibold">
                            Website
                        </label>

                        <input type="url" name="website" value="{{ old('website', $developer->website) }}"
                            class="mt-2 w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                    </div>

                </div>


                {{-- Approval --}}
                <div
                    class="mt-8 rounded-2xl border border-slate-200 bg-slate-50 p-5 dark:border-slate-800 dark:bg-slate-950">

                    <label class="flex cursor-pointer items-center gap-3">

                        <input type="checkbox" name="approved" value="1" @checked($developer->approved)
                            class="h-5 w-5 rounded border-slate-300 text-orange-500 focus:ring-orange-500">

                        <div>

                            <p class="font-semibold text-slate-900 dark:text-white">
                                Public Developer Profile
                            </p>

                            <p class="text-sm text-slate-500">
                                Allow this developer to appear publicly.
                            </p>

                        </div>

                    </label>

                </div>


                {{-- Submit --}}
                <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a href="{{ route('developers.index') }}"
                        class="rounded-xl border border-slate-300 px-6 py-3 text-center font-semibold text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300">
                        Cancel
                    </a>

                    <button type="submit"
                        class="rounded-xl bg-orange-500 px-7 py-3 font-semibold text-white shadow-lg shadow-orange-500/20 transition hover:bg-orange-600">
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>
</x-admin>
