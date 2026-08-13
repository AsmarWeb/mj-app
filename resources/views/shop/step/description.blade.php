@php
    $isArabic = app()->getLocale() === 'ar';

    $labels = [
        'description' => $isArabic ? 'وصف المتجر' : 'Shop Description',
        'description_placeholder' => $isArabic ? 'أخبر العملاء عن متجرك...' : 'Tell customers about your store...',
        'ai_generate' => $isArabic ? 'إنشاء بالذكاء الاصطناعي' : 'AI Generate',
        'ai_hint' => $isArabic
            ? 'يمكن للذكاء الاصطناعي إنشاء وصف احترافي بناءً على معلومات متجرك.'
            : 'AI can create a professional description based on your shop information.',

        'shop_type' => $isArabic ? 'اختر نوع متجرك' : 'Choose Your Shop Type',

        'location' => $isArabic ? 'موقع المتجر' : 'Shop Location',
        'detect' => $isArabic ? 'تحديد الموقع' : 'Detect',
        'location_placeholder' => $isArabic ? 'جارٍ تحديد موقعك...' : 'Detecting your location...',
        'location_hint' => $isArabic
            ? 'يساعد موقعك العملاء في العثور على متجرك.'
            : 'Your location helps customers find your shop.',

        'country' => $isArabic ? 'الدولة' : 'Country',
        'select_country' => $isArabic ? 'اختر الدولة' : 'Select a country',

        'state' => $isArabic ? 'الإمارة' : 'State / Emirate',
        'select_state' => $isArabic ? 'اختر الإمارة' : 'Select a state / emirate',

        'city' => $isArabic ? 'المدينة' : 'City',
        'select_city' => $isArabic ? 'اختر المدينة' : 'Select a city',

        'generating' => $isArabic ? 'جارٍ الإنشاء...' : 'Generating...',

        'select_required' => $isArabic
            ? 'يرجى اختيار نوع المتجر والدولة والإمارة والمدينة.'
            : 'Please select a shop type, country, state and city.',

        'server_error' => $isArabic ? 'لم يُرجع الخادم وصفاً.' : 'The server did not return a description.',
    ];
@endphp


{{-- ================================================================ --}}
{{-- DESCRIPTION --}}
{{-- ================================================================ --}}

<div>

    <div class="mb-3 flex items-center justify-between gap-4">

        <label for="description" class="text-sm font-black text-[#211a15]">
            {{ $labels['description'] }}
        </label>

        <button type="button" id="generate-description"
            class="group inline-flex shrink-0 items-center gap-2 rounded-xl
                   bg-gradient-to-r from-[#f97316] to-[#c2410c]
                   px-4 py-2.5 text-xs font-black text-white
                   shadow-md shadow-orange-200
                   transition duration-200
                   hover:-translate-y-0.5
                   hover:from-[#ea580c]
                   hover:to-[#9a3412]
                   hover:shadow-lg
                   focus:outline-none
                   focus:ring-4 focus:ring-orange-200
                   disabled:cursor-not-allowed disabled:opacity-60">

            <span>✨</span>

            <span>
                {{ $labels['ai_generate'] }}
            </span>

        </button>

    </div>


    <textarea rows="6" name="description" id="description" autofocus dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
        placeholder="{{ $labels['description_placeholder'] }}"
        class="w-full resize-none rounded-2xl
               border border-[#e5d9cd]
               bg-white px-5 py-4
               text-sm text-[#211a15]
               placeholder:text-[#a8998c]
               outline-none transition
               focus:border-orange-400
               focus:ring-4 focus:ring-orange-100">{{ old('description', $shop?->description) }}</textarea>


    <p class="mt-2 text-xs leading-5 text-[#8c7b6d]">
        ✨ {{ $labels['ai_hint'] }}
    </p>


    @error('description')
        <p class="mt-2 text-sm font-semibold text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>


{{-- ================================================================ --}}
{{-- SHOP TYPE --}}
{{-- ================================================================ --}}

<div class="mt-8">

    <p class="mb-4 text-sm font-black text-[#211a15]">
        {{ $labels['shop_type'] }}
    </p>


    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">

        {{-- IMPORTANT:
             No $sectionRecords here.
             We use the $sections variable supplied by the controller.
        --}}

        @foreach ($sections as $section)
            <label class="group cursor-pointer">

                <input type="radio" name="section_id" value="{{ $section->id }}" class="peer hidden"
                    @checked(old('section_id', $shop?->section_id) == $section->id)>


                <div
                    class="h-full rounded-3xl
                           border border-[#eadfd3]
                           bg-white p-5
                           transition-all duration-200
                           hover:-translate-y-1
                           hover:border-orange-300
                           hover:shadow-lg
                           hover:shadow-orange-100/50

                           peer-checked:border-orange-500
                           peer-checked:bg-gradient-to-br
                           peer-checked:from-orange-500
                           peer-checked:to-orange-600
                           peer-checked:text-white
                           peer-checked:shadow-lg
                           peer-checked:shadow-orange-200">

                    <div
                        class="mb-3 flex h-12 w-12 items-center
                               justify-center rounded-2xl
                               bg-orange-50 text-2xl">

                        @switch($section->slug)
                            @case('sales')
                                🛍️
                            @break

                            @case('rental')
                                🚗
                            @break

                            @case('real-estate')
                                🏠
                            @break

                            @case('auction')
                                🔨
                            @break

                            @case('events')
                                🎟️
                            @break

                            @default
                                📦
                        @endswitch

                    </div>


                    <div
                        class="text-sm font-black text-[#211a15]
                                peer-checked:text-white">

                        {{ $isArabic ? $section->name_ar : $section->name }}

                    </div>

                </div>

            </label>
        @endforeach

    </div>


    @error('section_id')
        <p class="mt-2 text-sm font-semibold text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>


{{-- ================================================================ --}}
{{-- LOCATION --}}
{{-- ================================================================ --}}

<div class="mt-10">

    <h2 class="mb-5 text-xl font-black text-[#211a15]">
        📍 {{ $labels['location'] }}
    </h2>


    <div class="relative">

        <input type="text" name="location" id="location" value="{{ old('location', $shop?->location) }}"
            placeholder="{{ $labels['location_placeholder'] }}" dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
            class="w-full rounded-2xl
                   border border-[#e5d9cd]
                   bg-white px-5 py-4
                   {{ $isArabic ? 'pl-36' : 'pr-36' }}
                   text-sm text-[#211a15]
                   placeholder:text-[#a8998c]
                   outline-none transition
                   focus:border-orange-400
                   focus:ring-4 focus:ring-orange-100">


        <button type="button" onclick="detectLocation()"
            class="absolute top-1/2
                   {{ $isArabic ? 'left-2' : 'right-2' }}
                   -translate-y-1/2
                   rounded-xl
                   bg-orange-500
                   px-4 py-2.5
                   text-xs font-black text-white
                   transition
                   hover:bg-orange-600
                   focus:outline-none
                   focus:ring-4 focus:ring-orange-100">
            📍 {{ $labels['detect'] }}
        </button>

    </div>


    <p id="location-status" class="mt-2 text-xs text-[#8c7b6d]" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
        {{ $labels['location_hint'] }}
    </p>


    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $shop?->latitude) }}">

    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $shop?->longitude) }}">

</div>


{{-- ================================================================ --}}
{{-- COUNTRY --}}
{{-- ================================================================ --}}

<div class="mt-6">

    <label for="country_id" class="mb-2 block text-sm font-black text-[#211a15]">
        🌍 {{ $labels['country'] }}
    </label>


    <select id="country_id" name="country_id" dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
        class="w-full rounded-2xl
               border border-[#e5d9cd]
               bg-white px-5 py-4
               text-sm text-[#211a15]
               outline-none transition
               focus:border-orange-400
               focus:ring-4 focus:ring-orange-100">

        <option value="">
            {{ $labels['select_country'] }}
        </option>


        @foreach ($countries as $country)
            <option value="{{ $country->id }}" @selected(old('country_id', $shop?->country_id) == $country->id)>
                {{ $isArabic ? $country->name_ar : $country->name }}
                {{ $country->flag ?? '' }}
            </option>
        @endforeach

    </select>


    @error('country_id')
        <p class="mt-2 text-sm font-semibold text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>


{{-- ================================================================ --}}
{{-- STATE / EMIRATE --}}
{{-- ================================================================ --}}

<div class="mt-5">

    <label for="state_id" class="mb-2 block text-sm font-black text-[#211a15]">
        🏛️ {{ $labels['state'] }}
    </label>


    <select id="state_id" name="state_id" dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
        class="w-full rounded-2xl
               border border-[#e5d9cd]
               bg-white px-5 py-4
               text-sm text-[#211a15]
               outline-none transition
               focus:border-orange-400
               focus:ring-4 focus:ring-orange-100
               disabled:cursor-not-allowed
               disabled:bg-[#f7f2ed]"
        {{ old('country_id', $shop?->country_id) ? '' : 'disabled' }}>

        <option value="">
            {{ $labels['select_state'] }}
        </option>


        @foreach ($states as $state)
            <option value="{{ $state->id }}" data-country="{{ $state->country_id }}" @selected(old('state_id', $shop?->state_id) == $state->id)>
                {{ $isArabic ? $state->name_ar : $state->name }}
            </option>
        @endforeach

    </select>


    @error('state_id')
        <p class="mt-2 text-sm font-semibold text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>


{{-- ================================================================ --}}
{{-- CITY --}}
{{-- ================================================================ --}}

<div class="mt-5">

    <label for="city_id" class="mb-2 block text-sm font-black text-[#211a15]">
        🏙️ {{ $labels['city'] }}
    </label>


    <select id="city_id" name="city_id" dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
        class="w-full rounded-2xl
               border border-[#e5d9cd]
               bg-white px-5 py-4
               text-sm text-[#211a15]
               outline-none transition
               focus:border-orange-400
               focus:ring-4 focus:ring-orange-100
               disabled:cursor-not-allowed
               disabled:bg-[#f7f2ed]"
        {{ old('state_id', $shop?->state_id) ? '' : 'disabled' }}>

        <option value="">
            {{ $labels['select_city'] }}
        </option>


        @foreach ($cities as $city)
            <option value="{{ $city->id }}" data-state="{{ $city->state_id }}" @selected(old('city_id', $shop?->city_id) == $city->id)>
                {{ $isArabic ? $city->name_ar : $city->name }}
            </option>
        @endforeach

    </select>


    @error('city_id')
        <p class="mt-2 text-sm font-semibold text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>


{{-- ================================================================ --}}
{{-- LOCATION SELECT JS --}}
{{-- ================================================================ --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const country = document.getElementById('country_id');
        const state = document.getElementById('state_id');
        const city = document.getElementById('city_id');

        if (!country || !state || !city) {
            return;
        }

        const allStates = Array.from(state.options);
        const allCities = Array.from(city.options);

        const selectedState = @json(old('state_id', $shop?->state_id));
        const selectedCity = @json(old('city_id', $shop?->city_id));

        const statePlaceholder = @json($labels['select_state']);
        const cityPlaceholder = @json($labels['select_city']);


        function loadStates(selected = null) {

            const countryId = country.value;

            state.innerHTML = '';

            const placeholder = document.createElement('option');

            placeholder.value = '';
            placeholder.textContent = statePlaceholder;

            state.appendChild(placeholder);


            allStates.forEach(function(option) {

                if (
                    option.value &&
                    String(option.dataset.country) === String(countryId)
                ) {
                    state.appendChild(option.cloneNode(true));
                }

            });


            state.disabled = !countryId;


            if (selected) {
                state.value = selected;
            }


            loadCities(selectedCity);
        }


        function loadCities(selected = null) {

            const stateId = state.value;

            city.innerHTML = '';

            const placeholder = document.createElement('option');

            placeholder.value = '';
            placeholder.textContent = cityPlaceholder;

            city.appendChild(placeholder);


            allCities.forEach(function(option) {

                if (
                    option.value &&
                    String(option.dataset.state) === String(stateId)
                ) {
                    city.appendChild(option.cloneNode(true));
                }

            });


            city.disabled = !stateId;


            if (selected) {
                city.value = selected;
            }
        }


        loadStates(selectedState);


        country.addEventListener('change', function() {

            loadStates();

        });


        state.addEventListener('change', function() {

            loadCities();

        });

    });
</script>


{{-- ================================================================ --}}
{{-- AI DESCRIPTION --}}
{{-- ================================================================ --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const button = document.getElementById('generate-description');
        const textarea = document.getElementById('description');

        if (!button || !textarea) {
            return;
        }

        const isArabic = @json($isArabic);

        const text = {
            generate: @json($labels['ai_generate']),
            generating: @json($labels['generating']),
            selectRequired: @json($labels['select_required']),
            serverError: @json($labels['server_error']),
        };


        button.addEventListener('click', async function() {

            const selectedSection =
                document.querySelector('input[name="section_id"]:checked');


            if (!selectedSection) {

                alert(text.selectRequired);

                return;
            }


            const sectionName =
                selectedSection
                .closest('label')
                ?.querySelector('.font-black')
                ?.textContent
                ?.trim() || '';


            const countrySelect = document.getElementById('country_id');
            const stateSelect = document.getElementById('state_id');
            const citySelect = document.getElementById('city_id');


            const country =
                countrySelect?.selectedOptions[0]?.textContent?.trim() || '';

            const state =
                stateSelect?.selectedOptions[0]?.textContent?.trim() || '';

            const city =
                citySelect?.selectedOptions[0]?.textContent?.trim() || '';


            if (!sectionName || !country || !state || !city) {

                alert(text.selectRequired);

                return;
            }


            button.disabled = true;

            button.innerHTML = `
            <span>⏳</span>
            <span>${text.generating}</span>
        `;


            try {

                const csrf =
                    document.querySelector('meta[name="csrf-token"]')?.content;


                const response = await fetch(
                    "{{ url('/ai/shop-description') }}", {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf
                        },

                        body: JSON.stringify({
                            section: sectionName,
                            country: country,
                            state: state,
                            city: city,
                            locale: isArabic ? 'ar' : 'en'
                        })
                    }
                );


                const data = await response.json().catch(() => null);


                if (!response.ok) {

                    throw new Error(
                        data?.message || `HTTP ${response.status}`
                    );
                }


                if (data?.description) {

                    textarea.value = data.description;

                    textarea.dispatchEvent(
                        new Event('input', {
                            bubbles: true
                        })
                    );

                } else {

                    alert(text.serverError);
                }


            } catch (error) {

                console.error('AI Error:', error);

                alert(error.message || text.serverError);


            } finally {

                button.disabled = false;

                button.innerHTML = `
                <span>✨</span>
                <span>${text.generate}</span>
            `;
            }

        });

    });
</script>
