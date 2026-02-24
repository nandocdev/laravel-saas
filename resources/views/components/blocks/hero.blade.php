@props(['data' => []])

<div class="flex-1 flex flex-col justify-center w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
    @if(isset($data['badge']))
        <div class="mb-4 inline-flex justify-center items-center gap-2 rounded-full border border-line-2 bg-surface px-4 py-1.5 text-sm text-foreground shadow-xs">
            <span class="size-2 rounded-full bg-teal-500"></span>
            {{ $data['badge'] }}
        </div>
    @endif
    
    <flux:heading size="hero" class="mb-6 mx-auto max-w-3xl">
        {{ $data['title'] ?? 'Welcome' }}
    </flux:heading>
    
    <p class="text-xl text-muted-foreground-1 mb-10 max-w-2xl mx-auto leading-relaxed">
        {{ $data['subtitle'] ?? 'Discover our services.' }}
    </p>
    
    <div class="flex flex-col sm:flex-row justify-center gap-4">
        @isset($data['cta_link'])
            <a href="{{ $data['cta_link'] }}" class="inline-flex justify-center items-center gap-x-2 text-base font-bold rounded-lg border text-primary-foreground hover:brightness-90 px-8 py-3.5 transition-all shadow-sm" style="background-color: var(--brand-primary); border-color: var(--brand-primary)">
                {{ $data['cta_text'] ?? 'Get Started' }}
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        @endisset
    </div>
</div>
