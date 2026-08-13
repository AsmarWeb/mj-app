@php
    $isArabic = app()->getLocale() === 'ar';

    $labels = [
        'logo' => $isArabic ? 'شعار المتجر' : 'Shop Logo',
        'logo_hint' => $isArabic ? 'PNG أو JPG — الحد الأقصى 2MB' : 'PNG or JPG — maximum 2MB',

        'cover' => $isArabic ? 'صورة الغلاف' : 'Cover Image',
        'upload_cover' => $isArabic ? 'رفع صورة الغلاف' : 'Upload Cover Photo',

        'change_logo' => $isArabic ? 'تغيير الشعار' : 'Change Logo',
        'change_cover' => $isArabic ? 'تغيير صورة الغلاف' : 'Change Cover',
    ];

    // Change these paths if your database stores a different path.
    $logoUrl = !empty($shop?->logo) ? asset('storage/' . $shop->logo) : null;

    $bannerUrl = !empty($shop?->banner) ? asset('storage/' . $shop->banner) : null;
@endphp


{{-- ================================================================ --}}
{{-- SHOP LOGO --}}
{{-- ================================================================ --}}

<div class="space-y-4">

    <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

        {{-- Logo Upload --}}

        <div class="relative shrink-0">

            <div
                class="relative h-32 w-32 overflow-hidden rounded-full
                       border-4 border-white bg-[#f5eee7]
                       shadow-xl shadow-orange-100/60">

                {{-- Existing / Preview Logo --}}

                <img id="logoPreview" src="{{ $logoUrl ?? '' }}" alt="{{ $labels['logo'] }}"
                    class="h-full w-full object-cover
                           {{ $logoUrl ? '' : 'hidden' }}">


                {{-- Placeholder --}}

                <div id="logoPlaceholder"
                    class="absolute inset-0 flex items-center
                           justify-center text-[#a69687]
                           {{ $logoUrl ? 'hidden' : '' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 00-9.78 2.096A4.001 4.001 0 003 15z" />

                    </svg>

                </div>


                {{-- Upload Input --}}

                <input type="file" name="logo" accept="image/png,image/jpeg,image/jpg,image/webp"
                    onchange="previewImage(event, 'logoPreview', 'logoPlaceholder')"
                    class="absolute inset-0 z-10 cursor-pointer rounded-full opacity-0">

            </div>


            {{-- Upload Indicator --}}

            <div
                class="pointer-events-none absolute bottom-1
                       {{ $isArabic ? 'left-1' : 'right-1' }}
                       flex h-9 w-9 items-center justify-center
                       rounded-full border-4 border-white
                       bg-orange-500 text-white shadow-lg">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />

                </svg>

            </div>

        </div>


        {{-- Logo Information --}}

        <div class="{{ $isArabic ? 'text-right' : 'text-left' }}">

            <h3 class="text-lg font-black text-[#211a15]">
                {{ $labels['logo'] }}
            </h3>

            <p class="mt-1 text-sm leading-6 text-[#8c7b6d]">
                {{ $labels['logo_hint'] }}
            </p>

            <div
                class="mt-3 inline-flex items-center gap-2
                       rounded-full bg-orange-50
                       px-3 py-1.5 text-xs font-bold
                       text-orange-700">

                <span>✦</span>

                {{ $labels['change_logo'] }}

            </div>

        </div>

    </div>


    @error('logo')
        <p class="text-sm font-semibold text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>


{{-- ================================================================ --}}
{{-- COVER IMAGE --}}
{{-- ================================================================ --}}

<div class="mt-10">

    <div class="mb-4">

        <h3 class="text-lg font-black text-[#211a15]">
            {{ $labels['cover'] }}
        </h3>

    </div>


    <div
        class="group relative h-56 overflow-hidden rounded-3xl
               border-2 border-dashed border-[#dfd2c5]
               bg-[#f8f3ee] transition-all duration-200
               hover:border-orange-300 hover:bg-orange-50/30
               sm:h-64">

        {{-- Existing / Preview Banner --}}

        <img id="coverPreview" src="{{ $bannerUrl ?? '' }}" alt="{{ $labels['cover'] }}"
            class="absolute inset-0 h-full w-full object-cover
                   {{ $bannerUrl ? '' : 'hidden' }}">


        {{-- Placeholder --}}

        <div id="coverPlaceholder"
            class="absolute inset-0 flex flex-col
                   items-center justify-center
                   text-center text-[#8c7b6d]
                   {{ $bannerUrl ? 'hidden' : '' }}">

            <div
                class="flex h-16 w-16 items-center justify-center
                       rounded-2xl bg-white text-orange-500
                       shadow-sm">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.5 8.5h.01" />

                </svg>

            </div>


            <p class="mt-4 text-sm font-black text-[#66584d]">
                {{ $labels['upload_cover'] }}
            </p>

            <p class="mt-1 text-xs text-[#9b8b7e]">
                PNG, JPG or WEBP
            </p>

        </div>


        {{-- Upload Input --}}

        <input type="file" name="banner" accept="image/png,image/jpeg,image/jpg,image/webp"
            onchange="previewImage(event, 'coverPreview', 'coverPlaceholder')"
            class="absolute inset-0 z-10 cursor-pointer opacity-0">


        {{-- Hover Overlay --}}

        <div
            class="pointer-events-none absolute inset-0
                   bg-orange-500/0 transition
                   group-hover:bg-orange-500/5">
        </div>

    </div>


    @error('banner')
        <p class="mt-2 text-sm font-semibold text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>


{{-- ================================================================ --}}
{{-- IMAGE PREVIEW --}}
{{-- ================================================================ --}}

<script>
    function previewImage(event, previewId, placeholderId) {

        const input = event.target;
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);

        if (!input || !preview || !placeholder) {
            return;
        }

        const file = input.files?.[0];

        if (!file) {
            preview.src = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');

            return;
        }

        // Maximum 2MB
        if (file.size > 2 * 1024 * 1024) {

            alert(
                @json($isArabic ? 'حجم الصورة يجب ألا يتجاوز 2MB.' : 'The image size must not exceed 2MB.')
            );

            input.value = '';

            preview.src = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');

            return;
        }

        // Check image type
        if (!file.type.startsWith('image/')) {

            alert(
                @json($isArabic ? 'يرجى اختيار ملف صورة صالح.' : 'Please select a valid image file.')
            );

            input.value = '';

            return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {

            preview.src = e.target.result;

            preview.classList.remove('hidden');

            placeholder.classList.add('hidden');
        };

        reader.readAsDataURL(file);
    }
</script>
