<x-app-layout>


    <div class="min-h-screen">

        <!-- Header -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">
                    ShopBuilder
                </h1>

                <button class="px-5 py-2 rounded-xl bg-gray-900 text-white hover:bg-black transition">
                    My Shops
                </button>
            </div>
        </header>

        <!-- Hero -->
        <section class="max-w-7xl mx-auto px-6 py-20">
            <div class="text-center">

                <span
                    class="inline-flex items-center px-4 py-2 rounded-full bg-gray-100 text-gray-700 text-sm font-medium">
                    🚀 Launch Your Store Today
                </span>

                <h2 class="mt-6 text-6xl font-bold text-gray-900 leading-tight">
                    Build Your Online Shop
                    <span class="text-gray-400">
                        In Minutes
                    </span>
                </h2>

                <p class="mt-6 text-xl text-gray-500 max-w-2xl mx-auto">
                    Create a beautiful storefront, add products,
                    accept orders, and grow your business.
                </p>

            </div>
        </section>

        <!-- Shop Creation Form -->
        <section class="max-w-6xl mx-auto px-6 pb-20 lg:pb-40">
            <div class="grid lg:grid-cols-5 gap-8">
                <form action="{{ route('shop.create', $step) }}" method="POST" enctype="multipart/form-data"
                    class="lg:col-span-3 bg-white rounded-xl shadow p-8">
                    @csrf

                    @switch($step)
                        @case(1)
                            @include('shop.step.name')
                        @break

                        @case(2)
                            @include('shop.step.description')
                        @break

                        @case(3)
                            @include('shop.step.logo')
                        @break

                        @case(4)
                            @include('shop.step.finish')
                        @break
                    @endswitch

                    <div class="mt-10 flex justify-between">

                        @if ($step > 1)
                            <a href="{{ route('shop.create', $step - 1) }}" class="px-6 py-3 rounded-lg border">
                                Back
                            </a>
                        @endif

                        <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-lg">
                            {{ $step == 4 ? 'Finish' : 'Continue' }}
                        </button>

                    </div>

                </form>
            </div>
        </section>

    </div>


</x-app-layout>
