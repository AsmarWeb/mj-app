<section class="overflow-hidden">

    @php
        $mapShops = $shops
            ->map(function ($shop) {
                return [
                    'name' => $shop->name,
                    'lat' => $shop->latitude,
                    'lng' => $shop->longitude,
                    'url' => route('shop', $shop->slug),
                    'logo' => $shop->logo ? Storage::disk('public')->url($shop->logo) : null,
                ];
            })
            ->values();
    @endphp


    <div class="max-w-7xl mx-auto px-6 py-16 text-center">


        {{-- HERO TITLE --}}

        <div class="mx-auto mt-10 flex justify-center px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8">
            <div class="text-center ">
                <h1
                    class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-slate-200 sm:text-5xl md:text-6xl">
                    <span class="block xl:inline"><span class="mb-1 block">{{ __('hero.main.title') }}</span>
                        <span class="bg-gradient-to-r from-indigo-400 to-pink-600 bg-clip-text text-transparent">
                            {{ __('hero.main.Sell Smarter') }}
                        </span>
                    </span>
                    <div class="mt-2">{{ __('hero.main.Get Found') }}
                        <span class="relative mt-3 whitespace-nowrap text-orange-600"><svg aria-hidden="true"
                                viewBox="0 0 418 42"
                                class="absolute top-3/4 left-0 right-0 m-auto h-[0.58em] w-fit fill-pink-400/50"
                                preserveAspectRatio="none">
                                <path
                                    d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.78 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.54-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.81 23.239-7.825 27.934-10.149 28.304-14.005.417-4.348-3.529-6-16.878-7.066Z">
                                </path>
                            </svg>
                            <span class="relative">{{ __('hero.main.With') }} {{ __('hero.main.AI tools') }}</span>
                        </span>
                    </div>
                </h1>
                <p class="mx-auto mt-3 max-w-xl text-lg text-gray-500 dark:text-slate-400 sm:mt-5 md:mt-5">
                    {{ __('hero.main.subtitle') }}
                </p>
            </div>
        </div>



        {{-- SEARCH --}}

        <form action="{{ route('search') }}" method="GET" class="mt-10">


            <div
                class="max-w-3xl mx-auto flex flex-col sm:flex-row gap-3
                        bg-white dark:bg-gray-900
                        rounded-3xl shadow-xl p-3">


                <input type="text" name="q" required placeholder="{{ __('hero.form.placeholder') }}"
                    class="flex-1 rounded-2xl px-6 py-4
                           border-gray-200 dark:border-gray-700
                           bg-gray-50 dark:bg-gray-800
                           dark:text-white focus:ring-orange-500">


                <button
                    class="px-8 py-4 rounded-2xl
                           bg-orange-600 hover:bg-orange-700
                           text-white font-bold">

                    {{ __('hero.form.button') }}

                </button>


            </div>


        </form>




        {{-- SEARCH TAGS --}}

        <div class="mt-8 flex flex-wrap justify-center gap-3">

            @foreach (['Furniture', 'Cars', 'Property', 'Jobs', 'Templates'] as $tag)
                <a href="{{ route('search', ['q' => $tag]) }}"
                    class="px-5 py-2 rounded-full
                          bg-gray-100 dark:bg-gray-800
                          text-gray-700 dark:text-gray-200
                          hover:bg-orange-600 hover:text-white transition">

                    {{ $tag }}

                </a>
            @endforeach

        </div>





        {{-- FEATURED SHOPS --}}


        <div class="mt-20">


            <h2 class="text-3xl font-black text-gray-900 dark:text-white">

                Featured Shops

            </h2>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-10">


                @foreach ($shops as $shop)
                    <a href="{{ route('shop', $shop->slug) }}"
                        class="bg-white dark:bg-gray-900
                              rounded-3xl shadow
                              p-6
                              hover:-translate-y-2
                              transition">


                        @if ($shop->logo)
                            <img src="{{ Storage::disk('public')->url($shop->logo) }}"
                                class="w-28 h-28 mx-auto rounded-full object-cover">
                        @else
                            <div
                                class="w-28 h-28 mx-auto rounded-full
                                        flex items-center justify-center
                                        bg-gradient-to-br from-indigo-500 to-orange-500
                                        text-white text-4xl font-black">

                                {{ strtoupper(substr($shop->name, 0, 1)) }}

                            </div>
                        @endif



                        <h3
                            class="mt-5 font-bold text-lg
                                   text-gray-900 dark:text-white">

                            {{ $shop->name }}

                        </h3>


                    </a>
                @endforeach


            </div>


        </div>








        {{-- =========================================================
          MARKETPLACE SHOP MAP
         ========================================================= --}}

        <section class="mt-16 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl">

                {{-- Header --}}
                <div class="mb-8 text-center">

                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-orange-600 shadow-sm dark:bg-orange-500/10 dark:text-orange-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21s7-4.35 7-10a7 7 0 10-14 0c0 5.65 7 10 7 10z" />

                            <circle cx="12" cy="11" r="2.5" />

                        </svg>
                    </div>

                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                        Explore Our Shops
                    </h2>

                    <p class="mx-auto mt-3 max-w-2xl text-gray-500 dark:text-gray-400">
                        Discover shops and marketplace sellers from different locations around the world.
                    </p>

                </div>


                {{-- Map Card --}}
                <div
                    class="group relative overflow-hidden rounded-[2rem] border border-gray-200 bg-white shadow-2xl shadow-gray-200/50 dark:border-gray-700 dark:bg-gray-900 dark:shadow-black/30">

                    {{-- Map --}}
                    <div id="marketplace-map" class="h-[450px] w-full sm:h-[550px] lg:h-[600px]">
                    </div>


                    {{-- Map Top Badge --}}
                    <div
                        class="pointer-events-none absolute left-4 top-4 z-[500] flex items-center gap-2 rounded-full border border-gray-200 bg-white/95 px-4 py-2 text-sm font-semibold text-gray-700 shadow-lg backdrop-blur dark:border-gray-700 dark:bg-gray-900/95 dark:text-gray-200">

                        <span class="relative flex h-3 w-3">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-orange-400 opacity-75">
                            </span>

                            <span class="relative inline-flex h-3 w-3 rounded-full bg-orange-500">
                            </span>
                        </span>

                        Marketplace Shops

                    </div>


                    {{-- Bottom Information --}}
                    <div
                        class="absolute bottom-4 left-4 right-4 z-[500] flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div
                            class="rounded-2xl border border-gray-200 bg-white/95 px-4 py-3 shadow-lg backdrop-blur dark:border-gray-700 dark:bg-gray-900/95">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-orange-100 text-orange-600 dark:bg-orange-500/10 dark:text-orange-400">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 21s7-4.35 7-10a7 7 0 10-14 0c0 5.65 7 10 7 10z" />

                                        <circle cx="12" cy="11" r="2.5" />

                                    </svg>

                                </div>

                                <div>

                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Available shops
                                    </p>

                                    <p id="shop-count" class="font-bold text-gray-900 dark:text-white">
                                        Loading...
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            ```

        </section>

        {{-- =========================================================
LEAFLET
========================================================= --}}

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

        <style>
            /*
    |--------------------------------------------------------------------------
    | Leaflet Styling
    |--------------------------------------------------------------------------
    */

            #marketplace-map {
                z-index: 1;
            }

            #marketplace-map .leaflet-control-zoom {
                border: none !important;
                box-shadow: 0 8px 25px rgba(0, 0, 0, .12) !important;
            }

            #marketplace-map .leaflet-control-zoom a {
                width: 38px;
                height: 38px;
                line-height: 38px;
                border: none !important;
                color: #374151;
                background: rgba(255, 255, 255, .95);
            }

            #marketplace-map .leaflet-control-zoom a:hover {
                background: #f97316;
                color: white;
            }

            #marketplace-map .leaflet-control-attribution {
                font-size: 10px;
                background: rgba(255, 255, 255, .85);
                padding: 3px 7px;
                border-radius: 8px 0 0 0;
            }

            /*
    |--------------------------------------------------------------------------
    | Popup
    |--------------------------------------------------------------------------
    */

            .marketplace-popup .leaflet-popup-content-wrapper {
                border-radius: 18px;
                padding: 0;
                overflow: hidden;
                box-shadow: 0 15px 40px rgba(0, 0, 0, .18);
            }

            .marketplace-popup .leaflet-popup-content {
                margin: 0;
                min-width: 220px;
            }

            .marketplace-popup .leaflet-popup-tip {
                box-shadow: 0 4px 10px rgba(0, 0, 0, .08);
            }

            /*
    |--------------------------------------------------------------------------
    | Custom Marker
    |--------------------------------------------------------------------------
    */

            .shop-marker {
                position: relative;
                width: 42px;
                height: 42px;
                border-radius: 50% 50% 50% 0;
                background: #f97316;
                border: 3px solid white;
                box-shadow: 0 6px 18px rgba(249, 115, 22, .4);
                transform: rotate(-45deg);
            }

            .shop-marker-inner {
                position: absolute;
                inset: 6px;
                border-radius: 50%;
                background: white;
            }

            .shop-marker-dot {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 9px;
                height: 9px;
                border-radius: 50%;
                background: #f97316;
                transform: translate(-50%, -50%);
            }

            /*
    |--------------------------------------------------------------------------
    | Dark mode popup
    |--------------------------------------------------------------------------
    */

            @media (prefers-color-scheme: dark) {

                .marketplace-popup .leaflet-popup-content-wrapper,
                .marketplace-popup .leaflet-popup-tip {
                    background: #111827;
                    color: white;
                }

            }
        </style>

        <script>
            (function() {

                function initializeMarketplaceMap() {

                    /*
                    |--------------------------------------------------------------------------
                    | Check Leaflet
                    |--------------------------------------------------------------------------
                    */

                    if (typeof L === 'undefined') {
                        console.error('Leaflet.js is not loaded.');
                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Find Map
                    |--------------------------------------------------------------------------
                    */

                    const mapElement = document.getElementById('marketplace-map');

                    if (!mapElement) {
                        console.error('Marketplace map element not found.');
                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Prevent Duplicate Map
                    |--------------------------------------------------------------------------
                    */

                    if (mapElement._leaflet_id) {
                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Shop Data From Laravel
                    |--------------------------------------------------------------------------
                    */

                    const shops = @json($mapShops ?? []);


                    /*
                    |--------------------------------------------------------------------------
                    | Create Map
                    |--------------------------------------------------------------------------
                    */

                    const map = L.map('marketplace-map', {

                        zoomControl: false,

                        scrollWheelZoom: true,

                        dragging: true,

                        doubleClickZoom: true,

                        touchZoom: true,

                    }).setView(
                        [24.4539, 54.3773],
                        5
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Zoom Controls
                    |--------------------------------------------------------------------------
                    */

                    L.control.zoom({
                        position: 'bottomright'
                    }).addTo(map);


                    /*
                    |--------------------------------------------------------------------------
                    | OpenStreetMap Tiles
                    |--------------------------------------------------------------------------
                    */

                    L.tileLayer(
                        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,

                            minZoom: 2,

                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> contributors'
                        }
                    ).addTo(map);


                    /*
                    |--------------------------------------------------------------------------
                    | Custom Shop Icon
                    |--------------------------------------------------------------------------
                    */

                    const shopIcon = L.divIcon({

                        className: '',

                        html: `
                <div class="shop-marker">
                    <div class="shop-marker-inner"></div>
                    <div class="shop-marker-dot"></div>
                </div>
            `,

                        iconSize: [42, 42],

                        iconAnchor: [21, 42],

                        popupAnchor: [0, -40]

                    });


                    /*
                    |--------------------------------------------------------------------------
                    | Markers
                    |--------------------------------------------------------------------------
                    */

                    const markers = [];


                    shops.forEach(function(shop) {

                        const lat = parseFloat(shop.lat);

                        const lng = parseFloat(shop.lng);


                        if (
                            !Number.isFinite(lat) ||
                            !Number.isFinite(lng)
                        ) {
                            return;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Marker
                        |--------------------------------------------------------------------------
                        */

                        const marker = L.marker(
                            [lat, lng], {
                                icon: shopIcon
                            }
                        ).addTo(map);


                        /*
                        |--------------------------------------------------------------------------
                        | Safe Shop Values
                        |--------------------------------------------------------------------------
                        */

                        const shopName =
                            shop.name || 'Marketplace Shop';


                        const shopUrl =
                            shop.url || '#';


                        /*
                        |--------------------------------------------------------------------------
                        | Logo
                        |--------------------------------------------------------------------------
                        */

                        let logoHtml = `
                <div
                    style="
                        width:56px;
                        height:56px;
                        border-radius:16px;
                        background:linear-gradient(
                            135deg,
                            #f97316,
                            #ea580c
                        );
                        color:white;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:22px;
                        font-weight:800;
                        margin:auto;
                    "
                >
                    ${shopName.charAt(0).toUpperCase()}
                </div>
            `;


                        if (shop.logo) {

                            logoHtml = `
                    <img
                        src="${shop.logo}"
                        alt="${shopName}"
                        style="
                            width:56px;
                            height:56px;
                            border-radius:16px;
                            object-fit:cover;
                            display:block;
                            margin:auto;
                        "
                    >
                `;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Popup
                        |--------------------------------------------------------------------------
                        */

                        const popup = `

                <div
                    style="
                        padding:18px;
                        text-align:center;
                        font-family:Arial,Helvetica,sans-serif;
                    "
                >

                    ${logoHtml}

                    <div
                        style="
                            margin-top:12px;
                            font-size:17px;
                            font-weight:800;
                            color:#111827;
                        "
                    >
                        ${shopName}
                    </div>

                    <div
                        style="
                            margin-top:4px;
                            font-size:12px;
                            color:#6b7280;
                        "
                    >
                        Marketplace Shop
                    </div>

                    ${
                        shopUrl !== '#'
                        ? `
                                                                            <a
                                                                                href="${shopUrl}"
                                                                                style="
                                                                                    display:block;
                                                                                    margin-top:14px;
                                                                                    padding:10px 16px;
                                                                                    border-radius:10px;
                                                                                    background:#f97316;
                                                                                    color:#ffffff;
                                                                                    text-decoration:none;
                                                                                    font-size:13px;
                                                                                    font-weight:700;
                                                                                "
                                                                            >
                                                                                Visit Shop →
                                                                            </a>
                                                                        `
                        : ''
                    }

                </div>

            `;


                        marker.bindPopup(
                            popup, {
                                className: 'marketplace-popup',

                                closeButton: true,

                                autoClose: true,

                                closeOnClick: true,

                                maxWidth: 280
                            }
                        );


                        markers.push(marker);

                    });


                    /*
                    |--------------------------------------------------------------------------
                    | Shop Counter
                    |--------------------------------------------------------------------------
                    */

                    const shopCount =
                        document.getElementById('shop-count');


                    if (shopCount) {

                        shopCount.textContent =
                            `${markers.length} ${markers.length === 1 ? 'shop' : 'shops'}`;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Fit Map To Shops
                    |--------------------------------------------------------------------------
                    */

                    if (markers.length === 1) {

                        map.setView(
                            markers[0].getLatLng(),
                            10
                        );

                    }


                    if (markers.length > 1) {

                        const group =
                            L.featureGroup(markers);


                        map.fitBounds(
                            group.getBounds(), {
                                padding: [60, 60],

                                maxZoom: 10
                            }
                        );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | No Shops
                    |--------------------------------------------------------------------------
                    */

                    if (markers.length === 0) {

                        map.setView(
                            [24.4539, 54.3773],
                            3
                        );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Fix Rendering
                    |--------------------------------------------------------------------------
                    */

                    setTimeout(function() {

                        map.invalidateSize();

                    }, 300);


                    window.addEventListener(
                        'resize',
                        function() {

                            map.invalidateSize();

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Start
                |--------------------------------------------------------------------------
                */

                if (
                    document.readyState === 'loading'
                ) {

                    document.addEventListener(
                        'DOMContentLoaded',
                        initializeMarketplaceMap
                    );

                } else {

                    initializeMarketplaceMap();

                }

            })();
        </script>





    </div>


</section>
