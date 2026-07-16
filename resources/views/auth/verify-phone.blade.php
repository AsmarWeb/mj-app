<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="max-w-lg mx-auto mt-10 bg-white shadow rounded-xl p-8">

            <h1 class="text-2xl font-bold">
                Verify your phone
            </h1>

            <form method="POST" action="{{ route('phone.send') }}" class="mt-6">

                @csrf

                <input type="text" name="phone" placeholder="+971501234567" value="{{ auth()->user()->phone }}"
                    class="w-full border rounded-lg p-3">

                <button class="mt-4 w-full bg-indigo-600 text-white py-3 rounded-lg">

                    Send Code

                </button>

            </form>

            @if (session('codeSent'))
                <form action="{{ route('phone.check') }}" method="POST" class="mt-8">

                    @csrf

                    <input type="text" name="code" placeholder="123456" class="w-full border rounded-lg p-3">

                    <button class="mt-4 w-full bg-green-600 text-white py-3 rounded-lg">

                        Verify

                    </button>

                </form>
            @endif

        </div>
    </x-authentication-card>
</x-guest-layout>
