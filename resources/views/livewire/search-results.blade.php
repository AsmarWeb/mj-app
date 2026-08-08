<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- Search --}}
    <div class="mb-10">
        <div class="relative">
            <svg class="absolute left-5 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-5.2-5.2m2.2-5.3A7 7 0 1110 3a7 7 0 017 7z" />
            </svg>

            <input wire:model.live.debounce.500ms="search" type="text"
                placeholder="Search listings, digital products..."
                class="w-full rounded-2xl border border-gray-200 dark:border-gray-700
                       bg-white dark:bg-neutral-900
                       pl-14 pr-6 py-4
                       text-lg
                       text-gray-900 dark:text-white
                       shadow-sm
                       focus:ring-2 focus:ring-orange-500
                       focus:border-orange-500">
        </div>
    </div>


    {{-- Listings --}}
    <section class="mb-14">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold dark:text-white">
                Marketplace Listings
            </h2>

            <span class="px-4 py-2 rounded-full bg-orange-100 text-orange-700 text-sm font-semibold">
                {{ $listings->total() }} Results
            </span>

        </div>

        @if ($listings->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach ($listings as $listing)
                    <div
                        class="group bg-white dark:bg-neutral-900 rounded-3xl overflow-hidden shadow hover:shadow-2xl transition">

                        <a href="{{ route('listing.show', $listing) }}">

                            <img src="{{ $listing->image ? asset('storage/products/' . $listing->image) : asset('images/no-image.png') }}"
                                class="h-56 w-full object-cover group-hover:scale-105 transition duration-300">

                        </a>

                        <div class="p-5">

                            <h3 class="font-bold text-lg dark:text-white line-clamp-2">

                                {{ $listing->title }}

                            </h3>

                            <p class="text-sm text-gray-500 mt-2">

                                {{ optional($listing->shop)->name }}

                            </p>

                            <div class="flex items-center justify-between mt-5">

                                <span class="text-2xl font-black text-orange-600">
                                    ${{ number_format($listing->price, 2) }}
                                </span>

                                <span
                                    class="text-xs px-3 py-1 rounded-full bg-gray-100 dark:bg-neutral-800 dark:text-gray-300">
                                    Listing
                                </span>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

            <div class="mt-8">
                {{ $listings->links() }}
            </div>
        @else
            <div class="rounded-3xl bg-white dark:bg-neutral-900 p-12 text-center shadow">

                <div class="text-5xl mb-4">
                    📦
                </div>

                <h3 class="text-xl font-bold dark:text-white">
                    No marketplace listings found
                </h3>

            </div>

        @endif

    </section>


    {{-- Digital Products --}}
    <section>

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold dark:text-white">
                Digital Products
            </h2>

            <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">
                {{ $digitalProducts->count() }} Results
            </span>

        </div>

        @if ($digitalProducts->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach ($digitalProducts as $product)
                    <div
                        class="group bg-white dark:bg-neutral-900 rounded-3xl overflow-hidden shadow hover:shadow-2xl transition">

                        <a href="{{ route('digital-products.show', $product->slug) }}">

                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}"
                                class="h-56 w-full object-cover group-hover:scale-105 transition duration-300">

                        </a>

                        <div class="p-5">

                            <h3 class="font-bold text-lg dark:text-white line-clamp-2">

                                {{ $product->title }}

                            </h3>

                            <p class="text-sm text-gray-500 mt-2">

                                {{ optional($product->supplier)->company }}

                            </p>

                            <div class="flex items-center justify-between mt-5">

                                <span class="text-2xl font-black text-orange-600">

                                    ${{ number_format($product->price, 2) }}

                                </span>

                                @if ($product->type === 'digital')
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs">

                                        Digital

                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">

                                        POD

                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        @else
            <div class="rounded-3xl bg-white dark:bg-neutral-900 p-12 text-center shadow">

                <div class="text-5xl mb-4">
                    💻
                </div>

                <h3 class="text-xl font-bold dark:text-white">
                    No digital products found
                </h3>

            </div>

        @endif

    </section>


    {{-- Empty State --}}
    @if ($listings->total() == 0 && $digitalProducts->count() == 0)

        <div class="mt-16 rounded-3xl bg-white dark:bg-neutral-900 p-14 text-center shadow">

            <div class="text-7xl mb-6">
                🔍
            </div>

            <h2 class="text-3xl font-bold dark:text-white">

                Nothing matched your search

            </h2>

            <p class="mt-3 text-gray-500">

                No listings or digital products matched
                <strong>{{ $search }}</strong>.

            </p>

            @if ($globalSearchUrl)
                <a href="{{ $globalSearchUrl }}" target="_blank"
                    class="inline-flex mt-8 rounded-xl bg-orange-500 px-6 py-3 text-white font-semibold hover:bg-orange-600">

                    Search the Web

                </a>
            @endif

        </div>

    @endif

</div>
