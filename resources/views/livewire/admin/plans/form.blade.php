<div>
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.plans.index') }}" wire:navigate class="text-muted-foreground-1 hover:text-foreground transition-colors">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div>
            <flux:heading size="xl">{{ $plan ? 'Edit Plan' : 'Create Plan' }}</flux:heading>
            <flux:subheading>{{ $plan ? 'Update the plan details below.' : 'Fill in the details to create a new subscription plan.' }}</flux:subheading>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 rounded-lg bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-400 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-card border border-card-line rounded-xl shadow-2xs p-6 max-w-2xl">
        <form wire:submit="save" class="space-y-5">

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-foreground mb-1.5">Plan Name *</label>
                <input wire:model="name" type="text" id="name" required
                       class="py-2.5 px-4 block w-full border border-line-2 rounded-lg text-sm text-foreground bg-background placeholder-muted-foreground-1 focus:border-primary focus:ring-primary"
                       placeholder="e.g. Growth">
                @error('name') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-foreground mb-1.5">Description</label>
                <textarea wire:model="description" id="description" rows="2"
                          class="py-2.5 px-4 block w-full border border-line-2 rounded-lg text-sm text-foreground bg-background placeholder-muted-foreground-1 focus:border-primary focus:ring-primary"
                          placeholder="Brief description of the plan"></textarea>
                @error('description') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Price + Currency + Billing Cycle -->
            <div class="grid sm:grid-cols-3 gap-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-foreground mb-1.5">Price *</label>
                    <input wire:model="price" type="number" step="0.01" min="0" id="price" required
                           class="py-2.5 px-4 block w-full border border-line-2 rounded-lg text-sm text-foreground bg-background placeholder-muted-foreground-1 focus:border-primary focus:ring-primary"
                           placeholder="49.00">
                    @error('price') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="currency" class="block text-sm font-medium text-foreground mb-1.5">Currency *</label>
                    <select wire:model="currency" id="currency"
                            class="py-2.5 px-4 block w-full border border-line-2 rounded-lg text-sm text-foreground bg-background focus:border-primary focus:ring-primary">
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="MXN">MXN</option>
                    </select>
                </div>

                <div>
                    <label for="billing_cycle" class="block text-sm font-medium text-foreground mb-1.5">Billing Cycle *</label>
                    <select wire:model="billing_cycle" id="billing_cycle"
                            class="py-2.5 px-4 block w-full border border-line-2 rounded-lg text-sm text-foreground bg-background focus:border-primary focus:ring-primary">
                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>
                        <option value="lifetime">Lifetime</option>
                    </select>
                </div>
            </div>

            <!-- Features -->
            <div>
                <label for="features" class="block text-sm font-medium text-foreground mb-1.5">
                    Features <span class="text-xs text-muted-foreground-1">(one per line)</span>
                </label>
                <textarea wire:model="features" id="features" rows="4"
                          class="py-2.5 px-4 block w-full border border-line-2 rounded-lg text-sm text-foreground bg-background placeholder-muted-foreground-1 focus:border-primary focus:ring-primary font-mono"
                          placeholder="Up to 10 users&#10;Dedicated database&#10;Priority support"></textarea>
                @error('features') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Active Toggle -->
            <div class="flex items-center gap-3">
                <input wire:model="is_active" type="checkbox" id="is_active"
                       class="shrink-0 border border-line-3 rounded text-primary focus:ring-primary">
                <label for="is_active" class="text-sm text-foreground font-medium">Active (visible to tenants)</label>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="py-2.5 px-5 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus disabled:opacity-50 disabled:pointer-events-none transition-all"
                        wire:loading.attr="disabled">
                    <span wire:loading.remove>{{ $plan ? 'Update Plan' : 'Create Plan' }}</span>
                    <span wire:loading>Saving...</span>
                </button>
                <a href="{{ route('admin.plans.index') }}" wire:navigate
                   class="py-2.5 px-5 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-layer border border-layer-line text-layer-foreground hover:bg-layer-hover transition-all">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>
