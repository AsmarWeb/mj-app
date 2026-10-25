@php
    $ar=app()->getLocale()==='ar';
    $t=fn($a,$e)=>$ar?$a:$e;
    $s=$order->rasloShipment;
    $states=['awaiting_payment'=>['بانتظار الدفع','Awaiting payment'],'pending'=>['بانتظار الإرسال','Queued'],
        'retry'=>['ستتم إعادة المحاولة','Retry scheduled'],'processing'=>['قيد الإرسال','Sending'],'sent'=>['تم الربط','Connected'],
        'review'=>['يحتاج مراجعة','Needs attention'],'pending_pricing'=>['بانتظار التسعير','Awaiting pricing'],
        'priced'=>['بانتظار الموافقة على السعر','Awaiting price approval'],'accepted'=>['تم قبول السعر','Price approved'],
        'assigned'=>['تم تعيين السائق','Driver assigned'],'picked_up'=>['تم الاستلام','Picked up'],'in_transit'=>['في الطريق','In transit'],
        'delivered'=>['تم التسليم','Delivered'],'completed'=>['اكتمل التوصيل','Completed'],'cancelled'=>['ملغي','Cancelled'],
        'delivery_failed'=>['تعذر التوصيل','Delivery unsuccessful'],'rescheduled'=>['أعيدت الجدولة','Rescheduled']];
    $stateLabel=fn($value)=>$states[$value][$ar?0:1]??str_replace('_',' ',(string)$value);
@endphp
<x-app-layout>
<main dir="{{ $ar?'rtl':'ltr' }}" class="mx-auto max-w-2xl px-4 py-10 text-gray-900 dark:text-gray-100">
    <h1 class="text-3xl font-bold">{{ $ar?'توصيل طلبك':'Your delivery' }}</h1>
    <div class="mt-5 space-y-4 rounded-2xl border border-gray-300 bg-white p-6 dark:bg-gray-900">
        <p>{{ $order->order_number }}</p>
        <p>{{ $ar?'حالة الدفع':'Payment status' }}: {{ $order->payment_status }}</p>
        <p>{{ $ar?'حالة التوصيل':'Delivery status' }}: {{ $s?->delivery_status?$stateLabel($s->delivery_status):($ar?'لم يتم إنشاء توصيل بعد':'No delivery created yet') }}</p>
        @if($s?->tracking_number)<p>{{ $ar?'رقم التتبع':'Tracking number' }}: {{ $s->tracking_number }}</p>@endif
        @if($s && ($link=app(\App\Services\Raslo\RasloEndpoint::class)->tracking($s->tracking_url)))
            <a href="{{ $link }}" rel="noreferrer noopener" target="_blank" class="inline-block rounded-xl bg-orange-600 px-5 py-3 text-white">{{ $ar?'تتبع مع رسلو':'Track with Raslo' }}</a>
        @endif
        <p class="text-sm">{{ $ar?'حالة التوصيل مستقلة عن الدفع. إلغاء الطلب أو استرداده لا يلغي التوصيل تلقائيًا؛ تواصل مع المتجر.':'Delivery status is separate from payment. Cancelling or refunding an order does not automatically cancel delivery; contact the store.' }}</p>
    </div>
</main>
</x-app-layout>
