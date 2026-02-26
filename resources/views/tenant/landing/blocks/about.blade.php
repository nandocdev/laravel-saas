<section class="py-24 px-6 md:px-12 lg:px-24 bg-bgSection relative overflow-hidden" id="about">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-16 items-center">
        
        <div class="md:w-1/2 space-y-8 relative z-10 lg:pr-8">
            <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight text-textPrimary">
                {{ $block->setting('title', 'Sobre Nosotros') }}
            </h2>
            <div class="h-1 w-20 bg-primary rounded-full"></div>
            
            <div class="text-lg md:text-xl text-textSecondary leading-relaxed space-y-6 opacity-90">
                {!! nl2br(e($block->setting('body'))) !!}
            </div>
            
            <div class="flex items-center gap-12 pt-6 border-t border-borderColor/50">
                <div class="text-center">
                    <div class="text-4xl font-black text-primary mb-1">10+</div>
                    <div class="text-sm font-bold text-textSecondary uppercase tracking-wider">Años Exp.</div>
                </div>
                <div class="text-center border-l-2 border-borderColor pl-12">
                    <div class="text-4xl font-black text-primary mb-1">5k</div>
                    <div class="text-sm font-bold text-textSecondary uppercase tracking-wider">Clientes</div>
                </div>
            </div>
        </div>

        <div class="md:w-1/2 relative group hidden md:block">
            <div class="absolute inset-0 bg-primary/10 -ml-6 mt-6 rounded-3xl -z-10 transition-transform duration-500 group-hover:translate-x-4 group-hover:-translate-y-4"></div>
            
            @if($block->setting('image_url'))
                <img src="{{ $block->setting('image_url') }}" alt="Sobre Nosotros" class="w-full h-auto rounded-3xl object-cover shadow-2xl relative z-0 group-hover:scale-y-105 transition-all duration-700 ease-[cubic-bezier(0.19,1,0.22,1)] origin-bottom">
            @endif
        </div>
    </div>
</section>
