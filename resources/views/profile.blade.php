<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Profile Header -->

            @if (session()->has('success'))
                <div>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8">
                <div class="h-40 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500"></div>

                <div class="px-8 pb-8 relative">
                    <div class="-mt-16 flex flex-col md:flex-row md:items-end md:justify-between">

                        <div class="flex items-center gap-6">
                            <img src="{{ Auth::user()->profile_photo_url ?: 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                                class="w-32 h-32 rounded-full border-4 border-white object-cover">

                            <div>
                                <h1 class="text-3xl font-bold">
                                    {{ auth()->user()->name }}
                                </h1>

                                <p class="text-gray-500">
                                    {{ auth()->user()->email }}
                                </p>

                                <div class="mt-3 flex gap-2">

                                    @role('seller')
                                        <span
                                            class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                            Seller
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">
                                            Buyer
                                        </span>
                                    @endrole

                                </div>

                            </div>
                        </div>

                        <a href="{{ route('profile.show') }}"
                            class="mt-6 md:mt-0 px-6 py-3 rounded-xl bg-gray-900 text-white hover:bg-black">
                            Edit Profile
                        </a>

                    </div>
                </div>
            </div>

            <div
                class="mb-8 rounded-2xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 text-white overflow-hidden shadow-xl">
                <div class="p-8">

                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">

                        <div class="max-w-3xl">

                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full bg-white/20 text-sm font-medium">
                                🎉 Welcome to {{ config('app.name') }}
                            </span>

                            <h1 class="mt-4 text-4xl font-bold">
                                Hello, {{ auth()->user()->name }} 👋
                            </h1>

                            <p class="mt-3 text-white/90 text-lg leading-relaxed">
                                Welcome to your account! Complete the steps below to secure your account
                                and unlock all marketplace features, including creating your own shop and
                                selling products.
                            </p>

                            <div class="mt-6 flex flex-wrap gap-3">

                                @unless (auth()->user()->hasVerifiedEmail())
                                    <a href="{{ route('verification.notice') }}"
                                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white text-indigo-700 font-semibold hover:bg-gray-100 transition">
                                        📧 Verify Email
                                    </a>
                                @endunless

                                @if (empty(auth()->user()->phone_verified_at))
                                    <a href="{{ route('phone.verify') }}""
                                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-yellow-400 text-gray-900 font-semibold hover:bg-yellow-300 transition">
                                        📱 Verify Phone
                                    </a>
                                @endif

                                @unless (auth()->user()->hasRole('seller'))
                                    <a href="{{ route('shop.create', 1) }}"
                                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-green-500 hover:bg-green-600 text-white font-semibold transition">
                                        🏪 Become a Seller
                                    </a>
                                @endunless

                            </div>

                        </div>

                        <!-- Progress Card -->
                        <div class="bg-white/10 backdrop-blur rounded-2xl p-6 min-w-[320px]">

                            <h3 class="font-bold text-lg mb-4">
                                Account Checklist
                            </h3>

                            <div class="space-y-4">

                                <div class="flex items-center justify-between">
                                    <span>Account Created</span>
                                    <span class="text-green-300 font-bold">✔</span>
                                </div>

                                <div class="flex items-center justify-between">
                                    <span>Email Verified</span>

                                    @if (auth()->user()->hasVerifiedEmail())
                                        <span class="text-green-300 font-bold">✔</span>
                                    @else
                                        <span class="text-yellow-300">Pending</span>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between">
                                    <span>Phone Verified</span>

                                    @if (auth()->user()->phone_verified_at)
                                        <span class="text-green-300 font-bold">✔</span>
                                    @else
                                        <span class="text-yellow-300">Pending</span>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between">
                                    <span>Seller Account</span>

                                    @if (auth()->user()->hasRole('seller'))
                                        <span class="text-green-300 font-bold">✔</span>
                                    @else
                                        <span class="text-gray-200">Not Started</span>
                                    @endif
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

            @role('seller')

                <!-- Seller Details -->
                <div class="grid lg:grid-cols-3 gap-6">

                    <div class="bg-white rounded-2xl shadow-sm p-6">

                        <h2 class="font-bold text-xl mb-5">
                            Seller Details
                        </h2>

                        <div class="space-y-4">

                            <a href="{{ route('shop', auth()->user()->shop->slug) }}"
                                class="block rounded-xl border p-4 hover:border-indigo-500 hover:bg-indigo-50 transition">

                                <h3 class="font-semibold">
                                    My Shop
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Manage your storefront and information.
                                </p>

                            </a>

                            <a href="{{ route('seller.create') }}"
                                class="block rounded-xl border p-4 hover:border-green-500 hover:bg-green-50 transition">

                                <h3 class="font-semibold">
                                    Add Product
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Publish a new product to your shop.
                                </p>

                            </a>

                            <a href="#"
                                class="block rounded-xl border p-4 hover:border-orange-500 hover:bg-orange-50 transition">

                                <h3 class="font-semibold">
                                    Manage Products
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Edit prices, inventory and product images.
                                </p>

                            </a>

                        </div>

                    </div>

                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-6">

                        <h2 class="text-xl font-bold mb-6">
                            Subscription
                        </h2>

                        @if (auth()->user()->shop?->activeSubscription)
                            <div class="rounded-xl bg-green-50 border border-green-200 p-6">

                                <h3 class="text-2xl font-bold">
                                    {{ auth()->user()->shop->activeSubscription->plan->name }}
                                </h3>

                                <div class="mt-4 grid md:grid-cols-3 gap-4">

                                    <div>
                                        <p class="text-gray-500 text-sm">
                                            Product Limit
                                        </p>

                                        <p class="font-bold">
                                            {{ auth()->user()->shop->activeSubscription->plan->listing_limit }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-gray-500 text-sm">
                                            Storage
                                        </p>

                                        <p class="font-bold">
                                            {{ auth()->user()->shop->activeSubscription->plan->storage_limit }} MB
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-gray-500 text-sm">
                                            Orders
                                        </p>

                                        <p class="font-bold">
                                            {{ auth()->user()->shop->activeSubscription->plan->order_limit }}
                                        </p>
                                    </div>

                                </div>

                                <a href="{{ route('plans.index') }}"
                                    class="inline-flex mt-6 px-5 py-3 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                    Upgrade Plan
                                </a>

                            </div>
                        @endif

                    </div>

                </div>
            @else
                <!-- Become Seller -->
                <div
                    class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 rounded-3xl text-white overflow-hidden">

                    <div class="grid lg:grid-cols-2 items-center">

                        <div class="p-10">

                            <span class="bg-white/20 px-3 py-1 rounded-full text-sm">
                                Start Selling Today
                            </span>

                            <h2 class="text-5xl font-bold mt-6 leading-tight">
                                Open your own shop and sell to thousands of customers.
                            </h2>

                            <p class="mt-6 text-lg text-white/90">
                                Create your shop in just a few minutes. You'll receive a free seller plan with your first
                                product included.
                            </p>

                            <div class="mt-8 flex flex-wrap gap-4">

                                <a href="{{ route('shop.create', 1) }}"
                                    class="px-8 py-4 rounded-xl bg-white text-indigo-700 font-bold hover:bg-gray-100">
                                    Become a Seller
                                </a>

                                <a href="{{ route('plans.index') }}"
                                    class="px-8 py-4 rounded-xl border border-white hover:bg-white/10">
                                    View Plans
                                </a>

                            </div>

                        </div>

                        <div class="hidden lg:flex justify-center">

                            <img src="#" class="max-w-md">

                        </div>

                    </div>

                </div>

                <!-- Benefits -->
                <div class="grid md:grid-cols-3 gap-6 mt-10">

                    <div class="bg-white rounded-2xl p-8 shadow-sm">
                        <div class="text-4xl mb-4">🏪</div>
                        <h3 class="font-bold text-xl">Create Your Shop</h3>
                        <p class="text-gray-500 mt-2">
                            Customize your storefront with a logo, banner, description and location.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl p-8 shadow-sm">
                        <div class="text-4xl mb-4">📦</div>
                        <h3 class="font-bold text-xl">Sell Products</h3>
                        <p class="text-gray-500 mt-2">
                            Add products, upload multiple images, manage stock and pricing.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl p-8 shadow-sm">
                        <div class="text-4xl mb-4">💰</div>
                        <h3 class="font-bold text-xl">Grow Your Business</h3>
                        <p class="text-gray-500 mt-2">
                            Upgrade your plan to publish more products and unlock premium features.
                        </p>
                    </div>

                </div>

            @endrole

        </div>
    </div>
</x-app-layout>
