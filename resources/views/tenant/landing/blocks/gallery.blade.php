<section id="gallery" class="py-24 px-6 md:px-12 lg:px-24 bg-bgPage relative">
    @if($block->setting('title'))
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4">{{ $block->setting('title') }}</h2>
            <div class="h-1 w-20 bg-primary mx-auto rounded-full"></div>
        </div>
    @endif
    
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($block->setting('images', []) as $image)
            <div class="group relative rounded-2xl overflow-hidden aspect-[4/3] bg-primary/5 cursor-pointer shadow-sm hover:shadow-xl transition-all duration-300">
                <img src="{{ $image['url'] }}" alt="{{ $image['alt'] ?? '' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    @if(isset($image['alt']) && !empty($image['alt']))
                        <span class="text-white font-semibold text-lg drop-shadow-md">{{ $image['alt'] }}</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
