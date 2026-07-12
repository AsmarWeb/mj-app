<x-main-layout>

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <section>

        <div class="mx-auto mt-10 mb-10 max-w-6xl text-center p-6">
            <form action="{{ route('shop.creators') }}" method="GET">
                <label
                    class="mx-auto mt-8 relative bg-white min-w-sm max-w-2xl flex flex-col md:flex-row items-center justify-center border py-2 px-2 rounded-2xl gap-2 shadow-2xl focus-within:border-gray-300"
                    for="search-bar">

                    <input id="search-bar" placeholder="Search creators..." name="q"
                        class="px-6 py-2 w-full rounded-md flex-1 outline-none bg-white" required="">
                    <button type="submit"
                        class="w-full md:w-auto px-6 py-3 bg-orange-600 border-orange-700 text-white fill-white active:scale-95 duration-100 border will-change-transform overflow-hidden relative rounded-xl transition-all">
                        <div class="flex items-center transition-all opacity-1">
                            <span class="text-sm font-semibold whitespace-nowrap truncate mx-auto">
                                {{ __('hero.form.button') }}
                            </span>
                        </div>
                    </button>
                </label>
            </form>
        </div>

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

                @forelse($shops as $shop)
                    <div class="rounded-2xl border p-6 text-center hover:shadow-xl transition">

                        @if ($shop->logo)
                            <img src="{{ Storage::disk('public')->url($shop->logo) }}"
                                class="w-24 h-24 rounded-full mx-auto">
                        @else
                            <div
                                class="flex h-full w-full items-center justify-center bg-gradient-to-br from-indigo-500 to-cyan-500 text-3xl font-semibold text-white">
                                {{ strtoupper(substr($shop->name, 0, 1)) }}
                            </div>
                        @endif

                        <h3 class="mt-4 font-bold">
                            {{ $shop->user->name }}
                        </h3>

                        <p class="text-gray-500">
                            {{ $shop->type ?: 'murwaj seller' }}
                        </p>

                        <div class="flex justify-center gap-8 mt-5">

                            <div>
                                <div class="font-bold">{{ $shop->listings_count }}</div>
                                <div class="text-sm text-gray-400">Products</div>
                            </div>

                            <div>
                                <div class="font-bold">{{ $shop->rating }}★</div>
                                <div class="text-sm text-gray-400">Rating</div>
                            </div>

                        </div>

                    </div>
                @empty

                    <div class="col-12">
                        <div class="alert alert-info">
                            No creators found.
                        </div>
                    </div>
                @endforelse

            </div>

            <div class="mt-5">
                {{ $shops->withQueryString()->links() }}
            </div>

        </div>



    </section>

    <x-main-footer></x-main-footer>
</x-main-layout>
