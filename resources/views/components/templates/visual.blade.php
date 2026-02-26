@props(['sections' => [], 'style' => [], 'config' => []])

<div class="landing-template-visual bg-zinc-950 text-white selection:bg-teal-500/30">
    {{-- Visual: High contrast, dark mode, immersive. --}}
    @foreach ($sections as $section)
        <div class="visual-block-wrapper">
            <x-dynamic-component :component="$section['component']" :data="$section['content'] ?? []" :style="$style" />
        </div>
    @endforeach
</div>
