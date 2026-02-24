@props(['data' => []])

<div class="py-24 bg-surface/50 border-t border-line-2">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($data['items'] ?? [] as $item)
                <div class="p-6 rounded-2xl bg-surface border border-line-2 hover:shadow-md transition-shadow group">
                    <div class="size-10 rounded-lg mb-4 flex items-center justify-center" style="background-color: color-mix(in srgb, var(--brand-accent), transparent 90%); color: var(--brand-accent)">
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-foreground mb-3 group-hover:text-[var(--brand-primary)] transition-colors" style="--brand-primary: var(--brand-primary)">{{ $item['title'] ?? '' }}</h3>
                    <p class="text-muted-foreground-1 leading-relaxed">{{ $item['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
