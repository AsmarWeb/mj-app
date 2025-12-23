<x-main-layout>
    @section('title', 'Home | Murwaj')
    @section('description', "$description")
    @section('keywords', "$keywords")


    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>
    <section>
        <x-main-hero></x-main-hero>
    </section>
    {{-- <section>
        <x-main-category></x-main-category>
        <x-main-featured></x-main-featured>
        <x-main-recomend></x-main-recomend>
        <x-main-section></x-main-section>
        <x-main-city></x-main-city>
        <x-main-intro></x-main-intro>
        <x-main-blog></x-main-blog>
    </section> --}}
    <x-main-footer></x-main-footer>
</x-main-layout>
