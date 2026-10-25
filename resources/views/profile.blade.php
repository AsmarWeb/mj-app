<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-neutral-950 py-10">

        <div class="max-w-7xl mx-auto px-4 space-y-8">


            @if (session()->has('success'))
                <div
                    class="
bg-green-100
dark:bg-green-900/30
border
border-green-300
dark:border-green-700
text-green-700
dark:text-green-300
rounded-2xl
px-5
py-4
font-semibold
">
                    {{ session('success') }}
                </div>
            @endif



            {{-- PROFILE HEADER --}}

            <div class="
bg-white
dark:bg-neutral-900
rounded-3xl
shadow-xl
overflow-hidden
">


                <div class="
h-44
bg-gradient-to-r
from-orange-500
via-red-500
to-orange-600
">
                </div>



                <div class="px-8 pb-8">


                    <div class="
-translate-y-16
flex
flex-col
md:flex-row
md:items-end
md:justify-between
gap-6
">


                        <div class="flex items-center gap-6">


                            <img src="{{ Auth::user()->profile_photo_url ?: 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                                class="
w-32
h-32
rounded-full
border-4
border-white
dark:border-neutral-900
shadow-xl
object-cover
">


                            <div>


                                <h1 class="
text-3xl
font-black
dark:text-white
">

                                    {{ auth()->user()->name }}

                                </h1>


                                <p class="
text-gray-500
dark:text-gray-400
">

                                    {{ auth()->user()->email }}

                                </p>



                                <div class="mt-3">

                                    @role('seller')
                                        <span
                                            class="
px-4
py-2
rounded-full
bg-green-100
text-green-700
font-bold
text-sm
">

                                            🏪 Seller

                                        </span>
                                    @else
                                        <span
                                            class="
px-4
py-2
rounded-full
bg-orange-100
text-orange-700
font-bold
text-sm
">

                                            🛒 Buyer

                                        </span>
                                    @endrole

                                </div>


                            </div>

                        </div>




                        <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('raslo.my-deliveries') }}" class="rounded-2xl border border-orange-300 bg-orange-50 px-6 py-3 text-sm font-bold text-orange-800 transition hover:bg-orange-100">{{ app()->getLocale()==='ar'?'توصيل طلباتي':'My deliveries' }}</a>
                        <a href="{{ route('profile.show') }}"
                            class="
bg-orange-500
hover:bg-orange-600
text-white
px-7
py-3
rounded-2xl
font-bold
shadow-lg
transition
">

                            ✏️ {{ app()->getLocale()==='ar'?'تعديل الملف الشخصي':'Edit Profile' }}

                        </a>
                        </div>



                    </div>


                </div>

            </div>





            {{-- WELCOME CARD --}}


            <div
                class="
rounded-3xl
overflow-hidden
shadow-xl
bg-gradient-to-br
from-orange-500
to-red-500
text-white
">


                <div class="p-8">


                    <div class="
flex
flex-col
lg:flex-row
gap-8
justify-between
">



                        <div class="max-w-3xl">


                            <span class="
inline-flex
px-4
py-2
rounded-full
bg-white/20
font-semibold
">

                                🎉 Welcome to {{ config('app.name') }}

                            </span>



                            <h1 class="
mt-5
text-4xl
font-black
">

                                Hello {{ auth()->user()->name }} 👋

                            </h1>



                            <p class="
mt-4
text-lg
text-white/90
">

                                Complete your account setup and unlock marketplace features,
                                create your shop, sell products and connect with customers.

                            </p>




                            <div class="mt-6 flex flex-wrap gap-3">



                                @unless (auth()->user()->hasVerifiedEmail())
                                    <a href="{{ route('verification.notice') }}"
                                        class="
px-5
py-3
rounded-xl
bg-white
text-orange-600
font-bold
">

                                        📧 Verify Email

                                    </a>
                                @endunless




                                @if (empty(auth()->user()->phone_verified_at))
                                    <a href="{{ route('phone.verify') }}"
                                        class="
px-5
py-3
rounded-xl
bg-yellow-400
text-black
font-bold
">

                                        📱 Verify Phone

                                    </a>
                                @endif





                                @unless (auth()->user()->hasRole('seller'))
                                    <a href="{{ route('shop.create', 1) }}"
                                        class="
px-5
py-3
rounded-xl
bg-black/30
font-bold
">

                                        🏪 Become Seller

                                    </a>
                                @endunless



                            </div>


                        </div>






                        {{-- CHECKLIST --}}


                        <div class="
bg-white/20
backdrop-blur
rounded-3xl
p-6
min-w-[300px]
">


                            <h3 class="
font-black
text-xl
mb-5
">

                                Account Checklist

                            </h3>



                            <div class="space-y-4">



                                <div class="flex justify-between">

                                    <span>
                                        Account Created
                                    </span>

                                    <span>
                                        ✔
                                    </span>

                                </div>




                                <div class="flex justify-between">

                                    <span>
                                        Email Verified
                                    </span>


                                    @if (auth()->user()->hasVerifiedEmail())
                                        <span>
                                            ✔
                                        </span>
                                    @else
                                        <span>
                                            Pending
                                        </span>
                                    @endif


                                </div>




                                <div class="flex justify-between">

                                    <span>
                                        Phone Verified
                                    </span>


                                    @if (auth()->user()->phone_verified_at)
                                        <span>
                                            ✔
                                        </span>
                                    @else
                                        <span>
                                            Pending
                                        </span>
                                    @endif


                                </div>





                                <div class="flex justify-between">

                                    <span>
                                        Seller Account
                                    </span>


                                    @if (auth()->user()->hasRole('seller'))
                                        <span>
                                            ✔
                                        </span>
                                    @else
                                        <span>
                                            Not Started
                                        </span>
                                    @endif


                                </div>




                            </div>


                        </div>


                    </div>


                </div>


            </div>





            @php
                $orders = \App\Models\Order::with('items')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->get();

                $paidOrders = $orders->where('payment_status', 'paid');

                $totalSpent = $paidOrders->sum('total');

                $productsPurchased = $orders->sum(function ($order) {
                    return $order->items->sum('quantity');
                });
            @endphp

            {{-- STATS --}}
            <div class="grid md:grid-cols-4 gap-6">

                <div class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl p-6">
                    <div class="text-4xl">🛍️</div>

                    <h2 class="text-3xl font-black mt-3 dark:text-white">
                        {{ $orders->count() }}
                    </h2>

                    <p class="text-gray-500">
                        Total Orders
                    </p>
                </div>

                <div class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl p-6">
                    <div class="text-4xl">📦</div>

                    <h2 class="text-3xl font-black mt-3 dark:text-white">
                        {{ $productsPurchased }}
                    </h2>

                    <p class="text-gray-500">
                        Products Purchased
                    </p>
                </div>

                <div class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl p-6">
                    <div class="text-4xl">💳</div>

                    <h2 class="text-3xl font-black mt-3 dark:text-white">
                        {{ $paidOrders->count() }}
                    </h2>

                    <p class="text-gray-500">
                        Paid Orders
                    </p>
                </div>

                <div class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl p-6">
                    <div class="text-4xl">💰</div>

                    <h2 class="text-3xl font-black mt-3 dark:text-white">
                        AED {{ number_format($totalSpent, 2) }}
                    </h2>

                    <p class="text-gray-500">
                        Total Spent
                    </p>
                </div>

            </div>

            {{-- RESUME SECTION --}}

            @php
                $resume = auth()->user()->resumes()->latest()->first();
            @endphp


            @if ($resume)
                <div class="
bg-white
dark:bg-neutral-900
rounded-3xl
shadow-xl
overflow-hidden
">


                    <div class="
bg-gradient-to-r
from-orange-500
to-red-500
p-8
text-white
">


                        <h2 class="text-3xl font-black">

                            🌐 Share Your Resume

                        </h2>


                        <p class="mt-2 text-white/90">

                            Share your professional resume with recruiters and customers.

                        </p>


                    </div>




                    <div class="p-8">


                        <label class="font-bold dark:text-white">

                            Public Resume Link

                        </label>


                        <div class="flex gap-3 mt-3">


                            <input id="resumeLink" readonly value="{{ route('resume.public', $resume->slug) }}"
                                class="
flex-1
rounded-xl
border-gray-300
dark:bg-neutral-800
dark:border-neutral-700
">


                            <button onclick="copyResumeLink()"
                                class="
px-6
rounded-xl
bg-orange-500
hover:bg-orange-600
text-white
font-bold
">

                                📋 Copy

                            </button>


                        </div>





                        <div class="mt-8 grid md:grid-cols-4 gap-4">


                            <a target="_blank"
                                href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('resume.public', $resume->slug)) }}"
                                class="
rounded-xl
bg-blue-600
text-white
py-3
text-center
font-bold
">

                                💼 LinkedIn

                            </a>



                            <a target="_blank"
                                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('resume.public', $resume->slug)) }}"
                                class="
rounded-xl
bg-blue-500
text-white
py-3
text-center
font-bold
">

                                📘 Facebook

                            </a>




                            <a target="_blank"
                                href="https://twitter.com/intent/tweet?url={{ urlencode(route('resume.public', $resume->slug)) }}"
                                class="
rounded-xl
bg-black
text-white
py-3
text-center
font-bold
">

                                ✖ X

                            </a>



                            <a target="_blank"
                                href="https://wa.me/?text={{ urlencode(route('resume.public', $resume->slug)) }}"
                                class="
rounded-xl
bg-green-500
text-white
py-3
text-center
font-bold
">

                                💬 WhatsApp

                            </a>


                        </div>


                    </div>


                </div>
            @endif







            {{-- CREATE RESUME --}}


            <div class="
bg-white
dark:bg-neutral-900
rounded-3xl
shadow-xl
p-8
">


                <div class="text-5xl">
                    📄
                </div>


                <h3 class="
text-2xl
font-black
mt-4
dark:text-white
">

                    Create Professional Resume

                </h3>



                <p class="text-gray-500 mt-3">

                    Build a modern CV and share it with employers.

                </p>



                @if (auth()->user()->resumes()->exists())
                    <a href="{{ route('resumes.edit', auth()->user()->resumes()->latest()->first()->id) }}"
                        class="
inline-block
mt-6
px-6
py-3
rounded-xl
bg-orange-500
text-white
font-bold
">

                        ✏️ Edit Resume

                    </a>
                @else
                    <a href="{{ route('resumes.create') }}"
                        class="
inline-block
mt-6
px-6
py-3
rounded-xl
bg-orange-500
text-white
font-bold
">

                        📄 Create Resume

                    </a>
                @endif


            </div>







            @role('seller')



                {{-- SELLER AREA --}}


                <div class="grid lg:grid-cols-3 gap-6">



                    <div class="
bg-white
dark:bg-neutral-900
rounded-3xl
shadow-xl
p-6
">


                        <h2 class="
text-2xl
font-black
dark:text-white
mb-5
">

                            🏪 Seller Dashboard

                        </h2>



                        <div class="space-y-4">


                            <a href="{{ route('shop', auth()->user()->shop->slug) }}"
                                class="
block
rounded-2xl
border
dark:border-neutral-700
p-5
hover:border-orange-500
transition
">


                                <h3 class="font-bold dark:text-white">

                                    My Shop

                                </h3>


                                <p class="text-sm text-gray-500">

                                    Manage your store.

                                </p>


                            </a>




                            <a href="{{ route('seller.create') }}"
                                class="
block
rounded-2xl
border
dark:border-neutral-700
p-5
hover:border-orange-500
transition
">


                                <h3 class="font-bold dark:text-white">

                                    Add Product

                                </h3>


                                <p class="text-sm text-gray-500">

                                    Publish new products.

                                </p>


                            </a>




                        </div>


                    </div>





                    <div class="
lg:col-span-2
bg-white
dark:bg-neutral-900
rounded-3xl
shadow-xl
p-6
">


                        <h2 class="
text-2xl
font-black
dark:text-white
">

                            Subscription

                        </h2>



                        @if (auth()->user()->shop?->activeSubscription)
                            <div class="
mt-5
bg-green-50
dark:bg-green-900/20
rounded-2xl
p-6
">


                                <h3 class="
text-2xl
font-black
">

                                    {{ auth()->user()->shop->activeSubscription->plan->name }}

                                </h3>


                                <div class="grid md:grid-cols-3 gap-4 mt-5">


                                    <div>
                                        <p class="text-gray-500">
                                            Products
                                        </p>

                                        <b>
                                            {{ auth()->user()->shop->activeSubscription->plan->listing_limit }}
                                        </b>

                                    </div>


                                    <div>
                                        <p class="text-gray-500">
                                            Storage
                                        </p>

                                        <b>
                                            {{ auth()->user()->shop->activeSubscription->plan->storage_limit }} MB
                                        </b>

                                    </div>


                                    <div>
                                        <p class="text-gray-500">
                                            Orders
                                        </p>

                                        <b>
                                            {{ auth()->user()->shop->activeSubscription->plan->order_limit }}
                                        </b>

                                    </div>


                                </div>


                                <a href="{{ route('plans.index') }}"
                                    class="
inline-block
mt-6
bg-orange-500
text-white
px-6
py-3
rounded-xl
font-bold
">

                                    Upgrade Plan

                                </a>


                            </div>
                        @endif


                    </div>


                </div>
            @else
                {{-- BECOME SELLER --}}


                <div class="
rounded-3xl
overflow-hidden
bg-gradient-to-br
from-orange-500
to-red-500
text-white
">


                    <div class="p-10">


                        <span class="
bg-white/20
px-4
py-2
rounded-full
">

                            Start Selling Today

                        </span>


                        <h2 class="
text-5xl
font-black
mt-6
">

                            Open your shop and reach customers.

                        </h2>


                        <p class="
mt-5
text-lg
text-white/90
">

                            Create your marketplace store and start selling products.

                        </p>



                        <div class="mt-8 flex gap-4 flex-wrap">


                            <a href="{{ route('shop.create', 1) }}"
                                class="
bg-white
text-orange-600
px-8
py-4
rounded-xl
font-black
">

                                🏪 Become Seller

                            </a>


                            <a href="{{ route('plans.index') }}"
                                class="
border
border-white
px-8
py-4
rounded-xl
font-bold
">

                                View Plans

                            </a>


                        </div>


                    </div>


                </div>






                {{-- BENEFITS --}}


                <div class="
grid
md:grid-cols-3
gap-6
">


                    <div class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl p-8">

                        <div class="text-5xl">
                            🏪
                        </div>

                        <h3 class="text-xl font-black mt-4 dark:text-white">
                            Create Shop
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Customize your store.
                        </p>

                    </div>




                    <div class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl p-8">

                        <div class="text-5xl">
                            📦
                        </div>

                        <h3 class="text-xl font-black mt-4 dark:text-white">
                            Sell Products
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Manage products easily.
                        </p>

                    </div>




                    <div class="bg-white dark:bg-neutral-900 rounded-3xl shadow-xl p-8">

                        <div class="text-5xl">
                            💰
                        </div>

                        <h3 class="text-xl font-black mt-4 dark:text-white">
                            Grow Business
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Reach more buyers.
                        </p>

                    </div>


                </div>



            @endrole



        </div>

    </div>



    <script>
        function copyResumeLink() {

            const input = document.getElementById('resumeLink');

            navigator.clipboard.writeText(input.value);

            alert('Resume link copied');

        }
    </script>



</x-app-layout>
