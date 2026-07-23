<x-main-layout>

    <x-slot name="header">
        <x-main-header />
    </x-slot>


    <div class="min-h-screen py-10">

        <div class="max-w-6xl mx-auto px-6">


            <h1 class="text-3xl font-bold mb-8">
                🛒 Your Basket
            </h1>


            @if (isset($shops) && $shops->count())


                <div class="space-y-8">


                    @foreach ($shops as $shopId => $items)
                        @php
                            $shop = $items->first()->listing?->shop;
                        @endphp


                        @if ($shop)
                            <div class="bg-white rounded-3xl shadow-sm p-6">


                                <div class="flex justify-between items-center mb-5">

                                    <h2 class="text-xl font-bold">
                                        {{ $shop->name }}
                                    </h2>


                                    @if ($shop->allow_whatsapp && $shop->whatsapp)
                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $shop->whatsapp) }}"
                                            target="_blank" class="text-green-600 font-semibold">

                                            WhatsApp

                                        </a>
                                    @endif

                                </div>



                                @foreach ($items as $item)
                                    @if ($item->listing)
                                        <div class="flex gap-5 border-b pb-5 mb-5">


                                            <img src="{{ asset('storage/products/' . $item->listing->image) }}"
                                                class="w-28 h-28 rounded-xl object-cover">



                                            <div class="flex-1">


                                                <h3 class="font-semibold text-lg">

                                                    {{ $item->listing->title }}

                                                </h3>



                                                <p class="text-gray-500">

                                                    {{ $shop->name }}

                                                </p>



                                                <div class="flex items-center gap-3 mt-4">


                                                    <div class="flex items-center rounded-xl border">


                                                        <form method="POST"
                                                            action="{{ route('cart.decrease', $item->id) }}">

                                                            @csrf

                                                            <button class="w-10 h-10 hover:bg-gray-100">

                                                                −

                                                            </button>

                                                        </form>



                                                        <span class="px-5 font-bold">

                                                            {{ $item->quantity }}

                                                        </span>



                                                        <form method="POST"
                                                            action="{{ route('cart.increase', $item->id) }}">

                                                            @csrf

                                                            <button class="w-10 h-10 hover:bg-gray-100">

                                                                +

                                                            </button>

                                                        </form>


                                                    </div>



                                                </div>


                                            </div>




                                            <div class="text-right">


                                                <p class="font-bold text-lg">

                                                    {{ $shop->currency }}

                                                    {{ number_format($item->price * $item->quantity, 2) }}

                                                </p>




                                                <form method="POST" action="{{ route('cart.destroy', $item->id) }}">

                                                    @csrf
                                                    @method('DELETE')


                                                    <button onclick="return confirm('Remove this item?')"
                                                        class="mt-4 text-red-600">

                                                        Remove

                                                    </button>


                                                </form>



                                            </div>


                                        </div>
                                    @endif
                                @endforeach




                                <div class="flex justify-between font-bold">


                                    <span>
                                        Shop Total
                                    </span>


                                    <span>

                                        {{ $shop->currency }}

                                        {{ number_format(
                                            $items->sum(function ($item) {
                                                return $item->price * $item->quantity;
                                            }),
                                            2,
                                        ) }}

                                    </span>


                                </div>



                            </div>
                        @endif
                    @endforeach


                </div>




                <div class="mt-8 bg-white rounded-3xl p-6 shadow-sm">


                    <div class="flex justify-between text-2xl font-bold">


                        <span>
                            Total
                        </span>


                        <span>

                            AED {{ number_format($total, 2) }}

                        </span>


                    </div>



                    <a href="{{ route('checkout') }}"
                        class="block mt-6 text-center bg-orange-600 hover:bg-orange-700 text-white py-4 rounded-xl font-bold">

                        Proceed to Checkout

                    </a>


                </div>
            @else
                <div class="bg-white rounded-3xl p-10 text-center">


                    <div class="text-6xl mb-5">
                        🛒
                    </div>


                    <h2 class="text-2xl font-bold">

                        Your basket is empty

                    </h2>



                    <a href="{{ route('explore') }}"
                        class="inline-block mt-5 bg-orange-600 text-white px-8 py-3 rounded-xl">

                        Continue Shopping

                    </a>


                </div>


            @endif


        </div>

    </div>


    <x-main-footer />


</x-main-layout>
