<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{ $head ?? '' }}

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">

    <!-- Top Navigation -->
    <header class="mx-auto px-4 sm:px-6 lg:px-8 py-4 bg-white dark:bg-gray-800 shadow">
        <div class="sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden sm:rounded-lg">
                @include('layouts.guest-navigation')
            </div>
        </div>
    </header>

    <!-- Content Box -->
    <main class="min-h-screen px-4">
        {{ $slot }}
    </main>


    @livewireScripts
</body>

</html>
