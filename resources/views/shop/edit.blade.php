<x-app-layout>

    <div class="min-h-screen bg-gray-50">

        <header class="bg-white border-b">
            <div class="max-w-5xl mx-auto px-6 py-5">
                <h1 class="text-2xl font-bold text-gray-900">
                    Edit Your Shop
                </h1>
            </div>
        </header>


        <main class="max-w-3xl mx-auto px-6 py-10">

            @if (session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif


            <form action="{{ route('shop.update') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-xl shadow p-8">

                @csrf
                @method('PUT')


                <div class="space-y-6">


                    <!-- Shop Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Shop Name
                        </label>

                        <input type="text" name="name" value="{{ old('name', $shop->name) }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>



                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>

                        <textarea name="description" rows="5" class="w-full rounded-lg border-gray-300 focus:ring-indigo-500">{{ old('description', $shop->description) }}</textarea>

                        @error('description')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>



                    <!-- Logo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Shop Logo
                        </label>


                        @if ($shop->logo)
                            <img src="{{ asset('storage/' . $shop->logo) }}"
                                class="w-24 h-24 rounded-xl object-cover mb-4">
                        @endif


                        <input type="file" name="logo" class="block w-full text-sm">

                        @error('logo')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                </div>



                <div class="mt-8 flex justify-end">

                    <button type="submit"
                        class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Save Changes
                    </button>

                </div>


            </form>

        </main>

    </div>

</x-app-layout>
