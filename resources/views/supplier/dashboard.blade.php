<x-supplier>

    <div class="min-h-screen bg-gray-100">

        <div class="max-w-7xl mx-auto px-6 py-10">


            {{-- HEADER --}}
            <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-3xl p-8 text-white shadow mb-8">

                <h1 class="text-4xl font-black">
                    Welcome {{ auth()->user()->name }} 👋
                </h1>

                <p class="mt-3 text-orange-100">
                    Manage fulfillment orders, products and payouts.
                </p>

            </div>



            {{-- STATS --}}

            <div class="grid md:grid-cols-4 gap-6 mb-8">


                <div class="bg-white rounded-2xl shadow p-6">

                    <p class="text-gray-500">
                        Products
                    </p>

                    <h2 class="text-4xl font-black">
                        {{ $products }}
                    </h2>

                </div>



                <div class="bg-white rounded-2xl shadow p-6">

                    <p class="text-gray-500">
                        New Orders
                    </p>

                    <h2 class="text-4xl font-black text-orange-600">
                        {{ $pendingOrders }}
                    </h2>

                </div>



                <div class="bg-white rounded-2xl shadow p-6">

                    <p class="text-gray-500">
                        Completed
                    </p>

                    <h2 class="text-4xl font-black text-green-600">
                        {{ $completedOrders }}
                    </h2>

                </div>



                <div class="bg-white rounded-2xl shadow p-6">

                    <p class="text-gray-500">
                        Earned
                    </p>

                    <h2 class="text-3xl font-black">
                        AED {{ number_format($revenue, 2) }}
                    </h2>

                </div>


            </div>





            {{-- FULFILLMENT ORDERS --}}

            <div class="bg-white rounded-3xl shadow overflow-hidden">


                <div class="p-6 border-b flex justify-between">

                    <h2 class="text-2xl font-black">
                        Fulfillment Orders
                    </h2>


                    <a href="{{ route('supplier.orders.index') }}" class="text-orange-600 font-bold">

                        View All

                    </a>


                </div>



                <table class="w-full">


                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-4 text-left">
                                Order
                            </th>


                            <th>
                                Product
                            </th>


                            <th>
                                Quantity
                            </th>


                            <th>
                                Status
                            </th>


                        </tr>

                    </thead>



                    <tbody>


                        @forelse($recentOrders as $order)
                            <tr class="border-t">


                                <td class="px-6 py-4 font-bold">

                                    #{{ $order->order_number }}

                                </td>



                                <td>

                                    {{ $order->product_name }}

                                </td>



                                <td>

                                    {{ $order->quantity }}

                                </td>



                                <td>


                                    @if ($order->status == 'pending')
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                                            New
                                        </span>
                                    @elseif($order->status == 'processing')
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">
                                            Production
                                        </span>
                                    @elseif($order->status == 'shipped')
                                        <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs">
                                            Shipped
                                        </span>
                                    @else
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                            Completed
                                        </span>
                                    @endif


                                </td>


                            </tr>


                        @empty


                            <tr>

                                <td colspan="4" class="text-center py-10 text-gray-400">

                                    No fulfillment orders

                                </td>

                            </tr>
                        @endforelse


                    </tbody>


                </table>


            </div>





            {{-- PRODUCTS --}}


            <div class="grid lg:grid-cols-2 gap-8 mt-8">


                <div class="bg-white rounded-3xl shadow p-6">


                    <div class="flex justify-between mb-5">


                        <h2 class="text-xl font-black">
                            Product Catalog
                        </h2>


                        <a href="{{ route('supplier.products.index') }}" class="text-orange-600">

                            Manage

                        </a>


                    </div>



                    @foreach ($recentProducts as $product)
                        <div class="flex items-center gap-4 border-b py-4">


                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="w-16 h-16 rounded-xl object-cover">



                            <div>


                                <h3 class="font-bold">

                                    {{ $product->title }}

                                </h3>


                                <p class="text-gray-500 text-sm">

                                    Production Cost:
                                    AED {{ number_format($product->base_cost, 2) }}

                                </p>


                            </div>


                        </div>
                    @endforeach


                </div>







                {{-- PAYOUT --}}


                <div class="bg-white rounded-3xl shadow p-6">


                    <h2 class="text-xl font-black mb-5">
                        Payouts
                    </h2>



                    <div class="space-y-4">


                        @forelse($payouts as $payout)
                            <div class="flex justify-between border-b pb-4">


                                <div>

                                    <p class="font-bold">

                                        Order #{{ $payout->order_id }}

                                    </p>


                                    <p class="text-sm text-gray-500">

                                        {{ $payout->created_at->format('M d,Y') }}

                                    </p>


                                </div>


                                <div class="text-right">


                                    <p class="font-black">

                                        AED {{ number_format($payout->amount, 2) }}

                                    </p>


                                    <span class="text-sm text-green-600">

                                        {{ ucfirst($payout->status) }}

                                    </span>


                                </div>


                            </div>



                        @empty


                            <p class="text-gray-400">

                                No payouts yet

                            </p>
                        @endforelse


                    </div>


                </div>


            </div>







            {{-- SUPPLIER INFO --}}


            <div class="bg-white rounded-3xl shadow p-6 mt-8">


                <h2 class="text-xl font-black mb-5">

                    Supplier Account

                </h2>


                <div class="grid md:grid-cols-3 gap-6">


                    <div>

                        <p class="text-gray-500">
                            Company
                        </p>

                        <p class="font-bold">
                            {{ $supplier->company }}
                        </p>

                    </div>


                    <div>

                        <p class="text-gray-500">
                            Type
                        </p>

                        <p class="font-bold">
                            {{ ucfirst($supplier->type) }}
                        </p>

                    </div>


                    <div>

                        <p class="text-gray-500">
                            Status
                        </p>

                        <p class="text-green-600 font-bold">
                            Active
                        </p>

                    </div>


                </div>


            </div>



        </div>

    </div>

</x-supplier>
