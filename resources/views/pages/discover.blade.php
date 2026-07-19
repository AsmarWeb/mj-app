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
                        <a href="{{ route('discover.category', ['slug' => $category->slug]) }}"
                            class="px-5 py-2 rounded-full bg-white shadow hover:bg-blue-600 hover:text-white transition">
                            {{ $category->category_name_ar }}
                        </a>
                    @else
                        <a href="{{ route('discover.category', ['slug' => $category->slug]) }}"
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

            <h2 class="text-3xl font-bold dark:text-white">
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

                        <div class="flex items-center">
                            {{-- <a href="#">
                                <img class="w-10 h-10 rounded-full mr-4" src="https://tailwindcss.com/img/jonathan.jpg"
                                    alt="Avatar of Jonathan Reinink">
                                </a> --}}
                            <div class="text-sm">
                                <a href="{{ route('shop', $listing->shop->slug) }}"
                                    class="text-orange-500 font-semibold leading-none hover:text-indigo-600 transition">
                                    By {{ $listing->shop->name }}
                                </a>
                                {{-- <p class="text-gray-600">Aug 18</p> --}}
                            </div>
                        </div>

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
                                <a
                                    href="{{ route('listing.show', [
                                        'shop' => $listing->shop->slug,
                                        'section' => $listing->section->slug,
                                        'category' => $listing->category->slug,
                                        'subcategories' => $listing->subcategories->slug,
                                        'brand' => $listing->brand->slug,
                                        'listing' => $listing->slug,
                                    ]) }}">
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

                @foreach ($topCreators as $shop)
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
                            {{ $shop->user->name }}
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

                    </div>
                @endforeach

            </div>

        </div>

    </section>

    <!-- Shops -->

    <section class="max-w-7xl mx-auto px-6 py-16">

        <div class="flex justify-between mb-10">
            <h2 class="text-3xl font-bold mb-8 dark:text-white">
                Popular shops
            </h2>

            <a href="#" class="text-blue-600">
                View All
            </a>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            @foreach ($shops as $shop)
                <div
                    class="relative h-96 px-5 py-8 group transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 rounded-3xl bg-gray-200 overflow-hidden shadow-xl">

                    @if ($shop->logo)
                        <img src="{{ Storage::disk('public')->url($shop->logo) }}" alt="{{ $shop->name }}"
                            class="absolute w-full h-full inset-0 object-cover">
                    @else
                        <div
                            class="flex h-full w-full items-center justify-center bg-gradient-to-br from-indigo-500 to-cyan-500 text-3xl font-semibold text-white">
                            {{ strtoupper(substr($shop->name, 0, 1)) }}
                        </div>
                    @endif

                    <div
                        class="absolute inset-0 w-full h-full rounded-3xl bg-black bg-opacity-0 transition duration-500 backdrop-filter group-hover:bg-opacity-20 group-hover:backdrop-blur">
                    </div>

                    <div class="absolute inset-x-5 text-white">
                        <h2 class="text-4xl font-semibold mb-2">{{ $shop->name }}</h2>
                        <p class="text-sm font-medium uppercase tracking-wider mb-6">{{ $shop->type ?: 'Online shop' }}
                        </p>
                        <p class="hidden group-hover:block">
                            {{ $shop->description = strlen($shop->description) > 50 ? substr($shop->description, 0, 50) . '...' : $shop->description }}
                        </p>
                    </div>

                    <button onclick="window.location.href='{{ route('shop', $shop->slug) }}'"
                        class="absolute inset-x-5 bottom-8 py-3 rounded-2xl font-semibold bg-white shadow-lg hidden transition duration-200 hover:bg-gray-300 group-hover:block">
                        Shop now
                    </button>
                </div>
                {{ $shops->links() }}
            @endforeach

        </div>

    </section>

    <!-- Features -->

    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-center text-4xl font-bold mb-14">
                Why Choose Our Marketplace?
            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach (['Verified Creators', 'Secure Payments', '24/7 Support'] as $feature)
                    <div class="text-center">

                        <div
                            class="w-16 h-16 mx-auto rounded-2xl bg-blue-100 flex items-center justify-center text-3xl">
                            ⭐
                        </div>

                        <h3 class="font-bold mt-5">
                            {{ $feature }}
                        </h3>

                        <p class="text-gray-500 mt-3">

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
                Join thousands of creators and grow your business.
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
