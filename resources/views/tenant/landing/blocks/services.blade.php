<section class="py-24 px-6 md:px-12 lg:px-24 bg-bgSection relative border-y border-borderColor">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4">
                {{ $block->setting('title', 'Lo que ofrecemos') }}
            </h2>
            <div class="h-1 w-20 bg-primary mx-auto rounded-full"></div>
            <p class="mt-6 text-xl text-textSecondary max-w-2xl mx-auto">
                {{ $block->setting('subtitle', 'Soluciones diseñadas para llevar tu negocio al siguiente nivel.') }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($block->setting('items', []) as $item)
                <div class="group bg-bgCard border border-borderColor p-8 rounded-3xl shadow-sm hover:shadow-xl hover:border-primary/30 transition-all duration-300 flex flex-col items-center text-center {{ ($settings['layout'] ?? 'cards-3') === 'cards-2' ? 'lg:col-span-1 md:col-span-1' : '' }}">
                    <div class="size-16 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-3xl mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        {{ $item['icon'] ?? '✨' }}
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-textPrimary">{{ $item['title'] ?? 'Servicio' }}</h3>
                    <p class="text-textSecondary leading-relaxed flex-grow">{{ $item['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
