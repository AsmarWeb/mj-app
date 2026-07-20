<x-main-layout>
    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <div class="bg-slate-50 min-h-screen">

        {{-- Hero --}}
        <section class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500">
            <div class="max-w-7xl mx-auto px-6 py-16 text-white">

                <h1 class="text-5xl font-bold">
                    Browse Categories
                </h1>

                <p class="mt-4 text-xl text-white/90 max-w-3xl">
                    Discover thousands of products across all marketplace categories.
                </p>

            </div>
        </section>

        {{-- Breadcrumb --}}
        <div class="max-w-7xl mx-auto px-6 py-5">

            <nav class="text-sm text-slate-500">

                <a href="{{ url('/') }}" class="hover:text-indigo-600">
                    Home
                </a>

                /

                <span class="font-semibold text-slate-800">
                    Categories
                </span>

            </nav>

        </div>

        {{-- Categories --}}
        <section class="max-w-7xl mx-auto px-6 pb-16">

            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">

                @foreach ($categories as $category)
                    <a href="{{ route('discover.category', $category->slug) }}"
                        class="group bg-white rounded-3xl shadow-sm hover:shadow-xl transition overflow-hidden border hover:border-indigo-500">

                        <div class="h-40 bg-slate-100 flex items-center justify-center">

                            @if ($category->image)
                                <img src="{{ asset('storage/category-suggest/' . $category->image) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <svg class="w-20 h-20 text-slate-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 6h16v12H4z" />

                                </svg>
                            @endif

                        </div>

                        <div class="p-5">

                            <h2 class="font-bold text-lg group-hover:text-indigo-600">

                                {{ $category->name }}

                            </h2>

                            <p class="text-slate-500 mt-2">

                                {{ number_format($category->listings_count) }}
                                Products

                            </p>

                        </div>

                    </a>
                @endforeach

            </div>

        </section>

    </div>

    <x-main-footer></x-main-footer>
</x-main-layout>
