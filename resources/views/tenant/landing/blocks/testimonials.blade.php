<section class="py-24 px-6 md:px-12 lg:px-24 bg-bgPage relative">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4">
                {{ $block->setting('title', 'Lo que dicen nuestros clientes') }}
            </h2>
            <div class="h-1 w-20 bg-primary mx-auto rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($block->setting('items', []) as $item)
                <div class="bg-bgCard border border-borderColor p-8 rounded-3xl shadow-sm hover:shadow-md transition-all flex flex-col relative">
                    {{-- Comillas decorativas --}}
                    <div class="absolute top-6 right-8 text-6xl text-primary/10 font-serif leading-none rotate-180">"</div>
                    
                    {{-- Estrellas --}}
                    <div class="flex gap-1 mb-6 text-amber-400 text-lg">
                        @for($i = 0; $i < ($item['rating'] ?? 5); $i++)
                            <span>★</span>
                        @endfor
                        @for($i = ($item['rating'] ?? 5); $i < 5; $i++)
                            <span class="text-gray-300 dark:text-gray-700">★</span>
                        @endfor
                    </div>
                    
                    {{-- Texto --}}
                    <p class="text-textPrimary text-lg italic leading-relaxed mb-8 flex-grow">
                        "{{ $item['text'] }}"
                    </p>
                    
                    {{-- Autor --}}
                    <div class="flex items-center gap-4 mt-auto pt-6 border-t border-borderColor/50">
                        <div class="size-12 rounded-full bg-gradient-to-br from-primary to-accent flex items-center justify-center text-white font-bold text-xl shadow-inner">
                            {{ substr($item['author'] ?? 'U', 0, 1) }}
                        </div>
                        <div>
                            <div class="font-bold text-textPrimary text-lg">{{ $item['author'] }}</div>
                            <div class="text-textSecondary text-sm">{{ $item['role'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
