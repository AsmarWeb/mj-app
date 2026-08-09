<x-app-layout>

    <div class="min-h-screen bg-[#fbf8f3] text-[#211a15]">


        {{-- ========================================================= --}}
        {{-- PREMIUM HEADER --}}
        {{-- ========================================================= --}}

        <header class="sticky top-0 z-50 border-b border-[#eadfd3]/80 bg-[#fffdf9]/95 backdrop-blur-xl">

            <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 sm:px-6 lg:px-8">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-2xl
                       bg-gradient-to-br from-[#f97316] to-[#c2410c]
                       text-lg font-black text-white
                       shadow-lg shadow-orange-200">

                        S

                    </div>

                    <div>
                        <h1 class="text-xl font-black tracking-tight text-[#211a15] sm:text-2xl">
                            ShopBuilder
                        </h1>

                        <p class="hidden text-xs font-medium text-[#8c7b6d] sm:block">
                            Build something worth discovering
                        </p>
                    </div>

                </div>


                <div
                    class="hidden items-center gap-2 rounded-full border border-[#eadfd3]
                    bg-white px-4 py-2 text-sm font-semibold text-[#6f6258] md:flex">

                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                    Your shop is almost ready

                </div>

            </div>

        </header>


        {{-- ========================================================= --}}
        {{-- HERO --}}
        {{-- ========================================================= --}}

        <section class="relative overflow-hidden">

            <div class="absolute -left-32 top-20 h-72 w-72 rounded-full bg-orange-200/30 blur-3xl"></div>

            <div class="absolute -right-32 top-10 h-80 w-80 rounded-full bg-amber-200/30 blur-3xl"></div>


            <div class="relative mx-auto max-w-7xl px-5 pb-12 pt-14 sm:px-6 sm:pt-20 lg:px-8">

                <div class="grid items-center gap-12 lg:grid-cols-[1.05fr_.95fr] lg:gap-20">


                    {{-- Hero Content --}}

                    <div>

                        <div
                            class="inline-flex items-center gap-2 rounded-full
                           border border-orange-200 bg-orange-50
                           px-4 py-2 text-sm font-bold text-orange-700">

                            <span class="text-base">✦</span>

                            Create your shop

                        </div>


                        <h2
                            class="mt-6 max-w-3xl text-4xl font-black leading-[1.05]
                           tracking-tight text-[#211a15]
                           sm:text-5xl lg:text-6xl">

                            Your brand deserves
                            <span
                                class="bg-gradient-to-r from-[#f97316] via-[#ea580c] to-[#c2410c]
                               bg-clip-text text-transparent">

                                a beautiful home.

                            </span>

                        </h2>


                        <p
                            class="mt-6 max-w-xl text-base leading-7 text-[#75685d]
                           sm:text-lg">

                            Create a professional storefront in just a few simple steps.
                            Tell your story, showcase your products, and start building
                            something customers will remember.

                        </p>


                        {{-- Trust indicators --}}

                        <div class="mt-8 flex flex-wrap gap-3">

                            <div
                                class="inline-flex items-center gap-2 rounded-full
                               border border-[#e8ddd1] bg-white px-4 py-2
                               text-sm font-semibold text-[#66584d]
                               shadow-sm">

                                <span class="text-orange-600">✓</span>
                                Easy setup

                            </div>

                            <div
                                class="inline-flex items-center gap-2 rounded-full
                               border border-[#e8ddd1] bg-white px-4 py-2
                               text-sm font-semibold text-[#66584d]
                               shadow-sm">

                                <span class="text-orange-600">✓</span>
                                No technical skills

                            </div>

                            <div
                                class="inline-flex items-center gap-2 rounded-full
                               border border-[#e8ddd1] bg-white px-4 py-2
                               text-sm font-semibold text-[#66584d]
                               shadow-sm">

                                <span class="text-orange-600">✓</span>
                                Start selling faster

                            </div>

                        </div>


                        {{-- Stats --}}

                        <div class="mt-10 grid max-w-xl grid-cols-3 border-y border-[#e8ddd1] py-6">

                            <div class="pr-4">

                                <p class="text-2xl font-black text-[#211a15] sm:text-3xl">
                                    10K+
                                </p>

                                <p class="mt-1 text-xs font-medium text-[#8c7b6d] sm:text-sm">
                                    Active buyers
                                </p>

                            </div>


                            <div class="border-l border-[#e8ddd1] px-4">

                                <p class="text-2xl font-black text-[#211a15] sm:text-3xl">
                                    24/7
                                </p>

                                <p class="mt-1 text-xs font-medium text-[#8c7b6d] sm:text-sm">
                                    Store access
                                </p>

                            </div>


                            <div class="border-l border-[#e8ddd1] pl-4">

                                <p class="text-2xl font-black text-[#211a15] sm:text-3xl">
                                    0%
                                </p>

                                <p class="mt-1 text-xs font-medium text-[#8c7b6d] sm:text-sm">
                                    Setup fee
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Premium Preview Card --}}

                    <div class="relative">

                        <div
                            class="absolute -inset-4 rounded-[2.5rem]
                           bg-gradient-to-br from-orange-200/40 to-amber-100/20
                           blur-2xl">
                        </div>


                        <div
                            class="relative overflow-hidden rounded-[2rem]
                           border border-white/80 bg-white p-3
                           shadow-[0_25px_80px_-25px_rgba(120,53,15,0.25)]">

                            <div
                                class="overflow-hidden rounded-[1.5rem]
                               bg-gradient-to-br from-[#fff4e8]
                               via-[#fffaf4] to-[#fef1df]">

                                {{-- Fake storefront header --}}

                                <div class="flex items-center justify-between border-b border-orange-100/80 px-5 py-4">

                                    <div class="flex items-center gap-2">

                                        <div
                                            class="flex h-9 w-9 items-center justify-center
                                           rounded-xl bg-orange-500 text-sm font-black text-white">

                                            S

                                        </div>

                                        <div class="h-3 w-20 rounded-full bg-[#d9c5b2]"></div>

                                    </div>

                                    <div class="flex gap-2">

                                        <div class="h-8 w-8 rounded-full bg-white/80"></div>
                                        <div class="h-8 w-8 rounded-full bg-white/80"></div>

                                    </div>

                                </div>


                                {{-- Store preview --}}

                                <div class="p-6 sm:p-8">

                                    <div
                                        class="flex aspect-[4/3] items-center justify-center
                                       rounded-[1.5rem]
                                       border border-orange-100
                                       bg-gradient-to-br
                                       from-orange-100 via-amber-50 to-white">

                                        <div class="text-center">

                                            <div
                                                class="mx-auto flex h-20 w-20 items-center
                                               justify-center rounded-3xl
                                               bg-white text-4xl
                                               shadow-xl shadow-orange-100">

                                                🛍️

                                            </div>

                                            <h3 class="mt-5 text-xl font-black text-[#2a211b] sm:text-2xl">
                                                Your shop starts here
                                            </h3>

                                            <p class="mt-2 text-sm text-[#8b796a]">
                                                Your story. Your products. Your brand.
                                            </p>

                                        </div>

                                    </div>


                                    <div class="mt-5 grid grid-cols-3 gap-3">

                                        <div class="h-20 rounded-2xl bg-white shadow-sm"></div>
                                        <div class="h-20 rounded-2xl bg-white shadow-sm"></div>
                                        <div class="h-20 rounded-2xl bg-white shadow-sm"></div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Floating badge --}}

                        <div
                            class="absolute -bottom-5 -left-3 hidden rounded-2xl
                           border border-[#eadfd3] bg-white px-4 py-3
                           shadow-xl shadow-orange-100 sm:block">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 items-center justify-center
                                   rounded-xl bg-emerald-50 text-emerald-600">

                                    ✓

                                </div>

                                <div>

                                    <p class="text-xs font-bold text-[#3a2e27]">
                                        Ready to grow
                                    </p>

                                    <p class="text-[11px] text-[#918174]">
                                        Your storefront awaits
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- CREATION WORKSPACE --}}
        {{-- ========================================================= --}}

        <section class="mx-auto max-w-6xl px-5 pb-20 sm:px-6 lg:px-8">

            <div
                class="overflow-hidden rounded-[2rem]
               border border-[#e9ddd0] bg-white
               shadow-[0_20px_60px_-30px_rgba(68,42,20,0.25)]">


                {{-- Workspace Header --}}

                <div
                    class="border-b border-[#eee4da]
                   bg-gradient-to-r from-white to-[#fffaf5]
                   px-6 py-6 sm:px-8">

                    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

                        <div>

                            <p class="text-xs font-black uppercase tracking-[0.18em] text-orange-600">
                                Build your storefront
                            </p>

                            <h3 class="mt-1 text-2xl font-black text-[#211a15]">
                                Let's create your shop
                            </h3>

                            <p class="mt-1 text-sm text-[#827468]">
                                A few details are all we need to get you started.
                            </p>

                        </div>


                        <div
                            class="inline-flex w-fit items-center gap-2 rounded-full
                           bg-orange-50 px-4 py-2 text-xs font-bold text-orange-700">

                            <span class="h-2 w-2 rounded-full bg-orange-500"></span>

                            Step {{ $step }} of 4

                        </div>

                    </div>

                </div>


                {{-- Progress Steps --}}

                <div class="px-6 py-7 sm:px-8">

                    <div class="relative">

                        <div
                            class="absolute left-[10%] right-[10%] top-5 hidden h-px
                           bg-[#e9ddd0] md:block">
                        </div>


                        <div class="absolute left-[10%] top-5 hidden h-px
                           bg-gradient-to-r from-orange-500 to-amber-400
                           transition-all duration-500 md:block"
                            style="width: {{ max(0, (($step - 1) / 3) * 80) }}%;">
                        </div>


                        <div class="relative grid grid-cols-4 gap-2">

                            @foreach (['Shop Name', 'Description', 'Logo', 'Finish'] as $index => $name)
                                @php
                                    $stepNumber = $index + 1;
                                    $isCompleted = $step >= $stepNumber;
                                    $isCurrent = $step === $stepNumber;
                                @endphp

                                <div class="flex flex-col items-center text-center">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full
                                border-4 border-white text-sm font-black transition-all duration-300
                                {{ $isCompleted
                                    ? 'bg-gradient-to-br from-orange-500 to-orange-700 text-white shadow-lg shadow-orange-200'
                                    : 'bg-[#f5eee7] text-[#a69687]' }}
                                {{ $isCurrent ? 'ring-4 ring-orange-100' : '' }}">

                                        @if ($step > $stepNumber)
                                            ✓
                                        @else
                                            {{ $stepNumber }}
                                        @endif

                                    </div>


                                    <span
                                        class="mt-3 hidden text-xs font-bold sm:block
                                {{ $isCurrent ? 'text-orange-700' : 'text-[#88796d]' }}">

                                        {{ $name }}

                                    </span>

                                </div>
                            @endforeach

                        </div>

                    </div>

                </div>


                {{-- Form --}}

                <form action="{{ route('shop.create', $step) }}" method="POST" enctype="multipart/form-data">

                    @csrf


                    <div class="border-t border-[#eee4da] px-6 py-8 sm:px-8 sm:py-10">

                        <div class="mx-auto max-w-3xl">

                            @switch($step)
                                @case(1)
                                    @include('shop.step.name')
                                @break

                                @case(2)
                                    @include('shop.step.description')
                                @break

                                @case(3)
                                    @include('shop.step.logo')
                                @break

                                @case(4)
                                    @include('shop.step.finish')
                                @break
                            @endswitch

                        </div>

                    </div>


                    {{-- Form Actions --}}

                    <div
                        class="flex flex-col-reverse gap-3 border-t border-[#eee4da]
                       bg-[#fffaf5] px-6 py-5 sm:flex-row sm:items-center
                       sm:justify-between sm:px-8">

                        @if ($step > 1)
                            <a href="{{ route('shop.create', $step - 1) }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl
                               border border-[#ded1c4] bg-white px-6 py-3
                               text-sm font-bold text-[#66584d]
                               transition hover:border-orange-300 hover:bg-orange-50
                               hover:text-orange-700">

                                ← Back

                            </a>
                        @else
                            <div class="hidden sm:block"></div>
                        @endif


                        <button type="submit"
                            class="group inline-flex items-center justify-center gap-3
                           rounded-xl bg-gradient-to-r from-[#f97316] to-[#c2410c]
                           px-8 py-3.5 text-sm font-black text-white
                           shadow-lg shadow-orange-200
                           transition duration-200
                           hover:-translate-y-0.5 hover:from-[#ea580c]
                           hover:to-[#9a3412] hover:shadow-xl hover:shadow-orange-200
                           focus:outline-none focus:ring-4 focus:ring-orange-200">

                            {{ $step == 4 ? 'Open My Shop' : 'Continue' }}

                            <span class="transition-transform duration-200 group-hover:translate-x-1">
                                {{ $step == 4 ? '🎉' : '→' }}
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- BENEFITS --}}
        {{-- ========================================================= --}}

        <section class="border-y border-[#eadfd3] bg-[#fffaf5]">

            <div class="mx-auto max-w-6xl px-5 py-16 sm:px-6 lg:px-8">

                <div class="mx-auto max-w-2xl text-center">

                    <p class="text-xs font-black uppercase tracking-[0.2em] text-orange-600">
                        Everything you need
                    </p>

                    <h2 class="mt-3 text-3xl font-black tracking-tight text-[#211a15] sm:text-4xl">
                        Built to help your shop grow
                    </h2>

                    <p class="mt-3 text-[#827468]">
                        We've kept the process simple so you can focus on what matters:
                        your products and your customers.
                    </p>

                </div>


                <div class="mt-10 grid gap-5 md:grid-cols-3">


                    {{-- Benefit 1 --}}

                    <div
                        class="group rounded-3xl border border-[#eadfd3] bg-white p-7
                       shadow-sm transition duration-300
                       hover:-translate-y-1 hover:border-orange-200
                       hover:shadow-xl hover:shadow-orange-100/60">

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl
                           bg-orange-50 text-2xl transition
                           group-hover:bg-orange-500 group-hover:scale-105">

                            🌎

                        </div>

                        <h3 class="mt-6 text-lg font-black text-[#211a15]">
                            Reach more customers
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-[#827468]">
                            Put your products in front of buyers and give your brand
                            a professional storefront they can trust.
                        </p>

                    </div>


                    {{-- Benefit 2 --}}

                    <div
                        class="group rounded-3xl border border-[#eadfd3] bg-white p-7
                       shadow-sm transition duration-300
                       hover:-translate-y-1 hover:border-orange-200
                       hover:shadow-xl hover:shadow-orange-100/60">

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl
                           bg-orange-50 text-2xl transition
                           group-hover:bg-orange-500 group-hover:scale-105">

                            📦

                        </div>

                        <h3 class="mt-6 text-lg font-black text-[#211a15]">
                            Manage your products
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-[#827468]">
                            Add beautiful product listings, images, prices and inventory
                            from one simple storefront.
                        </p>

                    </div>


                    {{-- Benefit 3 --}}

                    <div
                        class="group rounded-3xl border border-[#eadfd3] bg-white p-7
                       shadow-sm transition duration-300
                       hover:-translate-y-1 hover:border-orange-200
                       hover:shadow-xl hover:shadow-orange-100/60">

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl
                           bg-orange-50 text-2xl transition
                           group-hover:bg-orange-500 group-hover:scale-105">

                            💳

                        </div>

                        <h3 class="mt-6 text-lg font-black text-[#211a15]">
                            Sell with confidence
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-[#827468]">
                            Give customers a polished buying experience with secure
                            payments and a storefront built for trust.
                        </p>

                    </div>

                </div>


                {{-- Trust Footer --}}

                <div
                    class="mt-8 flex flex-col items-center justify-center gap-3
                   rounded-2xl border border-[#eadfd3] bg-white px-6 py-5
                   text-center sm:flex-row">

                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-full
                       bg-emerald-50 text-emerald-600">

                        ✓

                    </div>

                    <p class="text-sm font-semibold text-[#66584d]">
                        Your information is handled securely and your shop remains under your control.
                    </p>

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- FINAL CTA --}}
        {{-- ========================================================= --}}

        <section class="relative overflow-hidden bg-[#211a15]">

            <div class="absolute -left-20 -top-20 h-64 w-64 rounded-full bg-orange-500/10 blur-3xl"></div>

            <div class="absolute -bottom-20 -right-20 h-64 w-64 rounded-full bg-orange-400/10 blur-3xl"></div>


            <div class="relative mx-auto max-w-4xl px-5 py-16 text-center sm:px-6">

                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center
                   rounded-2xl bg-orange-500 text-2xl shadow-xl shadow-orange-950/40">

                    ✦

                </div>

                <h2 class="mt-6 text-3xl font-black tracking-tight text-white sm:text-4xl">
                    Your next chapter starts here.
                </h2>

                <p class="mx-auto mt-4 max-w-xl text-sm leading-6 text-[#c9b9aa] sm:text-base">
                    Create your shop, showcase what you love, and start building
                    a business you're proud of.
                </p>

            </div>

        </section>

    </div>



</x-app-layout>
