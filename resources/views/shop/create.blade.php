<x-main-layout>
    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <div class="font-sans leading-normal tracking-normal">

        <!-- Hero section -->
        <section class="py-20">
            <div class="container mx-auto px-4">
                <div class="max-w-2xl mx-auto text-center">
                    <h1 class="text-4xl font-bold mb-6 dark:text-white">{{ __('create.main.title') }}</h1>
                    <p class="text-gray-600 mb-12 dark:text-gray-400">
                        {{ __('create.main.subtitle') }}
                    </p>
                    <livewire:newsletter.subscribe />
                </div>
            </div>
        </section>

        <!-- Features section -->
        <section class="py-20">
            <div class="container mx-auto px-4">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="text-3xl font-bold mb-6 dark:text-white">{{ __('create.expect.title') }}</h2>
                    <p class="text-gray-600 mb-12 dark:text-gray-400">
                        {{ __('create.expect.subtitle') }}
                    </p>
                </div>
                <livewire:feature.features-section />
            </div>
        </section>
    </div>

    <x-main-footer></x-main-footer>
</x-main-layout>
