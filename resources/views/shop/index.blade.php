<div class="flex min-h-[70vh] items-center justify-center px-4 py-16 sm:px-6 lg:px-8">
    <div class="w-full max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-8 shadow-2xl sm:p-12">
        <div class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-700">
            Create your shop
        </div>
        <h1 class="mt-6 text-4xl font-semibold tracking-tight text-slate-900 sm:text-5xl">
            You do not have a shop yet
        </h1>
        <p class="mt-4 text-lg leading-8 text-slate-600">
            Set up your storefront, add your brand story, and start sharing your products with buyers in
            minutes.
        </p>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('shop.create') }}"
                class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                Create your shop
            </a>
            <a href="{{ route('discover') }}"
                class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-indigo-300 hover:text-indigo-700">
                Explore marketplace
            </a>
        </div>
    </div>
</div>
