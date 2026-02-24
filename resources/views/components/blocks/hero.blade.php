@props(['data' => []])

<div class="relative overflow-hidden bg-surface py-24 sm:py-32">
    <!-- Background grid from app.css -->
    <div class="absolute inset-0 hero-grid-bg opacity-30 [mask-image:radial-gradient(ellipse_at_center,black,transparent_75%)]"></div>

    <div class="relative z-10 flex flex-col justify-center w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        @if(isset($data['badge']))
            <div class="mb-6 inline-flex justify-center items-center gap-2 rounded-full border border-line-2 bg-surface px-4 py-1.5 text-sm text-foreground shadow-xs hero-animate">
                <span class="size-2 rounded-full bg-teal-500 animate-pulse"></span>
                {{ $data['badge'] }}
            </div>
        @endif
        
        <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-foreground mb-8 mx-auto max-w-4xl hero-animate hero-animate-delay-1">
            @php
                $title = $data['title'] ?? 'Welcome';
                $words = explode(' ', $title);
                $lastTwo = array_slice($words, -2);
                $initialResult = array_slice($words, 0, -2);
                $mainText = implode(' ', $initialResult);
                $highlightText = implode(' ', $lastTwo);
            @endphp
            
            {{ $mainText }} <span class="text-gradient-primary" style="--primary: var(--brand-primary)">{{ $highlightText }}</span>
        </h1>
        
        <p class="text-xl text-muted-foreground-1 mb-10 max-w-2xl mx-auto leading-relaxed hero-animate hero-animate-delay-2">
            {{ $data['subtitle'] ?? 'Discover our services.' }}
        </p>
        
        <div class="flex flex-col sm:flex-row justify-center gap-4 hero-animate hero-animate-delay-3">
            @isset($data['cta_link'])
                <a href="{{ $data['cta_link'] }}" class="inline-flex justify-center items-center gap-x-3 text-base font-bold rounded-xl border text-primary-foreground hover:brightness-105 hover:scale-[1.02] active:scale-[0.98] px-8 py-4 transition-all shadow-lg shadow-primary/20" style="background-color: var(--brand-primary); border-color: var(--brand-primary)">
                    {{ $data['cta_text'] ?? 'Get Started' }}
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            @endisset
            
            <a href="#services" class="inline-flex justify-center items-center gap-x-3 text-base font-semibold rounded-xl border border-line-2 bg-surface text-foreground hover:bg-surface-1 px-8 py-4 transition-all">
                Learn More
            </a>
        </div>
    </div>
</div>

