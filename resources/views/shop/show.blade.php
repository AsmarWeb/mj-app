<x-main-layout>
    @section('title', $title)
    @section('description', $description)
    @section('keywords', $keywords)

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <div class="min-h-screen">
        <div class="relative overflow-hidden">
            <div class="absolute inset-0 "></div>
            <div class="relative mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-16 lg:px-8">
                <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/90 shadow-2xl backdrop-blur">
                    <div class="h-56 bg-cover bg-center sm:h-72"
                        style="background-image: url('{{ $bannerImage ?? 'https://images.unsplash.com/photo-1516321497487-e288fb19713f?auto=format&fit=crop&w=1600&q=80' }}')">
                    </div>

                    <div class="px-6 pb-8 sm:px-8 lg:px-10">
                        <div class="-mt-16 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-end">
                                <div
                                    class="flex h-28 w-28 items-center justify-center overflow-hidden rounded-3xl border-4 border-white bg-white shadow-lg sm:h-32 sm:w-32">
                                    @if ($logoImage)
                                        <img src="{{ $logoImage }}" alt="{{ $shop->name }} logo"
                                            class="h-full w-full object-cover">
                                    @else
                                        <div
                                            class="flex h-full w-full items-center justify-center bg-gradient-to-br from-indigo-500 to-cyan-500 text-3xl font-semibold text-white">
                                            {{ strtoupper(substr($shop->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <span
                                        class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-700">
                                        {{ $shop->type ?: 'Online shop' }}
                                    </span>
                                    <h1 class="mt-3 text-3xl font-semibold text-slate-900 sm:text-4xl">
                                        {{ $shop->name }}
                                    </h1>
                                    <p class="mt-2 text-base text-slate-600">
                                        {{ optional($shop->section)->name ?: 'Fresh storefront' }} •
                                        {{ optional($shop->city)->name ?: 'Location pending' }}
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('explore') }}"
                                class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-indigo-300 hover:text-indigo-700">
                                Explore marketplace
                            </a>
                        </div>

                        <div class="mt-8 grid gap-6 lg:grid-cols-[1.7fr_0.9fr]">
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 sm:p-7">
                                <h2 class="text-xl font-semibold text-slate-900">About this shop</h2>
                                <p class="mt-4 text-base leading-8 text-slate-600">
                                    {{ $shop->description ?: 'This storefront is ready for its first big moment. Add your story, highlights, and listings to make it shine.' }}
                                </p>
                            </div>

                            <div class="space-y-4">
                                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                                    <h3 class="text-lg font-semibold text-slate-900">Location</h3>
                                    <p class="mt-2 text-sm leading-7 text-slate-600">
                                        {{ optional($shop->city)->name ?: 'Location not added yet' }}
                                        @if (optional($shop->state)->name)
                                            , {{ optional($shop->state)->name }}
                                        @endif
                                    </p>
                                </div>

                                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                                    <h3 class="text-lg font-semibold text-slate-900">Shop status</h3>
                                    <p class="mt-2 text-sm leading-7 text-slate-600">
                                        Your storefront is live and ready to welcome visitors.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-main-footer></x-main-footer>
</x-main-layout>
