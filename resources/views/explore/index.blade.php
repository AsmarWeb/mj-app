<x-app-layout>

    <div class="bg-gray-50 min-h-screen">


        {{-- HERO --}}
        <section class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 text-white">

            <div class="max-w-7xl mx-auto px-6 py-24">

                <div class="max-w-3xl">

                    <h1 class="text-5xl font-extrabold leading-tight">
                        Discover unique products from creative sellers
                    </h1>

                    <p class="mt-5 text-xl text-white/90">
                        Shop handmade items, digital products, services and exclusive
                        collections from independent creators.
                    </p>


                    <form action="#" method="GET" class="mt-8 flex bg-white rounded-2xl overflow-hidden shadow-xl">

                        <input name="q" placeholder="Search products, categories, shops..."
                            class="flex-1 px-6 py-4 text-gray-800 outline-none">


                        <button class="px-8 bg-gray-900 text-white font-bold">

                            Search

                        </button>


                    </form>


                </div>


            </div>

        </section>







        {{-- CATEGORIES --}}

        <section class="max-w-7xl mx-auto px-6 py-12">


            <div class="flex justify-between items-center mb-8">

                <h2 class="text-3xl font-bold">
                    Explore Categories
                </h2>


                <a href="{{ route('categories.index') }}" class="text-indigo-600 font-semibold">

                    View All

                </a>


            </div>



            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-5">


                @foreach ($categories as $category)
                    <a href="{{ route('discover.category', $category->slug) }}"
                        class="bg-white rounded-2xl shadow hover:shadow-xl transition p-5 text-center">


                        <div class="h-20 w-20 mx-auto rounded-full bg-indigo-100 flex items-center justify-center">

                            @if ($category->icon)
                                <img src="{{ asset('storage/' . $category->icon) }}" class="h-12">
                            @else
                                🛍️
                            @endif

                        </div>


                        <h3 class="mt-4 font-semibold">

                            {{ $category->name }}

                        </h3>


                    </a>
                @endforeach


            </div>


        </section>








        {{-- FEATURED PRODUCTS --}}

        <section class="max-w-7xl mx-auto px-6 py-12">


            <h2 class="text-3xl font-bold mb-8">

                Featured Products

            </h2>



            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">


                @foreach ($featuredProducts as $product)
                    <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition">


                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-64 object-cover">


                        <div class="p-5">


                            <h3 class="font-bold text-lg">

                                {{ $product->name }}

                            </h3>


                            <p class="text-gray-500 text-sm">

                                {{ $product->shop->name }}

                            </p>



                            <div class="flex justify-between items-center mt-4">


                                <span class="text-xl font-bold text-indigo-600">

                                    ${{ $product->price }}

                                </span>


                                <a href="{{ route('product.show', $product->slug) }}" class="text-indigo-600">

                                    View

                                </a>


                            </div>


                        </div>


                    </div>
                @endforeach


            </div>


        </section>









        {{-- TRENDING --}}

        <section class="bg-white py-16">


            <div class="max-w-7xl mx-auto px-6">


                <h2 class="text-3xl font-bold mb-8">

                    Trending Now 🔥

                </h2>



                <div class="grid md:grid-cols-4 gap-6">


                    @foreach ($trendingProducts as $product)
                        <div class="border rounded-2xl p-5">

                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="h-40 w-full object-cover rounded-xl">


                            <h3 class="font-bold mt-4">

                                {{ $product->name }}

                            </h3>


                            <div class="text-yellow-500 mt-2">

                                ★★★★★

                            </div>


                        </div>
                    @endforeach


                </div>


            </div>


        </section>









        {{-- TOP SELLERS --}}

        <section class="max-w-7xl mx-auto px-6 py-12">


            <h2 class="text-3xl font-bold mb-8">

                Top Sellers

            </h2>



            <div class="grid md:grid-cols-4 gap-6">


                @foreach ($shops as $shop)
                    <div class="bg-white rounded-2xl shadow p-6 text-center">


                        <img src="{{ asset('storage/' . $shop->logo) }}"
                            class="w-24 h-24 rounded-full mx-auto object-cover">


                        <h3 class="font-bold mt-4">

                            {{ $shop->name }}

                        </h3>


                        <a href="{{ route('shop', $shop->slug) }}" class="text-indigo-600">

                            Visit Shop

                        </a>


                    </div>
                @endforeach


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

</x-app-layout>
