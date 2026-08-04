<div class="bg-white border rounded-xl px-8 py-6 mx-auto my-8 max-w-5xl">

    @if (session()->has('success'))
        <div class="mb-6 rounded-lg bg-green-100 border border-green-300 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif


    @if (session()->has('error'))
        <div class="mb-6 rounded-lg bg-red-100 border border-red-300 px-4 py-3 text-red-700">
            {{ session('error') }}
        </div>
    @endif



    <form wire:submit.prevent="save">


        <div class="space-y-8">


            {{-- Basic Information --}}

            <div class="border-b pb-8">

                <h2 class="text-lg font-semibold">
                    Product Information
                </h2>


                <div class="grid md:grid-cols-2 gap-6 mt-6">


                    <div>
                        <label class="text-sm font-medium">
                            Title
                        </label>

                        <input wire:model="title" class="mt-2 w-full rounded-lg border-gray-300"
                            placeholder="Product title">


                        @error('title')
                            <span class="text-red-500 text-sm">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>




                    <div dir="rtl">

                        <label class="text-sm font-medium">
                            العنوان
                        </label>


                        <input wire:model="title_ar" class="mt-2 w-full rounded-lg border-gray-300 text-right"
                            placeholder="عنوان المنتج">


                    </div>



                    <div>

                        <label>
                            Price
                        </label>

                        <input type="number" wire:model="price" class="mt-2 w-full rounded-lg border-gray-300">

                    </div>



                    <div>

                        <label>
                            Quantity
                        </label>

                        <input type="number" wire:model="quantity" class="mt-2 w-full rounded-lg border-gray-300">

                    </div>


                </div>

            </div>






            {{-- Description --}}

            <div>

                <label class="font-medium">
                    Description
                </label>


                <textarea wire:model="description" rows="5" class="mt-2 w-full rounded-lg border-gray-300">
</textarea>


            </div>







            {{-- Condition --}}

            <div class="grid md:grid-cols-2 gap-6">


                <div>

                    <label class="font-medium">
                        Condition
                    </label>


                    <select wire:model="condition" class="mt-2 w-full rounded-lg border-gray-300">


                        <option value="new">
                            New
                        </option>


                        <option value="used">
                            Used
                        </option>


                    </select>


                </div>




                <div>

                    <label class="font-medium">
                        Price Condition
                    </label>


                    <select wire:model="price_condition" class="mt-2 w-full rounded-lg border-gray-300">


                        <option value="fixed">
                            Fixed
                        </option>


                        <option value="negotiable">
                            Negotiable
                        </option>


                    </select>


                </div>



            </div>







            {{-- Features --}}

            <div>


                <label class="font-medium">
                    Features
                </label>



                <div class="flex gap-3 mt-3">

                    <input wire:model="feature" class="flex-1 rounded-lg border-gray-300"
                        placeholder="Example: Handmade">


                    <button type="button" wire:click="addFeature" class="px-4 bg-indigo-600 text-white rounded-lg">

                        Add

                    </button>

                </div>



                @foreach ($features as $index => $item)
                    <div class="flex gap-3 mt-3">


                        <input wire:model="features.{{ $index }}" class="flex-1 rounded-lg border-gray-300">


                        <button type="button" wire:click="removeFeature({{ $index }})"
                            class="px-4 bg-red-600 text-white rounded-lg">

                            Remove

                        </button>


                    </div>
                @endforeach


            </div>







            {{-- Keywords --}}


            <div>


                <label class="font-medium">
                    Keywords
                </label>


                <div class="flex gap-3 mt-3">


                    <input wire:model="keyword" class="flex-1 rounded-lg border-gray-300" placeholder="keyword">


                    <button type="button" wire:click="addKeyword" class="px-4 bg-indigo-600 text-white rounded-lg">

                        Add

                    </button>


                </div>



                <div class="flex gap-2 mt-3 flex-wrap">

                    @foreach ($keywords as $index => $item)
                        <span class="bg-gray-200 px-3 py-1 rounded-lg">


                            {{ $item }}


                            <button type="button" wire:click="removeKeyword({{ $index }})"
                                class="text-red-600 ml-2">

                                x

                            </button>


                        </span>
                    @endforeach

                </div>


            </div>







            {{-- Shipping --}}


            <div class="grid md:grid-cols-2 gap-6">


                <div>

                    <label>
                        Shipping Method
                    </label>


                    <input wire:model="shipping_method" class="mt-2 w-full rounded-lg border-gray-300">

                </div>




                <div>

                    <label>
                        Delivery Days
                    </label>


                    <input type="number" wire:model="delivery_days" class="mt-2 w-full rounded-lg border-gray-300">


                </div>


            </div>







            {{-- Images --}}


            <div>


                <label>
                    Main Image
                </label>


                <input type="file" wire:model="image" class="mt-2">


                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="mt-4 w-32 h-32 rounded-lg object-cover">
                @endif


            </div>






            <div>


                <label>
                    Gallery Images
                </label>


                <input type="file" wire:model="images" multiple class="mt-2">



                @if ($images)

                    <div class="flex gap-3 mt-4 flex-wrap">


                        @foreach ($images as $img)
                            <img src="{{ $img->temporaryUrl() }}" class="w-24 h-24 rounded-lg object-cover">
                        @endforeach


                    </div>

                @endif


            </div>







            {{-- Categories --}}
            <div
                class="bg-white dark:bg-neutral-900 rounded-3xl shadow-lg border border-gray-200 dark:border-neutral-800 p-6 space-y-8">

                {{-- STEP 1 --}}
                <div>
                    <h3 class="text-lg font-bold mb-4">
                        1. Select Section
                    </h3>

                    <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">

                        @foreach ($sections as $section)
                            <button type="button" wire:click="$set('section_id', {{ $section->id }})"
                                class="
                        shrink-0
                        px-5
                        py-3
                        rounded-2xl
                        border
                        transition-all
                        duration-300

                        {{ $section_id == $section->id
                            ? 'bg-orange-500 border-orange-500 text-white shadow-lg'
                            : 'bg-white dark:bg-neutral-800 border-gray-200 dark:border-neutral-700 hover:border-orange-400 hover:-translate-y-1' }}
                    ">

                                {{ $section->name }}

                            </button>
                        @endforeach

                    </div>
                </div>


                {{-- STEP 2 --}}
                @if ($section_id)

                    <div>

                        <h3 class="text-lg font-bold mb-4">
                            2. Choose Category
                        </h3>

                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

                            @foreach ($categories as $category)
                                <button type="button" wire:click="$set('category_id', {{ $category->id }})"
                                    class="
                        rounded-2xl
                        border
                        p-5
                        text-center
                        transition-all
                        duration-300

                        {{ $category_id == $category->id
                            ? 'bg-orange-500 text-white border-orange-500 shadow-xl scale-105'
                            : 'bg-white dark:bg-neutral-800 border-gray-200 dark:border-neutral-700 hover:border-orange-400 hover:-translate-y-1' }}
                    ">

                                    <div class="text-4xl mb-3">

                                        📦

                                    </div>

                                    <div class="font-semibold">

                                        {{ $category->category_name }}

                                    </div>

                                </button>
                            @endforeach

                        </div>

                    </div>

                @endif


                {{-- STEP 3 --}}
                @if ($category_id)

                    <div>

                        <h3 class="text-lg font-bold mb-4">
                            3. Select Subcategory
                        </h3>

                        <div class="flex flex-wrap gap-3">

                            @foreach ($subcategories->where('category_id', $category_id) as $subcategory)
                                <button type="button" wire:click="$set('subcategory_id', {{ $subcategory->id }})"
                                    class="
                        px-5
                        py-3
                        rounded-full
                        border
                        transition

                        {{ $subcategory_id == $subcategory->id
                            ? 'bg-orange-500 text-white border-orange-500'
                            : 'bg-gray-100 dark:bg-neutral-800 border-gray-200 dark:border-neutral-700 hover:border-orange-400' }}
                    ">

                                    {{ $subcategory->subcategory_name }}

                                </button>
                            @endforeach

                        </div>

                    </div>

                @endif


                {{-- STEP 4 --}}
                @if ($subcategory_id)

                    <div>

                        <h3 class="text-lg font-bold mb-4">
                            4. Select Brand
                        </h3>

                        <div class="flex flex-wrap gap-3">

                            @foreach ($brands as $brand)
                                <button type="button" wire:click="$set('brand_id', {{ $brand->id }})"
                                    class="
                        px-5
                        py-3
                        rounded-full
                        border
                        transition

                        {{ $brand_id == $brand->id
                            ? 'bg-black dark:bg-orange-500 text-white border-orange-500'
                            : 'bg-white dark:bg-neutral-800 border-gray-200 dark:border-neutral-700 hover:border-orange-400' }}
                    ">

                                    {{ $brand->brand_name }}

                                </button>
                            @endforeach

                        </div>

                    </div>

                @endif

            </div>






            <div class="flex justify-end gap-4 pt-6">


                <a href="{{ route('listings.index') }}" class="px-5 py-2 border rounded-lg">

                    Cancel

                </a>




                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">

                    Create Listing

                </button>


            </div>




        </div>


    </form>


</div>
