<!DOCTYPE html>
@php
$theme = 'autumn';
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{$theme}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="//unpkg.com/alpinejs" defer></script>
        @inertiaHead

    </head>
    <body class="">
        @inertia
    </body>
</html>
