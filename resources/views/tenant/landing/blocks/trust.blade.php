<section class="py-16 bg-bgPage text-center border-t border-borderColor relative overflow-hidden" id="confianza">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-sm font-bold tracking-widest text-textSecondary uppercase mb-10">
            {{ $block->setting('title', 'Empresas que confían en nosotros') }}
        </h2>
        
        <div class="flex flex-wrap justify-center items-center gap-x-16 gap-y-12">
            @foreach($block->setting('items', []) as $item)
                <div class="flex items-center gap-3 text-textSecondary hover:text-primary transition-colors duration-300 grayscale hover:grayscale-0 opacity-60 hover:opacity-100">
                    <span class="text-4xl filter drop-shadow-sm">{{ $item['icon'] ?? '🏢' }}</span>
                    <span class="text-xl font-bold tracking-tight">{{ $item['title'] ?? 'Empresa' }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
