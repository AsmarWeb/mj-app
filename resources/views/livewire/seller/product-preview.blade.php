<div class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl overflow-hidden sticky top-24">

    {{-- Image --}}
    {{-- Product Image / Preview --}}

    <div class="relative h-72 w-full overflow-hidden bg-gray-100 dark:bg-neutral-800">

        ```
        @php
            $imageUrl = null;

            // Livewire temporary upload
            if ($image && is_object($image) && method_exists($image, 'temporaryUrl')) {
                $imageUrl = $image->temporaryUrl();
            }

            // Existing stored image path
            elseif ($image && is_string($image)) {
                $imageUrl = \Illuminate\Support\Facades\Storage::url($image);
            }

            // Existing listing image
            elseif (isset($listing) && !empty($listing->image)) {
                $imageUrl = \Illuminate\Support\Facades\Storage::url($listing->image);
            }
        @endphp

        @if ($imageUrl)
            <img src="{{ $imageUrl }}" alt="{{ $listing->title ?? 'Product Preview' }}"
                class="h-full w-full object-cover">
        @else
            <div class="flex h-full w-full items-center justify-center">

                <div class="text-center">

                    <div
                        class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-4xl shadow-sm dark:bg-neutral-900">
                        📦
                    </div>

                    <p class="text-sm font-medium text-gray-400 dark:text-gray-500">
                        Product Preview
                    </p>

                </div>

            </div>
        @endif
        ```

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
