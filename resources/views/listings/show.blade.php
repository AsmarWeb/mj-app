<x-main-layout>

    @section('title', $title ?? $listing->title)
    @section('description', $description ?? Str::limit($listing->description, 160))
    @section('keywords', implode(', ', $keywords ?? []))


    <x-slot name="header">
        <x-main-header />
    </x-slot>

    <style>
        .media-thumb {
            transition: .2s;
        }

        .media-thumb:hover {
            transform: scale(1.05);
        }

        #mainImage {
            cursor: zoom-in;
        }
    </style>

    <div class="container mx-auto px-4 py-10">


        <div class="grid md:grid-cols-2 gap-10">


            {{-- MEDIA --}}
            {{-- MEDIA --}}
            <div class="grid grid-cols-1 md:grid-cols-[90px_1fr] gap-4">

                {{-- Thumbnails --}}
                <div class="flex md:flex-col gap-3 overflow-x-auto md:overflow-y-auto">

                    {{-- Main Image --}}
                    @if ($listing->image)
                        <img src="{{ asset('storage/products/' . $listing->image) }}"
                            onclick="showImage('{{ asset('storage/products/' . $listing->image) }}')"
                            class="media-thumb w-20 h-20 object-cover rounded-xl border-2 border-gray-200 hover:border-orange-500 cursor-pointer transition">
                    @endif

                    {{-- Gallery Images --}}
                    @foreach ($listing->images ?? [] as $image)
                        <img src="{{ asset('storage/products/' . $image) }}"
                            onclick="showImage('{{ asset('storage/products/' . $image) }}')"
                            class="media-thumb w-20 h-20 object-cover rounded-xl border-2 border-gray-200 hover:border-orange-500 cursor-pointer transition">
                    @endforeach

                    {{-- Video --}}
                    @if ($listing->video)
                        <div onclick="showVideo()"
                            class="media-thumb w-20 h-20 rounded-xl border-2 border-gray-200 hover:border-orange-500 cursor-pointer bg-black flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="currentColor"
                                viewBox="0 0 16 16">

                                <path
                                    d="M11.596 8.697L6.233 11.98A.5.5 0 0 1 5.5 11.56V4.44a.5.5 0 0 1 .733-.42l5.363 3.282a.5.5 0 0 1 0 .848z" />

                            </svg>

                        </div>
                    @endif

                </div>

                {{-- Main Viewer --}}
                <div class="relative overflow-hidden rounded-2xl bg-white border shadow">

                    @if ($listing->quantity > 0 || $listing->product_type === 'digital')
                        <span class="absolute top-4 left-4 z-20 bg-green-600 text-white px-4 py-1 rounded-full text-sm">

                            ✓ Available

                        </span>
                    @else
                        <span class="absolute top-4 left-4 z-20 bg-red-600 text-white px-4 py-1 rounded-full text-sm">

                            Out of Stock

                        </span>
                    @endif

                    {{-- Main Image --}}
                    <img id="mainImage" src="{{ asset('storage/products/' . $listing->image) }}"
                        class="block w-full h-[650px] object-contain bg-white transition">

                    {{-- Video --}}
                    @if ($listing->video)
                        <video id="mainVideo" controls class="hidden w-full h-[650px] bg-black object-contain">

                            <source src="{{ asset('storage/products/videos/' . $listing->video) }}" type="video/mp4">

                        </video>
                    @endif

                </div>

            </div>





            {{-- DETAILS --}}

            <div>


                <h1 class="text-4xl font-bold dark:text-white">

                    {{ $listing->title }}

                </h1>


                <p class="mt-2 text-gray-500">

                    SKU:
                    {{ $listing->sku }}

                </p>




                <div class="mt-6">


                    <span class="text-3xl font-bold">

                        {{ $listing->shop?->currency ?? '$' }}
                        {{ number_format($listing->price, 2) }}

                    </span>


                    @if ($listing->price_condition)
                        <span class="ml-3 text-gray-500">

                            {{ ucfirst($listing->price_condition) }}

                        </span>
                    @endif


                </div>





                <p class="mt-6 text-gray-700 dark:text-gray-300">

                    {{ $listing->description }}

                </p>






                {{-- DIGITAL PRODUCT --}}

                @if ($listing->product_type === 'digital' || $listing->digital_file)
                    <div class="mt-8">


                        <div class="bg-purple-50 rounded-xl p-5">


                            <h3 class="font-bold text-purple-700">
                                Digital Product
                            </h3>


                            <p class="text-gray-600 mt-2">

                                Instant download after purchase.

                            </p>


                        </div>



                        <a href="{{ route('digital-products.checkout', $listing->slug) }}"
                            class="block text-center mt-5 bg-purple-600 text-white px-6 py-3 rounded-xl">

                            Buy & Download

                        </a>


                    </div>
                @else
                    {{-- Quantity --}}

                    <div class="mt-6">


                        <label class="font-semibold">

                            Quantity

                        </label>


                        <input type="number" value="1" min="1" max="{{ $listing->quantity }}"
                            class="mt-2 w-24 rounded-xl border-gray-300">


                    </div>





                    <div class="mt-6">


                        <livewire:add-to-cart :listing="$listing" />


                    </div>
                @endif






                {{-- CONTACT --}}


                @if ($listing->shop?->allow_whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/\D+/', '', $listing->shop->whatsapp) }}"
                        class="block mt-5 text-center bg-green-600 text-white px-6 py-3 rounded-xl">

                        WhatsApp Seller

                    </a>
                @endif




                @if ($listing->shop?->phone)
                    <a href="tel:{{ $listing->shop->phone }}"
                        class="block mt-3 text-center bg-blue-600 text-white px-6 py-3 rounded-xl">

                        Call Seller

                    </a>
                @endif






                {{-- Wishlist --}}

                <form method="POST" action="{{ route('wishlist.add', $listing) }}" class="mt-5">

                    @csrf


                    <button
                        class="w-full rounded-xl py-3
{{ $inWishlist ? 'bg-red-100 text-red-600' : 'bg-gray-200' }}">


                        {{ $inWishlist ? '❤️ Added' : '♡ Wishlist' }}


                    </button>


                </form>



            </div>


        </div>





        {{-- FEATURES --}}

        <div class="mt-12">


            <h2 class="text-2xl font-bold">

                Features

            </h2>


            <ul class="mt-4 list-disc ml-6">


                @foreach ($listing->features ?? [] as $feature)
                    <li>
                        {{ $feature }}
                    </li>
                @endforeach


            </ul>


        </div>

        <div class="mt-8 space-y-6">

            @forelse($listing->reviews as $review)

                <div class="rounded-xl border bg-white p-6 shadow-sm">

                    <div class="flex justify-between">

                        <div>

                            <h4 class="font-semibold">

                                {{ $review->user->name }}

                            </h4>

                            <p class="text-sm text-gray-500">

                                {{ $review->created_at->diffForHumans() }}

                            </p>

                        </div>

                        <div class="text-yellow-500 text-lg">

                            @for ($i = 1; $i <= 5; $i++)
                                {{ $i <= $review->rating ? '★' : '☆' }}
                            @endfor

                        </div>

                    </div>

                    <p class="mt-4 text-gray-700">

                        {{ $review->comment }}

                    </p>

                </div>

            @empty

                <div class="rounded-xl bg-gray-50 p-10 text-center text-gray-500">

                    No reviews yet.

                    <br>

                    Be the first to review this product.

                </div>

            @endforelse

        </div>


        {{-- REVIEWS --}}

        <div class="mt-12">


            <h2 class="text-2xl font-bold">

                Write Review

            </h2>


            <form method="POST" action="{{ route('review.store', $listing) }}">

                @csrf


                <select name="rating" class="border rounded-xl p-3 mt-4">

                    <option value="5">
                        ⭐⭐⭐⭐⭐
                    </option>

                    <option value="4">
                        ⭐⭐⭐⭐
                    </option>

                    <option value="3">
                        ⭐⭐⭐
                    </option>

                    <option value="2">
                        ⭐⭐
                    </option>

                    <option value="1">
                        ⭐
                    </option>


                </select>


                <textarea name="comment" class="w-full border rounded-xl mt-4" placeholder="Your review"></textarea>



                <button class="mt-4 bg-orange-500 text-white px-6 py-3 rounded-xl">

                    Submit Review

                </button>


            </form>


        </div>



    </div>



    <script>
        function showImage(src) {
            let image = document.getElementById('mainImage');
            let video = document.getElementById('mainVideo');

            image.src = src;
            image.classList.remove('hidden');

            if (video) {
                video.pause();
                video.classList.add('hidden');
            }
        }

        function showVideo() {
            let image = document.getElementById('mainImage');
            let video = document.getElementById('mainVideo');

            if (video) {

                image.classList.add('hidden');

                video.classList.remove('hidden');

                video.load();

            }
        }
    </script>



    @push('schema')
        <script type="application/ld+json">

{
"@context":"https://schema.org",
"@type":"Product",

"name":"{{$listing->title}}",

"description":"{{strip_tags($listing->description)}}",

"image":[
"{{asset('storage/products/'.$listing->image)}}"
],

"offers":
{

"@type":"Offer",

"price":"{{$listing->price}}",

"priceCurrency":"AED",

"availability":
"https://schema.org/InStock"

}

}

</script>
    @endpush



    <x-main-footer />

</x-main-layout>
