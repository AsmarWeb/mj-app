<x-admin>
    <div class="bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-2xl">
        <h2 class="text-2xl font-medium mb-4">Edit Settings</h2>
        <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <div class="form-group">
                    <strong>Logo:</strong>
                    <input type="file" name="logo" class="form-control" placeholder="logo">
                </div>
            </div>

            <div class="mb-4">
                <div class="form-group">
                    <strong>Favicon:</strong>
                    <input type="file" name="favicon" class="form-control" placeholder="favicon">
                </div>
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-medium mb-2">Enter Phone Number</label>
                <input type="tel" id="phone" name="phone" value="{{ $setting->phone }}"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
            </div>

            <div class="mb-4">
                <label for="phone2" class="block text-gray-700 font-medium mb-2">Enter Second Phone</label>
                <input type="tel" id="phone2" name="phone2" value="{{ $setting->phone2 }}"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Enter Email Address</label>
                <input type="email" id="email" name="email" value="{{ $setting->email }}"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-medium mb-2">Enter Address</label>
                <input type="address" id="address" name="address" value="{{ $setting->address }}"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
            </div>

            <div class="mb-4">
                <label for="short_des" class="block text-gray-700 font-medium mb-2">Enter Short Des</label>
                <input type="text" id="short_des" name="short_des" value="{{ $setting->short_des }}"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Enter Description</label>
                <textarea id="description" name="description"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" rows="5">{{ $setting->description }}</textarea>
            </div>

            <div class="mb-4">
                <label for="facebook" class="block text-gray-700 font-medium mb-2">Enter Facebook</label>
                <input type="url" id="facebook" name="facebook" value="{{ $setting->facebook }}"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400">
            </div>

            <div class="mb-4">
                <label for="instagram" class="block text-gray-700 font-medium mb-2">Enter Instagram</label>
                <input type="url" id="instagram" name="instagram" value="{{ $setting->instagram }}"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400">
            </div>

            <div class="mb-4">
                <label for="telegram" class="block text-gray-700 font-medium mb-2">Enter Telegram</label>
                <input type="url" id="telegram" name="telegram" value="{{ $setting->telegram }}"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400">
            </div>

            <div class="mb-4">
                <label for="tiktok" class="block text-gray-700 font-medium mb-2">Enter Tiktok</label>
                <input type="url" id="tiktok" name="tiktok" value="{{ $setting->tiktok }}"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400">
            </div>

            <div class="mb-4">
                <label for="map" class="block text-gray-700 font-medium mb-2">Enter Map Url</label>
                <input type="url" id="map" name="map" value="{{ $setting->map }}"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400">
            </div>

            <div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Submit</button>
            </div>

        </form>
    </div>
</x-admin>
