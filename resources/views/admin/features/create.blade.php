<x-admin>
    <div class="bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-2xl">
        <h2 class="text-2xl font-medium mb-4">Create Feature</h2>
        <form action="{{ route('features.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Enter Title</label>
                <input type="text" id="title" name="title" placeholder=""
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
                @error('title')
                    <span class="text-sm text-red-500 italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="short_des" class="block text-gray-700 font-medium mb-2">Enter Short Des</label>
                <input type="text" id="short_des" name="short_des" placeholder=""
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
                @error('short_des')
                    <span class="text-sm text-red-500 italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                <div class="mt-2">
                    <textarea id="description" name="description"
                        class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" rows="5"></textarea>
                </div>
                <div>
                    @error('description')
                        <span class="text-sm text-red-500 italic">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Submit</button>
            </div>

        </form>
    </div>
</x-admin>
