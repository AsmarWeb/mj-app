<x-admin>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Create Shop</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be
                        careful what you share.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="username"
                                class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <span
                                        class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">murwaj.com/</span>
                                    <input type="text" name="name" id="name" autocomplete="name"
                                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="shop">
                                </div>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Cover
                                photo</label>
                            <div
                                class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                        <label for="file-upload"
                                            class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" name="image" id="image" type="file"
                                                class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.
                    </p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                        <div class="col-span-full">
                            <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">
                                Location
                            </label>
                            <div class="mt-2">
                                <input type="text" name="location" id="location" autocomplete="location"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>


                        <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                            <div class="container mx-auto px-4 py-2 md:py-10 sm:col-span-2 sm:col-start-1">
                                <div class="mb-5 w-64">

                                    <label for="datepicker" class="block text-sm font-medium leading-6 text-gray-900">
                                        Select Date
                                    </label>
                                    <div class="relative">
                                        <input type="hidden" name="published_at" id="published_at" x-ref="date">
                                        <input type="text" readonly x-model="datepickerValue"
                                            @click="showDatepicker = !showDatepicker"
                                            @keydown.escape="showDatepicker = false"
                                            class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                            placeholder="Select date">

                                        <div class="absolute top-0 right-0 px-3 py-2">
                                            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>


                                        <!-- <div x-text="no_of_days.length"></div>
                                            <div x-text="32 - new Date(year, month, 32).getDate()"></div>
                                            <div x-text="new Date(year, month).getDay()"></div> -->

                                        <div class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0"
                                            style="width: 17rem" x-show.transition="showDatepicker"
                                            @click.away="showDatepicker = false">

                                            <div class="flex justify-between items-center mb-2">
                                                <div>
                                                    <span x-text="MONTH_NAMES[month]"
                                                        class="text-lg font-bold text-gray-800"></span>
                                                    <span x-text="year"
                                                        class="ml-1 text-lg text-gray-600 font-normal"></span>
                                                </div>
                                                <div>
                                                    <button type="button"
                                                        class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                                        :class="{ 'cursor-not-allowed opacity-25': month == 0 }"
                                                        :disabled="month == 0 ? true : false"
                                                        @click="month--; getNoOfDays()">
                                                        <svg class="h-6 w-6 text-gray-500 inline-flex" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                    </button>
                                                    <button type="button"
                                                        class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                                        :class="{ 'cursor-not-allowed opacity-25': month == 11 }"
                                                        :disabled="month == 11 ? true : false"
                                                        @click="month++; getNoOfDays()">
                                                        <svg class="h-6 w-6 text-gray-500 inline-flex" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="flex flex-wrap mb-3 -mx-1">
                                                <template x-for="(day, index) in DAYS" :key="index">
                                                    <div style="width: 14.26%" class="px-1">
                                                        <div x-text="day"
                                                            class="text-gray-800 font-medium text-center text-xs">
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>

                                            <div class="flex flex-wrap -mx-1">
                                                <template x-for="blankday in blankdays">
                                                    <div style="width: 14.28%"
                                                        class="text-center border p-1 border-transparent text-sm">
                                                    </div>
                                                </template>
                                                <template x-for="(date, dateIndex) in no_of_days"
                                                    :key="dateIndex">
                                                    <div style="width: 14.28%" class="px-1 mb-1">
                                                        <div @click="getDateValue(date)" x-text="date"
                                                            class="cursor-pointer text-center text-sm rounded-full leading-loose transition ease-in-out duration-100"
                                                            :class="{
                                                                'bg-blue-500 text-white': isToday(date) ==
                                                                    true,
                                                                'text-gray-700 hover:bg-blue-200': isToday(
                                                                    date) == false
                                                            }">
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>

    </div>
</x-admin>
