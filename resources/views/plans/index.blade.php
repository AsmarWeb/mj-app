<x-main-layout>

    <div class="grid gap-8 md:grid-cols-3">

        @foreach ($plans as $plan)
            <div class="relative rounded-2xl border bg-white p-8 shadow-sm hover:shadow-lg transition">

                @if ($plan->is_popular)
                    <span
                        class="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full bg-blue-600 px-4 py-1 text-xs font-semibold text-white">
                        Most Popular
                    </span>
                @endif

                <h2 class="text-2xl font-bold">
                    {{ $plan->name }}
                </h2>

                <p class="mt-3 text-4xl font-bold">
                    ${{ number_format($plan->price, 2) }}
                </p>

                <p class="text-gray-500">
                    per {{ ucfirst($plan->billing_period) }}
                </p>

                <hr class="my-6">

                <ul class="space-y-3 text-sm">

                    <li>✔ {{ $plan->listing_limit }} Active Products</li>

                    <li>✔ {{ $plan->storage_limit }} MB Image Storage</li>

                    <li>✔ Listings live for {{ $plan->listing_duration }} days</li>

                    <li>✔ Featured Listings:
                        {{ $plan->featured_limit ?? 'Unlimited' }}
                    </li>

                    <li>✔ Product Images:
                        {{ $plan->image_limit ?? 'Unlimited' }}
                    </li>

                    <li>✔ Video Uploads:
                        {{ $plan->video_upload ? 'Yes' : 'No' }}
                    </li>

                    <li>✔ Customer Chat:
                        {{ $plan->live_chat ? 'Included' : 'Not Included' }}
                    </li>

                    <li>✔ Analytics Dashboard:
                        {{ $plan->analytics ? 'Included' : 'Basic' }}
                    </li>

                    <li>✔ Priority Search Ranking:
                        {{ $plan->priority_listing ? 'Yes' : 'No' }}
                    </li>

                    <li>✔ Coupon Creation:
                        {{ $plan->coupon_limit ?? 'No Coupons' }}
                    </li>

                    <li>✔ Team Members:
                        {{ $plan->staff_limit ?? 1 }}
                    </li>

                    <li>✔ Support:
                        {{ $plan->support_level }}
                    </li>

                </ul>

                <form action="{{ route('subscription.checkout', $plan) }}" method="POST" class="mt-8">

                    @csrf

                    <button class="w-full rounded-lg bg-blue-600 py-3 font-semibold text-white hover:bg-blue-700">
                        Subscribe
                    </button>

                </form>

            </div>
        @endforeach

    </div>
</x-main-layout>
