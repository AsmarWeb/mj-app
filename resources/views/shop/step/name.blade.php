@php
    $locale = app()->getLocale();
    $isArabic = $locale === 'ar';

    $selectedType = old('type', $shop?->type);
@endphp

<div dir="{{ $isArabic ? 'rtl' : 'ltr' }}" lang="{{ $locale }}" class="space-y-8">

    {{-- Intro --}}
    <div class="{{ $isArabic ? 'text-right' : 'text-left' }}">

        <div
            class="inline-flex items-center gap-2 rounded-full
                   border border-orange-200 bg-orange-50
                   px-4 py-2 text-xs font-black text-orange-700">

            <span>✦</span>

            {{ $isArabic ? 'هوية المتجر' : 'Shop identity' }}

        </div>

        <h2 class="mt-4 text-2xl font-black tracking-tight text-[#211a15] sm:text-3xl">
            {{ $isArabic ? 'أعطِ متجرك اسماً' : 'Give your shop a name' }}
        </h2>

        <p class="mt-2 max-w-2xl text-sm leading-6 text-[#827468] sm:text-base">
            {{ $isArabic
                ? 'اختر اسماً يتعرف عليه العملاء ويتذكرونه بسهولة. يمكنك إضافة اسم متجرك باللغتين العربية والإنجليزية.'
                : 'Choose a name that customers will recognize and remember. You can provide both English and Arabic names.' }}
        </p>

    </div>


    {{-- Shop Names --}}
    <div class="grid gap-6 md:grid-cols-2">

        {{-- English Name --}}
        <div>

            <label for="name" class="block text-sm font-black text-[#211a15]">
                {{ $isArabic ? 'اسم المتجر بالإنجليزية' : 'English Shop Name' }}

                <span class="text-orange-500">*</span>
            </label>

            <input type="text" id="name" name="name" value="{{ old('name', $shop?->name) }}"
                placeholder="{{ $isArabic ? 'مثال: Noor Boutique' : 'e.g. Noor Boutique' }}" dir="ltr"
                autocomplete="organization"
                class="mt-2 w-full rounded-2xl border border-[#ded1c4]
                       bg-[#fffdf9] px-4 py-3.5
                       text-sm font-medium text-[#211a15]
                       placeholder:text-[#b2a295]
                       outline-none transition
                       focus:border-orange-400
                       focus:bg-white
                       focus:ring-4 focus:ring-orange-100
                       @error('name')
                           border-red-300 focus:border-red-400 focus:ring-red-100
                       @enderror">

            @error('name')
                <p class="mt-2 text-xs font-semibold text-red-600">
                    ⚠ {{ $message }}
                </p>
            @enderror

        </div>


        {{-- Arabic Name --}}
        <div>

            <label for="name_ar" class="block text-sm font-black text-[#211a15]">
                {{ $isArabic ? 'اسم المتجر بالعربية' : 'Arabic Shop Name' }}

                <span class="text-orange-500">*</span>
            </label>

            <input type="text" id="name_ar" name="name_ar" value="{{ old('name_ar', $shop?->name_ar) }}"
                placeholder="{{ $isArabic ? 'مثال: متجر نور' : 'e.g. متجر نور' }}" dir="rtl"
                autocomplete="organization"
                class="mt-2 w-full rounded-2xl border border-[#ded1c4]
                       bg-[#fffdf9] px-4 py-3.5
                       text-right text-sm font-medium text-[#211a15]
                       placeholder:text-[#b2a295]
                       outline-none transition
                       focus:border-orange-400
                       focus:bg-white
                       focus:ring-4 focus:ring-orange-100
                       @error('name_ar')
                           border-red-300 focus:border-red-400 focus:ring-red-100
                       @enderror">

            @error('name_ar')
                <p class="mt-2 text-xs font-semibold text-red-600">
                    ⚠ {{ $message }}
                </p>
            @enderror

        </div>

    </div>


    {{-- Shop Type --}}
    <div>

        <div class="{{ $isArabic ? 'text-right' : 'text-left' }}">

            <label class="block text-sm font-black text-[#211a15]">
                {{ $isArabic ? 'نوع المتجر' : 'Shop Type' }}

                <span class="text-orange-500">*</span>
            </label>

            <p class="mt-1 text-xs text-[#918174]">
                {{ $isArabic ? 'اختر النوع الذي يصف متجرك بشكل أفضل.' : 'Choose the type that best describes your shop.' }}
            </p>

        </div>


        <div class="mt-4 grid gap-4 sm:grid-cols-2">

            {{-- Freelance --}}
            <label class="group cursor-pointer">

                <input type="radio" name="type" value="freelance" class="peer sr-only"
                    {{ $selectedType === 'freelance' ? 'checked' : '' }}>

                <div
                    class="rounded-2xl border border-[#ded1c4]
                           bg-[#fffdf9] p-5 transition duration-200
                           hover:border-orange-300 hover:bg-orange-50/40
                           peer-checked:border-orange-500
                           peer-checked:bg-orange-50
                           peer-checked:ring-4
                           peer-checked:ring-orange-100">

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-11 w-11 shrink-0
                                       items-center justify-center
                                       rounded-xl bg-orange-50 text-xl">
                                💼
                            </div>

                            <div class="{{ $isArabic ? 'text-right' : 'text-left' }}">

                                <p class="text-sm font-black text-[#211a15]">
                                    {{ $isArabic ? 'عمل حر' : 'Freelance' }}
                                </p>

                                <p class="mt-1 text-xs leading-5 text-[#918174]">
                                    {{ $isArabic ? 'عمل مستقل أو خدمات عبر الإنترنت' : 'Independent work or online services' }}
                                </p>

                            </div>

                        </div>


                        <div
                            class="flex h-5 w-5 shrink-0 items-center
                                   justify-center rounded-full border-2
                                   {{ $selectedType === 'freelance' ? 'border-orange-500 bg-orange-500' : 'border-[#d8cabe] bg-white' }}">
                            @if ($selectedType === 'freelance')
                                <span class="text-xs font-black text-white">
                                    ✓
                                </span>
                            @endif
                        </div>

                    </div>

                </div>

            </label>


            {{-- Local --}}
            <label class="group cursor-pointer">

                <input type="radio" name="type" value="local" class="peer sr-only"
                    {{ $selectedType === 'local' ? 'checked' : '' }}>

                <div
                    class="rounded-2xl border border-[#ded1c4]
                           bg-[#fffdf9] p-5 transition duration-200
                           hover:border-orange-300 hover:bg-orange-50/40
                           peer-checked:border-orange-500
                           peer-checked:bg-orange-50
                           peer-checked:ring-4
                           peer-checked:ring-orange-100">

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-11 w-11 shrink-0
                                       items-center justify-center
                                       rounded-xl bg-orange-50 text-xl">
                                🇦🇪
                            </div>

                            <div class="{{ $isArabic ? 'text-right' : 'text-left' }}">

                                <p class="text-sm font-black text-[#211a15]">
                                    {{ $isArabic ? 'محلي' : 'Local' }}
                                </p>

                                <p class="mt-1 text-xs leading-5 text-[#918174]">
                                    {{ $isArabic ? 'نشاط تجاري محلي أو متجر فعلي' : 'A local business or physical store' }}
                                </p>

                            </div>

                        </div>


                        <div
                            class="flex h-5 w-5 shrink-0 items-center
                                   justify-center rounded-full border-2
                                   {{ $selectedType === 'local' ? 'border-orange-500 bg-orange-500' : 'border-[#d8cabe] bg-white' }}">
                            @if ($selectedType === 'local')
                                <span class="text-xs font-black text-white">
                                    ✓
                                </span>
                            @endif
                        </div>

                    </div>

                </div>

            </label>

        </div>


        @error('type')
            <p class="mt-3 text-xs font-semibold text-red-600">
                ⚠ {{ $message }}
            </p>
        @enderror

    </div>


    {{-- Helpful Hint --}}
    <div
        class="flex items-start gap-3 rounded-2xl
               border border-[#eadfd3]
               bg-[#fffaf5] px-4 py-4
               {{ $isArabic ? 'text-right' : 'text-left' }}">

        <div
            class="flex h-9 w-9 shrink-0 items-center justify-center
                   rounded-xl bg-orange-50 text-orange-600">
            ✨
        </div>

        <div>

            <p class="text-sm font-bold text-[#3a2e27]">
                {{ $isArabic ? 'اجعل الاسم مميزاً' : 'Make it memorable' }}
            </p>

            <p class="mt-1 text-xs leading-5 text-[#827468]">
                {{ $isArabic
                    ? 'الاسم الواضح وسهل التذكر يساعد العملاء على معرفة علامتك التجارية وتذكرها.'
                    : 'A clear and recognizable shop name helps customers understand and remember your brand.' }}
            </p>

        </div>

    </div>

</div>
