<x-main-layout>

    <x-slot name="header">
        <x-main-header />
    </x-slot>


    <div class="max-w-7xl mx-auto px-6 py-12">


        <div class="grid md:grid-cols-2 gap-10 bg-white rounded-3xl shadow p-8">


            {{-- IMAGE --}}
            <div>

                <img src="{{ asset('storage/' . $product->image) }}" class="w-full rounded-3xl object-cover">
            </div>




            {{-- DETAILS --}}
            <div>


                <span class="text-orange-500 font-semibold">
                    {{ $product->category->category_name ?? 'Digital Product' }}
                </span>



                <h1 class="text-4xl font-bold mt-3">

                    {{ app()->getLocale() == 'ar' ? $product->title_ar : $product->title }}

                </h1>



                <p class="text-gray-500 mt-5 leading-8">

                    {{ app()->getLocale() == 'ar' ? $product->description_ar : $product->description }}

                </p>




                <div class="mt-8">


                    @if ($product->is_free)
                        <span class="text-3xl font-bold text-green-600">
                            Free
                        </span>
                    @else
                        <span class="text-3xl font-bold">
                            ${{ number_format($product->price, 2) }}
                        </span>
                    @endif


                </div>





                @if ($product->is_free)
                    <form method="POST" action="{{ route('digital-products.checkout', $product->slug) }}">

                        @csrf

                        <button class="bg-green-600 text-white px-8 py-4 rounded-xl">

                            Download Free

                        </button>

                    </form>
                @else
                    <form method="POST" action="{{ route('digital-products.checkout', $product->slug) }}">

                        @csrf

                        <button class="bg-orange-500 text-white px-8 py-4 rounded-xl">

                            Buy for ${{ number_format($product->price, 2) }}

                        </button>

                    </form>
                @endif



            </div>


        </div>


    </div>


    <x-main-footer />

</x-main-layout>
