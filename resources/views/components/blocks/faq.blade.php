@props(['data' => []])

<div class="py-24 bg-surface/50 border-t border-line-2">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <flux:heading size="xl" class="text-center mb-12">{{ $data['heading'] ?? 'Frequently Asked Questions' }}</flux:heading>
        
        <div class="space-y-4">
            @foreach($data['items'] ?? [] as $item)
                <details class="group bg-surface border border-line-2 rounded-xl p-6 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between cursor-pointer font-bold text-lg text-foreground">
                        {{ $item['question'] ?? '' }}
                        <span class="transition group-open:rotate-180">
                            <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                        </span>
                    </summary>
                    <p class="text-muted-foreground-1 mt-4 leading-relaxed group-open:animate-fadeIn">
                        {!! nl2br(e($item['answer'] ?? '')) !!}
                    </p>
                </details>
            @endforeach
        </div>
    </div>
</div>
