<x-admin>

    <div class="max-w-5xl mx-auto py-10 px-6">


        {{-- HEADER --}}
        <div class="mb-10">

            <h1 class="text-4xl font-black text-gray-900">
                Edit Supplier
            </h1>

            <p class="text-gray-500 mt-2">
                Update POD supplier information and integrations.
            </p>

        </div>





        {{-- ERRORS --}}

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







        <form method="POST" action="{{ route('suppliers.update', $supplier) }}" class="space-y-8">


            @csrf

            @method('PUT')







            {{-- BASIC INFORMATION --}}

            <div class="bg-white rounded-3xl shadow-sm p-8">


                <h2 class="text-xl font-black mb-6">
                    Supplier Information
                </h2>



                <div class="grid md:grid-cols-2 gap-6">



                    <div>

                        <label class="font-bold block mb-2">
                            Name *
                        </label>

                        <input name="name" value="{{ old('name', $supplier->name) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>





                    <div>

                        <label class="font-bold block mb-2">
                            Company
                        </label>

                        <input name="company" value="{{ old('company', $supplier->company) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>





                    <div>

                        <label class="font-bold block mb-2">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email', $supplier->email) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>






                    <div>

                        <label class="font-bold block mb-2">
                            Phone
                        </label>

                        <input name="phone" value="{{ old('phone', $supplier->phone) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>







                    <div>

                        <label class="font-bold block mb-2">
                            WhatsApp
                        </label>

                        <input name="whatsapp" value="{{ old('whatsapp', $supplier->whatsapp) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>






                    <div>

                        <label class="font-bold block mb-2">
                            Website
                        </label>

                        <input name="website" value="{{ old('website', $supplier->website) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>



                </div>


            </div>









            {{-- UAE INFORMATION --}}

            <div class="bg-white rounded-3xl shadow-sm p-8">


                <h2 class="text-xl font-black mb-6">
                    UAE Information
                </h2>




                <div class="grid md:grid-cols-2 gap-6">



                    <div>

                        <label class="font-bold block mb-2">
                            Country
                        </label>

                        <input name="country" value="{{ old('country', $supplier->country ?? 'UAE') }}"
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


                            @foreach (['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Umm Al Quwain', 'Ras Al Khaimah', 'Fujairah'] as $city)
                                <option value="{{ $city }}" @selected(old('emirate', $supplier->emirate) == $city)>

                                    {{ $city }}

                                </option>
                            @endforeach


                        </select>


                    </div>






                    <div>

                        <label class="font-bold block mb-2">
                            VAT / TRN
                        </label>

                        <input name="vat_number" value="{{ old('vat_number', $supplier->vat_number) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>






                    <div class="md:col-span-2">

                        <label class="font-bold block mb-2">
                            Address
                        </label>


                        <textarea name="address" rows="4" class="w-full rounded-xl border-gray-300">{{ old('address', $supplier->address) }}</textarea>


                    </div>



                </div>



            </div>









            {{-- POD SETTINGS --}}

            <div class="bg-white rounded-3xl shadow-sm p-8">


                <h2 class="text-xl font-black mb-6">
                    POD Settings
                </h2>



                <div class="grid md:grid-cols-3 gap-6">



                    <div>

                        <label class="font-bold block mb-2">
                            Supplier Type
                        </label>


                        <select name="type" class="w-full rounded-xl border-gray-300">


                            <option value="printful" @selected(old('type', $supplier->type) == 'printful')>
                                Printful
                            </option>


                            <option value="printify" @selected(old('type', $supplier->type) == 'printify')>
                                Printify
                            </option>


                            <option value="local" @selected(old('type', $supplier->type) == 'local')>
                                Local Supplier
                            </option>


                            <option value="manufacturer" @selected(old('type', $supplier->type) == 'manufacturer')>
                                Manufacturer
                            </option>


                            <option value="other" @selected(old('type', $supplier->type) == 'other')>
                                Other
                            </option>


                        </select>


                    </div>







                    <div>

                        <label class="font-bold block mb-2">
                            Commission %
                        </label>


                        <input type="number" step="0.01" name="commission"
                            value="{{ old('commission', $supplier->commission) }}"
                            class="w-full rounded-xl border-gray-300">


                    </div>






                    <div>

                        <label class="font-bold block mb-2">
                            Status
                        </label>


                        <select name="status" class="w-full rounded-xl border-gray-300">


                            <option value="active" @selected(old('status', $supplier->status) == 'active')>
                                Active
                            </option>


                            <option value="inactive" @selected(old('status', $supplier->status) == 'inactive')>
                                Inactive
                            </option>


                        </select>


                    </div>



                </div>


            </div>









            {{-- API --}}

            <div class="bg-white rounded-3xl shadow-sm p-8">


                <h2 class="text-xl font-black mb-6">
                    API Integration
                </h2>



                <label class="font-bold block mb-2">
                    API Key
                </label>


                <input name="api_key" placeholder="Enter new API key" class="w-full rounded-xl border-gray-300">


                <p class="text-sm text-gray-500 mt-2">
                    Leave empty to keep current API connection.
                </p>



            </div>









            <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-5 rounded-2xl font-black text-lg">


                Update Supplier


            </button>





        </form>


    </div>


</x-admin>
