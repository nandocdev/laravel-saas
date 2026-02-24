@props(['blocks'])

<div class="landing-template-visual bg-zinc-950 text-zinc-50 dark:bg-background dark:text-foreground">
    {{-- Visual / Experience: High visual impact, dark mode by default or strong contrast. --}}
    @foreach($blocks as $block)
        <div class="visual-block-wrapper">
            <x-dynamic-component 
                :component="'blocks.' . $block['type']" 
                :data="$block['data'] ?? []" 
            />
        </div>
    @endforeach
</div>
