<x-main-layout>
    @section('title', 'Category | murwaj')
    @section('description', "$description")
    @section('keywords', "$keywords")

    <x-slot name="header">
        <x-main-header />
    </x-slot>

    <section class="max-w-7xl mx-auto px-6 py-10">

        {{-- Category Header --}}
        <div class="rounded-3xl bg-gradient-to-r from-orange-500 to-red-500 text-white p-10 mb-10">

            <div class="flex items-center gap-6">

                <div class="w-24 h-24 rounded-3xl bg-white/20 flex items-center justify-center">

                    @if ($category->image)
                        <img src="{{ asset('storage/category-suggest/' . $category->image) }}"
                            class="w-16 h-16 object-contain">
                    @else
                        <span class="text-5xl">📦</span>
                    @endif

                </div>

                <div>

                    <h1 class="text-4xl font-black">

                        {{ app()->getLocale() == 'ar' ? $category->category_name_ar : $category->category_name }}

                    </h1>

                    <p class="mt-2 text-orange-100">

                        {{ $products->total() }} Products Available

                    </p>

                </div>

            </div>

        </div>



        {{-- Products --}}
        @if ($products->count())

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">

                @foreach ($products as $product)
                    <a href="{{ $product->url }}"
                        class="group bg-white dark:bg-neutral-900 rounded-3xl overflow-hidden shadow hover:shadow-2xl transition">

                        {{-- Image --}}
                        <div class="relative">

                            @if ($product->image)
                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                    class="w-full aspect-square object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="aspect-square bg-gray-100 flex items-center justify-center">

                                    📦

                                </div>
                            @endif

                            @if ($product->featured)
                                <span
                                    class="absolute top-3 left-3 bg-orange-500 text-white text-xs px-3 py-1 rounded-full">

                                    Featured

                                </span>
                            @endif

                        </div>

                        {{-- Info --}}
                        <div class="p-5">

                            <h3 class="font-bold line-clamp-2 dark:text-gray-100">

                                {{ $product->title }}

                            </h3>

                            <p class="text-gray-500 text-sm mt-2 dark:text-gray-200">

                                {{ $product->shop->name ?? 'Marketplace' }}

                            </p>

                            <div class="mt-4 flex items-center justify-between">

                                <span class="text-2xl font-black text-orange-500">

                                    AED {{ number_format($product->price) }}

                                </span>

                            </div>

                        </div>

                    </a>
                @endforeach

            </div>

            <div class="mt-10">

                {{ $products->links() }}

            </div>
        @else
            <div class="text-center py-24">

                <div class="text-7xl mb-6">
                    📦
                </div>

                <h2 class="text-3xl font-bold dark:text-gray-100">

                    No Products Found

                </h2>

                <p class="text-gray-500 mt-3">

                    There are currently no products in this category.

                </p>

            </div>

        @endif

    </section>

    <x-main-footer />

</x-main-layout>
