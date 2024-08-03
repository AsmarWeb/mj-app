<x-admin>
    <div class="bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-2xl">
        <h2 class="text-2xl font-medium mb-4">Create Service</h2>
        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
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
            <div class="mb-4">
                <label for="hs-color-input" class="block text-sm font-medium mb-2">Color picker</label>
                <input type="color" id="bg_color" name="bg_color"
                    class="p-1 h-10 w-14 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none"
                    id="hs-color-input" value="#2563eb" title="Choose your color">
            </div>
            <div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Submit</button>
            </div>

        </form>
    </div>
</x-admin>
