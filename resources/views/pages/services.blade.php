<x-main-layout>
    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <div class="container relative flex flex-col justify-between h-full max-w-6xl px-6 py-10 mx-auto xl:px-0 mt-5">
        <h2 class="mb-1 text-3xl font-extrabold leading-tight text-gray-900 dark:text-white">Services</h2>
        <p class="mb-12 text-lg text-gray-500">Here is a few of the awesome Services we provide.</p>
        <div class="w-full">
            <livewire:service.service-section />
        </div>
    </div>
    <!-- source:https://tailwind.besoeasy.com -->

    <x-main-footer></x-main-footer>
</x-main-layout>
