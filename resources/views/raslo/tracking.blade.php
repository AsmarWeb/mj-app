@php
    $ar=app()->getLocale()==='ar';
    $t=fn($a,$e)=>$ar?$a:$e;
    $s=$order->rasloShipment;
    $stateLabel=fn($value)=>\App\Services\Raslo\RasloStatus::label($value);
@endphp
<x-app-layout>
<main dir="{{ $ar?'rtl':'ltr' }}" data-raslo-tracking data-status-url="{{ route('raslo.tracking', $order) }}" class="mx-auto max-w-2xl px-4 py-10 text-gray-900 dark:text-gray-100">
    <h1 class="text-3xl font-bold">{{ $ar?'توصيل طلبك':'Your delivery' }}</h1>
    <div class="mt-5 space-y-4 rounded-2xl border border-gray-300 bg-white p-6 dark:bg-gray-900">
        <p>{{ $order->order_number }}</p>
        <p>{{ $ar?'حالة الدفع':'Payment status' }}: {{ $order->payment_status }}</p>
        <p>{{ $ar?'حالة التوصيل':'Delivery status' }}: <strong data-delivery-status role="status">{{ $stateLabel($s?->delivery_status ?: $s?->state) }}</strong></p>
        <p>{{ $t('رقم التتبع','Tracking number') }}: <span data-tracking-number>{{ $s?->tracking_number ?: '—' }}</span></p>
        @php($link=app(\App\Services\Raslo\RasloEndpoint::class)->tracking($s?->tracking_url))
        <a data-tracking-link href="{{ $link ?: '#' }}" @if(!$link) hidden @endif rel="noreferrer noopener" target="_blank" class="inline-block rounded-xl bg-orange-700 px-5 py-3 text-white">{{ $t('تتبع مع رسلو','Track with Raslo') }}</a>
        <p class="text-sm text-slate-600">{{ $t('آخر تحديث بتوقيت الإمارات','Last update · UAE time') }}: <span data-tracking-updated>{{ $s?->updated_at?->timezone('Asia/Dubai')->format('Y-m-d H:i') ?: '—' }}</span></p>
        <p class="text-sm">{{ $t('تُحدَّث الصفحة تلقائيًا عند وصول حالة جديدة. قد تستغرق المزامنة الدورية خمس دقائق.','This page refreshes automatically as new statuses arrive. Periodic synchronization may take five minutes.') }}</p>
        <p data-tracking-error role="status" hidden class="text-sm text-orange-800">{{ $t('تعذر تحديث العرض الآن؛ آخر حالة محفوظة ظاهرة. ستتم إعادة المحاولة تلقائيًا.','Could not refresh now; your last saved status is shown. Retrying automatically.') }}</p>
        <a href="{{ route('raslo.tracking',$order) }}" class="inline-block text-sm font-bold text-orange-700 underline">{{ $t('تحديث الآن','Refresh now') }}</a>
        <p class="text-sm">{{ $ar?'حالة التوصيل مستقلة عن الدفع. إلغاء الطلب أو استرداده لا يلغي التوصيل تلقائيًا؛ تواصل مع المتجر.':'Delivery status is separate from payment. Cancelling or refunding an order does not automatically cancel delivery; contact the store.' }}</p>
    </div>
</main>
</x-app-layout>
