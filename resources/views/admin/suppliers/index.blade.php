<x-admin>

    <div class="max-w-7xl mx-auto py-10 px-6">


        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-5">


            <div>

                <h1 class="text-4xl font-black text-gray-900">
                    POD Suppliers
                </h1>

                <p class="text-gray-500 mt-2">
                    Manage Printful, Printify and manufacturing partners.
                </p>

            </div>



            <a href="{{ route('suppliers.create') }}"
                class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-2xl font-bold shadow">

                + Add Supplier

            </a>


        </div>





        {{-- SUCCESS --}}

        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-200 text-green-700 p-5 rounded-2xl">

                {{ session('success') }}

            </div>
        @endif






        {{-- SEARCH --}}

        <form method="GET" class="bg-white rounded-3xl shadow-sm p-5 mb-8 flex flex-col md:flex-row gap-4">


            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search supplier..."
                class="flex-1 rounded-xl border-gray-300">


            <select name="status" class="rounded-xl border-gray-300">


                <option value="">
                    All Status
                </option>


                <option value="active" @selected(request('status') == 'active')>
                    Active
                </option>


                <option value="inactive" @selected(request('status') == 'inactive')>
                    Inactive
                </option>


            </select>



            <button class="bg-gray-900 text-white px-6 rounded-xl font-bold">

                Search

            </button>


        </form>









        {{-- SUPPLIER TABLE --}}

        <div class="bg-white rounded-3xl shadow overflow-hidden">


            <div class="overflow-x-auto">


                <table class="w-full">


                    <thead class="bg-gray-50">


                        <tr class="text-left text-sm text-gray-500">


                            <th class="p-5">
                                Supplier
                            </th>


                            <th class="p-5">
                                Type
                            </th>


                            <th class="p-5">
                                Commission
                            </th>


                            <th class="p-5">
                                Products
                            </th>


                            <th class="p-5">
                                Status
                            </th>


                            <th class="p-5">
                                Actions
                            </th>


                        </tr>


                    </thead>





                    <tbody>


                        @forelse($suppliers as $supplier)
                            <tr class="border-t hover:bg-gray-50 transition">


                                {{-- NAME --}}

                                <td class="p-5">


                                    <div class="font-bold text-gray-900">

                                        {{ $supplier->name }}

                                    </div>


                                    @if ($supplier->company)
                                        <div class="text-sm text-gray-500">

                                            {{ $supplier->company }}

                                        </div>
                                    @endif


                                    @if ($supplier->email)
                                        <div class="text-xs text-gray-400 mt-1">

                                            {{ $supplier->email }}

                                        </div>
                                    @endif


                                </td>






                                {{-- TYPE --}}

                                <td class="p-5">


                                    @switch($supplier->type)
                                        @case('printful')
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-700">

                                                Printful

                                            </span>
                                        @break

                                        @case('printify')
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">

                                                Printify

                                            </span>
                                        @break

                                        @case('local')
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">

                                                Local

                                            </span>
                                        @break

                                        @default
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100">

                                                Other

                                            </span>
                                    @endswitch


                                </td>







                                {{-- COMMISSION --}}

                                <td class="p-5 font-bold">


                                    {{ number_format($supplier->commission, 2) }}%


                                </td>







                                {{-- PRODUCTS --}}

                                <td class="p-5">


                                    <span class="font-bold">

                                        {{ $supplier->products_count ?? $supplier->products->count() }}

                                    </span>


                                    <span class="text-gray-500 text-sm">

                                        products

                                    </span>


                                </td>







                                {{-- STATUS --}}

                                <td class="p-5">


                                    @if ($supplier->status === 'active')
                                        <span
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">

                                            Active

                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">

                                            Inactive

                                        </span>
                                    @endif


                                </td>







                                {{-- ACTIONS --}}

                                <td class="p-5">


                                    <div class="flex gap-2">


                                        <a href="{{ route('suppliers.edit', $supplier) }}"
                                            class="px-4 py-2 rounded-xl bg-orange-100 text-orange-700 font-bold text-sm">


                                            Edit


                                        </a>





                                        <form method="POST" action="{{ route('suppliers.destroy', $supplier) }}">


                                            @csrf

                                            @method('DELETE')


                                            <button onclick="return confirm('Delete supplier?')"
                                                class="px-4 py-2 rounded-xl bg-red-100 text-red-700 font-bold text-sm">


                                                Delete


                                            </button>


                                        </form>


                                    </div>


                                </td>



                            </tr>


                            @empty


                                <tr>

                                    <td colspan="6" class="p-20 text-center">


                                        <div class="text-5xl">
                                            🏭
                                        </div>


                                        <h3 class="font-bold text-xl mt-4">

                                            No suppliers found

                                        </h3>


                                        <p class="text-gray-500 mt-2">

                                            Add your first POD supplier.

                                        </p>


                                    </td>


                                </tr>
                            @endforelse



                        </tbody>


                    </table>


                </div>



            </div>





            {{-- PAGINATION --}}

            <div class="mt-8">

                {{ $suppliers->links() }}

            </div>



        </div>


    </x-admin>
