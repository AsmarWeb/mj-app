<x-guest-layout>

    <x-authentication-card>

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>


        <div class="w-full max-w-md mx-auto">

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-8">


                <div class="text-center mb-8">

                    <div
                        class="mx-auto w-16 h-16 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">

                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />

                        </svg>

                    </div>


                    <h1 class="mt-5 text-2xl font-bold text-gray-900 dark:text-white">
                        Verify your phone number
                    </h1>


                    <p class="mt-2 text-gray-500 dark:text-gray-400">
                        We will send a verification code by SMS.
                    </p>

                </div>



                {{-- Success --}}
                @if (session('success'))
                    <div class="mb-5 rounded-xl bg-green-100 text-green-700 px-4 py-3">
                        {{ session('success') }}
                    </div>
                @endif



                {{-- Errors --}}
                @if ($errors->any())

                    <div class="mb-5 rounded-xl bg-red-100 text-red-700 px-4 py-3">

                        <ul class="list-disc list-inside">

                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach

                        </ul>

                    </div>

                @endif





                {{-- Send SMS --}}
                <form method="POST" action="{{ route('phone.send') }}">

                    @csrf


                    <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-200">

                        Phone Number

                    </label>


                    <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                        placeholder="+971501234567"
                        class="w-full rounded-xl border-gray-300 
                        dark:bg-gray-700 dark:border-gray-600 
                        dark:text-white p-3">


                    <button
                        class="mt-5 w-full rounded-xl bg-indigo-600 
                        hover:bg-indigo-700 text-white font-semibold py-3">

                        Send Verification Code

                    </button>


                </form>





                {{-- Show Code Input after SMS sent --}}
                @if (session('codeSent') || session('success') || old('code'))
                    <div class="border-t dark:border-gray-700 my-8"></div>


                    <form method="POST" action="{{ route('phone.check') }}">

                        @csrf


                        <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-200">

                            Verification Code

                        </label>


                        <input type="text" name="code" maxlength="6" value="{{ old('code') }}"
                            placeholder="123456"
                            class="w-full rounded-xl border-gray-300
                            dark:bg-gray-700 dark:border-gray-600
                            dark:text-white text-center
                            text-xl tracking-widest p-3">


                        <button
                            class="mt-5 w-full rounded-xl bg-green-600 
                            hover:bg-green-700 text-white font-semibold py-3">

                            Verify Phone

                        </button>


                    </form>
                @endif


            </div>

        </div>


    </x-authentication-card>

</x-guest-layout>
