<x-admin>

    <div class="p-8">

        <h1 class="text-2xl font-bold mb-6">

            Lead #{{ $lead->id }}

        </h1>

        <div class="bg-white rounded-xl shadow p-6 space-y-5">

            <div>
                <strong>Shop:</strong>
                {{ $lead->shop->name }}
            </div>

            <div>
                <strong>Listing:</strong>
                {{ $lead->listing->title }}
            </div>

            <div>
                <strong>User:</strong>
                {{ $lead->user?->name ?? 'Guest' }}
            </div>

            <div>
                <strong>Lead Type:</strong>
                {{ ucfirst($lead->type) }}
            </div>

            <div>
                <strong>Date:</strong>
                {{ $lead->created_at->format('M d, Y h:i A') }}
            </div>

        </div>

    </div>

</x-admin>
