<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="bg-background text-foreground antialiased min-h-screen flex flex-col">
    <!-- Navbar -->
    <header class="w-full border-b border-line-2 bg-surface/90 backdrop-blur-md sticky top-0 z-50 py-4 px-6 md:px-10 flex justify-between items-center">
        <div class="flex items-center gap-2 font-bold text-lg text-foreground">
            <span class="size-8 rounded-lg bg-primary flex items-center justify-center shadow-sm">
                <svg class="size-5 text-primary-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
            </span>
            <span class="truncate max-w-[150px] sm:max-w-xs">{{ tenant('company_name') ?? tenant('id') }}</span>
        </div>
        <nav class="flex items-center gap-3 sm:gap-4">
            @auth
                <a href="{{ route('tenant.dashboard') }}" wire:navigate class="text-sm font-medium px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary-hover transition-colors shadow-xs">Dashboard</a>
            @else
                <a href="{{ route('tenant.login') }}" wire:navigate class="text-sm font-medium text-muted-foreground-1 hover:text-foreground hidden sm:inline-block">Log in</a>
                <a href="{{ route('tenant.register') }}" wire:navigate class="text-sm font-medium px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary-hover transition-colors shadow-xs">Sign up</a>
            @endauth
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col">
        {{ $slot }}
    </main>
    
    <!-- Footer -->
    <footer class="py-10 px-6 text-center text-sm text-muted-foreground-1 border-t border-line-2 bg-surface">
        <div class="flex items-center justify-center gap-2 mb-4">
            <span class="size-6 rounded bg-primary/20 flex items-center justify-center">
                <svg class="size-3 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
            </span>
            <span class="font-semibold text-foreground">{{ tenant('company_name') ?? tenant('id') }}</span>
        </div>
        <p>&copy; {{ date('Y') }} {{ tenant('company_name') ?? tenant('id') }}. All rights reserved.</p>
    </footer>

    @fluxScripts
    @livewireScripts
</body>
</html>
