@props(['blocks', 'logo' => null])

<div class="landing-template-corporate bg-surface text-foreground">
    @if($logo)
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex justify-between items-center">
            <img src="{{ asset('storage/' . $logo) }}" class="h-10 object-contain">
        </div>
    @endif
    {{-- Classic Corporate: Clean, formal, professional. Normal rendering. --}}
    @foreach($blocks as $block)
        <x-dynamic-component 
            :component="'blocks.' . $block['type']" 
            :data="$block['data'] ?? []" 
        />
    @endforeach
</div>
