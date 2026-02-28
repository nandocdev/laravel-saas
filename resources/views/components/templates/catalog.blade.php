@props(['sections' => [], 'style' => [], 'config' => []])

<div class="landing-template-catalog bg-gray-50 text-gray-900">
    {{-- Marketplace / Catalog: Oriented to grid products. --}}
    @foreach ($sections as $section)
        <x-dynamic-component :component="$section['component']" :data="$section['content'] ?? []" :style="$style" />
    @endforeach
</div>
