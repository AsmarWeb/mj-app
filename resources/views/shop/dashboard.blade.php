<x-app-layout>

    <div class="min-h-screen bg-[#faf7f2] text-[#211d19]">

        {{-- ========================================================= --}}
        {{-- TOP WELCOME / HERO --}}
        {{-- ========================================================= --}}

        <section class="relative overflow-hidden border-b border-[#eadfd3] bg-[#211d19]">

            {{-- Decorative glow --}}
            <div class="absolute -right-32 -top-32 h-96 w-96 rounded-full bg-orange-500/20 blur-3xl"></div>
            <div class="absolute -bottom-40 left-1/3 h-96 w-96 rounded-full bg-amber-400/10 blur-3xl"></div>

            <div class="relative mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">

                <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full border border-orange-400/30 bg-white/5 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-orange-300">
                            <span class="h-1.5 w-1.5 rounded-full bg-orange-400"></span>
                            Seller Dashboard
                        </div>

                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl lg:text-5xl">
                            Welcome back,
                            <span class="text-orange-400">
                                {{ auth()->user()->name }}
                            </span>
                            👋
                        </h1>

                        <p class="mt-4 max-w-2xl text-base leading-7 text-stone-300">
                            Manage your shop, products, orders, earnings and subscription
                            from one elegant workspace.
                        </p>

                    </div>


                    <div class="flex flex-col gap-3 sm:flex-row">

                        <a href="{{ route('seller.create') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-orange-500 px-6 py-3.5 text-sm font-bold text-white shadow-xl shadow-orange-950/20 transition hover:bg-orange-400 hover:-translate-y-0.5">

                            <span class="text-lg">+</span>
                            Add Product

                        </a>

                        <a href="{{ route('shop', $shop->slug) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/15 bg-white/10 px-6 py-3.5 text-sm font-bold text-white backdrop-blur transition hover:bg-white/15">

                            View My Shop
                            <span>→</span>

                        </a>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- MAIN CONTENT --}}
        {{-- ========================================================= --}}

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">


            {{-- ========================================================= --}}
            {{-- STRIPE WARNING --}}
            {{-- ========================================================= --}}

            @if (!$shop->stripe_connected)
                <div
                    class="mb-8 overflow-hidden rounded-3xl border border-orange-200 bg-gradient-to-r from-orange-50 to-amber-50 shadow-sm">

                    <div class="flex flex-col gap-5 p-6 md:flex-row md:items-center md:justify-between md:p-7">

                        <div class="flex items-start gap-4">

                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-orange-500 text-xl text-white shadow-lg shadow-orange-200">
                                💳
                            </div>

                            <div>

                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-orange-600">
                                    Action Required
                                </p>

                                <h3 class="mt-1 text-lg font-black text-[#211d19]">
                                    Complete your payment setup
                                </h3>

                                <p class="mt-1 max-w-2xl text-sm leading-6 text-stone-600">
                                    Your shop is live, but you can't receive customer payments
                                    until your Stripe Express account is connected.
                                </p>

                            </div>

                        </div>

                        <a href="{{ route('connect.create') }}"
                            class="inline-flex shrink-0 items-center justify-center rounded-xl bg-[#211d19] px-5 py-3 text-sm font-bold text-white transition hover:bg-orange-600">

                            Connect Stripe →

                        </a>

                    </div>

                </div>
            @endif


            {{-- ========================================================= --}}
            {{-- STATISTICS --}}
            {{-- ========================================================= --}}

            <div class="mb-10 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">


                {{-- Products --}}
                <div
                    class="group relative overflow-hidden rounded-3xl border border-[#eadfd3] bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl hover:shadow-[#6b4b2a]/10">

                    <div
                        class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-orange-100 opacity-60 transition group-hover:scale-125">
                    </div>

                    <div class="relative">

                        <div class="flex items-center justify-between">

                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-stone-500">
                                Products
                            </p>

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-lg">
                                📦
                            </div>

                        </div>

                        <p class="mt-6 text-4xl font-black tracking-tight text-[#211d19]">
                            {{ $publishedListings }}
                        </p>

                        <p class="mt-2 text-sm text-stone-500">
                            Published listings
                        </p>

                    </div>

                </div>


                {{-- Orders --}}
                <div
                    class="group relative overflow-hidden rounded-3xl border border-[#eadfd3] bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl hover:shadow-[#6b4b2a]/10">

                    <div
                        class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-amber-100 opacity-60 transition group-hover:scale-125">
                    </div>

                    <div class="relative">

                        <div class="flex items-center justify-between">

                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-stone-500">
                                Orders
                            </p>

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-lg">
                                🛍️
                            </div>

                        </div>

                        <p class="mt-6 text-4xl font-black tracking-tight text-[#211d19]">
                            {{ $ordersCount }}
                        </p>

                        <p class="mt-2 text-sm text-stone-500">
                            Customer orders
                        </p>

                    </div>

                </div>


                {{-- Revenue --}}
                <div
                    class="group relative overflow-hidden rounded-3xl border border-[#eadfd3] bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl hover:shadow-[#6b4b2a]/10">

                    <div
                        class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-green-100 opacity-60 transition group-hover:scale-125">
                    </div>

                    <div class="relative">

                        <div class="flex items-center justify-between">

                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-stone-500">
                                Revenue
                            </p>

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-50 text-lg">
                                💰
                            </div>

                        </div>

                        <p class="mt-6 text-4xl font-black tracking-tight text-[#211d19]">
                            ${{ number_format($revenue, 2) }}
                        </p>

                        <p class="mt-2 text-sm text-stone-500">
                            Total shop revenue
                        </p>

                    </div>

                </div>


                {{-- Plan --}}
                <div
                    class="group relative overflow-hidden rounded-3xl border border-orange-200 bg-gradient-to-br from-[#fffaf5] to-orange-50 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl hover:shadow-orange-900/10">

                    <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-orange-200/40 blur-xl"></div>

                    <div class="relative">

                        <div class="flex items-center justify-between">

                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-orange-700">
                                Current Plan
                            </p>

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500 text-lg text-white shadow-lg shadow-orange-200">
                                ✦
                            </div>

                        </div>

                        <p class="mt-6 truncate text-3xl font-black tracking-tight text-[#211d19]">
                            {{ $plan->name }}
                        </p>

                        <a href="{{ route('plans.index') }}"
                            class="mt-2 inline-flex text-sm font-bold text-orange-600 hover:text-orange-700">

                            Manage subscription →

                        </a>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- TWO COLUMN CONTENT --}}
            {{-- ========================================================= --}}

            <div class="grid gap-8 xl:grid-cols-3">


                {{-- ===================================================== --}}
                {{-- LEFT / MAIN --}}
                {{-- ===================================================== --}}

                <div class="space-y-8 xl:col-span-2">


                    {{-- ================================================= --}}
                    {{-- SUBSCRIPTION --}}
                    {{-- ================================================= --}}

                    <section class="overflow-hidden rounded-3xl border border-[#eadfd3] bg-white shadow-sm">

                        <div class="border-b border-[#eee5dc] p-6 sm:p-7">

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                <div>

                                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-orange-600">
                                        Membership
                                    </p>

                                    <h2 class="mt-1 text-2xl font-black text-[#211d19]">
                                        Your Subscription
                                    </h2>

                                </div>

                                <a href="{{ route('plans.index') }}"
                                    class="inline-flex items-center justify-center rounded-xl border border-orange-200 bg-orange-50 px-4 py-2.5 text-sm font-bold text-orange-700 transition hover:bg-orange-100">

                                    View Plans →

                                </a>

                            </div>

                        </div>


                        <div class="p-6 sm:p-7">

                            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

                                <div>

                                    <p class="text-sm text-stone-500">
                                        Current membership
                                    </p>

                                    <h3 class="mt-1 text-2xl font-black text-[#211d19]">
                                        {{ $plan->name }} Plan
                                    </h3>

                                </div>

                                <div class="rounded-full bg-green-50 px-4 py-2 text-sm font-bold text-green-700">
                                    ● Active
                                </div>

                            </div>


                            @php
                                $percentage = ($publishedListings / max($plan->listing_limit, 1)) * 100;
                            @endphp


                            <div class="mt-8">

                                <div class="mb-3 flex items-center justify-between text-sm">

                                    <span class="font-semibold text-stone-700">
                                        Product capacity
                                    </span>

                                    <span class="font-bold text-[#211d19]">
                                        {{ $publishedListings }} / {{ $plan->listing_limit }}
                                    </span>

                                </div>


                                <div class="h-3 overflow-hidden rounded-full bg-[#eee5dc]">

                                    <div class="h-full rounded-full bg-gradient-to-r from-orange-500 to-amber-400 transition-all"
                                        style="width: {{ min($percentage, 100) }}%">
                                    </div>

                                </div>


                                <div
                                    class="mt-3 flex flex-col gap-2 text-xs text-stone-500 sm:flex-row sm:items-center sm:justify-between">

                                    <span>
                                        {{ number_format(min($percentage, 100), 0) }}% of product limit used
                                    </span>

                                    @if ($subscription->ends_at)
                                        <span>
                                            Expires {{ $subscription->ends_at->format('M d, Y') }}
                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- ================================================= --}}
                    {{-- RECENT PRODUCTS --}}
                    {{-- ================================================= --}}

                    <section class="overflow-hidden rounded-3xl border border-[#eadfd3] bg-white shadow-sm">

                        <div
                            class="flex flex-col gap-4 border-b border-[#eee5dc] p-6 sm:flex-row sm:items-center sm:justify-between sm:p-7">

                            <div>

                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-orange-600">
                                    Inventory
                                </p>

                                <h2 class="mt-1 text-2xl font-black text-[#211d19]">
                                    Recent Products
                                </h2>

                            </div>

                            <a href="{{ route('seller.create') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-[#211d19] px-4 py-2.5 text-sm font-bold text-white transition hover:bg-orange-600">

                                + Add Product

                            </a>

                        </div>


                        <div class="overflow-x-auto">

                            <table class="w-full min-w-[720px]">

                                <thead class="bg-[#fcf9f5]">

                                    <tr class="text-left text-xs font-bold uppercase tracking-wider text-stone-500">

                                        <th class="px-6 py-4 sm:px-7">
                                            Product
                                        </th>

                                        <th class="px-4 py-4">
                                            Status
                                        </th>

                                        <th class="px-4 py-4">
                                            Stock
                                        </th>

                                        <th class="px-4 py-4">
                                            Price
                                        </th>

                                        <th class="px-6 py-4">
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-[#eee5dc]">

                                    @forelse($recentListings as $listing)
                                        <tr class="transition hover:bg-[#fffaf5]">

                                            <td class="px-6 py-5 sm:px-7">

                                                <div class="flex items-center gap-4">

                                                    @if ($listing->image)
                                                        <img src="{{ asset('storage/products/' . $listing->image) }}"
                                                            alt="{{ $listing->title }}"
                                                            class="h-14 w-14 rounded-2xl object-cover ring-1 ring-black/5">
                                                    @else
                                                        <div
                                                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-50 text-xl">
                                                            📦
                                                        </div>
                                                    @endif


                                                    <div class="min-w-0">

                                                        <p class="truncate font-bold text-[#211d19]">
                                                            {{ $listing->title }}
                                                        </p>

                                                        <p class="mt-1 text-xs text-stone-500">
                                                            {{ $listing->sku }}
                                                        </p>

                                                    </div>

                                                </div>

                                            </td>


                                            <td class="px-4 py-5">

                                                @if ($listing->status === 'published')
                                                    <span
                                                        class="inline-flex rounded-full bg-green-50 px-3 py-1 text-xs font-bold text-green-700">
                                                        Published
                                                    </span>
                                                @elseif ($listing->status === 'draft')
                                                    <span
                                                        class="inline-flex rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700">
                                                        Draft
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex rounded-full bg-red-50 px-3 py-1 text-xs font-bold text-red-700">
                                                        Expired
                                                    </span>
                                                @endif

                                            </td>


                                            <td class="px-4 py-5 text-sm font-semibold text-stone-700">
                                                {{ $listing->quantity }}
                                            </td>


                                            <td class="px-4 py-5 text-sm font-bold text-[#211d19]">
                                                ${{ number_format($listing->price, 2) }}
                                            </td>


                                            <td class="px-6 py-5">

                                                <a href="{{ route('seller.edit', ['listing' => $listing->id]) }}"
                                                    class="font-bold text-orange-600 transition hover:text-orange-700">

                                                    Edit

                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="5" class="px-6 py-16 text-center">

                                                <div
                                                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 text-2xl">
                                                    📦
                                                </div>

                                                <h3 class="mt-4 font-bold text-[#211d19]">
                                                    No products yet
                                                </h3>

                                                <p class="mt-1 text-sm text-stone-500">
                                                    Add your first product and start building your shop.
                                                </p>

                                                <a href="{{ route('seller.create') }}"
                                                    class="mt-5 inline-flex rounded-xl bg-orange-500 px-5 py-3 text-sm font-bold text-white transition hover:bg-orange-600">

                                                    Add Your First Product →

                                                </a>

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </section>


                    {{-- ================================================= --}}
                    {{-- WALLET --}}
                    {{-- ================================================= --}}

                    <section>

                        <div class="mb-5">

                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-orange-600">
                                Financial Overview
                            </p>

                            <h2 class="mt-1 text-2xl font-black text-[#211d19]">
                                Shop Wallet
                            </h2>

                            <p class="mt-1 text-sm text-stone-500">
                                Track your earnings, pending payments and available balance.
                            </p>

                        </div>


                        <div class="grid gap-5 md:grid-cols-3">


                            {{-- Available --}}
                            <div
                                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#2f5d50] to-[#173d32] p-6 text-white shadow-xl">

                                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10 blur-2xl">
                                </div>

                                <div class="relative">

                                    <div class="flex items-center justify-between">

                                        <p class="text-xs font-bold uppercase tracking-[0.15em] text-white/70">
                                            Available
                                        </p>

                                        <span class="text-xl">
                                            ✓
                                        </span>

                                    </div>

                                    <p class="mt-7 text-3xl font-black">
                                        {{ $shop->currency ?? '$' }}
                                        {{ number_format($wallet->available_balance, 2) }}
                                    </p>

                                    <p class="mt-2 text-xs text-white/60">
                                        Ready for withdrawal
                                    </p>

                                </div>

                            </div>


                            {{-- Pending --}}
                            <div
                                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-orange-500 to-[#c2410c] p-6 text-white shadow-xl shadow-orange-900/10">

                                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10 blur-2xl">
                                </div>

                                <div class="relative">

                                    <div class="flex items-center justify-between">

                                        <p class="text-xs font-bold uppercase tracking-[0.15em] text-white/70">
                                            Pending
                                        </p>

                                        <span class="text-xl">
                                            ◷
                                        </span>

                                    </div>

                                    <p class="mt-7 text-3xl font-black">
                                        {{ $shop->currency ?? '$' }}
                                        {{ number_format($wallet->pending_balance, 2) }}
                                    </p>

                                    <p class="mt-2 text-xs text-white/60">
                                        Processing payments
                                    </p>

                                </div>

                            </div>


                            {{-- Total --}}
                            <div
                                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#8b6b3e] to-[#5b4324] p-6 text-white shadow-xl">

                                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10 blur-2xl">
                                </div>

                                <div class="relative">

                                    <div class="flex items-center justify-between">

                                        <p class="text-xs font-bold uppercase tracking-[0.15em] text-white/70">
                                            Total Earned
                                        </p>

                                        <span class="text-xl">
                                            ✦
                                        </span>

                                    </div>

                                    <p class="mt-7 text-3xl font-black">
                                        {{ $shop->currency ?? '$' }}
                                        {{ number_format($wallet->total_earned, 2) }}
                                    </p>

                                    <p class="mt-2 text-xs text-white/60">
                                        Lifetime shop earnings
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Wallet Summary --}}
                        <div class="mt-5 rounded-3xl border border-[#eadfd3] bg-white p-6 shadow-sm sm:p-7">

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                <div>

                                    <h3 class="text-lg font-black text-[#211d19]">
                                        Wallet Summary
                                    </h3>

                                    <p class="mt-1 text-sm text-stone-500">
                                        Your marketplace earnings overview
                                    </p>

                                </div>

                                <span
                                    class="inline-flex w-fit items-center gap-2 rounded-full bg-green-50 px-4 py-2 text-xs font-bold text-green-700">
                                    <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                    Active
                                </span>

                            </div>


                            <div class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-4">

                                <div class="rounded-2xl bg-[#fcf9f5] p-4">
                                    <p class="text-xs text-stone-500">
                                        Commission
                                    </p>
                                    <p class="mt-2 font-black text-[#211d19]">
                                        {{ config('revenue.commission') }}%
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-[#fcf9f5] p-4">
                                    <p class="text-xs text-stone-500">
                                        Currency
                                    </p>
                                    <p class="mt-2 font-black text-[#211d19]">
                                        {{ $shop->currency ?? 'USD' }}
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-[#fcf9f5] p-4">
                                    <p class="text-xs text-stone-500">
                                        Status
                                    </p>
                                    <p class="mt-2 font-black text-green-600">
                                        Verified
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-[#fcf9f5] p-4">
                                    <p class="text-xs text-stone-500">
                                        Withdrawals
                                    </p>
                                    <p class="mt-2 font-black text-[#211d19]">
                                        Available
                                    </p>
                                </div>

                            </div>

                        </div>

                    </section>

                </div>


                {{-- ===================================================== --}}
                {{-- RIGHT SIDEBAR --}}
                {{-- ===================================================== --}}

                <aside class="space-y-6">


                    {{-- ================================================= --}}
                    {{-- NOTIFICATIONS --}}
                    {{-- ================================================= --}}

                    <section class="overflow-hidden rounded-3xl border border-[#eadfd3] bg-white shadow-sm">

                        <div class="border-b border-[#eee5dc] p-6">

                            <div class="flex items-start justify-between gap-4">

                                <div>

                                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-orange-600">
                                        Activity
                                    </p>

                                    <h2 class="mt-1 text-xl font-black text-[#211d19]">
                                        Notifications
                                    </h2>

                                    <p class="mt-1 text-sm text-stone-500">
                                        Important updates for your shop.
                                    </p>

                                </div>

                                @if (auth()->user()->unreadNotifications->count())
                                    <span
                                        class="shrink-0 rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700">
                                        {{ auth()->user()->unreadNotifications->count() }} New
                                    </span>
                                @endif

                            </div>

                        </div>


                        <div class="divide-y divide-[#eee5dc]">

                            @forelse($notifications as $notification)
                                <a href="{{ route('notifications.read', $notification->id) }}"
                                    class="block transition hover:bg-[#fffaf5]">

                                    <div
                                        class="flex gap-3 p-5 {{ is_null($notification->read_at) ? 'bg-orange-50/60' : '' }}">

                                        <div
                                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl
                                            {{ is_null($notification->read_at) ? 'bg-orange-100 text-orange-600' : 'bg-[#f5f0ea] text-stone-500' }}">

                                            @switch($notification->data['icon'] ?? 'bell')
                                                @case('success')
                                                    ✅
                                                @break

                                                @case('order')
                                                    📦
                                                @break

                                                @case('shop')
                                                    🏪
                                                @break

                                                @case('payment')
                                                    💳
                                                @break

                                                @default
                                                    🔔
                                            @endswitch

                                        </div>


                                        <div class="min-w-0 flex-1">

                                            <div class="flex items-start justify-between gap-2">

                                                <h3 class="truncate text-sm font-bold text-[#211d19]">
                                                    {{ $notification->data['title'] ?? 'Notification' }}
                                                </h3>

                                                @if (is_null($notification->read_at))
                                                    <span
                                                        class="mt-1 h-2 w-2 shrink-0 rounded-full bg-orange-500"></span>
                                                @endif

                                            </div>

                                            <p class="mt-1 text-xs leading-5 text-stone-600">
                                                {{ $notification->data['message'] ?? '' }}
                                            </p>

                                            <div class="mt-3 flex items-center justify-between gap-2">

                                                <span class="text-[11px] text-stone-400">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>

                                                @if (is_null($notification->read_at))
                                                    <span class="text-[11px] font-bold text-orange-600">
                                                        Mark as read →
                                                    </span>
                                                @else
                                                    <span class="text-[11px] text-stone-400">
                                                        Read
                                                    </span>
                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </a>

                                @empty

                                    <div class="px-6 py-12 text-center">

                                        <div
                                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-50 text-2xl">
                                            🔔
                                        </div>

                                        <h3 class="mt-4 font-bold text-[#211d19]">
                                            You're all caught up
                                        </h3>

                                        <p class="mt-1 text-sm text-stone-500">
                                            We'll notify you when something important happens.
                                        </p>

                                    </div>
                                @endforelse

                            </div>

                        </section>


                        {{-- ================================================= --}}
                        {{-- QUICK ACTIONS --}}
                        {{-- ================================================= --}}

                        <section class="rounded-3xl border border-[#eadfd3] bg-white p-6 shadow-sm">

                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-orange-600">
                                Workspace
                            </p>

                            <h2 class="mt-1 text-xl font-black text-[#211d19]">
                                Quick Actions
                            </h2>


                            <div class="mt-5 space-y-3">

                                <a href="{{ route('seller.create') }}"
                                    class="flex items-center justify-between rounded-2xl bg-[#211d19] px-5 py-4 text-sm font-bold text-white transition hover:bg-orange-600">

                                    <span class="flex items-center gap-3">
                                        <span>＋</span>
                                        Add Product
                                    </span>

                                    <span>→</span>

                                </a>


                                <a href="{{ route('shop.public', $shop->slug) }}"
                                    class="flex items-center justify-between rounded-2xl bg-orange-500 px-5 py-4 text-sm font-bold text-white transition hover:bg-orange-600">

                                    <span class="flex items-center gap-3">
                                        <span>◈</span>
                                        View Business Card
                                    </span>

                                    <span>→</span>

                                </a>


                                <a href="{{ route('shop.edit') }}"
                                    class="flex items-center justify-between rounded-2xl border border-[#eadfd3] bg-[#fcf9f5] px-5 py-4 text-sm font-bold text-[#211d19] transition hover:border-orange-200 hover:bg-orange-50">

                                    <span class="flex items-center gap-3">
                                        <span>✎</span>
                                        Edit Shop
                                    </span>

                                    <span>→</span>

                                </a>


                                <a href="{{ route('plans.index') }}"
                                    class="flex items-center justify-between rounded-2xl border border-[#eadfd3] bg-[#fcf9f5] px-5 py-4 text-sm font-bold text-[#211d19] transition hover:border-orange-200 hover:bg-orange-50">

                                    <span class="flex items-center gap-3">
                                        <span>✦</span>
                                        Subscription
                                    </span>

                                    <span>→</span>

                                </a>

                            </div>

                        </section>


                        {{-- ================================================= --}}
                        {{-- SHOP STATUS --}}
                        {{-- ================================================= --}}

                        <section class="rounded-3xl border border-[#eadfd3] bg-white p-6 shadow-sm">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-orange-600">
                                        Trust & Security
                                    </p>

                                    <h2 class="mt-1 text-xl font-black text-[#211d19]">
                                        Shop Status
                                    </h2>

                                </div>

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-50 text-green-600">
                                    ✓
                                </div>

                            </div>


                            <div class="mt-6 space-y-4">


                                {{-- Email --}}
                                <div class="flex items-center justify-between rounded-2xl bg-[#fcf9f5] px-4 py-3">

                                    <span class="text-sm font-medium text-stone-600">
                                        Email
                                    </span>

                                    @if (auth()->user()->hasVerifiedEmail())
                                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-green-600">
                                            <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                            Verified
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-red-600">
                                            <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                            Not Verified
                                        </span>
                                    @endif

                                </div>


                                {{-- Phone --}}
                                <div class="flex items-center justify-between rounded-2xl bg-[#fcf9f5] px-4 py-3">

                                    <span class="text-sm font-medium text-stone-600">
                                        Phone
                                    </span>

                                    @if (auth()->user()->phone_verified_at)
                                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-green-600">
                                            <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                            Verified
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-red-600">
                                            <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                            Not Verified
                                        </span>
                                    @endif

                                </div>


                                {{-- Shop --}}
                                <div class="flex items-center justify-between rounded-2xl bg-[#fcf9f5] px-4 py-3">

                                    <span class="text-sm font-medium text-stone-600">
                                        Shop
                                    </span>

                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-green-600">
                                        <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                        Active
                                    </span>

                                </div>


                                {{-- Stripe --}}
                                <div class="flex items-center justify-between rounded-2xl bg-[#fcf9f5] px-4 py-3">

                                    <span class="text-sm font-medium text-stone-600">
                                        Payments
                                    </span>

                                    @if ($shop->stripe_connected)
                                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-green-600">
                                            <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                            Connected
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-orange-600">
                                            <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                                            Setup Required
                                        </span>
                                    @endif

                                </div>

                            </div>

                        </section>


                        {{-- ================================================= --}}
                        {{-- PREMIUM SHOP CTA --}}
                        {{-- ================================================= --}}

                        <div class="relative overflow-hidden rounded-3xl bg-[#211d19] p-6 text-white shadow-xl">

                            <div class="absolute -right-12 -top-12 h-32 w-32 rounded-full bg-orange-500/20 blur-2xl"></div>

                            <div class="relative">

                                <div
                                    class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-500 text-lg">
                                    ✦
                                </div>

                                <h3 class="text-xl font-black">
                                    Make your shop unforgettable.
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-stone-300">
                                    Add beautiful products, improve your storefront,
                                    and give customers a premium shopping experience.
                                </p>

                                <a href="{{ route('shop', $shop->slug) }}"
                                    class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-orange-400 hover:text-orange-300">

                                    View storefront
                                    <span>→</span>

                                </a>

                            </div>

                        </div>

                    </aside>

                </div>


                {{-- ========================================================= --}}
                {{-- FOOTER TRUST STRIP --}}
                {{-- ========================================================= --}}

                <div class="mt-10 border-t border-[#eadfd3] pt-7">

                    <div class="flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">

                        <p class="text-xs text-stone-500">
                            Your seller workspace is protected with secure payment infrastructure.
                        </p>

                        <div class="flex items-center gap-5 text-xs font-semibold text-stone-500">

                            <span class="flex items-center gap-1.5">
                                <span class="text-green-600">✓</span>
                                Secure Payments
                            </span>

                            <span class="flex items-center gap-1.5">
                                <span class="text-green-600">✓</span>
                                Verified Shop
                            </span>

                            <span class="flex items-center gap-1.5">
                                <span class="text-green-600">✓</span>
                                24/7 Access
                            </span>

                        </div>

                    </div>

                </div>

            </main>

        </div>

    </x-app-layout>
