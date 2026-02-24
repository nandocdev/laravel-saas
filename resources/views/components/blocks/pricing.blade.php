@props(['data' => []])

<div class="py-24 bg-surface border-t border-line-2">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <flux:heading size="xl" class="mb-12">{{ $data['heading'] ?? 'Simple, Transparent Pricing' }}</flux:heading>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            @foreach($data['items'] ?? [] as $item)
                <div class="p-8 rounded-2xl bg-surface border border-line-2 flex flex-col {{ !empty($item['popular']) ? 'ring-2 relative' : '' }}" style="{{ !empty($item['popular']) ? 'border-color: var(--brand-primary); --tw-ring-color: var(--brand-primary);' : '' }}">
                    @if(!empty($item['popular']))
                        <span class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 text-primary-foreground text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide" style="background-color: var(--brand-primary)">Most Popular</span>
                    @endif
                    <h3 class="text-xl font-bold text-foreground mb-2">{{ $item['name'] ?? '' }}</h3>
                    <div class="text-3xl font-bold mb-6">${{ $item['price'] ?? '0' }}<span class="text-base font-normal text-muted-foreground-1">/mo</span></div>
                    
                    <ul class="mb-8 space-y-3 flex-1 flex flex-col">
                        @foreach($item['features'] ?? [] as $feature)
                            <li class="flex items-start text-muted-foreground-1">
                                <svg class="w-5 h-5 mr-2 shrink-0" style="color: var(--brand-primary)" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                    
                    <a href="{{ $item['cta_link'] ?? '#' }}" class="block w-full py-3 px-4 text-primary-foreground text-center rounded-lg font-bold hover:brightness-90 transition-colors" style="background-color: var(--brand-primary)">
                        {{ $item['cta_text'] ?? 'Choose Plan' }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
