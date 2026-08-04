{{-- DESCRIPTION --}}
<div>
    <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
        Shop Description
    </label>

    <textarea rows="5" name="description" id="description" placeholder="Tell customers about your store..."
        class="
        w-full
        rounded-2xl
        border-gray-300
        dark:border-neutral-700
        dark:bg-neutral-900
        dark:text-white
        px-4
        py-3
        focus:ring-2
        focus:ring-orange-500
        outline-none
        ">{{ old('description', $shop?->description) }}</textarea>


    @error('description')
        <p class="text-red-500 mt-2 text-sm">
            {{ $message }}
        </p>
    @enderror

</div>



{{-- SHOP SECTION --}}
<div class="mt-8">

    <label class="block mb-4 text-sm font-semibold text-gray-700 dark:text-gray-300">
        Choose Your Shop Type
    </label>


    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

        @foreach ($sections as $section)
            <label class="cursor-pointer">


                <input type="radio" name="section_id" value="{{ $section->id }}" class="hidden peer"
                    @checked(old('section_id', $shop?->section_id) == $section->id)>


                <div
                    class="
                    p-5
                    rounded-3xl
                    border
                    bg-white
                    dark:bg-neutral-900
                    dark:border-neutral-700

                    transition-all

                    hover:border-orange-500
                    hover:-translate-y-1
                    hover:shadow-lg

                    peer-checked:bg-orange-500
                    peer-checked:text-white
                    peer-checked:border-orange-500
                    ">

                    <div class="text-4xl mb-3">

                        @switch($section->slug)
                            @case('sales')
                                🛍️
                            @break

                            @case('real-estate')
                                🏠
                            @break

                            @case('rental')
                                🚗
                            @break

                            @case('auction')
                                🔨
                            @break

                            @case('events')
                                🎟️
                            @break

                            @case('digital')
                                💻
                            @break

                            @default
                                📦
                        @endswitch

                    </div>


                    <div class="font-bold">
                        {{ $section->name }}
                    </div>


                </div>


            </label>
        @endforeach


    </div>


    @error('section_id')
        <p class="text-red-500 mt-2 text-sm">
            {{ $message }}
        </p>
    @enderror


</div>




{{-- LOCATION --}}
<div class="mt-8">

    <h2 class="text-2xl font-bold mb-5">
        📍 Shop Location
    </h2>


    <div class="relative">

        <input type="text" name="location" id="location" value="{{ old('location', $shop?->location) }}"
            placeholder="Detecting your location..." class="
w-full
rounded-2xl
border-gray-300
px-5
py-4
pr-40
" />



        <button type="button" onclick="detectLocation()"
            class="
absolute
right-2
top-1/2
-translate-y-1/2

bg-orange-500
text-white

px-4
py-2
rounded-xl
font-semibold
">

            📍 Detect

        </button>


    </div>



    <p id="location-status" class="text-sm text-gray-500 mt-2">

        Your location helps customers find your shop.

    </p>



    <input type="hidden" name="country_id">


    <input type="hidden" name="state_id">


    <input type="hidden" name="city_id">


    <input type="hidden" name="latitude" id="latitude">


    <input type="hidden" name="longitude" id="longitude">


</div>






{{-- COUNTRY --}}
<div class="mt-10">


    <label class="block mb-4 font-semibold">
        Country
    </label>


    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">


        @foreach ($countries as $country)
            <label class="cursor-pointer">


                <input type="radio" name="country_id" value="{{ $country->id }}" class="hidden peer"
                    @checked(old('country_id', $shop?->country_id) == $country->id)>


                <div
                    class="
p-5
rounded-2xl
border

dark:border-neutral-700
dark:bg-neutral-900

transition

peer-checked:bg-orange-500
peer-checked:text-white
peer-checked:border-orange-500

hover:border-orange-500
">

                    🌍

                    <p class="mt-2 font-semibold">
                        {{ $country->name }}
                    </p>

                </div>


            </label>
        @endforeach


    </div>


</div>





{{-- STATE --}}
@if (old('country_id', $shop?->country_id))

    <div class="mt-10">

        <label class="block mb-4 font-semibold">
            State
        </label>


        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">


            @foreach ($states->where('country_id', old('country_id', $shop?->country_id)) as $state)
                <label class="cursor-pointer">


                    <input type="radio" name="state_id" value="{{ $state->id }}" class="hidden peer"
                        @checked(old('state_id', $shop?->state_id) == $state->id)>


                    <div
                        class="
p-5
rounded-2xl
border

dark:bg-neutral-900
dark:border-neutral-700

peer-checked:bg-orange-500
peer-checked:text-white
peer-checked:border-orange-500

hover:border-orange-500
">

                        🏛️

                        <p class="mt-2 font-semibold">
                            {{ $state->name }}
                        </p>


                    </div>


                </label>
            @endforeach


        </div>


    </div>

@endif







{{-- CITY --}}
@if (old('state_id', $shop?->state_id))


    <div class="mt-10">


        <label class="block mb-4 font-semibold">
            City
        </label>



        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">


            @foreach ($cities->where('state_id', old('state_id', $shop?->state_id)) as $city)
                <label class="cursor-pointer">


                    <input type="radio" name="city_id" value="{{ $city->id }}" class="hidden peer"
                        @checked(old('city_id', $shop?->city_id) == $city->id)>


                    <div
                        class="
p-5
rounded-2xl
border

dark:bg-neutral-900
dark:border-neutral-700

peer-checked:bg-orange-500
peer-checked:text-white
peer-checked:border-orange-500

hover:border-orange-500
">

                        🏙️

                        <p class="mt-2 font-semibold">
                            {{ $city->name }}
                        </p>

                    </div>


                </label>
            @endforeach


        </div>


    </div>


@endif
