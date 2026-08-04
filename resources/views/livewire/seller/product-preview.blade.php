<div class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl overflow-hidden sticky top-24">

    {{-- Image --}}
    <div class="relative">

        @if ($image)
            <img src="{{ is_string($image) ? Storage::url($image) : $image->temporaryUrl() }}"
                class="w-full h-72 object-cover">
        @elseif(isset($listing) && $listing->image)
            <img src="{{ Storage::url($listing->image) }}" class="w-full h-72 object-cover">
        @else
            <div class="h-72 bg-gray-100 dark:bg-neutral-800 flex items-center justify-center">

                <div class="text-center">

                    <div class="text-6xl mb-3">
                        📦
                    </div>

                    <p class="text-gray-400">
                        Product Preview
                    </p>

                </div>

            </div>
        @endif

    </div>



    {{-- Details --}}
    <div class="p-6 space-y-4">

        <div>

            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">

                {{ $title ?: $listing->title ?? 'Product Title' }}

            </h2>

            <p class="mt-2 text-gray-500 dark:text-gray-400">

                {{ $description ?: $listing->description ?? 'Product description will appear here.' }}

            </p>

        </div>



        <div class="flex items-center justify-between">

            <div>

                <p class="text-xs uppercase tracking-wide text-gray-400">
                    Price
                </p>

                <p class="text-3xl font-black text-orange-500">

                    AED {{ number_format($price ?: $listing->price ?? 0, 2) }}

                </p>

            </div>

            <div class="text-right">

                <p class="text-xs text-gray-400">
                    Stock
                </p>

                <p class="font-semibold">

                    {{ $quantity ?: $listing->quantity ?? 1 }}

                </p>

            </div>

        </div>



        <div class="grid grid-cols-2 gap-3 text-sm">

            <div class="rounded-xl bg-gray-100 dark:bg-neutral-800 p-3">

                <p class="text-gray-400 text-xs">
                    Condition
                </p>

                <p class="font-semibold capitalize">

                    {{ $condition ?: $listing->condition ?? 'New' }}

                </p>

            </div>

            <div class="rounded-xl bg-gray-100 dark:bg-neutral-800 p-3">

                <p class="text-gray-400 text-xs">
                    Pricing
                </p>

                <p class="font-semibold capitalize">

                    {{ $price_condition ?: $listing->price_condition ?? 'Fixed' }}

                </p>

            </div>

        </div>



        @if (!empty($features))
            <div>

                <h4 class="font-semibold mb-2">
                    Features
                </h4>

                <div class="flex flex-wrap gap-2">

                    @foreach ($features as $feature)
                        <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs">
                            {{ $feature }}
                        </span>
                    @endforeach

                </div>

            </div>
        @endif



        @if (!empty($keywords))
            <div>

                <h4 class="font-semibold mb-2">
                    Keywords
                </h4>

                <div class="flex flex-wrap gap-2">

                    @foreach ($keywords as $keyword)
                        <span class="px-3 py-1 rounded-full bg-gray-200 dark:bg-neutral-700 text-xs">
                            #{{ $keyword }}
                        </span>
                    @endforeach

                </div>

            </div>
        @endif



        <button type="button" disabled class="w-full py-3 rounded-2xl bg-orange-500 text-white font-bold opacity-80">

            Preview Only

        </button>

    </div>

</div>
