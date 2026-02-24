@props(['blocks', 'logo' => null])

<div class="landing-template-visual bg-zinc-950 text-white selection:bg-teal-500/30">
    @if($logo)
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex justify-between items-center">
            <img src="{{ asset('storage/' . $logo) }}" class="h-10 object-contain brightness-0 invert">
        </div>
    @endif
    {{-- Visual: High contrast, dark mode, immersive. --}}
    @foreach($blocks as $block)
        <div class="visual-block-wrapper">
            <x-dynamic-component 
                :component="'blocks.' . $block['type']" 
                :data="$block['data'] ?? []" 
            />
        </div>
    @endforeach
</div>
