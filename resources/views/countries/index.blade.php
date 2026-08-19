@php
    $isArabic = app()->getLocale() === 'ar';

    $labels = [
        'marketplace' => $isArabic ? 'سوق دول مجلس التعاون' : 'GCC Marketplace',

        'hero_title' => $isArabic
            ? 'تسوق من متاجر موثوقة في دول الخليج'
            : 'Shop From Trusted Businesses Across GCC Countries',

        'hero_text' => $isArabic
            ? 'اكتشف آلاف المتاجر الموثوقة والعلامات المحلية والمنتجات المصنوعة يدوياً والخدمات في جميع أنحاء الخليج.'
            : 'Browse thousands of verified shops, local brands, handmade products, services, and businesses across the Gulf.',

        'explore_shops' => $isArabic ? 'استكشف المتاجر' : 'Explore Shops',
        'create_shop' => $isArabic ? 'إنشاء متجر' : 'Create Shop',

        'explore_markets' => $isArabic ? 'استكشف أسواق الخليج' : 'Explore GCC Markets',

        'find_businesses' => $isArabic
            ? 'اعثر على الشركات والمتاجر الموثوقة بالقرب منك.'
            : 'Find trusted businesses near you.',

        'shops' => $isArabic ? 'المتاجر' : 'Shops',
        'verified' => $isArabic ? 'موثوق' : 'Verified',

        'featured_shops' => $isArabic ? 'المتاجر المميزة' : 'Featured Shops',

        'no_shops' => $isArabic ? 'لا توجد متاجر بعد.' : 'No shops yet.',

        'location' => $isArabic ? 'الموقع' : 'Location',
    ];

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    $countryName = function ($country) use ($isArabic) {
        if ($isArabic) {
            return $country->name_ar ?: $country->name;
        }

        return $country->name;
    };

    $cityName = function ($city) use ($isArabic) {
        if (!$city) {
            return null;
        }

        return $isArabic ? ($city->name_ar ?: $city->name) : $city->name;
    };
@endphp


<x-main-layout>

    <x-slot name="header">
        <x-main-header />
    </x-slot>


    {{-- =========================================================
        HERO
    ========================================================== --}}

    <section class="relative overflow-hidden" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">

        {{-- Background --}}
        <div class="absolute inset-0 bg-gradient-to-br from-orange-500 via-orange-400 to-red-500"></div>

        <div class="absolute inset-0 bg-black/10"></div>


        <div class="relative max-w-7xl mx-auto px-6 py-24">

            <div class="max-w-4xl">

                {{-- Badge --}}
                <span
                    class="
                        inline-flex
                        items-center
                        px-5
                        py-2
                        rounded-full
                        bg-white/20
                        backdrop-blur
                        text-white
                        font-bold
                        shadow
                    ">
                    🌍 {{ $labels['marketplace'] }}
                </span>


                {{-- Heading --}}
                <h1
                    class="
                        mt-6
                        text-5xl
                        md:text-6xl
                        font-black
                        text-white
                        leading-tight
                    ">
                    {{ $labels['hero_title'] }}
                </h1>


                {{-- Description --}}
                <p
                    class="
                        mt-6
                        text-xl
                        text-white/90
                        max-w-3xl
                        leading-relaxed
                    ">
                    {{ $labels['hero_text'] }}
                </p>


                {{-- Actions --}}
                <div
                    class="
                        mt-8
                        flex
                        flex-wrap
                        gap-4
                    ">

                    <a href="#countries"
                        class="
                            bg-white
                            text-orange-600
                            px-8
                            py-4
                            rounded-full
                            font-black
                            shadow-xl
                            hover:scale-105
                            transition
                        ">
                        {{ $labels['explore_shops'] }}
                    </a>


                    <a href="{{ route('shop.create') }}"
                        class="
                            bg-black/20
                            backdrop-blur
                            text-white
                            px-8
                            py-4
                            rounded-full
                            font-black
                            hover:bg-black/30
                            transition
                        ">
                        {{ $labels['create_shop'] }}
                    </a>

                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
        COUNTRIES
    ========================================================== --}}

    <section id="countries"
        class="
            max-w-7xl
            mx-auto
            px-6
            py-16
        "
        dir="{{ $isArabic ? 'rtl' : 'ltr' }}">

        {{-- Section heading --}}
        <div class="mb-10">

            <h2
                class="
                    text-4xl
                    font-black
                    text-gray-900
                    dark:text-white
                ">
                {{ $labels['explore_markets'] }}
            </h2>

            <p class="mt-2 text-gray-500 dark:text-gray-400">
                {{ $labels['find_businesses'] }}
            </p>

        </div>



        {{-- Countries --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($countries as $country)
                <a href="#" class="group block">

                    <div
                        class="
                            overflow-hidden
                            rounded-3xl
                            bg-white
                            dark:bg-neutral-900
                            border
                            border-gray-100
                            dark:border-neutral-800
                            shadow-xl
                            hover:shadow-2xl
                            hover:-translate-y-1
                            transition
                            duration-300
                        ">


                        {{-- Country Header --}}
                        <div
                            class="
                                bg-gradient-to-br
                                from-orange-500
                                to-red-500
                                p-8
                            ">

                            <div class="flex justify-between items-center">

                                <span class="text-7xl">
                                    {{ $country->flag }}
                                </span>


                                <span
                                    class="
                                        bg-white/20
                                        backdrop-blur
                                        px-4
                                        py-2
                                        rounded-full
                                        text-white
                                        font-bold
                                    ">
                                    {{ $country->code }}
                                </span>

                            </div>

                        </div>



                        {{-- Country Body --}}
                        <div class="p-8">

                            <h2
                                class="
                                    text-3xl
                                    font-black
                                    text-gray-900
                                    dark:text-white
                                ">
                                {{ $countryName($country) }}
                            </h2>


                            @if ($isArabic && $country->name)
                                <p class="text-gray-500 mt-2">
                                    {{ $country->name }}
                                </p>
                            @elseif (!$isArabic && $country->name_ar)
                                <p class="text-gray-500 mt-2">
                                    {{ $country->name_ar }}
                                </p>
                            @endif



                            {{-- Stats --}}
                            <div class="grid grid-cols-2 gap-4 mt-8">

                                <div
                                    class="
                                        rounded-2xl
                                        bg-orange-50
                                        dark:bg-orange-500/10
                                        p-5
                                    ">

                                    <div
                                        class="
                                            text-3xl
                                            font-black
                                            text-orange-600
                                        ">
                                        {{ $country->shops_count }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ $labels['shops'] }}
                                    </div>

                                </div>



                                <div
                                    class="
                                        rounded-2xl
                                        bg-green-50
                                        dark:bg-green-500/10
                                        p-5
                                    ">

                                    <div
                                        class="
                                            text-3xl
                                            font-black
                                            text-green-600
                                        ">
                                        {{ $country->verified_shops_count }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ $labels['verified'] }}
                                    </div>

                                </div>

                            </div>



                            {{-- Featured Shops --}}
                            <div class="mt-8">

                                <h4
                                    class="
                                        font-black
                                        mb-4
                                        text-lg
                                        text-gray-900
                                        dark:text-white
                                    ">
                                    🏪 {{ $labels['featured_shops'] }}
                                </h4>


                                @forelse($country->shops as $shop)
                                    @php
                                        $shopName = $isArabic ? ($shop->name_ar ?: $shop->name) : $shop->name;

                                        $shopCity = $cityName($shop->city);
                                    @endphp


                                    <div
                                        class="
                                            flex
                                            items-center
                                            justify-between
                                            gap-4
                                            py-4
                                            border-b
                                            border-gray-100
                                            dark:border-neutral-800
                                            last:border-0
                                        ">

                                        <div class="min-w-0">

                                            <div
                                                class="
                                                    font-bold
                                                    text-gray-900
                                                    dark:text-white
                                                    truncate
                                                ">
                                                {{ $shopName }}
                                            </div>


                                            @if ($shopCity)
                                                <div
                                                    class="
                                                        text-sm
                                                        text-gray-500
                                                        dark:text-gray-400
                                                        mt-1
                                                    ">
                                                    📍 {{ $shopCity }}
                                                </div>
                                            @endif

                                        </div>


                                        <div
                                            class="
                                                shrink-0
                                                w-9
                                                h-9
                                                rounded-full
                                                bg-orange-100
                                                dark:bg-orange-500/20
                                                flex
                                                items-center
                                                justify-center
                                                text-orange-600
                                                group-hover:translate-x-1
                                                transition
                                            ">
                                            {{ $isArabic ? '←' : '→' }}
                                        </div>

                                    </div>

                                @empty

                                    <p class="text-gray-400">
                                        {{ $labels['no_shops'] }}
                                    </p>
                                @endforelse

                            </div>

                        </div>

                    </div>

                </a>
            @endforeach

        </div>

    </section>


    <x-main-footer />

</x-main-layout>
