<div>
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.tenants.index') }}" wire:navigate class="text-muted-foreground-1 hover:text-foreground transition-colors">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div>
            <flux:heading size="xl">Tenant: {{ Str::limit($tenant->id, 20) }}</flux:heading>
            <flux:subheading>Created {{ $tenant->created_at->format('M d, Y \a\t H:i') }}</flux:subheading>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="flex flex-wrap gap-2 mb-6">
        @php $latestSub = $subscriptions->first(); @endphp
        @if($latestSub?->status === 'active')
            <button wire:click="suspendTenant"
                    wire:confirm="Suspend this tenant? They will lose access to their application."
                    class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-amber-500 text-white hover:bg-amber-600 focus:outline-hidden transition-all">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="10" x2="10" y1="15" y2="9"/><line x1="14" x2="14" y1="15" y2="9"/></svg>
                Suspend Tenant
            </button>
        @elseif($latestSub?->status === 'suspended')
            <button wire:click="activateTenant"
                    class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-teal-500 text-white hover:bg-teal-600 focus:outline-hidden transition-all">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                Activate Tenant
            </button>
        @endif
    </div>

    <div class="grid lg:grid-cols-2 gap-6">

        <!-- Domains -->
        <div class="bg-card border border-card-line rounded-xl shadow-2xs overflow-hidden">
            <div class="px-5 py-4 border-b border-card-line">
                <h4 class="font-semibold text-foreground">Domains</h4>
            </div>
            <div class="divide-y divide-card-line">
                @forelse($domains as $domain)
                    <div class="px-5 py-3 flex items-center justify-between">
                        <span class="text-sm font-mono text-foreground">{{ $domain->domain }}</span>
                        <span class="text-xs text-muted-foreground-1">{{ $domain->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center text-sm text-muted-foreground-1">No domains configured.</div>
                @endforelse
            </div>
        </div>

        <!-- Tenant Info -->
        <div class="bg-card border border-card-line rounded-xl shadow-2xs overflow-hidden">
            <div class="px-5 py-4 border-b border-card-line">
                <h4 class="font-semibold text-foreground">Tenant Details</h4>
            </div>
            <div class="px-5 py-4 space-y-3">
                <div class="flex justify-between">
                    <span class="text-sm text-muted-foreground-1">ID</span>
                    <span class="text-sm font-mono text-foreground">{{ $tenant->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-muted-foreground-1">Database</span>
                    <span class="text-sm font-mono text-foreground">{{ $tenant->tenancy_db_name ?? 'tenant' . $tenant->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-muted-foreground-1">Created</span>
                    <span class="text-sm text-foreground">{{ $tenant->created_at->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-muted-foreground-1">Current Status</span>
                    @php $currentStatus = $latestSub?->status ?? 'no subscription'; @endphp
                    <span @class([
                        'inline-flex items-center py-1 px-2.5 rounded-full text-xs font-medium',
                        'bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-500' => $currentStatus === 'active',
                        'bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-500' => $currentStatus === 'canceled',
                        'bg-amber-100 text-amber-800 dark:bg-amber-500/10 dark:text-amber-500' => $currentStatus === 'suspended',
                        'bg-surface text-muted-foreground-1' => $currentStatus === 'no subscription',
                    ])>
                        {{ ucfirst($currentStatus) }}
                    </span>
                </div>
            </div>
        </div>

    </div>

    <!-- Subscription History -->
    <div class="mt-6 bg-card border border-card-line rounded-xl shadow-2xs overflow-hidden">
        <div class="px-5 py-4 border-b border-card-line">
            <h4 class="font-semibold text-foreground">Subscription History</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-card-line">
                <thead class="bg-surface">
                    <tr>
                        <th class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Plan</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Status</th>
                        <th class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Started</th>
                        <th class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Ends</th>
                        <th class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Canceled</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-card-line">
                    @forelse($subscriptions as $sub)
                        <tr>
                            <td class="px-5 py-3 text-sm font-semibold text-foreground">{{ $sub->plan?->name ?? '—' }}</td>
                            <td class="px-5 py-3 text-center">
                                <span @class([
                                    'inline-flex items-center py-1 px-2.5 rounded-full text-xs font-medium',
                                    'bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-500' => $sub->status === 'active',
                                    'bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-500' => $sub->status === 'canceled',
                                    'bg-amber-100 text-amber-800 dark:bg-amber-500/10 dark:text-amber-500' => $sub->status === 'suspended',
                                    'bg-surface text-muted-foreground-1' => ! in_array($sub->status, ['active', 'canceled', 'suspended']),
                                ])>
                                    {{ ucfirst($sub->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-sm text-muted-foreground-1">{{ $sub->starts_at?->format('M d, Y') ?? '—' }}</td>
                            <td class="px-5 py-3 text-sm text-muted-foreground-1">{{ $sub->ends_at?->format('M d, Y') ?? 'Ongoing' }}</td>
                            <td class="px-5 py-3 text-sm text-muted-foreground-1">{{ $sub->canceled_at?->format('M d, Y') ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-sm text-muted-foreground-1">No subscriptions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
