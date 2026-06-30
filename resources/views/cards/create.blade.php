<x-main-layout>
    @section('title', 'Business Card | Murwaj')
    @section('description', 'Create your business card and download it as a PDF file.')
    @section('keywords', 'business card, pdf, download, create, generate')


    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <div class="max-w-xl mx-auto p-6">

        <form method="POST" action="/business-card">

            @csrf


            <input class="w-full border p-3 mb-3 rounded" name="name" placeholder="Your name">


            <input class="w-full border p-3 mb-3 rounded" name="company" placeholder="Company">


            <input class="w-full border p-3 mb-3 rounded" name="job_title" placeholder="Job title">


            <input class="w-full border p-3 mb-3 rounded" name="phone" placeholder="Phone">


            <input class="w-full border p-3 mb-3 rounded" name="email" placeholder="Email">


            <input class="w-full border p-3 mb-3 rounded" name="website" placeholder="Website">


            <textarea class="w-full border p-3 mb-3 rounded" name="address" placeholder="Address"></textarea>


            <input type="color" name="color" value="#2563eb">


            <button class="bg-blue-600 text-white px-6 py-3 rounded">
                Generate PDF
            </button>


        </form>

    </div>
    <x-main-footer></x-main-footer>
</x-main-layout>
