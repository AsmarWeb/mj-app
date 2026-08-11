{{-- Arabic Name --}} <label class="font-medium">Arabic Name</label>

<input type="text" name="name_ar" value="{{ old('name_ar', $shop?->name_ar) }}" placeholder="الاسم بالعربي"
    class="w-full mt-2 border rounded-lg p-3 text-right">

@error('name_ar')
    <p class="text-red-500 text-sm">{{ $message }}</p>
@enderror

{{-- English Name --}} <label class="font-medium mt-4 block">English Name</label>

<input type="text" name="name" value="{{ old('name', $shop?->name) }}" placeholder="English Name"
    class="w-full mt-2 border rounded-lg p-3">

@error('name')
    <p class="text-red-500 text-sm">{{ $message }}</p>
@enderror

{{-- Type --}} <label class="font-medium mt-4 block">Type</label>

<div class="flex gap-3 mt-2">


    <label class="flex items-center gap-2">
        <input type="radio" name="type" value="freelance"
            {{ old('type', $shop?->type) === 'freelance' ? 'checked' : '' }}>
        Freelance
    </label>

    <label class="flex items-center gap-2">
        <input type="radio" name="type" value="local"
            {{ old('type', $shop?->type) === 'local' ? 'checked' : '' }}>
        Local 🇦🇪
    </label>

</div>

@error('type')
    <p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
