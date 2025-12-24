<section>
    <div class="flex flex-col w-full items-center justify-center px-4 pt-20 pb-16 sm:px-6 lg:px-8 lg:pt-32">
        <h1 class="text-5xl font-extrabold text-center lg:text-7xl 2xl:text-8xl">
            <span
                class="text-transparent bg-gradient-to-br bg-clip-text from-teal-500 via-indigo-500 to-sky-500 dark:from-teal-200 dark:via-indigo-300 dark:to-sky-500">
                {{ __('hero.coming') }}
            </span>

            <span
                class="text-transparent bg-gradient-to-tr bg-clip-text from-blue-500 via-pink-500 to-red-500 dark:from-sky-300 dark:via-pink-300 dark:to-red-500">
                {{ __('hero.soon') }}
            </span>
        </h1>

        @if (app()->getLocale() == 'ar')
            <p class="max-w-3xl mx-auto mt-6 text-lg text-center text-gray-700 dark:text-white md:text-xl">
                {{ $setting->description_ar }}
            </p>
        @else
            <p class="max-w-3xl mx-auto mt-6 text-lg text-center text-gray-700 dark:text-white md:text-xl">
                {{ $setting->description }}
            </p>
        @endif


        <livewire:newsletter.form />

        @if (app()->getLocale() == 'ar')
            <p class="mt-8 text-center text-gray-700 dark:text-white text-md md:text-xl">
                {{ $setting->short_des_ar }}
            </p>
        @else
            <p class="mt-8 text-center text-gray-700 dark:text-white text-md md:text-xl"> {{ $setting->short_des }}
            </p>
        @endif
    </div>
    {{-- <div class="mx-auto mt-10 mb-10 max-w-6xl text-center p-6">
        <div class="mx-auto max-w-2xl sm:text-center my-2">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-200 sm:text-4xl">
                {{ __('hero.main.title') }}
            </h2>
            <p class="mt-6 text-lg leading-8 text-gray-500">{{ __('hero.main.subtitle') }}</p>
        </div>
        <div
            class="mx-auto max-w-3xl items-stretch space-y-4 text-left sm:flex sm:space-y-0 sm:space-x-8 sm:text-center">
            <a class="flex w-full items-center rounded-xl border border-black border-opacity-10 px-4 py-6 text-black duration-200 hover:border-opacity-0 hover:no-underline hover:shadow-lg dark:text-white dark:hover:bg-white dark:hover:bg-opacity-10 sm:flex-col sm:hover:shadow-2xl"
                href="#" target="_blank">
                <img class="mr-4 w-12 sm:mr-0 sm:h-32 sm:w-32" src="https://swiperjs.com/images/projects/framework7.svg"
                    alt="Framework7">
                <div>
                    <div class="font-semibold text-black dark:text-white sm:mt-4 sm:mb-2">Framework7</div>
                </div>
            </a>
            <a class="flex w-full items-center rounded-xl border border-black border-opacity-10 px-4 py-6 text-black duration-200 hover:border-opacity-0 hover:no-underline hover:shadow-lg dark:text-white dark:hover:bg-white dark:hover:bg-opacity-10 sm:flex-col sm:hover:shadow-2xl"
                href="#" target="_blank">
                <img class="mr-4 w-12 sm:mr-0 sm:h-32 sm:w-32" src="https://swiperjs.com/images/projects/atropos.svg"
                    alt="Atropos">
                <div>
                    <div class="font-semibold text-black dark:text-white sm:mt-4 sm:mb-2">Atropos</div>
                </div>
            </a>
            <a class="flex w-full items-center rounded-xl border border-black border-opacity-10 px-4 py-6 text-black duration-200 hover:border-opacity-0 hover:no-underline hover:shadow-lg dark:text-white dark:hover:bg-white dark:hover:bg-opacity-10 sm:flex-col sm:hover:shadow-2xl"
                href="#" target="_blank">
                <img class="mr-4 w-12 sm:mr-0 sm:h-32 sm:w-32" src="https://swiperjs.com/images/projects/konsta.svg"
                    alt="Konsta UI">
                <div>
                    <div class="font-semibold text-black dark:text-white sm:mt-4 sm:mb-2">Konsta UI</div>
                </div>
            </a>
        </div>
    </div> --}}
</section>
