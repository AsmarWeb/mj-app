@php
    $isArabic = app()->getLocale() === 'ar';

    $labels = [
        'community_badge' => $isArabic ? 'مجتمع الأعمال في الإمارات' : 'UAE Business Community',

        'success_status' => $isArabic ? 'تم الإنشاء بنجاح' : 'Successfully Created',

        'title' => $isArabic ? '🎉 متجرك جاهز!' : '🎉 Your shop is ready!',

        'description' => $isArabic
            ? 'تهانينا! تم إنشاء متجرك بنجاح وأصبح جاهزاً ليكون جزءاً من مجتمع الأعمال الرقمي المتنامي في الإمارات.'
            : "Congratulations! Your shop has been created successfully and is ready to become part of the UAE's growing digital business community.",

        'verified_shop' => $isArabic ? 'متجر موثّق' : 'Verified Shop',

        'about_shop' => $isArabic ? 'عن المتجر' : 'About the shop',

        'welcome' => $isArabic ? 'مرحباً بك في المجتمع' : 'Welcome to the community',

        'journey' => $isArabic ? 'رحلة أعمالك تبدأ من هنا.' : 'Your business journey starts here.',

        'shop_created' => $isArabic ? 'تم إنشاء المتجر' : 'Shop Created',

        'thank_you' => $isArabic ? 'شكراً لاختيارك' : 'Thank you for choosing',

        'connecting' => $isArabic
            ? 'نفخر بربط الأعمال في جميع أنحاء الإمارات 🇦🇪'
            : 'Proudly connecting businesses across the UAE 🇦🇪',

        'freelance' => $isArabic ? 'مستقل' : 'Freelance',
        'local' => $isArabic ? 'محلي' : 'Local',
    ];

    $shopType = match ($shop->type) {
        'freelance' => $labels['freelance'],
        'local' => $labels['local'],
        default => ucfirst($shop->type ?? ''),
    };

    $shopName = $isArabic ? ($shop->name_ar ?: $shop->name) : ($shop->name ?: $shop->name_ar);

    $logoUrl = $shop->logo ? Storage::url($shop->logo) : asset('images/default-shop.png');
@endphp


<div dir="{{ $isArabic ? 'rtl' : 'ltr' }}" lang="{{ app()->getLocale() }}"
    class="min-h-screen bg-gradient-to-br
           from-[#fbf8f3] via-white to-orange-50/40
           px-4 py-12 text-[#211a15]
           sm:px-6 lg:px-8">

    <div class="mx-auto max-w-4xl">


        {{-- ========================================================== --}}
        {{-- UAE ACCENT --}}
        {{-- ========================================================== --}}

        <div class="mb-8 flex justify-center">

            <div
                class="inline-flex items-center gap-3 rounded-full
                       border border-orange-200
                       bg-white/80 px-5 py-2.5
                       shadow-sm backdrop-blur">

                <span class="text-xl">
                    🇦🇪
                </span>

                <span class="text-xs font-black uppercase
                           tracking-[0.2em] text-orange-600">
                    {{ $labels['community_badge'] }}
                </span>

            </div>

        </div>


        {{-- ========================================================== --}}
        {{-- MAIN CARD --}}
        {{-- ========================================================== --}}

        <div
            class="relative overflow-hidden rounded-[2rem]
                   border border-[#eadfd3]
                   bg-white
                   shadow-[0_25px_80px_-25px_rgba(68,42,20,0.25)]">


            {{-- Luxury Background --}}

            <div
                class="absolute inset-x-0 top-0 h-48
                       bg-gradient-to-br
                       from-[#f97316]
                       via-[#ea580c]
                       to-[#f59e0b]">
            </div>

            <div class="absolute -right-20 -top-24 h-72 w-72
                       rounded-full bg-white/10 blur-3xl">
            </div>

            <div
                class="absolute -left-20 top-20 h-64 w-64
                       rounded-full bg-amber-300/10 blur-3xl">
            </div>


            {{-- ====================================================== --}}
            {{-- SUCCESS ICON --}}
            {{-- ====================================================== --}}

            <div class="relative flex justify-center pt-12">

                <div
                    class="flex h-24 w-24 items-center
                           justify-center rounded-[1.75rem]
                           border-8 border-white
                           bg-emerald-500
                           shadow-2xl">

                    <svg class="h-11 w-11 text-white" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12l4 4L19 6" />

                    </svg>

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ====================================================== --}}

            <div class="relative px-6 pb-10 pt-8
                       text-center sm:px-10">

                <span
                    class="inline-flex items-center gap-2
                           rounded-full bg-emerald-50
                           px-4 py-2
                           text-xs font-black uppercase
                           tracking-wider text-emerald-700">

                    <span class="h-2 w-2 rounded-full
                               bg-emerald-500">
                    </span>

                    {{ $labels['success_status'] }}

                </span>


                <h1
                    class="mt-5 text-3xl font-black
                           tracking-tight text-[#211a15]
                           sm:text-5xl">

                    {{ $labels['title'] }}

                </h1>


                <p
                    class="mx-auto mt-4 max-w-2xl
                           text-base leading-7
                           text-[#75685d] sm:text-lg">

                    {{ $labels['description'] }}

                </p>

            </div>


            {{-- ====================================================== --}}
            {{-- SHOP INFORMATION --}}
            {{-- ====================================================== --}}

            <div
                class="mx-5 mb-5 rounded-[1.5rem]
                       border border-[#eadfd3]
                       bg-[#faf7f3] p-5
                       sm:mx-8 sm:p-7">


                <div class="flex flex-col gap-5
                           sm:flex-row sm:items-center">


                    {{-- Logo --}}

                    <div class="shrink-0">

                        <div
                            class="rounded-2xl border
                                   border-white bg-white p-1.5
                                   shadow-lg">

                            <img src="{{ $logoUrl }}" alt="{{ $shopName }}"
                                class="h-24 w-24 rounded-xl
                                       object-cover sm:h-28 sm:w-28">

                        </div>

                    </div>


                    {{-- Details --}}

                    <div class="min-w-0 flex-1">

                        <div class="flex flex-wrap items-center gap-3">

                            <h2
                                class="truncate text-2xl font-black
                                       text-[#211a15]
                                       sm:text-3xl">

                                {{ $shopName }}

                            </h2>


                            <span
                                class="inline-flex items-center
                                       rounded-full
                                       bg-orange-100 px-3 py-1
                                       text-xs font-black
                                       text-orange-700">

                                {{ $labels['verified_shop'] }}

                            </span>

                        </div>


                        <div class="mt-3 flex flex-wrap
                                   gap-x-5 gap-y-2 text-sm">


                            @if ($shop->type)
                                <p class="font-bold text-orange-600">

                                    {{ $shopType }}

                                </p>
                            @endif


                            @if ($shop->location)
                                <p
                                    class="flex items-center gap-1.5
                                           text-[#827468]">

                                    <span>📍</span>

                                    {{ $shop->location }}

                                </p>
                            @endif

                        </div>

                    </div>

                </div>


                {{-- Description --}}

                @if ($shop->description)
                    <div
                        class="mt-6 border-t
                               border-[#e9ddd0]
                               pt-6">

                        <p
                            class="text-sm font-black
                                   uppercase tracking-wider
                                   text-[#9a8b7e]">

                            {{ $labels['about_shop'] }}

                        </p>


                        <p class="mt-2 leading-7
                                   text-[#66584d]">

                            {{ $shop->description }}

                        </p>

                    </div>
                @endif

            </div>


            {{-- ====================================================== --}}
            {{-- SUCCESS FOOTER --}}
            {{-- ====================================================== --}}

            <div
                class="border-t border-[#eadfd3]
                       bg-gradient-to-r
                       from-orange-50 to-amber-50
                       px-6 py-6
                       sm:px-10">

                <div
                    class="flex flex-col
                           items-center justify-between
                           gap-4 text-center
                           sm:flex-row
                           {{ $isArabic ? 'sm:text-right' : 'sm:text-left' }}">


                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0
                                   items-center justify-center
                                   rounded-xl bg-orange-500/10
                                   text-lg">

                            🇦🇪

                        </div>


                        <div>

                            <p class="font-black text-[#211a15]">

                                {{ $labels['welcome'] }}

                            </p>


                            <p class="text-sm text-[#827468]">

                                {{ $labels['journey'] }}

                            </p>

                        </div>

                    </div>


                    <div
                        class="flex items-center gap-2
                               rounded-full
                               bg-emerald-100 px-4 py-2
                               text-sm font-black
                               text-emerald-700">

                        <span class="h-2 w-2 rounded-full
                                   bg-emerald-500">
                        </span>

                        {{ $labels['shop_created'] }}

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================== --}}
        {{-- BOTTOM MESSAGE --}}
        {{-- ========================================================== --}}

        <div class="mt-8 text-center">

            <p class="text-sm text-[#9a8b7e]">

                {{ $labels['thank_you'] }}

                <span class="font-bold text-[#66584d]">
                    {{ config('app.name') }}
                </span>.

            </p>


            <p class="mt-1 text-xs font-bold
                       text-orange-500">

                {{ $labels['connecting'] }}

            </p>

        </div>

    </div>

</div>
