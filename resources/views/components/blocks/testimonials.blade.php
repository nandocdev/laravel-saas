@props(['data' => []])

<div class="py-24 bg-surface">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <flux:heading size="xl" class="text-center mb-12">{{ $data['heading'] ?? 'What Our Clients Say' }}</flux:heading>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($data['items'] ?? [] as $item)
                <div class="p-6 rounded-2xl bg-surface border border-line-2 shadow-sm">
                    <p class="text-muted-foreground-1 mb-4 italic">"{!! nl2br(e($item['quote'] ?? '')) !!}"</p>
                    <div class="flex items-center gap-3">
                        <div class="font-bold text-foreground">{{ $item['name'] ?? '' }}</div>
                        <div class="text-sm text-muted-foreground-1">{{ $item['role'] ?? '' }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
