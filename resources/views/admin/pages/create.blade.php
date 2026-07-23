<x-admin>
    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Create New Page
                </h1>

                <p class="text-sm text-gray-500">
                    Add a new website page
                </p>
            </div>


            <a href="{{ route('pages.index') }}"
                class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">

                Back

            </a>

        </div>



        <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">

            @csrf


            {{-- Basic Information --}}
            <div class="bg-white rounded-xl border shadow-sm">

                <div class="px-6 py-4 border-b">

                    <h2 class="font-semibold text-gray-800">
                        Basic Information
                    </h2>

                </div>


                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">


                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Name
                        </label>

                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-primary-500">

                    </div>



                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Slug
                        </label>

                        <input type="text" name="slug" value="{{ old('slug') }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>



                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Status
                        </label>

                        <select name="status" class="w-full rounded-lg border-gray-300">

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
                        <label class="block text-sm font-medium mb-2">
                            URL
                        </label>

                        <input type="text" name="url" placeholder="/about"
                            class="w-full rounded-lg border-gray-300">

                    </div>


                </div>

            </div>





            {{-- English Content --}}
            <div class="bg-white rounded-xl border shadow-sm mt-6">


                <div class="px-6 py-4 border-b">

                    <h2 class="font-semibold text-gray-800">
                        English Content
                    </h2>

                </div>



                <div class="p-6 space-y-5">


                    <input name="title" placeholder="Page Title" class="w-full rounded-lg border-gray-300">



                    <input name="subtitle" placeholder="Subtitle" class="w-full rounded-lg border-gray-300">



                    <textarea name="short_des" rows="3" placeholder="Short Description" class="w-full rounded-lg border-gray-300"></textarea>



                    <textarea name="content" rows="8" placeholder="Full Content" class="w-full rounded-lg border-gray-300"></textarea>


                </div>


            </div>





            {{-- Arabic Content --}}
            <div class="bg-white rounded-xl border shadow-sm mt-6">


                <div class="px-6 py-4 border-b">

                    <h2 class="font-semibold text-gray-800">
                        Arabic Content
                    </h2>

                </div>



                <div class="p-6 space-y-5" dir="rtl">


                    <input name="title_ar" placeholder="العنوان" class="w-full rounded-lg border-gray-300">



                    <input name="subtitle_ar" placeholder="العنوان الفرعي" class="w-full rounded-lg border-gray-300">



                    <textarea name="short_des_ar" rows="3" placeholder="الوصف القصير" class="w-full rounded-lg border-gray-300"></textarea>



                    <textarea name="content_ar" rows="8" placeholder="المحتوى" class="w-full rounded-lg border-gray-300"></textarea>


                </div>


            </div>







            {{-- SEO --}}
            <div class="bg-white rounded-xl border shadow-sm mt-6">


                <div class="px-6 py-4 border-b">

                    <h2 class="font-semibold text-gray-800">
                        SEO Settings
                    </h2>

                </div>


                <div class="p-6 space-y-5">


                    <input name="meta_title" placeholder="Meta Title" class="w-full rounded-lg border-gray-300">



                    <input name="meta_keywords" placeholder="Meta Keywords" class="w-full rounded-lg border-gray-300">



                    <textarea name="meta_description" rows="4" placeholder="Meta Description"
                        class="w-full rounded-lg border-gray-300"></textarea>


                </div>

            </div>







            {{-- Image --}}
            <div class="bg-white rounded-xl border shadow-sm mt-6">


                <div class="px-6 py-4 border-b">

                    <h2 class="font-semibold text-gray-800">
                        Featured Image
                    </h2>

                </div>


                <div class="p-6">

                    <input type="file" name="image" class="block w-full text-sm">

                </div>


            </div>







            {{-- Footer --}}
            <div class="flex justify-end gap-3 mt-6">


                <a href="{{ route('pages.index') }}" class="px-5 py-2 rounded-lg border">

                    Cancel

                </a>



                <button type="submit"
                    class="px-6 py-2 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 shadow-sm transition">

                    Create Page

                </button>


            </div>



        </form>


    </div>
</x-admin>
