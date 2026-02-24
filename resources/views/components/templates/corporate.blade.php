@props(['blocks'])

<div class="landing-template-corporate bg-surface text-foreground">
    {{-- Classic Corporate: Clean, formal, professional. Normal rendering. --}}
    @foreach($blocks as $block)
        <x-dynamic-component 
            :component="'blocks.' . $block['type']" 
            :data="$block['data'] ?? []" 
        />
    @endforeach
</div>
