<x-admin>

    <div class="max-w-6xl mx-auto py-10 px-6">

        <div class="mb-10">
            <h1 class="text-4xl font-bold text-gray-900">
                Create Digital Product
            </h1>

            <p class="mt-2 text-gray-500">
                Upload templates, graphics, fonts, software, courses and other digital assets.
            </p>
        </div>



        @if (session('success'))
            <div class="mb-6 rounded-2xl bg-green-100 border border-green-200 p-5 text-green-700">
                {{ session('success') }}
            </div>
        @endif



        @if ($errors->any())

            <div class="mb-6 rounded-2xl bg-red-100 border border-red-200 p-5">

                <ul class="list-disc ml-5 text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif





        <form method="POST" action="{{ route('digital-products.store') }}" enctype="multipart/form-data"
            class="space-y-8">


            @csrf



            <div class="bg-white rounded-3xl shadow-xl p-8 space-y-8">



                {{-- CATEGORY --}}

                <div>

                    <label class="block font-bold mb-3">
                        Category
                    </label>


                    <select name="digital_category_id" required
                        class="w-full rounded-xl border-gray-300 focus:ring-orange-500">


                        <option value="">
                            Choose category
                        </option>


                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('digital_category_id') == $category->id)>

                                {{ app()->getLocale() == 'ar' ? $category->category_name_ar : $category->category_name }}

                            </option>
                        @endforeach


                    </select>

                </div>





                {{-- TITLE --}}

                <div class="grid md:grid-cols-2 gap-6">


                    <div>

                        <label class="font-bold block mb-2">
                            English Title
                        </label>


                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Modern UI Kit"
                            class="w-full rounded-xl border-gray-300" required>


                    </div>




                    <div>

                        <label class="font-bold block mb-2">
                            Arabic Title
                        </label>


                        <input type="text" name="title_ar" value="{{ old('title_ar') }}"
                            placeholder="واجهة مستخدم حديثة" class="w-full rounded-xl border-gray-300" required>


                    </div>


                </div>





                {{-- DESCRIPTION --}}

                <div class="grid md:grid-cols-2 gap-6">


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


                        <textarea name="description_ar" rows="6" class="w-full rounded-xl border-gray-300" required>{{ old('description_ar') }}</textarea>


                    </div>


                </div>







                {{-- PRICE OPTIONS --}}

                <div class="grid md:grid-cols-3 gap-6">


                    <div>

                        <label class="font-bold block mb-2">
                            Price
                        </label>


                        <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                            placeholder="29.99" class="w-full rounded-xl border-gray-300" required>

                    </div>



                    <div class="flex items-center gap-3 mt-8">


                        <input type="checkbox" name="featured" value="1" class="rounded text-orange-500">


                        <label>
                            Featured Product
                        </label>


                    </div>





                    <div class="flex items-center gap-3 mt-8">


                        <input type="checkbox" name="is_free" value="1" class="rounded text-orange-500">


                        <label>
                            Free Product
                        </label>


                    </div>



                </div>







                {{-- IMAGE UPLOAD --}}


                <div x-data="{
                    preview: null,
                
                    show(event) {
                
                        let file = event.target.files[0];
                
                        if (file) {
                
                            this.preview = URL.createObjectURL(file);
                
                        }
                
                    }
                
                }">


                    <label class="font-bold block mb-3">
                        Product Cover Image
                    </label>



                    <label
                        class="cursor-pointer flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-3xl p-12 hover:border-orange-500 transition">


                        <input type="file" name="image" accept="image/*" class="hidden" @change="show($event)"
                            required>



                        <template x-if="!preview">

                            <div class="text-center">

                                <div class="text-6xl">
                                    🖼️
                                </div>


                                <h3 class="font-bold mt-3">
                                    Upload Cover
                                </h3>


                                <p class="text-gray-500">
                                    PNG JPG WEBP
                                </p>


                            </div>


                        </template>



                        <template x-if="preview">


                            <img :src="preview" class="h-72 rounded-2xl object-cover shadow">


                        </template>



                    </label>


                </div>







                {{-- DIGITAL FILE --}}


                <div x-data="{
                    file: '',
                
                    choose(e) {
                
                        this.file = e.target.files[0].name;
                
                    }
                
                }">


                    <label class="font-bold block mb-3">
                        Digital Download File
                    </label>


                    <label class="block border rounded-2xl p-6 bg-gray-50 cursor-pointer">


                        <input type="file" name="file" class="hidden" @change="choose($event)" required>



                        <div class="text-center">


                            <div class="text-5xl">
                                📦
                            </div>


                            <p class="font-bold mt-3">
                                Click to upload file
                            </p>


                            <p x-text="file" class="text-green-600 mt-2">
                            </p>


                            <p class="text-sm text-gray-500 mt-3">

                                ZIP, PDF, PSD, AI, SVG, FIG, XD,
                                DOCX, PPTX, MP4, MP3

                            </p>


                        </div>



                    </label>


                </div>






            </div>






            <button
                class="w-full bg-orange-500 hover:bg-orange-600 text-white py-4 rounded-2xl font-bold text-lg shadow-lg">

                Publish Digital Product

            </button>




        </form>


    </div>


</x-admin>
