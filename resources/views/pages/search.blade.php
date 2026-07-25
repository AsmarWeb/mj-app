<x-main-layout>
    @section('title', 'Search | murwaj')


    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <livewire:search-results />

    <x-main-footer></x-main-footer>
</x-main-layout>
