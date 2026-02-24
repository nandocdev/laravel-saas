<div class="landing-template-wrapper w-full">
    @php
        $templateName = $config['template'] ?? 'corporate';
    @endphp
    
    <x-dynamic-component 
        :component="'templates.' . $templateName" 
        :blocks="$blocks" 
    />
</div>