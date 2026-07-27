<x-admin>

    <div class="p-8">

        <h1 class="text-2xl font-bold mb-6">
            Leads
        </h1>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-left">#</th>

                        <th class="px-6 py-3 text-left">Shop</th>

                        <th class="px-6 py-3 text-left">Listing</th>

                        <th class="px-6 py-3 text-left">User</th>

                        <th class="px-6 py-3 text-left">Type</th>

                        <th class="px-6 py-3 text-left">Date</th>

                        <th class="px-6 py-3"></th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($leads as $lead)
                        <tr class="border-t">

                            <td class="px-6 py-4">
                                {{ $lead->id }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $lead->shop->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $lead->listing->title }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $lead->user?->name ?? 'Guest' }}
                            </td>

                            <td class="px-6 py-4">

                                @if ($lead->type == 'phone')
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                                        Phone
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                                        WhatsApp
                                    </span>
                                @endif

                            </td>

                            <td class="px-6 py-4">
                                {{ $lead->created_at->diffForHumans() }}
                            </td>

                            <td class="px-6 py-4">

                                <a href="{{ route('leads.show', $lead) }}" class="text-indigo-600">
                                    View
                                </a>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $leads->links() }}

        </div>

    </div>

</x-admin>
