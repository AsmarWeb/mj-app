<x-main-layout>

    @section('title', 'Contact Us | ' . config('app.name'))

    <x-slot name="header">
        <x-main-header />
    </x-slot>

    @php
        $setting = App\Models\Setting::first();
    @endphp

    <div class="min-h-screen bg-gray-50 dark:bg-neutral-950 transition-colors duration-300">

        {{-- Hero --}}
        <section class="relative overflow-hidden bg-gradient-to-r from-orange-500 via-orange-600 to-red-600">

            <div class="absolute inset-0 opacity-10">
                <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-white"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 rounded-full bg-white/20"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-6 py-24">

                <div class="max-w-3xl">

                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 backdrop-blur text-white font-semibold">
                        Contact Support
                    </span>

                    <h1 class="mt-6 text-5xl md:text-6xl font-black text-white">
                        We'd Love To Hear From You
                    </h1>

                    <p class="mt-6 text-lg leading-8 text-orange-100">
                        Whether you have a question about your account, marketplace orders,
                        suppliers, products, or partnerships, our team is ready to help.
                    </p>

                </div>

            </div>

        </section>

        <div class="max-w-7xl mx-auto px-6 py-16">

            <div class="grid lg:grid-cols-3 gap-10">

                {{-- Left --}}
                <div class="space-y-8">

                    <div
                        class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl border border-gray-100 dark:border-neutral-800 p-8">

                        <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-8">
                            Contact Information
                        </h2>

                        <div class="space-y-8">

                            <div class="flex gap-5">

                                <div
                                    class="w-14 h-14 rounded-2xl bg-orange-100 dark:bg-orange-500/20 flex items-center justify-center text-2xl">
                                    📍
                                </div>

                                <div>

                                    <p class="font-bold text-gray-900 dark:text-white">
                                        Address
                                    </p>

                                    <p class="mt-1 text-gray-500 dark:text-neutral-400">
                                        {{ $setting->address }}
                                    </p>

                                </div>

                            </div>

                            <div class="flex gap-5">

                                <div
                                    class="w-14 h-14 rounded-2xl bg-blue-100 dark:bg-blue-500/20 flex items-center justify-center text-2xl">
                                    📞
                                </div>

                                <div>

                                    <p class="font-bold text-gray-900 dark:text-white">
                                        Phone
                                    </p>

                                    <p class="mt-1 text-gray-500 dark:text-neutral-400">
                                        {{ $setting->phone }}
                                    </p>

                                </div>

                            </div>

                            <div class="flex gap-5">

                                <div
                                    class="w-14 h-14 rounded-2xl bg-green-100 dark:bg-green-500/20 flex items-center justify-center text-2xl">
                                    ✉️
                                </div>

                                <div>

                                    <p class="font-bold text-gray-900 dark:text-white">
                                        Email
                                    </p>

                                    <p class="mt-1 text-gray-500 dark:text-neutral-400">
                                        {{ $setting->email }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Social --}}
                    <div
                        class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl border border-gray-100 dark:border-neutral-800 p-8">

                        <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-6">
                            Follow Us
                        </h2>

                        <div class="grid grid-cols-2 gap-4">

                            <a href="{{ $setting->facebook }}"
                                class="rounded-2xl border border-gray-200 dark:border-neutral-700 bg-gray-50 dark:bg-neutral-800 hover:bg-orange-500 hover:text-white transition-all p-4 text-center font-semibold text-gray-700 dark:text-gray-200">

                                Facebook

                            </a>

                            <a href="{{ $setting->instagram }}"
                                class="rounded-2xl border border-gray-200 dark:border-neutral-700 bg-gray-50 dark:bg-neutral-800 hover:bg-orange-500 hover:text-white transition-all p-4 text-center font-semibold text-gray-700 dark:text-gray-200">

                                Instagram

                            </a>

                            <a href="{{ $setting->tiktok }}"
                                class="rounded-2xl border border-gray-200 dark:border-neutral-700 bg-gray-50 dark:bg-neutral-800 hover:bg-orange-500 hover:text-white transition-all p-4 text-center font-semibold text-gray-700 dark:text-gray-200">

                                TikTok

                            </a>

                            <a href="{{ $setting->telegram }}"
                                class="rounded-2xl border border-gray-200 dark:border-neutral-700 bg-gray-50 dark:bg-neutral-800 hover:bg-orange-500 hover:text-white transition-all p-4 text-center font-semibold text-gray-700 dark:text-gray-200">

                                Telegram

                            </a>

                        </div>

                    </div>

                </div>

                {{-- Contact Form --}}
                <div class="lg:col-span-2">

                    <div
                        class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl border border-gray-100 dark:border-neutral-800 overflow-hidden">

                        <div class="bg-gradient-to-r from-orange-500 to-red-500 p-8">

                            <h2 class="text-3xl font-black text-white">

                                Send Us a Message

                            </h2>

                            <p class="mt-2 text-orange-100">

                                Fill in the form below and we'll get back to you shortly.

                            </p>

                        </div>

                        <div class="p-8">

                            @livewire('contact-component')

                        </div>

                    </div>

                </div>

            </div>

            {{-- FAQ --}}
            <div class="mt-16">

                <div
                    class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl border border-gray-100 dark:border-neutral-800 p-10">

                    <div class="text-center">

                        <span
                            class="inline-flex px-4 py-2 rounded-full bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 font-semibold">
                            FAQ
                        </span>

                        <h2 class="mt-5 text-4xl font-black text-gray-900 dark:text-white">

                            Frequently Asked Questions

                        </h2>

                    </div>

                    <div class="grid md:grid-cols-2 gap-8 mt-12">

                        <div class="rounded-2xl border border-gray-200 dark:border-neutral-700 p-6">

                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">

                                How long does support take?

                            </h3>

                            <p class="mt-3 text-gray-500 dark:text-neutral-400">

                                Most support requests receive a reply within one business day.

                            </p>

                        </div>

                        <div class="rounded-2xl border border-gray-200 dark:border-neutral-700 p-6">

                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">

                                Need help with an order?

                            </h3>

                            <p class="mt-3 text-gray-500 dark:text-neutral-400">

                                Include your order number in your message so we can assist you faster.

                            </p>

                        </div>

                        <div class="rounded-2xl border border-gray-200 dark:border-neutral-700 p-6">

                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">

                                Want to become a supplier?

                            </h3>

                            <p class="mt-3 text-gray-500 dark:text-neutral-400">

                                Contact us to learn about joining our supplier network.

                            </p>

                        </div>

                        <div class="rounded-2xl border border-gray-200 dark:border-neutral-700 p-6">

                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">

                                Business Partnership

                            </h3>

                            <p class="mt-3 text-gray-500 dark:text-neutral-400">

                                We welcome partnerships, integrations, and business opportunities.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <x-main-footer />

</x-main-layout>
