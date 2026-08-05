<x-main-layout>

    <x-slot name="header">
        <x-main-header />
    </x-slot>


    <section class="relative overflow-hidden">


        {{-- BACKGROUND --}}
        <div
            class="
            absolute
            inset-0
            bg-gradient-to-br
            from-orange-500
            via-orange-400
            to-red-500
            ">
        </div>


        <div class="
            absolute
            inset-0
            bg-black/10
            ">
        </div>



        <div class="relative max-w-7xl mx-auto px-6 py-24">


            <div class="max-w-4xl">


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

                    🌍 GCC Marketplace

                </span>



                <h1
                    class="
                    mt-6
                    text-5xl
                    md:text-6xl
                    font-black
                    text-white
                    leading-tight
                    ">

                    Shop From Trusted
                    <br>

                    Businesses Across

                    <span class="text-yellow-300">

                        GCC Countries

                    </span>


                </h1>



                <p
                    class="
                    mt-6
                    text-xl
                    text-white/90
                    max-w-3xl
                    leading-relaxed
                    ">

                    Browse thousands of verified shops, local brands, handmade products,
                    services, and businesses across the Gulf.


                </p>



                <div class="mt-8 flex gap-4">


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

                        Explore Shops

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

                        Create Shop

                    </a>


                </div>


            </div>


        </div>


    </section>






    {{-- COUNTRIES --}}

    <section id="countries" class="
        max-w-7xl
        mx-auto
        px-6
        py-16
        ">


        <div class="mb-10">


            <h2
                class="
                text-4xl
                font-black
                text-gray-900
                dark:text-white
                ">

                Explore GCC Markets

            </h2>


            <p class="
                mt-2
                text-gray-500
                ">

                Find trusted businesses near you.

            </p>


        </div>





        <div class="grid lg:grid-cols-3 gap-8">


            @foreach ($countries as $country)
                <a href="#" class="group">


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
                        transition
                        duration-300
                        ">



                        {{-- HEADER --}}


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







                        {{-- BODY --}}


                        <div class="p-8">


                            <h2
                                class="
                                text-3xl
                                font-black
                                text-gray-900
                                dark:text-white
                                ">

                                {{ $country->name }}

                            </h2>



                            <p class="text-gray-500 mt-2">

                                {{ $country->name_ar }}

                            </p>







                            {{-- STATS --}}


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

                                        Shops

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

                                        Verified

                                    </div>


                                </div>


                            </div>









                            {{-- SHOPS --}}


                            <div class="mt-8">


                                <h4
                                    class="
                                    font-black
                                    mb-4
                                    text-lg
                                    dark:text-white
                                    ">

                                    🏪 Featured Shops

                                </h4>




                                @forelse($country->shops as $shop)
                                    <div
                                        class="
                                        flex
                                        items-center
                                        justify-between
                                        py-4
                                        border-b
                                        dark:border-neutral-800
                                        ">


                                        <div>


                                            <div
                                                class="
                                                font-bold
                                                dark:text-white
                                                ">

                                                {{ $shop->name }}

                                            </div>



                                            <div
                                                class="
                                                text-sm
                                                text-gray-500
                                                ">

                                                📍 {{ $shop->city->name }}

                                            </div>


                                        </div>




                                        <div
                                            class="
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

                                            →

                                        </div>


                                    </div>



                                @empty


                                    <p class="text-gray-400">

                                        No shops yet.

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
