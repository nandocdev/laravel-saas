<section class="py-24 px-6 md:px-12 lg:px-24 bg-bgSection relative border-t border-borderColor" id="pricing">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4 text-textPrimary">{{ $block->setting('title', 'Planes simples, resultados reales') }}</h2>
            <div class="h-1 w-20 bg-primary mx-auto rounded-full mb-6"></div>
            <p class="text-xl text-textSecondary max-w-2xl mx-auto">{{ $block->setting('subtitle', 'Elige el plan que mejor se adapte a tus necesidades. Sin sorpresas, cambia o cancela cuando quieras.') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto items-center">
            @foreach($block->setting('plans', []) as $plan)
                @php
                    $isFeatured = $plan['featured'] ?? false;
                @endphp
                <div class="card p-8 rounded-3xl flex flex-col relative transition-all duration-300 {{ $isFeatured ? 'border-2 border-primary shadow-2xl scale-105 z-10 bg-primary/5' : 'border border-borderColor shadow-lg hover:shadow-xl' }}">
                    
                    @if($isFeatured)
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-primary text-white px-6 py-1.5 rounded-full text-sm font-bold tracking-wider uppercase shadow-md flex items-center gap-2">
                            <span class="text-yellow-300">★</span> Popular
                        </div>
                    @endif

                    <h3 class="text-2xl font-bold mb-2 text-textPrimary text-center">{{ $plan['name'] }}</h3>
                    <p class="text-textSecondary text-center mb-8 border-b border-borderColor/50 pb-8 text-sm opacity-80">Ideal para empezar</p>

                    <div class="flex items-baseline justify-center mb-8 gap-1">
                        <span class="text-3xl font-bold text-textSecondary align-top">{{ $block->setting('currency', '$') }}</span>
                        <span class="text-6xl font-black tracking-tighter text-textPrimary">{{ $plan['price'] }}</span>
                        <span class="text-lg text-textSecondary ml-1">/{{ $plan['period'] ?? 'mes' }}</span>
                    </div>

                    <ul class="space-y-4 mb-10 flex-grow text-textSecondary">
                        @foreach($plan['features'] ?? [] as $feature)
                            <li class="flex items-start gap-3">
                                <span class="text-green-500 mt-1 flex-shrink-0">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                </span>
                                <span>{{ is_array($feature) ? ($feature['name'] ?? '') : $feature }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a href="#" class="w-full py-4 px-6 rounded-xl font-bold text-center transition-all duration-300 {{ $isFeatured ? 'btn-primary' : 'bg-primary/10 text-primary hover:bg-primary/20 hover:text-primary shadow-sm' }}">
                        {{ $plan['cta'] ?? 'Elegir plan' }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
