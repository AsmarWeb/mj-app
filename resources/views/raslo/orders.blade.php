@php($ar=app()->getLocale()==='ar')
<x-app-layout>
<main dir="{{ $ar?'rtl':'ltr' }}" class="mx-auto max-w-3xl px-4 py-10 text-gray-900 dark:text-gray-100">
    <h1 class="mb-5 text-3xl font-bold">{{ $ar?'توصيل طلباتي':'My deliveries' }}</h1>
    <div class="space-y-4">
        @forelse($orders as $order)
            <article class="rounded-2xl border border-gray-300 bg-white p-5 dark:bg-gray-900">
                <p class="font-bold">{{ $order->order_number }}</p>
                @if($order->rasloShipment->tracking_number)<p class="my-2">{{ $order->rasloShipment->tracking_number }}</p>@endif
                <a class="mt-3 inline-block text-orange-600" href="{{ route('raslo.tracking',$order) }}">{{ $ar?'عرض حالة التوصيل':'View delivery status' }}</a>
            </article>
        @empty<p>{{ $ar?'لا توجد طلبات توصيل بعد.':'No deliveries yet.' }}</p>@endforelse
    </div>
    <div class="mt-5">{{ $orders->links() }}</div>
</main>
</x-app-layout>
