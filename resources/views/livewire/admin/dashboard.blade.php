<div>
    <flux:heading size="xl">Dashboard</flux:heading>
    <flux:subheading>Overview of your SaaS platform.</flux:subheading>

    <!-- Stats Grid -->
    <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Tenants -->
        <div class="bg-card border border-card-line rounded-xl p-5 shadow-2xs">
            <div class="flex items-center gap-x-3">
                <span class="size-10 inline-flex justify-center items-center rounded-lg bg-primary/10 text-primary">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </span>
                <div>
                    <p class="text-xs uppercase tracking-wide text-muted-foreground-1 font-semibold">Total Tenants</p>
                    <h3 class="text-2xl font-bold text-foreground">{{ $totalTenants }}</h3>
                </div>
            </div>
        </div>

        <!-- Active Tenants -->
        <div class="bg-card border border-card-line rounded-xl p-5 shadow-2xs">
            <div class="flex items-center gap-x-3">
                <span class="size-10 inline-flex justify-center items-center rounded-lg bg-teal-500/10 text-teal-500">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </span>
                <div>
                    <p class="text-xs uppercase tracking-wide text-muted-foreground-1 font-semibold">Active Subscriptions</p>
                    <h3 class="text-2xl font-bold text-foreground">{{ $activeTenants }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Plans -->
        <div class="bg-card border border-card-line rounded-xl p-5 shadow-2xs">
            <div class="flex items-center gap-x-3">
                <span class="size-10 inline-flex justify-center items-center rounded-lg bg-violet-500/10 text-violet-500">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                </span>
                <div>
                    <p class="text-xs uppercase tracking-wide text-muted-foreground-1 font-semibold">Plans</p>
                    <h3 class="text-2xl font-bold text-foreground">{{ $totalPlans }} <span class="text-sm font-normal text-muted-foreground-1">({{ $activePlans }} active)</span></h3>
                </div>
            </div>
        </div>

        <!-- Monthly Revenue -->
        <div class="bg-card border border-card-line rounded-xl p-5 shadow-2xs">
            <div class="flex items-center gap-x-3">
                <span class="size-10 inline-flex justify-center items-center rounded-lg bg-amber-500/10 text-amber-500">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </span>
                <div>
                    <p class="text-xs uppercase tracking-wide text-muted-foreground-1 font-semibold">Monthly Revenue</p>
                    <h3 class="text-2xl font-bold text-foreground">${{ number_format($monthlyRevenue, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="mt-8 grid lg:grid-cols-2 gap-6">

        <!-- Recent Tenants -->
        <div class="bg-card border border-card-line rounded-xl shadow-2xs overflow-hidden">
            <div class="px-5 py-4 border-b border-card-line flex items-center justify-between">
                <h4 class="font-semibold text-foreground">Recent Tenants</h4>
                <a href="{{ route('admin.tenants.index') }}" class="text-xs font-semibold text-primary hover:text-primary-hover transition-colors" wire:navigate>View all →</a>
            </div>
            <div class="divide-y divide-card-line">
                @forelse($recentTenants as $tenant)
                    <div class="px-5 py-3 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-foreground">{{ $tenant->id }}</p>
                            <p class="text-xs text-muted-foreground-1">
                                {{ $tenant->domains->pluck('domain')->implode(', ') ?: 'No domains' }}
                            </p>
                        </div>
                        <span class="text-xs text-muted-foreground-1">{{ $tenant->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center text-sm text-muted-foreground-1">No tenants yet.</div>
                @endforelse
            </div>
        </div>

        <!-- Recent Subscriptions -->
        <div class="bg-card border border-card-line rounded-xl shadow-2xs overflow-hidden">
            <div class="px-5 py-4 border-b border-card-line flex items-center justify-between">
                <h4 class="font-semibold text-foreground">Recent Subscriptions</h4>
                <a href="{{ route('admin.plans.index') }}" class="text-xs font-semibold text-primary hover:text-primary-hover transition-colors" wire:navigate>Manage plans →</a>
            </div>
            <div class="divide-y divide-card-line">
                @forelse($recentSubscriptions as $sub)
                    <div class="px-5 py-3 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-foreground">{{ $sub->tenant?->id ?? '—' }}</p>
                            <p class="text-xs text-muted-foreground-1">{{ $sub->plan?->name ?? '—' }}</p>
                        </div>
                        <span @class([
                            'inline-flex items-center gap-x-1 py-1 px-2 rounded-full text-xs font-medium',
                            'bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-500' => $sub->status === 'active',
                            'bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-500' => $sub->status === 'canceled',
                            'bg-amber-100 text-amber-800 dark:bg-amber-500/10 dark:text-amber-500' => $sub->status === 'suspended',
                            'bg-surface text-muted-foreground-1' => ! in_array($sub->status, ['active', 'canceled', 'suspended']),
                        ])>
                            {{ ucfirst($sub->status) }}
                        </span>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center text-sm text-muted-foreground-1">No subscriptions yet.</div>
                @endforelse
            </div>
        </div>

    </div>
</div>
