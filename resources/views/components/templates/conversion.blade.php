@props(['sections' => [], 'style' => [], 'config' => []])

<div class="landing-template-conversion bg-slate-50 text-slate-900 border-t-4 border-red-500">
    {{-- Direct Conversion: Less storytelling, more action. High urgency colors. --}}
    @foreach ($sections as $section)
        <x-dynamic-component :component="$section['component']" :data="$section['content'] ?? []" :style="$style" />
    @endforeach
</div>
