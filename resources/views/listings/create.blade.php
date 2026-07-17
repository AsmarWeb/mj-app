<x-app-layout>
    <div class="min-h-screen bg-gray-50">

        <div class="grid lg:grid-cols-3 gap-6">

            {{-- Form --}}
            <div class="lg:col-span-2">
                <livewire:seller.create-listing />
            </div>


            {{-- Sidebar --}}
            <div class="space-y-6">
                <livewire:seller.subscription-card />

                <livewire:seller.product-preview />
            </div>

        </div>

    </div>
</x-app-layout>
