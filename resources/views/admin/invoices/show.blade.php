<x-admin>

    <div class="max-w-5xl mx-auto px-6 py-10">

        <div class="bg-white shadow-xl rounded-2xl p-8">


            {{-- Header --}}
            <div class="flex flex-col md:flex-row justify-between gap-5 mb-10">


                <div>

                    <h1 class="text-3xl font-bold text-gray-900">
                        Invoice
                    </h1>


                    <p class="text-gray-500 mt-2">
                        {{ $invoice->invoice_number }}
                    </p>


                    <p class="text-sm text-gray-400">
                        {{ $invoice->created_at->format('d M Y') }}
                    </p>

                </div>



                <div class="flex items-start">

                    <a href="{{ route('invoices.download', $invoice) }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl shadow">

                        Download PDF

                    </a>

                </div>


            </div>





            {{-- Customer / Invoice Information --}}

            <div class="grid md:grid-cols-2 gap-6 mb-10">


                <div class="bg-gray-50 rounded-xl p-5">


                    <h2 class="font-bold text-lg mb-3">
                        Customer
                    </h2>


                    <p class="text-gray-700">
                        {{ $invoice->customer_name ?? 'Customer' }}
                    </p>


                    @if ($invoice->customer_email)
                        <p class="text-gray-500">
                            {{ $invoice->customer_email }}
                        </p>
                    @endif



                    @if ($invoice->customer_phone)
                        <p class="text-gray-500">
                            {{ $invoice->customer_phone }}
                        </p>
                    @endif


                </div>






                <div class="bg-gray-50 rounded-xl p-5">


                    <h2 class="font-bold text-lg mb-3">
                        Invoice Type
                    </h2>



                    @if ($invoice->order_id)
                        <span
                            class="inline-block px-4 py-2 rounded-full 
                    bg-blue-100 text-blue-700">

                            Store Order Invoice

                        </span>
                    @else
                        <span
                            class="inline-block px-4 py-2 rounded-full 
                    bg-purple-100 text-purple-700">

                            Service Invoice

                        </span>
                    @endif



                </div>


            </div>





            {{-- Shop Details only if order invoice --}}

            @if ($invoice->shop)


                <div class="border rounded-xl p-5 mb-10">


                    <h2 class="font-bold text-lg mb-3">
                        Store
                    </h2>


                    <p>
                        {{ $invoice->shop->name }}
                    </p>


                    @if ($invoice->shop->location)
                        <p class="text-gray-500">
                            {{ $invoice->shop->location }}
                        </p>
                    @endif


                </div>


            @endif







            {{-- Items --}}

            <div class="overflow-x-auto">


                <table class="w-full">


                    <thead>


                        <tr class="border-b bg-gray-50">


                            <th class="text-left p-4">
                                Service / Product
                            </th>


                            <th class="p-4">
                                Qty
                            </th>


                            <th class="p-4">
                                Price
                            </th>


                            <th class="p-4">
                                Total
                            </th>


                        </tr>


                    </thead>



                    <tbody>


                        @foreach ($invoice->items as $item)
                            <tr class="border-b">


                                <td class="p-4 font-medium">

                                    {{ $item->title }}

                                </td>



                                <td class="p-4 text-center">

                                    {{ $item->quantity }}

                                </td>



                                <td class="p-4 text-center">

                                    AED {{ number_format($item->price, 2) }}

                                </td>



                                <td class="p-4 text-center font-semibold">

                                    AED {{ number_format($item->total, 2) }}

                                </td>


                            </tr>
                        @endforeach



                    </tbody>


                </table>


            </div>





            {{-- Totals --}}

            <div class="mt-10 border-t pt-6 text-right">


                <p class="text-gray-600">

                    Subtotal:
                    AED {{ number_format($invoice->subtotal, 2) }}

                </p>



                @if ($invoice->tax > 0)
                    <p class="text-gray-600">

                        Tax:
                        AED {{ number_format($invoice->tax, 2) }}

                    </p>
                @endif



                <p class="text-2xl font-bold text-gray-900 mt-3">

                    Total:
                    AED {{ number_format($invoice->total, 2) }}

                </p>


            </div>



        </div>


    </div>


</x-admin>
