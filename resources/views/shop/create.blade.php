<x-app-layout>

    {{-- <div class="font-sans leading-normal tracking-normal">

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
    </div> --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>

</x-app-layout>
