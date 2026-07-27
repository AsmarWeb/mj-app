<x-main-layout>

    <div class="max-w-3xl mx-auto py-24">

        <div class="bg-white rounded-3xl shadow-xl p-12 text-center">

            <div class="text-7xl mb-6">
                ✅
            </div>

            <h1 class="text-4xl font-bold">

                Payment Successful

            </h1>

            <p class="mt-4 text-gray-500">

                Thank you for your purchase.

            </p>

            <div class="mt-8 rounded-xl bg-gray-100 p-6">

                <img src="{{ asset('storage/' . $product->image) }}" class="w-40 h-40 mx-auto rounded-xl object-cover">

                <h2 class="mt-5 text-2xl font-bold">

                    {{ $product->title }}

                </h2>

                <p class="text-orange-600 font-bold mt-2">

                    ${{ number_format($product->price, 2) }}

                </p>

            </div>

            <a href="{{ route('digital-products.download', $product->slug) }}"
                class="mt-10 inline-flex bg-orange-500 hover:bg-orange-600 text-white px-10 py-4 rounded-xl font-bold">

                Download Product

            </a>

        </div>

    </div>

</x-main-layout>
