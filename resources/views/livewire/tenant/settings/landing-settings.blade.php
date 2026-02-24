<div>
    <flux:heading size="xl">Landing Page</flux:heading>
    <flux:subheading>Manage your public-facing landing page configuration.</flux:subheading>

    <div class="mt-6 max-w-4xl">
        <form wire:submit="save" class="space-y-6">
            @if (session()->has('message'))
                <div class="p-4 bg-green-50 text-green-700 dark:bg-green-900/50 dark:text-green-400 rounded-lg text-sm mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <flux:card>
                <div class="space-y-6">
                    <flux:input wire:model="company_name" label="Company Name" placeholder="My SaaS Inc." />
                    
                    <flux:select wire:model="template" label="Layout Template">
                        <option value="corporate">Corporate (Classic)</option>
                        <option value="visual">Visual Experience</option>
                        <option value="conversion">Direct Conversion</option>
                        <option value="storytelling">Storytelling</option>
                        <option value="catalog">Catalog</option>
                        <option value="onepage">One Page Minimal</option>
                    </flux:select>
                </div>
                
                <div class="mt-8 border-t border-line-2 pt-8">
                    <flux:heading size="lg" class="mb-4">Page Blocks</flux:heading>
                    
                    <div class="space-y-6">
                        @foreach($blocks as $index => $block)
                            <div class="p-6 rounded-xl border border-line-2 bg-surface shadow-sm relative">
                                <div class="flex items-center justify-between mb-4 border-b border-line-2 pb-4">
                                    <div class="flex items-center gap-3">
                                        <div class="font-bold text-lg capitalize text-foreground">{{ $block['type'] }}</div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" wire:click="moveBlockUp({{ $index }})" class="p-1 rounded bg-line hover:bg-line-2 text-foreground" {{ $index === 0 ? 'disabled' : '' }}>
                                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                        </button>
                                        <button type="button" wire:click="moveBlockDown({{ $index }})" class="p-1 rounded bg-line hover:bg-line-2 text-foreground" {{ $index === count($blocks) - 1 ? 'disabled' : '' }}>
                                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </button>
                                        <button type="button" wire:click="removeBlock({{ $index }})" class="p-1 rounded text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 ml-2">
                                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <div>
                                    <flux:textarea wire:model="blocks.{{ $index }}.json_data" label="Configuration (JSON)" rows="6" class="font-mono text-sm" />
                                    @error('blocks.' . $block['type']) <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="mt-6 flex items-center gap-4 bg-surface p-4 border border-line-2 rounded-xl">
                    <div class="flex-1">
                        <flux:select wire:model="newBlockType" label="Add New Block">
                            <option value="">Select a block type...</option>
                            <option value="hero">Hero Section</option>
                            <option value="features">Features & Services</option>
                            <option value="testimonials">Testimonials</option>
                            <option value="pricing">Pricing Tables</option>
                            <option value="faq">FAQ</option>
                            <option value="contact">Contact Info</option>
                        </flux:select>
                    </div>
                    <div class="mt-8">
                        <flux:button type="button" wire:click="addBlock" variant="primary">Add Block</flux:button>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end gap-x-2 border-t border-line-2 pt-6">
                    <flux:button type="submit" variant="primary">Save Landing Page</flux:button>
                </div>
            </flux:card>
        </form>
    </div>
</div>
