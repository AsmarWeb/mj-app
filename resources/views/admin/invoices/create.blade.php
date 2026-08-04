<x-admin>

    <div class="max-w-4xl mx-auto px-6 py-10">

        <div class="bg-white rounded-2xl shadow-lg p-8">


            <div class="mb-8">

                <h1 class="text-3xl font-bold text-gray-900">
                    Create Service Invoice
                </h1>

                <p class="text-gray-500 mt-2">
                    Create an invoice for your services manually.
                </p>

            </div>



            <form method="POST" action="{{ route('invoices.store') }}">

                @csrf



                {{-- Customer Information --}}

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">


                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Customer Name
                        </label>

                        <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                            class="w-full rounded-lg border-gray-300" placeholder="Customer name" required>

                    </div>




                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Customer Email
                        </label>

                        <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                            class="w-full rounded-lg border-gray-300" placeholder="customer@email.com">

                    </div>



                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Customer Phone
                        </label>

                        <input type="text" name="customer_phone" value="{{ old('customer_phone') }}"
                            class="w-full rounded-lg border-gray-300" placeholder="Phone number">

                    </div>


                </div>





                {{-- Services --}}

                <div class="border-t pt-6">


                    <h2 class="text-xl font-bold mb-4">
                        Services
                    </h2>



                    <div id="items">


                        <div class="grid grid-cols-12 gap-3 mb-4 item">


                            <div class="col-span-6">

                                <input name="items[0][title]" placeholder="Service name"
                                    class="w-full rounded-lg border-gray-300" required>

                            </div>



                            <div class="col-span-2">

                                <input type="number" name="items[0][quantity]" value="1" min="1"
                                    class="w-full rounded-lg border-gray-300" required>

                            </div>



                            <div class="col-span-3">

                                <input type="number" step="0.01" name="items[0][price]" placeholder="Price"
                                    class="w-full rounded-lg border-gray-300" required>

                            </div>



                        </div>


                    </div>




                    <button type="button" onclick="addItem()" class="mb-6 text-indigo-600 font-semibold">

                        + Add Another Service

                    </button>



                </div>





                <div class="flex justify-end">


                    <button class="px-8 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">

                        Create Invoice

                    </button>


                </div>



            </form>


        </div>


    </div>





    <script>
        let itemIndex = 1;


        function addItem() {

            let html = `

    <div class="grid grid-cols-12 gap-3 mb-4">


        <div class="col-span-6">

            <input 
            name="items[${itemIndex}][title]"
            placeholder="Service name"
            class="w-full rounded-lg border-gray-300"
            required>

        </div>



        <div class="col-span-2">

            <input 
            type="number"
            name="items[${itemIndex}][quantity]"
            value="1"
            min="1"
            class="w-full rounded-lg border-gray-300"
            required>

        </div>



        <div class="col-span-3">

            <input 
            type="number"
            step="0.01"
            name="items[${itemIndex}][price]"
            placeholder="Price"
            class="w-full rounded-lg border-gray-300"
            required>

        </div>


    </div>

    `;


            document
                .getElementById('items')
                .insertAdjacentHTML('beforeend', html);


            itemIndex++;

        }
    </script>


</x-admin>
