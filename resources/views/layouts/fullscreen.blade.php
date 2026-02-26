<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind Play CDN for editor specific logic, just to guarantee compilation outside of Vite for testing -->
    <!-- Ideally, you'd use Vite for production -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine is usually included via Livewire 3 automatically, but we ensure it works -->
    
    <!-- DM Sans/Mono Fonts for Editor -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=DM+Mono:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-mono { font-family: 'DM Mono', monospace; }
        [x-cloak] { display: none !important; }
    </style>
    @livewireStyles
</head>
<body class="h-full overflow-hidden antialiased flex flex-col min-h-screen text-gray-900 m-0">
    <main class="flex-grow flex flex-col w-full h-full relative">
        {{ $slot }}
    </main>
    @livewireScripts
</body>
</html>
