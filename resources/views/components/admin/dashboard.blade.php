<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <x-application-logo class="block h-12 w-auto" />

    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Welcome to your Dashboard!
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">

    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 gap-6 lg:gap-8 p-6 lg:p-8">
    <div class="container px-5 py-24 mx-auto">

        <div class="flex flex-wrap -m-4 text-center">
            <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                <div
                    class="border-2 border-gray-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                        <path
                            d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                    </svg>
                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $shopCount }}</h2>
                    <p class="leading-relaxed">Shops</p>
                </div>
            </div>
            <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                <div
                    class="border-2 border-gray-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75"></path>
                    </svg>
                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $userCount }}</h2>
                    <p class="leading-relaxed">Users</p>
                </div>
            </div>
            <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                <div
                    class="border-2 border-gray-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                        <path
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </path>
                    </svg>
                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $listingCount }}</h2>
                    <p class="leading-relaxed">Products</p>
                </div>
            </div>
            <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                <div
                    class="border-2 border-gray-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="text-indigo-500 w-12 h-12 mb-3 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>

                    <h2 class="title-font font-medium text-3xl text-gray-900">{{ $subscriberCount }}</h2>
                    <p class="leading-relaxed">Subscribers</p>
                </div>
            </div>
        </div>
    </div>
</div>
