@props(['blocks'])

<div class="landing-template-storytelling bg-amber-50 text-amber-950 font-serif">
    {{-- Storytelling: More human, warm colors, minimalist background. --}}
    @foreach($blocks as $block)
        <x-dynamic-component 
            :component="'blocks.' . $block['type']" 
            :data="$block['data'] ?? []" 
        />
    @endforeach
</div>
