@php
    /*
    |--------------------------------------------------------------------------
    | PREVIEW VALUES
    |--------------------------------------------------------------------------
    */

    $previewTitle = filled($title) ? $title : $listing?->title ?? 'Your Product Title';

    $previewDescription = filled($description)
        ? $description
        : $listing?->description ?? 'Your product description will appear here.';

    $previewPrice = $price !== null && $price !== '' ? $price : $listing?->price ?? 0;

    $previewQuantity = $quantity !== null && $quantity !== '' ? $quantity : $listing?->quantity ?? 1;

    $previewCondition = filled($condition) ? $condition : $listing?->condition ?? 'new';

    $previewPriceCondition = filled($price_condition) ? $price_condition : $listing?->price_condition ?? 'fixed';

    /*
    |--------------------------------------------------------------------------
    | BRAND
    |--------------------------------------------------------------------------
    */

    $previewLocalBrandName = $listing?->local_brand_name;

    $previewLocalBrandNameAr = $listing?->local_brand_name_ar;

    $previewBrand = $listing?->brand;

    $hasLocalBrand = filled($previewLocalBrandName) || filled($previewLocalBrandNameAr);

    $hasExistingBrand = $previewBrand !== null;

    /*
    |--------------------------------------------------------------------------
    | IMAGE
    |--------------------------------------------------------------------------
    */

    $previewImage = $this->imageUrl;

    /*
    |--------------------------------------------------------------------------
    | FEATURES
    |--------------------------------------------------------------------------
    */

    $validFeatures = collect($features ?? [])
        ->filter(fn($feature) => is_string($feature) && trim($feature) !== '')
        ->map(fn($feature) => trim($feature))
        ->values();

    /*
    |--------------------------------------------------------------------------
    | KEYWORDS
    |--------------------------------------------------------------------------
    */

    $validKeywords = collect($keywords ?? [])
        ->filter(fn($keyword) => is_string($keyword) && trim($keyword) !== '')
        ->map(fn($keyword) => trim($keyword))
        ->values();

@endphp


<div
    class="relative sticky top-6 overflow-hidden rounded-[28px]
           bg-white shadow-[0_12px_50px_rgba(0,0,0,0.10)]
           ring-1 ring-black/5
           dark:bg-neutral-950 dark:ring-white/10">

    {{-- =========================================================
        PRODUCT IMAGE
    ========================================================== --}}

    <div class="relative h-[420px] overflow-hidden
               bg-neutral-100 dark:bg-neutral-900">

        @if ($previewImage)
            <img src="{{ $previewImage }}" alt="{{ $previewTitle }}" class="h-full w-full object-cover" loading="eager">

            <div
                class="pointer-events-none absolute inset-x-0 bottom-0 h-48
                       bg-gradient-to-t from-black/70 via-black/20 to-transparent">
            </div>
        @else
            <div class="flex h-full w-full items-center justify-center">

                <div class="px-6 text-center">

                    <div
                        class="mx-auto flex h-24 w-24 items-center justify-center
                               rounded-[28px] bg-white text-5xl shadow-xl
                               dark:bg-neutral-800">
                        🛍️
                    </div>

                    <p
                        class="mt-4 text-sm font-bold
                               text-neutral-500 dark:text-neutral-400">
                        Your product photo
                    </p>

                    <p
                        class="mx-auto mt-1 max-w-[220px]
                               text-xs leading-5 text-neutral-400">
                        Add an image to make your product stand out.
                    </p>

                </div>

            </div>
        @endif


        {{-- LIVE PREVIEW --}}

        <div class="absolute left-4 top-4 z-10">

            <span
                class="inline-flex items-center gap-2 rounded-full
                       bg-black/70 px-3.5 py-2
                       text-xs font-bold text-white
                       shadow-lg backdrop-blur-md">

                <span class="relative flex h-2 w-2">

                    <span
                        class="absolute inline-flex h-full w-full
                               animate-ping rounded-full
                               bg-emerald-400 opacity-75"></span>

                    <span
                        class="relative inline-flex h-2 w-2
                               rounded-full bg-emerald-400"></span>

                </span>

                LIVE PREVIEW

            </span>

        </div>


        {{-- FAVORITE --}}

        <button type="button" disabled aria-label="Favorite product"
            class="absolute right-4 top-4 z-10
                   flex h-11 w-11 items-center justify-center
                   rounded-full bg-white/90
                   text-xl text-neutral-800
                   shadow-lg backdrop-blur-md
                   dark:bg-black/70 dark:text-white">
            ♡
        </button>


        {{-- IMAGE INFORMATION --}}

        @if ($previewImage)
            <div class="absolute bottom-4 left-4 right-4 z-10
                       flex items-end justify-between">

                <span
                    class="inline-flex rounded-full
                           bg-white/95 px-3 py-1.5
                           text-xs font-bold capitalize
                           text-neutral-900 shadow-sm">
                    {{ $previewCondition }}
                </span>

                <span
                    class="rounded-full bg-black/60
                           px-3 py-1.5
                           text-xs font-semibold text-white
                           backdrop-blur-md">
                    Preview
                </span>

            </div>
        @endif

    </div>


    {{-- =========================================================
        PRODUCT INFORMATION
    ========================================================== --}}

    <div class="p-5 sm:p-6">


        {{-- SELLER --}}

        <div class="mb-5 flex items-center justify-between">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 shrink-0 items-center
                           justify-center rounded-full
                           bg-gradient-to-br from-orange-400 to-red-500
                           text-lg shadow-sm">
                    🛍️
                </div>

                <div>

                    <p class="text-sm font-bold
                               text-neutral-900 dark:text-white">
                        Your Store
                    </p>

                    <div class="mt-0.5 flex items-center gap-1
                               text-xs text-neutral-400">
                        <span class="text-yellow-500">★</span>

                        <span>New seller</span>
                    </div>

                </div>

            </div>

            <span
                class="rounded-full bg-orange-50
                       px-3 py-1.5 text-xs font-bold
                       text-orange-600
                       dark:bg-orange-500/10
                       dark:text-orange-400">
                Shop
            </span>

        </div>


        {{-- =====================================================
            TITLE
        ====================================================== --}}

        <div>

            <h2
                class="break-words text-[22px] font-extrabold
                       leading-tight tracking-[-0.02em]
                       text-neutral-950 dark:text-white">
                {{ $previewTitle }}
            </h2>

            <p
                class="mt-2 line-clamp-3
                       text-sm leading-6
                       text-neutral-500 dark:text-neutral-400">
                {{ $previewDescription }}
            </p>

        </div>


        {{-- =====================================================
            BRAND
        ====================================================== --}}

        @if ($hasLocalBrand)

            <div
                class="mt-5 rounded-2xl border
                       border-orange-100 bg-orange-50 p-4
                       dark:border-orange-500/10
                       dark:bg-orange-500/5">

                <p class="text-[10px] font-bold uppercase
                           tracking-wider text-orange-500">
                    Brand
                </p>

                @if (filled($previewLocalBrandName))
                    <p
                        class="mt-1 text-sm font-extrabold
                               text-neutral-900 dark:text-white">
                        {{ $previewLocalBrandName }}
                    </p>
                @endif

                @if (filled($previewLocalBrandNameAr))
                    <p class="mt-0.5 text-sm font-semibold
                               text-neutral-500 dark:text-neutral-400"
                        dir="rtl">
                        {{ $previewLocalBrandNameAr }}
                    </p>
                @endif

                <span
                    class="mt-2 inline-flex rounded-full
                           bg-orange-500/10 px-2.5 py-1
                           text-[10px] font-bold
                           text-orange-600
                           dark:text-orange-400">
                    Local Brand
                </span>

            </div>
        @elseif ($hasExistingBrand)
            <div class="mt-5 rounded-2xl bg-neutral-50 p-4
                       dark:bg-neutral-900">

                <p class="text-[10px] font-bold uppercase
                           tracking-wider text-neutral-400">
                    Brand
                </p>

                @if (filled($previewBrand?->brand_name))
                    <p
                        class="mt-1 text-sm font-extrabold
                               text-neutral-900 dark:text-white">
                        {{ $previewBrand->brand_name }}
                    </p>
                @endif

                @if (filled($previewBrand?->brand_name_ar))
                    <p class="mt-0.5 text-sm font-semibold
                               text-neutral-500 dark:text-neutral-400"
                        dir="rtl">
                        {{ $previewBrand->brand_name_ar }}
                    </p>
                @endif

            </div>

        @endif


        {{-- =====================================================
            PRICE + STOCK
        ====================================================== --}}

        <div class="mt-5 flex items-end justify-between">

            <div>

                <p
                    class="mb-1 text-[11px] font-bold
                           uppercase tracking-widest
                           text-neutral-400">
                    Price
                </p>

                <div class="flex items-baseline gap-1">

                    <span class="text-sm font-bold text-orange-500">
                        AED
                    </span>

                    <span
                        class="text-[34px] font-black
                               leading-none tracking-tight
                               text-orange-500">
                        {{ number_format((float) $previewPrice, 2) }}
                    </span>

                </div>

            </div>

            <div class="text-right">

                <p
                    class="mb-1 text-[11px] font-bold
                           uppercase tracking-widest
                           text-neutral-400">
                    Available
                </p>

                <p class="text-sm font-bold
                           text-neutral-900 dark:text-white">
                    {{ $previewQuantity }}
                    {{ (int) $previewQuantity === 1 ? 'item' : 'items' }}
                </p>

            </div>

        </div>


        {{-- =====================================================
            QUICK INFO
        ====================================================== --}}

        <div class="mt-5 grid grid-cols-2 gap-2.5">

            <div class="rounded-2xl bg-neutral-50 p-3.5
                       dark:bg-neutral-900">

                <p class="text-[10px] font-bold uppercase
                           tracking-wider text-neutral-400">
                    Condition
                </p>

                <p
                    class="mt-1 text-sm font-bold capitalize
                           text-neutral-900 dark:text-white">
                    {{ $previewCondition }}
                </p>

            </div>

            <div class="rounded-2xl bg-neutral-50 p-3.5
                       dark:bg-neutral-900">

                <p class="text-[10px] font-bold uppercase
                           tracking-wider text-neutral-400">
                    Pricing
                </p>

                <p
                    class="mt-1 text-sm font-bold capitalize
                           text-neutral-900 dark:text-white">
                    {{ $previewPriceCondition }}
                </p>

            </div>

        </div>


        {{-- =====================================================
            FEATURES
        ====================================================== --}}

        @if ($validFeatures->isNotEmpty())

            <div class="mt-6">

                <div class="mb-2.5 flex items-center justify-between">

                    <h4 class="text-sm font-extrabold
                               text-neutral-900 dark:text-white">
                        Why shoppers will love it
                    </h4>

                    <span class="text-xs text-neutral-400">
                        {{ $validFeatures->count() }}
                        {{ $validFeatures->count() === 1 ? 'feature' : 'features' }}
                    </span>

                </div>

                <div class="flex flex-wrap gap-2">

                    @foreach ($validFeatures as $feature)
                        <span
                            class="rounded-full bg-orange-50
                                   px-3 py-1.5
                                   text-xs font-semibold
                                   text-orange-700
                                   dark:bg-orange-500/10
                                   dark:text-orange-400">
                            {{ $feature }}
                        </span>
                    @endforeach

                </div>

            </div>

        @endif


        {{-- =====================================================
            KEYWORDS
        ====================================================== --}}

        @if ($validKeywords->isNotEmpty())

            <div class="mt-5">

                <h4 class="mb-2.5 text-sm font-extrabold
                           text-neutral-900 dark:text-white">
                    Search keywords
                </h4>

                <div class="flex flex-wrap gap-2">

                    @foreach ($validKeywords as $keyword)
                        <span
                            class="rounded-full bg-neutral-100
                                   px-3 py-1.5
                                   text-xs font-medium
                                   text-neutral-600
                                   dark:bg-neutral-800
                                   dark:text-neutral-300">
                            #{{ ltrim($keyword, '#') }}
                        </span>
                    @endforeach

                </div>

            </div>

        @endif


        {{-- =====================================================
            SHOPPER TRUST
        ====================================================== --}}

        <div
            class="mt-6 flex items-center gap-3
                   rounded-2xl border
                   border-emerald-100
                   bg-emerald-50 p-3.5
                   dark:border-emerald-500/10
                   dark:bg-emerald-500/5">

            <div
                class="flex h-9 w-9 shrink-0 items-center
                       justify-center rounded-full
                       bg-emerald-500
                       text-sm font-bold text-white">
                ✓
            </div>

            <div>

                <p
                    class="text-xs font-bold
                           text-emerald-800
                           dark:text-emerald-400">
                    Ready for shoppers
                </p>

                <p
                    class="mt-0.5 text-[11px]
                           leading-4
                           text-emerald-700/70
                           dark:text-emerald-400/60">
                    This is how your product will appear to customers.
                </p>

            </div>

        </div>


        {{-- =====================================================
            CTA
        ====================================================== --}}

        <div class="mt-5">

            <button type="button" disabled
                class="flex w-full items-center
                       justify-center gap-2
                       rounded-2xl
                       bg-gradient-to-r
                       from-orange-500 to-red-500
                       px-5 py-4
                       text-sm font-extrabold text-white
                       shadow-lg shadow-orange-500/20
                       opacity-90">

                <span class="text-base">🛒</span>

                <span>Buy Now</span>

            </button>

            <p
                class="mt-2 text-center
                       text-[11px] leading-4
                       text-neutral-400">
                Preview only — shoppers will see the real checkout here.
            </p>

        </div>

    </div>

</div>
