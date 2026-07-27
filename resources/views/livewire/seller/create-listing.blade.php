<div class="max-w-7xl mx-auto py-8 px-4">

    <div class="mb-8">
        <h1 class="text-3xl font-bold">Create a New Product</h1>
        <p class="text-gray-500 mt-2">
            Fill in the details below to publish your product.
        </p>
    </div>

    @if (!$canCreate)

        <div class="mb-6 rounded-xl border border-yellow-300 bg-yellow-50 p-6">

            <h2 class="text-xl font-bold text-yellow-800">
                Listing limit reached
            </h2>

            <p class="mt-2 text-yellow-700">
                Your <strong>{{ $plan->name }}</strong> plan allows
                <strong>{{ $plan->listing_limit }}</strong>
                published
                {{ Str::plural('product', $plan->listing_limit) }}.

                You have already used
                <strong>{{ $usedListings }}</strong>.
            </p>

            <a href="{{ route('plans.index') }}"
                class="mt-5 inline-flex rounded-lg bg-indigo-600 px-5 py-3 text-white hover:bg-indigo-700">

                Upgrade Plan

            </a>

        </div>
    @else
        <form wire:submit="save" class="space-y-8">

            <!-- Basic Information -->
            <div class="bg-white rounded-xl shadow p-6">

                <h2 class="text-xl font-semibold mb-6">
                    Basic Information
                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="font-medium">Title</label>

                        <input type="text" wire:model.defer="title" wire:model.live="title"
                            class="w-full mt-2 border rounded-lg p-3">

                        @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="font-medium">Arabic Title</label>

                        <input type="text" wire:model.defer="title_ar" class="w-full mt-2 border rounded-lg p-3">

                        @error('title_ar')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="mt-6">

                    <label class="font-medium">
                        Description
                    </label>

                    <textarea rows="6" wire:model.defer="description" wire:model.live="description"
                        class="w-full mt-2 border rounded-lg p-3"></textarea>

                    @error('description')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                </div>

                <div>

                    <label>
                        Keywords
                    </label>


                    <div class="flex gap-2">

                        <input wire:model="keyword" class="border rounded p-2" placeholder="Add keyword">


                        <button type="button" wire:click="addKeyword" class="bg-indigo-600 text-white px-4 rounded">

                            Add

                        </button>


                    </div>



                    <div class="flex gap-2 mt-3">


                        @foreach ($keywords as $index => $tag)
                            <span class="bg-gray-200 px-3 py-1 rounded-full">

                                {{ $tag }}


                                <button wire:click="removeKeyword({{ $index }})">
                                    ×
                                </button>

                            </span>
                        @endforeach


                    </div>

                </div>

            </div>

            <!-- Pricing -->
            <div class="bg-white rounded-xl shadow p-6">

                <h2 class="text-xl font-semibold mb-6">
                    Pricing & Inventory
                </h2>

                <div class="grid md:grid-cols-3 gap-6">

                    <div>

                        <label>Price</label>

                        <input type="number" step="0.01" wire:model.defer="price" wire:model.live="price"
                            class="w-full mt-2 border rounded-lg p-3">

                    </div>

                    <div>

                        <label>Quantity</label>

                        <input type="number" min="1" wire:model.defer="quantity"
                            class="w-full mt-2 border rounded-lg p-3">

                    </div>

                    <div>

                        <label>Price Type</label>

                        <select wire:model.defer="price_condition" class="w-full mt-2 border rounded-lg p-3">

                            <option value="fixed">Fixed Price</option>

                            <option value="negotiable">Negotiable</option>

                        </select>

                    </div>

                </div>

            </div>

            <!-- Categories -->
            <div class="bg-white rounded-xl shadow p-6">

                <h2 class="text-xl font-semibold mb-6">
                    Category
                </h2>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div>

                        <label>Section</label>

                        <select wire:model="section_id" class="w-full mt-2 border rounded-lg p-3">

                            <option value="">Select</option>

                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">
                                    {{ $section->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label>Category</label>

                        <select wire:model="category_id" class="w-full mt-2 border rounded-lg p-3">

                            <option value="">Select</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label>Subcategory</label>

                        <select wire:model="subcategory_id" class="w-full mt-2 border rounded-lg p-3">

                            <option value="">Select</option>

                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">
                                    {{ $subcategory->subcategory_name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label>Brand</label>

                        <select wire:model="brand_id" class="w-full mt-2 border rounded-lg p-3">

                            <option value="">Select</option>

                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">
                                    {{ $brand->brand_name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                </div>

            </div>

            <!-- Features -->
            <div class="bg-white rounded-xl shadow p-6">

                <h2 class="text-xl font-semibold mb-6">
                    Product Features
                </h2>

                <div class="flex gap-3">

                    <input type="text" wire:model="feature" class="flex-1 border rounded-lg p-3"
                        placeholder="Example: 128GB Storage">

                    <button type="button" wire:click="addFeature" class="bg-indigo-600 text-white px-6 rounded-lg">

                        Add

                    </button>

                </div>

                <div class="mt-5 flex flex-wrap gap-3">

                    @foreach ($features as $index => $feature)
                        <div class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full flex items-center">

                            {{ $feature }}

                            <button type="button" wire:click="removeFeature({{ $index }})" class="ml-3">

                                ✕

                            </button>

                        </div>
                    @endforeach

                </div>

            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <div class="grid md:grid-cols-2 gap-6">

                    {{-- Shipping Method --}}
                    <div>
                        <label class="block font-semibold mb-2">
                            Shipping Method
                        </label>

                        <select wire:model="shipping_method" class="w-full rounded-xl border-gray-300">

                            <option value="">
                                Select shipping method
                            </option>

                            <option value="Standard Shipping">
                                Standard Shipping
                            </option>

                            <option value="Express Shipping">
                                Express Shipping
                            </option>

                            <option value="Free Shipping">
                                Free Shipping
                            </option>

                            <option value="Pickup">
                                Local Pickup
                            </option>

                        </select>

                        @error('shipping_method')
                            <span class="text-red-500 text-sm">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>



                    {{-- Delivery Days --}}
                    <div>

                        <label class="block font-semibold mb-2">
                            Delivery Time (Days)
                        </label>


                        <input type="number" min="1" wire:model="delivery_days" placeholder="Example: 5"
                            class="w-full rounded-xl border-gray-300">


                        @error('delivery_days')
                            <span class="text-red-500 text-sm">
                                {{ $message }}
                            </span>
                        @enderror


                    </div>

                </div>
            </div>

            <!-- Images -->
            <div class="bg-white rounded-xl shadow p-6">

                <h2 class="text-xl font-semibold mb-6">
                    Product Images
                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label>Main Image</label>

                        <input type="file" wire:model="image" wire:model.live="image" class="mt-2">

                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="mt-4 rounded-lg h-52 object-cover">
                        @endif

                    </div>

                    <div>

                        <label>Gallery Images</label>

                        <input type="file" wire:model="images" multiple class="mt-2">

                        <div class="grid grid-cols-3 gap-3 mt-4">

                            @foreach ($images as $img)
                                <img src="{{ $img->temporaryUrl() }}" class="rounded-lg h-28 object-cover">
                            @endforeach

                        </div>

                    </div>

                </div>

            </div>

            <div>

                <label class="font-semibold block mb-2">
                    Product Video
                </label>


                <input type="file" wire:model="video" accept="video/mp4,video/webm,video/quicktime"
                    class="w-full border rounded-xl p-3">


                @error('video')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror


                @if ($video)
                    <video class="mt-4 rounded-xl w-full max-w-md" controls>

                        <source src="{{ $video->temporaryUrl() }}">

                    </video>
                @endif


                <p class="text-gray-500 text-sm mt-2">
                    Upload a short product video (15-60 seconds).
                    MP4 recommended.
                </p>

            </div>

            <!-- Publish -->
            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex justify-between items-center">

                    <div>

                        <h3 class="font-semibold text-lg">
                            Ready to publish?
                        </h3>

                        <p class="text-gray-500">
                            Your product will be published immediately.
                        </p>

                    </div>

                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-4 rounded-xl font-semibold">

                        Publish Product

                    </button>

                </div>

            </div>

        </form>

    @endif

</div>
