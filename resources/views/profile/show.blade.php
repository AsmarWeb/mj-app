<x-app-layout>
    <div
        class="min-h-screen bg-slate-50 text-slate-900 transition-colors duration-300 dark:bg-slate-950 dark:text-white">

        {{-- ========================================================= --}}
        {{-- Premium Profile Settings Header --}}
        {{-- ========================================================= --}}

        <div class="relative overflow-hidden border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">

            {{-- Decorative Background --}}
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -right-32 -top-40 h-96 w-96 rounded-full bg-orange-500/10 blur-3xl"></div>
                <div class="absolute -left-32 -bottom-40 h-96 w-96 rounded-full bg-amber-400/10 blur-3xl"></div>

                <div class="absolute inset-0 opacity-[0.035] dark:opacity-[0.04]"
                    style="background-image: radial-gradient(circle at 1px 1px, currentColor 1px, transparent 0); background-size: 28px 28px;">
                </div>
            </div>

            <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

                <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">

                    {{-- Title --}}
                    <div class="max-w-3xl">

                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full
                           border border-orange-200 bg-orange-50 px-3.5 py-1.5
                           text-xs font-bold uppercase tracking-[0.18em]
                           text-orange-600
                           dark:border-orange-500/20 dark:bg-orange-500/10
                           dark:text-orange-400">

                            <span class="h-1.5 w-1.5 rounded-full bg-orange-500 shadow-sm shadow-orange-500/50"></span>

                            Account Settings

                        </div>

                        <h1
                            class="text-3xl font-black tracking-tight text-slate-900 sm:text-4xl lg:text-5xl dark:text-white">
                            Profile & Security
                        </h1>

                        <p class="mt-4 max-w-2xl text-base leading-7 text-slate-500 dark:text-slate-400 sm:text-lg">
                            Manage your personal information, password, security preferences,
                            active sessions and account settings from one secure place.
                        </p>

                    </div>


                    {{-- Premium Badge --}}
                    <div class="hidden shrink-0 sm:block">

                        <div
                            class="flex items-center gap-3 rounded-2xl border border-slate-200
                           bg-white/80 px-4 py-3 shadow-sm backdrop-blur
                           dark:border-slate-700 dark:bg-slate-800/80">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl
                               bg-gradient-to-br from-orange-400 to-amber-500
                               text-white shadow-lg shadow-orange-500/20">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3l7 4v5c0 4.5-3 7.8-7 9-4-1.2-7-4.5-7-9V7l7-4z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />

                                </svg>

                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Account
                                </p>

                                <p class="text-sm font-bold text-slate-900 dark:text-white">
                                    Secure & Protected
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- Settings Content --}}
        {{-- ========================================================= --}}

        <main class="relative">

            {{-- Decorative glow --}}
            <div
                class="pointer-events-none absolute left-1/2 top-0 hidden h-96 w-[42rem]
                -translate-x-1/2 rounded-full bg-orange-500/5 blur-3xl lg:block">
            </div>


            <div class="relative mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

                {{-- ========================================================= --}}
                {{-- Profile Information --}}
                {{-- ========================================================= --}}

                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <section
                        class="group relative overflow-hidden rounded-[2rem]
                       border border-slate-200 bg-white
                       shadow-xl shadow-slate-200/40
                       transition duration-300
                       dark:border-slate-800 dark:bg-slate-900
                       dark:shadow-black/20">

                        {{-- Top Accent --}}
                        <div class="h-1 bg-gradient-to-r from-orange-400 via-orange-500 to-amber-500"></div>

                        {{-- Decorative glow --}}
                        <div
                            class="pointer-events-none absolute -right-24 -top-24 h-72 w-72
                           rounded-full bg-orange-500/5 blur-3xl
                           transition group-hover:bg-orange-500/10">
                        </div>

                        <div class="relative p-5 sm:p-8 lg:p-10">

                            {{-- Section Header --}}
                            <div class="mb-8 flex items-start gap-4">

                                <div
                                    class="flex h-12 w-12 shrink-0 items-center justify-center
                                   rounded-2xl bg-orange-500/10 text-orange-500">

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">

                                        <circle cx="12" cy="8" r="3" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5 20c0-3.5 3-6 7-6s7 2.5 7 6" />

                                    </svg>

                                </div>

                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-orange-500">
                                        Personal Details
                                    </p>

                                    <h2 class="mt-1 text-2xl font-black text-slate-900 dark:text-white">
                                        Profile Information
                                    </h2>

                                    <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">
                                        Update your name, email address and personal profile information.
                                    </p>
                                </div>

                            </div>

                            @livewire('profile.update-profile-information-form')

                        </div>

                    </section>

                    <x-section-border />
                @endif


                {{-- ========================================================= --}}
                {{-- Password --}}
                {{-- ========================================================= --}}

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <section
                        class="group relative mt-10 overflow-hidden rounded-[2rem]
                       border border-slate-200 bg-white
                       shadow-xl shadow-slate-200/40
                       transition duration-300
                       dark:border-slate-800 dark:bg-slate-900
                       dark:shadow-black/20">

                        <div class="h-1 bg-gradient-to-r from-orange-400 via-amber-500 to-yellow-500"></div>

                        <div
                            class="pointer-events-none absolute -left-24 -top-24 h-72 w-72
                           rounded-full bg-amber-500/5 blur-3xl">
                        </div>

                        <div class="relative p-5 sm:p-8 lg:p-10">

                            <div class="mb-8 flex items-start gap-4">

                                <div
                                    class="flex h-12 w-12 shrink-0 items-center justify-center
                                   rounded-2xl bg-amber-500/10 text-amber-500">

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">

                                        <rect x="4" y="10" width="16" height="11" rx="2" />

                                        <path stroke-linecap="round" d="M8 10V7a4 4 0 018 0v3" />

                                        <circle cx="12" cy="15.5" r="1" />

                                    </svg>

                                </div>

                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-amber-500">
                                        Account Security
                                    </p>

                                    <h2 class="mt-1 text-2xl font-black text-slate-900 dark:text-white">
                                        Password
                                    </h2>

                                    <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">
                                        Keep your account secure by using a strong and unique password.
                                    </p>
                                </div>

                            </div>

                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.update-password-form')
                            </div>

                        </div>

                    </section>

                    <x-section-border />
                @endif


                {{-- ========================================================= --}}
                {{-- Two Factor Authentication --}}
                {{-- ========================================================= --}}

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <section
                        class="group relative mt-10 overflow-hidden rounded-[2rem]
                       border border-slate-200 bg-white
                       shadow-xl shadow-slate-200/40
                       transition duration-300
                       dark:border-slate-800 dark:bg-slate-900
                       dark:shadow-black/20">

                        <div class="h-1 bg-gradient-to-r from-emerald-400 via-teal-500 to-cyan-500"></div>

                        <div
                            class="pointer-events-none absolute -right-24 -top-24 h-72 w-72
                           rounded-full bg-emerald-500/5 blur-3xl">
                        </div>

                        <div class="relative p-5 sm:p-8 lg:p-10">

                            <div class="mb-8 flex items-start gap-4">

                                <div
                                    class="flex h-12 w-12 shrink-0 items-center justify-center
                                   rounded-2xl bg-emerald-500/10 text-emerald-500">

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 3l7 4v5c0 4.5-3 7.8-7 9-4-1.2-7-4.5-7-9V7l7-4z" />

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />

                                    </svg>

                                </div>

                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-emerald-500">
                                        Enhanced Protection
                                    </p>

                                    <h2 class="mt-1 text-2xl font-black text-slate-900 dark:text-white">
                                        Two-Factor Authentication
                                    </h2>

                                    <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">
                                        Add an extra layer of protection to your account with two-factor authentication.
                                    </p>
                                </div>

                            </div>

                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.two-factor-authentication-form')
                            </div>

                        </div>

                    </section>

                    <x-section-border />
                @endif


                {{-- ========================================================= --}}
                {{-- Browser Sessions --}}
                {{-- ========================================================= --}}

                <section
                    class="group relative mt-10 overflow-hidden rounded-[2rem]
                   border border-slate-200 bg-white
                   shadow-xl shadow-slate-200/40
                   transition duration-300
                   dark:border-slate-800 dark:bg-slate-900
                   dark:shadow-black/20">

                    <div class="h-1 bg-gradient-to-r from-blue-400 via-indigo-500 to-violet-500"></div>

                    <div
                        class="pointer-events-none absolute -left-24 -bottom-24 h-72 w-72
                       rounded-full bg-indigo-500/5 blur-3xl">
                    </div>

                    <div class="relative p-5 sm:p-8 lg:p-10">

                        <div class="mb-8 flex items-start gap-4">

                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center
                               rounded-2xl bg-indigo-500/10 text-indigo-500">

                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">

                                    <rect x="3" y="5" width="18" height="14" rx="2" />

                                    <path stroke-linecap="round" d="M8 21h8M12 19v2" />

                                    <path stroke-linecap="round" d="M7 9h10M7 13h6" />

                                </svg>

                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-indigo-500">
                                    Active Access
                                </p>

                                <h2 class="mt-1 text-2xl font-black text-slate-900 dark:text-white">
                                    Browser Sessions
                                </h2>

                                <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">
                                    Review and manage devices currently signed in to your account.
                                </p>
                            </div>

                        </div>

                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.logout-other-browser-sessions-form')
                        </div>

                    </div>

                </section>


                {{-- ========================================================= --}}
                {{-- Delete Account --}}
                {{-- ========================================================= --}}

                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <x-section-border />

                    <section
                        class="group relative mt-10 overflow-hidden rounded-[2rem]
                       border border-red-200 bg-white
                       shadow-xl shadow-red-100/40
                       transition duration-300
                       dark:border-red-900/40 dark:bg-slate-900
                       dark:shadow-black/20">

                        <div class="h-1 bg-gradient-to-r from-red-400 via-rose-500 to-red-600"></div>

                        <div
                            class="pointer-events-none absolute -right-24 -bottom-24 h-80 w-80
                           rounded-full bg-red-500/5 blur-3xl">
                        </div>

                        <div class="relative p-5 sm:p-8 lg:p-10">

                            <div class="mb-8 flex items-start gap-4">

                                <div
                                    class="flex h-12 w-12 shrink-0 items-center justify-center
                                   rounded-2xl bg-red-500/10 text-red-500">

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3" />

                                    </svg>

                                </div>

                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-red-500">
                                        Danger Zone
                                    </p>

                                    <h2 class="mt-1 text-2xl font-black text-slate-900 dark:text-white">
                                        Delete Account
                                    </h2>

                                    <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">
                                        Permanently remove your account and all associated data.
                                    </p>
                                </div>

                            </div>

                            <div
                                class="rounded-2xl border border-red-100 bg-red-50/60 p-4
                                dark:border-red-900/30 dark:bg-red-500/5">

                                <div class="flex gap-3">

                                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500" fill="none"
                                        stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">

                                        <circle cx="12" cy="12" r="9" />

                                        <path stroke-linecap="round" d="M12 8v5M12 16h.01" />

                                    </svg>

                                    <p class="text-sm leading-6 text-red-700 dark:text-red-300">
                                        This action is permanent. Make sure you have backed up anything
                                        important before deleting your account.
                                    </p>

                                </div>

                            </div>

                            <div class="mt-8 sm:mt-0">
                                @livewire('profile.delete-user-form')
                            </div>

                        </div>

                    </section>
                @endif


                {{-- Bottom spacing --}}
                <div class="h-16"></div>

            </div>

        </main>

    </div>

</x-app-layout>
