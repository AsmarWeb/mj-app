<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="min-h-screen bg-gray-100">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

                        <!-- Header -->
                        <div
                            class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl p-8 text-white shadow-lg mb-8">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">

                                <div>
                                    <h1 class="text-3xl font-bold">
                                        Welcome back, {{ auth()->user()->name }} 👋
                                    </h1>

                                    <p class="mt-2 text-indigo-100">
                                        Manage your shop, products, orders and subscription.
                                    </p>
                                </div>

                                <div class="mt-6 md:mt-0">
                                    <a href="{{ route('seller.create') }}"
                                        class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded-xl shadow hover:bg-gray-100 transition">
                                        + Add Product
                                    </a>
                                </div>

                            </div>
                        </div>

                        <!-- Statistics -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                            <div class="bg-white rounded-xl p-6 shadow">
                                <p class="text-gray-500">Products</p>
                                <h2 class="text-3xl font-bold mt-2">{{ $publishedListings }}</h2>
                            </div>

                            <div class="bg-white rounded-xl p-6 shadow">
                                <p class="text-gray-500">Orders</p>
                                <h2 class="text-3xl font-bold mt-2">{{ $ordersCount }}</h2>
                            </div>

                            <div class="bg-white rounded-xl p-6 shadow">
                                <p class="text-gray-500">Revenue</p>
                                <h2 class="text-3xl font-bold mt-2">${{ number_format($revenue, 2) }}</h2>
                            </div>

                            <div class="bg-white rounded-xl p-6 shadow">
                                <p class="text-gray-500">Current Plan</p>
                                <h2 class="text-3xl font-bold mt-2">
                                    {{ $plan->name }}
                                </h2>
                            </div>

                        </div>

                        <div class="grid lg:grid-cols-3 gap-8">

                            <!-- Left -->
                            <div class="lg:col-span-2 space-y-8">

                                <!-- Subscription -->
                                <div class="bg-white rounded-xl shadow p-6">

                                    <div class="flex justify-between items-center mb-4">

                                        <h2 class="text-xl font-bold">
                                            Subscription
                                        </h2>

                                        <a href="{{ route('plans.index') }}" class="text-indigo-600 font-semibold">
                                            Upgrade
                                        </a>

                                    </div>

                                    <p class="text-gray-500 mb-4">
                                        {{ $plan->name }} Plan
                                    </p>

                                    @php
                                        $percentage = ($publishedListings / max($plan->listing_limit, 1)) * 100;
                                    @endphp

                                    <div class="w-full bg-gray-200 rounded-full h-3">

                                        <div class="bg-indigo-600 h-3 rounded-full"
                                            style="width: {{ min($percentage, 100) }}%">
                                        </div>

                                    </div>

                                    <div class="flex justify-between mt-3 text-sm text-gray-500">

                                        <span>{{ $publishedListings }} / {{ $plan->listing_limit }} Products</span>

                                        @if ($subscription->ends_at)
                                            <span>
                                                Expires
                                                {{ $subscription->ends_at->format('M d, Y') }}
                                            </span>
                                        @endif

                                    </div>

                                </div>

                                <!-- Recent Products -->
                                <div class="bg-white rounded-xl shadow">

                                    <div class="p-6 border-b">

                                        <div class="flex justify-between">

                                            <h2 class="text-xl font-bold">
                                                Recent Products
                                            </h2>

                                            <a href="#" class="text-indigo-600">
                                                View All
                                            </a>

                                        </div>

                                    </div>

                                    <div class="overflow-x-auto">

                                        <table class="w-full">

                                            <thead class="bg-gray-50">

                                                <tr>

                                                    <th class="text-left px-6 py-3">
                                                        Product
                                                    </th>

                                                    <th>Status</th>

                                                    <th>Stock</th>

                                                    <th>Price</th>

                                                    <th></th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                @forelse($recentListings as $listing)
                                                    <tr class="border-t">

                                                        <td class="px-6 py-4">

                                                            <div class="flex items-center">

                                                                <img src="{{ asset('storage/products/' . $listing->image) }}"
                                                                    class="w-14 h-14 rounded-lg object-cover">

                                                                <div class="ml-4">

                                                                    <div class="font-semibold">

                                                                        {{ $listing->title }}

                                                                    </div>

                                                                    <div class="text-sm text-gray-500">

                                                                        {{ $listing->sku }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </td>

                                                        <td>

                                                            @if ($listing->status == 'published')
                                                                <span
                                                                    class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                                                    Published
                                                                </span>
                                                            @elseif($listing->status == 'draft')
                                                                <span
                                                                    class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                                                                    Draft
                                                                </span>
                                                            @else
                                                                <span
                                                                    class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
                                                                    Expired
                                                                </span>
                                                            @endif

                                                        </td>

                                                        <td>
                                                            {{ $listing->quantity }}
                                                        </td>

                                                        <td>

                                                            ${{ number_format($listing->price, 2) }}

                                                        </td>

                                                        <td>

                                                            <a href="{{ route('seller.edit', ['listing' => $listing->id]) }}"
                                                                class="text-indigo-600">
                                                                Edit
                                                            </a>

                                                        </td>

                                                    </tr>

                                                @empty

                                                    <tr>

                                                        <td colspan="5" class="text-center py-10 text-gray-400">

                                                            No products yet.

                                                        </td>

                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                            <!-- Sidebar -->
                            <div class="space-y-6">

                                <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

                                    <!-- Header -->
                                    <div class="flex items-center justify-between p-6 border-b">

                                        <div>
                                            <h2 class="text-lg font-bold text-gray-900">
                                                Notifications
                                            </h2>

                                            <p class="text-sm text-gray-500">
                                                Stay up to date with your shop.
                                            </p>
                                        </div>

                                        @if (auth()->user()->unreadNotifications->count())
                                            <span
                                                class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                {{ auth()->user()->unreadNotifications->count() }} New
                                            </span>
                                        @endif

                                    </div>

                                    <!-- Notifications -->
                                    <div class="divide-y divide-gray-100">

                                        @forelse($notifications as $notification)
                                            <a href="{{ route('notifications.read', $notification->id) }}"
                                                class="block transition hover:bg-gray-50">

                                                <div
                                                    class="flex gap-4 p-5 {{ is_null($notification->read_at) ? 'bg-indigo-50' : 'bg-white' }}">

                                                    <!-- Icon -->
                                                    <div
                                                        class="flex h-12 w-12 items-center justify-center rounded-full
                        {{ is_null($notification->read_at) ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-500' }}">

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

                                                    <!-- Content -->
                                                    <div class="flex-1">

                                                        <div class="flex items-start justify-between">

                                                            <h3 class="font-semibold text-gray-900">
                                                                {{ $notification->data['title'] }}
                                                            </h3>

                                                            @if (is_null($notification->read_at))
                                                                <span class="h-3 w-3 rounded-full bg-indigo-600"></span>
                                                            @endif

                                                        </div>

                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ $notification->data['message'] }}
                                                        </p>

                                                        <div class="mt-3 flex items-center justify-between">

                                                            <span class="text-xs text-gray-400">
                                                                {{ $notification->created_at->diffForHumans() }}
                                                            </span>

                                                            @if (is_null($notification->read_at))
                                                                <span class="text-xs font-medium text-indigo-600">
                                                                    Mark as read →
                                                                </span>
                                                            @else
                                                                <span class="text-xs text-gray-400">
                                                                    Read
                                                                </span>
                                                            @endif

                                                        </div>

                                                    </div>

                                                </div>

                                            </a>

                                            @empty

                                                <div class="py-12 text-center">

                                                    <div class="text-5xl mb-4">
                                                        🔔
                                                    </div>

                                                    <h3 class="font-semibold text-gray-800">
                                                        No notifications
                                                    </h3>

                                                    <p class="text-sm text-gray-500 mt-2">
                                                        We'll notify you when something important happens.
                                                    </p>

                                                </div>
                                            @endforelse

                                        </div>

                                    </div>

                                    <div class="bg-white rounded-xl shadow p-6">

                                        <h2 class="font-bold mb-4">
                                            Quick Actions
                                        </h2>

                                        <div class="space-y-3">

                                            <a href="{{ route('seller.create') }}"
                                                class="block bg-indigo-600 text-white rounded-lg text-center py-3 hover:bg-indigo-700">

                                                Add Product

                                            </a>

                                            <a href="{{ route('shop.public', $shop->slug) }}"
                                                class="block bg-orange-600 rounded-lg text-center py-3 text-white hover:bg-orange-700">

                                                Business Card

                                            </a>

                                            <a href="{{ route('shop.edit') }}"
                                                class="block bg-gray-100 rounded-lg text-center py-3 hover:bg-gray-200">

                                                Edit Shop

                                            </a>

                                            <a href="{{ route('plans.index') }}"
                                                class="block bg-gray-100 rounded-lg text-center py-3 hover:bg-gray-200">

                                                Subscription

                                            </a>



                                        </div>

                                    </div>

                                    <div class="bg-white rounded-xl shadow p-6">

                                        <h2 class="font-bold mb-4">
                                            Shop Status
                                        </h2>

                                        <ul class="space-y-3">

                                            <li class="flex justify-between">

                                                <span>Email</span>

                                                @if (auth()->user()->hasVerifiedEmail())
                                                    <span class="text-green-600">Verified</span>
                                                @else
                                                    <span class="text-red-600">Not Verified</span>
                                                @endif

                                            </li>

                                            <li class="flex justify-between">

                                                <span>Phone</span>

                                                @if (auth()->user()->phone_verified_at)
                                                    <span class="text-green-600">Verified</span>
                                                @else
                                                    <span class="text-red-600">Not Verified</span>
                                                @endif

                                            </li>

                                            <li class="flex justify-between">

                                                <span>Shop</span>

                                                <span class="text-green-600">
                                                    Active
                                                </span>

                                            </li>

                                        </ul>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
