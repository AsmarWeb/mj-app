<x-admin>

    <div class="min-h-screen bg-gray-50">

        <header class="bg-white border-b">
            <div class="max-w-6xl mx-auto px-6 py-6">
                <h1 class="text-3xl font-bold text-gray-900">
                    Edit Shop
                </h1>

                <p class="mt-2 text-gray-600">
                    Update shop information, contact details, images, and visibility settings.
                </p>
            </div>
        </header>


        <main class="max-w-5xl mx-auto px-6 py-10">


            @if (session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif



            <form action="{{ route('shops.update', $shop) }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-2xl shadow-sm border p-8">


                @csrf
                @method('PUT')



                <div class="space-y-10">


                    {{-- Basic Information --}}
                    <section>

                        <h2 class="text-xl font-semibold text-gray-900 mb-6">
                            Basic Information
                        </h2>


                        <div class="grid md:grid-cols-2 gap-6">


                            <div>

                                <label class="block text-sm font-medium text-gray-700">
                                    Shop Name
                                </label>

                                <input type="text" name="name" value="{{ old('name', $shop->name) }}"
                                    class="mt-2 w-full rounded-xl border-gray-300">

                                @error('name')
                                    <p class="text-sm text-red-500 mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>



                            <div>

                                <label class="block text-sm font-medium text-gray-700">
                                    Location
                                </label>

                                <input type="text" name="location" value="{{ old('location', $shop->location) }}"
                                    class="mt-2 w-full rounded-xl border-gray-300">

                            </div>


                        </div>



                        <div class="mt-6">

                            <label class="block text-sm font-medium text-gray-700">
                                Description
                            </label>


                            <textarea name="description" rows="5" class="mt-2 w-full rounded-xl border-gray-300">{{ old('description', $shop->description) }}</textarea>

                        </div>


                        <div class="mt-6">

                            <label class="block text-sm font-medium text-gray-700">
                                Arabic Description
                            </label>


                            <textarea name="description_ar" rows="5" dir="rtl" class="mt-2 w-full rounded-xl border-gray-300">{{ old('description_ar', $shop->description_ar) }}</textarea>

                        </div>


                    </section>




                    {{-- Contact --}}
                    <section>

                        <h2 class="text-xl font-semibold text-gray-900 mb-6">
                            Contact Information
                        </h2>


                        <div class="grid md:grid-cols-2 gap-6">


                            <div>

                                <label class="block text-sm font-medium">
                                    Phone
                                </label>


                                <input type="text" name="phone" value="{{ old('phone', $shop->phone) }}"
                                    class="mt-2 w-full rounded-xl border-gray-300">

                            </div>



                            <div>

                                <label class="block text-sm font-medium">
                                    WhatsApp
                                </label>


                                <input type="text" name="whatsapp" value="{{ old('whatsapp', $shop->whatsapp) }}"
                                    placeholder="971501234567" class="mt-2 w-full rounded-xl border-gray-300">

                            </div>


                        </div>



                        <div class="mt-6 bg-gray-50 rounded-xl p-5 space-y-4">


                            <h3 class="font-semibold">
                                Customer Contact Options
                            </h3>



                            <label class="flex justify-between items-center">

                                <span>
                                    Show Phone Number
                                </span>


                                <input type="checkbox" name="allow_phone" value="1"
                                    {{ $shop->allow_phone ? 'checked' : '' }} class="rounded text-indigo-600">

                            </label>




                            <label class="flex justify-between items-center">

                                <span>
                                    Show WhatsApp
                                </span>


                                <input type="checkbox" name="allow_whatsapp" value="1"
                                    {{ $shop->allow_whatsapp ? 'checked' : '' }} class="rounded text-indigo-600">

                            </label>


                        </div>


                    </section>





                    {{-- Images --}}
                    <section>


                        <h2 class="text-xl font-semibold text-gray-900 mb-6">
                            Shop Images
                        </h2>



                        <div class="grid md:grid-cols-2 gap-8">


                            <div>

                                <label class="block font-medium">
                                    Logo
                                </label>


                                @if ($shop->logo)
                                    <img src="{{ asset('storage/' . $shop->logo) }}"
                                        class="mt-3 w-32 h-32 rounded-xl object-cover border">
                                @endif


                                <input type="file" name="logo" class="mt-4">

                            </div>





                            <div>

                                <label class="block font-medium">
                                    Banner
                                </label>


                                @if ($shop->banner)
                                    <img src="{{ asset('storage/' . $shop->banner) }}"
                                        class="mt-3 w-full h-32 rounded-xl object-cover border">
                                @endif


                                <input type="file" name="banner" class="mt-4">

                            </div>


                        </div>


                    </section>





                    {{-- Status --}}
                    <section>


                        <h2 class="text-xl font-semibold mb-6">
                            Shop Status
                        </h2>


                        <label class="flex items-center gap-3">


                            <input type="checkbox" name="verified" value="1"
                                {{ $shop->verified ? 'checked' : '' }} class="rounded text-green-600">


                            <span>
                                Verified Shop
                            </span>


                        </label>


                    </section>



                </div>





                <div class="mt-10 flex justify-end gap-4">


                    <a href="{{ route('shops.index') }}" class="px-6 py-3 rounded-xl border">
                        Cancel
                    </a>



                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
                        Update Shop
                    </button>


                </div>



            </form>


        </main>


    </div>


</x-admin>
