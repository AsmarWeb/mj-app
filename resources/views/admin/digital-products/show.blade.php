<x-main-layout>

    <x-slot name="header">
        <x-main-header />
    </x-slot>


    <div x-data="{
        image: '{{ asset('storage/' . $product->image) }}',
        video: null,
        showVideo: false,
    
        changeImage(src) {
            this.image = src;
            this.showVideo = false;
        },
    
        playVideo(src) {
            this.video = src;
            this.showVideo = true;
        }
    }" class="max-w-7xl mx-auto px-6 py-12">



        <div class="grid lg:grid-cols-2 gap-10">






            {{-- MEDIA --}}

            <div class="space-y-5">


                <div class="bg-white rounded-3xl shadow overflow-hidden relative">



                    @if ($product->featured)
                        <span
                            class="absolute top-5 left-5 z-10 bg-yellow-400 text-yellow-900 px-4 py-2 rounded-full font-bold">

                            ⭐ Featured

                        </span>
                    @endif





                    <template x-if="!showVideo">


                        <img :src="image"
                            class="w-full h-[650px] object-contain bg-white hover:scale-105 transition duration-500">

                    </template>




                    <template x-if="showVideo">


                        <video controls autoplay class="w-full h-[650px] bg-black object-contain">


                            <source :src="video" type="video/mp4">


                        </video>


                    </template>



                </div>







                {{-- THUMBNAILS --}}

                <div class="grid grid-cols-5 gap-3">


                    <button @click="changeImage('{{ asset('storage/' . $product->image) }}')"
                        class="rounded-xl overflow-hidden border hover:border-orange-500">

                        <img src="{{ asset('storage/' . $product->image) }}" class="h-20 w-full object-cover">

                    </button>






                    @if ($product->gallery)

                        @foreach ($product->gallery as $image)
                            <button @click="changeImage('{{ asset('storage/' . $image) }}')"
                                class="rounded-xl overflow-hidden border hover:border-orange-500">


                                <img src="{{ asset('storage/' . $image) }}" class="h-20 w-full object-cover">


                            </button>
                        @endforeach

                    @endif






                    @if ($product->video_url)
                        <button @click="playVideo('{{ $product->video_url }}')"
                            class="h-20 rounded-xl bg-black flex items-center justify-center">


                            <span class="text-white text-3xl">
                                ▶
                            </span>


                        </button>
                    @endif



                </div>


            </div>










            {{-- DETAILS --}}

            <div class="bg-white rounded-3xl shadow p-8">





                {{-- TYPE --}}

                <div class="flex justify-between items-center">


                    @if ($product->type == 'pod')
                        <span class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full font-bold">

                            👕 Print On Demand

                        </span>
                    @elseif($product->type == 'service')
                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full font-bold">

                            🛠 Service

                        </span>
                    @else
                        <span class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full font-bold">

                            📦 Digital Product

                        </span>
                    @endif



                </div>







                {{-- CATEGORY --}}

                <p class="text-orange-500 font-bold uppercase text-sm mt-6">

                    {{ $product->digitalCategory?->category_name ?? 'Digital' }}

                </p>







                <h1 class="text-4xl font-black mt-3">

                    {{ app()->getLocale() == 'ar' ? $product->title_ar : $product->title }}

                </h1>






                <p class="mt-5 text-gray-600 leading-8">

                    {{ app()->getLocale() == 'ar' ? $product->description_ar : $product->description }}

                </p>







                {{-- PRICE --}}

                <div class="mt-8">


                    @if ($product->is_free)
                        <h2 class="text-4xl font-black text-green-600">
                            FREE
                        </h2>
                    @else
                        <h2 class="text-4xl font-black">

                            ${{ number_format($product->price, 2) }}

                        </h2>
                    @endif


                </div>











                {{-- POD INFORMATION --}}

                @if ($product->type == 'pod')

                    <div class="mt-8 bg-gray-50 rounded-3xl p-6 space-y-6">


                        <h3 class="text-2xl font-black">
                            Print On Demand Details
                        </h3>



                        {{-- BASE PRODUCT --}}

                        @if ($product->base_product)
                            <div class="flex justify-between border-b pb-3">

                                <span class="font-bold">
                                    Product
                                </span>

                                <span>
                                    {{ $product->base_product }}
                                </span>

                            </div>
                        @endif






                        {{-- SUPPLIER --}}

                        @if ($product->supplier)

                            <div class="border rounded-2xl bg-white p-5">


                                <h4 class="font-black text-lg mb-3">
                                    Fulfilled by
                                </h4>


                                <div class="space-y-2">


                                    <p>
                                        <strong>
                                            Supplier:
                                        </strong>

                                        {{ $product->supplier->company ?? $product->supplier->name }}

                                    </p>



                                    @if ($product->supplier->country)
                                        <p>

                                            <strong>
                                                Location:
                                            </strong>

                                            {{ $product->supplier->country }}

                                        </p>
                                    @endif




                                    <p class="text-green-600 font-bold">

                                        ✓ Quality checked supplier

                                    </p>


                                </div>


                            </div>

                        @endif







                        {{-- OPTIONS --}}

                        <div>


                            <h4 class="font-bold mb-3">
                                Available Options
                            </h4>



                            @if ($product->sizes)

                                <div class="mb-4">

                                    <p class="font-bold">
                                        Sizes
                                    </p>


                                    <div class="flex flex-wrap gap-2 mt-2">

                                        @foreach ($product->sizes as $size)
                                            <span class="px-4 py-2 bg-white border rounded-xl">

                                                {{ $size }}

                                            </span>
                                        @endforeach

                                    </div>

                                </div>

                            @endif





                            @if ($product->colors)

                                <div>

                                    <p class="font-bold">
                                        Colors
                                    </p>


                                    <div class="flex flex-wrap gap-2 mt-2">


                                        @foreach ($product->colors as $color)
                                            <span class="px-4 py-2 bg-white border rounded-xl">

                                                {{ $color }}

                                            </span>
                                        @endforeach


                                    </div>


                                </div>


                            @endif


                        </div>






                        {{-- SHIPPING --}}

                        <div class="bg-white rounded-2xl p-5">


                            <h4 class="font-bold text-lg">
                                Shipping & Fulfillment
                            </h4>


                            <ul class="mt-3 space-y-2 text-gray-600">


                                <li>
                                    ✓ Made after purchase
                                </li>


                                <li>
                                    ✓ Supplier ships directly to customer
                                </li>


                                <li>
                                    ✓ Tracking number provided
                                </li>


                            </ul>


                        </div>




                    </div>

                @endif







                {{-- DIGITAL DETAILS --}}

                @if ($product->type == 'digital')


                    <div class="grid md:grid-cols-2 gap-4 mt-8">


                        @if ($product->version)
                            <div class="bg-gray-50 p-4 rounded-xl">

                                <strong>
                                    Version
                                </strong>

                                <p>
                                    {{ $product->version }}
                                </p>

                            </div>
                        @endif




                        @if ($product->compatible_with)
                            <div class="bg-gray-50 p-4 rounded-xl">

                                <strong>
                                    Works With
                                </strong>

                                <p>
                                    {{ $product->compatible_with }}
                                </p>

                            </div>
                        @endif




                        @if ($product->included_files)
                            <div class="bg-gray-50 p-4 rounded-xl">

                                <strong>
                                    Included
                                </strong>

                                <p>
                                    {{ $product->included_files }}
                                </p>

                            </div>
                        @endif



                        @if ($product->file_size)
                            <div class="bg-gray-50 p-4 rounded-xl">

                                <strong>
                                    Size
                                </strong>

                                <p>
                                    {{ $product->file_size }}
                                </p>

                            </div>
                        @endif


                    </div>


                @endif





                @if ($product->type == 'pod' && $product->supplier)
                    <div class="mt-8 border rounded-2xl p-5">

                        <h3 class="font-black text-lg">
                            Production Partner
                        </h3>


                        <p class="mt-2 text-gray-600">

                            This product is produced and fulfilled by:

                            <strong>
                                {{ $product->supplier->company ?? $product->supplier->name }}
                            </strong>

                        </p>


                    </div>
                @endif



                {{-- BUY --}}

                <form method="POST" action="{{ route('pod.checkout') }}" class="mt-10">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    @if ($product->type === 'pod')
                        <input type="hidden" name="quantity" value="1">
                    @endif

                    <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white py-5 rounded-2xl font-black text-lg">

                        @if ($product->is_free)
                            Download Free
                        @elseif ($product->type === 'pod')
                            Order Now • ${{ number_format($product->price, 2) }}
                        @else
                            Buy Now • ${{ number_format($product->price, 2) }}
                        @endif

                    </button>
                </form>







                {{-- STATS --}}

                <div class="flex justify-between border-t mt-8 pt-6 text-gray-500">


                    <span>
                        ⬇ {{ $product->downloads }}
                    </span>


                    <span>
                        ❤️ {{ $product->favorites }}
                    </span>


                    <span>
                        ⭐ {{ $product->rating }}
                    </span>


                    <span>
                        💬 {{ $product->reviews }}
                    </span>


                </div>



            </div>


        </div>









        {{-- EXTRA INFO --}}

        <div class="grid md:grid-cols-3 gap-6 mt-12">


            @if ($product->requirements)
                <div class="bg-white rounded-3xl shadow p-6">

                    <h3 class="font-bold text-xl">
                        Requirements
                    </h3>

                    <p class="mt-3 text-gray-600">
                        {{ $product->requirements }}
                    </p>

                </div>
            @endif




            @if ($product->installation)
                <div class="bg-white rounded-3xl shadow p-6">

                    <h3 class="font-bold text-xl">
                        Installation
                    </h3>

                    <p class="mt-3 text-gray-600">
                        {{ $product->installation }}
                    </p>

                </div>
            @endif




            @if ($product->changelog)
                <div class="bg-white rounded-3xl shadow p-6">

                    <h3 class="font-bold text-xl">
                        Updates
                    </h3>

                    <p class="mt-3 text-gray-600">
                        {{ $product->changelog }}
                    </p>

                </div>
            @endif



        </div>




    </div>


    <x-main-footer />

</x-main-layout>
