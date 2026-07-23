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


            <div class="grid md:grid-cols-4 gap-5">


                <select wire:model.live="section_id" class="rounded-lg border-gray-300">

                    <option>
                        Select Section
                    </option>


                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">
                            {{ $section->name }}
                        </option>
                    @endforeach


                </select>





                <select wire:model.live="category_id" class="rounded-lg border-gray-300">


                    <option>
                        Select Category
                    </option>


                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->category_name }}
                        </option>
                    @endforeach


                </select>






                <select wire:model="subcategory_id" class="rounded-lg border-gray-300">


                    <option>
                        Select Subcategory
                    </option>


                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">
                            {{ $subcategory->subcategory_name }}
                        </option>
                    @endforeach


                </select>





                <select wire:model="brand_id" class="rounded-lg border-gray-300">


                    <option>
                        Select Brand
                    </option>


                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">
                            {{ $brand->brand_name }}
                        </option>
                    @endforeach


                </select>



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
