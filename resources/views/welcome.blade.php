<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="bg-background text-foreground antialiased min-h-screen flex flex-col transition-colors duration-300">

    <!-- ========== HEADER ========== -->
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full py-4 bg-navbar border-b border-navbar-line sticky top-0 z-50">
        <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8" aria-label="Global">
            <div class="flex items-center justify-between">
                <a class="flex-none font-semibold text-2xl text-foreground focus:outline-none focus:opacity-80" href="/" aria-label="SaaSFlow Brand">
                    SaaSFlow
                </a>
                <div class="sm:hidden">
                    <button type="button" class="hs-collapse-toggle relative size-9 flex justify-center items-center gap-x-2 rounded-lg bg-layer border border-layer-line text-layer-foreground shadow-2xs hover:bg-layer-hover focus:outline-none focus:bg-layer-focus disabled:opacity-50 disabled:pointer-events-none" id="navbar-collapse-with-animation" aria-controls="navbar-collapse" aria-label="Toggle navigation" data-hs-collapse="#navbar-collapse">
                        <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                        <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
            </div>
            
            <div id="navbar-collapse" class="hidden hs-collapse overflow-hidden transition-all duration-300 basis-full grow sm:block">
                <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:justify-end sm:mt-0 sm:ps-5">
                    <a class="text-sm font-medium text-primary-active focus:outline-none" href="#" aria-current="page">Home</a>
                    <a class="text-sm font-medium text-navbar-nav-foreground hover:text-primary-hover focus:outline-none focus:text-primary-focus" href="#features">Features</a>
                    <a class="text-sm font-medium text-navbar-nav-foreground hover:text-primary-hover focus:outline-none focus:text-primary-focus" href="#pricing">Pricing</a>

                    @if (Route::has('login'))
                        <div class="flex items-center gap-x-3 sm:ms-auto">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground shadow-2xs hover:bg-layer-hover focus:outline-none focus:bg-layer-focus disabled:opacity-50 disabled:pointer-events-none">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-navbar-nav-foreground hover:text-primary-hover focus:outline-none focus:text-primary-focus">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-none focus:bg-primary-hover disabled:opacity-50 disabled:pointer-events-none transition-all">
                                        Sign up
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->

    <main id="content" class="flex-grow">
        <!-- Hero Section -->
        <div class="relative overflow-hidden w-full h-full bg-background before:absolute before:top-0 before:start-1/2 before:-z-[1] before:w-[80%] before:h-[80%] before:-translate-x-1/2 before:bg-primary/5 before:rounded-full before:blur-3xl">
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
                <!-- Title -->
                <div class="max-w-3xl text-center mx-auto">
                    <h1 class="block font-bold text-foreground text-4xl sm:text-5xl md:text-6xl lg:text-7xl">
                        Build your SaaS <br />
                        <span class="text-primary tracking-tight">intelligently.</span>
                    </h1>
                </div>
                <!-- End Title -->

                <div class="mt-5 max-w-2xl text-center mx-auto">
                    <p class="text-lg text-muted-foreground-1">
                        SaaSFlow helps you build and launch your multi-tenant SAAS in days, not months. Secure, scalable and fully featured.
                    </p>
                </div>

                <!-- Buttons -->
                <div class="mt-8 gap-3 flex flex-wrap justify-center">
                    <a class="py-3 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-none focus:bg-primary-hover disabled:opacity-50 disabled:pointer-events-none transition-all" href="{{ route('register') ?? '#' }}">
                        Start building for free
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                    <a class="py-3 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground shadow-2xs hover:bg-layer-hover focus:outline-none focus:bg-layer-focus disabled:opacity-50 disabled:pointer-events-none transition-all" href="#features">
                        Explore core features
                    </a>
                </div>
                <!-- End Buttons -->
            </div>
        </div>
        <!-- End Hero Section -->

        <!-- Features -->
        <div id="features" class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-16 mx-auto bg-background-1 border-y border-line-2">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-3xl font-bold md:text-4xl text-foreground">A platform designed for growth.</h2>
                <p class="mt-3 text-muted-foreground-1">Everything you need from your database to UI architecture seamlessly integrated.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card -->
                <div class="group flex flex-col h-full bg-card border border-card-line shadow-2xs rounded-xl hover:shadow-sm transition-all p-5">
                    <div class="flex items-center justify-center size-12 rounded-lg bg-primary/10 mb-4">
                        <svg class="shrink-0 size-6 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-foreground text-lg mb-1">True Multi-Tenancy</h3>
                        <p class="text-sm text-muted-foreground-1">
                            Complete robust data isolation out of the box. Single codebase, multiple databases per individual customer domain.
                        </p>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="group flex flex-col h-full bg-card border border-card-line shadow-2xs rounded-xl hover:shadow-sm transition-all p-5">
                    <div class="flex items-center justify-center size-12 rounded-lg bg-primary/10 mb-4">
                        <svg class="shrink-0 size-6 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" x2="12" y1="22.08" y2="12"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-foreground text-lg mb-1">Central Admin Base</h3>
                        <p class="text-sm text-muted-foreground-1">
                            Manage all your tenants, billing cycles, application configurations, and active sub-accounts from a single Admin portal.
                        </p>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="group flex flex-col h-full bg-card border border-card-line shadow-2xs rounded-xl hover:shadow-sm transition-all p-5">
                    <div class="flex items-center justify-center size-12 rounded-lg bg-primary/10 mb-4">
                        <svg class="shrink-0 size-6 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-foreground text-lg mb-1">Preline UI Integrated</h3>
                        <p class="text-sm text-muted-foreground-1">
                            Utilizes semantic tokens, optimized Preline components, and Tailwind v4. Fully responsive and supports automatic dark mode.
                        </p>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Features -->

        <!-- Pricing -->
        <div id="pricing" class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-16 mx-auto bg-background">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-3xl font-bold md:text-4xl text-foreground">Flexible pricing for teams of any size</h2>
                <p class="mt-3 text-muted-foreground-1">Simple, transparent, and scalable. No hidden fees.</p>
            </div>
            
            <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:items-center">
                
                <!-- Card -->
                <div class="flex flex-col bg-card border border-card-line text-center rounded-xl p-8 shadow-2xs">
                    <h4 class="font-medium text-lg text-foreground">Starter</h4>
                    <span class="mt-5 font-bold text-5xl text-foreground">
                        Free
                    </span>
                    <p class="mt-2 text-sm text-muted-foreground-1">Perfect for trying out SaaSFlow.</p>

                    <ul class="mt-7 space-y-3 text-sm flex-grow">
                        <li class="flex items-center gap-x-3 text-foreground">
                            <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            1 Admin user
                        </li>
                        <li class="flex items-center gap-x-3 text-foreground">
                            <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Shared resources
                        </li>
                    </ul>

                    <a class="mt-8 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-surface border border-transparent text-surface-foreground hover:bg-surface-hover focus:outline-none focus:bg-surface-hover disabled:opacity-50 disabled:pointer-events-none transition-all" href="#">
                        Get started Free
                    </a>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="flex flex-col bg-primary border-2 border-primary-line text-center shadow-sm rounded-xl p-8 transform lg:-translate-y-2">
                    <p class="mb-3">
                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-semibold bg-white text-primary uppercase tracking-wide">
                            Most popular
                        </span>
                    </p>
                    <h4 class="font-medium text-lg text-primary-foreground">Growth</h4>
                    <span class="mt-5 font-bold text-5xl text-primary-foreground">
                        $49
                    </span>
                    <p class="mt-2 text-sm text-primary-200">Per month, billed annually.</p>

                    <ul class="mt-7 space-y-3 text-sm flex-grow">
                        <li class="flex items-center gap-x-3 text-primary-foreground">
                            <svg class="shrink-0 size-4 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Up to 10 users
                        </li>
                        <li class="flex items-center gap-x-3 text-primary-foreground">
                            <svg class="shrink-0 size-4 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Dedicated database
                        </li>
                        <li class="flex items-center gap-x-3 text-primary-foreground">
                            <svg class="shrink-0 size-4 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Advanced integrations
                        </li>
                    </ul>

                    <a class="mt-8 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-lg bg-white border border-transparent text-primary hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none transition-all shadow-sm" href="#">
                        Start 14-day trial
                    </a>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="flex flex-col bg-card border border-card-line text-center rounded-xl p-8 shadow-2xs">
                    <h4 class="font-medium text-lg text-foreground">Enterprise</h4>
                    <span class="mt-5 font-bold text-5xl text-foreground">
                        $149
                    </span>
                    <p class="mt-2 text-sm text-muted-foreground-1">For mission-critical deployments.</p>

                    <ul class="mt-7 space-y-3 text-sm flex-grow">
                        <li class="flex items-center gap-x-3 text-foreground">
                            <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Unlimited users
                        </li>
                        <li class="flex items-center gap-x-3 text-foreground">
                            <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            24/7 Priority Support
                        </li>
                        <li class="flex items-center gap-x-3 text-foreground">
                            <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Custom domains & SSO
                        </li>
                    </ul>

                    <a class="mt-8 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-surface border border-transparent text-surface-foreground hover:bg-surface-hover focus:outline-none focus:bg-surface-hover disabled:opacity-50 disabled:pointer-events-none transition-all" href="#">
                        Contact Sales
                    </a>
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Pricing -->
    </main>

    <!-- ========== FOOTER ========== -->
    <footer class="mt-auto w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto border-t border-line-2 bg-footer">
        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-5 text-center md:text-start">
            <div>
                <a class="flex-none text-xl font-semibold text-foreground focus:outline-none focus:opacity-80" href="#" aria-label="Brand">SaaSFlow</a>
            </div>
            
            <div class="md:mx-auto">
                <p class="text-sm text-muted-foreground-1">
                    © {{ date('Y') }} SaaSFlow. Built with Preline UI.
                </p>
            </div>

            <div class="md:text-end space-x-2">
                <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full bg-layer border border-transparent text-muted-foreground-1 hover:bg-layer-hover focus:outline-none focus:bg-layer-focus disabled:opacity-50 disabled:pointer-events-none" href="#">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                </a>
                <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full bg-layer border border-transparent text-muted-foreground-1 hover:bg-layer-hover focus:outline-none focus:bg-layer-focus disabled:opacity-50 disabled:pointer-events-none" href="#">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                    </svg>
                </a>
            </div>
        </div>
    </footer>
    <!-- ========== END FOOTER ========== -->
    @livewireScripts
</body>
</html>
