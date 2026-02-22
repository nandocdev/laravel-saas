<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.header>
            <a href="{{ route('tenant.dashboard') }}" wire:navigate class="flex items-center gap-2 font-bold text-foreground">
                <span class="size-7 rounded-lg bg-primary flex items-center justify-center shadow-sm">
                    <svg class="size-4 text-primary-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </span>
                <span class="truncate">{{ tenant('id') }}</span>
            </a>
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('Workspace')" class="grid">
                <flux:sidebar.item icon="home" :href="route('tenant.dashboard')" :current="request()->routeIs('tenant.dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        <!-- Tenant User Menu (Desktop) -->
        @auth
            <div class="hidden lg:block border-t border-zinc-200 dark:border-zinc-700 pt-3 mt-2 px-3">
                <div class="flex items-center gap-3">
                    <flux:avatar :initials="auth()->user()->initials()" size="sm" />
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-foreground truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-muted-foreground-1 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('tenant.logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="w-full py-1.5 px-3 text-xs font-medium text-muted-foreground-1 hover:text-foreground rounded-lg hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors text-start flex items-center gap-2">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        @endauth
    </flux:sidebar>

    <!-- Mobile Header -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        @auth
            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />
                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('tenant.logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                        >
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        @endauth
    </flux:header>

    <flux:main>
        {{ $slot }}
    </flux:main>

    @fluxScripts
    @livewireScripts
</body>
</html>
