<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (!@empty($meta_title))
        <title>{{ $meta_title }}</title>
    @else
        <title>@yield('title', 'murwaj supplier')</title>
    @endif

    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="bg-gray-100 dark:bg-neutral-950">

    {{ $slot }}


</body>


</html>
