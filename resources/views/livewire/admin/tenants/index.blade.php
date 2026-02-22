<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <flux:heading size="xl">Tenants</flux:heading>
            <flux:subheading>Manage and monitor all tenant instances.</flux:subheading>
        </div>
    </div>

    <!-- Filters -->
    <div class="mt-6 flex flex-col sm:flex-row gap-3">
        <input wire:model.live.debounce.300ms="search" type="search" placeholder="Search by tenant ID..."
               class="py-2.5 px-4 block w-full sm:max-w-xs border border-line-2 rounded-lg text-sm text-foreground bg-background placeholder-muted-foreground-1 focus:border-primary focus:ring-primary">
        <select wire:model.live="statusFilter"
                class="py-2.5 px-4 block w-full sm:w-auto border border-line-2 rounded-lg text-sm text-foreground bg-background focus:border-primary focus:ring-primary">
            <option value="">All Statuses</option>
            <option value="active">Active</option>
            <option value="suspended">Suspended</option>
            <option value="canceled">Canceled</option>
            <option value="none">No subscription</option>
        </select>
    </div>

    <!-- Table -->
    <div class="mt-4 bg-card border border-card-line rounded-xl shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-card-line">
                <thead class="bg-surface">
                    <tr>
                        <th class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Tenant ID</th>
                        <th class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Domain(s)</th>
                        <th class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Plan</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Status</th>
                        <th class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Created</th>
                        <th class="px-5 py-3 text-end text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-card-line">
                    @forelse($tenants as $tenant)
                        @php
                            $sub = $tenant->latestSubscription;
                            $status = $sub?->status ?? 'none';
                        @endphp
                        <tr class="hover:bg-muted/50 transition-colors">
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.tenants.show', $tenant) }}" wire:navigate class="text-sm font-semibold text-primary hover:text-primary-hover transition-colors">
                                    {{ Str::limit($tenant->id, 12) }}
                                </a>
                            </td>
                            <td class="px-5 py-3 text-sm text-foreground">
                                {{ $tenant->domains->pluck('domain')->implode(', ') ?: '—' }}
                            </td>
                            <td class="px-5 py-3 text-sm text-foreground">
                                {{ $sub?->plan?->name ?? '—' }}
                            </td>
                            <td class="px-5 py-3 text-center">
                                <span @class([
                                    'inline-flex items-center py-1 px-2.5 rounded-full text-xs font-medium',
                                    'bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-500' => $status === 'active',
                                    'bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-500' => $status === 'canceled',
                                    'bg-amber-100 text-amber-800 dark:bg-amber-500/10 dark:text-amber-500' => $status === 'suspended',
                                    'bg-surface text-muted-foreground-1' => $status === 'none',
                                ])>
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-sm text-muted-foreground-1">
                                {{ $tenant->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-5 py-3 text-end">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.tenants.show', $tenant) }}" wire:navigate class="text-xs font-semibold text-primary hover:text-primary-hover transition-colors">View</a>
                                    @if($status === 'active')
                                        <button wire:click="suspendTenant('{{ $tenant->id }}')"
                                                wire:confirm="Suspend this tenant? They will lose access."
                                                class="text-xs font-semibold text-amber-600 hover:text-amber-700 transition-colors">Suspend</button>
                                    @elseif($status === 'suspended')
                                        <button wire:click="activateTenant('{{ $tenant->id }}')"
                                                class="text-xs font-semibold text-teal-600 hover:text-teal-700 transition-colors">Activate</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-sm text-muted-foreground-1">
                                No tenants found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
