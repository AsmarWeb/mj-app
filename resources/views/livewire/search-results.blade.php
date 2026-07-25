<div class="max-w-7xl mx-auto px-4 py-8">


    <!-- Search -->
    <div class="mb-8">

        <input wire:model.live.debounce.400ms="search" type="text" placeholder="Search listings..."
            class="w-full rounded-full border px-6 py-4 text-lg">

    </div>



    <div class="flex justify-between mb-6">

        <h2 class="text-2xl font-bold">

            Search Results

        </h2>


        <span class="text-gray-500">

            {{ $listings->total() }} items

        </span>

    </div>



    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">


        @forelse($listings as $listing)
            <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">


                <a href="{{ route('listing.show', $listing) }}">


                    <img src="{{ asset('storage/products/' . $listing->image) }}" class="h-52 w-full object-cover">


                </a>



                <div class="p-4">


                    <h3 class="font-semibold text-lg line-clamp-2">

                        {{ $listing->title }}

                    </h3>



                    <p class="text-gray-500 text-sm mt-2">

                        {{ $listing->shop->name ?? '' }}

                    </p>



                    <div class="mt-3 text-xl font-bold text-orange-600">

                        ${{ number_format($listing->price, 2) }}

                    </div>


                    <div class="mt-2 text-yellow-500">

                        ★★★★★

                    </div>



                </div>


            </div>


        @empty

            <div class="col-span-full text-center py-20">


                <h2 class="text-3xl font-bold">
                    No products found
                </h2>


                <p class="text-gray-500 mt-3">
                    We couldn't find
                    <strong>{{ $search }}</strong>
                    in our marketplace.
                </p>


                @if ($globalSearchUrl)
                    <a href="{{ $globalSearchUrl }}" target="_blank"
                        class="inline-block mt-6 bg-orange-500 text-white px-6 py-3 rounded-full hover:bg-orange-600">

                        Search the web for "{{ $search }}"

                    </a>
                @endif


            </div>

        @endempty


</div>



<div class="mt-8">

    {{ $listings->links() }}

</div>


</div>
