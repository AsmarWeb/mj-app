<x-guest-layout>

    <x-authentication-card>

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>


        <x-validation-errors class="mb-4" />


        <div class="mb-6 text-center">

            <h2 class="text-2xl font-bold text-gray-800">
                Welcome {{ $supplier->name }}
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Activate your supplier account and create your password.
            </p>

        </div>



        <form method="POST" action="{{ route('supplier.invitation.store', ['token' => $supplier->invite_token]) }}">

            @csrf



            <div>

                <x-label for="email" value="Email" />


                <x-input id="email" class="block mt-1 w-full bg-gray-100" type="email"
                    value="{{ $supplier->email }}" disabled />

            </div>




            <div class="mt-4">

                <x-label for="password" value="Password" />


                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autofocus
                    autocomplete="new-password" />

            </div>




            <div class="mt-4">

                <x-label for="password_confirmation" value="Confirm Password" />


                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

            </div>





            <div class="flex items-center justify-end mt-6">


                <x-button>

                    Activate Supplier Account

                </x-button>


            </div>



        </form>


    </x-authentication-card>


</x-guest-layout>
