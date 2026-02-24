@props(['data' => []])

<div class="py-24 bg-surface border-t border-line-2">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-foreground mb-12">{{ $data['heading'] ?? 'Simple, Transparent Pricing' }}</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            @foreach($data['items'] ?? [] as $item)
                @php
                    $isPopular = !empty($item['popular']);
                @endphp
                <div class="flex flex-col bg-surface border {{ $isPopular ? 'border-[var(--brand-primary)] shadow-2xl shadow-[var(--brand-primary)]/10 ring-1 ring-[var(--brand-primary)] scale-105 z-10' : 'border-line-2 shadow-sm' }} rounded-3xl p-8 transition-all duration-300 relative"
                     style="--brand-primary: var(--brand-primary)">
                    
                    @if($isPopular)
                        <span class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 text-primary-foreground text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider shadow-lg" style="background-color: var(--brand-primary)">Most Popular</span>
                    @endif
                    
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-foreground mb-2">{{ $item['name'] ?? '' }}</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl font-extrabold text-foreground">${{ $item['price'] ?? '0' }}</span>
                            <span class="text-muted-foreground-1">/mo</span>
                        </div>
                    </div>
                    
                    <ul class="mb-8 space-y-4 flex-1">
                        @foreach($item['features'] ?? [] as $feature)
                            <li class="flex items-start gap-x-3 text-muted-foreground-1">
                                <svg class="size-5 shrink-0 mt-0.5" style="color: var(--brand-primary)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                    
                    <a href="{{ $item['cta_link'] ?? '#' }}" 
                       class="block w-full py-4 px-6 text-center font-bold rounded-xl transition-all duration-200 {{ $isPopular ? 'text-primary-foreground hover:brightness-110 shadow-lg shadow-[var(--brand-primary)]/20' : 'bg-surface-1 text-foreground border border-line-2 hover:bg-surface-2' }}"
                       style="{{ $isPopular ? 'background-color: var(--brand-primary)' : '' }}">
                        {{ $item['cta_text'] ?? 'Choose Plan' }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

