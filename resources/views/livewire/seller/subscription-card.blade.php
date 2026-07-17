<div class="bg-white rounded-xl shadow p-5">

    <h3 class="text-lg font-bold mb-4">
        Your Subscription
    </h3>


    @if ($subscription)

        <div class="space-y-3">

            <div>
                <span class="text-gray-500">
                    Plan:
                </span>

                <span class="font-semibold">
                    {{ $subscription->plan->name }}
                </span>
            </div>


            <div>
                <span class="text-gray-500">
                    Products:
                </span>

                <span class="font-semibold">

                    {{ auth()->user()->shop->listings()->count() }}

                    /

                    {{ $subscription->plan->listing_limit }}

                </span>
            </div>


            @if ($subscription->ends_at)
                <div>

                    <span class="text-gray-500">
                        Expires:
                    </span>

                    <span>
                        {{ $subscription->ends_at->format('M d, Y') }}
                    </span>

                </div>
            @endif


            <div class="w-full bg-gray-200 rounded-full h-2">

                @php

                    $used = auth()->user()->shop->listings()->count();

                    $limit = $subscription->plan->listing_limit;

                    $percent = $limit > 0 ? ($used / $limit) * 100 : 0;

                @endphp


                <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ min($percent, 100) }}%">
                </div>

            </div>

        </div>
    @else
        <p class="text-red-500">
            No active subscription
        </p>

    @endif

</div>
