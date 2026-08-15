<div class="min-h-screen bg-gradient-to-br from-[#f8f7f3] via-[#f3f1eb] to-[#ebe7dc] px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex min-h-screen flex-col items-center justify-center">

        {{-- ========================================================= --}}
        {{-- LOGO --}}
        {{-- ========================================================= --}}

        <div class="mb-6">
            {{ $logo }}
        </div>


        {{-- ========================================================= --}}
        {{-- AUTH CARD --}}
        {{-- ========================================================= --}}

        <div
            class="w-full max-w-md overflow-hidden rounded-2xl
                   border border-[#e5dfd0]
                   bg-white
                   shadow-[0_25px_70px_-25px_rgba(70,55,25,.25)]
                   sm:max-w-lg">

            {{-- Top UAE accent --}}
            <div class="flex h-1.5 w-full">

                {{-- UAE Red --}}
                <span class="w-1/4 bg-[#D71920]"></span>

                {{-- UAE Green --}}
                <span class="w-1/4 bg-[#00732F]"></span>

                {{-- UAE White --}}
                <span class="w-1/4 bg-white"></span>

                {{-- UAE Black --}}
                <span class="w-1/4 bg-[#000000]"></span>

            </div>


            {{-- Content --}}
            <div class="px-6 py-8 sm:px-10 sm:py-10">
                {{ $slot }}
            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- FOOTER --}}
        {{-- ========================================================= --}}

        <div class="mt-6 text-center">

            <div class="flex items-center justify-center gap-2">

                <span class="h-px w-8 bg-[#c9a75e]"></span>

                <span class="text-sm">
                    🇦🇪
                </span>

                <span class="h-px w-8 bg-[#c9a75e]"></span>

            </div>

            <p class="mt-2 text-[10px] font-bold uppercase tracking-[0.18em] text-gray-400">
                UAE
            </p>

        </div>

    </div>
</div>
