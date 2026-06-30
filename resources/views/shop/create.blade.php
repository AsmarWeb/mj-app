<x-app-layout>


    <div class="min-h-screen">

        <!-- Header -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">
                    ShopBuilder
                </h1>

                <button class="px-5 py-2 rounded-xl bg-gray-900 text-white hover:bg-black transition">
                    My Shops
                </button>
            </div>
        </header>

        <!-- Hero -->
        <section class="max-w-7xl mx-auto px-6 py-20">
            <div class="text-center">

                <span
                    class="inline-flex items-center px-4 py-2 rounded-full bg-gray-100 text-gray-700 text-sm font-medium">
                    🚀 Launch Your Store Today
                </span>

                <h2 class="mt-6 text-6xl font-bold text-gray-900 leading-tight">
                    Build Your Online Shop
                    <span class="text-gray-400">
                        In Minutes
                    </span>
                </h2>

                <p class="mt-6 text-xl text-gray-500 max-w-2xl mx-auto">
                    Create a beautiful storefront, add products,
                    accept orders, and grow your business.
                </p>

            </div>
        </section>

        <!-- Main Card -->
        <section class="max-w-6xl mx-auto px-6 pb-20">
            <div class="grid lg:grid-cols-5 gap-8">

                <!-- Form -->
                <form action="/shop" method="POST" enctype="multipart/form-data" class="lg:col-span-3"
                    x-show="!showSuccess" x-transition>
                    {{ csrf_field() }}
                    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8" x-data="{
                        submitting: false,
                        showSuccess: false,
                        formData: {
                            name: '',
                            slug: '',
                            description: '',
                            logo: '',
                            banner: '',
                            type: '',
                            country_id: '',
                            state_id: '',
                            city_id: '',
                            location: '',
                            section_id: '',
                            published_at: ''
                        },
                        errors: {},
                    
                        validateField(fieldName, value) {
                            this.errors[fieldName] = '';
                    
                            if (fieldName === 'name') {
                                if (!value.trim()) return 'Name is required';
                            }
                    
                            if (fieldName === 'slug') {
                                if (!value.trim()) return 'Slug is required';
                            }
                        }
                    
                        if (fieldName === 'description') {
                            if (!value.trim()) return 'Description is required';
                        }
                    
                        if (fieldName === 'type') {
                            if (!value.trim()) return 'Type is required';
                        }
                    
                        if (fieldName === 'country_id') {
                            if (!value.trim()) return 'Country is required';
                        }
                    
                        if (fieldName === 'state_id') {
                            if (!value.trim()) return 'State is required';
                        }
                    
                        if (fieldName === 'city_id') {
                            if (!value.trim()) return 'City is required';
                        }
                    
                        if (fieldName === 'location') {
                            if (!value.trim()) return 'Location is required';
                        }
                    
                        if (fieldName === 'section_id') {
                            if (!value.trim()) return 'Section is required';
                        }
                    
                        if (fieldName === 'published_at') {
                            if (!value.trim()) return 'Published date is required';
                        }
                    
                        return '';
                    },
                    
                    validateForm() {
                            this.errors = {};
                            let isValid = true;
                    
                            // Validate required fields
                            Object.keys(this.formData).forEach(field => {
                                if (field === 'name' || field === 'slug' || field === 'description' || field === 'type' || field === 'country_id' || field === 'state_id' || field === 'city_id' || field === 'location' || field === 'section_id' || field === 'published_at') {
                                    const error = this.validateField(field, this.formData[field]);
                                    if (error) {
                                        this.errors[field] = error;
                                        isValid = false;
                                    }
                                }
                            });
                    
                            return isValid;
                        },
                    
                        async submitForm() {
                                if (!this.validateForm()) {
                                    // Scroll to first error
                                    const firstError = document.querySelector('.error-input');
                                    if (firstError) {
                                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                        firstError.focus();
                                    }
                                    return;
                                }
                    
                                this.submitting = true;
                    
                                // Simulate API call
                                await new Promise(resolve => setTimeout(resolve, 1500));
                    
                                // Show success message
                                this.showSuccess = true;
                                this.submitting = false;
                            },
                    
                            handleAvatarUpload(event) {
                                const file = event.target.files[0];
                                if (file) {
                                    if (file.size > 2 * 1024 * 1024) { // 2MB limit
                                        alert('File size must be less than 2MB');
                                        return;
                                    }
                    
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        this.formData.avatar = e.target.result;
                                    };
                                    reader.readAsDataURL(file);
                                }
                            }
                    }">

                        <h3 class="text-2xl font-bold text-gray-900 mb-8">
                            Create Your Shop
                        </h3>

                        <div class="space-y-6">

                            <!-- Shop Logo -->
                            <div class="flex items-center gap-6">

                                <div class="relative">

                                    <img id="logoPreview"
                                        class="w-32 h-32 rounded-full object-cover border-4 border-white shadow hidden">


                                    <div id="logoPlaceholder"
                                        class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">

                                        Logo

                                    </div>


                                    <input type="file" name="logo" onchange="previewLogo(event)"
                                        class="absolute inset-0 opacity-0 cursor-pointer rounded-full">

                                </div>


                                <div>
                                    <h3 class="font-semibold text-lg">
                                        Shop Logo
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        PNG or JPG (max 2MB)
                                    </p>
                                </div>

                            </div>

                            <!-- Cover Image -->
                            <div>
                                <label class="block font-semibold text-gray-700 mb-3">
                                    Cover Image
                                </label>

                                <div
                                    class="relative h-52 rounded-xl overflow-hidden bg-gray-200 border-2 border-dashed border-gray-300">

                                    <img id="coverPreview" class="w-full h-full object-cover hidden">


                                    <div id="coverPlaceholder"
                                        class="absolute inset-0 flex flex-col items-center justify-center text-gray-500">

                                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" />
                                        </svg>

                                        Upload Cover Photo

                                    </div>


                                    <input type="file" name="banner" onchange="previewCover(event)"
                                        class="absolute inset-0 opacity-0 cursor-pointer">

                                </div>

                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    Shop Name
                                </label>

                                <input type="text" name="name" id="name" placeholder="Fashion Store" required
                                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    Shop URL
                                </label>

                                <div class="flex">
                                    <span
                                        class="px-4 py-3 bg-gray-100 border border-r-0 border-gray-300 rounded-l-2xl text-gray-500">
                                        murwaj.com/
                                    </span>

                                    <input type="text" name="slug" id="slug" placeholder="my-store"
                                        class="flex-1 border border-gray-300 rounded-r-2xl px-4 py-3 focus:ring-2 focus:ring-gray-900 outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    Description
                                </label>

                                <textarea rows="4" name="description" id="description" placeholder="Tell customers about your store..."
                                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-gray-900 outline-none"></textarea>
                            </div>

                            <div class="col-span-full">
                                <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">
                                    Location
                                </label>
                                <div class="mt-2">
                                    <input type="text" name="location" id="location" autocomplete="location"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-900 sm:text-sm sm:leading-6" />
                                </div>
                            </div>

                            @php
                                $sections = App\Models\Section::where('status', 'active')->get();
                            @endphp

                            <div class="grid md:grid-cols-2 gap-5">

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">
                                        Shop Section
                                    </label>

                                    <select name="section_id"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3">
                                        <option value="">Select a Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">
                                        Shop Type
                                    </label>

                                    <select name="type" class="w-full rounded-2xl border border-gray-300 px-4 py-3">
                                        <option value="freelance">Freelance</option>
                                        <option value="local">Local</option>
                                    </select>
                                </div>

                                @php
                                    $countries = App\Models\Country::orderBy('name')->get();
                                @endphp

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">
                                        Country
                                    </label>

                                    <select name="country_id"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3">
                                        <option value="">Select a Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @php
                                    $states = App\Models\State::orderBy('name')->get();
                                @endphp

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">
                                        State
                                    </label>

                                    <select name="state_id" class="w-full rounded-2xl border border-gray-300 px-4 py-3">
                                        <option value="">Select a State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @php
                                    $cities = App\Models\City::orderBy('name')->get();
                                @endphp

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">
                                        City
                                    </label>

                                    <select name="city_id"
                                        class="w-full rounded-2xl border border-gray-300 px-4 py-3">
                                        <option value="">Select a City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                                    <div class="container mx-auto px-4 py-3 md:py-10 sm:col-span-2 sm:col-start-1">
                                        <div class="mb-5 w-64">
                                            <label for="datepicker"
                                                class="block mb-2 text-sm font-medium leading-6 text-gray-700">
                                                Select Date
                                            </label>
                                            <div class="relative">
                                                <input type="hidden" name="published_at" id="published_at"
                                                    x-ref="date" />
                                                <input type="text" readonly x-model="datepickerValue"
                                                    @click="showDatepicker = !showDatepicker"
                                                    @keydown.escape="showDatepicker = false"
                                                    class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                                    placeholder="Select date" />

                                                <div class="absolute top-0 right-0 px-3 py-2">
                                                    <svg class="h-6 w-6 text-gray-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
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
                                                                <svg class="h-6 w-6 text-gray-500 inline-flex"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M15 19l-7-7 7-7" />
                                                                </svg>
                                                            </button>
                                                            <button type="button"
                                                                class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                                                :class="{ 'cursor-not-allowed opacity-25': month == 11 }"
                                                                :disabled="month == 11 ? true : false"
                                                                @click="month++; getNoOfDays()">
                                                                <svg class="h-6 w-6 text-gray-500 inline-flex"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M9 5l7 7-7 7" />
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

                            <button type="submit"
                                class="w-full py-4 rounded-2xl bg-gray-900 text-white font-semibold hover:bg-black transition">
                                Create Shop
                            </button>

                        </div>

                    </div>
                </form>

                <!-- Preview -->
                <div class="lg:col-span-2">

                    <div class="bg-gray-900 rounded-3xl p-6 text-white sticky top-24">

                        <div class="h-40 rounded-2xl bg-gradient-to-r from-gray-700 to-black"></div>

                        <h4 class="mt-5 text-xl font-bold">
                            Fashion Store
                        </h4>

                        <p class="text-gray-400 mt-2">
                            Premium clothing and accessories.
                        </p>

                        <div class="grid grid-cols-2 gap-4 mt-6">

                            <div class="bg-white/10 rounded-2xl p-4">
                                <p class="text-gray-400 text-sm">
                                    Products
                                </p>
                                <p class="text-2xl font-bold">
                                    120
                                </p>
                            </div>

                            <div class="bg-white/10 rounded-2xl p-4">
                                <p class="text-gray-400 text-sm">
                                    Orders
                                </p>
                                <p class="text-2xl font-bold">
                                    450
                                </p>
                            </div>

                        </div>

                        <button class="w-full mt-6 py-3 rounded-xl bg-white text-gray-900 font-semibold">
                            Preview Store
                        </button>

                    </div>

                </div>

            </div>
        </section>

    </div>


</x-app-layout>
