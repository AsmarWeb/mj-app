<x-admin>

    <div x-data="{
        type: '{{ old('type', 'digital') }}',
        coverPreview: null,
        galleryPreview: []
    }" class="max-w-7xl mx-auto py-10 px-6">


        {{-- HEADER --}}
        <div class="mb-10">

            <h1 class="text-4xl font-black text-gray-900">
                Create Product
            </h1>

            <p class="mt-2 text-gray-500">
                Create digital products, print on demand products, and services.
            </p>

        </div>



        {{-- SUCCESS --}}

        @if (session('success'))
            <div class="mb-6 rounded-2xl bg-green-100 border border-green-200 p-5 text-green-700">
                {{ session('success') }}
            </div>
        @endif



        {{-- ERRORS --}}

        @if ($errors->any())

            <div class="mb-6 rounded-2xl bg-red-100 border border-red-200 p-5">

                <ul class="list-disc ml-5 text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>

        @endif





        <form method="POST" action="{{ route('digital-products.store') }}" enctype="multipart/form-data">


            @csrf



            <div class="grid lg:grid-cols-3 gap-8">



                {{-- MAIN CONTENT --}}
                <div class="lg:col-span-2 space-y-8">





                    {{-- PRODUCT TYPE --}}

                    <div class="bg-white rounded-3xl shadow-sm p-8">


                        <h2 class="text-xl font-bold mb-6">
                            Product Type
                        </h2>



                        <div class="grid md:grid-cols-3 gap-5">


                            <label class="cursor-pointer border rounded-2xl p-5 hover:border-orange-500">

                                <input type="radio" name="type" value="digital" class="hidden" x-model="type">

                                <div class="text-center">

                                    <div class="text-4xl">
                                        📦
                                    </div>

                                    <p class="font-bold mt-3">
                                        Digital Product
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        Templates, files, courses
                                    </p>

                                </div>

                            </label>




                            <label class="cursor-pointer border rounded-2xl p-5 hover:border-orange-500">

                                <input type="radio" name="type" value="pod" class="hidden" x-model="type">

                                <div class="text-center">

                                    <div class="text-4xl">
                                        👕
                                    </div>

                                    <p class="font-bold mt-3">
                                        Print On Demand
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        T-Shirts, mugs, hoodies
                                    </p>

                                </div>

                            </label>




                            <label class="cursor-pointer border rounded-2xl p-5 hover:border-orange-500">

                                <input type="radio" name="type" value="service" class="hidden" x-model="type">

                                <div class="text-center">

                                    <div class="text-4xl">
                                        🛠
                                    </div>

                                    <p class="font-bold mt-3">
                                        Service
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        Design and custom work
                                    </p>

                                </div>

                            </label>


                        </div>


                    </div>







                    {{-- PRODUCT INFORMATION --}}

                    <div class="bg-white rounded-3xl shadow-sm p-8">


                        <h2 class="text-xl font-bold mb-6">
                            Product Information
                        </h2>



                        {{-- CATEGORY --}}

                        <div class="mb-6">

                            <label class="font-bold block mb-2">
                                Category
                            </label>


                            <select name="digital_category_id" class="w-full rounded-xl border-gray-300" required>


                                <option value="">
                                    Choose Category
                                </option>


                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('digital_category_id') == $category->id)>

                                        {{ app()->getLocale() == 'ar' ? $category->category_name_ar : $category->category_name }}

                                    </option>
                                @endforeach


                            </select>


                        </div>





                        <div class="grid md:grid-cols-2 gap-6">


                            <div>

                                <label class="font-bold block mb-2">
                                    English Title
                                </label>


                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="w-full rounded-xl border-gray-300" placeholder="Modern UI Kit" required>


                            </div>




                            <div>

                                <label class="font-bold block mb-2">
                                    Arabic Title
                                </label>


                                <input type="text" name="title_ar" value="{{ old('title_ar') }}"
                                    class="w-full rounded-xl border-gray-300" placeholder="واجهة مستخدم">


                            </div>


                        </div>





                        <div class="grid md:grid-cols-2 gap-6 mt-6">


                            <div>

                                <label class="font-bold block mb-2">
                                    Description
                                </label>


                                <textarea name="description" rows="6" class="w-full rounded-xl border-gray-300" required>{{ old('description') }}</textarea>


                            </div>



                            <div>

                                <label class="font-bold block mb-2">
                                    Arabic Description
                                </label>


                                <textarea name="description_ar" rows="6" class="w-full rounded-xl border-gray-300">{{ old('description_ar') }}</textarea>


                            </div>


                        </div>



                    </div>









                    {{-- PRICING --}}

                    <div class="bg-white rounded-3xl shadow-sm p-8">


                        <h2 class="text-xl font-bold mb-6">
                            Pricing & License
                        </h2>



                        <div class="grid md:grid-cols-3 gap-6">


                            <div>

                                <label class="font-bold block mb-2">
                                    Price
                                </label>


                                <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                                    class="w-full rounded-xl border-gray-300" placeholder="29.99">


                            </div>




                            <div>

                                <label class="font-bold block mb-2">
                                    License
                                </label>


                                <select name="license" class="w-full rounded-xl border-gray-300">


                                    <option value="personal">
                                        Personal
                                    </option>


                                    <option value="commercial">
                                        Commercial
                                    </option>


                                    <option value="extended">
                                        Extended
                                    </option>


                                </select>


                            </div>




                            <div class="flex items-center gap-3 mt-8">


                                <input type="checkbox" name="featured" value="1" class="rounded text-orange-500">


                                <label class="font-bold">
                                    Featured
                                </label>


                            </div>



                        </div>


                    </div>








                    {{-- COVER IMAGE --}}

                    <div class="bg-white rounded-3xl shadow-sm p-8">


                        <h2 class="text-xl font-bold mb-6">
                            Cover Image
                        </h2>



                        <label
                            class="border-2 border-dashed rounded-3xl p-10 flex justify-center items-center cursor-pointer">


                            <input type="file" name="image" accept="image/*" class="hidden" required
                                @change="
coverPreview =
URL.createObjectURL($event.target.files[0])
">



                            <template x-if="!coverPreview">

                                <div class="text-center">

                                    <div class="text-6xl">
                                        🖼️
                                    </div>

                                    <p class="font-bold mt-3">
                                        Upload Cover Image
                                    </p>

                                    <p class="text-gray-500 text-sm">
                                        PNG JPG WEBP
                                    </p>

                                </div>

                            </template>



                            <template x-if="coverPreview">


                                <img :src="coverPreview" class="h-72 rounded-2xl object-cover" />


                            </template>


                        </label>


                    </div>





                    {{-- GALLERY --}}

                    <div class="bg-white rounded-3xl shadow-sm p-8">


                        <h2 class="text-xl font-bold mb-6">
                            Gallery Images
                        </h2>



                        <input type="file" name="gallery[]" multiple accept="image/*"
                            @change="
galleryPreview =
Array.from($event.target.files)
.map(file=>URL.createObjectURL(file))
"
                            class="w-full">


                        <div class="grid grid-cols-3 gap-4 mt-5">


                            <template x-for="img in galleryPreview">

                                <img :src="img" class="h-32 w-full object-cover rounded-xl">


                            </template>


                        </div>



                    </div>



                </div>

                {{-- RIGHT SIDEBAR --}}
                <div class="space-y-8">



                    {{-- PUBLISH CARD --}}

                    <div class="bg-white rounded-3xl shadow-sm p-6 sticky top-6">


                        <h2 class="text-xl font-bold mb-6">
                            Publish
                        </h2>



                        <div class="space-y-5">



                            <div>

                                <label class="font-bold block mb-2">
                                    Status
                                </label>


                                <select name="status" class="w-full rounded-xl border-gray-300">


                                    <option value="draft">
                                        Draft
                                    </option>


                                    <option value="published">
                                        Published
                                    </option>


                                    <option value="archived">
                                        Archived
                                    </option>


                                </select>

                            </div>





                            <div>

                                <label class="font-bold block mb-2">
                                    Visibility
                                </label>


                                <select class="w-full rounded-xl border-gray-300">


                                    <option>
                                        Public
                                    </option>


                                    <option>
                                        Private
                                    </option>


                                </select>


                            </div>





                            <div class="flex items-center gap-3">


                                <input type="checkbox" name="is_free" value="1"
                                    class="rounded text-orange-500">


                                <label class="font-bold">
                                    Free Product
                                </label>


                            </div>




                        </div>



                    </div>





                    {{-- DIGITAL FILE --}}

                    <div x-show="type === 'digital'" class="bg-white rounded-3xl shadow-sm p-6">


                        <h2 class="text-xl font-bold mb-5">
                            Digital File
                        </h2>



                        <label class="block border-2 border-dashed rounded-2xl p-8 cursor-pointer text-center">


                            <input type="file" name="file" class="hidden">


                            <div class="text-5xl">
                                📦
                            </div>


                            <p class="font-bold mt-3">
                                Upload Main File
                            </p>


                            <p class="text-sm text-gray-500">
                                ZIP, PSD, AI, FIG, PDF, MP4
                            </p>


                        </label>


                    </div>









                    {{-- DIGITAL DETAILS --}}

                    <div x-show="type === 'digital'" class="bg-white rounded-3xl shadow-sm p-6">


                        <h2 class="text-xl font-bold mb-5">
                            File Information
                        </h2>


                        <div class="space-y-4">



                            <input name="version" value="{{ old('version') }}" placeholder="Version 1.0"
                                class="w-full rounded-xl border-gray-300">



                            <input name="compatible_with" value="{{ old('compatible_with') }}"
                                placeholder="Compatible with: Figma, Photoshop, Canva"
                                class="w-full rounded-xl border-gray-300">




                            <input name="included_files" value="{{ old('included_files') }}"
                                placeholder="Included files: PSD, PNG, SVG" class="w-full rounded-xl border-gray-300">




                            <input name="file_size" value="{{ old('file_size') }}" placeholder="File size: 250 MB"
                                class="w-full rounded-xl border-gray-300">


                        </div>


                    </div>









                    {{-- PREVIEW --}}

                    <div class="bg-white rounded-3xl shadow-sm p-6">


                        <h2 class="text-xl font-bold mb-5">
                            Preview
                        </h2>


                        <div class="space-y-4">


                            <input name="preview_url" value="{{ old('preview_url') }}" placeholder="Preview URL"
                                class="w-full rounded-xl border-gray-300">


                            <input name="video_url" value="{{ old('video_url') }}" placeholder="Video URL"
                                class="w-full rounded-xl border-gray-300">


                        </div>


                    </div>









                    {{-- EXTRA INFORMATION --}}

                    <div class="bg-white rounded-3xl shadow-sm p-6">


                        <h2 class="text-xl font-bold mb-5">
                            Extra Information
                        </h2>



                        <textarea name="requirements" rows="4" placeholder="Requirements"
                            class="w-full rounded-xl border-gray-300 mb-4">{{ old('requirements') }}</textarea>




                        <textarea name="installation" rows="4" placeholder="Installation instructions"
                            class="w-full rounded-xl border-gray-300 mb-4">{{ old('installation') }}</textarea>





                        <textarea name="changelog" rows="4" placeholder="Change log" class="w-full rounded-xl border-gray-300">{{ old('changelog') }}</textarea>



                    </div>









                    {{-- POD SECTION --}}

                    <div x-show="type === 'pod'" class="bg-white rounded-3xl shadow-sm p-6">


                        <h2 class="text-xl font-bold mb-5">
                            Print On Demand
                        </h2>



                        <div class="space-y-5">


                            <div>

                                <label class="font-bold block mb-2">
                                    Product Base
                                </label>

                                <input name="base_product" value="{{ old('base_product') }}"
                                    placeholder="T-Shirt, Hoodie, Mug" class="w-full rounded-xl border-gray-300">

                            </div>



                            <div>

                                <label class="font-bold block mb-2">
                                    Supplier Base Cost
                                </label>

                                <p class="text-sm text-gray-500 mb-2">
                                    Your cost from supplier before marketplace profit.
                                </p>


                                <input type="number" step="0.01" name="base_cost"
                                    value="{{ old('base_cost') }}" placeholder="Example: 12.50"
                                    class="w-full rounded-xl border-gray-300">

                            </div>


                            <select name="supplier_id" class="w-full rounded-xl border-gray-300">

                                <option value="">
                                    Choose Supplier
                                </option>

                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" @selected(old('supplier_id') == $supplier->id)>

                                        {{ $supplier->name }}

                                    </option>
                                @endforeach

                            </select>



                            <div>

                                <label class="font-bold block mb-2">
                                    Sizes
                                </label>


                                <div class="flex flex-wrap gap-3">


                                    @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                                        <label class="border rounded-xl px-4 py-2">


                                            <input type="checkbox" name="sizes[]" value="{{ $size }}">


                                            {{ $size }}


                                        </label>
                                    @endforeach


                                </div>

                            </div>






                            <div>

                                <label class="font-bold block mb-2">
                                    Colors
                                </label>


                                <div class="flex flex-wrap gap-3">


                                    @foreach (['Black', 'White', 'Blue', 'Red'] as $color)
                                        <label class="border rounded-xl px-4 py-2">


                                            <input type="checkbox" name="colors[]" value="{{ $color }}">


                                            {{ $color }}


                                        </label>
                                    @endforeach


                                </div>


                            </div>



                        </div>


                    </div>









                    {{-- SAVE BUTTONS --}}


                    <div class="bg-white rounded-3xl shadow-sm p-6">


                        <button type="submit"
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white py-4 rounded-2xl font-bold text-lg">

                            Publish Product

                        </button>



                        <button type="button" class="w-full mt-4 border py-4 rounded-2xl font-bold">

                            Save Draft

                        </button>



                    </div>




                </div>





            </div>


        </form>


    </div>


</x-admin>
