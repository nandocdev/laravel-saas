<section class="py-24 px-6 md:px-12 lg:px-24 bg-primary text-white relative overflow-hidden" id="logros">
    {{-- Grid background pattern --}}
    <div class="absolute inset-0 bg-white/5 bg-[radial-gradient(var(--tw-gradient-from)_1px,transparent_1px)] [background-size:32px_32px]"></div>

    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4 text-white">
                {{ $block->setting('title', 'Nuestros números') }}
            </h2>
            <div class="h-1 w-20 bg-white/50 mx-auto rounded-full mb-6"></div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 text-center text-white">
            @foreach($block->setting('items', []) as $index => $item)
                <div class="p-6 md:p-8 rounded-3xl bg-white/10 backdrop-blur-md border border-white/20 hover:bg-white/15 transition-all shadow-lg group">
                    <span class="text-4xl md:text-5xl mb-6 block group-hover:scale-110 transition-transform origin-bottom">{{ $item['icon'] ?? '🏆' }}</span>
                    <h3 class="text-3xl md:text-5xl font-black mb-3 tracking-tighter">{{ $item['value'] ?? '0' }}</h3>
                    <p class="text-white/80 font-medium uppercase tracking-widest text-xs md:text-sm">{{ $item['title'] ?? 'Logro' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
