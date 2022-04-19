<!DOCTYPE html>
@php
$theme = 'corporate';
if(\Route::getCurrentRoute()->parameter('portfolio') =='platinum')
{
    $theme = 'valentine';
}

@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{$theme}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
            @livewire('navigation-menu')
       <div class="drawer drawer-mobile">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle">
            <div class="drawer-content flex flex-col items-center justify-center">
                <!-- Page content here -->
            <main class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $slot }}
                            </main>
            </div>
            <div class="drawer-side">
                <label for="my-drawer-2" class="drawer-overlay"></label>
                <aside class="w-80 bg-base-200">
                <div class="h-4"></div>
                <ul class="menu menu-compact flex flex-col p-0 px-4 overflow-y-auto">
                <!-- Sidebar content here -->
                {{ \Route::getCurrentRoute()->parameter('portfolio') }}
                @if(\Route::getCurrentRoute()->parameter('portfolio'))
                <li>
                    <a href="{{ route('portfolio.dashboard',[\Route::getCurrentRoute()->parameter('portfolio')]) }}" {{ request()->routeIs('portfolio.dashboard',\Route::getCurrentRoute()->parameter('portfolio')) ? "class=active" : '' }}>
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('portfolio.client.index',[\Route::getCurrentRoute()->parameter('portfolio')]) }}" {{ request()->routeIs('portfolio.client.*',[\Route::getCurrentRoute()->parameter('portfolio')]) ? "class=active" : '' }}>
                        {{ __('Clients') }}
                    </a>
                </li>
                @endif
                </ul>
                <div class="h-4"></div>
                <ul class="menu menu-compact flex flex-col p-0 px-4 overflow-y-auto">
                <!-- Sidebar content here -->
                @if(\Route::getCurrentRoute()->parameter('portfolio'))
                <li>
                    <a href="{{ route('portfolio.invoice.index',[\Route::getCurrentRoute()->parameter('portfolio')]) }}" {{ request()->routeIs('portfolio.invoice.*',[\Route::getCurrentRoute()->parameter('portfolio')]) ? "class=active" : '' }}>
                        {{ __('Invoices') }}
                    </a>
                </li>
                <li><a>Aging</a></li>
                <li><a>Quick Order</a></li>
                <li><a>Print PDF</a></li>
                <li><a>Print Docket</a></li>
                @endif
                </ul>
                </aside>
        </div>
        </div>
        @stack('modals')

        @livewireScripts
    </body>
</html>
