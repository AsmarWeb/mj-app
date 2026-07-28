<x-admin>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">


                <div>

                    <div class="flex items-center gap-3">

                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                            Listings
                        </h2>


                        <span class="px-3 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded-full">
                            {{ $listings->total() }} listings
                        </span>


                    </div>


                    <p class="text-sm text-gray-500 mt-1">
                        Manage your listings
                    </p>


                </div>




                <a href="{{ route('admin.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">


                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />

                    </svg>


                    Add Listing

                </a>


            </div>






            @if (session('success'))
                <div class="p-4 mb-5 text-sm text-green-700 bg-green-100 rounded-lg">

                    {{ session('success') }}

                </div>
            @endif







            <div class="bg-white rounded-xl shadow border overflow-hidden">



                {{-- Search --}}
                <div class="p-6 border-b">


                    <form method="GET" action="{{ route('listings.index') }}">


                        <div class="relative w-full md:w-96">


                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">

                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">

                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />

                                </svg>

                            </div>


                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search listings..."
                                class="w-full pl-10 rounded-lg border-gray-300 focus:ring-blue-500">


                        </div>


                    </form>


                </div>







                <div class="overflow-x-auto">


                    <table class="w-full text-left">


                        <thead class="bg-gray-50 border-b">


                            <tr>


                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    #
                                </th>


                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    Image
                                </th>


                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    Title
                                </th>


                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    featured
                                </th>


                                <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-right">
                                    Actions
                                </th>


                            </tr>


                        </thead>






                        <tbody class="divide-y">


                            @forelse($listings as $listing)
                                <tr class="hover:bg-gray-50">


                                    <td class="px-6 py-4">
                                        {{ $listing->id }}
                                    </td>





                                    <td class="px-6 py-4">


                                        @if ($listing->image)
                                            <img src="{{ Storage::url('products/' . $listing->image) }}"
                                                class="w-16 h-16 rounded-lg object-cover" alt="{{ $listing->title }}">
                                        @else
                                            <div
                                                class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">

                                                No Image

                                            </div>
                                        @endif


                                    </td>





                                    <td class="px-6 py-4">


                                        <a href="{{ route('listings.edit', $listing->id) }}"
                                            class="text-blue-600 hover:underline font-medium">

                                            {{ $listing->title }}

                                        </a>


                                        <p class="text-xs text-gray-500">

                                            {{ $listing->slug }}

                                        </p>


                                    </td>









                                    <td class="px-6 py-4">

                                        @if ($listing->active)
                                            <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-2 py-1 rounded bg-red-100 text-red-700 text-xs">
                                                Inactive
                                            </span>
                                        @endif

                                        <div class="mt-2">
                                            @switch($listing->status)
                                                @case('published')
                                                    <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs">
                                                        Published
                                                    </span>
                                                @break

                                                @case('draft')
                                                    <span class="px-2 py-1 rounded bg-gray-100 text-gray-700 text-xs">
                                                        Draft
                                                    </span>
                                                @break

                                                @case('expired')
                                                    <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 text-xs">
                                                        Expired
                                                    </span>
                                                @break

                                                @case('archived')
                                                    <span class="px-2 py-1 rounded bg-slate-200 text-slate-700 text-xs">
                                                        Archived
                                                    </span>
                                                @break
                                            @endswitch
                                        </div>

                                    </td>



                                    <td class="px-6 py-4">
                                        @if ($listing->featured)
                                            <div
                                                class="inline-flex items-center gap-2 rounded-full bg-emerald-500 text-white px-4 py-2 shadow">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-7.5 7.5a1 1 0 01-1.414 0l-3-3a1 1 0 011.414-1.414L8.5 12.086l6.793-6.793a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                Featured

                                            </div>
                                        @else
                                            <div
                                                class="inline-flex items-center gap-2 rounded-full bg-slate-200 text-slate-700 px-4 py-2">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 8v4m0 4h.01M10.29 3.86L1.82 18A2 2 0 003.53 21h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                                                </svg>

                                                Not Featured

                                            </div>
                                        @endif
                                    </td>






                                    <td class="px-6 py-4 text-right">

                                        <div class="flex justify-end gap-2">

                                            @if ($listing->featured)
                                                <form action="{{ route('listings.unfeatured', $listing->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white">
                                                        Remove Featured
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('listings.featured', $listing->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">
                                                        Feature Listing
                                                    </button>
                                                </form>
                                            @endif


                                            <a href="{{ route('listings.edit', $listing->id) }}"
                                                class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                                                Edit

                                            </a>





                                            <form action="{{ route('listings.destroy', $listing->id) }}"
                                                method="POST">


                                                @csrf

                                                @method('DELETE')


                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete?')"
                                                    class="px-3 py-1.5 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700">

                                                    Delete

                                                </button>


                                            </form>



                                        </div>


                                    </td>



                                </tr>



                                @empty


                                    <tr>

                                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">

                                            No listings found

                                        </td>

                                    </tr>
                                @endforelse



                            </tbody>


                        </table>


                    </div>







                    <div class="px-6 py-4 border-t">

                        {{ $listings->links() }}

                    </div>



                </div>


            </div>

        </div>

    </x-admin>
