{{-- Arabic Name --}}
<div>
    <label for="name_ar" class="font-medium">
        Arabic Name
    </label>

    <input type="text" id="name_ar" name="name_ar" value="{{ old('name_ar', $shop?->name_ar) }}"
        placeholder="الاسم بالعربي" dir="rtl" autofocus class="w-full mt-2 border rounded-lg p-3 text-right">

    @error('name_ar')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


{{-- English Name --}}
<div class="mt-4">
    <label for="name" class="font-medium">
        English Name
    </label>

    <input type="text" id="name" name="name" value="{{ old('name', $shop?->name) }}"
        placeholder="English Name" class="w-full mt-2 border rounded-lg p-3">

    @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


{{-- Type --}}
<div class="mt-4">
    <label class="font-medium block">
        Type
    </label>

    <div class="flex gap-4 mt-2">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="type" value="freelance"
                {{ old('type', $shop?->type) === 'freelance' ? 'checked' : '' }}>
            <span>Freelance</span>
        </label>

        <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="type" value="local"
                {{ old('type', $shop?->type) === 'local' ? 'checked' : '' }}>
            <span>Local 🇦🇪</span>
        </label>
    </div>

    @error('type')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
