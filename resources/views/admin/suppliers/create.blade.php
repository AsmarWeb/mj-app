<x-admin>

    @php
        $emirates = $emirates ?? [
            'Abu Dhabi',
            'Dubai',
            'Sharjah',
            'Ajman',
            'Umm Al Quwain',
            'Ras Al Khaimah',
            'Fujairah',
        ];

        $types = $types ?? ['local', 'printful', 'printify', 'other'];
    @endphp

    <div class="min-h-screen bg-slate-50 dark:bg-neutral-950">

        <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

            {{-- ===================================================== --}}
            {{-- HEADER --}}
            {{-- ===================================================== --}}

            <div class="mb-8">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <div
                            class="mb-3 inline-flex items-center gap-2 rounded-full
                                   bg-orange-50 px-3 py-1.5
                                   text-xs font-black uppercase tracking-wider
                                   text-orange-600
                                   dark:bg-orange-500/10 dark:text-orange-400">

                            <span class="h-2 w-2 rounded-full bg-orange-500"></span>

                            POD Supplier

                        </div>

                        <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white sm:text-4xl">

                            Add POD Supplier

                        </h1>

                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400 sm:text-base">

                            Add a print-on-demand supplier from the UAE or an international POD provider.

                        </p>

                    </div>


                    <a href="{{ route('suppliers.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl
                               border border-slate-200 bg-white px-4 py-3
                               text-sm font-bold text-slate-700 shadow-sm
                               transition hover:border-orange-200 hover:text-orange-600
                               dark:border-white/10 dark:bg-white/5 dark:text-slate-200">

                        <span>←</span>

                        Back to Suppliers

                    </a>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- VALIDATION ERRORS --}}
            {{-- ===================================================== --}}

            @if ($errors->any())

                <div
                    class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5
                           dark:border-red-500/20 dark:bg-red-500/10">

                    <div class="flex gap-3">

                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center
                                   rounded-xl bg-red-100 text-red-600
                                   dark:bg-red-500/20 dark:text-red-400">

                            ⚠️

                        </div>

                        <div>

                            <h3 class="font-black text-red-800 dark:text-red-300">

                                Please check the following:

                            </h3>

                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700 dark:text-red-400">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            <form method="POST" action="{{ route('suppliers.store') }}" class="space-y-6">

                @csrf


                {{-- ================================================= --}}
                {{-- BASIC INFORMATION --}}
                {{-- ================================================= --}}

                <section
                    class="overflow-hidden rounded-3xl border border-slate-200
                           bg-white shadow-sm
                           dark:border-white/10 dark:bg-neutral-900">

                    <div class="border-b border-slate-100 px-6 py-5 dark:border-white/10 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center
                                       rounded-xl bg-orange-100 text-xl
                                       dark:bg-orange-500/10">

                                🏢

                            </div>

                            <div>

                                <h2 class="font-black text-slate-900 dark:text-white">

                                    Supplier Information

                                </h2>

                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">

                                    Basic contact and business information.

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="grid gap-6 p-6 sm:p-8 md:grid-cols-2">

                        {{-- Name --}}
                        <div>

                            <label for="name"
                                class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                Supplier Name
                                <span class="text-orange-500">*</span>

                            </label>

                            <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                autocomplete="organization" placeholder="e.g. Ahmed Printing"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       px-4 py-3 text-sm text-slate-900
                                       outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-orange-400 focus:bg-white
                                       focus:ring-4 focus:ring-orange-500/10
                                       dark:border-white/10 dark:bg-white/5
                                       dark:text-white dark:focus:bg-white/[0.07]">

                        </div>


                        {{-- Company --}}
                        <div>

                            <label for="company"
                                class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                Company / Trade Name

                            </label>

                            <input id="company" type="text" name="company" value="{{ old('company') }}"
                                autocomplete="organization" placeholder="e.g. ABC Printing LLC"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       px-4 py-3 text-sm text-slate-900
                                       outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-orange-400 focus:bg-white
                                       focus:ring-4 focus:ring-orange-500/10
                                       dark:border-white/10 dark:bg-white/5
                                       dark:text-white dark:focus:bg-white/[0.07]">

                        </div>


                        {{-- Email --}}
                        <div>

                            <label for="email"
                                class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                Email

                            </label>

                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                autocomplete="email" placeholder="supplier@example.com"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       px-4 py-3 text-sm text-slate-900
                                       outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-orange-400 focus:bg-white
                                       focus:ring-4 focus:ring-orange-500/10
                                       dark:border-white/10 dark:bg-white/5
                                       dark:text-white dark:focus:bg-white/[0.07]">

                            <p class="mt-1.5 text-xs text-slate-400">

                                Used to send the supplier invitation.

                            </p>

                        </div>


                        {{-- Phone --}}
                        <div>

                            <label for="phone"
                                class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                Phone

                            </label>

                            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}"
                                autocomplete="tel" placeholder="+971 50 123 4567"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       px-4 py-3 text-sm text-slate-900
                                       outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-orange-400 focus:bg-white
                                       focus:ring-4 focus:ring-orange-500/10
                                       dark:border-white/10 dark:bg-white/5
                                       dark:text-white dark:focus:bg-white/[0.07]">

                        </div>


                        {{-- WhatsApp --}}
                        <div>

                            <label for="whatsapp"
                                class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                WhatsApp

                            </label>

                            <input id="whatsapp" type="tel" name="whatsapp" value="{{ old('whatsapp') }}"
                                placeholder="+971 50 123 4567"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       px-4 py-3 text-sm text-slate-900
                                       outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-orange-400 focus:bg-white
                                       focus:ring-4 focus:ring-orange-500/10
                                       dark:border-white/10 dark:bg-white/5
                                       dark:text-white dark:focus:bg-white/[0.07]">

                        </div>


                        {{-- Website --}}
                        <div>

                            <label for="website"
                                class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                Website

                            </label>

                            <input id="website" type="url" name="website" value="{{ old('website') }}"
                                placeholder="https://example.com"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       px-4 py-3 text-sm text-slate-900
                                       outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-orange-400 focus:bg-white
                                       focus:ring-4 focus:ring-orange-500/10
                                       dark:border-white/10 dark:bg-white/5
                                       dark:text-white dark:focus:bg-white/[0.07]">

                        </div>

                    </div>

                </section>


                {{-- ================================================= --}}
                {{-- UAE INFORMATION --}}
                {{-- ================================================= --}}

                <section
                    class="overflow-hidden rounded-3xl border border-slate-200
                           bg-white shadow-sm
                           dark:border-white/10 dark:bg-neutral-900">

                    <div class="border-b border-slate-100 px-6 py-5 dark:border-white/10 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center
                                       rounded-xl bg-red-50 text-xl
                                       dark:bg-red-500/10">

                                🇦🇪

                            </div>

                            <div>

                                <h2 class="font-black text-slate-900 dark:text-white">

                                    UAE Location

                                </h2>

                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">

                                    Location and tax information for UAE suppliers.

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="grid gap-6 p-6 sm:p-8 md:grid-cols-2">

                        {{-- Country --}}
                        <div>

                            <label for="country"
                                class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                Country

                            </label>

                            <input id="country" type="text" name="country" value="{{ old('country', 'UAE') }}"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       px-4 py-3 text-sm text-slate-900
                                       outline-none transition
                                       focus:border-orange-400 focus:bg-white
                                       focus:ring-4 focus:ring-orange-500/10
                                       dark:border-white/10 dark:bg-white/5
                                       dark:text-white">

                        </div>


                        {{-- Emirate --}}
                        <div>

                            <label for="emirate"
                                class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                Emirate

                            </label>

                            <select id="emirate" name="emirate"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       px-4 py-3 text-sm text-slate-900
                                       outline-none transition
                                       focus:border-orange-400 focus:bg-white
                                       focus:ring-4 focus:ring-orange-500/10
                                       dark:border-white/10 dark:bg-white/5
                                       dark:text-white">

                                <option value="">Select Emirate</option>

                                @foreach ($emirates as $emirate)
                                    <option value="{{ $emirate }}" @selected(old('emirate') === $emirate)>

                                        {{ $emirate }}

                                    </option>
                                @endforeach

                            </select>

                        </div>


                        {{-- Address --}}
                        <div class="md:col-span-2">

                            <label for="address"
                                class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                Business / Warehouse Address

                            </label>

                            <textarea id="address" name="address" rows="4"
                                placeholder="Enter the supplier's business or warehouse address..."
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       px-4 py-3 text-sm leading-6 text-slate-900
                                       outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-orange-400 focus:bg-white
                                       focus:ring-4 focus:ring-orange-500/10
                                       dark:border-white/10 dark:bg-white/5
                                       dark:text-white dark:focus:bg-white/[0.07]">{{ old('address') }}</textarea>

                        </div>


                        {{-- VAT --}}
                        <div>

                            <label for="vat_number"
                                class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                VAT / TRN Number

                            </label>

                            <input id="vat_number" type="text" name="vat_number" value="{{ old('vat_number') }}"
                                placeholder="e.g. 100xxxxxxxxx003"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       px-4 py-3 text-sm text-slate-900
                                       outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-orange-400 focus:bg-white
                                       focus:ring-4 focus:ring-orange-500/10
                                       dark:border-white/10 dark:bg-white/5
                                       dark:text-white dark:focus:bg-white/[0.07]">

                            <p class="mt-1.5 text-xs text-slate-400">

                                Optional for suppliers that are not VAT registered.

                            </p>

                        </div>

                    </div>

                </section>


                {{-- ================================================= --}}
                {{-- POD SETTINGS --}}
                {{-- ================================================= --}}

                <section
                    class="overflow-hidden rounded-3xl border border-slate-200
                           bg-white shadow-sm
                           dark:border-white/10 dark:bg-neutral-900">

                    <div class="border-b border-slate-100 px-6 py-5 dark:border-white/10 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center
                                       rounded-xl bg-amber-50 text-xl
                                       dark:bg-amber-500/10">

                                🖨️

                            </div>

                            <div>

                                <h2 class="font-black text-slate-900 dark:text-white">

                                    POD Settings

                                </h2>

                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">

                                    Configure how this supplier connects with مُروَّج.كم.

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div class="grid gap-6 md:grid-cols-2">

                            {{-- Integration --}}
                            <div>

                                <label for="type"
                                    class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                    Integration / Provider
                                    <span class="text-orange-500">*</span>

                                </label>

                                <select id="type" name="type" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50
                                           px-4 py-3 text-sm text-slate-900
                                           outline-none transition
                                           focus:border-orange-400 focus:bg-white
                                           focus:ring-4 focus:ring-orange-500/10
                                           dark:border-white/10 dark:bg-white/5
                                           dark:text-white">

                                    @foreach ($types as $type)
                                        <option value="{{ $type }}" @selected(old('type', 'local') === $type)>

                                            @switch($type)
                                                @case('local')
                                                    UAE Local Supplier
                                                @break

                                                @case('printful')
                                                    Printful
                                                @break

                                                @case('printify')
                                                    Printify
                                                @break

                                                @case('other')
                                                    Other
                                                @break

                                                @default
                                                    {{ ucfirst($type) }}
                                            @endswitch

                                        </option>
                                    @endforeach

                                </select>

                                <p class="mt-1.5 text-xs text-slate-400">

                                    Choose <strong>UAE Local Supplier</strong> for suppliers you manage directly.

                                </p>

                            </div>


                            {{-- Commission --}}
                            <div>

                                <label for="commission"
                                    class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                    Murwaj Commission %

                                </label>

                                <div class="relative">

                                    <input id="commission" type="number" step="0.01" min="0"
                                        max="100" name="commission" value="{{ old('commission', 0) }}"
                                        placeholder="0"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50
                                               px-4 py-3 pr-12 text-sm text-slate-900
                                               outline-none transition
                                               placeholder:text-slate-400
                                               focus:border-orange-400 focus:bg-white
                                               focus:ring-4 focus:ring-orange-500/10
                                               dark:border-white/10 dark:bg-white/5
                                               dark:text-white">

                                    <span
                                        class="absolute right-4 top-1/2 -translate-y-1/2
                                               font-black text-slate-400">

                                        %

                                    </span>

                                </div>

                                <p class="mt-1.5 text-xs text-slate-400">

                                    The marketplace commission deducted from supplier sales.

                                </p>

                            </div>

                        </div>


                        {{-- API --}}
                        <div class="mt-6">

                            <label for="api_key"
                                class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                                API Key

                            </label>

                            <input id="api_key" type="password" name="api_key" autocomplete="new-password"
                                placeholder="Optional — leave empty for local suppliers"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50
                                       px-4 py-3 text-sm text-slate-900
                                       outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-orange-400 focus:bg-white
                                       focus:ring-4 focus:ring-orange-500/10
                                       dark:border-white/10 dark:bg-white/5
                                       dark:text-white dark:focus:bg-white/[0.07]">

                            <div
                                class="mt-3 flex items-start gap-3 rounded-xl
                                       bg-slate-50 p-4
                                       dark:bg-white/5">

                                <span class="text-lg">🔐</span>

                                <p class="text-xs leading-5 text-slate-500 dark:text-slate-400">

                                    API credentials are sensitive. Only add an API key when this supplier
                                    actually provides an integration with مُروَّج.كم.

                                </p>

                            </div>

                        </div>

                    </div>

                </section>


                {{-- ================================================= --}}
                {{-- STATUS --}}
                {{-- ================================================= --}}

                <section
                    class="overflow-hidden rounded-3xl border border-slate-200
                           bg-white shadow-sm
                           dark:border-white/10 dark:bg-neutral-900">

                    <div class="border-b border-slate-100 px-6 py-5 dark:border-white/10 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center
                                       rounded-xl bg-emerald-50 text-xl
                                       dark:bg-emerald-500/10">

                                ✓

                            </div>

                            <div>

                                <h2 class="font-black text-slate-900 dark:text-white">

                                    Supplier Status

                                </h2>

                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">

                                    Control whether this supplier can be used on the marketplace.

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div class="grid gap-3 sm:grid-cols-2">

                            <label class="cursor-pointer">

                                <input type="radio" name="status" value="active" class="peer sr-only"
                                    @checked(old('status', 'active') === 'active')>

                                <div
                                    class="rounded-2xl border border-slate-200 p-4
                                           transition
                                           peer-checked:border-emerald-400
                                           peer-checked:bg-emerald-50
                                           dark:border-white/10
                                           dark:peer-checked:border-emerald-500/30
                                           dark:peer-checked:bg-emerald-500/10">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center
                                                   rounded-xl bg-emerald-100
                                                   dark:bg-emerald-500/20">

                                            🟢

                                        </div>

                                        <div>

                                            <p class="font-black text-slate-900 dark:text-white">

                                                Active

                                            </p>

                                            <p class="text-xs text-slate-500 dark:text-slate-400">

                                                Supplier can receive orders.

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </label>


                            <label class="cursor-pointer">

                                <input type="radio" name="status" value="inactive" class="peer sr-only"
                                    @checked(old('status') === 'inactive')>

                                <div
                                    class="rounded-2xl border border-slate-200 p-4
                                           transition
                                           peer-checked:border-slate-400
                                           peer-checked:bg-slate-50
                                           dark:border-white/10
                                           dark:peer-checked:border-white/20
                                           dark:peer-checked:bg-white/5">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center
                                                   rounded-xl bg-slate-100
                                                   dark:bg-white/10">

                                            ⚪

                                        </div>

                                        <div>

                                            <p class="font-black text-slate-900 dark:text-white">

                                                Inactive

                                            </p>

                                            <p class="text-xs text-slate-500 dark:text-slate-400">

                                                Temporarily disable this supplier.

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>

                </section>


                {{-- ================================================= --}}
                {{-- SUBMIT --}}
                {{-- ================================================= --}}

                <div
                    class="sticky bottom-4 z-20 rounded-2xl border border-slate-200
                           bg-white/95 p-3 shadow-xl backdrop-blur
                           dark:border-white/10 dark:bg-neutral-900/95">

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                        <a href="{{ route('suppliers.index') }}"
                            class="inline-flex items-center justify-center rounded-xl
                                   border border-slate-200 px-6 py-3
                                   text-sm font-bold text-slate-700
                                   transition hover:bg-slate-50
                                   dark:border-white/10 dark:text-slate-200
                                   dark:hover:bg-white/5">

                            Cancel

                        </a>


                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl
                                   bg-gradient-to-r from-orange-500 to-amber-500
                                   px-7 py-3
                                   text-sm font-black text-white
                                   shadow-lg shadow-orange-500/20
                                   transition
                                   hover:from-orange-600 hover:to-amber-600
                                   active:scale-[0.98]">

                            <span>＋</span>

                            Save Supplier

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-admin>
