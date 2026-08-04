<x-admin>

    <div class="max-w-7xl mx-auto px-6 py-10">


        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Invoices
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage service invoices and store order invoices
                </p>
            </div>


            <a href="{{ route('invoices.create') }}"
                class="bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 shadow">

                + Create Service Invoice

            </a>

        </div>



        @if ($invoices->count())


            <div class="bg-white rounded-xl shadow overflow-hidden">


                <table class="w-full">


                    <thead class="bg-gray-100">

                        <tr>

                            <th class="p-4 text-left">
                                Invoice
                            </th>


                            <th class="p-4 text-left">
                                Type
                            </th>


                            <th class="p-4 text-left">
                                Customer
                            </th>


                            <th class="p-4 text-left">
                                Store
                            </th>


                            <th class="p-4 text-left">
                                Total
                            </th>


                            <th class="p-4 text-left">
                                Status
                            </th>


                            <th class="p-4">
                                Action
                            </th>


                        </tr>

                    </thead>




                    <tbody>


                        @foreach ($invoices as $invoice)
                            <tr class="border-t hover:bg-gray-50">


                                <td class="p-4">

                                    <div class="font-semibold text-gray-800">
                                        {{ $invoice->invoice_number }}
                                    </div>


                                    <div class="text-xs text-gray-500">
                                        {{ $invoice->created_at->format('d M Y') }}
                                    </div>

                                </td>



                                <td class="p-4">


                                    @if ($invoice->order_id)
                                        <span
                                            class="px-3 py-1 rounded-full text-xs
                        bg-blue-100 text-blue-700">

                                            Store Order

                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full text-xs
                        bg-purple-100 text-purple-700">

                                            Service Invoice

                                        </span>
                                    @endif


                                </td>





                                <td class="p-4">


                                    <div class="font-medium">

                                        @if ($invoice->user)
                                            <p>
                                                {{ $invoice->user->name }}
                                            </p>
                                        @else
                                            <p>
                                                {{ $invoice->customer_name ?? 'Customer' }}
                                            </p>
                                        @endif


                                    </div>


                                    @if ($invoice->customer_email)
                                        <div class="text-sm text-gray-500">

                                            {{ $invoice->customer_email }}

                                        </div>
                                    @endif


                                </td>





                                <td class="p-4">


                                    @if ($invoice->shop)
                                        <span class="font-medium">

                                            {{ $invoice->shop->name }}

                                        </span>
                                    @else
                                        <span class="text-gray-400">

                                            Platform Service

                                        </span>
                                    @endif


                                </td>





                                <td class="p-4 font-semibold">


                                    AED {{ number_format($invoice->total, 2) }}


                                </td>





                                <td class="p-4">


                                    <span
                                        class="px-3 py-1 rounded-full text-xs
                    @if ($invoice->status == 'paid') bg-green-100 text-green-700
                    @else
                        bg-yellow-100 text-yellow-700 @endif">

                                        {{ ucfirst($invoice->status) }}

                                    </span>


                                </td>





                                <td class="p-4">


                                    <a href="{{ route('invoices.show', $invoice) }}"
                                        class="text-indigo-600 font-semibold hover:text-indigo-800">

                                        View

                                    </a>


                                </td>


                            </tr>
                        @endforeach


                    </tbody>


                </table>


            </div>




            <div class="mt-6">

                {{ $invoices->links() }}

            </div>
        @else
            <div class="bg-white rounded-xl shadow p-12 text-center">


                <div class="text-6xl mb-5">
                    🧾
                </div>


                <h2 class="text-2xl font-bold text-gray-800 mb-3">

                    No invoices yet

                </h2>


                <p class="text-gray-500 mb-8">

                    Create a service invoice or wait for customer orders to generate invoices automatically.

                </p>



                <a href="{{ route('invoices.create') }}"
                    class="inline-flex items-center px-8 py-4 
           bg-indigo-600 text-white rounded-xl 
           font-semibold hover:bg-indigo-700">

                    Create First Invoice

                </a>


            </div>


        @endif


    </div>


</x-admin>
