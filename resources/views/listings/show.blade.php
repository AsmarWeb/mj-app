<x-main-layout>
    @section('title', $title)
    @section('description', $description)
    @section('keywords', implode(', ', $keywords))

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <div class="container mx-auto px-4 py-8">

        <div class="flex flex-wrap -mx-4">

            {{-- Product Images --}}
            <div class="w-full md:w-1/2 px-4 mb-8">

                <div class="relative">

                    @if ($listing->quantity > 0)
                        <span
                            class="absolute top-4 left-4 z-10 rounded-full bg-emerald-600 text-white px-3 py-1 text-sm font-semibold shadow">
                            ✓ In Stock
                        </span>
                    @else
                        <span
                            class="absolute top-4 left-4 z-10 rounded-full bg-red-600 text-white px-3 py-1 text-sm font-semibold shadow">
                            ✕ Out of Stock
                        </span>
                    @endif


                    <img id="mainImage"
                        src="{{ $listing->image ? asset('storage/products/' . $listing->image) : asset('images/no-image.png') }}"
                        alt="{{ $listing->title }}" class="w-full rounded-lg shadow-md">

                </div>


                <div class="flex gap-4 py-4 justify-center overflow-x-auto">

                    @foreach ($listing->images ?? [] as $image)
                        @if ($image)
                            <img src="{{ asset('storage/products/' . $image) }}" onclick="changeImage(this.src)"
                                class="size-20 object-cover rounded-md cursor-pointer opacity-70 hover:opacity-100 transition">
                        @endif
                    @endforeach

                </div>

            </div>


            {{-- Product Details --}}
            <div class="w-full md:w-1/2 px-4">


                <h1 class="text-3xl font-bold mb-2 dark:text-white">
                    {{ $listing->title }}
                </h1>


                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    SKU: {{ $listing->sku }}
                </p>


                <div class="mb-4">

                    <span class="text-2xl font-bold dark:text-white">
                        {{ $listing->shop->currency }}
                        {{ $listing->price }}
                    </span>

                    <span class="text-gray-500">
                        {{ $listing->price_condition }}
                    </span>

                </div>



                <p class="text-gray-700 dark:text-gray-200 mb-6">
                    {{ $listing->description }}
                </p>



                <div class="mb-4">
                    <span class="text-gray-500 dark:text-gray-300">
                        Product condition:
                        {{ $listing->condition }}
                    </span>
                </div>



                <div class="mb-6">

                    <label class="block text-sm font-medium mb-1 dark:text-white">
                        Quantity:
                    </label>

                    <input type="number" name="quantity" value="1" min="1" max="{{ $listing->quantity }}"
                        class="w-24 rounded-lg border-gray-300">

                </div>



                <div class="flex flex-col gap-4 mb-6">


                    {{-- Cart --}}
                    <livewire:add-to-cart :listing="$listing" />



                    {{-- WhatsApp --}}
                    @if ($listing->shop?->allow_whatsapp && $listing->shop?->whatsapp)
                        <form method="POST" action="{{ route('lead.store', $listing) }}"
                            onsubmit="openWhatsApp(event)">

                            @csrf

                            <input type="hidden" name="type" value="whatsapp">


                            <button type="submit"
                                class="flex w-full items-center justify-center gap-2 rounded-xl bg-green-600 px-6 py-3 text-white font-semibold hover:bg-green-700">

                                WhatsApp Seller

                            </button>

                        </form>


                        <script>
                            function openWhatsApp(event) {

                                event.preventDefault();


                                let form = event.target;


                                fetch(form.action, {

                                    method: "POST",

                                    body: new FormData(form),

                                    headers: {

                                        "X-CSRF-TOKEN": form.querySelector('[name="_token"]').value

                                    }

                                });


                                window.open(
                                    "https://wa.me/{{ preg_replace('/\D+/', '', $listing->shop->whatsapp) }}?text={{ rawurlencode("Hi, I'm interested in " . $listing->title . ' ' . url()->current()) }}",
                                    "_blank"
                                );

                            }
                        </script>
                    @endif



                    {{-- Phone --}}
                    @if ($listing->shop?->allow_phone && $listing->shop?->phone)
                        <a href="tel:{{ preg_replace('/\s+/', '', $listing->shop->phone) }}"
                            class="flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-white font-semibold hover:bg-blue-700">

                            Call Seller

                        </a>
                    @endif



                    {{-- Wishlist --}}
                    <form action="{{ route('wishlist.add', $listing) }}" method="POST">

                        @csrf

                        <button type="submit"
                            class="w-full flex justify-center items-center gap-2 px-6 py-3 rounded-md
                            {{ $inWishlist ? 'bg-red-100 text-red-600' : 'bg-gray-200 text-gray-800' }}">

                            @if ($inWishlist)
                                ❤️ Added to Wishlist
                            @else
                                ♡ Wishlist
                            @endif

                        </button>

                    </form>


                </div>



                {{-- Shipping --}}
                <div class="mb-6">

                    <h3 class="font-bold text-lg">
                        Shipping
                    </h3>

                    <p class="text-gray-600 dark:text-gray-300">
                        Method:
                        {{ $listing->shipping_method }}
                    </p>

                    <p class="text-gray-600 dark:text-gray-300">
                        Delivery:
                        {{ $listing->delivery_days }} days
                    </p>

                </div>



                {{-- Features --}}
                <div>

                    <h3 class="text-lg font-semibold mb-2 dark:text-white">
                        Key Features
                    </h3>


                    <ul class="list-disc list-inside text-gray-700 dark:text-gray-200">

                        @foreach ($listing->features ?? [] as $feature)
                            <li>
                                {{ $feature }}
                            </li>
                        @endforeach

                    </ul>

                </div>


            </div>

        </div>

        <div class="mt-10">

            <h2 class="text-xl font-bold">
                Write a Review
            </h2>


            <form method="POST" action="{{ route('review.store', $listing) }}">

                @csrf


                <select name="rating" class="border rounded p-2">

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



                <textarea name="comment" class="w-full border rounded mt-3" placeholder="Your review"></textarea>


                <button class="bg-orange-500 text-white px-5 py-2 rounded mt-3">

                    Submit Review

                </button>


            </form>

        </div>

    </div>



    <script>
        function changeImage(src) {
            document.getElementById('mainImage').src = src;
        }
    </script>

    @push('schema')
        <script type="application/ld+json">

{
    "@context": "https://schema.org/",
    "@type": "Product",

    "name": "{{ $listing->title }}",

    "description": "{{ strip_tags($listing->description) }}",

    "image": [
        "{{ asset('storage/products/'.$listing->image) }}"
    ],

    "sku": "{{ $listing->sku }}",

    "brand": {
        "@type": "Brand",
        "name": "{{ $listing->brand->name ?? '' }}"
    },


    "offers": {

        "@type": "Offer",

        "url": "{{ url()->current() }}",

        "priceCurrency": "AED",

        "price": "{{ $listing->price }}",

        "availability":
        "https://schema.org/InStock"

    }

}

</script>
    @endpush


    <x-main-footer></x-main-footer>

</x-main-layout>
