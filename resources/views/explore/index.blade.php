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


        {{-- MARKETPLACE SECTIONS --}}
        <section class="max-w-7xl mx-auto px-6 py-10">

            <div class="flex items-center justify-between mb-8">

                <div>

                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                        Browse Marketplace
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Choose how you'd like to explore Murwaj.
                    </p>

                </div>

            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

                @foreach ($sections as $section)
                    <a href="{{ route('explore', ['section' => $section->slug]) }}"
                        class="group rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                        <div class="flex justify-center">

                            <div
                                class="w-20 h-20 rounded-2xl bg-orange-50 dark:bg-gray-700 flex items-center justify-center">

                                <img src="{{ asset('storage/section-suggest/' . $section->image) }}"
                                    alt="{{ $section->name }}" class="w-12 h-12 object-contain">

                            </div>

                        </div>

                        <h3 class="mt-5 text-lg font-bold text-center text-gray-900 dark:text-white">

                            {{ app()->getLocale() == 'ar' ? $section->name_ar : $section->name }}

                        </h3>

                        <p class="mt-2 text-center text-sm text-gray-500">

                            @switch($section->slug)
                                @case('sales')
                                    Buy products from trusted sellers.
                                @break

                                @case('rental')
                                    Rent products and equipment.
                                @break

                                @case('real-estate')
                                    Find homes, offices and land.
                                @break

                                @case('auction')
                                    Bid on exclusive listings.
                                @break

                                @case('events')
                                    Discover local events.
                                @break
                            @endswitch

                        </p>

                        <div class="mt-5 text-center">

                            <span
                                class="inline-flex items-center font-semibold text-orange-500 group-hover:gap-2 transition-all">

                                Explore →

                            </span>

                        </div>

                    </a>
                @endforeach

            </div>

        </section>


        {{-- Products --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

            @forelse($listings as $listing)
                <div class="bg-white rounded-2xl shadow overflow-hidden hover:shadow-xl transition">

                    <img src="{{ asset('storage/products/' . $listing->image) }}" class="w-full h-52 object-cover">

                    <div class="p-5">

                        <span class="text-xs text-orange-500 font-semibold uppercase">
                            {{ $listing->section->name }}
                        </span>

                        <h2 class="mt-2 font-bold text-lg">
                            {{ $listing->title }}
                        </h2>

                        <p class="text-gray-500 mt-2 line-clamp-2">
                            {{ Str::limit($listing->description, 80) }}
                        </p>

                        <div class="flex justify-between items-center mt-5">

                            <span class="text-xl font-bold">
                                ${{ number_format($listing->price, 2) }}
                            </span>

                            <a href="{{ $listing->url }}"
                                class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">

                                View

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-full text-center py-20">

                    <h2 class="text-2xl font-bold">
                        No products found
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Try another section.
                    </p>

                </div>
            @endforelse

        </div>


        <div class="mt-10">

            {{ $listings->withQueryString()->links() }}

        </div>

    </div>



    {{-- CATEGORIES --}}

    <section class="max-w-7xl mx-auto px-6 py-12">


        <div class="flex justify-between items-center mb-8">

            <h2 class="text-3xl font-bold dark:text-white">
                Explore Categories
            </h2>


            <a href="{{ route('categories') }}" class="text-indigo-600 font-semibold">

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
                                <img src="{{ asset('storage/category-suggest/' . $category->image) }}" class="h-12">
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
                                <img src="{{ asset('storage/category-suggest/' . $category->image) }}" class="h-12">
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



    {{-- DIGITAL PRODUCTS --}}
    <section class="max-w-7xl mx-auto px-6 py-12">

        <div class="flex justify-between mb-8">

            <div>

                <h2 class="text-3xl font-bold dark:text-white">
                    Creative Digital Products
                </h2>

                <p class="text-gray-500 mt-2">
                    Templates, designs, software and creative assets.
                </p>

            </div>


            <a href="{{ route('digital-products.index') }}" class="text-orange-500 font-semibold">

                View All →

            </a>

        </div>



        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">


            @forelse($digitalProducts as $product)
                <div class="bg-white rounded-3xl shadow hover:shadow-xl transition overflow-hidden group">


                    {{-- IMAGE --}}
                    <div class="relative h-56 overflow-hidden">


                        <img src="{{ asset('storage/' . $product->image) }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition">


                        @if ($product->featured)
                            <span
                                class="absolute top-3 left-3 bg-orange-500 text-white px-3 py-1 rounded-full text-xs">

                                Featured

                            </span>
                        @endif


                        @if ($product->is_free)
                            <span
                                class="absolute top-3 right-3 bg-green-600 text-white px-3 py-1 rounded-full text-xs">

                                FREE

                            </span>
                        @endif


                    </div>





                    <div class="p-5">


                        {{-- CATEGORY --}}

                        <span class="text-xs text-orange-500 font-semibold uppercase">

                            {{ $product->category->category_name ?? 'Digital' }}

                        </span>



                        <h3 class="font-bold text-lg mt-2 line-clamp-1">

                            {{ app()->getLocale() == 'ar' ? $product->title_ar : $product->title }}

                        </h3>




                        <p class="text-gray-500 text-sm mt-2 line-clamp-2">

                            {{ Str::limit(app()->getLocale() == 'ar' ? $product->description_ar : $product->description, 80) }}

                        </p>





                        <div class="flex justify-between items-center mt-5">


                            <div>

                                @if ($product->is_free)
                                    <span class="text-green-600 font-bold">
                                        Free
                                    </span>
                                @else
                                    <span class="font-bold text-xl">
                                        ${{ number_format($product->price, 2) }}
                                    </span>
                                @endif

                            </div>




                            <a href="{{ route('digital-products.show', $product->slug) }}"
                                class="bg-orange-500 text-white px-4 py-2 rounded-xl hover:bg-orange-600">

                                View

                            </a>


                        </div>



                        <div class="mt-3 text-xs text-gray-400">

                            {{ number_format($product->downloads) }} downloads

                        </div>



                    </div>


                </div>



            @empty


                <div class="col-span-full text-center py-20">

                    <h3 class="text-xl font-bold">
                        No digital products yet
                    </h3>

                    <p class="text-gray-500">
                        Upload your first creative product.
                    </p>

                </div>
            @endforelse


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

    <section class="py-24">

        <div class="max-w-6xl mx-auto rounded-[40px] bg-orange-500 p-16 text-white">

            <h2 class="text-5xl font-black">

                Open your own shop.

            </h2>

            <p class="mt-6 text-xl">

                Millions of buyers are waiting.

            </p>

            <a href="{{ route('shop.create', 1) }}"
                class="mt-10 inline-block bg-white text-orange-600 px-10 py-4 rounded-full font-bold">

                Start Selling

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



            @livewire('newsletter.subscribe')


        </div>


    </section>



    </div>

    <x-main-footer></x-main-footer>
</x-main-layout>
