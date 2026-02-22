<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="bg-background text-foreground antialiased min-h-screen flex flex-col">

    <!-- ========== HEADER ========== -->
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full py-4 bg-navbar border-b border-navbar-line sticky top-0 z-50 backdrop-blur-md">
        <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8" aria-label="Global">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a class="flex items-center gap-2 font-bold text-xl text-foreground focus:outline-hidden focus:opacity-80" href="/" aria-label="SaaSFlow Brand">
                    <span class="size-7 rounded-lg bg-primary flex items-center justify-center shadow-sm">
                        <svg class="size-4 text-primary-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </span>
                    SaaSFlow
                </a>
                <!-- Mobile toggle (Preline hs-collapse) -->
                <div class="sm:hidden">
                    <button type="button" class="hs-collapse-toggle relative size-9 flex justify-center items-center gap-x-2 rounded-lg bg-layer border border-layer-line text-layer-foreground shadow-2xs hover:bg-layer-hover focus:outline-hidden focus:bg-layer-focus disabled:opacity-50 disabled:pointer-events-none" id="hs-navbar-collapse" aria-expanded="false" aria-controls="hs-navbar" aria-label="Toggle navigation" data-hs-collapse="#hs-navbar">
                        <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                        <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
            </div>

            <div id="hs-navbar" class="hidden hs-collapse overflow-hidden transition-all duration-300 basis-full grow sm:block" aria-labelledby="hs-navbar-collapse">
                <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:justify-end sm:mt-0 sm:ps-5">
                    <a class="text-sm font-semibold text-primary-active" href="#" aria-current="page">Home</a>
                    <a class="text-sm font-medium text-navbar-nav-foreground hover:text-primary-hover focus:outline-hidden focus:text-primary-focus transition-colors" href="#features">Features</a>
                    <a class="text-sm font-medium text-navbar-nav-foreground hover:text-primary-hover focus:outline-hidden focus:text-primary-focus transition-colors" href="#pricing">Pricing</a>

                    <div class="flex items-center gap-x-3 sm:ms-3 sm:ps-3 sm:border-s sm:border-navbar-line">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-layer border border-layer-line text-layer-foreground shadow-2xs hover:bg-layer-hover focus:outline-hidden focus:bg-layer-focus disabled:opacity-50 disabled:pointer-events-none transition-all">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-navbar-nav-foreground hover:text-primary-hover focus:outline-hidden focus:text-primary-focus transition-colors">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="py-2 px-4 inline-flex items-center gap-x-1.5 text-sm font-semibold rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus disabled:opacity-50 disabled:pointer-events-none transition-all shadow-sm">
                                        Sign up
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->

    <main id="content" class="flex-grow">

        <!-- ===== HERO ===== -->
        <section class="relative overflow-hidden bg-background hero-grid-bg">
            <!-- Background blobs -->
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[500px] bg-primary/8 rounded-full blur-3xl"></div>
                <div class="absolute top-20 right-0 w-[350px] h-[350px] bg-cyan-500/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-violet-500/5 rounded-full blur-3xl"></div>
            </div>

            <div class="relative max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-20 text-center">
                <!-- Badge -->
                <div class="hero-animate mb-6 inline-flex items-center gap-2 py-1.5 px-4 rounded-full border border-primary/20 bg-primary/5 text-xs font-semibold text-primary tracking-wide uppercase">
                    <span class="size-1.5 rounded-full bg-primary animate-pulse"></span>
                    Now in Public Beta
                </div>

                <!-- Title -->
                <h1 class="hero-animate hero-animate-delay-1 block font-extrabold text-foreground text-5xl sm:text-6xl md:text-7xl lg:text-8xl leading-[1.05] tracking-tight">
                    Build your SaaS
                    <br />
                    <span class="text-gradient-primary">intelligently.</span>
                </h1>

                <p class="hero-animate hero-animate-delay-2 mt-6 max-w-2xl mx-auto text-lg sm:text-xl text-muted-foreground-1 leading-relaxed">
                    SaaSFlow helps you build and launch your multi-tenant SaaS in days, not months.
                    Secure, scalable and fully featured — from database to UI.
                </p>

                <!-- CTA Buttons -->
                <div class="hero-animate hero-animate-delay-3 mt-10 flex flex-wrap justify-center gap-3">
                    <a href="{{ Route::has('register') ? route('register') : '#' }}" class="group py-3.5 px-7 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus transition-all shadow-lg shadow-primary/25">
                        Start building for free
                        <svg class="shrink-0 size-4 transition-transform group-hover:translate-x-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                    <a href="#features" class="py-3.5 px-7 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl bg-layer border border-layer-line text-layer-foreground shadow-2xs hover:bg-layer-hover focus:outline-hidden focus:bg-layer-focus transition-all">
                        Explore core features
                    </a>
                </div>

                <!-- Social proof -->
                <div class="mt-10 flex flex-wrap items-center justify-center gap-6 text-xs text-muted-foreground-1">
                    <span class="flex items-center gap-1.5">
                        <svg class="size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        No credit card required
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Deploy in under 5 minutes
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Cancel anytime
                    </span>
                </div>
            </div>
        </section>
        <!-- End Hero -->

        <!-- ===== FEATURES ===== -->
        <section id="features" class="bg-background-1 border-y border-line-2">
            <div class="max-w-[85rem] px-4 py-16 sm:px-6 lg:px-8 lg:py-24 mx-auto">

                <div class="max-w-2xl mx-auto text-center mb-12 lg:mb-16">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block">Platform</span>
                    <h2 class="text-3xl font-extrabold md:text-4xl text-foreground tracking-tight">A platform designed for growth.</h2>
                    <p class="mt-3 text-muted-foreground-1 text-lg">Everything you need — from database to UI architecture, seamlessly integrated.</p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Feature Card 1 -->
                    <div class="group flex flex-col h-full bg-card border border-card-line shadow-2xs rounded-2xl p-6 hover:shadow-sm transition-all">
                        <div class="flex items-center justify-center size-12 rounded-xl bg-primary/10 mb-5 ring-1 ring-primary/15">
                            <svg class="shrink-0 size-6 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                        </div>
                        <h3 class="font-bold text-foreground text-lg mb-2">True Multi-Tenancy</h3>
                        <p class="text-sm text-muted-foreground-1 leading-relaxed">
                            Complete robust data isolation out of the box. Single codebase, multiple databases per individual customer domain.
                        </p>
                        <div class="mt-auto pt-5 border-t border-card-line mt-5">
                            <a href="#" class="text-xs font-semibold text-primary inline-flex items-center gap-1 hover:gap-2 transition-all">
                                Learn more <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Feature Card 2 -->
                    <div class="group flex flex-col h-full bg-card border border-card-line shadow-2xs rounded-2xl p-6 hover:shadow-sm transition-all">
                        <div class="flex items-center justify-center size-12 rounded-xl bg-primary/10 mb-5 ring-1 ring-primary/15">
                            <svg class="shrink-0 size-6 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" x2="12" y1="22.08" y2="12"/></svg>
                        </div>
                        <h3 class="font-bold text-foreground text-lg mb-2">Central Admin Base</h3>
                        <p class="text-sm text-muted-foreground-1 leading-relaxed">
                            Manage all your tenants, billing cycles, configurations, and sub-accounts from a single unified Admin portal.
                        </p>
                        <div class="mt-auto pt-5 border-t border-card-line mt-5">
                            <a href="#" class="text-xs font-semibold text-primary inline-flex items-center gap-1 hover:gap-2 transition-all">
                                Learn more <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Feature Card 3 -->
                    <div class="group flex flex-col h-full bg-card border border-card-line shadow-2xs rounded-2xl p-6 hover:shadow-sm transition-all">
                        <div class="flex items-center justify-center size-12 rounded-xl bg-primary/10 mb-5 ring-1 ring-primary/15">
                            <svg class="shrink-0 size-6 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        </div>
                        <h3 class="font-bold text-foreground text-lg mb-2">Preline UI Integrated</h3>
                        <p class="text-sm text-muted-foreground-1 leading-relaxed">
                            Semantic tokens, optimized Preline components, and Tailwind v4. Fully responsive with automatic dark mode support.
                        </p>
                        <div class="mt-auto pt-5 border-t border-card-line mt-5">
                            <a href="#" class="text-xs font-semibold text-primary inline-flex items-center gap-1 hover:gap-2 transition-all">
                                Learn more <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Feature Card 4 -->
                    <div class="group flex flex-col h-full bg-card border border-card-line shadow-2xs rounded-2xl p-6 hover:shadow-sm transition-all">
                        <div class="flex items-center justify-center size-12 rounded-xl bg-primary/10 mb-5 ring-1 ring-primary/15">
                            <svg class="shrink-0 size-6 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                        </div>
                        <h3 class="font-bold text-foreground text-lg mb-2">Billing & Subscriptions</h3>
                        <p class="text-sm text-muted-foreground-1 leading-relaxed">
                            Stripe integration baked in. Manage plans, trials, invoices, and payment methods without writing boilerplate.
                        </p>
                        <div class="mt-auto pt-5 border-t border-card-line mt-5">
                            <a href="#" class="text-xs font-semibold text-primary inline-flex items-center gap-1 hover:gap-2 transition-all">
                                Learn more <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Feature Card 5 -->
                    <div class="group flex flex-col h-full bg-card border border-card-line shadow-2xs rounded-2xl p-6 hover:shadow-sm transition-all">
                        <div class="flex items-center justify-center size-12 rounded-xl bg-primary/10 mb-5 ring-1 ring-primary/15">
                            <svg class="shrink-0 size-6 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/><circle cx="12" cy="12" r="4"/></svg>
                        </div>
                        <h3 class="font-bold text-foreground text-lg mb-2">Livewire + Alpine</h3>
                        <p class="text-sm text-muted-foreground-1 leading-relaxed">
                            Real-time reactive components without leaving the PHP ecosystem. Full Livewire v3 and Alpine.js integration ready.
                        </p>
                        <div class="mt-auto pt-5 border-t border-card-line mt-5">
                            <a href="#" class="text-xs font-semibold text-primary inline-flex items-center gap-1 hover:gap-2 transition-all">
                                Learn more <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Feature Card 6 -->
                    <div class="group flex flex-col h-full bg-card border border-card-line shadow-2xs rounded-2xl p-6 hover:shadow-sm transition-all">
                        <div class="flex items-center justify-center size-12 rounded-xl bg-primary/10 mb-5 ring-1 ring-primary/15">
                            <svg class="shrink-0 size-6 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <h3 class="font-bold text-foreground text-lg mb-2">Roles & Permissions</h3>
                        <p class="text-sm text-muted-foreground-1 leading-relaxed">
                            Spatie Permissions integrated per tenant. Define roles, policies, and gates at both the central and tenant level.
                        </p>
                        <div class="mt-auto pt-5 border-t border-card-line mt-5">
                            <a href="#" class="text-xs font-semibold text-primary inline-flex items-center gap-1 hover:gap-2 transition-all">
                                Learn more <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Features -->

        <!-- ===== PRICING ===== -->
        <section id="pricing" class="bg-background">
            <div class="max-w-[85rem] px-4 py-16 sm:px-6 lg:px-8 lg:py-24 mx-auto">

                <div class="max-w-2xl mx-auto text-center mb-12">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block">Pricing</span>
                    <h2 class="text-3xl font-extrabold md:text-4xl text-foreground tracking-tight">Flexible pricing for teams of any size</h2>
                    <p class="mt-3 text-muted-foreground-1 text-lg">Simple, transparent, and scalable. No hidden fees.</p>
                </div>

                <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:items-center">

                    <!-- Starter -->
                    <div class="flex flex-col bg-card border border-card-line text-center rounded-2xl p-8 shadow-2xs">
                        <div class="mb-4">
                            <span class="text-xs font-bold uppercase tracking-widest text-muted-foreground-1">Starter</span>
                        </div>
                        <div class="flex items-end justify-center gap-1">
                            <span class="font-extrabold text-5xl text-foreground">Free</span>
                        </div>
                        <p class="mt-2 text-sm text-muted-foreground-1">Perfect for trying out SaaSFlow.</p>

                        <ul class="mt-8 space-y-3 text-sm text-left flex-grow">
                            <li class="flex items-center gap-x-3 text-foreground">
                                <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                1 Admin user
                            </li>
                            <li class="flex items-center gap-x-3 text-foreground">
                                <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                Up to 3 tenants
                            </li>
                            <li class="flex items-center gap-x-3 text-foreground">
                                <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                Shared resources
                            </li>
                            <li class="flex items-center gap-x-3 text-muted-foreground-1">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                                Advanced integrations
                            </li>
                        </ul>

                        <a class="mt-8 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl bg-surface border border-transparent text-surface-foreground hover:bg-surface-hover focus:outline-hidden focus:bg-surface-hover disabled:opacity-50 disabled:pointer-events-none transition-all" href="#">
                            Get started Free
                        </a>
                    </div>

                    <!-- Growth — FEATURED -->
                    <div class="relative flex flex-col bg-primary border-2 border-primary-line text-center rounded-2xl p-8 shadow-sm lg:-translate-y-3">
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2">
                            <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-white text-primary uppercase tracking-wide shadow-sm">
                                ✦ Most popular
                            </span>
                        </div>
                        <div class="mb-4">
                            <span class="text-xs font-bold uppercase tracking-widest text-primary-200">Growth</span>
                        </div>
                        <div class="flex items-end justify-center gap-1">
                            <span class="text-2xl font-bold text-primary-foreground mt-1">$</span>
                            <span class="font-extrabold text-5xl text-primary-foreground">49</span>
                            <span class="text-sm text-primary-200 mb-1.5">/mo</span>
                        </div>
                        <p class="mt-2 text-sm text-primary-200">Billed annually. Save 20%.</p>

                        <ul class="mt-8 space-y-3 text-sm text-left flex-grow">
                            <li class="flex items-center gap-x-3 text-primary-foreground">
                                <svg class="shrink-0 size-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                Up to 10 users
                            </li>
                            <li class="flex items-center gap-x-3 text-primary-foreground">
                                <svg class="shrink-0 size-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                Dedicated database
                            </li>
                            <li class="flex items-center gap-x-3 text-primary-foreground">
                                <svg class="shrink-0 size-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                Advanced integrations
                            </li>
                            <li class="flex items-center gap-x-3 text-primary-foreground">
                                <svg class="shrink-0 size-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                Priority support
                            </li>
                        </ul>

                        <a class="mt-8 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-xl bg-white border border-transparent text-primary hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none transition-all shadow-md" href="#">
                            Start 14-day trial
                        </a>
                    </div>

                    <!-- Enterprise -->
                    <div class="flex flex-col bg-card border border-card-line text-center rounded-2xl p-8 shadow-2xs">
                        <div class="mb-4">
                            <span class="text-xs font-bold uppercase tracking-widest text-muted-foreground-1">Enterprise</span>
                        </div>
                        <div class="flex items-end justify-center gap-1">
                            <span class="text-2xl font-bold text-foreground mt-1">$</span>
                            <span class="font-extrabold text-5xl text-foreground">149</span>
                            <span class="text-sm text-muted-foreground-1 mb-1.5">/mo</span>
                        </div>
                        <p class="mt-2 text-sm text-muted-foreground-1">For mission-critical deployments.</p>

                        <ul class="mt-8 space-y-3 text-sm text-left flex-grow">
                            <li class="flex items-center gap-x-3 text-foreground">
                                <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                Unlimited users
                            </li>
                            <li class="flex items-center gap-x-3 text-foreground">
                                <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                24/7 Priority Support
                            </li>
                            <li class="flex items-center gap-x-3 text-foreground">
                                <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                Custom domains & SSO
                            </li>
                            <li class="flex items-center gap-x-3 text-foreground">
                                <svg class="shrink-0 size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                SLA + dedicated infra
                            </li>
                        </ul>

                        <a class="mt-8 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl bg-surface border border-transparent text-surface-foreground hover:bg-surface-hover focus:outline-hidden focus:bg-surface-hover disabled:opacity-50 disabled:pointer-events-none transition-all" href="#">
                            Contact Sales
                        </a>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Pricing -->

        <!-- ===== CTA FINAL ===== -->
        <section class="bg-background-1 border-t border-line-2">
            <div class="max-w-[85rem] px-4 py-16 sm:px-6 lg:px-8 mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-foreground tracking-tight">Ready to ship your SaaS?</h2>
                <p class="mt-3 text-muted-foreground-1">Join hundreds of developers already building with SaaSFlow.</p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ Route::has('register') ? route('register') : '#' }}" class="py-3.5 px-7 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus transition-all shadow-lg shadow-primary/20">
                        Get started for free →
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- ========== FOOTER ========== -->
    <footer class="mt-auto w-full bg-footer border-t border-footer-line">
        <div class="max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-5 text-center md:text-start">
                <div>
                    <a class="flex items-center gap-2 text-lg font-bold text-foreground focus:outline-hidden focus:opacity-80" href="#" aria-label="Brand">
                        <span class="size-6 rounded-md bg-primary flex items-center justify-center">
                            <svg class="size-3.5 text-primary-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                        </span>
                        SaaSFlow
                    </a>
                    <p class="mt-1 text-xs text-muted-foreground-1">Built with Laravel + Preline UI</p>
                </div>

                <div class="md:mx-auto">
                    <p class="text-sm text-muted-foreground-1">
                        © {{ date('Y') }} SaaSFlow. All rights reserved.
                    </p>
                </div>

                <div class="flex justify-center md:justify-end gap-2">
                    <a class="size-9 inline-flex justify-center items-center rounded-lg bg-layer border border-layer-line text-muted-foreground-1 hover:bg-layer-hover hover:text-foreground focus:outline-hidden focus:bg-layer-focus transition-colors" href="#">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
                    </a>
                    <a class="size-9 inline-flex justify-center items-center rounded-lg bg-layer border border-layer-line text-muted-foreground-1 hover:bg-layer-hover hover:text-foreground focus:outline-hidden focus:bg-layer-focus transition-colors" href="#">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/></svg>
                    </a>
                    <a class="size-9 inline-flex justify-center items-center rounded-lg bg-layer border border-layer-line text-muted-foreground-1 hover:bg-layer-hover hover:text-foreground focus:outline-hidden focus:bg-layer-focus transition-colors" href="#">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0 1 12 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!-- ========== END FOOTER ========== -->

    @livewireScripts
</body>
</html>
