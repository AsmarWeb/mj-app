<x-main-layout>
    @section('title', 'Discover | murwaj')
    @section('description', "$description")
    @section('keywords', "$keywords")


    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <!-- Hero -->
    <section class="bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-500">
        <div class="max-w-7xl mx-auto px-6 py-20">

            <div class="grid lg:grid-cols-2 gap-10 items-center">

                <div>

                    <span class="px-4 py-1 rounded-full bg-white/20 text-white text-sm">
                        🚀 Marketplace
                    </span>

                    <h1 class="mt-6 text-5xl font-extrabold text-white leading-tight">
                        Discover Amazing
                        Digital Products
                    </h1>

                    <p class="mt-6 text-lg text-blue-100">
                        Premium Laravel packages, templates, UI kits,
                        plugins, themes and tools from the world's best creators.
                    </p>

                    <div class="flex gap-4 mt-8">

                        <a href="#products"
                            class="px-6 py-3 rounded-xl bg-white text-blue-600 font-semibold hover:bg-gray-100 transition">
                            Explore Store
                        </a>

                        <a href="#creators"
                            class="px-6 py-3 rounded-xl border border-white text-white hover:bg-white hover:text-blue-600 transition">
                            Top Creators
                        </a>

                    </div>

                </div>

                <div>

                    <div class="bg-white rounded-3xl shadow-2xl p-6">

                        <input
                            class="w-full rounded-xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="Search products, creators...">

                        <div class="grid grid-cols-2 gap-4 mt-6">

                            <div class="rounded-xl bg-blue-50 p-4">
                                <p class="text-sm text-gray-500">Products</p>
                                <h2 class="text-3xl font-bold">12.4K</h2>
                            </div>

                            <div class="rounded-xl bg-green-50 p-4">
                                <p class="text-sm text-gray-500">Creators</p>
                                <h2 class="text-3xl font-bold">850+</h2>
                            </div>

                            <div class="rounded-xl bg-yellow-50 p-4">
                                <p class="text-sm text-gray-500">Downloads</p>
                                <h2 class="text-3xl font-bold">1.8M</h2>
                            </div>

                            <div class="rounded-xl bg-pink-50 p-4">
                                <p class="text-sm text-gray-500">Reviews</p>
                                <h2 class="text-3xl font-bold">92K</h2>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- Categories -->

    <section class="max-w-7xl mx-auto px-6 py-12">

        <div class="flex flex-wrap gap-4">

            @foreach (['Laravel', 'Tailwind', 'Vue', 'React', 'Admin', 'Dashboard', 'E-Commerce', 'API', 'Templates', 'UI Kits'] as $cat)
                <button class="px-5 py-2 rounded-full bg-white shadow hover:bg-blue-600 hover:text-white transition">
                    {{ $cat }}
                </button>
            @endforeach

        </div>

    </section>

    <!-- Products -->

    <section id="products" class="max-w-7xl mx-auto px-6 py-12">

        <div class="flex justify-between mb-8">

            <h2 class="text-3xl font-bold">
                Featured Products
            </h2>

            <a href="#" class="text-blue-600 font-semibold">
                View All →
            </a>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

            @for ($i = 1; $i <= 8; $i++)
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden group">

                    <div class="h-44 bg-gradient-to-r from-blue-500 to-cyan-400"></div>

                    <div class="p-5">

                        <h3 class="font-bold text-lg">
                            Laravel Dashboard {{ $i }}
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Modern admin panel with authentication.
                        </p>

                        <div class="flex justify-between items-center mt-5">

                            <span class="font-bold text-xl">
                                $49
                            </span>

                            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                                View
                            </button>

                        </div>

                    </div>

                </div>
            @endfor

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
                Build Your Shop
            </button>

        </div>

    </section>

    <x-main-footer></x-main-footer>
</x-main-layout>
