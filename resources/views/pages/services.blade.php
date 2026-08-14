@php
    $isArabic = app()->getLocale() === 'ar';
    $direction = $isArabic ? 'rtl' : 'ltr';
    $textAlign = $isArabic ? 'text-right' : 'text-left';
@endphp

<x-main-layout>

    @section('title', $isArabic ? 'الخدمات | مُروَّج.كم' : 'Services | Murwaj.com')
    @section('description',
        $isArabic
        ? 'اكتشف الخدمات المتاحة على مُروَّج.كم.'
        : 'Discover the services available on
        Murwaj.com.')

        <x-slot name="header">
            <x-main-header></x-main-header>
        </x-slot>


        <div dir="{{ $direction }}"
            class="container relative mx-auto mt-5 flex h-full max-w-6xl flex-col justify-between px-6 py-10 xl:px-0">

            {{-- Page Header --}}
            <div class="{{ $textAlign }}">

                <h2 class="mb-1 text-3xl font-extrabold leading-tight text-gray-900 dark:text-white">
                    {{ __('services.main.title') }}
                </h2>

                <p class="mb-12 text-lg text-gray-500 dark:text-gray-400">
                    {{ __('services.main.subtitle') }}
                </p>

            </div>


            {{-- Services --}}
            <div class="w-full">
                <livewire:service.service-section />
            </div>

        </div>


        <x-main-footer></x-main-footer>

    </x-main-layout>
