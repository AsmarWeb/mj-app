<div>
    <label class="block mb-2 text-sm font-medium text-gray-700">
        Description
    </label>

    <textarea rows="4" name="description" id="description" placeholder="Tell customers about your store..."
        value="{{ old('description', $shop?->description) }}"
        class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-gray-900 outline-none">
    </textarea>
</div>

@error('description')
    <p class="text-red-500 mt-2">{{ $message }}</p>
@enderror

<div>
    <label class="block mb-2 text-sm font-medium text-gray-700">
        Select your shop section
    </label>

    <select name="section_id" class="w-full rounded-2xl border border-gray-300 px-4 py-3">
        <option value="">Select a Section</option>
        @foreach ($sections as $section)
            <option value="{{ $section->id }}" @selected(old('section_id', $shop?->section_id) == $section->id)>{{ $section->name }}</option>
        @endforeach
    </select>
</div>

<h1 class="text-3xl font-bold mb-6 mt-6">
    Where is your shop located?
</h1>

<div class="col-span-full">
    <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">
        Location
    </label>
    <div class="mt-2">
        <input type="text" name="location" id="location" autocomplete="location"
            value="{{ old('location', $shop?->location) }}"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-900 sm:text-sm sm:leading-6" />
    </div>
</div>

<div>
    <label class="block mb-2 text-sm font-medium text-gray-700">
        Country
    </label>

    <select name="country_id" class="w-full rounded-2xl border border-gray-300 px-4 py-3">
        <option value="">Select a Country</option>
        @foreach ($countries as $country)
            <option value="{{ $country->id }}" @selected(old('country_id', $shop?->country_id) == $country->id)>{{ $country->name }}</option>
        @endforeach
    </select>
</div>

<div>
    <label class="block mb-2 text-sm font-medium text-gray-700">
        State
    </label>

    <select name="state_id" class="w-full rounded-2xl border border-gray-300 px-4 py-3">
        <option value="">Select a State</option>
        @foreach ($states as $state)
            <option value="{{ $state->id }}" @selected(old('state_id', $shop?->state_id) == $state->id)>{{ $state->name }}</option>
        @endforeach
    </select>
</div>

<div>
    <label class="block mb-2 text-sm font-medium text-gray-700">
        City
    </label>

    <select name="city_id" class="w-full rounded-2xl border border-gray-300 px-4 py-3">
        <option value="">Select a City</option>
        @foreach ($cities as $city)
            <option value="{{ $city->id }}" @selected(old('city_id', $shop?->city_id) == $city->id)>{{ $city->name }}</option>
        @endforeach
    </select>
</div>
