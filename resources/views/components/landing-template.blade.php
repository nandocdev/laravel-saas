@php
    $templateName = $config['template'] ?? 'corporate';
    $colors = $config['colors'] ?? [
        'primary' => '#3b82f6',
        'neutral' => '#6b7280',
        'accent' => '#ec4899',
    ];
    $logo = $config['logo'] ?? null;
@endphp

<div class="landing-template-wrapper w-full" style="
    --brand-primary: {{ $colors['primary'] }};
    --brand-neutral: {{ $colors['neutral'] }};
    --brand-accent: {{ $colors['accent'] }};
">
    <x-dynamic-component 
        :component="'templates.' . $templateName" 
        :blocks="$blocks"
        :logo="$logo"
    />
</div>