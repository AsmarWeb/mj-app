<h2 class="text-3xl font-bold mb-6">
    What is your shop name?
</h2>

<input type="text" name="name" autofocus value="{{ old('name', $shop?->name) }}" class="w-full rounded-lg border p-4">

@error('name')
    <p class="text-red-500 mt-2">{{ $message }}</p>
@enderror

<h2 class="text-3xl font-bold mb-6">
    Select your shop type
</h2>

<label>
    <input type="radio" name="type" value="freelance" {{ old('type', $shop?->type) == 'freelance' ? 'checked' : '' }}>

    Freelance
</label>

<label class="ml-6">
    <input type="radio" name="type" value="local" {{ old('type', $shop?->type) == 'local' ? 'checked' : '' }}>

    Local
</label>
