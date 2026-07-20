<x-main-layout>

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <div class="min-h-screen">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <div class="text-center mb-12">

                <h1 class="text-5xl font-bold text-slate-900 dark:text-white">
                    Sitemap
                </h1>

                <p class="mt-4 text-lg text-slate-600 dark:text-white">
                    Quickly navigate every major section of murwaj Marketplace.
                </p>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                {{-- Marketplace --}}
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-bold mb-4">
                        Marketplace
                    </h2>

                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-indigo-600 hover:underline">Home</a></li>
                        <li><a href="{{ route('explore') }}" class="text-indigo-600 hover:underline">Marketplace</a>
                        </li>
                        <li><a href="{{ route('categories.index') }}"
                                class="text-indigo-600 hover:underline">Categories</a></li>
                        <li><a href="{{ route('plans.index') }}" class="text-indigo-600 hover:underline">Pricing</a>
                        </li>
                    </ul>
                </div>

                {{-- Categories --}}
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-bold mb-4">
                        Categories
                    </h2>

                    <ul class="space-y-2">
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('discover.category', $category->slug) }}"
                                    class="text-slate-700 hover:text-indigo-600">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Shops --}}
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-bold mb-4">
                        Shops
                    </h2>

                    <ul class="space-y-2">
                        @foreach ($shops as $shop)
                            <li>
                                <a href="{{ route('shop', $shop->slug) }}" class="text-slate-700 hover:text-indigo-600">
                                    {{ $shop->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Countries --}}
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-bold mb-4">
                        🌍 Browse by Country
                    </h2>

                    <ul class="space-y-2">

                        @foreach ($countries as $country)
                            <li>

                                <a href="#"
                                    class="flex items-center justify-between rounded-lg px-3 py-2 hover:bg-slate-100 transition">

                                    <span>
                                        {{ $country->flag ?? '🌎' }}
                                        {{ $country->name }}
                                    </span>

                                    @if (isset($country->shops_count))
                                        <span class="text-sm text-slate-500">
                                            {{ $country->shops_count }}
                                        </span>
                                    @endif

                                </a>

                            </li>
                        @endforeach

                    </ul>

                </div>

            </div>

            <div class="mt-10 bg-white rounded-2xl shadow p-8">

                <h2 class="text-2xl font-bold mb-5">
                    Latest Products
                </h2>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">

                    @foreach ($products as $product)
                        <a href="{{ $product->url }}" class="border rounded-xl p-4 hover:border-indigo-500 transition">

                            <h3 class="font-semibold">
                                {{ $product->name }}
                            </h3>

                            <p class="text-sm text-slate-500 mt-1">
                                {{ $product->shop->name ?? '' }}
                            </p>

                        </a>
                    @endforeach

                </div>

            </div>

        </div>

    </div>

    <x-main-footer></x-main-footer>
</x-main-layout>
