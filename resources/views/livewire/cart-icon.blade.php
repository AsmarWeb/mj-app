<a href="{{ route('cart.index') }}" class="relative group flex items-center justify-center">

    <span class="absolute -inset-2 rounded-full bg-orange-500/20 blur-md opacity-0 group-hover:opacity-100 transition">
    </span>

    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
        class="relative w-7 h-7 text-gray-700 dark:text-gray-200 group-hover:text-orange-600 transition group-hover:scale-110">

        <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0" />
    </svg>

    @if ($count > 0)
        <span
            class="absolute -top-2 -right-2 min-w-[20px] h-5 px-1 flex items-center justify-center rounded-full bg-orange-600 text-white text-xs font-bold ring-2 ring-white dark:ring-gray-900">

            {{ $count }}

        </span>
    @endif
</a>
