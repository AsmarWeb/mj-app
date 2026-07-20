<x-main-layout>

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <div class="min-h-screen py-16">


        {{-- Hero --}}
        <div class="max-w-5xl mx-auto text-center px-6">

            <span class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 font-semibold">
                🚀 Murwaj Seller Plans
            </span>


            <h1 class="mt-6 text-5xl font-bold text-slate-900 dark:text-white">
                Choose the perfect plan for your shop
            </h1>


            <p class="mt-4 text-lg text-slate-500 dark:text-slate-100">
                Start selling today and upgrade as your business grows.
            </p>


        </div>



        {{-- Plans --}}
        <div class="max-w-7xl mx-auto px-6 mt-16">


            <div class="grid gap-8 md:grid-cols-3">

                @php
                    $user = auth()->user();

                    $isFree = !$user->subscriptions()->exists();
                @endphp

                {{-- Free Plan --}}
                @if ($isFree)
                    <div
                        class="relative rounded-3xl bg-slate-100 border-2 border-dashed border-slate-300 overflow-hidden">

                        <div
                            class="absolute top-0 right-0 bg-green-600 text-white px-5 py-2 rounded-bl-2xl text-sm font-bold">
                            Current Plan
                        </div>

                        <div class="p-8">
                            <h2 class="text-3xl font-bold text-slate-900">
                                Free
                            </h2>

                            <p class="mt-2 text-gray-500">
                                Your default seller account before subscribing.
                            </p>

                            <div class="mt-6 flex items-end gap-2">
                                <span class="text-5xl font-black text-slate-900">
                                    $0
                                </span>

                                <span class="text-gray-500 mb-2">
                                    /Forever
                                </span>
                            </div>
                        </div>

                        <div class="px-8 pb-8">
                            <div class="border-t pt-6">

                                <h3 class="font-bold mb-5">
                                    Plan Features
                                </h3>

                                <ul class="space-y-4 text-sm text-slate-700">
                                    <li class="flex gap-3">
                                        <span class="text-green-600">✔</span>
                                        1 Active Product
                                    </li>

                                    <li class="flex gap-3">
                                        <span class="text-green-600">✔</span>
                                        100 MB Storage
                                    </li>

                                    <li class="flex gap-3">
                                        <span class="text-green-600">✔</span>
                                        Listings live for 30 days
                                    </li>

                                    <li class="flex gap-3">
                                        <span class="text-red-500">✖</span>
                                        No Featured Listings
                                    </li>

                                    <li class="flex gap-3">
                                        <span class="text-red-500">✖</span>
                                        No Video Uploads
                                    </li>
                                </ul>
                            </div>

                            <button disabled
                                class="mt-8 w-full py-4 rounded-2xl font-bold bg-gray-300 text-gray-600 cursor-not-allowed">
                                Your Current Plan
                            </button>
                        </div>

                    </div>
                @endif


                @foreach ($plans as $plan)
                    <div
                        class="
                    relative 
                    rounded-3xl 
                    bg-white 
                    border 
                    overflow-hidden
                    shadow-sm 
                    hover:shadow-2xl 
                    transition
                    {{ $plan->is_popular ? 'ring-2 ring-indigo-600' : '' }}
                    ">


                        {{-- Popular Badge --}}
                        @if ($plan->is_popular)
                            <div
                                class="
                            absolute 
                            top-0 
                            right-0
                            bg-gradient-to-r 
                            from-indigo-600 
                            to-purple-600
                            text-white
                            px-5
                            py-2
                            rounded-bl-2xl
                            text-sm
                            font-bold
                            ">

                                ⭐ Most Popular

                            </div>
                        @endif



                        {{-- Header --}}
                        <div class="p-8">


                            <h2 class="text-3xl font-bold text-slate-900">
                                {{ $plan->name }}
                            </h2>


                            <p class="mt-2 text-gray-500">
                                {{ $plan->description ?? 'Perfect plan for growing your business.' }}
                            </p>



                            <div class="mt-6 flex items-end gap-2">


                                <span class="text-5xl font-black text-slate-900">

                                    ${{ number_format($plan->price, 2) }}

                                </span>


                                <span class="text-gray-500 mb-2">

                                    /{{ ucfirst($plan->billing_period) }}

                                </span>


                            </div>



                        </div>



                        {{-- Features --}}
                        <div class="px-8 pb-8">


                            <div class="border-t pt-6">


                                <h3 class="font-bold mb-5">
                                    Plan Features
                                </h3>



                                <ul class="space-y-4 text-sm text-slate-700">


                                    <li class="flex gap-3">
                                        <span class="text-green-600">✔</span>
                                        {{ $plan->listing_limit }} Active Products
                                    </li>


                                    <li class="flex gap-3">
                                        <span class="text-green-600">✔</span>
                                        {{ $plan->storage_limit }} MB Storage
                                    </li>


                                    <li class="flex gap-3">
                                        <span class="text-green-600">✔</span>
                                        Listings live {{ $plan->listing_duration }} days
                                    </li>


                                    <li class="flex gap-3">
                                        <span class="text-green-600">✔</span>

                                        Featured Listings:
                                        <b>
                                            {{ $plan->featured_limit ?? 'Unlimited' }}
                                        </b>

                                    </li>



                                    <li class="flex gap-3">

                                        @if ($plan->video_upload)
                                            <span class="text-green-600">✔</span>
                                            Video Uploads Included
                                        @else
                                            <span class="text-red-500">✖</span>
                                            No Video Uploads
                                        @endif

                                    </li>



                                </ul>


                            </div>




                            {{-- Button --}}

                            <form action="{{ route('subscription.checkout', $plan) }}" method="POST" class="mt-8">


                                @csrf


                                <button
                                    class="
                                w-full
                                py-4
                                rounded-2xl
                                font-bold
                                transition

                                {{ $plan->is_popular
                                    ? 'bg-indigo-600 hover:bg-indigo-700 text-white'
                                    : 'bg-slate-900 hover:bg-black text-white' }}
                                ">


                                    Subscribe Now 🚀


                                </button>




                            </form>


                        </div>


                    </div>
                @endforeach


            </div>


        </div>


    </div>

    <x-main-footer></x-main-footer>
</x-main-layout>
