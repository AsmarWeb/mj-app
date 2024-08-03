@if (Session::has('message'))
    <div class="text-green-700 bg-teal-100 border-t-4 border-teal-500 rounded-b px-4 py-3 shadow-md" role="alert">
        {{ Session::get('message') }}
    </div>
@endif
<form wire:submit.prevent="sendMessage" class="mt-6">
    <div class="flex-1">
        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Full Name</label>
        <input type="text" wire:model="fullname" placeholder="Sherlock Holmes"
            class="block w-full px-5 py-3 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" />
        @error('fullname')
            <span class="text-sm text-red-500 italic">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex-1 mt-6">
        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Email
            address</label>
        <input type="email" wire:model="email" placeholder="holmes@example.com"
            class="block w-full px-5 py-3 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" />
        @error('email')
            <span class="text-sm text-red-500 italic">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex-1 mt-6">
        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Phone number</label>
        <input type="tel" wire:model="phone" placeholder="+1 240-824-1243"
            class="block w-full px-5 py-3 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" />
        @error('phone')
            <span class="text-sm text-red-500 italic">{{ $message }}</span>
        @enderror
    </div>

    <div class="w-full mt-6">
        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Message</label>
        <textarea wire:model="message"
            class="block w-full h-32 px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md md:h-48 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"
            placeholder="Message">
        </textarea>
        @error('message')
            <span class="text-sm text-red-500 italic">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit"
        class="w-full px-6 py-3 mt-6 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-400 focus:ring-opacity-50">
        get in touch
    </button>
</form>
