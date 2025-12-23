<x-admin>
    <div class="bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-2xl">
        <h2 class="text-2xl font-medium mb-4">Create Category</h2>
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Enter Category Name</label>
                <input type="text" id="category_name" name="category_name" placeholder="Cell Phones"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
            </div>
            <div class="mb-4 text-end">
                <label for="title_ar" class="block text-sm font-medium leading-6 text-gray-900 text-right">
                    أدخل الاسم بالغة العربية
                </label>
                <div class="mt-2">
                    <input type="text" id="category_name_ar" name="category_name_ar" placeholder="هاتف خليوي"
                        class="text-right block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <div>
                    @error('title_ar')
                        <span class="text-sm text-red-500 italic">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            @php
                $sections = App\Models\Section::where('status', 'active')->get();
            @endphp

            <div class="mb-4">
                <label for="section_id" class="block text-gray-700 font-medium mb-2">Select Section</label>
                <select name="section_id"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
                    <option selected>Select One....</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
            </div> 
            <div class="mb-4">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                </div>
            </div>
            <div class="mb-4">
                <label for="parent_id" class="block text-gray-700 font-medium mb-2">Select Category Level</label>
                <select name="parent_id" class="form-control">
                    <option value="0">Main Category</option>
                </select>
            </div>
            <div class="mb-4">
                <label>Pick bg color</label>
                <div class="input-group colorpickerinput">
                    <input type="text" name="bg_color" class="form-control">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-fill-drip"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Submit</button>
            </div>

        </form>
    </div>
</x-admin>
