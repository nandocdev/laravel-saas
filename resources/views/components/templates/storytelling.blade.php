@props(['sections' => [], 'style' => [], 'config' => []])

<div class="landing-template-storytelling bg-amber-50 text-amber-950 font-serif">
    {{-- Storytelling: More human, warm colors, minimalist background. --}}
    @foreach ($sections as $section)
        <x-dynamic-component :component="$section['component']" :data="$section['content'] ?? []" :style="$style" />
    @endforeach
</div>
