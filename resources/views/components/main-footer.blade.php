<div>
    <footer>
        <div class="container px-6 py-8 mx-auto">
            <div class="flex flex-col items-center text-center">
                <a href="{{ route('home') }}">
                    <img class="w-auto h-7" src="{{ asset('logo.png') }}" alt="">
                </a>

                <div class="flex flex-wrap justify-center mt-6 -mx-4">
                    <a href="{{ route('home') }}"
                        class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400"
                        aria-label="Reddit"> Home </a>

                    <a target="_blank" href="{{ route('about') }}"
                        class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400"
                        aria-label="Reddit"> About </a>

                    <a target="_blank" href="{{ route('terms.show') }}"
                        class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400"
                        aria-label="Reddit"> Teams </a>

                    <a target="_blank" href="{{ route('policy.show') }}"
                        class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400"
                        aria-label="Reddit"> Privacy </a>

                    <a href="#"
                        class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400"
                        aria-label="Reddit"> Cookies </a>
                </div>

            </div>

            <hr class="my-6 border-gray-200 md:my-10 dark:border-gray-700" />

            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <p class="text-sm text-gray-500 dark:text-gray-300">© Copyright 2024. All Rights Reserved.</p>

                <div class="flex -mx-2 py-4">

                    <a href="#"
                        class="px-4 text-gray-700 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400">
                        Facebook</a>

                    <a href="#"
                        class="px-4 text-gray-700 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400">Instagram</a>

                    <a href="#"
                        class="px-4 text-gray-700 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400">
                        Telegram</a>

                </div>
            </div>
        </div>
    </footer>
</div>
