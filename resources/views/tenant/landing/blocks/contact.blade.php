<section class="py-24 px-6 md:px-12 lg:px-24 bg-bgPage relative border-t border-borderColor" id="contacto">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-16 items-start">
        <div class="md:w-1/2 space-y-8">
            <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight text-textPrimary">
                {{ $block->setting('title', 'Contacto') }}
            </h2>
            <div class="h-1 w-20 bg-primary rounded-full"></div>
            
            <p class="text-xl text-textSecondary leading-relaxed">
                Estamos aquí para ayudarte. Escríbenos o visítanos, responderemos lo antes posible.
            </p>
            
            <div class="space-y-6 pt-4">
                @if($block->setting('email'))
                <a href="mailto:{{ $block->setting('email') }}" class="flex items-center gap-4 text-textSecondary hover:text-primary transition-colors group">
                    <div class="size-12 rounded-xl bg-bgCard border border-borderColor flex items-center justify-center text-xl group-hover:bg-primary/10 group-hover:border-primary/30 transition-all">✉️</div>
                    <span class="text-lg font-medium">{{ $block->setting('email') }}</span>
                </a>
                @endif
                
                @if($block->setting('phone'))
                <a href="tel:{{ $block->setting('phone') }}" class="flex items-center gap-4 text-textSecondary hover:text-primary transition-colors group">
                    <div class="size-12 rounded-xl bg-bgCard border border-borderColor flex items-center justify-center text-xl group-hover:bg-primary/10 group-hover:border-primary/30 transition-all">📞</div>
                    <span class="text-lg font-medium">{{ $block->setting('phone') }}</span>
                </a>
                @endif
                
                @if($block->setting('address'))
                <div class="flex items-start gap-4 text-textSecondary group cursor-default">
                    <div class="size-12 rounded-xl bg-bgCard border border-borderColor flex items-center justify-center text-xl shrink-0">📍</div>
                    <div class="text-lg leading-relaxed mt-1">
                        {!! nl2br(e($block->setting('address'))) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="md:w-1/2 w-full">
            @if($block->setting('show_map', false) && $block->setting('address'))
                <div class="w-full h-96 rounded-3xl overflow-hidden shadow-lg border border-borderColor relative group">
                    <iframe 
                        width="100%" 
                        height="100%" 
                        frameborder="0" 
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0" 
                        src="https://maps.google.com/maps?q={{ urlencode($block->setting('address')) }}&t=m&z=15&output=embed"
                        class="grayscale hover:grayscale-0 transition-all duration-700"
                    ></iframe>
                    
                    <div class="absolute inset-0 bg-primary/20 pointer-events-none group-hover:opacity-0 transition-opacity duration-700"></div>
                </div>
            @else
                <div class="bg-bgCard border border-borderColor p-8 rounded-3xl shadow-sm">
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-textPrimary mb-2" for="name">Nombre</label>
                            <input class="w-full bg-bgPage border border-borderColor rounded-xl px-4 py-3 text-textPrimary focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" id="name" type="text" placeholder="Tu nombre">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-textPrimary mb-2" for="email">Email</label>
                            <input class="w-full bg-bgPage border border-borderColor rounded-xl px-4 py-3 text-textPrimary focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" id="email" type="email" placeholder="tu@email.com">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-textPrimary mb-2" for="message">Mensaje</label>
                            <textarea class="w-full bg-bgPage border border-borderColor rounded-xl px-4 py-3 text-textPrimary focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" id="message" rows="4" placeholder="¿En qué podemos ayudarte?"></textarea>
                        </div>
                        <button class="w-full btn-primary font-bold py-4 px-6 rounded-xl text-lg flex justify-center items-center gap-2" type="button">
                            Enviar mensaje
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</section>
