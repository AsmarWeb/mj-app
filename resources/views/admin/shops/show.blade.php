<x-admin>

    <div class="py-10 bg-gray-50 min-h-screen">

        <div class="max-w-7xl mx-auto px-6">


            {{-- Store Header --}}

            <div class="bg-white rounded-2xl shadow-sm border p-6 mb-8">


                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">


                    <div class="flex items-center gap-5">


                        @if ($shop->logo)
                            <img src="{{ asset('storage/' . $shop->logo) }}"
                                class="w-20 h-20 rounded-2xl object-cover border">
                        @else
                            <div
                                class="w-20 h-20 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600 text-3xl font-bold">

                                {{ strtoupper(substr($shop->name, 0, 1)) }}

                            </div>
                        @endif



                        <div>

                            <h1 class="text-2xl font-bold text-gray-900">

                                {{ $shop->name }}

                            </h1>


                            <p class="text-gray-500">

                                {{ $shop->location }}

                            </p>


                            <div class="flex gap-2 mt-3">


                                @if ($shop->verified)
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">

                                        Verified

                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-600">

                                        Not verified

                                    </span>
                                @endif


                            </div>


                        </div>


                    </div>



                    <div class="text-right">

                        <p class="text-sm text-gray-500">
                            Owner
                        </p>

                        <p class="font-semibold">
                            {{ $shop->user->name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $shop->user->email }}
                        </p>


                    </div>


                </div>


            </div>






            {{-- Stats --}}

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">


                <div class="bg-white rounded-xl border p-5">

                    <p class="text-sm text-gray-500">
                        Products
                    </p>

                    <h2 class="text-3xl font-bold">

                        {{ $shop->listings->count() }}

                    </h2>

                </div>



                <div class="bg-white rounded-xl border p-5">

                    <p class="text-sm text-gray-500">
                        Active
                    </p>

                    <h2 class="text-3xl font-bold text-green-600">

                        {{ $shop->listings->where('active', 1)->count() }}

                    </h2>

                </div>




                <div class="bg-white rounded-xl border p-5">

                    <p class="text-sm text-gray-500">
                        Published
                    </p>

                    <h2 class="text-3xl font-bold text-blue-600">

                        {{ $shop->listings->where('status', 'published')->count() }}

                    </h2>

                </div>




                <div class="bg-white rounded-xl border p-5">

                    <p class="text-sm text-gray-500">
                        Created
                    </p>

                    <h2 class="text-lg font-bold">
                        {{ $shop->created_at ? $shop->created_at->format('M Y') : 'N/A' }}
                    </h2>

                </div>


            </div>







            {{-- Products --}}

            <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">


                <div class="px-6 py-5 border-b flex justify-between items-center">


                    <div>

                        <h2 class="text-xl font-bold">

                            Products

                        </h2>

                        <p class="text-sm text-gray-500">

                            Manage everything in this store

                        </p>

                    </div>


                </div>





                <div class="overflow-x-auto">


                    <table class="w-full">


                        <thead class="bg-gray-50">


                            <tr>

                                <th class="px-6 py-4 text-left text-sm">
                                    Product
                                </th>

                                <th class="px-6 py-4 text-left text-sm">
                                    Price
                                </th>


                                <th class="px-6 py-4 text-left text-sm">
                                    Control
                                </th>


                                <th class="px-6 py-4 text-right text-sm">
                                    Actions
                                </th>


                            </tr>


                        </thead>



                        <tbody class="divide-y">


                            @forelse($shop->listings as $listing)


                                <tr>


                                    <td class="px-6 py-5">


                                        <div class="flex items-center gap-4">


                                            @if ($listing->image)
                                                <img src="{{ Storage::url('products/' . $listing->image) }}"
                                                    class="w-14 h-14 rounded-xl object-cover">
                                            @endif


                                            <div>

                                                <p class="font-semibold">
                                                    {{ $listing->title }}
                                                </p>


                                                <p class="text-xs text-gray-500">
                                                    {{ $listing->slug }}
                                                </p>


                                            </div>


                                        </div>


                                    </td>





                                    <td class="px-6 py-5 font-semibold">

                                        {{ $listing->price }}

                                    </td>







                                    <td class="px-6 py-5">


                                        <form method="POST"
                                            action="{{ route('admin.shops.products.update', $listing) }}">

                                            @csrf
                                            @method('PATCH')



                                            <select name="active" class="rounded-lg border mb-2">


                                                <option value="1" {{ $listing->active ? 'selected' : '' }}>

                                                    Active

                                                </option>


                                                <option value="0" {{ !$listing->active ? 'selected' : '' }}>

                                                    Hidden

                                                </option>


                                            </select>



                                            <select name="status" class="rounded-lg border">


                                                @foreach (['draft', 'published', 'expired', 'archived'] as $status)
                                                    <option value="{{ $status }}"
                                                        {{ $listing->status == $status ? 'selected' : '' }}>

                                                        {{ ucfirst($status) }}

                                                    </option>
                                                @endforeach


                                            </select>



                                            <button class="ml-2 px-3 py-2 bg-blue-600 text-white rounded-lg text-sm">

                                                Save

                                            </button>


                                        </form>


                                    </td>






                                    <td class="px-6 py-5 text-right">


                                        <form method="POST"
                                            action="{{ route('admin.shops.products.delete', $listing) }}">

                                            @csrf
                                            @method('DELETE')


                                            <button onclick="return confirm('Delete product?')"
                                                class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm">

                                                Delete

                                            </button>


                                        </form>


                                    </td>



                                </tr>


                            @empty


                                <tr>

                                    <td colspan="4" class="py-10 text-center text-gray-500">

                                        No products in this store

                                    </td>

                                </tr>


                            @endforelse



                        </tbody>


                    </table>


                </div>


            </div>




        </div>

    </div>


</x-admin>
