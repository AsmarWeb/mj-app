<x-main-layout>

    @section('title', $title)
    @section('description', $description)
    @section('keywords', $keywords)


    <x-slot name="header">
        <x-main-header />
    </x-slot>


    <div class="min-h-screen">


        {{-- SHOP HEADER --}}
        <section class="max-w-7xl mx-auto px-6 py-10">


            <div class="bg-white rounded-3xl shadow overflow-hidden">


                {{-- Banner --}}
                <div class="h-72 bg-cover bg-center"
                    style="background-image:url('{{ $shop->banner ? asset('storage/' . $shop->banner) : asset('shop-banner.jpg') }}')">
                </div>



                <div class="px-8 pb-8">


                    <div class="-mt-16 flex flex-col md:flex-row gap-6 items-center md:items-end">


                        {{-- Logo --}}
                        <div class="w-32 h-32 rounded-full border-8 border-white bg-white shadow overflow-hidden">


                            @if ($shop->logo)
                                <img src="{{ asset('storage/' . $shop->logo) }}" class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center 
bg-indigo-600 text-white text-4xl font-bold">

                                    {{ substr($shop->name, 0, 1) }}

                                </div>
                            @endif


                        </div>



                        <div class="flex-1 text-center md:text-left">


                            <h1 class="text-4xl font-bold">
                                {{ $shop->name }}
                            </h1>


                            <p class="text-gray-500 mt-2">
                                {{ $shop->description }}
                            </p>



                            <div class="flex gap-5 text-sm">

                                <span>
                                    ⭐ {{ $shop->rating ?? 5 }}
                                </span>

                                <span>
                                    {{ $products->total() }} Products
                                </span>

                                <span>
                                    ❤️ {{ $shop->followers_count }} Followers
                                </span>

                                <span>
                                    📍 {{ $shop->city->name ?? '' }}
                                </span>

                            </div>


                        </div>

                        @auth
                            @if (auth()->id() !== $shop->user_id)
                                @php
                                    $following = auth()->user()->followedShops->contains($shop->id);
                                @endphp

                                <form action="{{ route('shops.follow', $shop) }}" method="POST">
                                    @csrf

                                    <button
                                        class="{{ $following ? 'bg-gray-200 text-gray-800' : 'bg-orange-500 text-white' }} px-8 py-3 rounded-xl font-bold transition">

                                        {{ $following ? 'Following' : 'Follow Shop' }}

                                    </button>

                                </form>
                            @endif
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="bg-orange-500 text-white px-8 py-3 rounded-xl font-bold">
                                Follow Shop
                            </a>
                        @endguest


                    </div>


                </div>

            </div>


        </section>






        {{-- SHOP NAVIGATION --}}
        <section class="sticky top-16 z-30 bg-gray-50/80 backdrop-blur border-y">
            <div class="max-w-7xl mx-auto px-6">

                <nav class="flex gap-3 overflow-x-auto py-3">

                    <a href="#products"
                        class="px-5 py-2 rounded-xl bg-orange-500 text-white font-semibold whitespace-nowrap hover:bg-orange-600 transition">
                        📦 Products
                    </a>

                    <a href="#reviews"
                        class="px-5 py-2 rounded-xl bg-white hover:bg-gray-100 font-semibold whitespace-nowrap transition">
                        ⭐ Reviews
                    </a>

                    <a href="#about"
                        class="px-5 py-2 rounded-xl bg-white hover:bg-gray-100 font-semibold whitespace-nowrap transition">
                        ℹ️ About
                    </a>

                </nav>

            </div>
        </section>


        {{-- PRODUCTS --}}
        <section id="products" class="max-w-7xl mx-auto px-6 py-10">

            @if ($categories->count())

                <div class="mb-10">

                    <h2 class="text-2xl font-bold mb-5">
                        Shop Categories
                    </h2>

                    <div class="flex flex-wrap gap-3">

                        @foreach ($categories as $category)
                            <span class="px-4 py-2 bg-white rounded-full shadow text-sm hover:bg-orange-50 transition">

                                {{ $category->category_name ?? $category->name }}

                            </span>
                        @endforeach

                    </div>

                </div>

            @endif


            <div class="flex items-center justify-between mb-8">

                <div>

                    <h2 class="text-3xl font-bold">

                        {{ $shop->name }} Products

                    </h2>

                    <p class="text-gray-500">

                        {{ $products->total() }} Products Available

                    </p>

                </div>

            </div>


            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @forelse($products as $product)
                    <div
                        class="bg-white rounded-2xl shadow hover:shadow-2xl hover:-translate-y-1 transition overflow-hidden">

                        <div class="relative">

                            <img src="{{ asset('storage/products/' . $product->image) }}"
                                class="w-full h-60 object-cover">

                            @if ($product->product_type == 'digital')
                                <span
                                    class="absolute top-3 left-3 bg-purple-600 text-white text-xs px-3 py-1 rounded-full">

                                    Digital

                                </span>
                            @endif

                        </div>

                        <div class="p-5">

                            <h3 class="font-bold text-lg line-clamp-1">

                                {{ $product->title }}

                            </h3>

                            <p class="text-gray-500 text-sm mt-2 line-clamp-2">

                                {{ Str::limit($product->description, 70) }}

                            </p>

                            <div class="flex items-center justify-between mt-5">

                                <span class="text-xl font-bold text-orange-600">

                                    {{ $shop->currency }}

                                    {{ number_format($product->price, 2) }}

                                </span>

                                <a href="{{ $product->url }}"
                                    class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition">

                                    View

                                </a>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-span-full">

                        <div class="bg-white rounded-2xl shadow p-16 text-center">

                            <h3 class="text-2xl font-bold">

                                No products yet

                            </h3>

                            <p class="text-gray-500 mt-3">

                                This shop is preparing new products.

                            </p>

                        </div>

                    </div>
                @endforelse

            </div>

            <div class="mt-10">

                {{ $products->links() }}

            </div>

        </section>


        {{-- REVIEWS --}}
        <section id="reviews" class="max-w-7xl mx-auto px-6 py-10">

            <livewire:shop-review :shop="$shop" />

        </section>


        {{-- ABOUT --}}
        <section id="about" class="max-w-7xl mx-auto px-6 py-10">

            <h2 class="text-3xl font-bold mb-8">

                About {{ $shop->name }}

            </h2>

            <div class="bg-white rounded-2xl shadow p-8">

                <p class="text-gray-600 leading-8">

                    {{ $shop->description }}

                </p>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">

                    <div>

                        <h4 class="font-semibold">

                            📍 Location

                        </h4>

                        <p class="text-gray-500 mt-2">

                            {{ $shop->city->name ?? '' }}

                            {{ $shop->state->name ?? '' }}

                        </p>

                    </div>

                    <div>
                        <h4 class="font-semibold">
                            📅 Member Since
                        </h4>

                        <p class="text-gray-500 mt-2">
                            {{ $shop->created_at ? $shop->created_at->format('F Y') : 'Not available' }}
                        </p>
                    </div>

                    <div>

                        <h4 class="font-semibold">

                            👁 Views

                        </h4>

                        <p class="text-gray-500 mt-2">

                            {{ number_format($shop->views) }}

                        </p>

                    </div>

                    <div>

                        <h4 class="font-semibold">

                            ❤️ Followers

                        </h4>

                        <p class="text-gray-500 mt-2">

                            {{ $shop->followers_count }}

                        </p>

                    </div>

                </div>

            </div>

        </section>



    </div>



    <x-main-footer />

</x-main-layout>
