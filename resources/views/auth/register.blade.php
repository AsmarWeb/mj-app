<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('register.name') }}" />
                <x-input id="name"
                    class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 text-base shadow-sm focus:border-[#c9a75e] focus:ring-[#c9a75e]"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('register.email') }}" />
                <x-input id="email"
                    class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 text-base shadow-sm focus:border-[#c9a75e] focus:ring-[#c9a75e]"
                    type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('register.password') }}" />
                <x-input id="password"
                    class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 text-base shadow-sm focus:border-[#c9a75e] focus:ring-[#c9a75e]"
                    type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('register.password_confirmation') }}" />
                <x-input id="password_confirmation"
                    class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 text-base shadow-sm focus:border-[#c9a75e] focus:ring-[#c9a75e]"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required
                                class="mt-1 rounded border-gray-300 text-[#a17d35] focus:ring-[#c9a75e]" />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm font-semibold text-gray-500 underline-offset-4 transition hover:text-[#9a793a] hover:underline"
                    href="{{ route('login') }}">
                    {{ __('register.registered') }}
                </a>

                <x-button
                    class="ms-4 rounded-lg bg-[#171717] px-6 py-3 text-sm font-bold text-white transition hover:bg-[#9a793a] focus:ring-[#c9a75e]">
                    {{ __('register.register') }}
                </x-button>
            </div>
        </form>

        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="bg-white px-3 text-gray-500">
                        Or continue with
                    </span>
                </div>
            </div>

            <div class="mt-6 flex justify-center gap-4">

                <!-- Google -->
                <a href="{{ route('social.redirect', 'google') }}"
                    class="flex h-12 w-12 items-center justify-center rounded-full border border-gray-300 bg-white shadow-sm transition hover:bg-gray-100 hover:shadow-md">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="h-6 w-6">
                </a>

                <!-- Facebook -->
                <a href="{{ route('social.redirect', 'facebook') }}"
                    class="flex h-12 w-12 items-center justify-center rounded-full border border-gray-300 bg-white shadow-sm transition hover:bg-gray-100 hover:shadow-md">
                    <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" alt="Facebook" class="h-6 w-6">
                </a>

            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
