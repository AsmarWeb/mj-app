<x-main-layout>

    @section('title', __('plans.page_title'))

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    @php
        $plans = $plans ?? collect();

        $currentPlanId = $currentPlan?->id;

        $hasActiveSubscription = $subscription !== null && $currentPlan !== null;

        $isFreePlan = !$hasActiveSubscription;

        $locale = app()->getLocale();
        $isArabic = $locale === 'ar';
    @endphp

    <div dir="{{ $isArabic ? 'rtl' : 'ltr' }}" class="min-h-screen bg-[#faf8f5] text-slate-900">

        {{-- ================================================= --}}
        {{-- TOP AMBIENT BACKGROUND --}}
        {{-- ================================================= --}}

        <div class="pointer-events-none absolute inset-x-0 top-0 -z-0 h-[560px] overflow-hidden">

            <div
                class="absolute left-1/2 top-[-220px] h-[500px] w-[700px] -translate-x-1/2 rounded-full bg-orange-200/30 blur-3xl">
            </div>

            <div class="absolute right-[-150px] top-[120px] h-[350px] w-[350px] rounded-full bg-amber-200/20 blur-3xl">
            </div>

            <div class="absolute left-[-150px] top-[200px] h-[350px] w-[350px] rounded-full bg-orange-100/30 blur-3xl">
            </div>

        </div>


        {{-- ================================================= --}}
        {{-- ERROR MESSAGES --}}
        {{-- ================================================= --}}

        @if ($errors->any())

            <div class="relative z-10 mx-auto mb-6 max-w-7xl px-4 pt-8 sm:px-6 lg:px-8">

                <div class="rounded-2xl border border-red-200 bg-red-50 p-5 shadow-sm">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100 text-lg">
                            ⚠️
                        </div>

                        <div class="flex-1">

                            <h3 class="font-bold text-red-900">
                                {{ __('plans.something_went_wrong') }}
                            </h3>

                            <ul class="mt-2 space-y-1 text-sm text-red-700">

                                @foreach ($errors->all() as $error)
                                    <li class="flex gap-2">
                                        <span>•</span>
                                        <span>{{ $error }}</span>
                                    </li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        @endif


        {{-- ================================================= --}}
        {{-- SESSION ERROR --}}
        {{-- ================================================= --}}

        @if (session('error'))
            <div class="relative z-10 mx-auto mb-6 max-w-7xl px-4 pt-8 sm:px-6 lg:px-8">

                <div class="rounded-2xl border border-red-200 bg-red-50 p-5 shadow-sm">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100">
                            ⚠️
                        </div>

                        <p class="font-semibold text-red-700">
                            {{ session('error') }}
                        </p>

                    </div>

                </div>

            </div>
        @endif


        {{-- ================================================= --}}
        {{-- SESSION SUCCESS --}}
        {{-- ================================================= --}}

        @if (session('success'))
            <div class="relative z-10 mx-auto mb-6 max-w-7xl px-4 pt-8 sm:px-6 lg:px-8">

                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-5 shadow-sm">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100">
                            ✓
                        </div>

                        <p class="font-semibold text-emerald-700">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            </div>
        @endif


        {{-- ================================================= --}}
        {{-- HERO / CURRENT PLAN --}}
        {{-- ================================================= --}}

        <section class="relative z-10 mx-auto max-w-7xl px-4 pb-12 pt-10 sm:px-6 sm:pt-14 lg:px-8">

            <div
                class="relative overflow-hidden rounded-[2rem] border border-orange-200/70 bg-[#171411] shadow-2xl shadow-orange-950/10">

                <div class="absolute -right-32 -top-32 h-96 w-96 rounded-full bg-orange-500/20 blur-3xl"></div>

                <div class="absolute -bottom-40 left-1/3 h-96 w-96 rounded-full bg-amber-500/10 blur-3xl"></div>

                <div class="absolute right-16 top-16 h-32 w-32 rounded-full border border-orange-400/10"></div>

                <div class="absolute right-24 top-24 h-16 w-16 rounded-full border border-orange-400/10"></div>


                <div class="relative grid gap-10 p-7 sm:p-10 lg:grid-cols-[1fr_auto] lg:items-center lg:p-14">

                    {{-- Hero content --}}

                    <div class="text-start">

                        <div
                            class="mb-5 inline-flex items-center gap-2 rounded-full border border-orange-400/20 bg-orange-400/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-orange-300">

                            <span class="h-1.5 w-1.5 rounded-full bg-orange-400 shadow-[0_0_12px_rgba(251,146,60,0.9)]">
                            </span>

                            {{ __('plans.premium_seller_membership') }}

                        </div>


                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-orange-400">
                            {{ __('plans.your_current_plan') }}
                        </p>


                        <h1 class="mt-3 text-4xl font-black tracking-tight text-white sm:text-5xl">
                            {{ $currentPlan?->name ?? __('plans.free_plan') }}
                        </h1>


                        @if ($hasActiveSubscription)
                            <p class="mt-5 max-w-2xl text-base leading-7 text-stone-300">

                                {{ __('plans.current_plan_message', [
                                    'plan' => $currentPlan->name,
                                ]) }}

                            </p>
                        @else
                            <p class="mt-5 max-w-2xl text-base leading-7 text-stone-300">
                                {{ __('plans.free_plan_message') }}
                            </p>
                        @endif


                        <div class="mt-8 flex flex-wrap gap-x-6 gap-y-3 text-sm text-stone-300">

                            <div class="flex items-center gap-2">
                                <span class="text-orange-400">✓</span>
                                {{ __('plans.secure_payments') }}
                            </div>

                            <div class="flex items-center gap-2">
                                <span class="text-orange-400">✓</span>
                                {{ __('plans.upgrade_anytime') }}
                            </div>

                            <div class="flex items-center gap-2">
                                <span class="text-orange-400">✓</span>
                                {{ __('plans.flexible_plans') }}
                            </div>

                        </div>

                    </div>


                    {{-- Current status --}}

                    <div class="lg:min-w-[230px]">

                        <div class="rounded-3xl border border-white/10 bg-white/[0.05] p-6 backdrop-blur">

                            <div class="flex items-center justify-between">

                                <span class="text-xs font-bold uppercase tracking-[0.18em] text-stone-400">
                                    {{ __('plans.membership') }}
                                </span>

                                @if ($hasActiveSubscription)
                                    <span
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-500/10 text-emerald-400">
                                        ✓
                                    </span>
                                @else
                                    <span
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-orange-500/10 text-orange-400">
                                        ✦
                                    </span>
                                @endif

                            </div>


                            <div class="mt-5">

                                @if ($hasActiveSubscription)
                                    <div class="flex items-center gap-2 text-sm font-bold text-emerald-400">

                                        <span
                                            class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_10px_rgba(52,211,153,0.8)]">
                                        </span>

                                        {{ __('plans.active') }}

                                    </div>
                                @else
                                    <div class="text-sm font-bold text-orange-300">
                                        {{ __('plans.free_membership') }}
                                    </div>
                                @endif


                                <p class="mt-2 text-sm leading-6 text-stone-400">

                                    {{ $hasActiveSubscription ? __('plans.active_membership_message') : __('plans.choose_premium_message') }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ================================================= --}}
        {{-- PLANS INTRO --}}
        {{-- ================================================= --}}

        <section class="relative z-10 mx-auto max-w-7xl px-4 pb-10 sm:px-6 lg:px-8">

            <div class="text-center">

                <div
                    class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.25em] text-orange-600">

                    <span class="h-px w-8 bg-orange-300"></span>

                    {{ __('plans.seller_memberships') }}

                    <span class="h-px w-8 bg-orange-300"></span>

                </div>


                <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-950 sm:text-5xl">
                    {{ __('plans.invest_growth') }}
                </h2>


                <p class="mx-auto mt-4 max-w-2xl text-base leading-7 text-slate-500">
                    {{ __('plans.choose_plan_description') }}
                </p>

            </div>

        </section>


        {{-- ================================================= --}}
        {{-- PLANS --}}
        {{-- ================================================= --}}

        <section class="relative z-10 mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-7 md:grid-cols-2 xl:grid-cols-3">


                {{-- ================================================= --}}
                {{-- FREE PLAN --}}
                {{-- ================================================= --}}

                <div
                    class="group relative flex flex-col overflow-hidden rounded-[2rem] border bg-white transition duration-300
                    {{ $isFreePlan
                        ? 'border-orange-400 ring-2 ring-orange-400/20 shadow-2xl shadow-orange-100'
                        : 'border-stone-200 shadow-sm hover:-translate-y-1 hover:shadow-xl' }}">

                    @if ($isFreePlan)
                        <div
                            class="absolute right-0 top-0 rounded-bl-2xl bg-orange-500 px-5 py-2.5 text-xs font-black uppercase tracking-wider text-white shadow-lg shadow-orange-200 rtl:left-0 rtl:right-auto rtl:rounded-bl-none rtl:rounded-br-2xl">

                            ✓ {{ __('plans.current_plan') }}

                        </div>
                    @endif


                    <div class="p-8 sm:p-9">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-50 text-2xl ring-1 ring-orange-100">
                                🌱
                            </div>

                            <div>

                                <p class="text-xs font-bold uppercase tracking-[0.15em] text-stone-400">
                                    {{ __('plans.starter') }}
                                </p>

                                <h3 class="mt-1 text-2xl font-black text-slate-950">
                                    {{ __('plans.free') }}
                                </h3>

                            </div>

                        </div>


                        <div class="mt-8 flex items-end gap-2">

                            <span class="text-5xl font-black tracking-tight text-slate-950">
                                $0
                            </span>

                            <span class="mb-2 text-sm font-medium text-stone-400">
                                {{ __('plans.forever') }}
                            </span>

                        </div>


                        <p class="mt-4 min-h-[52px] text-sm leading-6 text-stone-500">
                            {{ __('plans.free_description') }}
                        </p>

                    </div>


                    <div class="flex flex-1 flex-col border-t border-stone-100 px-8 pb-8 sm:px-9 sm:pb-9">

                        <h4 class="mt-7 mb-5 text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                            {{ __('plans.included') }}
                        </h4>


                        <ul class="space-y-4 text-sm text-stone-600">

                            <li class="flex items-center gap-3">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-50 text-xs font-bold text-emerald-600">
                                    ✓
                                </span>
                                <span>{{ __('plans.one_active_product') }}</span>
                            </li>

                            <li class="flex items-center gap-3">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-50 text-xs font-bold text-emerald-600">
                                    ✓
                                </span>
                                <span>{{ __('plans.storage_100_mb') }}</span>
                            </li>

                            <li class="flex items-center gap-3">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-50 text-xs font-bold text-emerald-600">
                                    ✓
                                </span>
                                <span>{{ __('plans.listings_30_days') }}</span>
                            </li>

                            <li class="flex items-center gap-3 text-stone-400">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full bg-red-50 text-xs font-bold text-red-400">
                                    ×
                                </span>
                                <span>{{ __('plans.no_featured_listings') }}</span>
                            </li>

                            <li class="flex items-center gap-3 text-stone-400">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full bg-red-50 text-xs font-bold text-red-400">
                                    ×
                                </span>
                                <span>{{ __('plans.no_video_uploads') }}</span>
                            </li>

                        </ul>


                        <div class="mt-auto pt-9">

                            @if ($isFreePlan)
                                <button type="button" disabled
                                    class="w-full cursor-not-allowed rounded-2xl border border-orange-100 bg-orange-50 px-5 py-4 text-sm font-bold text-orange-700">

                                    ✓ {{ __('plans.you_are_on_free') }}

                                </button>
                            @else
                                <div
                                    class="w-full rounded-2xl border border-stone-200 bg-stone-50 px-5 py-4 text-center text-sm font-semibold text-stone-500">

                                    {{ __('plans.free_plan') }}

                                </div>
                            @endif

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- PAID PLANS --}}
                {{-- ================================================= --}}

                @foreach ($plans as $plan)
                    @php

                        $isCurrentPlan = $currentPlanId !== null && (int) $currentPlanId === (int) $plan->id;

                        $isUpgrade =
                            $hasActiveSubscription &&
                            $currentPlan &&
                            (float) $plan->price > (float) $currentPlan->price;

                        $isDowngrade =
                            $hasActiveSubscription &&
                            $currentPlan &&
                            (float) $plan->price < (float) $currentPlan->price;
                    @endphp


                    <div
                        class="group relative flex flex-col overflow-hidden rounded-[2rem] border bg-white transition duration-300
                        {{ $isCurrentPlan
                            ? 'border-orange-400 ring-2 ring-orange-400/20 shadow-2xl shadow-orange-100'
                            : 'border-stone-200 shadow-sm hover:-translate-y-1 hover:border-orange-200 hover:shadow-2xl hover:shadow-orange-100/60' }}">


                        {{-- PLAN BADGE --}}

                        @if ($isCurrentPlan)
                            <div
                                class="absolute right-0 top-0 z-10 rounded-bl-2xl bg-orange-500 px-5 py-2.5 text-xs font-black uppercase tracking-wider text-white shadow-lg shadow-orange-200 rtl:left-0 rtl:right-auto rtl:rounded-bl-none rtl:rounded-br-2xl">

                                ✓ {{ __('plans.current_plan') }}

                            </div>
                        @elseif ($plan->is_popular)
                            <div
                                class="absolute right-0 top-0 z-10 rounded-bl-2xl bg-gradient-to-r from-orange-500 to-amber-500 px-5 py-2.5 text-xs font-black uppercase tracking-wider text-white shadow-lg shadow-orange-200 rtl:left-0 rtl:right-auto rtl:rounded-bl-none rtl:rounded-br-2xl">

                                <span class="mr-1 rtl:mr-0 rtl:ml-1">✦</span>
                                {{ __('plans.most_popular') }}

                            </div>
                        @endif


                        {{-- PLAN HEADER --}}

                        <div class="relative p-8 sm:p-9">

                            @if ($plan->is_popular)
                                <div
                                    class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-orange-400 via-amber-400 to-orange-500">
                                </div>
                            @endif


                            <div class="flex items-center gap-4">

                                <div
                                    class="{{ $plan->is_popular
                                        ? 'bg-orange-100 text-orange-600 ring-orange-200'
                                        : 'bg-stone-100 text-stone-700 ring-stone-200' }}
                                    flex h-12 w-12 items-center justify-center rounded-2xl text-2xl ring-1">

                                    🚀

                                </div>


                                <div>

                                    <p class="text-xs font-bold uppercase tracking-[0.15em] text-stone-400">
                                        {{ $plan->is_popular ? __('plans.recommended') : __('plans.premium') }}
                                    </p>

                                    <h3 class="mt-1 text-2xl font-black text-slate-950">
                                        {{ $plan->name }}
                                    </h3>

                                </div>

                            </div>


                            <div class="mt-8 flex items-end gap-2">

                                <span class="text-5xl font-black tracking-tight text-slate-950">
                                    ${{ number_format((float) $plan->price, 2) }}
                                </span>

                                <span class="mb-2 text-sm font-medium text-stone-400">
                                    /{{ ucfirst(__("plans.periods.{$plan->billing_period}")) }}
                                </span>

                            </div>


                            <p class="mt-4 min-h-[52px] text-sm leading-6 text-stone-500">
                                {{ $plan->description ?? __('plans.default_plan_description') }}
                            </p>

                        </div>


                        {{-- FEATURES --}}

                        <div class="flex flex-1 flex-col border-t border-stone-100 px-8 pb-8 sm:px-9 sm:pb-9">

                            <h4 class="mt-7 mb-5 text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                                {{ __('plans.everything_included') }}
                            </h4>


                            <ul class="space-y-4 text-sm text-stone-600">

                                <li class="flex items-start gap-3">

                                    <span
                                        class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-orange-50 text-xs font-bold text-orange-600">
                                        ✓
                                    </span>

                                    <span>
                                        <strong class="font-bold text-slate-950">
                                            {{ $plan->listing_limit }}
                                        </strong>

                                        {{ __('plans.active_products') }}
                                    </span>

                                </li>


                                <li class="flex items-start gap-3">

                                    <span
                                        class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-orange-50 text-xs font-bold text-orange-600">
                                        ✓
                                    </span>

                                    <span>
                                        <strong class="font-bold text-slate-950">
                                            {{ $plan->storage_limit }} MB
                                        </strong>

                                        {{ __('plans.storage') }}
                                    </span>

                                </li>


                                <li class="flex items-start gap-3">

                                    <span
                                        class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-orange-50 text-xs font-bold text-orange-600">
                                        ✓
                                    </span>

                                    <span>

                                        {{ __('plans.listings_live_for') }}

                                        <strong class="font-bold text-slate-950">
                                            {{ $plan->listing_duration }}
                                            {{ __('plans.days') }}
                                        </strong>

                                    </span>

                                </li>


                                <li class="flex items-start gap-3">

                                    <span
                                        class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-orange-50 text-xs font-bold text-orange-600">
                                        ✓
                                    </span>

                                    <span>

                                        {{ __('plans.featured_listings') }}

                                        <strong class="font-bold text-slate-950">
                                            {{ $plan->featured_limit ?? __('plans.unlimited') }}
                                        </strong>

                                    </span>

                                </li>


                                <li class="flex items-start gap-3">

                                    @if ($plan->video_upload)
                                        <span
                                            class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-orange-50 text-xs font-bold text-orange-600">
                                            ✓
                                        </span>

                                        <span>
                                            {{ __('plans.video_uploads_included') }}
                                        </span>
                                    @else
                                        <span
                                            class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-red-50 text-xs font-bold text-red-400">
                                            ×
                                        </span>

                                        <span class="text-stone-400">
                                            {{ __('plans.no_video_uploads') }}
                                        </span>
                                    @endif

                                </li>

                            </ul>


                            {{-- CTA --}}

                            <div class="mt-auto pt-9">

                                @if ($isCurrentPlan)
                                    <button type="button" disabled
                                        class="w-full cursor-not-allowed rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-700">

                                        <span class="flex items-center justify-center gap-2">
                                            <span>✓</span>
                                            {{ __('plans.you_are_on_this_plan') }}
                                        </span>

                                    </button>
                                @else
                                    <form action="{{ route('subscription.checkout', ['plan' => $plan->id]) }}"
                                        method="POST">

                                        @csrf

                                        <button type="submit"
                                            class="{{ $isUpgrade
                                                ? 'bg-gradient-to-r from-orange-500 to-amber-500 shadow-lg shadow-orange-200 hover:from-orange-600 hover:to-amber-600'
                                                : 'bg-[#1c1815] shadow-lg shadow-stone-200 hover:bg-orange-600' }}
                                            group w-full rounded-2xl px-5 py-4 text-sm font-black text-white transition duration-300">

                                            <span class="flex items-center justify-center gap-2">

                                                @if (!$hasActiveSubscription)
                                                    <span>
                                                        {{ __('plans.choose_plan', ['plan' => $plan->name]) }}
                                                    </span>
                                                @elseif ($isUpgrade)
                                                    <span>
                                                        {{ __('plans.upgrade_to', ['plan' => $plan->name]) }}
                                                    </span>
                                                @elseif ($isDowngrade)
                                                    <span>
                                                        {{ __('plans.change_to', ['plan' => $plan->name]) }}
                                                    </span>
                                                @else
                                                    <span>
                                                        {{ __('plans.choose_plan', ['plan' => $plan->name]) }}
                                                    </span>
                                                @endif


                                                <span
                                                    class="transition-transform duration-200 group-hover:translate-x-1 rtl:group-hover:-translate-x-1">
                                                    →
                                                </span>

                                            </span>

                                        </button>

                                    </form>


                                    <div class="mt-4 flex items-center justify-center gap-2 text-xs text-stone-400">

                                        <span>🔒</span>

                                        @if ($isUpgrade)
                                            {{ __('plans.secure_upgrade') }}
                                        @elseif ($isDowngrade)
                                            {{ __('plans.change_anytime') }}
                                        @else
                                            {{ __('plans.secure_checkout') }}
                                        @endif

                                        <span>•</span>

                                        {{ __('plans.flexible_plans') }}

                                    </div>
                                @endif

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </section>


        {{-- ================================================= --}}
        {{-- TRUST SECTION --}}
        {{-- ================================================= --}}

        <section class="relative z-10 border-y border-stone-200/80 bg-white/70">

            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

                <div class="grid gap-8 md:grid-cols-3">


                    <div class="flex items-start gap-4">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                            🔒
                        </div>

                        <div>

                            <h3 class="font-bold text-slate-950">
                                {{ __('plans.secure_payments_title') }}
                            </h3>

                            <p class="mt-1 text-sm leading-6 text-stone-500">
                                {{ __('plans.secure_payments_description') }}
                            </p>

                        </div>

                    </div>


                    <div class="flex items-start gap-4">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                            ⚡
                        </div>

                        <div>

                            <h3 class="font-bold text-slate-950">
                                {{ __('plans.upgrade_anytime_title') }}
                            </h3>

                            <p class="mt-1 text-sm leading-6 text-stone-500">
                                {{ __('plans.upgrade_anytime_description') }}
                            </p>

                        </div>

                    </div>


                    <div class="flex items-start gap-4">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                            ✦
                        </div>

                        <div>

                            <h3 class="font-bold text-slate-950">
                                {{ __('plans.built_for_growth_title') }}
                            </h3>

                            <p class="mt-1 text-sm leading-6 text-stone-500">
                                {{ __('plans.built_for_growth_description') }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ================================================= --}}
        {{-- FINAL CTA --}}
        {{-- ================================================= --}}

        <section class="relative z-10 mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">

            <div
                class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 px-7 py-12 text-center shadow-2xl shadow-orange-200 sm:px-12">

                <div class="absolute -left-20 -top-20 h-60 w-60 rounded-full bg-white/10 blur-2xl"></div>

                <div class="absolute -bottom-24 -right-16 h-72 w-72 rounded-full bg-amber-300/20 blur-3xl"></div>


                <div class="relative">

                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl text-white ring-1 ring-white/20">
                        ✦
                    </div>


                    <h2 class="mt-6 text-3xl font-black tracking-tight text-white sm:text-4xl">
                        {{ __('plans.ready_to_grow') }}
                    </h2>


                    <p class="mx-auto mt-4 max-w-xl text-sm leading-6 text-orange-50 sm:text-base">
                        {{ __('plans.ready_to_grow_description') }}
                    </p>


                    <div
                        class="mt-7 flex flex-wrap items-center justify-center gap-x-6 gap-y-3 text-xs font-semibold text-orange-100">

                        <span>✓ {{ __('plans.secure_checkout') }}</span>
                        <span>✓ {{ __('plans.flexible_plans') }}</span>
                        <span>✓ {{ __('plans.upgrade_anytime') }}</span>

                    </div>

                </div>

            </div>

        </section>

    </div>


    <x-main-footer></x-main-footer>

</x-main-layout>
