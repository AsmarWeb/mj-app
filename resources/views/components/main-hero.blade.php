<section>
    {{-- <div class="flex flex-col w-full items-center justify-center px-4 pt-20 pb-16 sm:px-6 lg:px-8 lg:pt-32">
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
    </div> --}}

    <div class="mx-auto mt-10 mb-10 max-w-6xl text-center p-6">

        <div class="mx-auto mt-10 flex justify-center px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8">
            <div class="text-center ">
                <h1
                    class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-slate-200 sm:text-5xl md:text-6xl">
                    <span class="block xl:inline"><span class="mb-1 block">{{ __('hero.main.title') }}</span>
                        <span class="bg-gradient-to-r from-indigo-400 to-pink-600 bg-clip-text text-transparent">
                            {{ __('hero.main.Sell Smarter') }}
                        </span>
                    </span>
                    <div class="mt-2">{{ __('hero.main.Get Found') }}
                        <span class="relative mt-3 whitespace-nowrap text-orange-600"><svg aria-hidden="true"
                                viewBox="0 0 418 42"
                                class="absolute top-3/4 left-0 right-0 m-auto h-[0.58em] w-fit fill-pink-400/50"
                                preserveAspectRatio="none">
                                <path
                                    d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.78 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.54-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.81 23.239-7.825 27.934-10.149 28.304-14.005.417-4.348-3.529-6-16.878-7.066Z">
                                </path>
                            </svg>
                            <span class="relative">{{ __('hero.main.With') }} {{ __('hero.main.AI tools') }}</span>
                        </span>
                    </div>
                </h1>
                <p class="mx-auto mt-3 max-w-xl text-lg text-gray-500 dark:text-slate-400 sm:mt-5 md:mt-5">
                    {{ __('hero.main.subtitle') }}
                </p>
            </div>
        </div>

        <form action="{{ route('search') }}" method="GET">
            <label
                class="mx-auto mt-8 relative bg-white min-w-sm max-w-2xl flex flex-col md:flex-row items-center justify-center border py-2 px-2 rounded-2xl gap-2 shadow-2xl focus-within:border-gray-300"
                for="search-bar">

                <input id="search-bar" placeholder="{{ __('hero.form.placeholder') }}" name="q"
                    class="px-6 py-2 w-full rounded-md flex-1 outline-none bg-white" required="">
                <button type="submit"
                    class="w-full md:w-auto px-6 py-3 bg-orange-600 border-orange-700 text-white fill-white active:scale-95 duration-100 border will-change-transform overflow-hidden relative rounded-xl transition-all">
                    <div class="flex items-center transition-all opacity-1">
                        <span class="text-sm font-semibold whitespace-nowrap truncate mx-auto">
                            {{ __('hero.form.button') }}
                        </span>
                    </div>
                </button>
            </label>
        </form>

        <div class="mx-auto max-w-2xl sm:text-center my-20">

        </div>

        <div
            class="mx-auto max-w-3xl items-stretch space-y-4 text-left sm:flex sm:space-y-0 sm:space-x-8 sm:text-center">
            @foreach ($shops as $shop)
                <a class="flex w-full items-center rounded-xl border border-black border-opacity-10 px-4 py-6 text-black duration-200 hover:border-opacity-0 hover:no-underline hover:shadow-lg dark:text-white dark:hover:bg-white dark:hover:bg-opacity-10 sm:flex-col sm:hover:shadow-2xl"
                    href="{{ route('shop', $shop->slug) }}" target="_blank">
                    @if ($shop->logo)
                        <img class="mr-4 w-12 sm:mr-0 sm:h-32 sm:w-32"
                            src="{{ Storage::disk('public')->url($shop->logo) }}" alt="{{ $shop->name }}">
                    @else
                        <div
                            class="flex h-full w-full items-center justify-center bg-gradient-to-br from-indigo-500 to-cyan-500 text-3xl font-semibold text-white">
                            {{ strtoupper(substr($shop->name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <div class="font-semibold text-black dark:text-white sm:mt-4 sm:mb-2">{{ $shop->name }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
