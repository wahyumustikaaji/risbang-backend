<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="/assets/icon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/assets/icon/favicon.svg" />
    <link rel="shortcut icon" href="/assets/icon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/icon/apple-touch-icon.png" />
    <link rel="manifest" href="/assets/icon/site.webmanifest" />


    <title>{{ $title ?? config('app.name', 'Admin Risbang') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased flex bg-gray-100" x-data="{ sidebarOpen: false }">
    {{-- Overlay Mobile --}}
    <div class="fixed inset-0 bg-black bg-opacity-40 z-30 lg:hidden" x-show="sidebarOpen" @click="sidebarOpen = false"
        x-transition>
    </div>

    {{-- Sidebar Component --}}
    <x-sidebar-admin />

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col lg:ml-64">

        {{-- Navbar Component --}}
        <x-navbar-admin />

        {{-- Page Content --}}
        <main class="p-5">
            {{ $slot }}
        </main>
    </div>


</body>

</html>