<div>
    @if ($added)
        <a href="{{ route('cart.index') }}"
            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>

            Added to Basket
        </a>
    @else
        <button wire:click="add" wire:loading.attr="disabled"
            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-yellow-400 text-gray-800 font-semibold hover:bg-yellow-500 transition disabled:opacity-50">

            <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6h12M10 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />
            </svg>

            <svg wire:loading class="w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>

            <span wire:loading.remove>Add to Basket</span>
            <span wire:loading>Adding...</span>
        </button>
    @endif
</div>
