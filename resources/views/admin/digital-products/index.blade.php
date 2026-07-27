<x-admin>

    <div class="max-w-7xl mx-auto py-10 px-6">


        <div class="flex justify-between items-center mb-8">


            <div>

                <h1 class="text-3xl font-bold">
                    Digital Products
                </h1>

                <p class="text-gray-500 mt-2">
                    Manage murwaj digital marketplace products
                </p>

            </div>



            <a href="{{ route('digital-products.create') }}"
                class="bg-orange-500 text-white px-6 py-3 rounded-xl font-semibold">

                + Add Product

            </a>


        </div>





        {{-- Search --}}

        <form method="GET" class="mb-8 flex gap-4">


            <input name="search" value="{{ request('search') }}" placeholder="Search products..."
                class="flex-1 rounded-xl border-gray-300">



            <select name="status" class="rounded-xl border-gray-300">


                <option value="">
                    All Status
                </option>


                <option value="published" @selected(request('status') == 'published')>
                    Published
                </option>


                <option value="draft" @selected(request('status') == 'draft')>
                    Draft
                </option>


                <option value="archived" @selected(request('status') == 'archived')>
                    Archived
                </option>


            </select>



            <button class="bg-gray-900 text-white px-6 rounded-xl">

                Search

            </button>


        </form>







        <div class="bg-white rounded-3xl shadow overflow-hidden">


            <table class="w-full">


                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4 text-left">
                            Image
                        </th>

                        <th class="p-4 text-left">
                            Product
                        </th>


                        <th class="p-4">
                            Category
                        </th>


                        <th class="p-4">
                            Price
                        </th>


                        <th class="p-4">
                            Downloads
                        </th>


                        <th class="p-4">
                            Status
                        </th>


                        <th class="p-4">
                            Actions
                        </th>


                    </tr>

                </thead>




                <tbody>


                    @forelse($products as $product)
                        <tr class="border-t">


                            <td class="p-4">


                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="w-16 h-16 rounded-xl object-cover">


                            </td>





                            <td class="p-4">


                                <div class="font-bold">

                                    {{ $product->title }}

                                </div>


                                <div class="text-sm text-gray-500">

                                    {{ Str::limit($product->description, 50) }}

                                </div>


                                @if ($product->featured)
                                    <span class="text-yellow-500 text-sm">
                                        ★ Featured
                                    </span>
                                @endif


                            </td>





                            <td class="p-4">


                                {{ $product->digitalCategory?->category_name ?? 'No Category' }}


                            </td>





                            <td class="p-4 font-bold">


                                @if ($product->is_free)
                                    <span class="text-green-600">
                                        FREE
                                    </span>
                                @else
                                    ${{ number_format($product->price, 2) }}
                                @endif


                            </td>





                            <td class="p-4">

                                {{ number_format($product->downloads) }}

                            </td>





                            <td class="p-4">


                                @if ($product->status == 'published')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                        Published

                                    </span>
                                @elseif($product->status == 'draft')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                        Draft

                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">

                                        Archived

                                    </span>
                                @endif


                            </td>





                            <td class="p-4">


                                <div class="flex gap-2">


                                    <a href="#" class="px-3 py-2 bg-blue-100 text-blue-600 rounded-lg">

                                        Edit

                                    </a>


                                    <form method="POST" action="#">

                                        @csrf
                                        @method('DELETE')


                                        <button class="px-3 py-2 bg-red-100 text-red-600 rounded-lg">

                                            Delete

                                        </button>


                                    </form>


                                </div>


                            </td>


                        </tr>



                    @empty


                        <tr>

                            <td colspan="7" class="text-center p-10 text-gray-500">

                                No digital products found.

                            </td>

                        </tr>
                    @endforelse


                </tbody>


            </table>


        </div>




        <div class="mt-8">

            {{ $products->withQueryString()->links() }}

        </div>



    </div>


</x-admin>
