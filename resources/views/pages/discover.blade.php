<x-main-layout>
    @section('title', 'Discover | murwaj')
    @section('description', "$description")
    @section('keywords', "$keywords")


    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <!-- Hero -->
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

    <!-- Categories -->

    <section class="max-w-7xl mx-auto px-6 py-12">

        <div class="flex flex-wrap gap-4">

            @foreach ($categories as $category)
                @if (count($category['subcategories']) > 0)
                    @if (app()->getLocale() == 'ar')
                        <a href="{{ route('discover.category', ['category' => $category->id]) }}"
                            class="px-5 py-2 rounded-full bg-white shadow hover:bg-blue-600 hover:text-white transition">
                            {{ $category->category_name_ar }}
                        </a>
                    @else
                        <a href="{{ route('discover.category', ['category' => $category->id]) }}"
                            class="px-5 py-2 rounded-full bg-white shadow hover:bg-blue-600 hover:text-white transition">
                            {{ $category->category_name }}
                        </a>
                    @endif
                @endif
            @endforeach


        </div>

    </section>

    <!-- Products -->

    <section id="products" class="max-w-7xl mx-auto px-6 py-12">

        <div class="flex justify-between mb-8">

            <h2 class="text-3xl font-bold">
                Listings
            </h2>

            <a href="#" class="text-blue-600 font-semibold">
                View All →
            </a>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach ($listings as $listing)
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden group">

                    <div class="relative h-48 bg-gray-200">
                        <img src="{{ asset('storage/products/' . $listing->image) }}" alt="{{ $listing->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition">

                        <img src="{{ asset('watermark.png') }}" href="/" alt="Watermark"
                            class="absolute top-2 right-2 w-12 h-12 rounded-full border-2 border-orange-500"
                            style="position: absolute; top: 10px; right: 10px; width: 50px; height: 50px; border-radius: 50%; border: 2px solid white;">
                    </div>

                    <div class="p-5">

                        <h3 class="font-bold text-lg">
                            {{ $listing->title }}
                        </h3>

                        <p class="text-gray-500 mt-2">
                            {{ $listing->description = strlen($listing->description) > 50 ? substr($listing->description, 0, 50) . '...' : $listing->description }}
                        </p>

                        <div class="flex justify-between items-center mt-5">

                            <span class="font-bold text-xl">
                                ${{ $listing->price }}
                            </span>

                            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                                <a href="{{ route('listing.show', ['listing' => $listing->id]) }}">
                                    View
                                </a>
                            </button>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </section>

    <!-- Creators -->

    <section id="creators" class="bg-white py-16">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between mb-10">

                <h2 class="text-3xl font-bold">
                    Top Creators
                </h2>

                <a href="#" class="text-blue-600">
                    View All
                </a>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

                @for ($i = 1; $i <= 4; $i++)
                    <div class="rounded-2xl border p-6 text-center hover:shadow-xl transition">

                        <img src="https://i.pravatar.cc/150?img={{ $i + 10 }}"
                            class="w-24 h-24 rounded-full mx-auto">

                        <h3 class="mt-4 font-bold">
                            Creator {{ $i }}
                        </h3>

                        <p class="text-gray-500">
                            Laravel Expert
                        </p>

                        <div class="flex justify-center gap-8 mt-5">

                            <div>
                                <div class="font-bold">120</div>
                                <div class="text-sm text-gray-400">Products</div>
                            </div>

                            <div>
                                <div class="font-bold">4.9★</div>
                                <div class="text-sm text-gray-400">Rating</div>
                            </div>

                        </div>

                    </div>
                @endfor

            </div>

        </div>

    </section>

    <!-- Collections -->

    <section class="max-w-7xl mx-auto px-6 py-16">

        <h2 class="text-3xl font-bold mb-8">
            Trending Collections
        </h2>

        <div class="grid lg:grid-cols-3 gap-8">

            @foreach (['Admin Dashboards', 'Landing Pages', 'E-Commerce'] as $item)
                <div class="rounded-3xl overflow-hidden shadow bg-white">

                    <div class="h-48 bg-gradient-to-r from-indigo-500 to-cyan-500"></div>

                    <div class="p-6">

                        <h3 class="font-bold text-xl">
                            {{ $item }}
                        </h3>

                        <p class="mt-3 text-gray-500">
                            Hand-picked premium templates and products.
                        </p>

                    </div>

                </div>
            @endforeach

        </div>

    </section>

    <!-- Features -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-center text-4xl font-bold mb-14">
                Why Choose Our Marketplace?
            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                @foreach (['Verified Creators', 'Instant Downloads', 'Secure Payments', '24/7 Support'] as $feature)
                    <div class="text-center">

                        <div
                            class="w-16 h-16 mx-auto rounded-2xl bg-blue-100 flex items-center justify-center text-3xl">
                            ⭐
                        </div>

                        <h3 class="font-bold mt-5">
                            {{ $feature }}
                        </h3>

                        <p class="text-gray-500 mt-3">
                            Premium experience with trusted developers.
                        </p>

                    </div>
                @endforeach

            </div>

        </div>

    </section>

    <!-- CTA -->

    <section class="bg-gradient-to-r from-blue-600 to-indigo-700">

        <div class="max-w-6xl mx-auto px-6 py-20 text-center">

            <h2 class="text-5xl font-bold text-white">
                Start Selling Today
            </h2>

            <p class="text-blue-100 mt-5 text-lg">
                Join thousands of creators and grow your digital business.
            </p>

            <button class="mt-8 px-8 py-4 rounded-xl bg-white text-blue-700 font-bold hover:scale-105 transition">
                <div class="flex items-center justify-center gap-2">
                    <a href="{{ route('sell') }}" class="text-lg font-semibold">
                        Build Your Shop
                    </a>
                </div>
            </button>

        </div>

    </section>

    <x-main-footer></x-main-footer>
</x-main-layout>
