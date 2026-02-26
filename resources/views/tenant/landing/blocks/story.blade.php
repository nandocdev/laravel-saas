<section class="py-24 px-6 md:px-12 lg:px-24 bg-bgPage relative border-t border-borderColor" id="historia">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4 text-textPrimary">
                {{ $block->setting('title', 'Nuestra historia') }}
            </h2>
            <div class="h-1 w-20 bg-primary mx-auto rounded-full mb-6"></div>
        </div>

        <div class="space-y-12 border-l-2 border-primary/30 ml-4 md:ml-auto md:w-fit md:mx-auto pt-4 pb-8 pl-8 relative">
            
            {{-- Dot superior línea --}}
            <div class="absolute -top-1 -left-2 size-4 rounded-full bg-primary/30"></div>
            {{-- Dot inferior línea --}}
            <div class="absolute -bottom-1 -left-2 size-4 rounded-full bg-primary/30"></div>
            
            @foreach($block->setting('milestones', []) as $milestone)
                <div class="relative group">
                    {{-- Timeline dot --}}
                    <div class="absolute -left-[42px] top-1 size-5 rounded-full bg-bgPage border-2 border-primary group-hover:bg-primary group-hover:scale-125 transition-all outline outline-4 outline-bgPage z-10"></div>
                    
                    <div class="bg-bgCard p-6 rounded-2xl border border-borderColor/50 shadow-sm hover:shadow-md transition-shadow">
                        <span class="text-primary font-black text-xl mb-2 block tracking-wider drop-shadow-sm">{{ $milestone['year'] ?? '' }}</span>
                        <p class="text-textSecondary text-lg leading-relaxed">{{ $milestone['event'] ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
