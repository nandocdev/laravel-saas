@props(['blocks', 'logo' => null])

<div class="landing-template-conversion bg-slate-50 text-slate-900 border-t-4 border-red-500">
    {{-- Direct Conversion: Less storytelling, more action. High urgency colors. --}}
    @foreach($blocks as $block)
        <x-dynamic-component 
            :component="'blocks.' . $block['type']" 
            :data="$block['data'] ?? []" 
        />
    @endforeach
</div>
