<x-main-layout>

    <x-slot name="header">
        <x-main-header />
    </x-slot>


    <div class="min-h-screen py-10">


        <div class="max-w-6xl mx-auto px-6">


            <h1 class="text-3xl font-bold mb-8">
                🛒 Your Basket
            </h1>



            @if ($shops->count())


                <div class="space-y-8">


                    @foreach ($shops as $shopId => $items)
                        <div class="bg-white rounded-3xl shadow-sm p-6">


                            <h2 class="text-xl font-bold mb-5">

                                {{ $items->first()->listing->shop->name }}

                            </h2>



                            @foreach ($items as $item)
                                <div class="flex gap-5 border-b pb-5 mb-5">


                                    <img src="{{ asset('storage/products/' . $item->listing->image) }}"
                                        class="w-28 h-28 rounded-xl object-cover">



                                    <div class="flex-1">


                                        <h3 class="font-semibold text-lg">

                                            {{ $item->listing->title }}

                                        </h3>


                                        <p class="text-gray-500">

                                            {{ $item->listing->shop->name }}

                                        </p>



                                        <div class="flex items-center gap-3 mt-3">


                                            <div class="flex items-center rounded-xl border overflow-hidden">

                                                <form action="{{ route('cart.decrease', $item) }}" method="POST">
                                                    @csrf

                                                    <button class="w-10 h-10 bg-gray-100 hover:bg-gray-200 text-lg">
                                                        −
                                                    </button>
                                                </form>

                                                <span class="px-5 font-semibold">
                                                    {{ $item->quantity }}
                                                </span>

                                                <form action="{{ route('cart.increase', $item) }}" method="POST">
                                                    @csrf

                                                    <button class="w-10 h-10 bg-gray-100 hover:bg-gray-200 text-lg">
                                                        +
                                                    </button>
                                                </form>

                                            </div>


                                        </div>


                                    </div>



                                    <div class="text-right">


                                        <p class="font-bold text-lg">

                                            {{ $item->listing->shop->currency }}

                                            {{ number_format($item->price * $item->quantity, 2) }}

                                        </p>



                                        <form action="{{ route('cart.destroy', $item) }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button onclick="return confirm('Remove this item?')"
                                                class="mt-4 text-red-600 hover:text-red-700 font-medium">

                                                Remove

                                            </button>

                                        </form>


                                    </div>



                                </div>
                            @endforeach




                            <div class="flex justify-between font-bold">


                                <span>
                                    Shop Total
                                </span>


                                <span>

                                    {{ $items->first()->listing->shop->currency }}

                                    {{ number_format($items->sum(fn($i) => $i->price * $i->quantity), 2) }}

                                </span>


                            </div>



                        </div>
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



                    <a href="#"
                        class="
block
text-center
mt-6
bg-orange-600
text-white
py-4
rounded-2xl
font-bold
hover:bg-orange-700
">

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
                        class="
inline-block
mt-5
bg-orange-600
text-white
px-8
py-3
rounded-xl">

                        Continue Shopping

                    </a>


                </div>


            @endif



        </div>

    </div>



    <x-main-footer />

</x-main-layout>
