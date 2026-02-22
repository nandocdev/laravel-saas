<x-layouts.tenant :title="'Dashboard — ' . tenant('id')">

    <flux:heading size="xl">Dashboard</flux:heading>
    <flux:subheading>Welcome to your workspace, {{ $user->name }}.</flux:subheading>

    <!-- Stats Grid -->
    <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">

        <!-- Tenant ID -->
        <div class="bg-card border border-card-line rounded-xl p-5 shadow-2xs">
            <div class="flex items-center gap-x-3">
                <span class="size-10 inline-flex justify-center items-center rounded-lg bg-primary/10 text-primary">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/></svg>
                </span>
                <div>
                    <p class="text-xs uppercase tracking-wide text-muted-foreground-1 font-semibold">Tenant</p>
                    <h3 class="text-sm font-bold text-foreground font-mono truncate">{{ $tenant->id }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-card border border-card-line rounded-xl p-5 shadow-2xs">
            <div class="flex items-center gap-x-3">
                <span class="size-10 inline-flex justify-center items-center rounded-lg bg-teal-500/10 text-teal-500">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </span>
                <div>
                    <p class="text-xs uppercase tracking-wide text-muted-foreground-1 font-semibold">Users</p>
                    <h3 class="text-2xl font-bold text-foreground">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>

        <!-- Domain(s) -->
        <div class="bg-card border border-card-line rounded-xl p-5 shadow-2xs">
            <div class="flex items-center gap-x-3">
                <span class="size-10 inline-flex justify-center items-center rounded-lg bg-violet-500/10 text-violet-500">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" x2="22" y1="12" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </span>
                <div>
                    <p class="text-xs uppercase tracking-wide text-muted-foreground-1 font-semibold">Domain</p>
                    <h3 class="text-sm font-bold text-foreground truncate">{{ request()->getHost() }}</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Info -->
    <div class="mt-8 bg-card border border-card-line rounded-xl shadow-2xs overflow-hidden">
        <div class="px-5 py-4 border-b border-card-line">
            <h4 class="font-semibold text-foreground">Your Account</h4>
        </div>
        <div class="px-5 py-4 space-y-3">
            <div class="flex justify-between">
                <span class="text-sm text-muted-foreground-1">Name</span>
                <span class="text-sm font-medium text-foreground">{{ $user->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-muted-foreground-1">Email</span>
                <span class="text-sm font-medium text-foreground">{{ $user->email }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-muted-foreground-1">Member since</span>
                <span class="text-sm text-foreground">{{ $user->created_at->format('M d, Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Placeholder for future modules -->
    <div class="mt-8 border-2 border-dashed border-line-2 rounded-xl p-10 text-center">
        <div class="flex flex-col items-center gap-3">
            <span class="size-12 inline-flex justify-center items-center rounded-lg bg-surface text-muted-foreground-1">
                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
            </span>
            <p class="text-sm text-muted-foreground-1">Your tenant modules will appear here.<br>This is where tenants operate your SaaS services.</p>
        </div>
    </div>

</x-layouts.tenant>
