<x-main-layout>

    <div class="max-w-4xl mx-auto py-16 px-4">


        <div class="text-center">

            <div
                class="bg-green-100 text-green-700 rounded-full 
                w-20 h-20 flex items-center justify-center mx-auto text-4xl">
                ✓
            </div>


            <h1 class="text-4xl font-bold mt-6 dark:text-white">
                Payment Successful!
            </h1>


            <p class="mt-3 text-gray-500">
                Thank you for your order.
            </p>

        </div>



        <div class="mt-10 space-y-6">


            @foreach ($orders as $order)
                @if($order->rasloShipment)<a class="block text-orange-600" href="{{ route('raslo.tracking',$order) }}">{{ app()->getLocale()==='ar'?'متابعة التوصيل':'Delivery details' }}</a>@endif
                <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6">


                    <h2 class="font-bold text-xl dark:text-white mb-4">
                        Order Details
                    </h2>



                    <div class="space-y-3 text-gray-700 dark:text-gray-200">


                        <p>
                            Order Number:
                            <b>
                                {{ $order->order_number }}
                            </b>
                        </p>



                        <p>
                            Shop:
                            <b>
                                {{ $order->shop->name }}
                            </b>
                        </p>



                        <p>
                            Total:
                            <b>
                                {{ $order->shop->currency }}
                                {{ number_format($order->total, 2) }}
                            </b>
                        </p>



                        <p>
                            Status:
                            <b class="text-green-600">
                                {{ ucfirst($order->status) }}
                            </b>
                        </p>


                    </div>



                    <div class="mt-6 border-t pt-4">


                        <h3 class="font-semibold mb-3 dark:text-white">
                            Items
                        </h3>


                        <div class="space-y-2">


                            @foreach ($order->items as $item)
                                <div class="flex justify-between">


                                    <span class="dark:text-gray-200">
                                        {{ $item->listing_name }}
                                        × {{ $item->quantity }}
                                    </span>


                                    <span class="font-semibold dark:text-white">

                                        {{ number_format($item->total, 2) }}

                                    </span>


                                </div>
                            @endforeach


                        </div>


                    </div>



                </div>
            @endforeach


        </div>




        <div class="text-center">


            <a href="{{ route('profile') }}"
                class="inline-block mt-8 bg-orange-600 hover:bg-orange-700 
                text-white px-6 py-3 rounded-xl font-bold">

                View My Orders

            </a>


        </div>



    </div>

</x-main-layout>
