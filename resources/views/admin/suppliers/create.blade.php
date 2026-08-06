<x-admin>

    <div class="max-w-5xl mx-auto py-10 px-6">


        <div class="mb-10">

            <h1 class="text-4xl font-black text-gray-900">
                Add POD Supplier
            </h1>

            <p class="text-gray-500 mt-2">
                Add a Print On Demand supplier from UAE or international providers.
            </p>

        </div>




        @if ($errors->any())

            <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-5">

                <ul class="list-disc ml-5 text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>

        @endif





        <form method="POST" action="{{ route('suppliers.store') }}" class="space-y-8">

            @csrf




            <div class="bg-white rounded-3xl shadow-sm p-8">

                <h2 class="text-xl font-black mb-6">
                    Supplier Information
                </h2>


                <div class="grid md:grid-cols-2 gap-6">


                    <div>

                        <label class="font-bold block mb-2">
                            Name *
                        </label>

                        <input name="name" value="{{ old('name') }}" class="w-full rounded-xl border-gray-300"
                            placeholder="Supplier name">

                    </div>



                    <div>

                        <label class="font-bold block mb-2">
                            Company
                        </label>

                        <input name="company" value="{{ old('company') }}" class="w-full rounded-xl border-gray-300"
                            placeholder="Company LLC">

                    </div>



                    <div>

                        <label class="font-bold block mb-2">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full rounded-xl border-gray-300" placeholder="email@example.com">

                    </div>




                    <div>

                        <label class="font-bold block mb-2">
                            Phone
                        </label>

                        <input name="phone" value="{{ old('phone') }}" class="w-full rounded-xl border-gray-300"
                            placeholder="+971">

                    </div>




                    <div>

                        <label class="font-bold block mb-2">
                            WhatsApp
                        </label>

                        <input name="whatsapp" value="{{ old('whatsapp') }}" class="w-full rounded-xl border-gray-300">

                    </div>




                    <div>

                        <label class="font-bold block mb-2">
                            Website
                        </label>

                        <input name="website" value="{{ old('website') }}" class="w-full rounded-xl border-gray-300">

                    </div>


                </div>

            </div>







            <div class="bg-white rounded-3xl shadow-sm p-8">


                <h2 class="text-xl font-black mb-6">
                    UAE Location
                </h2>


                <div class="grid md:grid-cols-2 gap-6">


                    <div>

                        <label class="font-bold block mb-2">
                            Country
                        </label>

                        <input name="country" value="{{ old('country', 'UAE') }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>





                    <div>

                        <label class="font-bold block mb-2">
                            Emirate
                        </label>


                        <select name="emirate" class="w-full rounded-xl border-gray-300">


                            <option value="">
                                Select Emirate
                            </option>


                            @foreach (['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Umm Al Quwain', 'Ras Al Khaimah', 'Fujairah'] as $emirate)
                                <option value="{{ $emirate }}" @selected(old('emirate') == $emirate)>

                                    {{ $emirate }}

                                </option>
                            @endforeach


                        </select>


                    </div>





                    <div class="md:col-span-2">

                        <label class="font-bold block mb-2">
                            Address
                        </label>

                        <textarea name="address" rows="4" class="w-full rounded-xl border-gray-300">{{ old('address') }}</textarea>

                    </div>




                    <div>

                        <label class="font-bold block mb-2">
                            VAT / TRN
                        </label>

                        <input name="vat_number" value="{{ old('vat_number') }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>



                </div>


            </div>








            <div class="bg-white rounded-3xl shadow-sm p-8">


                <h2 class="text-xl font-black mb-6">
                    POD Settings
                </h2>



                <div class="grid md:grid-cols-2 gap-6">



                    <div>

                        <label class="font-bold block mb-2">
                            Supplier Type
                        </label>


                        <select name="type" class="w-full rounded-xl border-gray-300">


                            <option value="printful">
                                Printful
                            </option>

                            <option value="printify">
                                Printify
                            </option>

                            <option value="local">
                                Local Supplier
                            </option>

                            <option value="manufacturer">
                                Manufacturer
                            </option>

                            <option value="other">
                                Other
                            </option>


                        </select>


                    </div>





                    <div>

                        <label class="font-bold block mb-2">
                            Commission %
                        </label>


                        <input type="number" step="0.01" name="commission" value="{{ old('commission') }}"
                            class="w-full rounded-xl border-gray-300">


                    </div>


                </div>





                <div class="mt-6">

                    <label class="font-bold block mb-2">
                        API Key
                    </label>


                    <input name="api_key" class="w-full rounded-xl border-gray-300" placeholder="Optional">


                </div>


            </div>








            <div class="bg-white rounded-3xl shadow-sm p-8">


                <h2 class="text-xl font-black mb-6">
                    Status
                </h2>



                <select name="status" class="w-full rounded-xl border-gray-300">


                    <option value="active">
                        Active
                    </option>


                    <option value="inactive">
                        Inactive
                    </option>


                </select>


            </div>






            <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white py-5 rounded-2xl font-black text-lg">

                Save Supplier

            </button>




        </form>


    </div>


</x-admin>
