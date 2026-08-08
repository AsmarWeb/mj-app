<x-main-layout>

    @section('title', $title ?? $listing->title)

    @section('description', $description ?? Str::limit(strip_tags($listing->description ?? ''), 160))

    @section('keywords', implode(', ', $keywords ?? []))

    @section('og:title', $listing->title)
    @section('og:description', Str::limit(strip_tags($listing->description ?? ''), 160))
    @section('og:image', $listing->image ? Storage::url('products/' . $listing->image) :
        asset('images/placeholder.png'))

    @section('twitter:title', $listing->title)
    @section('twitter:description', Str::limit(strip_tags($listing->description ?? ''), 160))
    @section('twitter:image', $listing->image ? Storage::url('products/' . $listing->image) :
        asset('images/placeholder.png'))

        <x-slot name="header">
            <x-main-header />
        </x-slot>

        <div class="min-h-screen">

            {{-- Breadcrumb --}}
            <div class="border-b border-gray-200 bg-white dark:border-neutral-800 dark:bg-neutral-900">
                <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">

                    <div class="flex flex-wrap items-center gap-2 text-sm text-gray-500 dark:text-gray-400">

                        <a href="{{ url('/') }}" class="transition hover:text-orange-600">
                            Home
                        </a>

                        <span>/</span>

                        @if ($listing->category)
                            <a href="#" class="transition hover:text-orange-600">
                                {{ $listing->category->name }}
                            </a>

                            <span>/</span>
                        @endif

                        <span class="truncate text-gray-900 dark:text-white">
                            {{ $listing->title }}
                        </span>

                    </div>

                </div>
            </div>


            <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">

                {{-- ========================================================= --}}
                {{-- PRODUCT --}}
                {{-- ========================================================= --}}

                <div class="grid gap-10 lg:grid-cols-2">

                    {{-- ===================================================== --}}
                    {{-- PRODUCT MEDIA --}}
                    {{-- ===================================================== --}}

                    <div>

                        <div class="lg:sticky lg:top-6">

                            <div class="grid gap-4 md:grid-cols-[88px_1fr]">

                                {{-- Thumbnails --}}
                                <div class="order-2 flex gap-3 overflow-x-auto md:order-1 md:flex-col">

                                    @if ($listing->image)
                                        <button type="button"
                                            onclick="showProductImage('{{ Storage::url('products/' . $listing->image) }}')"
                                            class="product-thumbnail shrink-0 overflow-hidden rounded-xl border-2 border-orange-500 bg-white dark:bg-neutral-900">

                                            <img src="{{ Storage::url('products/' . $listing->image) }}"
                                                class="h-20 w-20 object-cover" alt="{{ $listing->title }}">

                                        </button>
                                    @endif


                                    @foreach ($listing->images ?? [] as $image)
                                        @if ($image)
                                            <button type="button"
                                                onclick="showProductImage('{{ Storage::url('products/' . $image) }}')"
                                                class="product-thumbnail shrink-0 overflow-hidden rounded-xl border-2 border-gray-200 bg-white transition hover:border-orange-500 dark:border-neutral-700 dark:bg-neutral-900">

                                                <img src="{{ Storage::url('products/' . $image) }}"
                                                    class="h-20 w-20 object-cover" alt="{{ $listing->title }}">

                                            </button>
                                        @endif
                                    @endforeach


                                    @if ($listing->video)
                                        <button type="button" onclick="showProductVideo()"
                                            class="flex h-20 w-20 shrink-0 items-center justify-center rounded-xl border-2 border-gray-200 bg-black text-white transition hover:border-orange-500 dark:border-neutral-700">

                                            <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">

                                                <path d="M8 5v14l11-7z" />

                                            </svg>

                                        </button>
                                    @endif

                                </div>


                                {{-- Main Viewer --}}
                                <div
                                    class="relative order-1 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-neutral-800 dark:bg-neutral-900 md:order-2">

                                    {{-- Availability --}}
                                    <div class="absolute left-5 top-5 z-10">

                                        @if (($listing->quantity ?? 0) > 0 || $listing->product_type === 'digital')
                                            <span
                                                class="inline-flex items-center gap-2 rounded-full bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow">

                                                <span class="h-2 w-2 rounded-full bg-white"></span>

                                                Available

                                            </span>
                                        @else
                                            <span
                                                class="rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow">

                                                Out of Stock

                                            </span>
                                        @endif

                                    </div>


                                    {{-- Main Image --}}
                                    @if ($listing->image)
                                        <img id="mainProductImage" src="{{ Storage::url('products/' . $listing->image) }}"
                                            alt="{{ $listing->title }}"
                                            class="h-[520px] w-full cursor-zoom-in object-contain bg-white p-4 transition dark:bg-neutral-900 sm:h-[600px]">
                                    @else
                                        <div
                                            class="flex h-[520px] items-center justify-center bg-gray-100 dark:bg-neutral-800">

                                            <div class="text-center">

                                                <div class="text-7xl">
                                                    📦
                                                </div>

                                                <p class="mt-3 text-gray-500">
                                                    No product image
                                                </p>

                                            </div>

                                        </div>
                                    @endif


                                    {{-- Video --}}
                                    @if ($listing->video)
                                        <video id="mainProductVideo" controls
                                            class="hidden h-[520px] w-full bg-black object-contain sm:h-[600px]">

                                            <source src="{{ Storage::url('products/videos/' . $listing->video) }}"
                                                type="video/mp4">

                                        </video>
                                    @endif

                                </div>

                            </div>


                            {{-- Image count / hint --}}
                            <p class="mt-3 text-center text-sm text-gray-500 dark:text-gray-400">
                                Click an image to view it
                            </p>

                        </div>

                    </div>


                    {{-- ===================================================== --}}
                    {{-- PRODUCT INFORMATION --}}
                    {{-- ===================================================== --}}

                    <div>

                        {{-- Brand / Shop --}}
                        @if ($listing->brand)
                            <div class="mb-3">

                                <span class="text-sm font-semibold uppercase tracking-wide text-orange-600">
                                    {{ $listing->brand->name }}
                                </span>

                            </div>
                        @endif


                        {{-- Title --}}
                        <h1 class="text-3xl font-black tracking-tight text-gray-900 dark:text-white sm:text-4xl">

                            {{ $listing->title }}

                        </h1>


                        {{-- SKU / category --}}
                        <div class="mt-3 flex flex-wrap items-center gap-3 text-sm text-gray-500 dark:text-gray-400">

                            @if ($listing->sku)
                                <span>
                                    SKU: {{ $listing->sku }}
                                </span>
                            @endif

                            @if ($listing->category)
                                <span>•</span>

                                <span>
                                    {{ $listing->category->category_name }}
                                </span>
                            @endif

                        </div>


                        {{-- Rating --}}
                        <div class="mt-5 flex flex-wrap items-center gap-3">

                            <div class="text-lg text-yellow-400">
                                ★★★★★
                            </div>

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $listing->reviews?->count() ?? 0 }} reviews
                            </span>

                        </div>


                        {{-- Price --}}
                        <div
                            class="mt-6 rounded-2xl border border-gray-200 bg-white p-5 dark:border-neutral-800 dark:bg-neutral-900">

                            <div class="flex flex-wrap items-end gap-3">

                                <span class="text-4xl font-black text-gray-900 dark:text-white">

                                    {{ $listing->shop?->currency ?? 'AED' }}
                                    {{ number_format($listing->price, 2) }}

                                </span>

                                @if ($listing->price_condition)
                                    <span
                                        class="mb-1 rounded-full bg-gray-100 px-3 py-1 text-sm text-gray-600 dark:bg-neutral-800 dark:text-gray-300">

                                        {{ ucfirst($listing->price_condition) }}

                                    </span>
                                @endif

                            </div>

                        </div>


                        {{-- Description --}}
                        <div class="mt-7">

                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                                About this product
                            </h2>

                            <div class="mt-3 leading-7 text-gray-600 dark:text-gray-300">

                                {!! nl2br(e($listing->description)) !!}

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- DIGITAL PRODUCT --}}
                        {{-- ================================================= --}}

                        @if ($listing->product_type === 'digital' || $listing->digital_file)

                            <div
                                class="mt-7 rounded-2xl border border-purple-200 bg-purple-50 p-5 dark:border-purple-900/50 dark:bg-purple-950/30">

                                <div class="flex gap-4">

                                    <div
                                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-purple-600 text-white">

                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                        </svg>

                                    </div>

                                    <div>

                                        <h3 class="font-bold text-purple-900 dark:text-purple-200">
                                            Digital Product
                                        </h3>

                                        <p class="mt-1 text-sm text-purple-700 dark:text-purple-300">
                                            Instant digital delivery after successful payment.
                                        </p>

                                    </div>

                                </div>


                                <a href="{{ route('digital-products.checkout', $listing->slug) }}"
                                    class="mt-5 block rounded-xl bg-purple-600 px-6 py-4 text-center font-bold text-white transition hover:bg-purple-700">

                                    Buy & Download

                                </a>

                            </div>
                        @else
                            {{-- ================================================= --}}
                            {{-- QUANTITY --}}
                            {{-- ================================================= --}}

                            @if (($listing->quantity ?? 0) > 0)
                                <div class="mt-7">

                                    <label class="text-sm font-bold text-gray-900 dark:text-white">
                                        Quantity
                                    </label>

                                    <div
                                        class="mt-2 inline-flex items-center overflow-hidden rounded-xl border border-gray-300 bg-white dark:border-neutral-700 dark:bg-neutral-900">

                                        <button type="button" onclick="changeQuantity(-1)"
                                            class="h-12 w-12 text-xl hover:bg-gray-100 dark:hover:bg-neutral-800">
                                            −
                                        </button>

                                        <input id="productQuantity" type="number" value="1" min="1"
                                            max="{{ $listing->quantity }}"
                                            class="h-12 w-16 border-x border-gray-200 bg-transparent text-center font-bold outline-none dark:border-neutral-700 dark:text-white">

                                        <button type="button" onclick="changeQuantity(1)"
                                            class="h-12 w-12 text-xl hover:bg-gray-100 dark:hover:bg-neutral-800">
                                            +
                                        </button>

                                    </div>

                                    <p class="mt-2 text-sm text-gray-500">
                                        {{ $listing->quantity }} available
                                    </p>

                                </div>
                            @endif


                            {{-- Add to Cart --}}
                            <div class="mt-6">

                                <livewire:add-to-cart :listing="$listing" />

                            </div>

                        @endif


                        {{-- ================================================= --}}
                        {{-- SELLER CONTACT --}}
                        {{-- ================================================= --}}

                        @if ($listing->shop)

                            <div
                                class="mt-7 rounded-2xl border border-gray-200 bg-white p-5 dark:border-neutral-800 dark:bg-neutral-900">

                                <div class="flex items-center gap-4">

                                    @if ($listing->shop->logo)
                                        <img src="{{ Storage::disk('public')->url($listing->shop->logo) }}"
                                            class="h-14 w-14 rounded-full object-cover" alt="{{ $listing->shop->name }}">
                                    @else
                                        <div
                                            class="flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-orange-500 to-pink-500 text-xl font-bold text-white">

                                            {{ strtoupper(substr($listing->shop->name, 0, 1)) }}

                                        </div>
                                    @endif


                                    <div class="flex-1">

                                        <p class="text-xs uppercase tracking-wide text-gray-500">
                                            Sold by
                                        </p>

                                        <a href="{{ route('shop', $listing->shop->slug) }}"
                                            class="font-bold text-gray-900 hover:text-orange-600 dark:text-white">

                                            {{ $listing->shop->name }}

                                        </a>

                                    </div>

                                </div>


                                <div class="mt-5 grid gap-3 sm:grid-cols-2">

                                    @if ($listing->shop->allow_whatsapp && $listing->shop->whatsapp)
                                        <a href="https://wa.me/{{ preg_replace('/\D+/', '', $listing->shop->whatsapp) }}"
                                            target="_blank"
                                            class="rounded-xl bg-green-600 px-4 py-3 text-center font-semibold text-white transition hover:bg-green-700">

                                            WhatsApp Seller

                                        </a>
                                    @endif


                                    @if ($listing->shop->phone)
                                        <a href="tel:{{ $listing->shop->phone }}"
                                            class="rounded-xl bg-blue-600 px-4 py-3 text-center font-semibold text-white transition hover:bg-blue-700">

                                            Call Seller

                                        </a>
                                    @endif

                                </div>

                            </div>

                        @endif


                        {{-- Wishlist --}}
                        @auth

                            <form method="POST" action="{{ route('wishlist.add', $listing) }}" class="mt-4">

                                @csrf

                                <button type="submit"
                                    class="w-full rounded-xl border px-5 py-3 font-semibold transition
                                {{ $inWishlist
                                    ? 'border-red-200 bg-red-50 text-red-600 dark:border-red-900 dark:bg-red-950/30'
                                    : 'border-gray-300 bg-white text-gray-700 hover:border-orange-500 hover:text-orange-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-200' }}">

                                    {{ $inWishlist ? '♥ Added to Wishlist' : '♡ Add to Wishlist' }}

                                </button>

                            </form>

                        @endauth


                        {{-- Security information --}}
                        <div class="mt-6 grid gap-3 sm:grid-cols-3">

                            <div class="rounded-xl bg-gray-100 p-4 text-center dark:bg-neutral-900">

                                <div class="text-xl">
                                    🔒
                                </div>

                                <p class="mt-1 text-xs font-semibold text-gray-700 dark:text-gray-300">
                                    Secure Payment
                                </p>

                            </div>

                            <div class="rounded-xl bg-gray-100 p-4 text-center dark:bg-neutral-900">

                                <div class="text-xl">
                                    ✓
                                </div>

                                <p class="mt-1 text-xs font-semibold text-gray-700 dark:text-gray-300">
                                    Trusted Seller
                                </p>

                            </div>

                            <div class="rounded-xl bg-gray-100 p-4 text-center dark:bg-neutral-900">

                                <div class="text-xl">
                                    ⚡
                                </div>

                                <p class="mt-1 text-xs font-semibold text-gray-700 dark:text-gray-300">
                                    Fast Delivery
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- PRODUCT INFORMATION --}}
                {{-- ========================================================= --}}

                <div class="mt-14 grid gap-8 lg:grid-cols-3">

                    {{-- Features --}}
                    <div
                        class="rounded-3xl border border-gray-200 bg-white p-7 dark:border-neutral-800 dark:bg-neutral-900 lg:col-span-2">

                        <h2 class="text-2xl font-black text-gray-900 dark:text-white">
                            Product Details
                        </h2>


                        <div class="mt-6 divide-y divide-gray-200 dark:divide-neutral-800">

                            @if ($listing->sku)
                                <div class="flex justify-between gap-6 py-4">

                                    <span class="text-gray-500">
                                        SKU
                                    </span>

                                    <span class="font-semibold text-gray-900 dark:text-white">
                                        {{ $listing->sku }}
                                    </span>

                                </div>
                            @endif


                            @if ($listing->category)
                                <div class="flex justify-between gap-6 py-4">

                                    <span class="text-gray-500">
                                        Category
                                    </span>

                                    <span class="font-semibold text-gray-900 dark:text-white">
                                        {{ $listing->category->category_name }}
                                    </span>

                                </div>
                            @endif


                            @if ($listing->brand)
                                <div class="flex justify-between gap-6 py-4">

                                    <span class="text-gray-500">
                                        Brand
                                    </span>

                                    <span class="font-semibold text-gray-900 dark:text-white">
                                        {{ $listing->brand->brand_name }}
                                    </span>

                                </div>
                            @endif


                            <div class="flex justify-between gap-6 py-4">

                                <span class="text-gray-500">
                                    Product Type
                                </span>

                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ ucfirst($listing->product_type ?? 'Physical') }}
                                </span>

                            </div>

                        </div>


                        {{-- Features --}}
                        @if (!empty($listing->features))

                            <div class="mt-8">

                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                    Features
                                </h3>

                                <div class="mt-4 grid gap-3 sm:grid-cols-2">

                                    @foreach ($listing->features as $feature)
                                        <div class="flex gap-3 rounded-xl bg-gray-50 p-4 dark:bg-neutral-800">

                                            <span class="text-green-600">
                                                ✓
                                            </span>

                                            <span class="text-gray-700 dark:text-gray-300">
                                                {{ $feature }}
                                            </span>

                                        </div>
                                    @endforeach

                                </div>

                            </div>

                        @endif

                    </div>


                    {{-- Delivery / Trust --}}
                    <div
                        class="rounded-3xl border border-gray-200 bg-white p-7 dark:border-neutral-800 dark:bg-neutral-900">

                        <h2 class="text-xl font-black text-gray-900 dark:text-white">
                            Good to know
                        </h2>

                        <div class="mt-6 space-y-5">

                            <div class="flex gap-4">

                                <span class="text-2xl">
                                    🚚
                                </span>

                                <div>

                                    <h3 class="font-bold text-gray-900 dark:text-white">
                                        Delivery
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Delivery information is provided by the seller.
                                    </p>

                                </div>

                            </div>


                            <div class="flex gap-4">

                                <span class="text-2xl">
                                    💳
                                </span>

                                <div>

                                    <h3 class="font-bold text-gray-900 dark:text-white">
                                        Secure checkout
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Complete your purchase through our secure checkout.
                                    </p>

                                </div>

                            </div>


                            <div class="flex gap-4">

                                <span class="text-2xl">
                                    🛍️
                                </span>

                                <div>

                                    <h3 class="font-bold text-gray-900 dark:text-white">
                                        Marketplace seller
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        This product is supplied by an independent marketplace seller.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- REVIEWS --}}
                {{-- ========================================================= --}}

                <section class="mt-14">

                    <div class="mb-7">

                        <h2 class="text-2xl font-black text-gray-900 dark:text-white">
                            Customer Reviews
                        </h2>

                        <p class="mt-1 text-gray-500">
                            What customers say about this product.
                        </p>

                    </div>


                    <div class="grid gap-6 lg:grid-cols-3">

                        {{-- Review summary --}}
                        <div
                            class="rounded-3xl border border-gray-200 bg-white p-7 dark:border-neutral-800 dark:bg-neutral-900">

                            <div class="text-5xl font-black text-gray-900 dark:text-white">
                                {{ number_format($listing->reviews?->avg('rating') ?? 0, 1) }}
                            </div>

                            <div class="mt-2 text-xl text-yellow-400">
                                ★★★★★
                            </div>

                            <p class="mt-2 text-sm text-gray-500">
                                Based on {{ $listing->reviews?->count() ?? 0 }} reviews
                            </p>

                        </div>


                        {{-- Reviews --}}
                        <div class="space-y-4 lg:col-span-2">

                            @forelse ($listing->reviews as $review)

                                <article
                                    class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-neutral-800 dark:bg-neutral-900">

                                    <div class="flex items-start justify-between gap-4">

                                        <div>

                                            <h3 class="font-bold text-gray-900 dark:text-white">
                                                {{ $review->user->name ?? 'Customer' }}
                                            </h3>

                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ $review->created_at->diffForHumans() }}
                                            </p>

                                        </div>

                                        <div class="text-yellow-400">

                                            @for ($i = 1; $i <= 5; $i++)
                                                {{ $i <= $review->rating ? '★' : '☆' }}
                                            @endfor

                                        </div>

                                    </div>


                                    @if ($review->comment)
                                        <p class="mt-4 leading-7 text-gray-600 dark:text-gray-300">
                                            {{ $review->comment }}
                                        </p>
                                    @endif

                                </article>

                            @empty

                                <div
                                    class="rounded-2xl border border-dashed border-gray-300 p-10 text-center dark:border-neutral-700">

                                    <div class="text-4xl">
                                        💬
                                    </div>

                                    <h3 class="mt-3 font-bold text-gray-900 dark:text-white">
                                        No reviews yet
                                    </h3>

                                    <p class="mt-1 text-gray-500">
                                        Be the first customer to review this product.
                                    </p>

                                </div>

                            @endforelse

                        </div>

                    </div>

                </section>


                {{-- ========================================================= --}}
                {{-- WRITE REVIEW --}}
                {{-- ========================================================= --}}

                @auth

                    <section
                        class="mt-12 rounded-3xl border border-gray-200 bg-white p-7 dark:border-neutral-800 dark:bg-neutral-900">

                        <h2 class="text-2xl font-black text-gray-900 dark:text-white">
                            Write a Review
                        </h2>

                        <p class="mt-1 text-gray-500">
                            Share your experience with other customers.
                        </p>


                        <form method="POST" action="{{ route('review.store', $listing) }}" class="mt-6 max-w-2xl">

                            @csrf

                            <label class="text-sm font-bold text-gray-900 dark:text-white">
                                Rating
                            </label>

                            <select name="rating"
                                class="mt-2 w-full rounded-xl border-gray-300 bg-white dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">

                                <option value="5">★★★★★ — Excellent</option>
                                <option value="4">★★★★☆ — Very Good</option>
                                <option value="3">★★★☆☆ — Good</option>
                                <option value="2">★★☆☆☆ — Fair</option>
                                <option value="1">★☆☆☆☆ — Poor</option>

                            </select>


                            <label class="mt-5 block text-sm font-bold text-gray-900 dark:text-white">
                                Your review
                            </label>

                            <textarea name="comment" rows="5"
                                class="mt-2 w-full rounded-xl border-gray-300 bg-white dark:border-neutral-700 dark:bg-neutral-900 dark:text-white"
                                placeholder="Tell other customers about this product..."></textarea>


                            <button type="submit"
                                class="mt-4 rounded-xl bg-orange-600 px-7 py-3 font-bold text-white transition hover:bg-orange-700">

                                Submit Review

                            </button>

                        </form>

                    </section>

                @endauth

            </main>

        </div>


        {{-- ============================================================= --}}
        {{-- JAVASCRIPT --}}
        {{-- ============================================================= --}}

        <script>
            function showProductImage(src) {

                const image = document.getElementById('mainProductImage');
                const video = document.getElementById('mainProductVideo');

                if (!image) return;

                image.src = src;
                image.classList.remove('hidden');

                if (video) {

                    video.pause();
                    video.classList.add('hidden');

                }

            }


            function showProductVideo() {

                const image = document.getElementById('mainProductImage');
                const video = document.getElementById('mainProductVideo');

                if (!video) return;

                if (image) {
                    image.classList.add('hidden');
                }

                video.classList.remove('hidden');
                video.load();

            }


            function changeQuantity(amount) {

                const input = document.getElementById('productQuantity');

                if (!input) return;

                let value = parseInt(input.value || 1);
                const min = parseInt(input.min || 1);
                const max = parseInt(input.max || 999999);

                value += amount;

                if (value < min) {
                    value = min;
                }

                if (value > max) {
                    value = max;
                }

                input.value = value;

            }
        </script>


        {{-- Product Schema --}}
        @push('schema')
            <script type="application/ld+json">

        {
            "@context": "https://schema.org",
            "@type": "Product",

            "name": @json($listing->title),

            "description": @json(strip_tags($listing->description ?? '')),

            "image": [
                @json(
                    $listing->image
                        ? Storage::url('products/' . $listing->image)
                        : asset('images/placeholder.png')
                )
            ],

            "sku": @json($listing->sku),

            "offers": {
                "@type": "Offer",
                "price": "{{ number_format($listing->price, 2, '.', '') }}",
                "priceCurrency": "{{ $listing->shop?->currency ?? 'AED' }}",
                "availability": "{{ (($listing->quantity ?? 0) > 0 || $listing->product_type === 'digital')
                    ? 'https://schema.org/InStock'
                    : 'https://schema.org/OutOfStock' }}"
            }
        }

        </script>
        @endpush


        <x-main-footer />

    </x-main-layout>
