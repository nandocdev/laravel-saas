@props(['sections' => [], 'style' => [], 'config' => []])

<div class="landing-template-corporate bg-surface text-foreground">
    {{-- Classic Corporate: Clean, formal, professional. Normal rendering. --}}
    @foreach ($sections as $section)
        <x-dynamic-component :component="$section['component']" :data="$section['content'] ?? []" :style="$style" />
    @endforeach
</div>
