<section class="py-24 px-6 md:px-12 lg:px-24 {{ ($settings['style'] ?? 'soft') === 'urgent' ? 'bg-primary text-white' : 'bg-bgSection text-textPrimary' }} relative overflow-hidden" id="cta">
    
    @if(($settings['style'] ?? 'soft') === 'urgent')
        <div class="absolute inset-0 bg-white/5 bg-[radial-gradient(var(--tw-gradient-from)_1px,transparent_1px)] [background-size:20px_20px]"></div>
    @endif
    
    <div class="max-w-4xl mx-auto text-center relative z-10">
        <h2 class="text-4xl md:text-6xl font-black mb-6 tracking-tight {{ ($settings['style'] ?? 'soft') === 'urgent' ? 'text-white' : 'text-textPrimary' }}">
            {{ $block->setting('title', '¿Listo para empezar?') }}
        </h2>
        
        <p class="text-xl md:text-2xl mb-12 {{ ($settings['style'] ?? 'soft') === 'urgent' ? 'text-white/80' : 'text-textSecondary' }} max-w-2xl mx-auto leading-relaxed">
            {{ $block->setting('subtitle', 'Únete a miles de clientes satisfechos que ya han transformado su forma de trabajar.') }}
        </p>
        
        <a href="{{ $block->setting('cta_url', '#') }}" class="{{ ($settings['style'] ?? 'soft') === 'urgent' ? 'bg-white text-primary hover:bg-gray-100 shadow-xl shadow-black/20' : 'btn-primary' }} px-10 py-5 rounded-2xl text-xl font-black inline-flex items-center gap-3 group transition-transform duration-300 hover:scale-105">
            {{ $block->setting('cta_text', 'Comenzar ahora') }}
            <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </div>
</section>
