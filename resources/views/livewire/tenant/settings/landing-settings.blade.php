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
                            <div wire:key="block-{{ $block['id'] ?? $index }}" class="p-6 rounded-xl border border-line-2 bg-surface shadow-sm relative">
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
                                
                                <div class="space-y-4">
                                    {{-- Render form based on block type --}}
                                    @if($block['type'] === 'hero')
                                        <flux:input wire:model="blocks.{{ $index }}.data.title" label="Headline" />
                                        <flux:textarea wire:model="blocks.{{ $index }}.data.subtitle" label="Subtitle" />
                                        <div class="grid grid-cols-2 gap-4">
                                            <flux:input wire:model="blocks.{{ $index }}.data.cta_text" label="CTA Button Text" />
                                            <flux:input wire:model="blocks.{{ $index }}.data.cta_link" label="CTA Button Link" />
                                        </div>
                                        
                                    @elseif($block['type'] === 'contact')
                                        <flux:input wire:model="blocks.{{ $index }}.data.heading" label="Section Heading" />
                                        <flux:textarea wire:model="blocks.{{ $index }}.data.description" label="Description" />
                                        <div class="grid grid-cols-2 gap-4">
                                            <flux:input wire:model="blocks.{{ $index }}.data.email" label="Contact Email" type="email" />
                                            <flux:input wire:model="blocks.{{ $index }}.data.phone" label="Phone Number" />
                                        </div>
                                        <flux:input wire:model="blocks.{{ $index }}.data.address" label="Address" />
                                        
                                    @elseif($block['type'] === 'features')
                                        <flux:heading size="sm" class="mb-2">Features List</flux:heading>
                                        <div class="space-y-3">
                                            @foreach($block['data']['items'] ?? [] as $itemIndex => $item)
                                                <div class="p-4 border border-line-2 rounded-xl relative space-y-3 bg-surface/50">
                                                    <div class="absolute top-2 right-2">
                                                        <flux:button type="button" size="sm" variant="danger" wire:click="removeRepeaterItem({{ $index }}, 'items', {{ $itemIndex }})">X</flux:button>
                                                    </div>
                                                    <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.title" label="Feature Title" />
                                                    <flux:textarea wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.description" label="Feature Description" rows="2" />
                                                </div>
                                            @endforeach
                                        </div>
                                        <flux:button type="button" size="sm" class="mt-2" wire:click="addRepeaterItem({{ $index }}, 'items', {title: 'New Feature', description: ''})">+ Add Feature</flux:button>
                                        
                                    @elseif($block['type'] === 'testimonials')
                                        <flux:input wire:model="blocks.{{ $index }}.data.heading" label="Section Heading" />
                                        <flux:heading size="sm" class="mb-2 mt-4">Testimonials List</flux:heading>
                                        <div class="space-y-3">
                                            @foreach($block['data']['items'] ?? [] as $itemIndex => $item)
                                                <div class="p-4 border border-line-2 rounded-xl relative space-y-3 bg-surface/50">
                                                    <div class="absolute top-2 right-2">
                                                        <flux:button type="button" size="sm" variant="danger" wire:click="removeRepeaterItem({{ $index }}, 'items', {{ $itemIndex }})">X</flux:button>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-4">
                                                        <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.name" label="Author Name" />
                                                        <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.role" label="Author Role/Company" />
                                                    </div>
                                                    <flux:textarea wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.quote" label="Quote" rows="2" />
                                                </div>
                                            @endforeach
                                        </div>
                                        <flux:button type="button" size="sm" class="mt-2" wire:click="addRepeaterItem({{ $index }}, 'items', {name: 'John Doe', role: 'CTO', quote: 'Amazing product!'} )">+ Add Testimonial</flux:button>
                                        
                                    @elseif($block['type'] === 'faq')
                                        <flux:input wire:model="blocks.{{ $index }}.data.heading" label="Section Heading" />
                                        <flux:heading size="sm" class="mb-2 mt-4">Questions & Answers</flux:heading>
                                        <div class="space-y-3">
                                            @foreach($block['data']['items'] ?? [] as $itemIndex => $item)
                                                <div class="p-4 border border-line-2 rounded-xl relative space-y-3 bg-surface/50">
                                                    <div class="absolute top-2 right-2">
                                                        <flux:button type="button" size="sm" variant="danger" wire:click="removeRepeaterItem({{ $index }}, 'items', {{ $itemIndex }})">X</flux:button>
                                                    </div>
                                                    <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.question" label="Question" />
                                                    <flux:textarea wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.answer" label="Answer" rows="2" />
                                                </div>
                                            @endforeach
                                        </div>
                                        <flux:button type="button" size="sm" class="mt-2" wire:click="addRepeaterItem({{ $index }}, 'items', {question: 'New Question?', answer: 'New answer'} )">+ Add Question</flux:button>
                                        
                                    @elseif($block['type'] === 'pricing')
                                        <flux:input wire:model="blocks.{{ $index }}.data.heading" label="Section Heading" />
                                        <flux:heading size="sm" class="mb-2 mt-4">Pricing Plans</flux:heading>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach($block['data']['items'] ?? [] as $itemIndex => $item)
                                            <div class="p-4 border border-line-2 rounded-xl relative space-y-4 bg-surface/50">
                                                <div class="absolute top-2 right-2 mt-2">
                                                    <flux:button type="button" size="sm" variant="danger" wire:click="removeRepeaterItem({{ $index }}, 'items', {{ $itemIndex }})">X</flux:button>
                                                </div>
                                                
                                                <div class="flex items-center space-x-4 mb-2 pr-8">
                                                    <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.name" label="Plan Name" class="flex-1" />
                                                    <div class="pt-6">
                                                        <flux:switch wire:model.live="blocks.{{ $index }}.data.items.{{ $itemIndex }}.popular" label="Popular" />
                                                    </div>
                                                </div>
                                                
                                                <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.price" label="Price (e.g. $29/mo)" />
                                                
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                                    <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.cta_text" label="Button Text" />
                                                    <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.cta_link" label="Button Link" />
                                                </div>
                                                
                                                <div class="mt-4">
                                                    <flux:heading size="sm" class="mb-2">Features Included</flux:heading>
                                                    <div class="space-y-2">
                                                        @foreach($item['features'] ?? [] as $featureIndex => $feature)
                                                            <div class="flex items-center space-x-2">
                                                                <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.features.{{ $featureIndex }}" class="flex-1" />
                                                                <flux:button type="button" size="sm" class="mt-2" variant="danger" wire:click="removePricingFeature({{ $index }}, {{ $itemIndex }}, {{ $featureIndex }})">X</flux:button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <flux:button type="button" size="sm" class="mt-2" variant="subtle" wire:click="addPricingFeature({{ $index }}, {{ $itemIndex }})">+ Add Feature</flux:button>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                        <flux:button type="button" size="sm" class="mt-4" wire:click="addRepeaterItem({{ $index }}, 'items', {name: 'Pro', price: '49', popular: false, features: ['Core'], cta_text: 'Get Started', cta_link: '#'} )">+ Add Plan</flux:button>
                                        
                                    @else
                                        <div class="text-sm text-yellow-500">Unrecognized block type {{ $block['type'] }}. Structural editing not supported.</div>
                                    @endif
                                    
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
