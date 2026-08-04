<div>
    <footer class="container px-6 py-8 mx-auto dark:bg-gray-900">
        <div class="flex flex-col items-center text-center font-normal">
            <a href="{{ route('home') }}">
                <img class="w-auto h-7" src="{{ asset('storage/setting-suggest/' . $setting->logo) }}" alt="murwaj">
            </a>

            <div class="flex flex-wrap justify-center mt-6 -mx-4">
                <a href="{{ route('home') }}"
                    class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-orange-500 dark:text-gray-300 dark:hover:text-orange-400"
                    aria-label="Reddit"> {{ __('footer.main.home') }} </a>

                <a target="_blank" href="{{ route('contact') }}"
                    class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-orange-500 dark:text-gray-300 dark:hover:text-orange-400"
                    aria-label="Reddit"> {{ __('footer.main.contact') }} </a>

                <a target="_blank" href="{{ route('terms.show') }}"
                    class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-orange-500 dark:text-gray-300 dark:hover:text-orange-400"
                    aria-label="Reddit"> {{ __('footer.main.terms') }} </a>

                <a target="_blank" href="{{ route('policy.show') }}"
                    class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-orange-500 dark:text-gray-300 dark:hover:text-orange-400"
                    aria-label="Reddit"> {{ __('footer.main.policy') }} </a>
                <a target="_blank" href="{{ route('sitemap.page') }}"
                    class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-orange-500 dark:text-gray-300 dark:hover:text-orange-400"
                    aria-label="Reddit"> {{ __('footer.main.sitemap') }} </a>
            </div>

        </div>

        <hr class="my-6 border-gray-200 md:my-10 dark:border-gray-700" />

        <div class="flex flex-col items-center sm:flex-row sm:justify-between">
            <p class="text-sm text-gray-500 dark:text-gray-300">©
                {{ date('Y') }} {{ app()->getLocale() == 'ar' ? $setting->copyright_ar : $setting->copyright }}
            </p>

            <div class="flex -mx-2 py-4">

                <a href="{{ $setting->facebook }}"
                    class="px-4 text-gray-700 transition-colors duration-300 dark:text-gray-300 hover:text-orange-500 dark:hover:text-orange-400">
                    Facebook
                </a>

                <a href="{{ $setting->instagram }}"
                    class="px-4 text-gray-700 transition-colors duration-300 dark:text-gray-300 hover:text-orange-500 dark:hover:text-orange-400">
                    Instagram
                </a>

                <a href="{{ $setting->telegram }}"
                    class="px-4 text-gray-700 transition-colors duration-300 dark:text-gray-300 hover:text-orange-500 dark:hover:text-orange-400">
                    Telegram
                </a>

            </div>
        </div>
    </footer>
</div>
