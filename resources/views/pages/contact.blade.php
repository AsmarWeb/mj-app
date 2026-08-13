<x-main-layout>

    @php
        $isArabic = app()->getLocale() === 'ar';

        $setting = App\Models\Setting::first();

        /*
        |--------------------------------------------------------------------------
        | Localized content
        |--------------------------------------------------------------------------
        */

        $pageTitle = $isArabic ? 'تواصل معنا | مُروَّج.كم' : 'Contact Us | murwaj';

        $heroBadge = $isArabic ? 'نحن هنا لمساعدتك' : 'We are here to help';

        $heroTitle = $isArabic ? 'يسعدنا أن نسمع منك' : "We'd Love To Hear From You";

        $heroText = $isArabic
            ? 'سواء كان لديك سؤال حول حسابك أو طلباتك أو المنتجات أو البيع والشراء أو الشراكات، فإن فريق مُروَّج.كم مستعد لمساعدتك.'
            : 'Whether you have a question about your account, orders, products, buying, selling, or partnerships, the murwaj team is ready to help.';

        $contactInfoTitle = $isArabic ? 'معلومات التواصل' : 'Contact Information';

        $addressLabel = $isArabic ? 'العنوان' : 'Address';

        $phoneLabel = $isArabic ? 'الهاتف' : 'Phone';

        $emailLabel = $isArabic ? 'البريد الإلكتروني' : 'Email';

        $followTitle = $isArabic ? 'تابعنا' : 'Follow Us';

        $messageTitle = $isArabic ? 'أرسل لنا رسالة' : 'Send Us a Message';

        $messageText = $isArabic
            ? 'املأ النموذج أدناه وسيتواصل معك فريقنا في أقرب وقت ممكن.'
            : "Fill in the form below and we'll get back to you shortly.";

        $faqBadge = 'FAQ';

        $faqTitle = $isArabic ? 'الأسئلة الشائعة' : 'Frequently Asked Questions';

        $supportQuestion = $isArabic ? 'كم يستغرق الرد من فريق الدعم؟' : 'How long does support take?';

        $supportAnswer = $isArabic
            ? 'نسعى للرد على معظم طلبات الدعم خلال يوم عمل واحد.'
            : 'We aim to respond to most support requests within one business day.';

        $orderQuestion = $isArabic ? 'هل تحتاج إلى مساعدة بخصوص طلب؟' : 'Need help with an order?';

        $orderAnswer = $isArabic
            ? 'أرسل رقم الطلب ضمن رسالتك حتى نتمكن من مساعدتك بشكل أسرع.'
            : 'Include your order number in your message so we can assist you faster.';

        $supplierQuestion = $isArabic ? 'هل ترغب في أن تصبح مورداً؟' : 'Want to become a supplier?';

        $supplierAnswer = $isArabic
            ? 'تواصل معنا لمعرفة المزيد حول الانضمام إلى شبكة الموردين لدينا.'
            : 'Contact us to learn more about joining our supplier network.';

        $businessQuestion = $isArabic ? 'هل تبحث عن شراكة تجارية؟' : 'Looking for a business partnership?';

        $businessAnswer = $isArabic
            ? 'نرحب بالشراكات والتكاملات والفرص التجارية الجديدة.'
            : 'We welcome partnerships, integrations, and new business opportunities.';

        $uaeText = $isArabic ? 'خدمة محلية في الإمارات' : 'Serving the UAE';

        $address = $setting?->address;
        $phone = $setting?->phone;
        $email = $setting?->email;

        $facebook = $setting?->facebook;
        $instagram = $setting?->instagram;
        $tiktok = $setting?->tiktok;
        $telegram = $setting?->telegram;
    @endphp


    @section('title', $pageTitle)

    @section('meta_description',
        $isArabic
        ? 'تواصل مع فريق مُروَّج.كم في الإمارات. نحن هنا لمساعدتك في التسوق والبيع
        والطلبات والشراكات.'
        : 'Contact the murwaj team in the UAE. We are here to help with shopping, selling, orders and
        partnerships.')

    @section('meta_keywords', 'murwaj, مُروَّج.كم, UAE, الإمارات, contact, support, customer service, تواصل, دعم')


    {{-- ============================================================= --}}
    {{-- HEADER --}}
    {{-- ============================================================= --}}

    <x-slot name="header">
        <x-main-header />
    </x-slot>


    {{-- ============================================================= --}}
    {{-- PAGE --}}
    {{-- ============================================================= --}}

    <div dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
        class="min-h-screen
               bg-[#faf8f5]
               text-slate-900
               transition-colors duration-300
               dark:bg-[#0b0b0c]
               dark:text-white">

        {{-- ========================================================= --}}
        {{-- HERO --}}
        {{-- ========================================================= --}}

        <section class="relative overflow-hidden">

            {{-- Background --}}
            <div
                class="absolute inset-0
                       bg-gradient-to-br
                       from-orange-500
                       via-orange-600
                       to-amber-500">
            </div>


            {{-- Decorative circles --}}
            <div
                class="pointer-events-none absolute
                       -right-32 -top-32
                       h-96 w-96
                       rounded-full
                       bg-white/10
                       blur-2xl">
            </div>

            <div
                class="pointer-events-none absolute
                       -bottom-48 -left-24
                       h-[32rem] w-[32rem]
                       rounded-full
                       bg-amber-300/20
                       blur-3xl">
            </div>


            <div
                class="relative mx-auto max-w-7xl
                       px-4 py-16
                       sm:px-6 sm:py-20
                       lg:px-8 lg:py-24">

                <div class="max-w-3xl">

                    {{-- Badge --}}
                    <div
                        class="inline-flex items-center gap-2
                               rounded-full
                               border border-white/20
                               bg-white/15
                               px-4 py-2
                               text-xs font-black
                               text-white
                               shadow-lg
                               backdrop-blur-md">
                        <span aria-hidden="true">🇦🇪</span>

                        {{ $heroBadge }}
                    </div>


                    {{-- Heading --}}
                    <h1
                        class="mt-6 text-4xl font-black
                               leading-tight
                               tracking-tight
                               text-white
                               sm:text-5xl
                               lg:text-6xl">
                        {{ $heroTitle }}
                    </h1>


                    {{-- Description --}}
                    <p
                        class="mt-6 max-w-2xl
                               text-sm leading-7
                               text-orange-50
                               sm:text-lg sm:leading-8">
                        {{ $heroText }}
                    </p>


                    {{-- UAE indicator --}}
                    <div class="mt-8 flex flex-wrap items-center gap-3">

                        <span
                            class="inline-flex items-center gap-2
                                   rounded-xl
                                   border border-white/20
                                   bg-black/10
                                   px-4 py-2.5
                                   text-xs font-bold
                                   text-white
                                   backdrop-blur-md">
                            <span aria-hidden="true">🇦🇪</span>
                            {{ $uaeText }}
                        </span>

                        <span
                            class="inline-flex items-center gap-2
                                   rounded-xl
                                   border border-white/20
                                   bg-black/10
                                   px-4 py-2.5
                                   text-xs font-bold
                                   text-white
                                   backdrop-blur-md">
                            <span class="h-2 w-2 rounded-full bg-emerald-300"></span>

                            {{ $isArabic ? 'دعم العملاء' : 'Customer Support' }}
                        </span>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- MAIN --}}
        {{-- ========================================================= --}}

        <main
            class="relative mx-auto max-w-7xl
                   px-4 py-10
                   sm:px-6 sm:py-14
                   lg:px-8 lg:py-16">

            <div class="grid gap-8
                       lg:grid-cols-3">

                {{-- ================================================= --}}
                {{-- LEFT COLUMN --}}
                {{-- ================================================= --}}

                <div class="space-y-8">

                    {{-- Contact information --}}
                    <div
                        class="overflow-hidden
                               rounded-[2rem]
                               border border-slate-200/80
                               bg-white
                               shadow-[0_20px_70px_-35px_rgba(0,0,0,0.25)]
                               dark:border-white/10
                               dark:bg-[#151516]">

                        <div class="p-6 sm:p-8">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11
                                           items-center justify-center
                                           rounded-xl
                                           bg-gradient-to-br
                                           from-orange-500
                                           to-amber-500
                                           text-xl text-white
                                           shadow-lg
                                           shadow-orange-500/20">
                                    ✦
                                </div>

                                <h2
                                    class="text-xl font-black
                                           text-slate-900
                                           dark:text-white">
                                    {{ $contactInfoTitle }}
                                </h2>

                            </div>


                            <div class="mt-8 space-y-6">

                                {{-- Address --}}
                                @if ($address)
                                    <div class="flex gap-4">

                                        <div
                                            class="flex h-12 w-12 shrink-0
                                                   items-center justify-center
                                                   rounded-2xl
                                                   bg-orange-50
                                                   text-xl
                                                   dark:bg-orange-500/10">
                                            📍
                                        </div>

                                        <div class="min-w-0">

                                            <p
                                                class="text-sm font-black
                                                       text-slate-900
                                                       dark:text-white">
                                                {{ $addressLabel }}
                                            </p>

                                            <p
                                                class="mt-1 break-words
                                                       text-sm leading-6
                                                       text-slate-500
                                                       dark:text-slate-400">
                                                {{ $address }}
                                            </p>

                                        </div>

                                    </div>
                                @endif


                                {{-- Phone --}}
                                @if ($phone)
                                    <div class="flex gap-4">

                                        <div
                                            class="flex h-12 w-12 shrink-0
                                                   items-center justify-center
                                                   rounded-2xl
                                                   bg-blue-50
                                                   text-xl
                                                   dark:bg-blue-500/10">
                                            📞
                                        </div>

                                        <div class="min-w-0">

                                            <p
                                                class="text-sm font-black
                                                       text-slate-900
                                                       dark:text-white">
                                                {{ $phoneLabel }}
                                            </p>

                                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                                                class="mt-1 block break-words
                                                       text-sm leading-6
                                                       text-slate-500
                                                       transition
                                                       hover:text-orange-600
                                                       dark:text-slate-400
                                                       dark:hover:text-orange-400">
                                                {{ $phone }}
                                            </a>

                                        </div>

                                    </div>
                                @endif


                                {{-- Email --}}
                                @if ($email)
                                    <div class="flex gap-4">

                                        <div
                                            class="flex h-12 w-12 shrink-0
                                                   items-center justify-center
                                                   rounded-2xl
                                                   bg-emerald-50
                                                   text-xl
                                                   dark:bg-emerald-500/10">
                                            ✉️
                                        </div>

                                        <div class="min-w-0">

                                            <p
                                                class="text-sm font-black
                                                       text-slate-900
                                                       dark:text-white">
                                                {{ $emailLabel }}
                                            </p>

                                            <a href="mailto:{{ $email }}"
                                                class="mt-1 block break-words
                                                       text-sm leading-6
                                                       text-slate-500
                                                       transition
                                                       hover:text-orange-600
                                                       dark:text-slate-400
                                                       dark:hover:text-orange-400">
                                                {{ $email }}
                                            </a>

                                        </div>

                                    </div>
                                @endif

                            </div>

                        </div>


                        {{-- UAE footer --}}
                        <div
                            class="border-t border-slate-200/80
                                   bg-slate-50/70
                                   px-6 py-4
                                   dark:border-white/10
                                   dark:bg-white/[0.02]">

                            <div
                                class="flex items-center gap-2
                                       text-xs font-bold
                                       text-slate-500
                                       dark:text-slate-400">
                                <span aria-hidden="true">🇦🇪</span>

                                {{ $isArabic ? 'مُروَّج.كم — الإمارات العربية المتحدة' : 'murwaj — United Arab Emirates' }}
                            </div>

                        </div>

                    </div>


                    {{-- Social --}}
                    <div
                        class="rounded-[2rem]
                               border border-slate-200/80
                               bg-white
                               p-6
                               shadow-[0_20px_70px_-35px_rgba(0,0,0,0.25)]
                               dark:border-white/10
                               dark:bg-[#151516]
                               sm:p-8">

                        <h2
                            class="text-xl font-black
                                   text-slate-900
                                   dark:text-white">
                            {{ $followTitle }}
                        </h2>


                        <p
                            class="mt-2 text-sm leading-6
                                   text-slate-500
                                   dark:text-slate-400">
                            {{ $isArabic ? 'تابع آخر أخبار وتحديثات مُروَّج.كم.' : 'Follow murwaj for the latest news and updates.' }}
                        </p>


                        <div class="mt-6 grid grid-cols-2 gap-3">

                            @if ($facebook)
                                <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer"
                                    class="group flex min-h-[48px]
                                           items-center justify-center
                                           gap-2 rounded-xl
                                           border border-slate-200
                                           bg-slate-50
                                           px-3 py-3
                                           text-sm font-bold
                                           text-slate-700
                                           transition
                                           hover:-translate-y-0.5
                                           hover:border-orange-200
                                           hover:bg-orange-50
                                           hover:text-orange-700
                                           dark:border-white/10
                                           dark:bg-white/[0.03]
                                           dark:text-slate-300
                                           dark:hover:border-orange-500/20
                                           dark:hover:bg-orange-500/10
                                           dark:hover:text-orange-400">
                                    <span>f</span>
                                    Facebook
                                </a>
                            @endif


                            @if ($instagram)
                                <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer"
                                    class="group flex min-h-[48px]
                                           items-center justify-center
                                           gap-2 rounded-xl
                                           border border-slate-200
                                           bg-slate-50
                                           px-3 py-3
                                           text-sm font-bold
                                           text-slate-700
                                           transition
                                           hover:-translate-y-0.5
                                           hover:border-orange-200
                                           hover:bg-orange-50
                                           hover:text-orange-700
                                           dark:border-white/10
                                           dark:bg-white/[0.03]
                                           dark:text-slate-300
                                           dark:hover:border-orange-500/20
                                           dark:hover:bg-orange-500/10
                                           dark:hover:text-orange-400">
                                    <span>◎</span>
                                    Instagram
                                </a>
                            @endif


                            @if ($tiktok)
                                <a href="{{ $tiktok }}" target="_blank" rel="noopener noreferrer"
                                    class="group flex min-h-[48px]
                                           items-center justify-center
                                           gap-2 rounded-xl
                                           border border-slate-200
                                           bg-slate-50
                                           px-3 py-3
                                           text-sm font-bold
                                           text-slate-700
                                           transition
                                           hover:-translate-y-0.5
                                           hover:border-orange-200
                                           hover:bg-orange-50
                                           hover:text-orange-700
                                           dark:border-white/10
                                           dark:bg-white/[0.03]
                                           dark:text-slate-300
                                           dark:hover:border-orange-500/20
                                           dark:hover:bg-orange-500/10
                                           dark:hover:text-orange-400">
                                    <span>♪</span>
                                    TikTok
                                </a>
                            @endif


                            @if ($telegram)
                                <a href="{{ $telegram }}" target="_blank" rel="noopener noreferrer"
                                    class="group flex min-h-[48px]
                                           items-center justify-center
                                           gap-2 rounded-xl
                                           border border-slate-200
                                           bg-slate-50
                                           px-3 py-3
                                           text-sm font-bold
                                           text-slate-700
                                           transition
                                           hover:-translate-y-0.5
                                           hover:border-orange-200
                                           hover:bg-orange-50
                                           hover:text-orange-700
                                           dark:border-white/10
                                           dark:bg-white/[0.03]
                                           dark:text-slate-300
                                           dark:hover:border-orange-500/20
                                           dark:hover:bg-orange-500/10
                                           dark:hover:text-orange-400">
                                    <span>➤</span>
                                    Telegram
                                </a>
                            @endif

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- CONTACT FORM --}}
                {{-- ================================================= --}}

                <div class="lg:col-span-2">

                    <div
                        class="overflow-hidden
                               rounded-[2rem]
                               border border-slate-200/80
                               bg-white
                               shadow-[0_20px_70px_-35px_rgba(0,0,0,0.25)]
                               dark:border-white/10
                               dark:bg-[#151516]">

                        {{-- Form header --}}
                        <div
                            class="relative overflow-hidden
                                   bg-gradient-to-br
                                   from-orange-500
                                   via-orange-600
                                   to-amber-500
                                   p-6 sm:p-8">

                            <div
                                class="pointer-events-none
                                       absolute -right-16 -top-20
                                       h-48 w-48
                                       rounded-full
                                       bg-white/10
                                       blur-2xl">
                            </div>


                            <div class="relative">

                                <div
                                    class="inline-flex h-11 w-11
                                           items-center justify-center
                                           rounded-xl
                                           bg-white/15
                                           text-xl text-white
                                           backdrop-blur-md">
                                    ✉
                                </div>

                                <h2
                                    class="mt-5 text-2xl font-black
                                           text-white
                                           sm:text-3xl">
                                    {{ $messageTitle }}
                                </h2>

                                <p
                                    class="mt-2 max-w-xl
                                           text-sm leading-6
                                           text-orange-50
                                           sm:text-base">
                                    {{ $messageText }}
                                </p>

                            </div>

                        </div>


                        {{-- Livewire form --}}
                        <div class="p-5 sm:p-8 lg:p-10">

                            @livewire('contact-component')

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- FAQ --}}
            {{-- ========================================================= --}}

            <section class="mt-10 sm:mt-14">

                <div
                    class="rounded-[2rem]
                           border border-slate-200/80
                           bg-white
                           p-6
                           shadow-[0_20px_70px_-35px_rgba(0,0,0,0.2)]
                           dark:border-white/10
                           dark:bg-[#151516]
                           sm:p-8 lg:p-10">

                    {{-- FAQ heading --}}
                    <div class="mx-auto max-w-2xl text-center">

                        <span
                            class="inline-flex items-center gap-2
                                   rounded-full
                                   bg-orange-50
                                   px-4 py-2
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-orange-600
                                   dark:bg-orange-500/10
                                   dark:text-orange-400">
                            <span aria-hidden="true">?</span>
                            {{ $faqBadge }}
                        </span>


                        <h2
                            class="mt-5 text-3xl font-black
                                   tracking-tight
                                   text-slate-900
                                   sm:text-4xl
                                   dark:text-white">
                            {{ $faqTitle }}
                        </h2>

                    </div>


                    {{-- FAQ cards --}}
                    <div
                        class="mx-auto mt-10
                               grid max-w-5xl gap-4
                               md:grid-cols-2">

                        {{-- FAQ 1 --}}
                        <div
                            class="group rounded-2xl
                                   border border-slate-200
                                   bg-slate-50/70
                                   p-5
                                   transition
                                   hover:border-orange-200
                                   hover:bg-orange-50/50
                                   dark:border-white/10
                                   dark:bg-white/[0.02]
                                   dark:hover:border-orange-500/20
                                   dark:hover:bg-orange-500/5">

                            <div class="flex items-start gap-4">

                                <span
                                    class="flex h-10 w-10 shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           bg-orange-100
                                           text-lg
                                           dark:bg-orange-500/10">
                                    ⏱
                                </span>

                                <div>

                                    <h3
                                        class="font-black
                                               text-slate-900
                                               dark:text-white">
                                        {{ $supportQuestion }}
                                    </h3>

                                    <p
                                        class="mt-2 text-sm
                                               leading-6
                                               text-slate-500
                                               dark:text-slate-400">
                                        {{ $supportAnswer }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- FAQ 2 --}}
                        <div
                            class="group rounded-2xl
                                   border border-slate-200
                                   bg-slate-50/70
                                   p-5
                                   transition
                                   hover:border-orange-200
                                   hover:bg-orange-50/50
                                   dark:border-white/10
                                   dark:bg-white/[0.02]
                                   dark:hover:border-orange-500/20
                                   dark:hover:bg-orange-500/5">

                            <div class="flex items-start gap-4">

                                <span
                                    class="flex h-10 w-10 shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           bg-blue-100
                                           text-lg
                                           dark:bg-blue-500/10">
                                    📦
                                </span>

                                <div>

                                    <h3
                                        class="font-black
                                               text-slate-900
                                               dark:text-white">
                                        {{ $orderQuestion }}
                                    </h3>

                                    <p
                                        class="mt-2 text-sm
                                               leading-6
                                               text-slate-500
                                               dark:text-slate-400">
                                        {{ $orderAnswer }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- FAQ 3 --}}
                        <div
                            class="group rounded-2xl
                                   border border-slate-200
                                   bg-slate-50/70
                                   p-5
                                   transition
                                   hover:border-orange-200
                                   hover:bg-orange-50/50
                                   dark:border-white/10
                                   dark:bg-white/[0.02]
                                   dark:hover:border-orange-500/20
                                   dark:hover:bg-orange-500/5">

                            <div class="flex items-start gap-4">

                                <span
                                    class="flex h-10 w-10 shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           bg-emerald-100
                                           text-lg
                                           dark:bg-emerald-500/10">
                                    🏪
                                </span>

                                <div>

                                    <h3
                                        class="font-black
                                               text-slate-900
                                               dark:text-white">
                                        {{ $supplierQuestion }}
                                    </h3>

                                    <p
                                        class="mt-2 text-sm
                                               leading-6
                                               text-slate-500
                                               dark:text-slate-400">
                                        {{ $supplierAnswer }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- FAQ 4 --}}
                        <div
                            class="group rounded-2xl
                                   border border-slate-200
                                   bg-slate-50/70
                                   p-5
                                   transition
                                   hover:border-orange-200
                                   hover:bg-orange-50/50
                                   dark:border-white/10
                                   dark:bg-white/[0.02]
                                   dark:hover:border-orange-500/20
                                   dark:hover:bg-orange-500/5">

                            <div class="flex items-start gap-4">

                                <span
                                    class="flex h-10 w-10 shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           bg-violet-100
                                           text-lg
                                           dark:bg-violet-500/10">
                                    🤝
                                </span>

                                <div>

                                    <h3
                                        class="font-black
                                               text-slate-900
                                               dark:text-white">
                                        {{ $businessQuestion }}
                                    </h3>

                                    <p
                                        class="mt-2 text-sm
                                               leading-6
                                               text-slate-500
                                               dark:text-slate-400">
                                        {{ $businessAnswer }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- BOTTOM CTA --}}
            {{-- ========================================================= --}}

            <section class="mt-10 sm:mt-14">

                <div
                    class="relative overflow-hidden
                           rounded-[2rem]
                           bg-gradient-to-br
                           from-orange-500
                           via-orange-600
                           to-amber-500
                           p-7
                           shadow-xl
                           shadow-orange-500/15
                           sm:p-10">

                    <div
                        class="pointer-events-none absolute
                               -right-20 -top-20
                               h-56 w-56
                               rounded-full
                               bg-white/10
                               blur-2xl">
                    </div>


                    <div
                        class="relative flex flex-col
                               items-center justify-between
                               gap-6 text-center
                               md:flex-row
                               md:text-start">

                        <div>

                            <div
                                class="flex items-center
                                       justify-center gap-2
                                       md:justify-start">
                                <span aria-hidden="true">🇦🇪</span>

                                <span
                                    class="text-xs font-black
                                           uppercase
                                           tracking-widest
                                           text-orange-100">
                                    {{ $isArabic ? 'مُروَّج.كم' : 'murwaj' }}
                                </span>
                            </div>


                            <h2
                                class="mt-3 text-2xl font-black
                                       text-white sm:text-3xl">
                                {{ $isArabic ? 'نحن جاهزون لمساعدتك' : 'We are ready to help' }}
                            </h2>

                            <p
                                class="mt-2 max-w-xl
                                       text-sm leading-6
                                       text-orange-50">
                                {{ $isArabic ? 'تواصل معنا وسنبذل قصارى جهدنا لمساعدتك.' : 'Get in touch and we will do our best to help you.' }}
                            </p>

                        </div>


                        @if ($email)
                            <a href="mailto:{{ $email }}"
                                class="inline-flex min-h-[48px]
                                       shrink-0 items-center
                                       justify-center gap-2
                                       rounded-xl
                                       bg-white
                                       px-6 py-3
                                       text-sm font-black
                                       text-orange-600
                                       shadow-lg
                                       transition
                                       hover:-translate-y-0.5
                                       hover:bg-orange-50
                                       focus:outline-none
                                       focus:ring-4
                                       focus:ring-white/30">
                                ✉
                                {{ $isArabic ? 'راسلنا الآن' : 'Email Us' }}
                            </a>
                        @endif

                    </div>

                </div>

            </section>

        </main>

    </div>


    {{-- ============================================================= --}}
    {{-- FOOTER --}}
    {{-- ============================================================= --}}

    <x-main-footer />

</x-main-layout>
