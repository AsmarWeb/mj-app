@php
    $ar=app()->getLocale()==='ar';
    $t=fn($a,$e)=>$ar?$a:$e;
    $stateLabel=fn($value)=>\App\Services\Raslo\RasloStatus::label($value);
@endphp
<x-app-layout>
<main dir="{{ $ar?'rtl':'ltr' }}" class="mx-auto max-w-5xl px-4 py-10 text-gray-900 dark:text-gray-100">
    <a href="{{ route('dashboard') }}" class="text-orange-600">{{ $t('لوحة المتجر','Store dashboard') }}</a>
    <h1 class="mt-4 text-3xl font-bold">{{ $t('توصيل رسلو','Raslo delivery') }} · {{ $shop->name }}</h1>
    <p class="my-4">{{ $t('فعّل الربط لإرسال طلبات المنتجات المادية الجديدة المحدد لها شحن رسلو تلقائيًا بعد الدفع داخل الإمارات.','Enable automatic delivery forwarding for new paid physical UAE orders whose products use Raslo shipping.') }}</p>
    @if(session('success'))<p role="status" class="my-4 rounded-xl bg-green-100 p-4 text-green-900">{{ session('success') }}</p>@endif
    @if($errors->any())<div role="alert" class="my-4 rounded-xl bg-red-100 p-4 text-red-900">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
    <section class="my-6 rounded-2xl border border-gray-300 bg-white p-6 dark:bg-gray-900">
        <h2 class="mb-3 text-xl font-bold">{{ $t('إعداد الربط','Connection settings') }}</h2>
        <p class="mb-4 text-sm">{{ $t('من رسلو: متاجري والتكاملات ← اتصال مستقل لهذا المتجر ← ربط طلبات التوصيل. اختر عنوان الاستلام وانسخ مفتاح Delivery API.','In Raslo: My stores & integrations → a dedicated connection for this store → Delivery-order integration. Set pickup and copy the Delivery API key.') }}</p>
        @if($connection)<p class="mb-4">{{ $t('رقم اتصال رسلو','Raslo connection') }}: {{ $connection->remote_id }} · {{ $connection->enabled?$t('مفعّل','Enabled'):$t('متوقف','Disabled') }}</p>@endif
        <form method="POST" action="{{ route('raslo.settings.update') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="enabled" value="0">
            <label class="flex gap-3"><input type="checkbox" name="enabled" value="1" @checked($connection?->enabled)><span>{{ $t('إرسال الطلبات الجديدة تلقائيًا','Automatically forward new orders') }}</span></label>
            <label class="block">{{ $t('مفتاح Delivery API','Delivery API key') }}<input type="password" name="api_key" autocomplete="new-password" maxlength="100" class="mt-2 w-full rounded-xl border-gray-300 bg-transparent" placeholder="{{ $connection?$t('محفوظ؛ اتركه فارغًا للاحتفاظ به','Saved; leave blank to keep it'):'raslo_delivery_…' }}"></label>
            <label class="block">{{ $t('سر توقيع تحديث الحالة (اختياري)','Status signing secret (optional)') }}<input type="password" name="webhook_secret" autocomplete="new-password" maxlength="64" class="mt-2 w-full rounded-xl border-gray-300 bg-transparent" placeholder="{{ $connection?->webhook_secret?$t('محفوظ','Saved'):'' }}"></label>
            <button class="rounded-xl bg-orange-600 px-5 py-3 font-bold text-white">{{ $t('تحقق واحفظ','Verify and save') }}</button>
        </form>
        @if($connection)
            <label class="mt-5 block">{{ $t('رابط استقبال تحديثات رسلو','Raslo callback URL') }}<input readonly value="{{ route('raslo.events',$connection->public_id) }}" class="mt-2 w-full rounded-xl border-gray-300 bg-transparent text-sm" dir="ltr"></label>
            <p class="mt-2 text-sm">{{ $t('أضف هذا المسار إلى اتصال رسلو على نطاق متجرك HTTPS. تعمل متابعة الحالة دوريًا حتى بدون رابط الاستقبال.','Add this path to your Raslo connection on your HTTPS store domain. Periodic status checks also work without callbacks.') }}</p>
        @endif
        <p class="mt-4 text-sm">{{ $t('سعر رسلو مستقل عن المبلغ المحصّل من العميل؛ راجع السعر ووافق عليه داخل رسلو قبل إسناد السائق.','Raslo’s fee is separate from the customer charge. Review and approve it in Raslo before driver assignment.') }}</p>
    </section>
    <section class="mb-8 rounded-2xl bg-emerald-50 p-6 text-emerald-950">
        <h2 class="text-xl font-bold">{{ $t('كيف يعمل التوصيل؟','How delivery works') }}</h2>
        <ol class="mt-4 list-inside list-decimal space-y-3 text-sm leading-6">
            <li>{{ $t('تحقق من الربط، ثم اختر «رسلو» في طريقة شحن المنتجات الجديدة أو عند تعديل المنتجات الحالية. لا نغيّر منتجاتك القديمة تلقائيًا.','Verify the connection, then select Raslo on new or existing products. Existing products are not changed automatically.') }}</li>
            <li>{{ $t('بعد تأكيد الدفع، تتم جدولة الإرسال تلقائيًا خلال دقيقة عند تشغيل العامل والمجدول. إعادة المحاولة لا تنشئ توصيلًا مكررًا.','After payment confirmation, forwarding is scheduled within a minute when the worker and scheduler run. Retries reuse the same delivery request.') }}</li>
            <li>{{ $t('راجع السعر ووافق عليه داخل رسلو. رسوم التوصيل لا تُضاف تلقائيًا إلى دفع العميل في هذا الإصدار.','Review and approve pricing in Raslo. Delivery fees are not automatically added to customer checkout in this release.') }}</li>
            <li>{{ $t('تصل تحديثات الحالة عبر Webhook أو الفحص الدوري كل خمس دقائق. اكتمال التوصيل لا يغيّر حالة دفع الطلب.','Status updates arrive through webhooks or five-minute polling. Delivery completion does not change the order’s payment status.') }}</li>
        </ol>
    </section>
    <h2 class="mb-3 text-2xl font-bold">{{ $t('طلبات المتجر والتوصيل','Store orders and deliveries') }}</h2>
    <div class="space-y-4">
        @forelse($orders as $order)
            @php($shipment=$order->rasloShipment)
            <article class="rounded-xl border border-gray-300 bg-white p-5 dark:bg-gray-900">
                <p class="font-bold">{{ $order->order_number }} · {{ $order->payment_status }}</p>
                @if($shipment)
                    <p class="mt-2">{{ $t('الإرسال','Forwarding') }}: {{ $stateLabel($shipment->state) }} · {{ $t('حالة التوصيل','Delivery status') }}: {{ $shipment->delivery_status?$stateLabel($shipment->delivery_status):'—' }}</p>
                    @if($shipment->delivery_fee!==null)<p>{{ $t('سعر رسلو','Raslo fee') }}: {{ $shipment->delivery_fee }} AED</p>@endif
                    @if($shipment->requires_price_approval && $shipment->remote_id)<p>{{ $t('راجع الموافقة على السعر داخل رسلو.','Review price approval in Raslo.') }}</p>@endif
                    @if($shipment->error_code)<p class="mt-2 text-red-700">{{ $shipment->error_code }} · {{ $t('راجع تفعيل الربط وصلاحية المفتاح واشتراك Enterprise. أعد المحاولة بعد التصحيح.','Check activation, key validity and Enterprise access. Retry after correcting the issue.') }}</p>@endif
                    <a class="mt-3 inline-block text-orange-600" href="{{ route('raslo.tracking',$order) }}">{{ $t('تفاصيل التوصيل','Delivery details') }}</a>
                @endif
                @if($order->isPaid() && $order->status==='processing' && $order->checkout_currency==='AED' && (($order->shipping_address['shipping_method'] ?? 'Raslo') === 'Raslo') && (!$shipment || (!$shipment->remote_id && $shipment->state!=='processing')))
                    <form class="mt-3" method="POST" action="{{ route('raslo.retry',$order) }}">@csrf<button class="rounded-lg border border-orange-500 px-4 py-3">{{ $shipment?$t('إعادة محاولة الإرسال','Retry forwarding'):$t('إرسال هذا الطلب إلى رسلو','Send this order to Raslo') }}</button></form>
                    @if(!$shipment)<p class="mt-2 text-sm">{{ $t('هذا الإجراء ينشئ طلب توصيل لهذا الطلب المدفوع.','This action creates a delivery for this paid order.') }}</p>@endif
                @endif
            </article>
        @empty<p>{{ $t('لا توجد طلبات بعد.','No orders yet.') }}</p>@endforelse
    </div>
    <div class="mt-5">{{ $orders->links() }}</div>
</main>
</x-app-layout>
