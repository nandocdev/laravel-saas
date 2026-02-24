@props(['data' => []])

<div class="py-24 bg-surface/50 border-t border-line-2">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($data['items'] ?? [] as $item)
                <div class="p-6 rounded-2xl bg-surface border border-line-2 hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-bold text-foreground mb-3">{{ $item['title'] ?? '' }}</h3>
                    <p class="text-muted-foreground-1 leading-relaxed">{{ $item['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
