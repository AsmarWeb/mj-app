<x-main-layout>

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-lg w-full bg-white rounded-2xl shadow-xl p-10 text-center">

            <!-- Success Icon -->
            <div class="mx-auto flex items-center justify-center w-20 h-20 rounded-full bg-green-100">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="mt-6 text-3xl font-bold text-gray-900">
                Subscription Successful!
            </h1>

            <p class="mt-4 text-gray-600 leading-relaxed">
                Thank you for subscribing. Your seller plan has been activated successfully.
                You can now enjoy all the features included in your subscription.
            </p>

            <div class="mt-8 rounded-xl bg-gray-50 border p-6 text-left">
                <h3 class="font-semibold text-gray-900 mb-3">
                    What's next?
                </h3>

                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-center gap-3">
                        ✅ Publish more products
                    </li>

                    <li class="flex items-center gap-3">
                        ✅ Access premium seller features
                    </li>

                    <li class="flex items-center gap-3">
                        ✅ Manage your orders and inventory
                    </li>

                    <li class="flex items-center gap-3">
                        ✅ Grow your shop with your new plan
                    </li>
                </ul>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">

                <a href="{{ route('dashboard') }}"
                    class="px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition">
                    Go to Dashboard
                </a>

                <a href="#"
                    class="px-6 py-3 rounded-lg border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold transition">
                    Add New Product
                </a>

            </div>

        </div>
    </div>

</x-main-layout>
