<x-main-layout>

    <div class="grid md:grid-cols-3 gap-6">

        @foreach ($plans as $plan)
            <div class="border rounded-lg p-6">

                <h2 class="text-xl font-bold">
                    {{ $plan->name }}
                </h2>

                <p class="text-2xl font-bold">
                    ${{ $plan->price }}
                    /
                    {{ $plan->billing_period }}
                </p>


                <ul class="mt-4">

                    <li>
                        {{ $plan->listing_limit }}
                        Products
                    </li>

                    <li>
                        {{ $plan->storage_limit }} MB Storage
                    </li>

                </ul>


                <form action="{{ route('subscription.checkout', $plan) }}" method="POST">

                    @csrf

                    <button class="bg-blue-600 text-white px-5 py-2 rounded">
                        Subscribe
                    </button>

                </form>


            </div>
        @endforeach

    </div>
</x-main-layout>
