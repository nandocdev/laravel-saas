@props(['sections' => [], 'style' => [], 'config' => []])

<div class="landing-template-onepage max-w-3xl mx-auto border-x border-line-2 shadow-sm bg-surface">
    {{-- One Page Minimal: Ultra simple, constrained width. --}}
    @foreach ($sections as $section)
        <x-dynamic-component :component="$section['component']" :data="$section['content'] ?? []" :style="$style" />
    @endforeach
</div>
