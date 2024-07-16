<x-main-layout>
    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <div class="font-sans leading-normal tracking-normal">

        <!-- Hero section -->
        <section class="py-20">
            <div class="container mx-auto px-4">
                <div class="max-w-2xl mx-auto text-center">
                    <h1 class="text-4xl font-bold mb-6 dark:text-white">We're launching soon</h1>
                    <p class="text-gray-600 mb-12 dark:text-gray-400">Enter your email to be the first to know when we
                        launch.</p>
                    <form class="max-w-md mx-auto">
                        <div class="flex items-center">
                            <input type="email"
                                class="bg-gray-100 mr-3 py-2 px-4 w-full rounded-md focus:outline-none focus:bg-white"
                                placeholder="Enter your email">
                            <button type="submit"
                                class="bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Features section -->
        <section class="py-20">
            <div class="container mx-auto px-4">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="text-3xl font-bold mb-6 dark:text-white">What to expect</h2>
                    <p class="text-gray-600 mb-12 dark:text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Duis nec
                        orci
                        quis justo aliquam euismod eget a leo. Sed eget orci feugiat, porttitor nibh vel, faucibus
                        mauris.
                    </p>
                </div>
                <div class="flex flex-wrap -mx-4 mt-12">
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="rounded-md bg-white shadow-md p-8">
                            <div class="text-4xl font-bold text-purple-600 mb-4">01</div>
                            <h3 class="text-2xl font-bold mb-4">Feature 1</h3>
                            <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                nec
                                orci quis justo aliquam euismod eget a leo.</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="rounded-md bg-white shadow-md p-8">
                            <div class="text-4xl font-bold text-purple-600 mb-4">02</div>
                            <h3 class="text-2xl font-bold mb-4">Feature 2</h3>
                            <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                nec
                                orci quis justo aliquam euismod eget a leo.</p>
                        </div>
                    </div>

                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="rounded-md bg-white shadow-md p-8">
                            <div class="text-4xl font-bold text-purple-600 mb-4">03</div>
                            <h3 class="text-2xl font-bold mb-4">Feature 3</h3>
                            <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                nec
                                orci quis justo aliquam euismod eget a leo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <x-main-footer></x-main-footer>
</x-main-layout>
