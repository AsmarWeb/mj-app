<div class="bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-2xl">
    <h2 class="text-2xl font-medium mb-4">Create New Listing</h2>
    <p class="mt-1 text-sm leading-6 text-gray-600">
        This information will be displayed publicly so be careful what you share.
    </p>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
    @endif
    <form enctype="multipart/form-data" wire:submit.prevent="createlisting">
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
            <input type="text" autocomplete="title" wire:model="title" wire:keyup="generateSlug"
                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                placeholder="Type your product title here" required autofocus>
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            @error('slug')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <div class="form-group text-right">
                <label for="title_ar" class="block text-gray-700 font-medium mb-2">عنوان المنتج باللغة العربية</label>
                <input type="text"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400 form-control text-right"
                    placeholder="عنوان المنتج الخاص بك هنا" wire:model="title_ar" required>
            </div>
            @error('title_ar')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
            <input type="number" wire:model="price" placeholder="Enter your pricing amount"
                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
        </div>
        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 font-medium mb-2">Quantity</label>
            <input type="text" wire:model="quantity"
                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                placeholder="Enter your product quantity">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea wire:model="description"
                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" rows="5"></textarea>
        </div>
        <div class="mb-4">
            <label for="keywords" class="block text-gray-700 font-medium mb-2">
                Keywords
            </label>
            <div class="mt-2">
                <textarea rows="4" cols="50" maxlength="150" wire:model="keywords"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"></textarea>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Price Condition</label>
            <div class="flex flex-wrap -mx-2">
                <div class="px-2 w-1/3">
                    <ul class="form-check-list">
                        <li>
                            <input type="checkbox" wire:model.lazy="price_condition" value="fixed" class="form-check"
                                id="fix-check">
                            <label for="fix-check" class="form-check-text">fixed</label>
                        </li>
                        <li>
                            <input type="checkbox" wire:model.lazy="price_condition" value="negotiable"
                                class="form-check" id="nego-check">
                            <label for="nego-check" class="form-check-text">negotiable</label>
                        </li>
                        <li>
                            <input type="checkbox" wire:model.lazy="price_condition" value="daily" class="form-check"
                                id="day-check">
                            <label for="day-check" class="form-check-text">daily</label>
                        </li>
                        <li>
                            <input type="checkbox" wire:model.lazy="price_condition" value="weekly" class="form-check"
                                id="week-check">
                            <label for="week-check" class="form-check-text">weekly</label>
                        </li>
                        <li>
                            <input type="checkbox" wire:model.lazy="price_condition" value="monthly" class="form-check"
                                id="month-check">
                            <label for="month-check" class="form-check-text">monthly</label>
                        </li>
                        <li>
                            <input type="checkbox" wire:model.lazy="price_condition" value="yearly" class="form-check"
                                id="year-check">
                            <label for="year-check" class="form-check-text">yearly</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Product Condition</label>
            <div class="flex flex-wrap -mx-2">
                <div class="px-2 w-1/3">
                    <ul class="form-check-list">
                        <li>
                            <input type="checkbox" wire:model.lazy="condition" value="used" class="form-check"
                                id="use-check">
                            <label for="use-check" class="form-check-text">used</label>
                        </li>
                        <li>
                            <input type="checkbox" wire:model.lazy="condition" value="new" class="form-check"
                                id="new-check">
                            <label for="new-check" class="form-check-text">new</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-span-full">
            <label
                class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" height="70px" width="70px" />
                @else
                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                    </svg>
                    <span class="mt-2 text-base leading-normal">Select A New Image</span>
                @endif
                <input type='file' wire:model="image" class="hidden" />
            </label>
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-span-full">
            <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Product
                Gallery</label>
            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                <div class="text-center">
                    @if ($images)
                        @foreach ($images as $image)
                            <img src="{{ $image->temporaryUrl() }}" height="70px" width="70px" />
                        @endforeach
                    @else
                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                clip-rule="evenodd" />
                        </svg>
                    @endif
                    <div class="mt-4 flex text-sm leading-6 text-gray-600">
                        <label for="file-upload"
                            class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                            <span>Upload a file</span>
                            <input id="file-upload" name="file-upload" type="file" class="sr-only"
                                wire:model="images" multiple>
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                </div>
                @error('images')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Categories Information</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p>

            <div class="mb-4">
                <label for="selectedSection" class="block text-gray-700 font-medium mb-2">Sections</label>
                <select wire:model.live="selectedSection"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
                    <option value="">Select section</option>
                    @foreach ($this->sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
                @error('selectedSection')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="selectedCategory" class="block text-gray-700 font-medium mb-2">Categories</label>
                <select wire:model="selectedCategory"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
                    <option value="">Select categories</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->category_name }}</option>
                    @endforeach
                </select>
                @error('selectedCategory')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="selectedSubCategory" class="block text-gray-700 font-medium mb-2">Sub Categories</label>
                <select wire:model="selectedSubCategory"
                    class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400"
                    required>
                    <option value="">Select subcategories</option>
                    @foreach ($this->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">
                            {{ $subcategory->subcategory_name }}</option>
                    @endforeach
                </select>
                @error('selectedSubCategory')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div>
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Submit</button>
        </div>

    </form>
</div>
