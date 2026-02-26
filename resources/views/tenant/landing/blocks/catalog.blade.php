<section class="py-24 px-6 md:px-12 lg:px-24 bg-bgSection relative border-y border-borderColor" id="catalog">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div>
                <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4 text-textPrimary">
                    {{ $block->setting('title', 'Catálogo Exclusivo') }}
                </h2>
                <div class="h-1 w-20 bg-primary rounded-full mb-6"></div>
                <p class="text-xl text-textSecondary max-w-2xl">Colección curada de productos de alta calidad diseñados para ti.</p>
            </div>
            
            <a href="#contacto" class="text-primary font-bold hover:underline underline-offset-4 decoration-2">
                Ver todos los productos <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($block->setting('items', []) as $item)
                <div class="group relative bg-bgCard border border-borderColor rounded-3xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="aspect-[4/5] bg-bgPage relative overflow-hidden">
                        <img 
                            src="{{ $item['image_url'] ?? 'https://via.placeholder.com/500x625.png?text=Producto' }}" 
                            alt="{{ $item['name'] ?? 'Producto' }}" 
                            class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-[cubic-bezier(0.19,1,0.22,1)]"
                        >
                        {{-- Overlay sutil al hover --}}
                        <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        {{-- Botón rápido (decorativo por ahora) --}}
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <span class="bg-white text-black font-bold py-2 px-6 rounded-full shadow-lg text-sm drop-shadow">Añadir</span>
                        </div>
                    </div>
                    
                    <div class="p-6 text-center">
                        <h3 class="text-lg font-bold text-textPrimary mb-2">{{ $item['name'] ?? 'Nombre del Producto' }}</h3>
                        @if($block->setting('show_price', true))
                            <p class="text-primary font-black text-xl tracking-tight">${{ $item['price'] ?? '0.00' }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
