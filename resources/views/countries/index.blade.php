<x-main-layout>

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <section class="relative overflow-hidden">

        <div class="absolute inset-0 bg-gradient-to-br from-sky-600 via-cyan-500 to-emerald-500"></div>

        <div class="absolute inset-0 bg-[url('/images/grid.svg')] opacity-10"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-24">

            <div class="max-w-3xl">

                <span
                    class="inline-flex px-4 py-2 rounded-full bg-white/20 backdrop-blur text-black dark:text-white font-semibold">

                    🌍 GCC Marketplace

                </span>

                <h1 class="mt-6 text-6xl font-black text-black dark:text-white leading-tight">

                    Shop From Trusted
                    <br>

                    Businesses Across
                    <span class="text-yellow-300">
                        GCC Countries
                    </span>

                </h1>

                <p class="mt-6 text-xl text-black dark:text-white">

                    Browse thousands of verified shops, local brands, handmade products,
                    services, and businesses across the Gulf.

                </p>

            </div>

        </div>

    </section>

    <div class="grid lg:grid-cols-3 gap-8 mt-16">

        @foreach ($countries as $country)
            <a href="#">

                <div
                    class="group relative overflow-hidden rounded-3xl bg-white border border-slate-200 shadow-xl hover:shadow-2xl transition duration-300">

                    {{-- Header --}}

                    <div class="bg-gradient-to-r from-cyan-500 to-blue-600 p-8">

                        <div class="flex justify-between items-center">

                            <span class="text-7xl">

                                {{ $country->flag }}

                            </span>

                            <span class="bg-white/20 backdrop-blur px-3 py-1 rounded-full text-white">

                                {{ $country->code }}

                            </span>

                        </div>

                    </div>

                    {{-- Body --}}

                    <div class="p-8">

                        <h2 class="text-3xl font-bold">

                            {{ $country->name }}

                        </h2>

                        <p class="text-slate-500 mt-2">

                            {{ $country->name_ar }}

                        </p>

                        <div class="grid grid-cols-2 gap-4 mt-8">

                            <div class="rounded-2xl bg-slate-100 p-5">

                                <div class="text-3xl font-black text-blue-600">

                                    {{ $country->shops_count }}

                                </div>

                                <div class="text-sm text-slate-500">

                                    Shops

                                </div>

                            </div>

                            <div class="rounded-2xl bg-green-100 p-5">

                                <div class="text-3xl font-black text-green-600">

                                    {{ $country->verified_shops_count }}

                                </div>

                                <div class="text-sm text-slate-500">

                                    Verified

                                </div>

                            </div>

                        </div>

                        {{-- Shops Preview --}}

                        <div class="mt-8">

                            <h4 class="font-semibold mb-4">

                                Featured Shops

                            </h4>

                            @forelse($country->shops as $shop)
                                <div class="flex items-center justify-between py-3 border-b">

                                    <div>

                                        <div class="font-semibold">

                                            {{ $shop->name }}

                                        </div>

                                        <div class="text-sm text-slate-500">

                                            {{ $shop->city->name }}

                                        </div>

                                    </div>

                                    <svg class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition"
                                        fill="none" stroke="currentColor" stroke-width="2">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />

                                    </svg>

                                </div>

                            @empty

                                <p class="text-slate-400">

                                    No shops yet.

                                </p>
                            @endforelse

                        </div>

                    </div>

                </div>

            </a>
        @endforeach

    </div>

    <x-main-footer></x-main-footer>
</x-main-layout>
