<x-app-layout>

    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">

        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

            {{-- ========================================================= --}}
            {{-- HEADER --}}
            {{-- ========================================================= --}}

            <div class="mb-8">

                <div class="mb-4 flex flex-wrap items-center gap-3">

                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-orange-100 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">

                        <span class="h-2 w-2 rounded-full bg-orange-500"></span>

                        <span lang="en">UAE Marketplace</span>

                        <span class="text-orange-400">•</span>

                        <span dir="rtl" lang="ar">سوق الإمارات</span>

                    </span>

                    <span class="text-sm text-slate-400">
                        🇦🇪 Dubai · Abu Dhabi · Sharjah · UAE
                    </span>

                </div>


                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <a href="{{ route('profile') }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-orange-600 dark:text-slate-400 dark:hover:text-orange-400">

                            ←

                            <span lang="en">Back to Listings</span>

                            <span class="text-slate-300">|</span>

                            <span dir="rtl" lang="ar">العودة إلى المنتجات</span>

                        </a>

                        <h1 class="mt-3 text-3xl font-black tracking-tight text-slate-900 dark:text-white sm:text-4xl">

                            <span lang="en">Edit Product</span>

                            <span class="mx-2 text-slate-300">|</span>

                            <span dir="rtl" lang="ar">تعديل المنتج</span>

                        </h1>

                        <p class="mt-2 max-w-3xl text-sm leading-7 text-slate-500 dark:text-slate-400">

                            <span lang="en">
                                Update your product information, pricing, inventory and images.
                            </span>

                            <br>

                            <span dir="rtl" lang="ar">
                                حدّث معلومات المنتج والسعر والمخزون والصور.
                            </span>

                        </p>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ========================================================= --}}

            @if (session('success'))
                <div
                    class="mb-8 flex items-start gap-4 rounded-2xl border border-green-200 bg-gradient-to-r from-green-50 to-emerald-50 p-5 text-green-800 shadow-lg shadow-green-100/50 dark:border-green-500/20 dark:from-green-500/10 dark:to-emerald-500/5 dark:text-green-300">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-500 text-white shadow-lg shadow-green-500/20">
                        ✓
                    </div>

                    <div>

                        <p class="font-bold">

                            <span lang="en">Product updated successfully</span>

                            <span class="mx-1">—</span>

                            <span dir="rtl" lang="ar">تم تحديث المنتج بنجاح</span>

                        </p>

                        <p class="mt-1 text-sm text-green-700/80 dark:text-green-300/70">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>
            @endif


            {{-- ========================================================= --}}
            {{-- VALIDATION --}}
            {{-- ========================================================= --}}

            @if ($errors->any())

                <div
                    class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-5 text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-300">

                    <div class="flex items-start gap-3">

                        <span
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-500 font-bold text-white">
                            !
                        </span>

                        <div class="flex-1">

                            <p class="font-bold">

                                <span lang="en">
                                    Please check the information below.
                                </span>

                                <span class="mx-1">—</span>

                                <span dir="rtl" lang="ar">
                                    يرجى التحقق من المعلومات أدناه.
                                </span>

                            </p>

                            <ul class="mt-3 list-disc space-y-1 pl-5 text-sm">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- FORM --}}
            {{-- ========================================================= --}}

            <form method="POST" action="{{ route('seller.listing.update', $listing) }}" enctype="multipart/form-data"
                class="space-y-8">

                @csrf
                @method('PUT')


                {{-- ===================================================== --}}
                {{-- BASIC INFORMATION --}}
                {{-- ===================================================== --}}

                <div
                    class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                    <div
                        class="border-b border-slate-100 bg-gradient-to-r from-orange-50 to-amber-50 px-6 py-5 dark:border-slate-800 dark:from-orange-500/5 dark:to-amber-500/5">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-500 text-xl shadow-lg shadow-orange-500/20">
                                📝
                            </div>

                            <div>

                                <h2 class="text-xl font-black text-slate-900 dark:text-white">

                                    <span lang="en">Basic Information</span>

                                    <span class="mx-1 text-slate-300">|</span>

                                    <span dir="rtl" lang="ar">المعلومات الأساسية</span>

                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">

                                    <span lang="en">
                                        Tell customers about your product.
                                    </span>

                                    <br>

                                    <span dir="rtl" lang="ar">
                                        أخبر العملاء عن منتجك.
                                    </span>

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="space-y-6 p-6 sm:p-8">


                        {{-- PRODUCT NAME --}}

                        <div>

                            <label for="title" class="font-bold text-slate-700 dark:text-slate-300">

                                <span lang="en">Product Name</span>

                                <span class="mx-1 text-slate-300">|</span>

                                <span dir="rtl" lang="ar">اسم المنتج</span>

                            </label>

                            <input id="title" type="text" name="title"
                                value="{{ old('title', $listing->title) }}"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            @error('title')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror

                        </div>


                        {{-- ARABIC NAME --}}

                        <div dir="rtl" lang="ar">

                            <div class="flex items-center justify-between gap-3">

                                <label for="title_ar" class="font-bold text-slate-700 dark:text-slate-300">

                                    اسم المنتج

                                </label>

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">

                                    🇦🇪 العربية

                                </span>

                            </div>

                            <input id="title_ar" type="text" name="title_ar"
                                value="{{ old('title_ar', $listing->title_ar) }}" dir="rtl" lang="ar"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-right text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            @error('title_ar')
                                <p class="mt-2 text-right text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- DESCRIPTION --}}

                        <div>

                            <label for="description" class="font-bold text-slate-700 dark:text-slate-300">

                                <span lang="en">Description</span>

                                <span class="mx-1 text-slate-300">|</span>

                                <span dir="rtl" lang="ar">الوصف</span>

                            </label>

                            <textarea id="description" name="description" rows="6"
                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 leading-7 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">{{ old('description', $listing->description) }}</textarea>

                            @error('description')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- PRICING & INVENTORY --}}
                {{-- ===================================================== --}}

                <div
                    class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                    <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 text-xl text-white shadow-lg shadow-orange-500/20">
                                💰
                            </div>

                            <div>

                                <h2 class="text-xl font-black text-slate-900 dark:text-white">

                                    <span lang="en">Pricing & Inventory</span>

                                    <span class="mx-1 text-slate-300">|</span>

                                    <span dir="rtl" lang="ar">السعر والمخزون</span>

                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">

                                    <span lang="en">
                                        Set your product price and available quantity.
                                    </span>

                                    <br>

                                    <span dir="rtl" lang="ar">
                                        حدد سعر المنتج والكمية المتوفرة.
                                    </span>

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="space-y-6 p-6 sm:p-8">

                        <div class="grid gap-6 md:grid-cols-2">


                            {{-- PRICE --}}

                            <div>

                                <label for="price" class="font-bold text-slate-700 dark:text-slate-300">

                                    <span lang="en">Price</span>

                                    <span class="mx-1 text-slate-300">|</span>

                                    <span dir="rtl" lang="ar">السعر</span>

                                </label>

                                <div class="relative mt-2">

                                    <span
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 font-black text-orange-500">
                                        {{ $currency }}
                                    </span>

                                    <input id="price" type="number" step="0.01" name="price"
                                        value="{{ old('price', $listing->price) }}"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-16 pr-4 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                </div>

                                @error('price')
                                    <p class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- QUANTITY --}}

                            <div>

                                <label for="quantity" class="font-bold text-slate-700 dark:text-slate-300">

                                    <span lang="en">Quantity</span>

                                    <span class="mx-1 text-slate-300">|</span>

                                    <span dir="rtl" lang="ar">الكمية</span>

                                </label>

                                <input id="quantity" type="number" min="0" name="quantity"
                                    value="{{ old('quantity', $listing->quantity) }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                @error('quantity')
                                    <p class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>


                        <div class="grid gap-6 md:grid-cols-2">


                            {{-- CONDITION --}}

                            <div>

                                <label for="condition" class="font-bold text-slate-700 dark:text-slate-300">

                                    <span lang="en">Condition</span>

                                    <span class="mx-1 text-slate-300">|</span>

                                    <span dir="rtl" lang="ar">الحالة</span>

                                </label>

                                <select id="condition" name="condition"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                    <option value="new"
                                        {{ old('condition', $listing->condition) == 'new' ? 'selected' : '' }}>
                                        New | جديد
                                    </option>

                                    <option value="used"
                                        {{ old('condition', $listing->condition) == 'used' ? 'selected' : '' }}>
                                        Used | مستعمل
                                    </option>

                                </select>

                            </div>


                            {{-- PRICE CONDITION --}}

                            <div>

                                <label for="price_condition" class="font-bold text-slate-700 dark:text-slate-300">

                                    <span lang="en">Price Type</span>

                                    <span class="mx-1 text-slate-300">|</span>

                                    <span dir="rtl" lang="ar">نوع السعر</span>

                                </label>

                                <select id="price_condition" name="price_condition"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                    <option value="fixed"
                                        {{ old('price_condition', $listing->price_condition) == 'fixed' ? 'selected' : '' }}>
                                        Fixed | ثابت
                                    </option>

                                    <option value="negotiable"
                                        {{ old('price_condition', $listing->price_condition) == 'negotiable' ? 'selected' : '' }}>
                                        Negotiable | قابل للتفاوض
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- SHIPPING --}}
                {{-- ===================================================== --}}

                <div
                    class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                    <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 text-xl text-white shadow-lg shadow-green-500/20">
                                🚚
                            </div>

                            <div>

                                <h2 class="text-xl font-black text-slate-900 dark:text-white">

                                    <span lang="en">Shipping & Delivery</span>

                                    <span class="mx-1 text-slate-300">|</span>

                                    <span dir="rtl" lang="ar">الشحن والتوصيل</span>

                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">

                                    <span lang="en">
                                        Tell customers how their order will be delivered.
                                    </span>

                                    <br>

                                    <span dir="rtl" lang="ar">
                                        أخبر العملاء بطريقة توصيل الطلب.
                                    </span>

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div class="grid gap-6 md:grid-cols-2">

                            {{-- SHIPPING METHOD --}}

                            <div>

                                <label for="shipping_method" class="font-bold text-slate-700 dark:text-slate-300">

                                    <span lang="en">Shipping Method</span>

                                    <span class="mx-1 text-slate-300">|</span>

                                    <span dir="rtl" lang="ar">طريقة الشحن</span>

                                </label>

                                <select id="shipping_method" name="shipping_method"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                    <option value="Standard Shipping"
                                        {{ old('shipping_method', $listing->shipping_method) == 'Standard Shipping' ? 'selected' : '' }}>
                                        Standard Shipping | الشحن العادي
                                    </option>

                                    <option value="Express Shipping"
                                        {{ old('shipping_method', $listing->shipping_method) == 'Express Shipping' ? 'selected' : '' }}>
                                        Express Shipping | الشحن السريع
                                    </option>

                                    <option value="Free Shipping"
                                        {{ old('shipping_method', $listing->shipping_method) == 'Free Shipping' ? 'selected' : '' }}>
                                        Free Shipping | شحن مجاني
                                    </option>

                                    <option value="Pickup"
                                        {{ old('shipping_method', $listing->shipping_method) == 'Pickup' ? 'selected' : '' }}>
                                        Local Pickup | استلام محلي
                                    </option>

                                </select>

                            </div>


                            {{-- DELIVERY DAYS --}}

                            <div>

                                <label for="delivery_days" class="font-bold text-slate-700 dark:text-slate-300">

                                    <span lang="en">Delivery Days</span>

                                    <span class="mx-1 text-slate-300">|</span>

                                    <span dir="rtl" lang="ar">أيام التوصيل</span>

                                </label>

                                <input id="delivery_days" type="number" min="1" name="delivery_days"
                                    value="{{ old('delivery_days', $listing->delivery_days) }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- PRODUCT IMAGE --}}
                {{-- ===================================================== --}}

                <div
                    class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                    <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-900 text-xl text-white shadow-lg dark:bg-orange-500">
                                🖼️
                            </div>

                            <div>

                                <h2 class="text-xl font-black text-slate-900 dark:text-white">

                                    <span lang="en">Product Image</span>

                                    <span class="mx-1 text-slate-300">|</span>

                                    <span dir="rtl" lang="ar">صورة المنتج</span>

                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">

                                    <span lang="en">
                                        Upload a new main image for your product.
                                    </span>

                                    <br>

                                    <span dir="rtl" lang="ar">
                                        قم برفع صورة رئيسية جديدة للمنتج.
                                    </span>

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div class="flex flex-col gap-6 sm:flex-row sm:items-center">


                            {{-- CURRENT IMAGE --}}

                            <div
                                class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-1 shadow-sm dark:border-slate-700 dark:bg-slate-950">

                                @if ($listing->image)
                                    <img src="{{ asset('storage/products/' . $listing->image) }}"
                                        alt="{{ $listing->title }}" class="h-36 w-36 rounded-xl object-cover">
                                @else
                                    <div
                                        class="flex h-36 w-36 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 text-5xl text-white">
                                        📦
                                    </div>
                                @endif

                            </div>


                            <div class="flex-1">

                                <label for="image" class="font-bold text-slate-700 dark:text-slate-300">

                                    <span lang="en">Upload New Image</span>

                                    <span class="mx-1 text-slate-300">|</span>

                                    <span dir="rtl" lang="ar">رفع صورة جديدة</span>

                                </label>

                                <input id="image" type="file" name="image"
                                    accept="image/jpeg,image/png,image/webp"
                                    class="mt-3 block w-full cursor-pointer rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm text-slate-600 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-300">

                                <p class="mt-2 text-xs text-slate-400">

                                    <span lang="en">
                                        JPG, PNG or WebP. A clear product image is recommended.
                                    </span>

                                    <span class="mx-1">|</span>

                                    <span dir="rtl" lang="ar">
                                        JPG أو PNG أو WebP. يفضل استخدام صورة واضحة للمنتج.
                                    </span>

                                </p>

                                @error('image')
                                    <p class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- PRODUCT PREVIEW --}}
                {{-- ===================================================== --}}

                <div
                    class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                    <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 text-xl text-white shadow-lg shadow-orange-500/20">
                                👁️
                            </div>

                            <div>

                                <h2 class="text-xl font-black text-slate-900 dark:text-white">

                                    <span lang="en">Product Preview</span>

                                    <span class="mx-1 text-slate-300">|</span>

                                    <span dir="rtl" lang="ar">معاينة المنتج</span>

                                </h2>

                                <p class="text-sm text-slate-500 dark:text-slate-400">

                                    <span lang="en">
                                        Preview how your product currently appears.
                                    </span>

                                    <br>

                                    <span dir="rtl" lang="ar">
                                        شاهد كيف يظهر منتجك حاليًا.
                                    </span>

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 sm:p-8">

                        <div class="grid gap-6 md:grid-cols-[220px_1fr] md:items-center">


                            <div
                                class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-1 dark:border-slate-700 dark:bg-slate-950">

                                @if ($listing->image)
                                    <img src="{{ asset('storage/products/' . $listing->image) }}"
                                        alt="{{ $listing->title }}"
                                        class="h-52 w-full rounded-xl object-cover md:h-52">
                                @else
                                    <div
                                        class="flex h-52 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 text-6xl text-white">
                                        📦
                                    </div>
                                @endif

                            </div>


                            <div>

                                <h3 class="text-2xl font-black text-slate-900 dark:text-white">
                                    {{ $listing->title }}
                                </h3>

                                @if ($listing->title_ar)
                                    <p dir="rtl" lang="ar"
                                        class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        {{ $listing->title_ar }}
                                    </p>
                                @endif

                                <p class="mt-4 text-2xl font-black text-orange-600 dark:text-orange-400">

                                    {{ $currency }} {{ number_format($listing->price, 2) }}

                                </p>

                                <div class="mt-4 flex flex-wrap gap-2">

                                    <span
                                        class="inline-flex items-center rounded-full bg-green-100 px-3 py-1.5 text-xs font-bold text-green-700 dark:bg-green-500/10 dark:text-green-400">

                                        {{ ucfirst($listing->status) }}

                                    </span>

                                    <span
                                        class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-600 dark:bg-slate-800 dark:text-slate-300">

                                        {{ ucfirst($listing->condition) }}

                                    </span>

                                    <span
                                        class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1.5 text-xs font-bold text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">

                                        {{ $listing->quantity }} in stock

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- SAVE --}}
                {{-- ===================================================== --}}

                <div
                    class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-orange-500 via-orange-600 to-amber-500 p-6 text-white shadow-2xl shadow-orange-500/20 sm:p-8">

                    <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-3xl">
                    </div>

                    <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <div
                                class="mb-2 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-xs font-bold uppercase tracking-wider backdrop-blur">

                                🇦🇪

                                <span lang="en">UAE Marketplace</span>

                                <span>•</span>

                                <span dir="rtl" lang="ar">سوق الإمارات</span>

                            </div>

                            <h3 class="text-2xl font-black">

                                <span lang="en">
                                    Ready to save your changes?
                                </span>

                                <span class="mx-1">|</span>

                                <span dir="rtl" lang="ar">
                                    هل أنت مستعد لحفظ التغييرات؟
                                </span>

                            </h3>

                            <p class="mt-2 max-w-xl text-sm leading-7 text-white/80">

                                <span lang="en">
                                    Your updated product information will be reflected across the marketplace.
                                </span>

                                <br>

                                <span dir="rtl" lang="ar">
                                    ستظهر معلومات منتجك المحدثة في جميع أنحاء السوق.
                                </span>

                            </p>

                        </div>


                        <div class="flex flex-col gap-3 sm:flex-row">

                            <a href="{{ route('profile') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-white/30 bg-white/10 px-6 py-4 font-bold text-white backdrop-blur transition hover:bg-white/20">

                                <span lang="en">Cancel</span>

                                <span class="mx-1 text-white/50">|</span>

                                <span dir="rtl" lang="ar">إلغاء</span>

                            </a>


                            <button type="submit"
                                class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-white px-8 py-4 font-black text-orange-600 shadow-xl transition hover:-translate-y-0.5 hover:bg-orange-50">

                                <span lang="en">Update Product</span>

                                <span class="text-orange-300">|</span>

                                <span dir="rtl" lang="ar">تحديث المنتج</span>

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-5-5 5 5-5 5" />

                                </svg>

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
