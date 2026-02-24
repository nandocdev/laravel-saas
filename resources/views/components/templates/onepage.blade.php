@props(['blocks', 'logo' => null])

<div class="landing-template-onepage max-w-3xl mx-auto border-x border-line-2 shadow-sm bg-surface">
    {{-- One Page Minimal: Ultra simple, constrained width. --}}
    @foreach($blocks as $block)
        <x-dynamic-component 
            :component="'blocks.' . $block['type']" 
            :data="$block['data'] ?? []" 
        />
    @endforeach
</div>
