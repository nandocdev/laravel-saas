<section class="py-24 px-6 md:px-12 lg:px-24 bg-gradient-to-br from-primary/10 via-bgPage to-accent/5 relative overflow-hidden">
    {{-- Grid background pattern --}}
    <div class="absolute inset-0 bg-[radial-gradient(var(--tw-gradient-from)_1px,transparent_1px)] [background-size:32px_32px] opacity-30"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto {{ ($settings['layout'] ?? 'centered') === 'centered' ? 'text-center' : '' }}">
        
        @if($block->setting('badge'))
            <div class="inline-block bg-accent/15 text-accent border border-accent/30 px-4 py-1.5 rounded-full text-sm font-bold mb-6">
                {{ $block->setting('badge') }}
            </div>
        @endif
        
        <h1 class="text-4xl md:text-5xl lg:text-7xl font-black leading-tight mb-6 tracking-tight text-textPrimary">
            {{ $block->setting('headline', 'El servicio que tu negocio necesita') }}
        </h1>
        
        <p class="text-lg md:text-xl text-textSecondary mb-10 leading-relaxed max-w-2xl {{ ($settings['layout'] ?? 'centered') === 'centered' ? 'mx-auto' : '' }}">
            {{ $block->setting('subheadline', 'Profesional · Confiable · Siempre disponible') }}
        </p>
        
        <div class="flex flex-wrap gap-4 {{ ($settings['layout'] ?? 'centered') === 'centered' ? 'justify-center' : '' }}">
            <a href="{{ $block->setting('cta_url', '#') }}" class="btn-primary px-8 py-4 rounded-xl text-lg font-bold">
                {{ $block->setting('cta_text', 'Comenzar ahora') }}
            </a>
            
            @if($block->setting('cta2_text'))
                <a href="{{ $block->setting('cta2_url', '#') }}" class="px-8 py-4 rounded-xl text-lg font-bold border-2 border-borderColor text-textPrimary hover:bg-borderColor hover:text-textPrimary transition-colors">
                    {{ $block->setting('cta2_text') }}
                </a>
            @endif
        </div>
    </div>
</section>
