<x-guest-layout>
    <x-authentication-card>

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        {{-- Validation errors --}}
        <x-validation-errors class="mb-5" />

        {{-- Session status --}}
        @session('status')
            <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
                {{ $value }}
            </div>
        @endsession


        {{-- ========================================================= --}}
        {{-- LOGIN FORM --}}
        {{-- ========================================================= --}}

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div>
                <x-label for="email" value="{{ __('login.email') }}" class="text-sm font-bold text-gray-700" />

                <x-input id="email"
                    class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 text-base shadow-sm focus:border-[#c9a75e] focus:ring-[#c9a75e]"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>


            {{-- Password --}}
            <div class="mt-5">
                <x-label for="password" value="{{ __('login.password') }}" class="text-sm font-bold text-gray-700" />

                <x-input id="password"
                    class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 text-base shadow-sm focus:border-[#c9a75e] focus:ring-[#c9a75e]"
                    type="password" name="password" required autocomplete="current-password" />
            </div>


            {{-- Remember me --}}
            <div class="mt-5">
                <label for="remember_me" class="flex cursor-pointer items-center">
                    <x-checkbox id="remember_me" name="remember"
                        class="rounded border-gray-300 text-[#a17d35] focus:ring-[#c9a75e]" />

                    <span class="ms-2 text-sm font-medium text-gray-600">
                        {{ __('login.remember_me') }}
                    </span>
                </label>
            </div>


            {{-- Login / Forgot password --}}
            <div class="mt-6 flex items-center justify-between gap-4">

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm font-semibold text-gray-500 underline-offset-4 transition hover:text-[#9a793a] hover:underline">
                        {{ __('login.password_request') }}
                    </a>
                @endif

                <x-button
                    class="rounded-lg bg-[#171717] px-6 py-3 text-sm font-bold text-white transition hover:bg-[#9a793a] focus:ring-[#c9a75e]">
                    {{ __('login.login') }}
                </x-button>

            </div>

        </form>


        {{-- ========================================================= --}}
        {{-- SOCIAL LOGIN --}}
        {{-- ========================================================= --}}

        <div class="mt-8">

            {{-- Divider --}}
            <div class="relative">

                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>

                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-sm font-medium text-gray-400">
                        {{ __('login.or_continue_with') }}
                    </span>
                </div>

            </div>


            {{-- Social buttons --}}
            <div class="mt-6 flex justify-center gap-4">

                {{-- Google --}}
                <a href="{{ route('social.redirect', 'google') }}" aria-label="Continue with Google"
                    title="Continue with Google"
                    class="flex h-12 w-12 items-center justify-center rounded-full border border-gray-300 bg-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-gray-100 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#c9a75e] focus:ring-offset-2">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="h-6 w-6">
                </a>


                {{-- Facebook --}}
                <a href="{{ route('social.redirect', 'facebook') }}" aria-label="Continue with Facebook"
                    title="Continue with Facebook"
                    class="flex h-12 w-12 items-center justify-center rounded-full border border-gray-300 bg-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-gray-100 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#c9a75e] focus:ring-offset-2">
                    <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" alt="Facebook" class="h-6 w-6">
                </a>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- REGISTER --}}
        {{-- ========================================================= --}}

        @if (Route::has('register'))
            <div class="mt-7 border-t border-gray-100 pt-6 text-center">

                <span class="text-sm text-gray-500">
                    {{ __('login.no_account') }}
                </span>

                <a href="{{ route('register') }}"
                    class="ms-1 text-sm font-bold text-[#9a793a] hover:text-[#73571f] hover:underline">
                    {{ __('login.register') }}
                </a>

            </div>
        @endif

    </x-authentication-card>
</x-guest-layout>
