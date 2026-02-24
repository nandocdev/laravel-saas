@props(['data' => []])

<div class="py-24 bg-surface/50 border-t border-line-2" id="services">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($data['items'] ?? [] as $item)
                <div class="group flex flex-col h-full bg-surface border border-line-2 hover:border-[var(--brand-primary)] hover:shadow-xl hover:shadow-[var(--brand-primary)]/5 rounded-3xl p-8 transition-all duration-300" 
                     style="--brand-primary: var(--brand-primary)">
                    <div class="size-14 rounded-2xl mb-6 flex items-center justify-center transition-colors group-hover:scale-110 duration-300" 
                         style="background-color: color-mix(in srgb, var(--brand-primary), transparent 90%); color: var(--brand-primary)">
                        <svg class="size-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-4 transition-colors group-hover:text-[var(--brand-primary)]">
                        {{ $item['title'] ?? '' }}
                    </h3>
                    <p class="text-muted-foreground-1 leading-relaxed text-lg">
                        {{ $item['description'] ?? '' }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>

