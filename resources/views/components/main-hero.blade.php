<div class="flex flex-col px-6 py-8 mx-auto">
    <section class="flex items-center flex-1">
        <div class="flex flex-col w-full ">
            <h1 class="text-5xl font-extrabold text-center lg:text-7xl 2xl:text-8xl">
                <span
                    class="text-transparent bg-gradient-to-br bg-clip-text from-teal-500 via-indigo-500 to-sky-500 dark:from-teal-200 dark:via-indigo-300 dark:to-sky-500">
                    Coming
                </span>

                <span
                    class="text-transparent bg-gradient-to-tr bg-clip-text from-blue-500 via-pink-500 to-red-500 dark:from-sky-300 dark:via-pink-300 dark:to-red-500">
                    Soon
                </span>
            </h1>

            <p class="max-w-3xl mx-auto mt-6 text-lg text-center text-gray-700 dark:text-white md:text-xl">
                {{ $setting->description }}
            </p>

            <livewire:newsletter.form />

            <p class="mt-8 text-center text-gray-700 dark:text-white text-md md:text-xl"> {{ $setting->short_des }}
            </p>
        </div>
    </section>
</div>
