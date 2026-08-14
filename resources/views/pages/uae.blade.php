@php
    $isArabic = app()->getLocale() === 'ar';
    $direction = $isArabic ? 'rtl' : 'ltr';

    /*
    |--------------------------------------------------------------------------
    | LABELS
    |--------------------------------------------------------------------------
    */

    $labels = [
        'discover_uae' => $isArabic ? 'اكتشف روح الإمارات' : 'Discover the Spirit of the UAE',

        'uae_gifts' => $isArabic ? 'هدايا إماراتية ومنتجات تحمل عبق التراث' : 'UAE Gifts & Timeless Local Heritage',

        'hero_text' => $isArabic
            ? 'اكتشف مجموعة مختارة من المنتجات الإماراتية الأصيلة، من التمور والعود والعطور إلى القهوة العربية والحرف اليدوية والهدايا الفاخرة، مقدمة من بائعين محليين في مختلف أنحاء الدولة.'
            : 'Discover a refined collection of authentic UAE products, from dates, oud and perfumes to Arabic coffee, traditional crafts and elegant gifts, offered by local sellers across the Emirates.',

        'explore_products' => $isArabic ? 'استكشف المجموعة' : 'Explore Collection',

        'browse_categories' => $isArabic ? 'تصفح التصنيفات' : 'Browse Categories',

        'made_inspired' => $isArabic ? 'مستوحى من' : 'Inspired by',

        'emirati_culture' => $isArabic ? 'التراث والثقافة الإماراتية' : 'Emirati Heritage & Culture',

        'authentic_uae' => $isArabic ? 'أصالة إماراتية' : 'Authentically UAE',

        'explore' => $isArabic ? 'استكشف' : 'Explore',

        'local_traditional_products' => $isArabic ? 'المنتجات المحلية والتراثية' : 'Local & Traditional Products',

        'categories_text' => $isArabic
            ? 'اختيارات أصيلة تعكس جمال الثقافة الإماراتية وتقاليدها العريقة.'
            : 'Authentic selections reflecting the beauty and enduring traditions of Emirati culture.',

        'all_products' => $isArabic ? 'جميع المنتجات' : 'All Products',

        'explore_uae' => $isArabic ? 'استكشف الإمارات' : 'Explore UAE',

        'uae_heritage' => $isArabic ? 'التراث الإماراتي' : 'UAE Heritage',

        'marketplace' => $isArabic ? 'سوق الإمارات' : 'UAE Marketplace',

        'discover_local_products' => $isArabic ? 'اختيارات من قلب الإمارات' : 'Curated from the UAE',

        'local_products_text' => $isArabic
            ? 'منتجات أصيلة من بائعين محليين في مختلف أنحاء دولة الإمارات.'
            : 'Authentic products from local sellers across the United Arab Emirates.',

        'products' => $isArabic ? 'منتج' : 'products',

        'uae_local' => $isArabic ? 'منتج محلي' : 'UAE Local',

        'uae_seller' => $isArabic ? 'بائع إماراتي' : 'UAE Seller',

        'uae' => $isArabic ? 'الإمارات' : 'UAE',

        'price' => $isArabic ? 'السعر' : 'Price',

        'view' => $isArabic ? 'عرض المنتج' : 'View Product',

        'no_products' => $isArabic ? 'لا توجد منتجات حالياً' : 'No products found',

        'no_products_text' => $isArabic
            ? 'لا توجد منتجات متاحة حالياً في هذا التصنيف. استكشف التصنيفات الأخرى لاكتشاف المزيد.'
            : 'There are currently no products in this category. Explore other collections to discover more.',

        'view_all' => $isArabic ? 'عرض جميع المنتجات' : 'View All Products',

        'emirati_heritage' => $isArabic ? 'الإرث الإماراتي' : 'Emirati Heritage',

        'more_than_product' => $isArabic ? 'أكثر من مجرد منتج.' : 'More than a product.',

        'uae_story' => $isArabic ? 'إنها حكاية من الإمارات.' : 'It carries a story from the UAE.',

        'heritage_text' => $isArabic
            ? 'من نخلة التمر والقهوة العربية إلى العود والعطور والحرف اليدوية والهدايا الراقية، تعكس هذه المنتجات تفاصيل من حياة الإمارات وكرم أهلها وتراثها المتوارث عبر الأجيال.'
            : 'From the date palm and Arabic coffee to oud, perfumes, traditional crafts and refined gifts, these products capture the warmth, generosity and heritage of the UAE passed down through generations.',

        'local_heritage' => $isArabic ? 'تراث محلي' : 'Local Heritage',

        'local_heritage_text' => $isArabic
            ? 'منتجات مستوحاة من التقاليد الإماراتية الأصيلة.'
            : 'Products inspired by authentic Emirati traditions.',

        'uae_sellers' => $isArabic ? 'بائعون من الإمارات' : 'UAE Sellers',

        'uae_sellers_text' => $isArabic
            ? 'اكتشف علامات وبائعين محليين من مختلف أنحاء الدولة.'
            : 'Discover local brands and sellers from across the Emirates.',

        'united_arab_emirates' => $isArabic ? 'دولة الإمارات العربية المتحدة' : 'United Arab Emirates',

        'shop_local' => $isArabic ? 'تسوق محلياً. احتفل بالتراث.' : 'Shop Local. Celebrate Heritage.',

        'have_local_product' => $isArabic
            ? 'لديك منتج إماراتي يستحق أن يُكتشف؟'
            : 'Have a UAE product worth discovering?',

        'seller_text' => $isArabic
            ? 'اعرض منتجاتك التقليدية وحرفك اليدوية وهدايا الإمارات والتمور والعطور والعود وغيرها من المنتجات المحلية أمام العملاء في جميع أنحاء الدولة.'
            : 'Showcase your traditional products, handmade crafts, UAE gifts, dates, perfumes, oud and other local creations to customers across the Emirates.',

        'start_selling' => $isArabic ? 'ابدأ البيع' : 'Start Selling',

        'uae_collection' => $isArabic ? 'المجموعة الإماراتية' : 'The UAE Collection',

        'home' => $isArabic ? 'الرئيسية' : 'Home',

        'categories' => $isArabic ? 'التصنيفات' : 'Categories',

        'collection' => $isArabic ? 'المجموعة' : 'Collection',

        'sell' => $isArabic ? 'للبيع' : 'Sell',

        'uae_time' => $isArabic ? 'التوقيت المحلي في الإمارات' : 'UAE Local Time',

        'abu_dhabi' => $isArabic ? 'أبوظبي، الإمارات' : 'Abu Dhabi, UAE',
    ];

    /*
    |--------------------------------------------------------------------------
    | SEO
    |--------------------------------------------------------------------------
    */

    $pageTitle = $isArabic ? 'هدايا الإمارات والمنتجات المحلية والتراثية' : 'UAE Gifts & Local Traditional Products';

    $pageDescription = $isArabic
        ? 'اكتشف هدايا الإمارات والمنتجات المحلية والتراثية الأصيلة من البائعين في جميع أنحاء دولة الإمارات العربية المتحدة.'
        : 'Discover authentic UAE gifts, local products and traditional Emirati heritage products from sellers across the United Arab Emirates.';

    $pageKeywords = $isArabic
        ? 'هدايا الإمارات, المنتجات الإماراتية, المنتجات المحلية, المنتجات التراثية, التراث الإماراتي, العود, العطور, التمور, القهوة العربية, الهدايا الإماراتية'
        : 'UAE gifts, Emirati products, UAE local products, traditional UAE products, Emirati heritage, oud, perfumes, dates, Arabic coffee, UAE souvenirs';

    /*
    |--------------------------------------------------------------------------
    | COLLECTIONS
    |--------------------------------------------------------------------------
    */

    $productsCollection = $products ?? collect();
    $subcategoriesCollection = $subcategories ?? collect();

    $productCount = method_exists($productsCollection, 'total')
        ? $productsCollection->total()
        : $productsCollection->count();

    /*
    |--------------------------------------------------------------------------
    | CATEGORY ICONS
    |--------------------------------------------------------------------------
    */

    $categoryIcons = [
        'dates-date-products' => '🌴',
        'arabic-sweets-desserts' => '🍯',
        'honey-natural-products' => '🍯',
        'spices-traditional-ingredients' => '🌿',
        'arabic-coffee-tea' => '☕',
        'traditional-clothing' => '🧵',
        'perfumes-oud' => '🌹',
        'bakhoor-incense' => '🪔',
        'traditional-handicrafts' => '🧺',
        'pottery-ceramics' => '🏺',
        'palm-date-palm-products' => '🌴',
        'traditional-home-decor' => '🏠',
        'uae-souvenirs-gifts' => '🎁',
        'traditional-accessories-jewelry' => '💎',
    ];
@endphp


<x-main-layout>

    @section('title', $title ?? $pageTitle)
    @section('description', $description ?? $pageDescription)
    @section('keywords', $keywords ?? $pageKeywords)

    {{-- ========================================================= --}}
    {{-- FONT --}}
    {{-- ========================================================= --}}

    @push('styles')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap"
            rel="stylesheet">
    @endpush


    <div dir="{{ $direction }}" lang="{{ $isArabic ? 'ar-AE' : 'en-AE' }}"
        class="uae-page min-h-screen overflow-x-hidden bg-[#f7f4ed] text-[#171717] dark:bg-[#080808] dark:text-white">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <header
            class="sticky top-0 z-[100] border-b border-white/[0.08] bg-[#090909]/95 text-white shadow-2xl backdrop-blur-2xl">

            <div class="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">

                <div class="flex min-h-[78px] items-center justify-between gap-4 sm:h-[86px]">

                    <a href="{{ route('uae') }}" class="group flex shrink-0 items-center gap-3">

                        <div
                            class="relative flex h-11 w-11 items-center justify-center overflow-hidden rounded-full border border-[#c9a75e]/70 bg-gradient-to-br from-[#29210f] via-[#12100b] to-black shadow-[0_0_35px_rgba(201,167,94,.18)]">
                            <span class="text-lg">🇦🇪</span>
                            <span class="absolute inset-1 rounded-full border border-[#d8b866]/20"></span>
                        </div>

                        <div class="hidden sm:block">

                            <div class="brand-title">
                                {{ $labels['uae_collection'] }}
                            </div>

                            <div class="brand-subtitle">
                                {{ $labels['united_arab_emirates'] }}
                            </div>

                        </div>

                    </a>


                    <nav class="hidden items-center gap-8 lg:flex">

                        <a href="{{ route('uae') }}" class="nav-link">
                            {{ $labels['home'] }}
                        </a>

                        <a href="#categories" class="nav-link">
                            {{ $labels['categories'] }}
                        </a>

                        <a href="#products" class="nav-link">
                            {{ $labels['collection'] }}
                        </a>

                        <a href="#seller" class="nav-link">
                            {{ $labels['sell'] }}
                        </a>

                    </nav>


                    {{-- CLOCK --}}

                    <div class="flex items-center gap-3">

                        <div class="hidden text-end sm:block">

                            <div class="clock-label">
                                {{ $labels['uae_time'] }}
                            </div>

                            <div class="clock-location">
                                {{ $labels['abu_dhabi'] }}
                            </div>

                        </div>


                        <div class="uae-watch relative h-[61px] w-[61px] shrink-0 rounded-full bg-gradient-to-br from-[#f4dc98] via-[#b58b39] to-[#694a18] p-[3px]"
                            aria-label="{{ $labels['uae_time'] }}">

                            <div
                                class="relative h-full w-full rounded-full bg-gradient-to-br from-[#eed48c] via-[#806020] to-[#d1ae5b] p-[2px]">

                                <div
                                    class="relative h-full w-full overflow-hidden rounded-full border border-[#f5e4a9]/50 bg-[radial-gradient(circle_at_35%_25%,#fffef5_0%,#eee3bf_30%,#bda15f_72%,#59451f_100%)] shadow-[inset_0_0_15px_rgba(0,0,0,.4)]">

                                    <div class="absolute inset-[5px] rounded-full border border-[#5d481f]/45"></div>

                                    <span
                                        class="absolute left-1/2 top-[7px] -translate-x-1/2 text-[6px] font-bold text-[#382b12]">
                                        XII
                                    </span>

                                    <span
                                        class="absolute right-[7px] top-1/2 -translate-y-1/2 text-[6px] font-bold text-[#382b12]">
                                        III
                                    </span>

                                    <span
                                        class="absolute bottom-[7px] left-1/2 -translate-x-1/2 text-[6px] font-bold text-[#382b12]">
                                        VI
                                    </span>

                                    <span
                                        class="absolute left-[7px] top-1/2 -translate-y-1/2 text-[6px] font-bold text-[#382b12]">
                                        IX
                                    </span>

                                    <span
                                        class="absolute left-1/2 top-[20%] -translate-x-1/2 text-[6px] text-[#806021]">
                                        ♛
                                    </span>

                                    <span
                                        class="absolute left-1/2 top-[35%] -translate-x-1/2 whitespace-nowrap text-[5px] font-bold tracking-[0.08em] text-[#59441b]">
                                        murwaj
                                    </span>

                                    <span id="watch-hour" class="watch-hand watch-hour"></span>
                                    <span id="watch-minute" class="watch-hand watch-minute"></span>
                                    <span id="watch-second" class="watch-hand watch-second"></span>

                                    <span
                                        class="absolute left-1/2 top-1/2 z-50 h-[5px] w-[5px] -translate-x-1/2 -translate-y-1/2 rounded-full border border-[#d7b866] bg-[#17130a]"></span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </header>


        {{-- ========================================================= --}}
        {{-- MOBILE TIME --}}
        {{-- ========================================================= --}}

        <div class="border-b border-[#c9a75e]/10 bg-[#11100e] px-4 py-3 text-center sm:hidden">

            <span class="mobile-location">
                {{ $labels['abu_dhabi'] }}
            </span>

            <span id="uae-digital-time-mobile"
                class="ms-2 font-mono text-[12px] font-semibold tracking-[0.08em] text-white">
                --:--:--
            </span>

        </div>


        {{-- ========================================================= --}}
        {{-- HERO --}}
        {{-- ========================================================= --}}

        <section class="relative overflow-hidden bg-[#10100e] text-white">

            <div class="pointer-events-none absolute inset-0">

                <div class="absolute -right-40 -top-40 h-[550px] w-[550px] rounded-full bg-[#b89550]/20 blur-[130px]">
                </div>

                <div class="absolute -bottom-60 -left-40 h-[500px] w-[500px] rounded-full bg-[#765321]/20 blur-[120px]">
                </div>

                <div class="absolute inset-0 opacity-[0.035]"
                    style="
                        background-image:
                        linear-gradient(30deg,#fff 12%,transparent 12.5%,transparent 87%,#fff 87.5%,#fff),
                        linear-gradient(150deg,#fff 12%,transparent 12.5%,transparent 87%,#fff 87.5%,#fff);
                        background-size:80px 140px;
                    ">
                </div>

            </div>


            <div class="relative mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

                <div
                    class="grid min-h-[650px] items-center gap-14 py-16 lg:grid-cols-[.95fr_1.05fr] lg:gap-20 lg:py-24">

                    <div class="{{ $isArabic ? 'lg:order-2' : 'lg:order-1' }}">

                        <div class="mb-7 flex items-center gap-4">

                            <span class="h-px w-12 bg-[#c9a75e]"></span>

                            <span class="hero-eyebrow">
                                {{ $labels['discover_uae'] }}
                            </span>

                        </div>


                        <h1 class="hero-title">
                            {{ $labels['uae_gifts'] }}
                        </h1>


                        <div class="mt-7 h-[2px] w-28 bg-gradient-to-r from-[#8c682c] via-[#e0c27a] to-transparent">
                        </div>


                        <p class="hero-description">
                            {{ $labels['hero_text'] }}
                        </p>


                        <div class="mt-9 flex flex-wrap gap-3">

                            <a href="#products" class="luxury-button group">

                                {{ $labels['explore_products'] }}

                                <span class="button-arrow">
                                    {{ $isArabic ? '←' : '→' }}
                                </span>

                            </a>


                            <a href="#categories" class="luxury-button-outline">
                                {{ $labels['browse_categories'] }}
                            </a>

                        </div>


                        <div class="mt-10 flex items-center gap-1.5">
                            <span class="h-1 w-10 bg-[#d71920]"></span>
                            <span class="h-1 w-10 bg-white"></span>
                            <span class="h-1 w-10 bg-[#00732f]"></span>
                            <span class="h-1 w-5 bg-black"></span>
                        </div>

                    </div>


                    <div class="{{ $isArabic ? 'lg:order-1' : 'lg:order-2' }} relative">

                        <div class="relative mx-auto max-w-[590px]">

                            <div class="absolute -inset-5 border border-[#c9a75e]/20"></div>
                            <div class="absolute -inset-1 border border-white/10"></div>

                            <div class="relative aspect-[4/5] overflow-hidden">

                                <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?q=80&w=928&auto=format&fit=crop"
                                    alt="{{ $labels['uae_heritage'] }}"
                                    class="h-full w-full object-cover transition duration-[1200ms] hover:scale-[1.04]">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#090909] via-[#090909]/10 to-transparent">
                                </div>


                                <div class="absolute bottom-7 start-7 end-7">

                                    <div class="heritage-overlay">

                                        <div class="flex items-center gap-4">

                                            <div class="flex h-10 w-7 shrink-0 overflow-hidden rounded-sm">
                                                {{-- Red vertical section --}}
                                                <span class="w-1/3 bg-[#D71920]"></span>

                                                {{-- Green / White / Black horizontal stripes --}}
                                                <span class="flex w-2/3 flex-col">
                                                    <span class="h-1/3 bg-[#00732F]"></span>
                                                    <span class="h-1/3 bg-white"></span>
                                                    <span class="h-1/3 bg-black"></span>
                                                </span>
                                            </div>

                                            <div>

                                                <p class="overlay-label">
                                                    {{ $labels['made_inspired'] }}
                                                </p>

                                                <p class="overlay-title">
                                                    {{ $labels['emirati_culture'] }}
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div
                                class="absolute -bottom-7 {{ $isArabic ? '-left-7' : '-right-7' }} hidden h-28 w-28 items-center justify-center rounded-full border border-[#c9a75e]/50 bg-[#151515] shadow-2xl sm:flex">

                                <div class="text-center">

                                    <div class="text-xl">🇦🇪</div>

                                    <p class="mt-2 text-[10px] font-semibold text-[#d7bd82]">
                                        {{ $labels['authentic_uae'] }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- CATEGORIES --}}
        {{-- ========================================================= --}}

        <section id="categories" class="mx-auto max-w-7xl scroll-mt-24 px-5 py-16 sm:px-6 lg:px-8 lg:py-20">

            <div class="mb-10">

                <div class="flex items-center gap-3">

                    <span class="h-px w-9 bg-[#b89550]"></span>

                    <span class="section-label">
                        {{ $labels['explore'] }}
                    </span>

                </div>


                <h2 class="section-title mt-3">
                    {{ $labels['local_traditional_products'] }}
                </h2>


                <p class="section-description">
                    {{ $labels['categories_text'] }}
                </p>

            </div>


            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">

                <a href="{{ route('uae') }}" class="category-card-dark group">

                    <div class="absolute -end-10 -top-10 h-32 w-32 rounded-full bg-[#c8a45d]/10 blur-2xl"></div>

                    <div class="relative text-3xl">🇦🇪</div>

                    <div class="relative">

                        <h3 class="category-title text-white">
                            {{ $labels['all_products'] }}
                        </h3>

                        <p class="category-subtitle text-white/50">
                            {{ $labels['explore_uae'] }}
                        </p>

                    </div>

                </a>


                @foreach ($subcategoriesCollection as $subcategory)
                    @php
                        $subcategoryName = $isArabic
                            ? $subcategory->subcategory_name_ar ?? $subcategory->subcategory_name
                            : $subcategory->subcategory_name;

                        $subcategorySlug = $subcategory->slug ?? '';

                        $icon = $categoryIcons[$subcategorySlug] ?? '✦';
                    @endphp


                    @if ($subcategorySlug)
                        <a href="{{ route('uae', ['subcategory' => $subcategorySlug]) }}"
                            class="category-card group">

                            <div
                                class="absolute -end-8 -top-8 h-20 w-20 rounded-full border border-[#c8a45d]/10 transition group-hover:border-[#c8a45d]/30">
                            </div>


                            <div class="relative flex items-start justify-between">

                                <span class="category-icon">
                                    {{ $icon }}
                                </span>

                                <span class="category-arrow">
                                    {{ $isArabic ? '←' : '→' }}
                                </span>

                            </div>


                            <div class="relative">

                                <h3 class="category-title">
                                    {{ $subcategoryName }}
                                </h3>

                                <p class="category-subtitle">
                                    {{ $labels['uae_heritage'] }}
                                </p>

                            </div>

                        </a>
                    @endif
                @endforeach

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- PRODUCTS --}}
        {{-- ========================================================= --}}

        <section id="products"
            class="scroll-mt-24 border-y border-black/[0.06] bg-white dark:border-white/10 dark:bg-[#0e0e0f]">

            <div class="mx-auto max-w-7xl px-5 py-16 sm:px-6 lg:px-8 lg:py-20">

                <div class="mb-10 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <div class="flex items-center gap-3">

                            <span class="h-px w-8 bg-[#b89550]"></span>

                            <span class="section-label">
                                {{ $labels['marketplace'] }}
                            </span>

                        </div>


                        <h2 class="section-title mt-3">
                            {{ $labels['discover_local_products'] }}
                        </h2>


                        <p class="section-description mt-3">
                            {{ $labels['local_products_text'] }}
                        </p>

                    </div>


                    <div class="luxury-count">

                        <span class="h-1.5 w-1.5 rounded-full bg-[#b89550]"></span>

                        {{ $productCount }}

                        {{ $labels['products'] }}

                    </div>

                </div>


                @if ($productsCollection->count())

                    <div class="grid grid-cols-2 gap-4 sm:gap-6 md:grid-cols-3 lg:grid-cols-4">

                        @foreach ($productsCollection as $product)
                            @php

                                $productTitle = $isArabic ? $product->title_ar ?? $product->title : $product->title;

                                $productDescription = $isArabic
                                    ? $product->description_ar ?? $product->description
                                    : $product->description;

                                $image = $product->image ?? null;

                                if (!$image && !empty($product->images)) {
                                    $images = is_array($product->images)
                                        ? $product->images
                                        : (method_exists($product->images, 'toArray')
                                            ? $product->images->toArray()
                                            : []);

                                    $firstImage = $images[0] ?? null;

                                    if (is_array($firstImage)) {
                                        $image =
                                            $firstImage['path'] ??
                                            ($firstImage['image'] ?? ($firstImage['url'] ?? null));
                                    } elseif (is_object($firstImage)) {
                                        $image =
                                            $firstImage->path ?? ($firstImage->image ?? ($firstImage->url ?? null));
                                    } elseif (is_string($firstImage)) {
                                        $image = $firstImage;
                                    }
                                }

                                $imageUrl = null;

                                if ($image) {
                                    $imageUrl = filter_var($image, FILTER_VALIDATE_URL)
                                        ? $image
                                        : asset('storage/' . ltrim($image, '/'));
                                }

                                $shopName = null;

                                if ($product->shop) {
                                    $shopName = $isArabic
                                        ? $product->shop->name_ar ?? $product->shop->name
                                        : $product->shop->name;
                                }

                                $productSubcategory = null;
                                $subcategoryTitle = null;

                                if (
                                    isset($product->subcategories) &&
                                    $product->subcategories &&
                                    $product->subcategories->count()
                                ) {
                                    $productSubcategory = $product->subcategories->first();

                                    $subcategoryTitle = $isArabic
                                        ? $productSubcategory->subcategory_name_ar ??
                                            $productSubcategory->subcategory_name
                                        : $productSubcategory->subcategory_name;
                                }
                            @endphp


                            <article class="product-card group">

                                <div class="relative aspect-[4/4.5] overflow-hidden bg-[#f3efe6] dark:bg-[#202022]">

                                    @if ($imageUrl)
                                        <img src="{{ $imageUrl }}" alt="{{ $productTitle }}" loading="lazy"
                                            class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.06]">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center">
                                            <span class="text-5xl opacity-20">🇦🇪</span>
                                        </div>
                                    @endif


                                    <div
                                        class="pointer-events-none absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-black/30 to-transparent opacity-0 transition group-hover:opacity-100">
                                    </div>


                                    <span class="product-badge start-3">
                                        {{ $labels['uae_local'] }}
                                    </span>


                                    <span class="product-country end-3">
                                        🇦🇪
                                    </span>

                                </div>


                                <div class="p-4 sm:p-5">

                                    @if ($subcategoryTitle)
                                        <p class="product-category">
                                            {{ $subcategoryTitle }}
                                        </p>
                                    @endif


                                    <h3 class="product-title">
                                        {{ $productTitle }}
                                    </h3>


                                    @if ($productDescription)
                                        <p class="product-description">

                                            {{ \Illuminate\Support\Str::limit(strip_tags($productDescription), 90) }}

                                        </p>
                                    @endif


                                    @if ($shopName)
                                        <div class="mt-5 flex items-center gap-2.5">

                                            <div class="seller-icon">
                                                🏪
                                            </div>

                                            <div class="min-w-0">

                                                <p class="seller-name">
                                                    {{ $shopName }}
                                                </p>

                                                <p class="seller-label">
                                                    {{ $labels['uae_seller'] }}
                                                </p>

                                            </div>

                                        </div>
                                    @endif


                                    <div
                                        class="mt-5 flex items-end justify-between border-t border-black/[0.06] pt-4 dark:border-white/10">

                                        <div>

                                            <p class="price-label">
                                                {{ $labels['price'] }}
                                            </p>


                                            @if ($product->price !== null)
                                                <span class="product-price">
                                                    AED {{ number_format((float) $product->price, 2) }}
                                                </span>
                                            @endif

                                        </div>


                                        <span class="product-uae">
                                            {{ $labels['uae'] }}
                                        </span>

                                    </div>

                                </div>

                            </article>
                        @endforeach

                    </div>


                    @if (method_exists($productsCollection, 'hasPages') && $productsCollection->hasPages())
                        <div class="mt-12 border-t border-black/[0.07] pt-7 dark:border-white/10">
                            {{ $productsCollection->links() }}
                        </div>
                    @endif
                @else
                    <div class="py-24 text-center">

                        <div
                            class="mx-auto flex h-20 w-20 items-center justify-center rounded-full border border-[#d8c79f] bg-[#faf7ef] text-3xl dark:border-white/10 dark:bg-white/5">
                            🇦🇪
                        </div>


                        <h3 class="mt-6 text-2xl font-bold text-slate-900 dark:text-white">
                            {{ $labels['no_products'] }}
                        </h3>


                        <p
                            class="mx-auto mt-3 max-w-md text-base font-normal leading-7 text-slate-500 dark:text-slate-400">
                            {{ $labels['no_products_text'] }}
                        </p>


                        <a href="{{ route('uae') }}"
                            class="mt-7 inline-flex bg-[#171717] px-7 py-3.5 text-sm font-semibold text-white transition hover:bg-[#9a793a] dark:bg-white dark:text-[#171717]">
                            {{ $labels['view_all'] }}
                        </a>

                    </div>

                @endif

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- HERITAGE --}}
        {{-- ========================================================= --}}

        <section class="mx-auto max-w-7xl px-5 py-16 sm:px-6 lg:px-8 lg:py-24">

            <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-20">

                <div>

                    <div class="mb-5 flex items-center gap-3">

                        <span class="h-px w-9 bg-[#b89550]"></span>

                        <span class="section-label">
                            {{ $labels['emirati_heritage'] }}
                        </span>

                    </div>


                    <h2 class="heritage-title">

                        {{ $labels['more_than_product'] }}

                        <span>
                            {{ $labels['uae_story'] }}
                        </span>

                    </h2>


                    <p class="heritage-description">
                        {{ $labels['heritage_text'] }}
                    </p>


                    <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <div class="heritage-card">

                            <div class="heritage-icon">
                                🌴
                            </div>

                            <h3 class="heritage-card-title">
                                {{ $labels['local_heritage'] }}
                            </h3>

                            <p class="heritage-card-text">
                                {{ $labels['local_heritage_text'] }}
                            </p>

                        </div>


                        <div class="heritage-card">

                            <div class="heritage-icon">
                                🏪
                            </div>

                            <h3 class="heritage-card-title">
                                {{ $labels['uae_sellers'] }}
                            </h3>

                            <p class="heritage-card-text">
                                {{ $labels['uae_sellers_text'] }}
                            </p>

                        </div>

                    </div>

                </div>


                <div class="relative">

                    <div class="absolute -inset-3 border border-[#c9a75e]/25"></div>

                    <div class="relative aspect-[4/4.5] overflow-hidden">

                        <img src="https://images.unsplash.com/photo-1518684079-3c830dcef090?q=85&w=1400&auto=format&fit=crop"
                            alt="{{ $labels['united_arab_emirates'] }}" loading="lazy"
                            class="h-full w-full object-cover transition duration-1000 hover:scale-105">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>


                        <div class="absolute bottom-7 start-7 end-7">

                            <div class="border-s-2 border-[#d4b66f] ps-5">

                                <p class="overlay-label">
                                    {{ $labels['united_arab_emirates'] }}
                                </p>

                                <p class="mt-2 text-2xl font-bold text-white sm:text-3xl">
                                    {{ $labels['shop_local'] }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- SELLER --}}
        {{-- ========================================================= --}}

        <section id="seller" class="relative scroll-mt-24 overflow-hidden bg-[#131313] text-white">

            <div class="absolute -end-32 -top-32 h-96 w-96 rounded-full bg-[#b89550]/15 blur-[100px]"></div>


            <div class="relative mx-auto max-w-7xl px-5 py-16 sm:px-6 lg:px-8 lg:py-20">

                <div
                    class="flex flex-col gap-10 border border-[#c8a45d]/20 p-7 sm:p-10 lg:flex-row lg:items-center lg:justify-between lg:p-12">

                    <div class="max-w-2xl">

                        <div class="flex items-center gap-3">

                            <span class="h-px w-8 bg-[#c8a45d]"></span>

                            <span class="section-label section-label-dark">
                                {{ $labels['uae_sellers'] }}
                            </span>

                        </div>


                        <h2 class="seller-title">
                            {{ $labels['have_local_product'] }}
                        </h2>


                        <p class="seller-description">
                            {{ $labels['seller_text'] }}
                        </p>

                    </div>


                    <a href="{{ route('shop.create') }}" class="luxury-button group shrink-0">

                        {{ $labels['start_selling'] }}

                        <span class="button-arrow">
                            {{ $isArabic ? '←' : '→' }}
                        </span>

                    </a>

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- FOOTER --}}
        {{-- ========================================================= --}}

        <footer class="bg-[#090909] px-5 py-10 text-white sm:px-6">

            <div class="mx-auto flex max-w-7xl flex-col gap-7 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <div class="flex items-center gap-3">

                        <span class="text-xl">🇦🇪</span>

                        <span class="footer-brand">
                            {{ $labels['uae_collection'] }}
                        </span>

                    </div>


                    <p class="footer-country">
                        {{ $labels['united_arab_emirates'] }}
                    </p>

                </div>


                <div class="text-end">

                    <div id="uae-digital-time"
                        class="font-mono text-lg font-semibold tracking-[0.12em] text-[#d4b66f]">
                        --:--:--
                    </div>

                    <div class="footer-time-label">
                        {{ $labels['abu_dhabi'] }}
                    </div>

                </div>

            </div>

        </footer>

    </div>


    {{-- ============================================================= --}}
    {{-- TYPOGRAPHY + DESIGN --}}
    {{-- ============================================================= --}}

    <style>
        /*
        |--------------------------------------------------------------------------
        | UAE TYPOGRAPHY
        |--------------------------------------------------------------------------
        */

        .uae-page,
        .uae-page * {
            font-family:
                "IBM Plex Sans Arabic",
                "Noto Sans Arabic",
                "Tahoma",
                "Arial",
                sans-serif;
        }


        .uae-page {
            font-weight: 400;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }


        /*
        |--------------------------------------------------------------------------
        | RTL ARABIC
        |--------------------------------------------------------------------------
        */

        [dir="rtl"] .uae-page {
            letter-spacing: 0;
        }


        [dir="rtl"] .hero-title,
        [dir="rtl"] .section-title,
        [dir="rtl"] .heritage-title,
        [dir="rtl"] .seller-title,
        [dir="rtl"] .product-title,
        [dir="rtl"] .category-title {
            letter-spacing: 0;
        }


        /*
        |--------------------------------------------------------------------------
        | BRAND
        |--------------------------------------------------------------------------
        */

        .brand-title {
            font-size: 14px;
            line-height: 1.4;
            font-weight: 700;
            letter-spacing: .08em;
        }


        .brand-subtitle {
            margin-top: 4px;
            color: #d5b66e;
            font-size: 9px;
            line-height: 1.5;
            font-weight: 600;
            letter-spacing: .12em;
        }


        /*
        |--------------------------------------------------------------------------
        | NAVIGATION
        |--------------------------------------------------------------------------
        */

        .nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            color: rgba(255, 255, 255, .68);
            font-size: 13px;
            line-height: 1.5;
            font-weight: 600;
            letter-spacing: .04em;
            transition:
                color .25s ease,
                transform .25s ease;
        }


        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -8px;
            height: 1px;
            transform: scaleX(0);
            transform-origin: center;
            background: #d5b66e;
            transition: transform .25s ease;
        }


        .nav-link:hover {
            color: #d8bb75;
            transform: translateY(-1px);
        }


        .nav-link:hover::after {
            transform: scaleX(1);
        }


        /*
        |--------------------------------------------------------------------------
        | CLOCK LABELS
        |--------------------------------------------------------------------------
        */

        .clock-label {
            color: #c9a75e;
            font-size: 9px;
            line-height: 1.6;
            font-weight: 600;
            letter-spacing: .08em;
        }


        .clock-location {
            margin-top: 3px;
            color: rgba(255, 255, 255, .52);
            font-size: 11px;
            line-height: 1.6;
            font-weight: 500;
        }


        .mobile-location {
            color: #c9a75e;
            font-size: 11px;
            font-weight: 600;
        }


        /*
        |--------------------------------------------------------------------------
        | HERO
        |--------------------------------------------------------------------------
        */

        .hero-eyebrow {
            color: #d9bf82;
            font-size: 12px;
            line-height: 1.7;
            font-weight: 600;
            letter-spacing: .04em;
        }


        .hero-title {
            max-width: 850px;
            color: white;
            font-size: clamp(2.25rem, 5vw, 4.65rem);
            line-height: 1.16;
            font-weight: 700;
            letter-spacing: -.025em;
        }


        .hero-description {
            max-width: 700px;
            margin-top: 28px;
            color: rgba(255, 255, 255, .72);
            font-size: 17px;
            line-height: 2;
            font-weight: 400;
        }


        /*
        |--------------------------------------------------------------------------
        | BUTTONS
        |--------------------------------------------------------------------------
        */

        .luxury-button {
            display: inline-flex;
            min-height: 50px;
            align-items: center;
            justify-content: center;
            gap: .75rem;
            padding: .8rem 1.55rem;
            background: linear-gradient(100deg, #bd984b, #e4c77f);
            color: #151515;
            font-size: 13px;
            line-height: 1.5;
            font-weight: 700;
            letter-spacing: .02em;
            box-shadow: 0 15px 40px -12px rgba(211, 174, 93, .5);
            transition:
                transform .3s ease,
                box-shadow .3s ease,
                filter .3s ease;
        }


        .luxury-button:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
            box-shadow: 0 20px 45px -12px rgba(211, 174, 93, .65);
        }


        .luxury-button-outline {
            display: inline-flex;
            min-height: 50px;
            align-items: center;
            justify-content: center;
            padding: .8rem 1.55rem;
            border: 1px solid rgba(255, 255, 255, .25);
            background: rgba(255, 255, 255, .025);
            color: white;
            font-size: 13px;
            line-height: 1.5;
            font-weight: 600;
            letter-spacing: .02em;
            backdrop-filter: blur(10px);
            transition:
                border-color .3s ease,
                background .3s ease,
                transform .3s ease;
        }


        .luxury-button-outline:hover {
            transform: translateY(-2px);
            border-color: #c9a75e;
            background: rgba(201, 167, 94, .1);
        }


        .button-arrow {
            font-size: 17px;
            line-height: 1;
        }


        /*
        |--------------------------------------------------------------------------
        | SECTION TYPOGRAPHY
        |--------------------------------------------------------------------------
        */

        .section-label {
            color: #9b7737;
            font-size: 12px;
            line-height: 1.6;
            font-weight: 600;
            letter-spacing: .08em;
        }


        .section-label-dark {
            color: #d4b66f;
        }


        .section-title {
            color: #171717;
            font-size: clamp(1.9rem, 4vw, 2.8rem);
            line-height: 1.25;
            font-weight: 700;
            letter-spacing: -.025em;
        }


        .dark .section-title {
            color: white;
        }


        .section-description {
            max-width: 700px;
            margin-top: 14px;
            color: #64748b;
            font-size: 15px;
            line-height: 1.9;
            font-weight: 400;
        }


        .dark .section-description {
            color: #94a3b8;
        }


        /*
        |--------------------------------------------------------------------------
        | CATEGORY CARDS
        |--------------------------------------------------------------------------
        */

        .category-card,
        .category-card-dark {
            position: relative;
            display: flex;
            min-height: 165px;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            padding: 1.35rem;
            border-radius: 2px;
            transition:
                transform .3s ease,
                box-shadow .3s ease,
                border-color .3s ease;
        }


        .category-card {
            border: 1px solid rgba(0, 0, 0, .07);
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .025);
        }


        .category-card-dark {
            background: #151515;
            color: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
        }


        .category-card:hover,
        .category-card-dark:hover {
            transform: translateY(-5px);
        }


        .category-card:hover {
            border-color: #c8a45d;
            box-shadow: 0 20px 40px -25px rgba(150, 110, 35, .45);
        }


        .category-icon {
            display: flex;
            height: 45px;
            width: 45px;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: #f6f1e6;
            font-size: 21px;
        }


        .dark .category-icon {
            background: rgba(255, 255, 255, .05);
        }


        .category-title {
            margin-top: 20px;
            color: #171717;
            font-size: 14px;
            line-height: 1.65;
            font-weight: 700;
        }


        .category-card-dark .category-title {
            color: white;
        }


        .category-subtitle {
            margin-top: 5px;
            color: #a17d35;
            font-size: 11px;
            line-height: 1.6;
            font-weight: 500;
        }


        .category-arrow {
            color: #cbd5e1;
            font-size: 16px;
            transition: color .25s ease;
        }


        .category-card:hover .category-arrow {
            color: #a17d35;
        }


        /*
        |--------------------------------------------------------------------------
        | PRODUCT COUNT
        |--------------------------------------------------------------------------
        */

        .luxury-count {
            display: inline-flex;
            width: fit-content;
            align-items: center;
            gap: .5rem;
            border: 1px solid #d9ccb0;
            background: #faf7ef;
            padding: .55rem 1rem;
            color: #8e6c32;
            font-size: 12px;
            line-height: 1.5;
            font-weight: 600;
        }


        /*
        |--------------------------------------------------------------------------
        | PRODUCT CARDS
        |--------------------------------------------------------------------------
        */

        .product-card {
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, .07);
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .035);
            transition:
                transform .5s ease,
                border-color .5s ease,
                box-shadow .5s ease;
        }


        .dark .product-card {
            border-color: rgba(255, 255, 255, .10);
            background: #151515;
        }


        .product-card:hover {
            transform: translateY(-5px);
            border-color: #d4b66f;
            box-shadow: 0 25px 55px -30px rgba(139, 103, 42, .45);
        }


        .product-badge {
            position: absolute;
            top: 12px;
            background: rgba(21, 21, 21, .92);
            padding: 6px 10px;
            color: white;
            font-size: 10px;
            line-height: 1.4;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }


        .product-country {
            position: absolute;
            top: 12px;
            background: rgba(255, 255, 255, .92);
            padding: 6px 8px;
            color: #171717;
            font-size: 12px;
            line-height: 1.4;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }


        .product-category {
            margin-bottom: 8px;
            color: #a17d35;
            font-size: 10px;
            line-height: 1.6;
            font-weight: 600;
        }


        .product-title {
            min-height: 3rem;
            color: #171717;
            font-size: 16px;
            line-height: 1.55;
            font-weight: 700;
        }


        .dark .product-title {
            color: white;
        }


        .product-description {
            min-height: 2.8rem;
            margin-top: 8px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
            font-weight: 400;
        }


        .dark .product-description {
            color: #94a3b8;
        }


        .seller-icon {
            display: flex;
            height: 31px;
            width: 31px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            border: 1px solid #e6ddc9;
            background: #faf7ef;
            font-size: 14px;
        }


        .dark .seller-icon {
            border-color: rgba(255, 255, 255, .10);
            background: rgba(255, 255, 255, .05);
        }


        .seller-name {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #475569;
            font-size: 12px;
            line-height: 1.5;
            font-weight: 600;
        }


        .dark .seller-name {
            color: #cbd5e1;
        }


        .seller-label {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
            font-weight: 500;
        }


        .price-label {
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
            font-weight: 500;
        }


        .product-price {
            display: block;
            margin-top: 3px;
            color: #171717;
            font-size: 17px;
            line-height: 1.5;
            font-weight: 700;
        }


        .dark .product-price {
            color: white;
        }


        .product-uae {
            color: #a17d35;
            font-size: 11px;
            line-height: 1.5;
            font-weight: 600;
        }


        /*
        |--------------------------------------------------------------------------
        | HERITAGE
        |--------------------------------------------------------------------------
        */

        .heritage-title {
            max-width: 650px;
            color: #171717;
            font-size: clamp(2rem, 4vw, 3.5rem);
            line-height: 1.25;
            font-weight: 700;
            letter-spacing: -.025em;
        }


        .dark .heritage-title {
            color: white;
        }


        .heritage-title span {
            color: #a17d35;
        }


        .heritage-description {
            max-width: 650px;
            margin-top: 24px;
            color: #475569;
            font-size: 16px;
            line-height: 2;
            font-weight: 400;
        }


        .dark .heritage-description {
            color: #cbd5e1;
        }


        .heritage-card {
            border: 1px solid rgba(0, 0, 0, .07);
            background: white;
            padding: 1.35rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .025);
        }


        .dark .heritage-card {
            border-color: rgba(255, 255, 255, .10);
            background: #151515;
        }


        .heritage-icon {
            display: flex;
            height: 44px;
            width: 44px;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: #f7f1e4;
            font-size: 20px;
        }


        .dark .heritage-icon {
            background: rgba(255, 255, 255, .05);
        }


        .heritage-card-title {
            margin-top: 15px;
            color: #171717;
            font-size: 15px;
            line-height: 1.6;
            font-weight: 700;
        }


        .dark .heritage-card-title {
            color: white;
        }


        .heritage-card-text {
            margin-top: 8px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.8;
            font-weight: 400;
        }


        .dark .heritage-card-text {
            color: #94a3b8;
        }


        /*
        |--------------------------------------------------------------------------
        | SELLER
        |--------------------------------------------------------------------------
        */

        .seller-title {
            margin-top: 18px;
            color: white;
            font-size: clamp(1.8rem, 4vw, 3rem);
            line-height: 1.3;
            font-weight: 700;
        }


        .seller-description {
            margin-top: 18px;
            color: rgba(255, 255, 255, .62);
            font-size: 16px;
            line-height: 1.95;
            font-weight: 400;
        }


        /*
        |--------------------------------------------------------------------------
        | OVERLAY
        |--------------------------------------------------------------------------
        */

        .heritage-overlay {
            border: 1px solid rgba(255, 255, 255, .15);
            background: rgba(0, 0, 0, .60);
            padding: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .25);
            backdrop-filter: blur(16px);
        }


        .overlay-label {
            color: #d7bd82;
            font-size: 10px;
            line-height: 1.6;
            font-weight: 600;
        }


        .overlay-title {
            margin-top: 4px;
            color: white;
            font-size: 15px;
            line-height: 1.6;
            font-weight: 600;
        }


        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        .footer-brand {
            color: white;
            font-size: 13px;
            line-height: 1.6;
            font-weight: 600;
        }


        .footer-country {
            margin-top: 7px;
            color: rgba(255, 255, 255, .38);
            font-size: 10px;
            line-height: 1.6;
            font-weight: 500;
        }


        .footer-time-label {
            margin-top: 4px;
            color: rgba(255, 255, 255, .38);
            font-size: 10px;
            line-height: 1.6;
            font-weight: 500;
        }


        /*
        |--------------------------------------------------------------------------
        | WATCH
        |--------------------------------------------------------------------------
        */

        .uae-watch {
            transform: translateZ(0);
            transition:
                transform .4s cubic-bezier(.2, .8, .2, 1),
                box-shadow .4s ease;

            box-shadow:
                0 12px 40px -10px rgba(218, 179, 91, .5),
                inset 0 0 0 1px rgba(255, 255, 255, .18);
        }


        .uae-watch:hover {
            transform: translateY(-2px) scale(1.035);

            box-shadow:
                0 18px 50px -10px rgba(218, 179, 91, .68),
                0 0 0 1px rgba(255, 255, 255, .1);
        }


        .uae-watch::after {
            content: "";
            position: absolute;
            right: -5px;
            top: 50%;
            width: 5px;
            height: 12px;
            transform: translateY(-50%);
            border-radius: 0 3px 3px 0;
            background: linear-gradient(to bottom,
                    #d9bd70,
                    #74531e,
                    #d9bd70);
        }


        [dir="rtl"] .uae-watch::after {
            right: auto;
            left: -5px;
            border-radius: 3px 0 0 3px;
        }


        .watch-hand {
            position: absolute;
            left: 50%;
            bottom: 50%;
            z-index: 20;
            display: block;
            width: 1px;
            transform-origin: 50% 100%;
            transform: translateX(-50%) rotate(0deg);
            border-radius: 999px;
            pointer-events: none;
        }


        .watch-hour {
            width: 2px;
            height: 14px;
            background: #15110a;
            z-index: 25;
        }


        .watch-minute {
            width: 1.4px;
            height: 19px;
            background: #29200d;
            z-index: 26;
        }


        .watch-second {
            width: .7px;
            height: 21px;
            background: #a11919;
            z-index: 27;
        }


        /*
        |--------------------------------------------------------------------------
        | GENERAL
        |--------------------------------------------------------------------------
        */

        html {
            scroll-behavior: smooth;
        }


        .uae-page ::selection {
            background: #c9a75e;
            color: #111;
        }


        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 768px) {

            .hero-title {
                font-size: clamp(2rem, 9vw, 3rem);
                line-height: 1.25;
            }


            .hero-description {
                font-size: 15px;
                line-height: 1.9;
            }


            .section-title {
                font-size: 1.9rem;
                line-height: 1.3;
            }


            .section-description {
                font-size: 14px;
                line-height: 1.85;
            }


            .category-card,
            .category-card-dark {
                min-height: 155px;
                padding: 1.15rem;
            }


            .category-title {
                font-size: 13px;
                line-height: 1.65;
            }


            .product-title {
                font-size: 14px;
                line-height: 1.6;
            }


            .product-description {
                font-size: 12px;
                line-height: 1.7;
            }


            .heritage-description {
                font-size: 15px;
                line-height: 1.9;
            }


            .seller-description {
                font-size: 15px;
                line-height: 1.9;
            }

        }


        @media (max-width: 480px) {

            .luxury-button,
            .luxury-button-outline {
                width: 100%;
                min-height: 52px;
                font-size: 13px;
            }


            .hero-description {
                font-size: 15px;
                line-height: 1.95;
            }


            .product-card {
                box-shadow: 0 3px 12px rgba(0, 0, 0, .03);
            }


            .product-title {
                min-height: 3rem;
                font-size: 14px;
            }


            .product-price {
                font-size: 15px;
            }

        }
    </style>


    {{-- ============================================================= --}}
    {{-- UAE CLOCK --}}
    {{-- ============================================================= --}}

    <script>
        (() => {

            'use strict';


            const timezone = 'Asia/Dubai';


            const hourHand =
                document.getElementById('watch-hour');

            const minuteHand =
                document.getElementById('watch-minute');

            const secondHand =
                document.getElementById('watch-second');


            const desktopDigital =
                document.getElementById('uae-digital-time');


            const mobileDigital =
                document.getElementById('uae-digital-time-mobile');


            function getUaeTime() {

                const parts =
                    new Intl.DateTimeFormat('en-US', {
                        timeZone: timezone,
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false,
                        hourCycle: 'h23'
                    }).formatToParts(new Date());


                const values = {};


                parts.forEach((part) => {

                    if (part.type !== 'literal') {
                        values[part.type] = Number(part.value);
                    }

                });


                return {
                    hours: values.hour ?? 0,
                    minutes: values.minute ?? 0,
                    seconds: values.second ?? 0
                };

            }


            function updateUaeClock() {

                const {
                    hours,
                    minutes,
                    seconds
                } = getUaeTime();


                const secondDegrees =
                    seconds * 6;


                const minuteDegrees =
                    minutes * 6 +
                    seconds * 0.1;


                const hourDegrees =
                    (hours % 12) * 30 +
                    minutes * 0.5;


                if (secondHand) {

                    secondHand.style.transform =
                        `translateX(-50%) rotate(${secondDegrees}deg)`;

                }


                if (minuteHand) {

                    minuteHand.style.transform =
                        `translateX(-50%) rotate(${minuteDegrees}deg)`;

                }


                if (hourHand) {

                    hourHand.style.transform =
                        `translateX(-50%) rotate(${hourDegrees}deg)`;

                }


                const formatted =
                    `${String(hours).padStart(2, '0')}:` +
                    `${String(minutes).padStart(2, '0')}:` +
                    `${String(seconds).padStart(2, '0')}`;


                if (desktopDigital) {
                    desktopDigital.textContent = formatted;
                }


                if (mobileDigital) {
                    mobileDigital.textContent = formatted;
                }

            }


            updateUaeClock();


            setInterval(updateUaeClock, 1000);

        })();
    </script>

    <x-main-footer></x-main-footer>
</x-main-layout>
