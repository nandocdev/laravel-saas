<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <flux:heading size="xl">Plans</flux:heading>
            <flux:subheading>Manage subscription plans for your tenants.</flux:subheading>
        </div>
        <a href="{{ route('admin.plans.create') }}" wire:navigate
           class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus disabled:opacity-50 disabled:pointer-events-none transition-all">
            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            New Plan
        </a>
    </div>

    <!-- Search -->
    <div class="mt-6">
        <input wire:model.live.debounce.300ms="search" type="search" placeholder="Search plans..."
               class="py-2.5 px-4 block w-full sm:max-w-xs border border-line-2 rounded-lg text-sm text-foreground bg-background placeholder-muted-foreground-1 focus:border-primary focus:ring-primary">
    </div>

    <!-- Table -->
    <div class="mt-4 bg-card border border-card-line rounded-xl shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-card-line">
                <thead class="bg-surface">
                    <tr>
                        <th class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Name</th>
                        <th class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Price</th>
                        <th class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Cycle</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Status</th>
                        <th class="px-5 py-3 text-end text-xs font-semibold uppercase tracking-wide text-muted-foreground-1">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-card-line">
                    @forelse($plans as $plan)
                        <tr class="hover:bg-muted/50 transition-colors">
                            <td class="px-5 py-3">
                                <div>
                                    <p class="text-sm font-semibold text-foreground">{{ $plan->name }}</p>
                                    <p class="text-xs text-muted-foreground-1">{{ Str::limit($plan->description, 50) }}</p>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-sm text-foreground font-medium">
                                ${{ number_format($plan->price, 2) }}
                                <span class="text-muted-foreground-1">{{ $plan->currency }}</span>
                            </td>
                            <td class="px-5 py-3 text-sm text-foreground capitalize">{{ $plan->billing_cycle }}</td>
                            <td class="px-5 py-3 text-center">
                                <button wire:click="toggleActive({{ $plan->id }})"
                                        class="inline-flex items-center gap-x-1 py-1 px-2.5 rounded-full text-xs font-medium transition-colors cursor-pointer
                                            {{ $plan->is_active
                                                ? 'bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-500'
                                                : 'bg-surface text-muted-foreground-1' }}">
                                    {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-5 py-3 text-end">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.plans.edit', $plan) }}" wire:navigate
                                       class="text-xs font-semibold text-primary hover:text-primary-hover transition-colors">Edit</a>
                                    <button wire:click="deletePlan({{ $plan->id }})"
                                            wire:confirm="Are you sure you want to delete this plan?"
                                            class="text-xs font-semibold text-red-500 hover:text-red-600 transition-colors">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-sm text-muted-foreground-1">
                                No plans found. <a href="{{ route('admin.plans.create') }}" wire:navigate class="text-primary font-semibold">Create your first plan →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
