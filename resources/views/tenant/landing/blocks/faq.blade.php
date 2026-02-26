<section class="py-24 px-6 md:px-12 lg:px-24 bg-bgPage relative overflow-hidden" id="faq">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4 text-textPrimary">
                {{ $block->setting('title', 'Preguntas frecuentes') }}
            </h2>
            <div class="h-1 w-20 bg-primary mx-auto rounded-full mb-6"></div>
            <p class="text-xl text-textSecondary">Resolvemos tus dudas para que puedas tomar la mejor decisión con confianza.</p>
        </div>

        <div class="space-y-4" x-data="{ selected: null }">
            @foreach($block->setting('items', []) as $index => $item)
                <div class="bg-bgCard border border-borderColor rounded-2xl overflow-hidden shadow-sm hover:border-primary/50 transition-colors duration-300">
                    <button 
                        @click="selected !== {{ $index }} ? selected = {{ $index }} : selected = null"
                        class="w-full flex justify-between items-center p-6 text-left focus:outline-none focus-visible:ring-2 ring-primary/50"
                    >
                        <h3 class="font-bold text-lg md:text-xl text-textPrimary pr-4 flex-grow">{{ $item['question'] ?? 'Pregunta frecuente' }}</h3>
                        <span class="flex-shrink-0 size-8 rounded-full bg-primary/10 text-primary flex items-center justify-center transition-transform duration-300 ease-in-out" :class="{'rotate-180 bg-primary text-white': selected === {{ $index }}}">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </span>
                    </button>
                    
                    <div 
                        x-show="selected === {{ $index }}" 
                        x-collapse 
                        x-cloak
                        class="px-6 pb-8 text-textSecondary text-lg leading-relaxed border-t border-borderColor/30 mt-2 pt-6"
                    >
                        {{ $item['answer'] ?? 'Respuesta detallada' }}
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-16 text-center border-t border-borderColor pt-10">
            <p class="text-textSecondary text-lg mb-6">¿Aún tienes dudas? No te preocupes, estamos para ayudarte.</p>
            <a href="#contacto" class="btn-primary px-8 py-3 rounded-xl font-bold inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Contactar soporte
            </a>
        </div>
    </div>
</section>
