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



                            <div class="flex justify-center md:justify-start gap-5 mt-4 text-sm">


                                <span>
                                    ⭐ {{ $shop->rating ?? 5 }}
                                </span>


                                <span>
                                    {{ $shop->digitalProduct ?? $products->total() }}
                                    Products
                                </span>


                                <span>
                                    📍 {{ $shop->city->name ?? '' }}
                                </span>


                            </div>


                        </div>




                        <button class="bg-orange-500 text-white px-8 py-3 rounded-xl font-bold">

                            Follow Shop

                        </button>



                    </div>


                </div>

            </div>


        </section>





        {{-- SHOP NAVIGATION --}}

        <section class="max-w-7xl mx-auto px-6">


            <div class="bg-white rounded-xl shadow p-5 flex gap-8">


                <a class="font-bold text-orange-500">

                    Products

                </a>


                <a>
                    Reviews
                </a>


                <a>
                    About
                </a>


            </div>


        </section>





        {{-- SHOP CATEGORIES --}}

        @if ($categories->count())

            <section class="max-w-7xl mx-auto px-6 py-8">


                <h2 class="text-2xl font-bold mb-5">

                    Shop Categories

                </h2>


                <div class="flex flex-wrap gap-3">


                    @foreach ($categories as $category)
                        <span class="px-5 py-2 rounded-full bg-white shadow">

                            {{ $category->category_name ?? $category->name }}

                        </span>
                    @endforeach


                </div>


            </section>

        @endif







        {{-- PRODUCTS --}}

        <section class="max-w-7xl mx-auto px-6 py-10">


            <div class="flex justify-between mb-8">


                <h2 class="text-3xl font-bold dark:text-white">

                    {{ $shop->name }} Products

                </h2>


                <span class="text-gray-500 dark:text-white">

                    {{ $products->total() }} items

                </span>


            </div>





            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">


                @forelse($products as $product)
                    <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">


                        <div class="h-56 relative">


                            <img src="{{ asset('storage/products/' . $product->image) }}"
                                class="w-full h-full object-cover">


                            @if ($product->product_type == 'digital')
                                <span
                                    class="absolute top-3 left-3 bg-purple-600 text-white px-3 py-1 rounded-full text-xs">

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




                            <div class="flex justify-between items-center mt-5">


                                <span class="font-bold text-xl">

                                    {{ $shop->currency ?? '$' }}
                                    {{ number_format($product->price, 2) }}

                                </span>



                                <a href="{{ route('listing.show', $product->slug) }}"
                                    class="bg-orange-500 text-white px-4 py-2 rounded-lg">


                                    View

                                </a>


                            </div>


                        </div>


                    </div>



                @empty


                    <div class="col-span-full text-center py-20">


                        <h2 class="text-2xl font-bold dark:text-white">

                            No products yet

                        </h2>


                        <p class="text-gray-500 dark:text-white">

                            This shop is preparing new products.

                        </p>


                    </div>
                @endforelse


            </div>





            <div class="mt-10">

                {{ $products->links() }}

            </div>


        </section>




    </div>



    <x-main-footer />

</x-main-layout>
