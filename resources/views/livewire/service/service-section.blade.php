<div>
    <div class="flex flex-col w-full mb-10 sm:flex-row">
        @if ($services->count() > 0)
            @foreach ($services as $service)
                <div class="w-full mb-10 sm:mb-0 sm:w-1/2">
                    <div class="relative h-full ml-0 mr-0 sm:mr-10">
                        <span class="absolute top-0 left-0 w-full h-full mt-1 ml-1 rounded-lg"
                            style="background-color:{{ $service->bg_color }}"></span>
                        <div class="relative h-full p-5 bg-white border-2 border-indigo-500 rounded-lg">
                            <div class="flex items-center -mt-1">
                                <h3 class="my-2 ml-3 text-lg font-bold text-gray-800">{{ $service->title }}</h3>
                            </div>
                            <p class="mt-3 mb-1 text-xs font-medium text-indigo-500 uppercase">------------</p>
                            <p class="mb-2 text-gray-600">
                                {{ $service->description }}
                            </p>
                        </div>
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
</div>
