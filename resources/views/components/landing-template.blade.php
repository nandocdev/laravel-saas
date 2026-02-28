@php
    $primary = $style['primary'] ?? '#644FB5';
    $neutral = $style['neutral'] ?? '#F8FAFC';
    $accent = $style['accent'] ?? '#F5A623';
    $font = $style['font'] ?? 'Roboto';
    $logo = data_get($config, 'assets.logo');
@endphp

<div class="landing-template-wrapper w-full"
    style="
    --brand-primary: {{ $primary }};
    --brand-neutral: {{ $neutral }};
    --brand-accent: {{ $accent }};
    font-family: {{ $font }}, sans-serif;
">
    @if ($logo)
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex justify-between items-center">
            <img src="{{ asset('storage/' . $logo) }}" class="h-10 object-contain" alt="Company logo">
        </div>
    @endif

    <x-dynamic-component :component="$templateView" :sections="$sections" :style="$style" :config="$config" />
</div>
