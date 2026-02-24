@props(['data' => []])

<div class="py-24 bg-surface border-t border-line-2">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-foreground mb-12">{{ $data['heading'] ?? 'What Our Clients Say' }}</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($data['items'] ?? [] as $item)
                <div class="flex flex-col bg-surface border border-line-2 rounded-2xl p-8 hover:shadow-lg transition-all duration-300">
                    <div class="mb-6">
                        <svg class="size-8 text-muted-foreground-1/20" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                        </svg>
                    </div>
                    
                    <p class="text-lg text-muted-foreground-1 mb-8 italic flex-1">
                        "{!! nl2br(e($item['quote'] ?? '')) !!}"
                    </p>
                    
                    <div class="flex items-center gap-4 border-t border-line-2 pt-6">
                        <div class="size-12 rounded-full bg-surface-1 flex items-center justify-center font-bold text-lg text-foreground border border-line-2">
                            {{ substr($item['name'] ?? 'U', 0, 1) }}
                        </div>
                        <div>
                            <div class="font-bold text-foreground">{{ $item['name'] ?? '' }}</div>
                            <div class="text-sm text-muted-foreground-1">{{ $item['role'] ?? '' }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

