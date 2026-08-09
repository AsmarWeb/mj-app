<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>We'll Be Back Soon | {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-950">

    <div class="min-h-screen flex flex-col justify-center items-center px-6 py-12">

        {{-- Main Content --}}
        <div class="w-full max-w-3xl text-center">

            {{-- Icon --}}
            <div class="flex justify-center mb-8">

                <div
                    class="flex items-center justify-center h-32 w-32 rounded-full
                    bg-orange-100 dark:bg-orange-500/10
                    ring-8 ring-orange-50 dark:ring-orange-500/5">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-20 h-20 text-orange-500">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6h3m-6.75 3.75h10.5M5.25 9.75v7.5A2.25 2.25 0 007.5 19.5h9a2.25 2.25 0 002.25-2.25v-7.5M8.25 9.75V6.75A2.25 2.25 0 0110.5 4.5h3a2.25 2.25 0 012.25 2.25v3M12 13.5v3m0-3h.008v.008H12V13.5z" />

                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9.75h7.5" />
                    </svg>

                </div>

            </div>


            {{-- Status --}}
            <div class="flex justify-center mb-5">

                <span
                    class="inline-flex items-center gap-2 rounded-full
                    bg-orange-100 px-4 py-2
                    text-sm font-semibold text-orange-600
                    dark:bg-orange-500/10 dark:text-orange-400">

                    <span class="relative flex h-2.5 w-2.5">

                        <span
                            class="absolute inline-flex h-full w-full animate-ping
                            rounded-full bg-orange-400 opacity-75">
                        </span>

                        <span
                            class="relative inline-flex h-2.5 w-2.5
                            rounded-full bg-orange-500">
                        </span>

                    </span>

                    Maintenance Mode

                </span>

            </div>


            {{-- Heading --}}
            <h1
                class="text-4xl md:text-5xl lg:text-6xl
                font-bold tracking-tight
                text-gray-800 dark:text-white">

                We'll Be Back
                <span class="text-orange-500">Soon.</span>

            </h1>


            {{-- Description --}}
            <p
                class="max-w-2xl mx-auto mt-6
                text-lg md:text-xl
                leading-8 text-gray-500 dark:text-gray-300">

                We're currently giving our platform a little attention
                to make it faster, smoother, and even better.

                <br class="hidden sm:block">

                <span class="text-orange-500 font-medium">
                    Don't worry — we're not going anywhere.
                </span>

            </p>


            {{-- Arabic Message --}}
            <div class="mt-5 text-base md:text-lg
                text-gray-400 dark:text-gray-400" dir="rtl">

                الموقع قيد الصيانة مؤقتاً.
                نعمل على تحسين تجربتكم وسنعود قريباً بإذن الله.

            </div>


            {{-- UAE Notice --}}
            <div
                class="max-w-xl mx-auto mt-8
                rounded-2xl border border-orange-200
                bg-white p-5 shadow-sm
                dark:border-orange-500/20
                dark:bg-gray-900">

                <div class="flex items-center justify-center gap-3">

                    <span class="text-2xl">
                        🇦🇪
                    </span>

                    <div class="text-left">

                        <p class="font-semibold text-gray-800 dark:text-white">
                            Serving the UAE
                        </p>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            We'll be back shortly. Thank you for your patience.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Buttons --}}
            <div
                class="flex flex-col sm:flex-row
                justify-center items-center
                gap-4 mt-8">

                {{-- Contact --}}
                @if (isset($setting) && $setting->phone)
                    <a href="tel:{{ $setting->phone }}"
                        class="inline-flex items-center justify-center
                        gap-2 w-full sm:w-auto
                        bg-orange-500 hover:bg-orange-600
                        text-white font-semibold
                        py-3 px-7 rounded-xl
                        shadow-lg shadow-orange-500/20
                        transition duration-200">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                            stroke="currentColor" class="w-5 h-5">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372a1.5 1.5 0 00-1.06-1.432l-3.47-1.157a1.5 1.5 0 00-1.62.582l-.76 1.013a1.5 1.5 0 01-1.73.498 12.04 12.04 0 01-7.02-7.02 1.5 1.5 0 01.498-1.73l1.013-.76a1.5 1.5 0 00.582-1.62L7.077 3.31A1.5 1.5 0 005.645 2.25H4.5A2.25 2.25 0 002.25 4.5v2.25z" />

                        </svg>

                        Contact Us

                    </a>
                @endif


                {{-- Reload --}}
                <button type="button" onclick="window.location.reload()"
                    class="inline-flex items-center justify-center
                    gap-2 w-full sm:w-auto
                    border-2 border-orange-500
                    text-orange-600
                    hover:bg-orange-50
                    dark:text-orange-400
                    dark:hover:bg-orange-500/10
                    font-semibold
                    py-3 px-7 rounded-xl
                    transition duration-200">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="w-5 h-5">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992V4.356m-1.5 4.992a9 9 0 10.5 7.5" />

                    </svg>

                    Reload Page

                </button>

            </div>


            {{-- Fun message --}}
            <p class="mt-8 text-sm text-gray-400 dark:text-gray-500">

                Our developers are currently negotiating with the coffee machine. ☕
                <br>

                <span class="text-orange-500">
                    We expect a successful agreement very soon.
                </span>

            </p>


            {{-- Footer --}}
            <div class="mt-10 pt-6
                border-t border-gray-200
                dark:border-gray-800">

                <p class="text-xs text-gray-400 dark:text-gray-600">

                    &copy; {{ date('Y') }}
                    {{ config('app.name') }}.
                    All rights reserved.

                </p>

            </div>

        </div>

    </div>

</body>

</html>
