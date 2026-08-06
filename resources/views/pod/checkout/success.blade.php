<x-app-layout>

    <div class="min-h-screen bg-gray-100 flex items-center justify-center px-6">

        <div class="bg-white rounded-3xl shadow-xl p-10 max-w-lg text-center">

            <div class="w-20 h-20 mx-auto rounded-full bg-green-100 flex items-center justify-center">

                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />

                </svg>

            </div>


            <h1 class="text-3xl font-black mt-6">
                Payment Successful 🎉
            </h1>


            <p class="text-gray-500 mt-4">
                Thank you for your order.
                Your payment has been confirmed.
            </p>


            <div class="mt-8 space-y-3">


                <a href="#" class="block bg-orange-500 text-white py-3 rounded-xl font-bold">

                    View Order

                </a>


                <a href="{{ route('home') }}" class="block bg-gray-100 py-3 rounded-xl font-bold">

                    Continue Shopping

                </a>


            </div>


        </div>

    </div>

</x-app-layout>
