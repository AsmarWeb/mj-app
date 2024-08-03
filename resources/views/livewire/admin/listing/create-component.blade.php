<div class="bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-2xl">
    @if (session()->has('success'))
        <div class="text-green-700 bg-teal-100 border-t-4 border-teal-500 rounded-b px-4 py-3 shadow-md" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <form enctype="multipart/form-data" wire:submit="save">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">
                    This information will be displayed publicly so be careful what you share.
                </p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" id="title" wire:model="title" autocomplete="title"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="Type your product title here" autofocus>
                            </div>
                        </div>
                        <div>
                            @error('title')
                                <span class="text-sm text-red-500 italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-full text-end">
                        <label for="title_ar" class="block text-sm font-medium leading-6 text-gray-900 text-right">عنوان
                            المنتج
                            باللغة
                            العربية
                        </label>
                        <div class="mt-2">
                            <input type="text" wire:model="title_ar" id="title_ar"
                                placeholder="أكتب عنوان المنتج الخاص بك هنا" autocomplete="title_ar"
                                class="text-right block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div>
                            @error('title_ar')
                                <span class="text-sm text-red-500 italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">
                            Product price
                        </label>
                        <input type="number" id="price" wire:model="price" placeholder="Enter your pricing amount"
                            min="0"
                            class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>

                    <div class="col-span-full">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">
                            Product quantity
                        </label>
                        <input type="number" id="quantity" wire:model="quantity" placeholder="1" min="0"
                            class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>

                    <div class="col-span-full">
                        <div class="form-group">
                            <ul class="form-check-list">
                                <li>
                                    <label class="block text-sm font-medium leading-6 text-gray-900">price
                                        condition</label>
                                </li>
                                <li>
                                    <input type="checkbox" wire:model.lazy="price_condition" value="fixed"
                                        class="form-check" id="fix-check">
                                    <label for="fix-check" class="form-check-text">fixed</label>
                                </li>
                                <li>
                                    <input type="checkbox" wire:model.lazy="price_condition" value="negotiable"
                                        class="form-check" id="nego-check">
                                    <label for="nego-check" class="form-check-text">negotiable</label>
                                </li>
                                <li>
                                    <input type="checkbox" wire:model.lazy="price_condition" value="daily"
                                        class="form-check" id="day-check">
                                    <label for="day-check" class="form-check-text">daily</label>
                                </li>
                                <li>
                                    <input type="checkbox" wire:model.lazy="price_condition" value="weekly"
                                        class="form-check" id="week-check">
                                    <label for="week-check" class="form-check-text">weekly</label>
                                </li>
                                <li>
                                    <input type="checkbox" wire:model.lazy="price_condition" value="monthly"
                                        class="form-check" id="month-check">
                                    <label for="month-check" class="form-check-text">monthly</label>
                                </li>
                                <li>
                                    <input type="checkbox" wire:model.lazy="price_condition" value="yearly"
                                        class="form-check" id="year-check">
                                    <label for="year-check" class="form-check-text">yearly</label>
                                </li>
                            </ul>
                            @error('price_condition')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-full">
                        <div class="form-group">
                            <ul class="form-check-list">
                                <li>
                                    <label class="block text-sm font-medium leading-6 text-gray-900">product
                                        condition</label>
                                </li>
                                <li>
                                    <input type="checkbox" wire:model.lazy="condition" value="used"
                                        class="form-check" id="use-check">
                                    <label for="use-check" class="form-check-text">used</label>
                                </li>
                                <li>
                                    <input type="checkbox" wire:model.lazy="condition" value="new"
                                        class="form-check" id="new-check">
                                    <label for="new-check" class="form-check-text">new</label>
                                </li>
                            </ul>
                            @error('condition')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="description"
                            class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="3" wire:model="description"
                                placeholder="Describe your message"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </textarea>
                        </div>
                        <div>
                            @error('description')
                                <span class="text-sm text-red-500 italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div x-data @tags-update="console.log('tags updated', $event.detail.tags)"
                        data-tags='["apple","phone"]' class="col-span-full">
                        <div x-data="tagSelect()" x-init="init('parentEl')" @click.away="clearSearch()"
                            @keydown.escape="clearSearch()">
                            <div class="relative" @keydown.enter.prevent="addTag(textInput)">
                                <input x-model="textInput" x-ref="textInput" @input="search($event.target.value)"
                                    wire:model="keywords" id="keywords"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Enter some tags">
                                <div :class="[open ? 'block' : 'hidden']">
                                    <div class="absolute z-40 left-0 mt-2 w-full">
                                        <div class="py-1 text-sm bg-white rounded shadow-lg border border-gray-300">
                                            <a @click.prevent="addTag(textInput)"
                                                class="block py-1 px-5 cursor-pointer hover:bg-indigo-600 hover:text-white">Add
                                                tag "<span class="font-semibold" x-text="textInput"></span>"</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- selections -->
                                <template x-for="(tag, index) in tags">
                                    <div class="bg-indigo-100 inline-flex items-center text-sm rounded mt-2 mr-1">
                                        <span class="ml-2 mr-1 leading-relaxed truncate max-w-xs"
                                            x-text="tag"></span>
                                        <button @click.prevent="removeTag(index)"
                                            class="w-6 h-8 inline-block align-middle text-gray-500 hover:text-gray-600 focus:outline-none">
                                            <svg class="w-6 h-6 fill-current mx-auto"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-md border border-indigo-500 bg-gray-50 p-4 shadow-md w-36">
                        <label for="image" class="flex flex-col items-center gap-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 fill-white stroke-indigo-500"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-gray-600 font-medium">Upload cover</span>
                        </label>
                        <input id="image" type="file" wire:model="image" class="hidden" />
                        <div wire:loading wire:target="image" class="text-sm text-gray-500 italic">Uploading...</div>
                    </div>

                    <div class="col-span-full">
                        <div class="form-group">
                            <label class="block text-sm font-medium leading-6 text-gray-900">
                                product cover image
                            </label>
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" height="70px" width="70px" />
                            @endif
                            <div>
                                @error('image')
                                    <span class="text-sm text-red-500 italic">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Cover
                            photo</label>
                        <div
                            class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                @if ($images)
                                    @foreach ($images as $image)
                                        <img src="{{ $image->temporaryUrl() }}" height="70px" width="70px" />
                                    @endforeach
                                @else
                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @endif
                                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                    <label for="file-upload"
                                        class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" wire:model="images" name="file-upload"
                                            type="file" class="sr-only" multiple>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                            </div>
                            <div>
                                @error('images')
                                    <span class="text-sm text-red-500 italic">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Categories Information</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="sm:col-span-3">
                    <label for="section" class="block text-sm font-medium leading-6 text-gray-900">Product
                        Section</label>
                    <div class="mt-2">
                        <select wire:model.live="section_id" wire:change="changeCategory" id="section"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="" selected>Select One...</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Product
                        Category</label>
                    <div class="mt-2">
                        <select wire:model.live="category_id" wire:change="changeSubCategory" id="category"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="" selected>Select One...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="subcategory" class="block text-sm font-medium leading-6 text-gray-900">Product
                        SubCategory</label>
                    <div class="mt-2">
                        <select wire:model="subcategory_id" wire:change="changeBrand" id="subcategory"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="" selected>Select One...</option>
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">
                                    {{ $subcategory->subcategory_name }}</option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="brand" class="block text-sm font-medium leading-6 text-gray-900">Product
                        Brand</label>
                    <div class="mt-2">
                        <select wire:model="brand_id" id="brand"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="" selected>Select One...</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" wire:click.prevent="cancelListing()"
                class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
</div>
