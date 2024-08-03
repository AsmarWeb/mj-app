<div class="flex flex-wrap -mx-4 mt-12">
    @if ($features->count() > 0)
        @foreach ($features as $feature)
            <div class="w-full md:w-1/3 px-4 mb-8">

                <div class="rounded-md bg-white shadow-md p-8">
                    <div class="text-4xl font-bold text-purple-600 mb-4">0{{ $feature->id }}</div>
                    <h3 class="text-2xl font-bold mb-4">{{ $feature->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ $feature->short_des }}</p>
                </div>

            </div>
        @endforeach
    @else
        <tr>
            <td colspan="5" style="text-align: center;"> No Result
                found!
            </td>
        </tr>
    @endif
</div>
