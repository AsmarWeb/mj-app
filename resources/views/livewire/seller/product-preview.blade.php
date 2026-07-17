<div class="bg-white rounded-xl shadow p-5">


    <h3 class="text-lg font-bold mb-4">
        Product Preview
    </h3>


    @if ($image)
        <img src="{{ $image }}" class="w-full h-52 object-cover rounded-xl">
    @endif


    <h2 class="text-xl font-bold mt-4">

        {{ $title ?? 'Product title' }}

    </h2>


    <p class="text-gray-500 mt-2">

        {{ $description ?? 'Product description' }}

    </p>


    <p class="text-indigo-600 text-xl font-bold mt-4">

        ${{ $price ?? '0' }}

    </p>


</div>
