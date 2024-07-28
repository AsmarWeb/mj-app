<x-admin>
    <div class="bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-2xl">
        <h2 class="text-2xl font-medium mb-4">Create Section</h2>
        <form action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Enter Section Name</label>
                <input type="text" id="name" name="name" placeholder="Jobs"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
            </div>

            <div class="mb-4 text-end">
                <label for="name_ar" class="block text-sm font-medium leading-6 text-gray-900 text-right">
                    أدخل الاسم بالغة العربية
                </label>
                <div class="mt-2">
                    <input type="text" id="name_ar" name="name_ar" placeholder="وظائف"
                        class="text-right block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <div>
                    @error('name_ar')
                        <span class="text-sm text-red-500 italic">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Submit</button>
            </div>

        </form>
    </div>
</x-admin>
