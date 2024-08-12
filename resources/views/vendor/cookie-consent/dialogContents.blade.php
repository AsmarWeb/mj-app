<div class="js-cookie-consent cookie-consent fixed max-w-md p-4 mx-auto bottom-0 inset-x-0 pb-2 z-50">
    <div class="max-w-7xl">
        <div class="p-4 md:p-2 rounded-2xl bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700 ">
            <div class="flex items-center justify-between flex-wrap">
                <div class="max-w-full flex-1 items-center md:w-0 md:inline">
                    <h2 class="font-semibold text-gray-800 dark:text-white">🍪 Cookie Notice</h2>
                    <p class="md:ml-3 text-sm text-gray-600 dark:text-gray-300 cookie-consent__message">
                        {!! trans('cookie-consent::texts.message') !!}
                        <a target="_blank" href="{{ route('policy.show') }}" class="text-blue-500 hover:underline">
                            Read cookies policies
                        </a>.
                    </p>
                </div>
                <div class="mt-2 flex-shrink-0 w-full sm:mt-0 sm:w-auto flex items-center justify-between">
                    <button
                        class="js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-yellow-800 bg-yellow-400 hover:bg-yellow-300">
                        {{ trans('cookie-consent::texts.agree') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
