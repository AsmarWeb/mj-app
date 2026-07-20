<x-main-layout>

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <div class="min-h-screen">


        {{-- HERO --}}
        <div
            class="p-10 sm:p-10 m-5 rounded-3xl bg-gray-900 dark:bg-gray-900 dark:text-white bg-white text-black flex items-center justify-center overflow-hidden shadow-2xl">
            <div class="w-full max-w-6xl px-4 sm:px-6">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    <!-- Left Section: Text Content -->
                    <div class="flex flex-col justify-center text-center md:text-left z-10">
                        <span class="px-4 py-1 rounded-full text-orange-500 text-sm">
                            🚀 {{ __('discover.marketplace') }}
                        </span>
                        <h1
                            class="text-4xl sm:text-4xl md:text-5xl lg:text-8xl font-extrabold uppercase leading-tight tracking-tight">
                            {{ __('discover.Shopping with') }} <span
                                class="text-orange-500">{{ __('discover.murwaj') }}</span>
                        </h1>
                        <p
                            class="mt-4 text-base sm:text-lg md:text-xl font-medium text-gray-400 dark:text-gray-400 text-gray-700 text-balance">

                        </p>
                        <div class="mt-6 sm:mt-8 flex flex-wrap gap-4">
                            <a href="#products"
                                class="rounded-sm p-3 grow text-center bg-orange-500 text-black font-bold uppercase text-sm tracking-widest hover:bg-orange-600 transition">
                                {{ __('discover.explore store') }}
                            </a>
                            <a href="#creators"
                                class="rounded-sm p-3 grow border text-center border-orange-500 text-orange-500 font-bold uppercase text-sm tracking-widest hover:bg-orange-500 hover:text-black transition">
                                {{ __('discover.top creators') }}
                            </a>
                        </div>
                    </div>

                    <!-- Right Section: Visual Block -->
                    <div class="relative flex items-center sm:m-10">
                        <div
                            class="absolute -top-10 md:-top-20 -left-10 sm:w-32 sm:h-32 lg:w-64 lg:h-64 bg-orange-500 rotate-12 rounded-lg border-orange-700 border-b-4 border-r-8 max-sm:hidden">
                        </div>
                        <div
                            class="relative z-10 bg-gray-800 dark:bg-gray-800 p-4 sm:p-6 -right-1/2 -translate-x-1/2 grow text-center shadow-2xl -rotate-2 rounded-xl text-nowrap border-slate-950 border-b-4 border-r-8">
                            <h2 class="text-2xl sm:text-3xl font-bold uppercase text-gray-50 dark:text-gray-50">
                                {{ __('discover.buy') }}. {{ __('discover.rent') }}. {{ __('discover.booking') }}.
                            </h2>
                            <p class="mt-1 text-sm sm:text-base font-light text-gray-400 dark:text-gray-400">
                                {{ __('discover.Buy and sell everything from digital products to services.') }}
                            </p>
                        </div>
                        <div
                            class="absolute -bottom-10 md:-bottom-20 -right-16 sm:w-32 sm:h-32 lg:w-64 lg:h-64 bg-orange-500 -rotate-12 rounded-lg border-orange-700 border-r-4 border-b-8 max-sm:hidden">
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- CATEGORIES --}}

        <section class="max-w-7xl mx-auto px-6 py-12">


            <div class="flex justify-between items-center mb-8">

                <h2 class="text-3xl font-bold dark:text-white">
                    Explore Categories
                </h2>


                <a href="{{ route('categories.index') }}" class="text-indigo-600 font-semibold">

                    View All

                </a>


            </div>



            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-5">


                @foreach ($categories as $category)
                    @if (app()->getLocale() == 'ar')
                        <a href="{{ route('discover.category', $category->slug) }}"
                            class="bg-white rounded-2xl shadow hover:shadow-xl transition p-5 text-center">


                            <div class="h-20 w-20 mx-auto rounded-full bg-indigo-100 flex items-center justify-center">

                                @if ($category->image)
                                    <img src="{{ asset('storage/category-suggest/' . $category->image) }}"
                                        class="h-12">
                                @else
                                    🛍️
                                @endif

                            </div>


                            <h3 class="mt-4 font-semibold">

                                {{ $category->category_name_ar }}

                            </h3>


                        </a>
                    @else
                        <a href="{{ route('discover.category', $category->slug) }}"
                            class="bg-white rounded-2xl shadow hover:shadow-xl transition p-5 text-center">


                            <div class="h-20 w-20 mx-auto rounded-full bg-indigo-100 flex items-center justify-center">

                                @if ($category->image)
                                    <img src="{{ asset('storage/category-suggest/' . $category->image) }}"
                                        class="h-12">
                                @else
                                    🛍️
                                @endif

                            </div>


                            <h3 class="mt-4 font-semibold">

                                {{ $category->category_name }}

                            </h3>


                        </a>
                    @endif
                @endforeach


            </div>


        </section>








        {{-- FEATURED PRODUCTS --}}
        <section id="products" class="max-w-7xl mx-auto px-6 py-12">

            <div class="flex justify-between mb-8">

                <h2 class="text-3xl font-bold dark:text-white">
                    Featured Products
                </h2>

                <a href="#" class="text-blue-600 font-semibold">
                    View All →
                </a>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach ($featuredProducts as $product)
                    <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden group">

                        <div class="relative h-48 bg-gray-200">
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition">

                            <img src="{{ asset('watermark.png') }}" href="/" alt="Watermark"
                                class="absolute top-2 right-2 w-12 h-12 rounded-full border-2 border-orange-500"
                                style="position: absolute; top: 10px; right: 10px; width: 50px; height: 50px; border-radius: 50%; border: 2px solid white;">
                        </div>

                        <div class="p-5">

                            <div class="flex items-center">
                                {{-- <a href="#">
                                <img class="w-10 h-10 rounded-full mr-4" src="https://tailwindcss.com/img/jonathan.jpg"
                                    alt="Avatar of Jonathan Reinink">
                                </a> --}}
                                <div class="text-sm">
                                    <a href="{{ route('shop', $product->shop->slug) }}"
                                        class="text-orange-500 font-semibold leading-none hover:text-indigo-600 transition">
                                        By {{ $product->shop->name }}
                                    </a>
                                    {{-- <p class="text-gray-600">Aug 18</p> --}}
                                </div>
                            </div>

                            <h3 class="font-bold text-lg">
                                {{ $product->title }}
                            </h3>

                            <p class="text-gray-500 mt-2">
                                {{ $product->description = strlen($product->description) > 50 ? substr($product->description, 0, 50) . '...' : $product->description }}
                            </p>

                            <div class="flex justify-between items-center mt-5">

                                <span class="font-bold text-xl">
                                    ${{ $product->price }}
                                </span>

                                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                                    <a href="{{ $product->url }}">
                                        View
                                    </a>
                                </button>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </section>









        {{-- TRENDING --}}
        <section id="products" class="max-w-7xl mx-auto px-6 py-12">

            <div class="flex justify-between mb-8">

                <h2 class="text-3xl font-bold dark:text-white">
                    Trending Now 🔥
                </h2>

                <a href="#" class="text-blue-600 font-semibold">
                    View All →
                </a>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach ($trendingProducts as $product)
                    <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden group">

                        <div class="relative h-48 bg-gray-200">
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition">

                            <img src="{{ asset('watermark.png') }}" href="/" alt="Watermark"
                                class="absolute top-2 right-2 w-12 h-12 rounded-full border-2 border-orange-500"
                                style="position: absolute; top: 10px; right: 10px; width: 50px; height: 50px; border-radius: 50%; border: 2px solid white;">
                        </div>

                        <div class="p-5">

                            <div class="flex items-center">
                                {{-- <a href="#">
                                <img class="w-10 h-10 rounded-full mr-4" src="https://tailwindcss.com/img/jonathan.jpg"
                                    alt="Avatar of Jonathan Reinink">
                                </a> --}}
                                <div class="text-sm">
                                    <a href="{{ route('shop', $product->shop->slug) }}"
                                        class="text-orange-500 font-semibold leading-none hover:text-indigo-600 transition">
                                        By {{ $product->shop->name }}
                                    </a>
                                    {{-- <p class="text-gray-600">Aug 18</p> --}}
                                </div>
                            </div>

                            <h3 class="font-bold text-lg">
                                {{ $product->title }}
                            </h3>

                            <p class="text-gray-500 mt-2">
                                {{ $product->description = strlen($product->description) > 50 ? substr($product->description, 0, 50) . '...' : $product->description }}
                            </p>

                            <div class="flex justify-between items-center mt-5">

                                <span class="font-bold text-xl">
                                    ${{ $product->price }}
                                </span>

                                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                                    <a href="{{ $product->url }}">
                                        View
                                    </a>
                                </button>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </section>









        {{-- TOP SELLERS --}}
        <section id="creators" class="bg-white py-16">

            <div class="max-w-7xl mx-auto px-6">

                <div class="flex justify-between mb-10">

                    <h2 class="text-3xl font-bold">
                        Top Sellers
                    </h2>

                    <a href="#" class="text-blue-600">
                        View All
                    </a>

                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

                    @foreach ($shops as $shop)
                        <div class="rounded-2xl border p-6 text-center hover:shadow-xl transition">

                            @if ($shop->logo)
                                <img src="{{ Storage::disk('public')->url($shop->logo) }}"
                                    class="w-24 h-24 rounded-full mx-auto">
                            @else
                                <div
                                    class="flex h-full w-full items-center justify-center bg-gradient-to-br from-indigo-500 to-cyan-500 text-3xl font-semibold text-white">
                                    {{ strtoupper(substr($shop->name, 0, 1)) }}
                                </div>
                            @endif

                            <h3 class="mt-4 font-bold">
                                {{ $shop->name }}
                            </h3>

                            <p class="text-gray-500">
                                {{ $shop->type ?: 'murwaj seller' }}
                            </p>

                            <div class="flex justify-center gap-8 mt-5">

                                <div>
                                    <div class="font-bold">{{ $shop->listings_count }}</div>
                                    <div class="text-sm text-gray-400">Products</div>
                                </div>

                                <div>
                                    <div class="font-bold">{{ $shop->rating }}★</div>
                                    <div class="text-sm text-gray-400">Rating</div>
                                </div>

                            </div>

                            <a href="{{ route('shop', $shop->slug) }}" class="text-indigo-600">

                                Visit Shop

                            </a>

                        </div>
                    @endforeach

                </div>

            </div>

        </section>









        {{-- CTA SELL --}}

        <section class="max-w-7xl mx-auto px-6 py-16">


            <div class="rounded-3xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-12">


                <h2 class="text-4xl font-bold">

                    Start Selling Today

                </h2>


                <p class="mt-4 text-lg">

                    Create your shop and reach thousands of customers.

                </p>



                <a href="{{ route('shop.create', 1) }}"
                    class="inline-block mt-8 bg-white text-indigo-700 px-8 py-4 rounded-xl font-bold">

                    Open Your Shop

                </a>


            </div>


        </section>









        {{-- NEWSLETTER --}}

        <section class="bg-gray-900 text-white py-16">


            <div class="max-w-4xl mx-auto text-center px-6">


                <h2 class="text-3xl font-bold">

                    Join Murwaj Community

                </h2>


                <p class="mt-3 text-gray-300">

                    Get updates about new products, sellers and special offers.

                </p>



                <form class="mt-8 flex">

                    <input class="flex-1 rounded-l-xl text-gray-900 px-5" placeholder="Your email">


                    <button class="bg-indigo-600 px-8 rounded-r-xl">

                        Subscribe

                    </button>


                </form>


            </div>


        </section>



    </div>

    <x-main-footer></x-main-footer>
</x-main-layout>
