<x-main-layout>
    @section('title', 'Selling on murwaj | Your Creative Marketplace')
    @section('description',
        'Discover how to sell your digital products on Murwaj, the leading creative marketplace.
        Join our community of talented creators and start earning from your work today.')
        <x-slot name="header">
            <x-main-header></x-main-header>
        </x-slot>
        <div class="min-h-screen">

            <!-- Hero Section -->
            <section class="container mx-auto px-6 py-20">
                <div class="grid lg:grid-cols-2 gap-12 items-center">

                    <!-- Left Content -->
                    <div>
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-orange-700 font-medium">
                            🚀 Start Selling Today
                        </span>

                        <h1 class="mt-6 text-5xl font-bold text-gray-900 dark:text-gray-300 leading-tight">
                            {{ __('sell.main.title') }}
                        </h1>

                        <p class="mt-6 text-lg text-gray-600 dark:text-gray-300">
                            {{ __('sell.main.subtitle') }}
                        </p>

                        <div class="mt-8 flex flex-wrap gap-4">

                            @if (Route::has('login'))
                                @auth
                                    @if (!auth()->user()->shop)
                                        <a href="{{ route('shop.create') }}"
                                            class="px-8 py-4 bg-orange-600 text-white rounded-xl font-semibold shadow-lg hover:bg-[#131A22] dark:hover:bg-gray-300 transition">
                                            {{ __('sell.card.started') }}
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                        class="px-8 py-4 bg-orange-600 text-white rounded-xl font-semibold shadow-lg hover:bg-[#131A22] dark:hover:bg-gray-300 transition">
                                        {{ __('sell.card.started') }}
                                    </a>
                                @endif
                            @endauth


                            <a href="#features"
                                class="px-8 py-4 border border-gray-300 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-50 transition">
                                Learn More
                            </a>
                        </div>

                        <div class="mt-10 flex gap-8">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-300">10K+</h3>
                                <p class="text-gray-500 dark:text-gray-400">Active Sellers</p>
                            </div>

                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-300">50K+</h3>
                                <p class="text-gray-500 dark:text-gray-400">Products Listed</p>
                            </div>

                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-300">99%</h3>
                                <p class="text-gray-500 dark:text-gray-400">Customer Satisfaction</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Illustration -->
                    <div>
                        <div class="bg-white rounded-3xl shadow-2xl p-8">
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-40 rounded-2xl"></div>

                            <div class="mt-6">
                                <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                <div class="h-4 bg-gray-100 rounded w-1/2 mt-3"></div>

                                <div class="grid grid-cols-2 gap-4 mt-6">
                                    <div class="bg-gray-100 h-32 rounded-xl"></div>
                                    <div class="bg-gray-100 h-32 rounded-xl"></div>
                                </div>

                                <button class="w-full mt-6 bg-indigo-500 text-white py-3 rounded-xl font-semibold">
                                    Your Shop Preview
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Features -->
            <section id="features" class="container mx-auto px-6 py-20">
                <div class="text-center mb-14">
                    <h2 class="text-4xl font-bold text-gray-900 dark:text-white">
                        Everything You Need to Sell
                    </h2>
                    <p class="mt-4 text-gray-600 dark:text-gray-300">
                        Powerful tools to launch and grow your online business.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">

                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition">
                        <div class="text-4xl mb-4">🛍️</div>
                        <h3 class="font-bold text-xl mb-3">Custom Storefront</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Create a beautiful branded shop page for your customers.
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition">
                        <div class="text-4xl mb-4">📦</div>
                        <h3 class="font-bold text-xl mb-3">Easy Product Management</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Add products, pricing, inventory, and images effortlessly.
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition">
                        <div class="text-4xl mb-4">💳</div>
                        <h3 class="font-bold text-xl mb-3">Secure Payments</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Receive payments safely with integrated checkout systems.
                        </p>
                    </div>

                </div>
            </section>

            <!-- CTA -->
            <section class="container mx-auto px-6 pb-20">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl p-12 text-center text-white">
                    <h2 class="text-4xl font-bold">
                        Ready to Launch Your Shop?
                    </h2>

                    <p class="mt-4 text-indigo-100 max-w-2xl mx-auto">
                        Join thousands of entrepreneurs already selling online.
                        Create your shop and start receiving orders today.
                    </p>

                    @if (Route::has('login'))
                        @auth
                            @if (!auth()->user()->shop)
                                <a href="{{ route('shop.create') }}"
                                    class="inline-block mt-8 px-10 py-4 bg-white text-indigo-600 rounded-xl font-bold hover:bg-gray-100 transition">
                                    Start Selling Now
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="inline-block mt-8 px-10 py-4 bg-white text-indigo-600 rounded-xl font-bold hover:bg-gray-100 transition">
                                Start Selling Now
                            </a>
                        @endif
                    @endauth
                </div>
            </section>

        </div>
        <x-main-footer></x-main-footer>
    </x-main-layout>
