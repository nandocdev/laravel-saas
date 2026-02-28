@props(['data' => []])

<div class="py-24 bg-surface/50 border-t border-line-2">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-foreground mb-12">{{ $data['heading'] ?? 'Frequently Asked Questions' }}</h2>
        
        <div class="hs-accordion-group space-y-4">
            @foreach($data['items'] ?? [] as $index => $item)
                <div class="hs-accordion bg-surface border border-line-2 rounded-xl" id="hs-basic-heading-{{ $index }}">
                    <button class="hs-accordion-toggle hs-accordion-active:text-[var(--brand-primary)] py-5 px-6 inline-flex items-center justify-between gap-x-3 w-full font-bold text-start text-foreground hover:bg-surface-1 rounded-xl transition-all" 
                        aria-expanded="false" 
                        aria-controls="hs-basic-collapse-{{ $index }}"
                        style="--brand-primary: var(--brand-primary)">
                        {{ $item['question'] ?? '' }}
                        <svg class="hs-accordion-active:rotate-180 size-4 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>
                    <div id="hs-basic-collapse-{{ $index }}" 
                        class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" 
                        role="region" 
                        aria-labelledby="hs-basic-heading-{{ $index }}">
                        <div class="pb-6 px-6">
                            <p class="text-muted-foreground-1 leading-relaxed">
                                {!! nl2br(e($item['answer'] ?? '')) !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

