<div class="text-center">

    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100">
        <svg class="h-10 w-10 text-green-600" ...></svg>
    </div>

    <h1 class="mt-6 text-4xl font-bold">
        🎉 Your shop is ready!
    </h1>

    <p class="mt-3 text-gray-500">
        Congratulations! Your shop has been created successfully.
    </p>

</div>

<div class="mt-10 rounded-2xl border bg-gray-50 p-6">

    <div class="flex items-center gap-4">

        <img src="{{ $shop->logo ? Storage::url($shop->logo) : asset('images/default-shop.png') }}"
            class="h-20 w-20 rounded-xl object-cover">

        <div>

            <h2 class="text-2xl font-semibold">
                {{ $shop->name }}
            </h2>

            <p class="text-gray-500">
                {{ ucfirst($shop->type) }}
            </p>

            <p class="text-sm text-gray-400">
                {{ $shop->location }}
            </p>

        </div>

    </div>

    @if ($shop->description)
        <p class="mt-6 text-gray-700">
            {{ $shop->description }}
        </p>
    @endif

</div>

<div class="mt-10 flex flex-col gap-4 sm:flex-row sm:justify-end">

    <a href="{{ route('shop', $shop) }}" class="rounded-lg border px-6 py-3 text-center hover:bg-gray-50">
        Preview Shop
    </a>

    <a href="#" class="rounded-lg bg-indigo-600 px-8 py-3 text-center font-medium text-white hover:bg-indigo-700">
        Add Your First Product
    </a>

</div>
