<x-admin>
    <div class="bg-white rounded-lg shadow-lg px-8 py-10 max-w-xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <img class="h-8 w-8 mr-2" src="{{ asset('storage/shop-suggest/' . $shop->image) }}" alt="shop" />
                <div class="text-gray-700 font-semibold text-lg">{{ $shop->name }}</div>
            </div>
            <div class="text-gray-700">
                <div class="font-bold text-xl mb-2">INVOICE</div>
                <div class="text-sm">Date: {{ $shop->created_at }}</div>
                <div class="text-sm">Shop #: {{ $shop->id }}</div>
            </div>
        </div>
        <div class="border-b-2 border-gray-300 pb-8 mb-8">
            <h2 class="text-2xl font-bold mb-4">Belong To:</h2>
            <div class="text-gray-700 mb-2">{{ $shop->user->name }}</div>
            <div class="text-gray-700 mb-2"> {{ $shop->location }}</div>
            <div class="text-gray-700">{{ $shop->user->email }}</div>
        </div>
        <table class="w-full text-left mb-8">
            <thead>
                <tr>
                    <th class="text-gray-700 font-bold uppercase py-2">Description</th>
                    <th class="text-gray-700 font-bold uppercase py-2">Quantity</th>
                    <th class="text-gray-700 font-bold uppercase py-2">Price</th>
                    <th class="text-gray-700 font-bold uppercase py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shop->listing as $item)
                    <tr>
                        <td class="py-4 text-gray-700">{{ $item->title }}</td>
                        <td class="py-4 text-gray-700">{{ $item->quantity }}</td>
                        <td class="py-4 text-gray-700">{{ $item->price }}</td>
                        <td class="py-4 text-gray-700">{{ $item->price * $item->quantity }}</td>
                    </tr>
                @endforeach
                @if ($shop->listing->isEmpty())
                    <tr>
                        <td colspan="3">
                            <div class="flex flecol justify-center items-center py-4 text-lg">
                                {{ __('No Result Found') }}
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{-- <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Subtotal:</div>
            <div class="text-gray-700">$425.00</div>
        </div>
        <div class="text-right mb-8">
            <div class="text-gray-700 mr-2">Tax:</div>
            <div class="text-gray-700">$25.50</div>

        </div>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Total:</div>
            <div class="text-gray-700 font-bold text-xl">$450.50</div>
        </div> --}}
        {{-- <div class="border-t-2 border-gray-300 pt-8 mb-8">
            <div class="text-gray-700 mb-2">Payment is due within 30 days. Late payments are subject to fees.</div>
            <div class="text-gray-700 mb-2">Please make checks payable to Your Company Name and mail to:</div>
            <div class="text-gray-700">123 Main St., Anytown, USA 12345</div>
        </div> --}}
    </div>
</x-admin>
