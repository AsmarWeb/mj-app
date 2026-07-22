<x-app-layout>
    <div class="min-h-screen bg-gray-50 p-4 md:p-8">

        <div class="max-w-7xl mx-auto">

            <form method="POST" action="{{ route('seller.listing.update', $listing) }}" enctype="multipart/form-data">

                @csrf
                @method('PUT')


                {{-- Header --}}
                <div class="flex justify-between items-center mb-6">

                    <div>
                        <a href="{{ route('profile') }}" class="text-sm text-gray-500">
                            ← Back to Listings
                        </a>

                        <h1 class="text-3xl font-bold mt-2">
                            Edit Product
                        </h1>

                        <p class="text-gray-500">
                            Update your product information quickly.
                        </p>

                    </div>


                    <button type="submit" class="hidden md:block px-6 py-3 rounded-xl bg-indigo-600 text-white">

                        Update Product

                    </button>


                </div>




                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


                    {{-- LEFT --}}

                    <div class="lg:col-span-2 space-y-6">



                        <div class="bg-white rounded-2xl p-6 shadow-sm">

                            <h2 class="text-xl font-semibold mb-5">
                                Basic Information
                            </h2>


                            <label>
                                Product Name
                            </label>

                            <input name="title" value="{{ old('title', $listing->title) }}"
                                class="w-full rounded-xl border-gray-300 mb-4">



                            <label>
                                Arabic Name
                            </label>

                            <input name="title_ar" value="{{ old('title_ar', $listing->title_ar) }}"
                                class="w-full rounded-xl border-gray-300 mb-4">



                            <label>
                                Description
                            </label>

                            <textarea name="description" rows="5" class="w-full rounded-xl border-gray-300">{{ old('description', $listing->description) }}</textarea>


                        </div>






                        <div class="bg-white rounded-2xl p-6 shadow-sm">


                            <h2 class="text-xl font-semibold mb-5">
                                Pricing & Inventory
                            </h2>


                            <div class="grid md:grid-cols-2 gap-4">


                                <div>

                                    <label>
                                        Price
                                    </label>

                                    <input type="number" name="price" value="{{ old('price', $listing->price) }}"
                                        class="w-full rounded-xl border-gray-300">

                                </div>



                                <div>

                                    <label>
                                        Quantity
                                    </label>

                                    <input type="number" name="quantity"
                                        value="{{ old('quantity', $listing->quantity) }}"
                                        class="w-full rounded-xl border-gray-300">

                                </div>


                            </div>




                            <div class="grid md:grid-cols-2 gap-4 mt-4">


                                <select name="condition" class="rounded-xl border-gray-300">

                                    <option value="new" @if ($listing->condition == 'new') selected @endif>
                                        New
                                    </option>


                                    <option value="used" @if ($listing->condition == 'used') selected @endif>
                                        Used
                                    </option>

                                </select>



                                <select name="price_condition" class="rounded-xl border-gray-300">


                                    <option value="fixed" @if ($listing->price_condition == 'fixed') selected @endif>
                                        Fixed
                                    </option>


                                    <option value="negotiable" @if ($listing->price_condition == 'negotiable') selected @endif>
                                        Negotiable
                                    </option>


                                </select>


                            </div>


                        </div>


                        <div class="bg-white rounded-2xl p-6 shadow-sm">
                            <div class="grid md:grid-cols-2 gap-6">

                                <div>
                                    <label class="block font-semibold mb-2">
                                        Shipping Method
                                    </label>

                                    <select name="shipping_method" class="w-full rounded-xl border-gray-300">

                                        <option value="Standard Shipping"
                                            {{ $listing->shipping_method == 'Standard Shipping' ? 'selected' : '' }}>
                                            Standard Shipping
                                        </option>

                                        <option value="Express Shipping"
                                            {{ $listing->shipping_method == 'Express Shipping' ? 'selected' : '' }}>
                                            Express Shipping
                                        </option>

                                        <option value="Free Shipping"
                                            {{ $listing->shipping_method == 'Free Shipping' ? 'selected' : '' }}>
                                            Free Shipping
                                        </option>

                                        <option value="Pickup"
                                            {{ $listing->shipping_method == 'Pickup' ? 'selected' : '' }}>
                                            Local Pickup
                                        </option>

                                    </select>
                                </div>



                                <div>

                                    <label class="block font-semibold mb-2">
                                        Delivery Days
                                    </label>

                                    <input type="number" name="delivery_days" min="1"
                                        value="{{ $listing->delivery_days }}"
                                        class="w-full rounded-xl border-gray-300">

                                </div>

                            </div>
                        </div>





                        {{-- Images --}}

                        <div class="bg-white rounded-2xl p-6 shadow-sm">


                            <h2 class="text-xl font-semibold mb-5">
                                Product Images
                            </h2>


                            <div>

                                <p class="mb-2">
                                    Current Image
                                </p>


                                <img src="{{ asset('storage/products/' . $listing->image) }}"
                                    class="w-40 h-40 rounded-xl object-cover">


                            </div>



                            <input type="file" name="image" class="mt-4">


                        </div>



                    </div>





                    {{-- RIGHT --}}

                    <div>


                        <div class="bg-white rounded-2xl shadow-sm p-5 sticky top-5">


                            <h2 class="font-semibold mb-4">
                                Product Preview
                            </h2>


                            <img src="{{ asset('storage/products/' . $listing->image) }}"
                                class="w-full h-56 object-cover rounded-xl">


                            <h3 class="mt-4 text-xl font-bold">
                                {{ $listing->title }}
                            </h3>


                            <p class="text-indigo-600 font-bold text-xl">

                                AED {{ $listing->price }}

                            </p>



                            <span class="inline-block mt-3 px-3 py-1 rounded-full
bg-green-100 text-green-700">

                                {{ ucfirst($listing->status) }}

                            </span>



                            <button type="submit" class="w-full mt-6 bg-indigo-600 text-white py-3 rounded-xl">

                                Update Product

                            </button>


                            <a href="{{ route('profile') }}" class="block text-center mt-3 text-gray-500">

                                Cancel

                            </a>


                        </div>


                    </div>


                </div>


            </form>


        </div>

    </div>
</x-app-layout>
