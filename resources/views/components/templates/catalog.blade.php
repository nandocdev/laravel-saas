@props(['blocks'])

<div class="landing-template-catalog bg-gray-50 text-gray-900">
    {{-- Marketplace / Catalog: Oriented to grid products. --}}
    @foreach($blocks as $block)
        <x-dynamic-component 
            :component="'blocks.' . $block['type']" 
            :data="$block['data'] ?? []" 
        />
    @endforeach
</div>
