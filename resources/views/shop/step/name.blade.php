<h2 class="text-3xl font-bold mb-6">
    What is your shop name?
</h2>

<input type="text" name="name" autofocus value="{{ old('name', $shop?->name) }}" class="w-full rounded-lg border p-4">

<div dir="rtl">

    <label class="font-medium">Arabic Name</label>

    <input type="text" name="name_ar" value="{{ old('name', $shop?->name_ar) }}" placeholder="الاسم بالعربي"
        class="w-full mt-2 border rounded-lg p-3 text-right">

    @error('name_ar')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

@error('name')
    <p class="text-red-500 mt-2">{{ $message }}</p>
@enderror

<h2 class="text-3xl font-bold mb-6">
    Select your shop type
</h2>

<label>
    <input type="radio" name="type" value="freelance"
        {{ old('type', $shop?->type) == 'freelance' ? 'checked' : '' }}>

    Freelance
</label>

<label class="ml-6">
    <input type="radio" name="type" value="local" {{ old('type', $shop?->type) == 'local' ? 'checked' : '' }}>

    Local
</label>
