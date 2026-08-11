<x-app-layout>

    <div
        class="min-h-screen bg-slate-50 text-slate-900 transition-colors duration-300
            dark:bg-slate-950 dark:text-white">

        {{-- Background decoration --}}
        <div class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute -left-40 -top-40 h-96 w-96 rounded-full bg-orange-500/10 blur-3xl"></div>
            <div class="absolute -right-40 top-1/3 h-96 w-96 rounded-full bg-amber-500/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 h-80 w-80 rounded-full bg-orange-400/5 blur-3xl"></div>
        </div>


        <div class="mx-auto max-w-5xl px-5 py-10 sm:px-6 lg:px-8 lg:py-16">

            {{-- Main Card --}}
            <div
                class="overflow-hidden rounded-[2rem] border border-slate-200
                    bg-white shadow-xl shadow-slate-900/5
                    dark:border-slate-800 dark:bg-slate-900
                    dark:shadow-black/20">


                {{-- Header --}}
                <div
                    class="relative overflow-hidden
                        bg-gradient-to-br from-orange-500 via-orange-600 to-amber-500
                        px-6 py-12 sm:px-10 lg:px-12">

                    {{-- Decorative circles --}}
                    <div
                        class="pointer-events-none absolute -right-20 -top-20
                            h-64 w-64 rounded-full bg-white/10 blur-2xl">
                    </div>

                    <div
                        class="pointer-events-none absolute -bottom-24 -left-16
                            h-56 w-56 rounded-full bg-black/10 blur-2xl">
                    </div>


                    <div class="relative">

                        {{-- Badge --}}
                        <div
                            class="inline-flex items-center gap-2 rounded-full
                                border border-white/20 bg-white/10 px-4 py-2
                                text-xs font-bold uppercase tracking-[0.18em]
                                text-white backdrop-blur-sm">

                            <span class="h-2 w-2 rounded-full bg-white"></span>

                            Developer Community

                        </div>


                        <h1
                            class="mt-6 text-3xl font-black tracking-tight text-white
                               sm:text-4xl lg:text-5xl">

                            👨‍💻 Join Our Developer Community

                        </h1>


                        <p class="mt-5 max-w-2xl text-base leading-7 text-orange-50 sm:text-lg">

                            Become part of the people building
                            <strong>{{ config('app.name') }}</strong>.

                            Share your experience, showcase your skills,
                            and help us make the platform even better.

                        </p>


                        {{-- Small highlights --}}
                        <div class="mt-8 flex flex-wrap gap-3">

                            <span
                                class="inline-flex items-center gap-2 rounded-xl
                                     bg-white/10 px-4 py-2 text-sm font-semibold
                                     text-white backdrop-blur-sm">

                                ✓ Build together

                            </span>

                            <span
                                class="inline-flex items-center gap-2 rounded-xl
                                     bg-white/10 px-4 py-2 text-sm font-semibold
                                     text-white backdrop-blur-sm">

                                ✓ Showcase your work

                            </span>

                            <span
                                class="inline-flex items-center gap-2 rounded-xl
                                     bg-white/10 px-4 py-2 text-sm font-semibold
                                     text-white backdrop-blur-sm">

                                ✓ Grow with us

                            </span>

                        </div>

                    </div>

                </div>


                {{-- Validation errors --}}
                @if ($errors->any())

                    <div
                        class="mx-6 mt-6 rounded-2xl border border-red-200
                            bg-red-50 p-5 text-red-700
                            dark:border-red-900/50 dark:bg-red-950/30
                            dark:text-red-400 sm:mx-10 lg:mx-12">

                        <div class="flex gap-3">

                            <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v4m0 4h.01M10.3 3.6L2.1 18a2 2 0 001.7 3h16.4a2 2 0 001.7-3L13.7 3.6a2 2 0 00-3.4 0z" />

                            </svg>

                            <div>

                                <p class="font-bold">
                                    Please check the following:
                                </p>

                                <ul class="mt-2 list-inside list-disc space-y-1 text-sm">

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- Form --}}
                <form action="{{ route('developers.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-6 sm:p-10 lg:p-12">

                    @csrf


                    {{-- Profile Section --}}
                    <section>

                        <div class="mb-6">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11 items-center justify-center
                                        rounded-xl bg-orange-500/10 text-orange-500">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 19a6 6 0 00-12 0M9 11a4 4 0 100-8 4 4 0 000 8zM19 8v6m3-3h-6" />

                                    </svg>

                                </div>

                                <div>

                                    <h2 class="text-xl font-black">
                                        Developer Profile
                                    </h2>

                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Tell the community who you are.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="grid gap-6 md:grid-cols-2">

                            {{-- Name --}}
                            <div>

                                <label for="name"
                                    class="block text-sm font-bold text-slate-700
                                       dark:text-slate-200">

                                    Full Name
                                    <span class="text-orange-500">*</span>

                                </label>

                                <input id="name" type="text" name="name"
                                    value="{{ old('name', auth()->user()->name ?? '') }}" required autocomplete="name"
                                    placeholder="John Developer"
                                    class="mt-2 block w-full rounded-xl border-slate-300
                                       bg-white px-4 py-3 text-sm text-slate-900
                                       shadow-sm outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-orange-500 focus:ring-orange-500
                                       dark:border-slate-700 dark:bg-slate-950
                                       dark:text-white dark:placeholder:text-slate-600">

                                @error('name')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror

                            </div>


                            {{-- Role --}}
                            <div>

                                <label for="role"
                                    class="block text-sm font-bold text-slate-700
                                       dark:text-slate-200">

                                    Developer Role
                                    <span class="text-orange-500">*</span>

                                </label>

                                <select id="role" name="role" required
                                    class="mt-2 block w-full rounded-xl border-slate-300
                                       bg-white px-4 py-3 text-sm text-slate-900
                                       shadow-sm outline-none transition
                                       focus:border-orange-500 focus:ring-orange-500
                                       dark:border-slate-700 dark:bg-slate-950
                                       dark:text-white">

                                    @php
                                        $roles = [
                                            'Full Stack Developer',
                                            'Backend Developer',
                                            'Frontend Developer',
                                            'Mobile Developer',
                                            'UI/UX Designer',
                                            'DevOps Engineer',
                                            'Software Engineer',
                                            'QA Engineer',
                                            'Other',
                                        ];
                                    @endphp

                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" @selected(old('role', 'Full Stack Developer') === $role)>
                                            {{ $role }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('role')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror

                            </div>

                        </div>

                    </section>


                    {{-- Divider --}}
                    <div class="my-10 border-t border-slate-200 dark:border-slate-800"></div>


                    {{-- Avatar --}}
                    <section>

                        <div class="mb-6">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11 items-center justify-center
                                        rounded-xl bg-orange-500/10 text-orange-500">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 7a2 2 0 012-2h2l1-2h6l1 2h2a2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V7z" />

                                        <circle cx="12" cy="13" r="3.5" />

                                    </svg>

                                </div>

                                <div>

                                    <h2 class="text-xl font-black">
                                        Profile Image
                                    </h2>

                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Give your developer profile a face.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div
                            class="rounded-2xl border border-dashed border-slate-300
                                bg-slate-50 p-6
                                dark:border-slate-700 dark:bg-slate-950">

                            <label for="avatar"
                                class="flex cursor-pointer flex-col items-center
                                   justify-center text-center">

                                <div
                                    class="flex h-14 w-14 items-center justify-center
                                        rounded-2xl bg-orange-500/10 text-orange-500">

                                    <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.6"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 16V4m0 0L8 8m4-4l4 4M5 20h14" />

                                    </svg>

                                </div>

                                <span class="mt-4 text-sm font-bold text-slate-700 dark:text-slate-200">
                                    Choose profile image
                                </span>

                                <span class="mt-1 text-xs text-slate-500">
                                    PNG, JPG or WEBP · Recommended square image
                                </span>

                                <input id="avatar" type="file" name="avatar"
                                    accept="image/png,image/jpeg,image/webp" class="sr-only">

                            </label>

                        </div>

                        @error('avatar')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </section>


                    {{-- Divider --}}
                    <div class="my-10 border-t border-slate-200 dark:border-slate-800"></div>


                    {{-- About --}}
                    <section>

                        <div class="mb-6">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11 items-center justify-center
                                        rounded-xl bg-orange-500/10 text-orange-500">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 5h16M4 9h16M4 13h10M4 17h7" />

                                    </svg>

                                </div>

                                <div>

                                    <h2 class="text-xl font-black">
                                        About You
                                    </h2>

                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Tell us about your skills and experience.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <textarea id="bio" name="bio" rows="6" maxlength="1000"
                            placeholder="Tell us about your experience, skills, technologies you work with, and what you would like to contribute..."
                            class="block w-full resize-y rounded-2xl border-slate-300
                               bg-white px-4 py-3 text-sm text-slate-900
                               shadow-sm outline-none transition
                               placeholder:text-slate-400
                               focus:border-orange-500 focus:ring-orange-500
                               dark:border-slate-700 dark:bg-slate-950
                               dark:text-white dark:placeholder:text-slate-600">{{ old('bio') }}</textarea>

                        <div class="mt-2 flex justify-between text-xs text-slate-400">

                            <span>
                                Keep it professional and useful.
                            </span>

                            <span>
                                Maximum 1000 characters
                            </span>

                        </div>

                        @error('bio')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </section>


                    {{-- Divider --}}
                    <div class="my-10 border-t border-slate-200 dark:border-slate-800"></div>


                    {{-- Social Links --}}
                    <section>

                        <div class="mb-6">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11 items-center justify-center
                                        rounded-xl bg-orange-500/10 text-orange-500">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10 13a5 5 0 007.07.07l2-2a5 5 0 00-7.07-7.07l-1.15 1.15M14 11a5 5 0 00-7.07-.07l-2 2A5 5 0 0017 20l1.15-1.15" />

                                    </svg>

                                </div>

                                <div>

                                    <h2 class="text-xl font-black">
                                        Developer Links
                                    </h2>

                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Let people discover your work.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="grid gap-6 md:grid-cols-3">

                            {{-- GitHub --}}
                            <div>

                                <label for="github"
                                    class="block text-sm font-bold text-slate-700
                                       dark:text-slate-200">

                                    GitHub

                                </label>

                                <input id="github" type="url" name="github" value="{{ old('github') }}"
                                    autocomplete="url" placeholder="https://github.com/username"
                                    class="mt-2 block w-full rounded-xl border-slate-300
                                       bg-white px-4 py-3 text-sm
                                       dark:border-slate-700 dark:bg-slate-950
                                       dark:text-white">

                                @error('github')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror

                            </div>


                            {{-- LinkedIn --}}
                            <div>

                                <label for="linkedin"
                                    class="block text-sm font-bold text-slate-700
                                       dark:text-slate-200">

                                    LinkedIn

                                </label>

                                <input id="linkedin" type="url" name="linkedin" value="{{ old('linkedin') }}"
                                    placeholder="https://linkedin.com/in/name"
                                    class="mt-2 block w-full rounded-xl border-slate-300
                                       bg-white px-4 py-3 text-sm
                                       dark:border-slate-700 dark:bg-slate-950
                                       dark:text-white">

                                @error('linkedin')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror

                            </div>


                            {{-- Website --}}
                            <div>

                                <label for="website"
                                    class="block text-sm font-bold text-slate-700
                                       dark:text-slate-200">

                                    Portfolio Website

                                </label>

                                <input id="website" type="url" name="website" value="{{ old('website') }}"
                                    placeholder="https://yourwebsite.com"
                                    class="mt-2 block w-full rounded-xl border-slate-300
                                       bg-white px-4 py-3 text-sm
                                       dark:border-slate-700 dark:bg-slate-950
                                       dark:text-white">

                                @error('website')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror

                            </div>

                        </div>

                    </section>


                    {{-- Agreement --}}
                    <div
                        class="my-10 rounded-2xl border border-orange-200
                            bg-orange-50 p-6
                            dark:border-orange-500/20 dark:bg-orange-500/5">

                        <div class="flex gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center
                                    rounded-xl bg-orange-500 text-white">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />

                                </svg>

                            </div>

                            <div>

                                <h3 class="font-black text-orange-800 dark:text-orange-400">
                                    Developer Community
                                </h3>

                                <p
                                    class="mt-2 text-sm leading-6 text-orange-700/80
                                      dark:text-orange-300/70">

                                    By submitting this form, you understand that your
                                    developer profile may be reviewed before appearing
                                    on the {{ config('app.name') }} developer community
                                    page.

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Submit --}}
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <p class="text-xs leading-5 text-slate-500 dark:text-slate-400">

                            Your information will be reviewed by the platform team.

                        </p>


                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2
                               rounded-xl bg-orange-500 px-7 py-3.5
                               text-sm font-bold text-white
                               shadow-lg shadow-orange-500/20
                               transition hover:-translate-y-0.5
                               hover:bg-orange-600
                               focus:outline-none focus:ring-2
                               focus:ring-orange-500 focus:ring-offset-2
                               dark:focus:ring-offset-slate-900">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M6 12h14" />

                            </svg>

                            Join Developer Team

                        </button>

                    </div>

                </form>

            </div>


            {{-- Bottom note --}}
            <div class="mt-6 text-center">

                <p class="text-xs text-slate-500 dark:text-slate-500">

                    {{ config('app.name') }}
                    <span class="mx-1">•</span>
                    {{ __('Building something better, one commit at a time.') }}

                </p>

            </div>

        </div>

    </div>


</x-app-layout>
