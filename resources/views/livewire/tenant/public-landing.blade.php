<div class="flex-1 flex flex-col justify-center w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
    
    <div class="mb-4 inline-flex justify-center items-center gap-2 rounded-full border border-line-2 bg-surface px-4 py-1.5 text-sm text-foreground shadow-xs">
        <span class="size-2 rounded-full bg-teal-500"></span>
        We are open for business
    </div>
    
    <flux:heading size="hero" class="mb-6 mx-auto max-w-3xl">
        {{ tenant('landing_headline') ?? 'Welcome to ' . (tenant('company_name') ?? tenant('id')) }}
    </flux:heading>
    
    <p class="text-xl text-muted-foreground-1 mb-10 max-w-2xl mx-auto leading-relaxed">
        {{ tenant('landing_description') ?? 'Your tailored experience starts here. Explore our services and manage your workspace effortlessly.' }}
    </p>
    
    <div class="flex flex-col sm:flex-row justify-center gap-4">
        @auth
            <a href="{{ route('tenant.dashboard') }}" class="inline-flex justify-center items-center gap-x-2 text-base font-bold rounded-lg bg-primary border text-primary-foreground hover:bg-primary-hover px-8 py-3.5 transition-all shadow-sm">
                Go to Dashboard
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        @else
            <a href="{{ route('tenant.register') }}" class="inline-flex justify-center items-center gap-x-2 text-base font-bold rounded-lg bg-primary border text-primary-foreground hover:bg-primary-hover px-8 py-3.5 transition-all shadow-sm">
                {{ tenant('landing_cta') ?? 'Get Started for Free' }}
            </a>
            <a href="{{ route('tenant.login') }}" class="inline-flex justify-center items-center gap-x-2 text-base font-semibold rounded-lg bg-surface border border-line-2 text-foreground hover:bg-card-hover px-8 py-3.5 transition-all shadow-xs">
                Log In
            </a>
        @endauth
    </div>
</div>
