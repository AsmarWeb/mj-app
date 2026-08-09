<x-main-layout>
    @section('title', "$getPage->meta_title")
    @section('meta_description', "$getPage->meta_description")
    @section('meta_keywords', "$getPage->meta_keywords")

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>
    <div class="pt-4">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            @php
                $page = App\Models\Page::where('id', 1)->first();
            @endphp
            <div class="w-full sm:max-w-2xl mt-6 p-6 shadow-md overflow-hidden sm:rounded-lg prose">
                <div class="container px-6 py-12 mx-auto">
                    <div class="text-center">
                        @if (app()->getLocale() == 'ar')
                            <h1 class="mt-2 text-2xl font-semibold text-gray-800 md:text-3xl dark:text-white">
                                {{ $page->title_ar }}
                            </h1>
                        @else
                            <h1 class="mt-2 text-2xl font-semibold text-gray-800 md:text-3xl dark:text-white">
                                {{ $page->title }}
                            </h1>
                        @endif
                    </div>

                    <div class="mt-10">
                        @if (app()->getLocale() == 'ar')
                            <p class="mt-3 text-gray-500 dark:text-gray-400 text-right">
                                {{ $page->short_des_ar }}
                            </p>
                        @else
                            <p class="mt-3 text-gray-500 dark:text-gray-400">
                                {{ $page->short_des }}
                            </p>
                        @endif

                        @if (app()->getLocale() == 'ar')
                            <h1 class="text-right font-semibold text-gray-800 capitalize dark:text-white lg:text-3xl">
                                {{ $page->subtitle_ar }}
                            </h1>
                        @else
                            <h1 class="text-2xl font-semibold text-gray-800 capitalize dark:text-white lg:text-3xl">
                                {{ $page->subtitle }}
                            </h1>
                        @endif

                        @if (app()->getLocale() == 'ar')
                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-right">
                                {!! $page->content_ar !!}
                            </p>
                        @else
                            <p class="mt-4 text-gray-500 dark:text-gray-400">
                                {!! $page->content !!}
                            </p>
                        @endif

                        <div class="mt-12 md:mt-0">
                            @if ($page->image != null)
                                <img src="{{ asset("$page->image") }}" alt="About Us Image"
                                    class="object-cover rounded-lg shadow-md">
                            @endif
                        </div>

                        <div class="text-center">
                            <h4>
                                @if (app()->getLocale() == 'ar')
                                    <p class="mt-2 text-gray-500 dark:text-gray-400">
                                        {{ $page->created_by_ar }}
                                        <br>
                                        <a class="underline decoration-orange-500 dark:text-white" target="_blank"
                                            href="{{ route('developers.index') }}">{{ $page->developer }}</a>
                                        {{ __('about.by') }}
                                    </p>
                                @else
                                    <p class="mt-2 text-gray-500 dark:text-gray-400">
                                        {{ $page->created_by }}
                                        <br> {{ __('about.by') }}
                                        <a class="underline decoration-orange-500 dark:text-white" target="_blank"
                                            href="{{ route('developers.index') }}">{{ $page->developer }}</a>
                                    </p>
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-main-footer></x-main-footer>
</x-main-layout>
