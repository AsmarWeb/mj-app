@php
    $isArabic = app()->getLocale() === 'ar';

    /*
    |--------------------------------------------------------------------------
    | Localized content
    |--------------------------------------------------------------------------
    */

    $page = App\Models\Page::find(1);

    $title = $isArabic ? $page->title_ar ?? $page->title : $page->title;

    $shortDescription = $isArabic ? $page->short_des_ar ?? $page->short_des : $page->short_des;

    $subtitle = $isArabic ? $page->subtitle_ar ?? $page->subtitle : $page->subtitle;

    $content = $isArabic ? $page->content_ar ?? $page->content : $page->content;

    $createdBy = $isArabic ? $page->created_by_ar ?? $page->created_by : $page->created_by;
@endphp


<x-main-layout>

    {{-- ============================================================= --}}
    {{-- SEO --}}
    {{-- ============================================================= --}}

    @section('title', $getPage->meta_title ?? $title)

    @section('meta_description', $getPage->meta_description ?? $shortDescription)

    @section('meta_keywords', $getPage->meta_keywords ?? 'UAE, الإمارات, مُروَّج.كم, murwaj, marketplace, متجر, تسوق')


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
               dark:bg-[#0b0b0c]
               dark:text-white">

        {{-- ========================================================= --}}
        {{-- HERO --}}
        {{-- ========================================================= --}}

        <section class="relative overflow-hidden">

            {{-- Background decoration --}}
            <div
                class="pointer-events-none absolute -right-32 -top-32
                       h-96 w-96 rounded-full
                       bg-orange-300/20 blur-3xl
                       dark:bg-orange-500/10">
            </div>

            <div
                class="pointer-events-none absolute -bottom-40 -left-32
                       h-[28rem] w-[28rem] rounded-full
                       bg-amber-300/20 blur-3xl
                       dark:bg-amber-500/10">
            </div>


            <div
                class="relative mx-auto max-w-7xl
                       px-4 pb-8 pt-8
                       sm:px-6 sm:pt-12
                       lg:px-8 lg:pt-16">

                {{-- UAE badge --}}
                <div
                    class="mx-auto flex w-fit items-center gap-2
                           rounded-full
                           border border-orange-200/80
                           bg-orange-50
                           px-4 py-2
                           text-xs font-black
                           text-orange-700
                           shadow-sm
                           dark:border-orange-500/20
                           dark:bg-orange-500/10
                           dark:text-orange-400">
                    <span aria-hidden="true">🇦🇪</span>

                    <span>
                        {{ $isArabic ? 'من الإمارات إلى العالم' : 'From the UAE to the world' }}
                    </span>
                </div>


                {{-- Main heading --}}
                <div class="mx-auto mt-6 max-w-4xl text-center">

                    <h1
                        class="text-3xl font-black tracking-tight
                               text-slate-950
                               sm:text-4xl
                               lg:text-5xl
                               dark:text-white">
                        {{ $title }}
                    </h1>

                    @if ($shortDescription)
                        <p
                            class="mx-auto mt-5 max-w-2xl
                                   text-sm leading-7
                                   text-slate-500
                                   sm:text-base sm:leading-8
                                   dark:text-slate-400">
                            {{ $shortDescription }}
                        </p>
                    @endif

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- MAIN CONTENT --}}
        {{-- ========================================================= --}}

        <main
            class="relative mx-auto max-w-7xl
                   px-4 pb-16
                   sm:px-6 sm:pb-20
                   lg:px-8">

            <div
                class="overflow-hidden rounded-[2rem]
                       border border-slate-200/80
                       bg-white
                       shadow-[0_25px_80px_-40px_rgba(0,0,0,0.3)]
                       dark:border-white/10
                       dark:bg-[#151516]">

                {{-- ================================================= --}}
                {{-- CONTENT --}}
                {{-- ================================================= --}}

                <div class="grid lg:grid-cols-12">

                    {{-- ================================================= --}}
                    {{-- TEXT --}}
                    {{-- ================================================= --}}

                    <article
                        class="lg:col-span-7
                               p-6 sm:p-8
                               lg:p-12">

                        {{-- Small label --}}
                        <div class="mb-5 flex items-center gap-3">

                            <span
                                class="flex h-10 w-10 items-center justify-center
                                       rounded-xl
                                       bg-gradient-to-br
                                       from-orange-500
                                       to-amber-500
                                       text-lg text-white
                                       shadow-lg
                                       shadow-orange-500/20"
                                aria-hidden="true">
                                ✦
                            </span>

                            <span
                                class="text-xs font-black uppercase
                                       tracking-[0.18em]
                                       text-orange-600
                                       dark:text-orange-400">
                                {{ $isArabic ? 'عن مُروَّج.كم' : 'About murwaj' }}
                            </span>

                        </div>


                        {{-- Subtitle --}}
                        @if ($subtitle)
                            <h2
                                class="text-2xl font-black
                                       leading-tight
                                       text-slate-950
                                       sm:text-3xl
                                       dark:text-white">
                                {{ $subtitle }}
                            </h2>
                        @endif


                        {{-- Content --}}
                        @if ($content)
                            <div
                                class="prose prose-slate mt-7 max-w-none
                                       text-sm leading-8
                                       prose-headings:font-black
                                       prose-headings:text-slate-900
                                       prose-a:text-orange-600
                                       prose-a:no-underline
                                       hover:prose-a:underline
                                       prose-strong:text-slate-900
                                       dark:prose-invert
                                       dark:prose-headings:text-white
                                       dark:prose-strong:text-white
                                       dark:prose-a:text-orange-400">
                                {!! $content !!}
                            </div>
                        @endif


                        {{-- ================================================= --}}
                        {{-- UAE VALUES --}}
                        {{-- ================================================= --}}

                        <div class="mt-10 grid gap-3
                                   sm:grid-cols-3">

                            {{-- Trust --}}
                            <div
                                class="rounded-2xl
                                       border border-slate-200
                                       bg-slate-50
                                       p-4
                                       dark:border-white/10
                                       dark:bg-white/[0.03]">
                                <div class="text-xl" aria-hidden="true">
                                    🤝
                                </div>

                                <h3
                                    class="mt-3 text-sm font-black
                                           text-slate-900
                                           dark:text-white">
                                    {{ $isArabic ? 'ثقة' : 'Trust' }}
                                </h3>

                                <p
                                    class="mt-1 text-xs leading-5
                                           text-slate-500
                                           dark:text-slate-400">
                                    {{ $isArabic ? 'تجربة موثوقة للمستخدمين والبائعين.' : 'A trusted experience for buyers and sellers.' }}
                                </p>
                            </div>


                            {{-- Community --}}
                            <div
                                class="rounded-2xl
                                       border border-slate-200
                                       bg-slate-50
                                       p-4
                                       dark:border-white/10
                                       dark:bg-white/[0.03]">
                                <div class="text-xl" aria-hidden="true">
                                    🇦🇪
                                </div>

                                <h3
                                    class="mt-3 text-sm font-black
                                           text-slate-900
                                           dark:text-white">
                                    {{ $isArabic ? 'مجتمع' : 'Community' }}
                                </h3>

                                <p
                                    class="mt-1 text-xs leading-5
                                           text-slate-500
                                           dark:text-slate-400">
                                    {{ $isArabic ? 'نبني مجتمعاً رقمياً نابضاً في الإمارات.' : 'Building a vibrant digital community in the UAE.' }}
                                </p>
                            </div>


                            {{-- Simplicity --}}
                            <div
                                class="rounded-2xl
                                       border border-slate-200
                                       bg-slate-50
                                       p-4
                                       dark:border-white/10
                                       dark:bg-white/[0.03]">
                                <div class="text-xl" aria-hidden="true">
                                    ✨
                                </div>

                                <h3
                                    class="mt-3 text-sm font-black
                                           text-slate-900
                                           dark:text-white">
                                    {{ $isArabic ? 'سهولة' : 'Simplicity' }}
                                </h3>

                                <p
                                    class="mt-1 text-xs leading-5
                                           text-slate-500
                                           dark:text-slate-400">
                                    {{ $isArabic ? 'تجربة بسيطة وسريعة للجميع.' : 'A simple and fast experience for everyone.' }}
                                </p>
                            </div>

                        </div>

                    </article>


                    {{-- ================================================= --}}
                    {{-- IMAGE / VISUAL --}}
                    {{-- ================================================= --}}

                    <aside
                        class="relative min-h-[320px]
                               overflow-hidden
                               bg-gradient-to-br
                               from-orange-500
                               via-orange-600
                               to-amber-500
                               lg:col-span-5
                               lg:min-h-full">

                        @if ($page?->image)
                            <img src="{{ asset($page->image) }}" alt="{{ $title }}" loading="lazy"
                                class="absolute inset-0 h-full w-full
                                       object-cover" />

                            {{-- Image overlay --}}
                            <div
                                class="absolute inset-0
                                       bg-gradient-to-t
                                       from-black/65
                                       via-black/10
                                       to-transparent">
                            </div>
                        @else
                            {{-- Fallback visual --}}
                            <div
                                class="absolute inset-0
                                       flex items-center justify-center">

                                <div
                                    class="absolute h-72 w-72
                                           rounded-full
                                           border border-white/20">
                                </div>

                                <div
                                    class="absolute h-52 w-52
                                           rounded-full
                                           border border-white/20">
                                </div>

                                <div
                                    class="relative flex h-28 w-28
                                           items-center justify-center
                                           rounded-[2rem]
                                           bg-white/15
                                           text-6xl text-white
                                           shadow-2xl
                                           backdrop-blur-md">
                                    ✦
                                </div>

                            </div>
                        @endif


                        {{-- Visual text --}}
                        <div class="absolute bottom-0 left-0 right-0
                                   p-6 sm:p-8">

                            <div
                                class="inline-flex items-center gap-2
                                       rounded-full
                                       border border-white/20
                                       bg-black/20
                                       px-3 py-1.5
                                       text-xs font-bold
                                       text-white
                                       backdrop-blur-md">
                                <span aria-hidden="true">🇦🇪</span>

                                {{ $isArabic ? 'صنع في الإمارات' : 'Made for the UAE' }}
                            </div>


                            <p
                                class="mt-4 max-w-sm
                                       text-lg font-black
                                       leading-7 text-white
                                       sm:text-xl">
                                {{ $isArabic ? 'تسوق، بع، واكتشف المزيد مع مُروَّج.كم' : 'Shop, sell and discover more with murwaj.' }}
                            </p>

                        </div>

                    </aside>

                </div>


                {{-- ================================================= --}}
                {{-- FOOTER / AUTHOR --}}
                {{-- ================================================= --}}

                <div
                    class="border-t border-slate-200/80
                           bg-slate-50/70
                           px-6 py-6
                           dark:border-white/10
                           dark:bg-white/[0.02]
                           sm:px-8
                           lg:px-12">

                    <div
                        class="flex flex-col items-center
                               justify-between gap-4
                               text-center
                               sm:flex-row
                               sm:text-start">

                        <div>

                            <p
                                class="text-xs font-semibold
                                       text-slate-400
                                       dark:text-slate-500">
                                {{ $createdBy }}
                            </p>

                            <div
                                class="mt-1 text-sm
                                       text-slate-500
                                       dark:text-slate-400">

                                {{ __('about.by') }}

                                <a href="{{ route('developer.index') }}" target="_blank" rel="noopener noreferrer"
                                    class="font-bold
                                           text-orange-600
                                           underline
                                           decoration-orange-300
                                           underline-offset-4
                                           transition
                                           hover:text-orange-700
                                           dark:text-orange-400
                                           dark:hover:text-orange-300">
                                    {{ $page->developer }}
                                </a>

                            </div>

                        </div>


                        {{-- Brand --}}
                        <div class="flex items-center gap-2">

                            <span
                                class="flex h-9 w-9 items-center
                                       justify-center
                                       rounded-xl
                                       bg-gradient-to-br
                                       from-orange-500
                                       to-amber-500
                                       text-white
                                       shadow-md"
                                aria-hidden="true">
                                ✦
                            </span>

                            <div class="text-start">
                                <div
                                    class="text-sm font-black
                                           text-slate-900
                                           dark:text-white">
                                    {{ $isArabic ? 'مُروَّج.كم' : 'murwaj' }}
                                </div>

                                <div class="text-[10px]
                                           text-slate-400">
                                    UAE
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>


    {{-- ============================================================= --}}
    {{-- FOOTER --}}
    {{-- ============================================================= --}}

    <x-main-footer />

</x-main-layout>
