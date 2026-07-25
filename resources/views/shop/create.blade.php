<x-app-layout>

    <div class="min-h-screen bg-[#faf7f2]">


        <!-- Header -->
        <header class="bg-white border-b sticky top-0 z-50">

            <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold text-xl">
                        S
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900">
                        ShopBuilder
                    </h1>

                </div>


                <p class="hidden md:block text-sm text-gray-500">
                    Start selling your products worldwide
                </p>


            </div>

        </header>



        <!-- Hero -->
        <section class="max-w-7xl mx-auto px-6 pt-16 pb-10">


            <div class="grid lg:grid-cols-2 gap-12 items-center">


                <div>


                    <span
                        class="inline-flex items-center gap-2 bg-orange-100 text-orange-700 px-5 py-2 rounded-full text-sm font-semibold">

                        ✨ Create your shop

                    </span>



                    <h2 class="mt-6 text-5xl lg:text-6xl font-bold leading-tight text-gray-900">

                        Turn your passion into

                        <span class="text-orange-600">
                            a beautiful shop
                        </span>

                    </h2>



                    <p class="mt-6 text-lg text-gray-600 max-w-xl">

                        Build your online store, showcase your products,
                        connect with customers, and grow your business
                        with our marketplace.

                    </p>



                    <div class="mt-8 flex gap-8">


                        <div>

                            <p class="text-3xl font-bold">
                                10K+
                            </p>

                            <p class="text-gray-500 text-sm">
                                Active buyers
                            </p>

                        </div>


                        <div>

                            <p class="text-3xl font-bold">
                                24/7
                            </p>

                            <p class="text-gray-500 text-sm">
                                Store access
                            </p>

                        </div>


                        <div>

                            <p class="text-3xl font-bold">
                                0%
                            </p>

                            <p class="text-gray-500 text-sm">
                                Setup fee
                            </p>

                        </div>


                    </div>


                </div>




                <!-- Image Card -->

                <div class="relative">


                    <div class="bg-white rounded-3xl shadow-xl p-6">


                        <div
                            class="aspect-square rounded-2xl bg-gradient-to-br from-orange-100 to-yellow-50 flex items-center justify-center">


                            <div class="text-center">


                                <div class="text-7xl">
                                    🛍️
                                </div>


                                <h3 class="mt-5 text-xl font-bold">

                                    Your shop starts here

                                </h3>


                                <p class="text-gray-500 mt-2">

                                    Add products and start selling

                                </p>


                            </div>


                        </div>


                    </div>


                </div>



            </div>


        </section>




        <!-- Steps -->


        <section class="max-w-6xl mx-auto px-6">


            <div class="bg-white rounded-3xl shadow-sm border p-8">


                <div class="flex justify-between mb-10">


                    @foreach (['Shop Name', 'Description', 'Logo', 'Finish'] as $index => $name)
                        <div class="flex items-center gap-3">


                            <div
                                class="w-10 h-10 rounded-full flex items-center justify-center font-bold
                    {{ $step >= $index + 1 ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-400' }}">

                                {{ $index + 1 }}

                            </div>


                            <span class="hidden md:block text-sm font-medium">

                                {{ $name }}

                            </span>


                        </div>
                    @endforeach


                </div>




                <!-- Form -->

                <form action="{{ route('shop.create', $step) }}" method="POST" enctype="multipart/form-data">


                    @csrf



                    <div class="max-w-3xl mx-auto">


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


                    </div>




                    <!-- Buttons -->

                    <div class="mt-10 flex justify-between">


                        @if ($step > 1)
                            <a href="{{ route('shop.create', $step - 1) }}"
                                class="px-8 py-3 rounded-xl border border-gray-300 hover:bg-gray-50">

                                Back

                            </a>
                        @else
                            <div></div>
                        @endif




                        <button
                            class="px-10 py-3 rounded-xl bg-orange-600 text-white font-semibold hover:bg-orange-700 transition">

                            {{ $step == 4 ? 'Open My Shop 🎉' : 'Continue' }}

                        </button>


                    </div>



                </form>



            </div>


        </section>



        <!-- Benefits -->


        <section class="max-w-6xl mx-auto px-6 py-20">


            <div class="grid md:grid-cols-3 gap-6">


                <div class="bg-white rounded-2xl p-6 shadow-sm">

                    <div class="text-3xl">
                        🌎
                    </div>

                    <h3 class="font-bold mt-4">
                        Reach customers
                    </h3>

                    <p class="text-gray-500 mt-2 text-sm">
                        Sell your products to buyers everywhere.
                    </p>

                </div>



                <div class="bg-white rounded-2xl p-6 shadow-sm">

                    <div class="text-3xl">
                        📦
                    </div>

                    <h3 class="font-bold mt-4">
                        Manage products
                    </h3>

                    <p class="text-gray-500 mt-2 text-sm">
                        Add listings, photos, prices and inventory.
                    </p>

                </div>



                <div class="bg-white rounded-2xl p-6 shadow-sm">

                    <div class="text-3xl">
                        💳
                    </div>

                    <h3 class="font-bold mt-4">
                        Get paid easily
                    </h3>

                    <p class="text-gray-500 mt-2 text-sm">
                        Receive payments securely.
                    </p>

                </div>


            </div>


        </section>


    </div>


</x-app-layout>
