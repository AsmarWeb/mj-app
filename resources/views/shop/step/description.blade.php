{{-- ================================================================ --}}
{{-- DESCRIPTION --}}
{{-- ================================================================ --}}

<div class="flex items-center justify-between mb-2">

    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">
        Shop Description
    </label>

    <button type="button" id="generate-description"
        class="
    inline-flex
    items-center
    gap-2
    px-4
    py-2
    rounded-full
    bg-gradient-to-r
    from-orange-500
    to-red-500
    text-white
    text-sm
    font-semibold
    hover:opacity-90
    transition
    ">

        ✨ AI Generate

    </button>

</div>

<textarea rows="6" name="description" id="description" placeholder="Tell customers about your store..." autofocus
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

<p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
    ✨ AI can create a professional description based on your shop information.
</p>

@error('description')
    <p class="text-red-500 mt-2 text-sm">
        {{ $message }} </p>
@enderror

{{-- ================================================================ --}}
{{-- SHOP SECTION --}}
{{-- ================================================================ --}}

<label class="block mb-4 text-sm font-semibold text-gray-700 dark:text-gray-300">
    Choose Your Shop Type 🇦🇪
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
        {{ $message }} </p>
@enderror

{{-- ================================================================ --}}
{{-- SHOP LOCATION --}}
{{-- ================================================================ --}}

<h2 class="text-2xl font-bold mb-5 mt-8">
    📍 Shop Location 🇦🇪
</h2>

<div class="relative">

    <input type="text" name="location" id="location" value="{{ old('location', $shop?->location) }}"
        placeholder="Detecting your location..."
        class="
    w-full
    rounded-2xl
    border-gray-300
    px-5
    py-4
    pr-40
    dark:border-neutral-700
    dark:bg-neutral-900
    dark:text-white
    focus:ring-2
    focus:ring-orange-500
    outline-none
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
    hover:bg-orange-600
    transition
    ">

        📍 Detect

    </button>

</div>

<p id="location-status" class="text-sm text-gray-500 mt-2">
    Your location helps customers find your shop across the UAE.
</p>

<input type="hidden" name="latitude" id="latitude">

<input type="hidden" name="longitude" id="longitude">

{{-- ================================================================ --}}
{{-- COUNTRY --}}
{{-- ================================================================ --}}

<div class="mt-6">

    <label for="country_id" class="block text-sm font-bold mb-2">
        🌍 Country
    </label>

    <select id="country_id" name="country_id"
        class="
    w-full
    rounded-2xl
    border
    border-gray-300
    dark:border-neutral-700
    dark:bg-neutral-900
    dark:text-white
    px-5
    py-4
    focus:ring-2
    focus:ring-orange-500
    outline-none
    ">

        <option value="">
            Select a country
        </option>

        @foreach ($countries as $country)
            <option value="{{ $country->id }}" @selected(old('country_id', $shop?->country_id) == $country->id)>
                {{ $country->name }}
            </option>
        @endforeach

    </select>

    @error('country_id')
        <p class="text-red-500 mt-2 text-sm">
            {{ $message }}
        </p>
    @enderror

</div>

{{-- ================================================================ --}}
{{-- STATE / EMIRATE --}}
{{-- ================================================================ --}}

<div class="mt-5">

    <label for="state_id" class="block text-sm font-bold mb-2">
        🏛️ State / Emirate 🇦🇪
    </label>

    <select id="state_id" name="state_id"
        class="
    w-full
    rounded-2xl
    border
    border-gray-300
    dark:border-neutral-700
    dark:bg-neutral-900
    dark:text-white
    px-5
    py-4
    focus:ring-2
    focus:ring-orange-500
    outline-none
    "
        {{ old('country_id', $shop?->country_id) ? '' : 'disabled' }}>

        <option value="">
            Select a state / emirate
        </option>

        @foreach ($states as $state)
            <option value="{{ $state->id }}" data-country="{{ $state->country_id }}" @selected(old('state_id', $shop?->state_id) == $state->id)>
                {{ $state->name }}
            </option>
        @endforeach

    </select>

    @error('state_id')
        <p class="text-red-500 mt-2 text-sm">
            {{ $message }}
        </p>
    @enderror

</div>

{{-- ================================================================ --}}
{{-- CITY --}}
{{-- ================================================================ --}}

<div class="mt-5">


    <label for="city_id" class="block text-sm font-bold mb-2">
        🏙️ City
    </label>

    <select id="city_id" name="city_id"
        class="
    w-full
    rounded-2xl
    border
    border-gray-300
    dark:border-neutral-700
    dark:bg-neutral-900
    dark:text-white
    px-5
    py-4
    focus:ring-2
    focus:ring-orange-500
    outline-none
    "
        {{ old('state_id', $shop?->state_id) ? '' : 'disabled' }}>

        <option value="">
            Select a city
        </option>

        @foreach ($cities as $city)
            <option value="{{ $city->id }}" data-state="{{ $city->state_id }}" @selected(old('city_id', $shop?->city_id) == $city->id)>
                {{ $city->name }}
            </option>
        @endforeach

    </select>

    @error('city_id')
        <p class="text-red-500 mt-2 text-sm">
            {{ $message }}
        </p>
    @enderror

</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {

        const country = document.getElementById('country_id');
        const state = document.getElementById('state_id');
        const city = document.getElementById('city_id');

        const stateOptions = [...state.options];
        const cityOptions = [...city.options];

        function loadStates(selectedState = null) {

            const countryId = country.value;

            state.innerHTML = '<option value="">Select a state</option>';

            stateOptions.forEach(option => {

                if (
                    option.value &&
                    option.dataset.country == countryId
                ) {
                    state.appendChild(option.cloneNode(true));
                }

            });

            state.disabled = !countryId;

            if (selectedState) {
                state.value = selectedState;
            }

            loadCities(city.dataset.selected);

        }

        function loadCities(selectedCity = null) {

            const stateId = state.value;

            city.innerHTML = '<option value="">Select a city</option>';

            cityOptions.forEach(option => {

                if (
                    option.value &&
                    option.dataset.state == stateId
                ) {
                    city.appendChild(option.cloneNode(true));
                }

            });

            city.disabled = !stateId;

            if (selectedCity) {
                city.value = selectedCity;
            }

        }

        state.dataset.selected = "{{ old('state_id', $shop?->state_id) }}";
        city.dataset.selected = "{{ old('city_id', $shop?->city_id) }}";

        loadStates(state.dataset.selected);

        country.addEventListener('change', () => {

            loadStates();

        });

        state.addEventListener('change', () => {

            loadCities();

        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const button = document.getElementById('generate-description');
        const textarea = document.getElementById('description');

        if (!button || !textarea) return;

        button.addEventListener('click', async () => {

            const selectedSection = document.querySelector('input[name="section_id"]:checked');

            const section = selectedSection ?
                selectedSection.closest('label').querySelector('.font-bold')?.textContent.trim() :
                '';

            const country = document.getElementById('country_id')?.selectedOptions[0]?.text
                .trim() || '';
            const state = document.getElementById('state_id')?.selectedOptions[0]?.text.trim() ||
                '';
            const city = document.getElementById('city_id')?.selectedOptions[0]?.text.trim() || '';

            if (!section || !country || !state || !city) {
                alert('Please select a shop type, country, state and city.');
                return;
            }

            button.disabled = true;
            button.innerHTML = '⏳ Generating...';

            try {

                const response = await fetch("{{ url('/ai/shop-description') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .content
                    },
                    body: JSON.stringify({
                        section: section,
                        country: country,
                        state: state,
                        city: city
                    })
                });

                const data = await response.json().catch(() => null);

                if (!response.ok) {
                    console.error(data);
                    throw new Error(data?.message || `HTTP ${response.status}`);
                }

                if (data && data.description) {
                    textarea.value = data.description;
                } else {
                    alert("The server did not return a description.");
                }

            } catch (error) {

                console.error("AI Error:", error);
                alert(error.message);

            } finally {

                button.disabled = false;
                button.innerHTML = "✨ AI Generate";

            }

        });

    });
</script>
