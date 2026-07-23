<x-admin>
    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Edit Page
                </h1>

                <p class="text-sm text-gray-500">
                    Update page content and settings
                </p>
            </div>


            <a href="{{ route('pages.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">

                Back

            </a>

        </div>




        <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')



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

                        <input type="text" name="name" value="{{ old('name', $page->name) }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>



                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Slug
                        </label>

                        <input type="text" name="slug" value="{{ old('slug', $page->slug) }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>



                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Status
                        </label>


                        <select name="status" class="w-full rounded-lg border-gray-300">

                            <option value="draft" @if ($page->status == 'draft') selected @endif>
                                Draft
                            </option>


                            <option value="published" @if ($page->status == 'published') selected @endif>
                                Published
                            </option>


                            <option value="archived" @if ($page->status == 'archived') selected @endif>
                                Archived
                            </option>


                        </select>

                    </div>



                    <div>

                        <label class="block text-sm font-medium mb-2">
                            URL
                        </label>

                        <input type="text" name="url" value="{{ old('url', $page->url) }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>


                </div>

            </div>





            {{-- English --}}
            <div class="bg-white rounded-xl border shadow-sm mt-6">

                <div class="px-6 py-4 border-b">
                    <h2 class="font-semibold">
                        English Content
                    </h2>
                </div>


                <div class="p-6 space-y-5">


                    <input type="text" name="title" value="{{ old('title', $page->title) }}" placeholder="Title"
                        class="w-full rounded-lg border-gray-300">



                    <input type="text" name="subtitle" value="{{ old('subtitle', $page->subtitle) }}"
                        placeholder="Subtitle" class="w-full rounded-lg border-gray-300">



                    <textarea name="short_des" rows="3" placeholder="Short Description" class="w-full rounded-lg border-gray-300">{{ old('short_des', $page->short_des) }}</textarea>



                    <textarea name="content" rows="8" placeholder="Content" class="w-full rounded-lg border-gray-300">{{ old('content', $page->content) }}</textarea>


                </div>

            </div>






            {{-- Arabic --}}
            <div class="bg-white rounded-xl border shadow-sm mt-6">


                <div class="px-6 py-4 border-b">
                    <h2 class="font-semibold">
                        Arabic Content
                    </h2>
                </div>



                <div class="p-6 space-y-5" dir="rtl">


                    <input type="text" name="title_ar" value="{{ old('title_ar', $page->title_ar) }}"
                        placeholder="العنوان" class="w-full rounded-lg border-gray-300">



                    <input type="text" name="subtitle_ar" value="{{ old('subtitle_ar', $page->subtitle_ar) }}"
                        placeholder="العنوان الفرعي" class="w-full rounded-lg border-gray-300">



                    <textarea name="short_des_ar" rows="3" placeholder="الوصف القصير" class="w-full rounded-lg border-gray-300">{{ old('short_des_ar', $page->short_des_ar) }}</textarea>



                    <textarea name="content_ar" rows="8" placeholder="المحتوى" class="w-full rounded-lg border-gray-300">{{ old('content_ar', $page->content_ar) }}</textarea>


                </div>


            </div>







            {{-- SEO --}}
            <div class="bg-white rounded-xl border shadow-sm mt-6">


                <div class="px-6 py-4 border-b">
                    <h2 class="font-semibold">
                        SEO Settings
                    </h2>
                </div>



                <div class="p-6 space-y-5">


                    <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}"
                        placeholder="Meta Title" class="w-full rounded-lg border-gray-300">



                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}"
                        placeholder="Meta Keywords" class="w-full rounded-lg border-gray-300">



                    <textarea name="meta_description" rows="4" placeholder="Meta Description"
                        class="w-full rounded-lg border-gray-300">{{ old('meta_description', $page->meta_description) }}</textarea>


                </div>

            </div>







            {{-- Image --}}
            <div class="bg-white rounded-xl border shadow-sm mt-6">


                <div class="px-6 py-4 border-b">
                    <h2 class="font-semibold">
                        Featured Image
                    </h2>
                </div>



                <div class="p-6">


                    @if ($page->image)
                        <div class="mb-4">

                            <img src="{{ asset('storage/pages/' . $page->image) }}" class="h-32 rounded-lg border">

                        </div>
                    @endif



                    <input type="file" name="image" class="block w-full">


                </div>


            </div>







            {{-- Buttons --}}
            <div class="flex justify-end gap-3">


                <a href="{{ route('pages.index') }}" class="px-5 py-2 rounded-lg border">

                    Cancel

                </a>



                <button type="submit"
                    class="px-6 py-2 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 shadow-sm transition">
                    Update Page
                </button>


            </div>




        </form>

    </div>
</x-admin>
