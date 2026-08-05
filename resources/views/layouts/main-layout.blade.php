<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-cloak x-data="{ darkMode: localStorage.getItem('dark') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
    x-bind:class="{ 'dark': darkMode }">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- Language --}}
    <meta http-equiv="content-language" content="{{ app()->getLocale() }}">


    {{-- Title --}}
    <title>
        {{ $meta_title ?? trim($__env->yieldContent('title', 'murwaj marketplace')) }}
    </title>


    {{-- Description --}}
    <meta name="description"
        content="{{ $meta_description ?? trim($__env->yieldContent('description', 'Discover products on murwaj Marketplace')) }}">


    {{-- Keywords --}}
    <meta name="keywords"
        content="{{ $meta_keywords ?? trim($__env->yieldContent('keywords', 'marketplace, products, shops')) }}">



    {{-- Robots --}}
    <meta name="robots" content="index, follow">



    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">



    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $og_type ?? 'website' }}">

    <meta property="og:title" content="{{ $meta_title ?? trim($__env->yieldContent('title', 'Murwaj Marketplace')) }}">


    <meta property="og:description"
        content="{{ $meta_description ?? trim($__env->yieldContent('description', 'Discover products on Murwaj Marketplace')) }}">


    <meta property="og:image" content="{{ $meta_image ?? asset('images/share-default.jpg') }}">


    <meta property="og:url" content="{{ url()->current() }}">

    <meta property="og:site_name" content="murwaj Marketplace">



    {{-- Twitter Card --}}

    <meta name="twitter:card" content="summary_large_image">


    <meta name="twitter:title"
        content="{{ $meta_title ?? trim($__env->yieldContent('title', 'murwaj Marketplace')) }}">


    <meta name="twitter:description"
        content="{{ $meta_description ?? trim($__env->yieldContent('description', 'Discover products on murwaj Marketplace')) }}">


    <meta name="twitter:image" content="{{ $meta_image ?? asset('images/share-default.jpg') }}">



    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">



    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">



    {{-- App --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    {{-- Livewire --}}
    @livewireStyles


</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-EFEE07R6NT"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-EFEE07R6NT');
</script>

<body x-data="{ isOpen: false }" :class="{ 'dark': darkMode === true }"
    class="font-sans antialiased leading-normal tracking-normal">
    <x-banner />

    <div class="w-full min-h-screen bg-white dark:bg-gray-900">

        <!-- Page Heading -->
        @if (isset($header))
            <header class="absolute inset-x-0 top-0 z-50">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="relative isolate pt-24 flex-1 xl:pt-[5.5rem]">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
            {{-- @include('cookie-consent::index') --}}
            {{ $slot }}
        </main>
    </div>

    <script>
        // Reloj
        function updateClock() {
            const now = new Date();
            let hours = now.getHours();
            const ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12;
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('clock').innerText = `${hours}:${minutes}:${seconds} ${ampm}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Lógica del Menú Móvil
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = menuBtn.querySelector('svg path');
        let isMenuOpen = false;

        menuBtn.addEventListener('click', () => {
            isMenuOpen = !isMenuOpen;
            if (isMenuOpen) {
                mobileMenu.classList.add('open');
                // Cambiar icono a X
                menuIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            } else {
                mobileMenu.classList.remove('open');
                // Cambiar icono a Hamburguesa
                menuIcon.setAttribute('d', 'M4 6h16M4 12h16m-7 6h7');
            }
        });

        // Efecto scroll en Navbar
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-sm');
            } else {
                navbar.classList.remove('shadow-sm');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('notify', (event) => {

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Added to Basket',
                    html: `
                <div style="margin-top:8px">
                    <strong>${event[0].message}</strong><br><br>

                    <a href="/cart"
                       style="
                        display:inline-block;
                        padding:8px 14px;
                        background:#f97316;
                        color:white;
                        border-radius:8px;
                        text-decoration:none;
                        font-weight:600;">
                        View Basket
                    </a>
                </div>
            `,
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true,
                });

            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {


            const input = document.getElementById('imageInput');
            const preview = document.getElementById('imagePreview');


            let files = [];


            input.addEventListener('change', function(e) {


                files = Array.from(e.target.files);


                preview.innerHTML = "";


                files.forEach((file, index) => {


                    const reader = new FileReader();


                    reader.onload = function(event) {


                        const box = document.createElement('div');


                        box.className =
                            `
                relative
                aspect-square
                rounded-2xl
                overflow-hidden
                border
                border-gray-200
                dark:border-neutral-700
                `;



                        box.innerHTML = `

                    <img 
                    src="${event.target.result}"
                    class="
                    w-full
                    h-full
                    object-cover
                    ">


                    <button
                    type="button"
                    data-index="${index}"
                    class="
                    remove-image
                    absolute
                    top-2
                    right-2
                    bg-black/60
                    text-white
                    w-7
                    h-7
                    rounded-full
                    flex
                    items-center
                    justify-center
                    font-bold
                    ">

                    ×

                    </button>

                `;


                        preview.appendChild(box);



                    };


                    reader.readAsDataURL(file);


                });


            });





            preview.addEventListener('click', function(e) {


                if (e.target.classList.contains('remove-image')) {


                    let index = e.target.dataset.index;


                    files.splice(index, 1);



                    const dataTransfer = new DataTransfer();


                    files.forEach(file => {

                        dataTransfer.items.add(file);

                    });



                    input.files = dataTransfer.files;



                    input.dispatchEvent(new Event('change'));

                }


            });


        });
    </script>

    @stack('modals')

    @livewireScripts
</body>

</html>
