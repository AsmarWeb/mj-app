<x-admin>

    <div class="py-10 bg-gray-50 min-h-screen">

        <div class="max-w-7xl mx-auto px-6">

            {{-- ========================================================= --}}
            {{-- STORE HEADER --}}
            {{-- ========================================================= --}}

            <div class="bg-white rounded-2xl shadow-sm border p-6 mb-8">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                    {{-- Shop Information --}}

                    <div class="flex items-center gap-5">

                        @if ($shop->logo)
                            <img src="{{ asset('storage/' . $shop->logo) }}"
                                class="w-20 h-20 rounded-2xl object-cover border" alt="{{ $shop->name }}">
                        @else
                            <div
                                class="w-20 h-20 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600 text-3xl font-bold">
                                {{ strtoupper(substr($shop->name, 0, 1)) }}
                            </div>
                        @endif


                        <div>

                            <h1 class="text-2xl font-bold text-gray-900">
                                {{ $shop->name }}
                            </h1>

                            <p class="text-gray-500">
                                {{ $shop->location ?: 'No location provided' }}
                            </p>


                            {{-- Status Badges --}}

                            <div class="flex flex-wrap gap-2 mt-3">

                                {{-- Verification --}}

                                @if ($shop->verified)
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Verified
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-600">
                                        Not verified
                                    </span>
                                @endif


                                {{-- Subscription Plan --}}

                                @if ($shop->activeSubscription && $shop->activeSubscription->plan)
                                    <span class="px-3 py-1 text-xs rounded-full bg-purple-100 text-purple-700">
                                        Plan:
                                        {{ $shop->activeSubscription->plan->name }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                        No Active Plan
                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- Owner --}}

                    <div class="text-right">

                        <p class="text-sm text-gray-500">
                            Owner
                        </p>

                        @if ($shop->user)
                            <p class="font-semibold">
                                {{ $shop->user->name }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $shop->user->email }}
                            </p>
                        @else
                            <p class="text-gray-400">
                                No owner
                            </p>
                        @endif

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- SHOP SUBSCRIPTION / PLAN --}}
            {{-- ========================================================= --}}

            <div class="bg-white rounded-2xl border shadow-sm p-6 mb-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    {{-- Plan Information --}}

                    <div>

                        <p class="text-sm text-gray-500 mb-1">
                            Current Shop Plan
                        </p>


                        @if ($shop->activeSubscription && $shop->activeSubscription->plan)

                            <h2 class="text-2xl font-bold text-purple-700">
                                {{ $shop->activeSubscription->plan->name }}
                            </h2>


                            @if ($shop->activeSubscription->plan->description)
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $shop->activeSubscription->plan->description }}
                                </p>
                            @endif


                            <span
                                class="inline-flex mt-3 px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                Active Subscription
                            </span>
                        @else
                            <h2 class="text-2xl font-bold text-gray-400">
                                No Active Plan
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                This shop does not currently have an active subscription.
                            </p>

                            <span
                                class="inline-flex mt-3 px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">
                                No Active Subscription
                            </span>

                        @endif

                    </div>


                    {{-- Subscription Details --}}

                    @if ($shop->activeSubscription)

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">

                            {{-- Price --}}

                            @if ($shop->activeSubscription->plan)
                                <div>

                                    <p class="text-xs text-gray-500">
                                        Price
                                    </p>

                                    <p class="text-lg font-bold text-gray-900">
                                        {{ $shop->activeSubscription->plan->price }}
                                    </p>

                                </div>
                            @endif


                            {{-- Start Date --}}

                            @if ($shop->activeSubscription->starts_at)
                                <div>

                                    <p class="text-xs text-gray-500">
                                        Started
                                    </p>

                                    <p class="font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($shop->activeSubscription->starts_at)->format('M d, Y') }}
                                    </p>

                                </div>
                            @endif


                            {{-- End Date --}}

                            @if ($shop->activeSubscription->ends_at)
                                <div>

                                    <p class="text-xs text-gray-500">
                                        Expires
                                    </p>

                                    <p class="font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($shop->activeSubscription->ends_at)->format('M d, Y') }}
                                    </p>

                                </div>
                            @endif

                        </div>

                    @endif

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- STATS --}}
            {{-- ========================================================= --}}

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">

                {{-- Products --}}

                <div class="bg-white rounded-xl border p-5">

                    <p class="text-sm text-gray-500">
                        Products
                    </p>

                    <h2 class="text-3xl font-bold">
                        {{ $shop->listings->count() }}
                    </h2>

                </div>


                {{-- Active --}}

                <div class="bg-white rounded-xl border p-5">

                    <p class="text-sm text-gray-500">
                        Active
                    </p>

                    <h2 class="text-3xl font-bold text-green-600">
                        {{ $shop->listings->where('active', 1)->count() }}
                    </h2>

                </div>


                {{-- Published --}}

                <div class="bg-white rounded-xl border p-5">

                    <p class="text-sm text-gray-500">
                        Published
                    </p>

                    <h2 class="text-3xl font-bold text-blue-600">
                        {{ $shop->listings->where('status', 'published')->count() }}
                    </h2>

                </div>


                {{-- Created --}}

                <div class="bg-white rounded-xl border p-5">

                    <p class="text-sm text-gray-500">
                        Created
                    </p>

                    <h2 class="text-lg font-bold">
                        {{ $shop->created_at ? $shop->created_at->format('M Y') : 'N/A' }}
                    </h2>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- PRODUCTS --}}
            {{-- ========================================================= --}}

            <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b">

                    <h2 class="text-xl font-bold">
                        Products
                    </h2>

                    <p class="text-sm text-gray-500">
                        Manage everything in this store
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Product
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Price
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Control
                                </th>

                                <th class="px-6 py-4 text-right text-sm font-semibold">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y">

                            @forelse ($shop->listings as $listing)

                                <tr>

                                    {{-- Product --}}

                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-4">

                                            @if ($listing->image)
                                                <img src="{{ Storage::url('products/' . $listing->image) }}"
                                                    class="w-14 h-14 rounded-xl object-cover"
                                                    alt="{{ $listing->title }}">
                                            @endif


                                            <div>

                                                <p class="font-semibold">
                                                    {{ $listing->title }}
                                                </p>

                                                <p class="text-xs text-gray-500">
                                                    {{ $listing->slug }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Price --}}

                                    <td class="px-6 py-5 font-semibold">
                                        {{ $listing->price }}
                                    </td>


                                    {{-- Control --}}

                                    <td class="px-6 py-5">

                                        <form method="POST" action="{{ route('listings.update', $listing) }}"
                                            class="flex flex-wrap items-center gap-2">

                                            @csrf

                                            @method('PATCH')


                                            {{-- Active --}}

                                            <select name="active" class="rounded-lg border-gray-300 text-sm">

                                                <option value="1" {{ $listing->active ? 'selected' : '' }}>
                                                    Active
                                                </option>

                                                <option value="0" {{ !$listing->active ? 'selected' : '' }}>
                                                    Hidden
                                                </option>

                                            </select>


                                            {{-- Status --}}

                                            <select name="status" class="rounded-lg border-gray-300 text-sm">

                                                @foreach (['draft', 'published', 'expired', 'archived'] as $status)
                                                    <option value="{{ $status }}"
                                                        {{ $listing->status === $status ? 'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach

                                            </select>


                                            <button type="submit"
                                                class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm">
                                                Save
                                            </button>

                                        </form>

                                    </td>


                                    {{-- Actions --}}

                                    <td class="px-6 py-5 text-right">

                                        @if (Route::has('listings.destroy'))
                                            <form method="POST" action="{{ route('listings.destroy', $listing) }}"
                                                class="inline">

                                                @csrf

                                                @method('DELETE')


                                                <button type="submit" onclick="return confirm('Delete product?')"
                                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm">
                                                    Delete
                                                </button>

                                            </form>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="py-10 text-center text-gray-500">
                                        No products in this store
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-admin>
