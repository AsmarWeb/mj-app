@if (session()->has('success'))
    <div class="text-green-700 bg-green-100" role="alert">
        {{ session()->get('success') }}
    </div>
@endif
@if (session()->has('error'))
    <div class="text-red-700 bg-red-100" role="alert">
        {{ session()->get('error') }}
    </div>
@endif
<form wire:submit.prevent="formSubmit">
    <div class="flex flex-col mt-8 space-y-3 sm:-mx-2 sm:flex-row sm:justify-center sm:space-y-0">
        <input id="email" type="email" wire:model="email"
            class="px-6 py-3 text-gray-700 bg-white border rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring sm:mx-2"
            placeholder="Email Address" />

        <button
            class="px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-md hover:bg-blue-600 focus:bg-blue-600 focus:outline-none sm:mx-2">
            Notify Me
        </button>
    </div>
</form>
