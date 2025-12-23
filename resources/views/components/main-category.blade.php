<section>
    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">shop our <br> popular
            <span class="underline decoration-orange-500">Categories</span>
        </h1>

        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 sm:gap-2 gap-4 auto-cols-fr my-2 mt-8">
            @foreach ($categories as $category)
                @if (count($category['subcategories']) > 0)
                    @if (app()->getLocale() == 'ar')
                        <a href="#"
                            class="flex flex-col items-center justify-center p-4 bg-white border border-2 border-gray-200 hover:border-orange-600 rounded-2xl group transition-colors min-h-[120px] transition-all duration-300">
                            <div class="mb-2 w-32 aspect-square flex items-center justify-center">
                                @if ($category->image)
                                    <img class="max-w-full max-h-full object-contain"
                                        src="{{ asset('storage/category-suggest/' . $category->image) }}"
                                        alt="Heineken logo" />
                                @else
                                    <img class="max-w-full max-h-full object-contain"
                                        src="https://images.unsplash.com/photo-1622180203374-9524a54b734d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1950&amp;q=80"
                                        alt="Heineken logo" />
                                @endif
                            </div>
                            <h5
                                class="text-center text-lg sm:text-base font-medium text-gray-900 group-hover:text-orange-600">
                                {{ $category->category_name_ar }}
                            </h5>
                        </a>
                    @else
                        <a href="#"
                            class="flex flex-col items-center justify-center p-4 bg-white border border-2 border-gray-200 hover:border-orange-600 rounded-2xl group transition-colors min-h-[120px] transition-all duration-300">
                            <div class="mb-2 w-32 aspect-square flex items-center justify-center">
                                @if ($category->image)
                                    <img class="max-w-full max-h-full object-contain"
                                        src="{{ asset('storage/category-suggest/' . $category->image) }}"
                                        alt="Heineken logo" />
                                @else
                                    <img class="max-w-full max-h-full object-contain"
                                        src="https://images.unsplash.com/photo-1622180203374-9524a54b734d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1950&amp;q=80"
                                        alt="Heineken logo" />
                                @endif
                            </div>
                            <h5
                                class="text-center text-lg sm:text-base font-medium text-gray-900 group-hover:text-orange-600">
                                {{ $category->category_name }}
                            </h5>
                        </a>
                    @endif
                @endif
            @endforeach

        </div>

    </div>
</section>
