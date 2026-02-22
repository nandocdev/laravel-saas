<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="bg-white text-gray-800 dark:bg-neutral-900 dark:text-neutral-200 antialiased min-h-screen flex flex-col">

    <!-- ========== HEADER ========== -->
    <header class="flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full py-5 sticky top-0 bg-white/80 dark:bg-neutral-900/80 backdrop-blur-md border-b border-gray-200 dark:border-neutral-800 transition-all duration-300">
        <nav class="relative max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8" aria-label="Global">
            <div class="flex items-center justify-between">
                <a class="flex-none text-2xl font-bold dark:text-white" href="/" aria-label="Brand">
                    SaaSFlow
                </a>
                <div class="sm:hidden">
                    <button type="button" class="hs-collapse-toggle size-9 flex justify-center items-center text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-neutral-700 dark:hover:bg-neutral-700" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
            </div>
            <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
                <div class="flex flex-col gap-y-4 gap-x-0 mt-5 sm:flex-row sm:items-center sm:justify-end sm:gap-y-0 sm:gap-x-7 sm:mt-0 sm:ps-7">
                    <a class="font-medium text-blue-600 sm:py-6 dark:text-blue-500" href="#" aria-current="page">Home</a>
                    <a class="font-medium text-gray-500 hover:text-gray-400 sm:py-6 dark:text-neutral-400 dark:hover:text-neutral-500" href="#features">Features</a>
                    <a class="font-medium text-gray-500 hover:text-gray-400 sm:py-6 dark:text-neutral-400 dark:hover:text-neutral-500" href="#pricing">Pricing</a>

                    @if (Route::has('login'))
                        <div class="flex items-center gap-x-2 sm:ms-auto">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="flex items-center gap-x-2 font-medium text-gray-500 hover:text-blue-600 sm:border-s sm:border-gray-300 sm:my-6 sm:ps-6 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-blue-500">
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
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
        <div class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:size-full before:-z-[1] before:transform before:-translate-x-1/2">
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
                <div class="mt-5 max-w-2xl text-center mx-auto">
                    <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-neutral-200">
                        Build your product <span class="bg-clip-text bg-gradient-to-tl from-blue-600 to-violet-600 text-transparent">faster</span>
                    </h1>
                </div>
                <div class="mt-5 max-w-3xl text-center mx-auto">
                    <p class="text-lg text-gray-600 dark:text-neutral-400">
                        Launch your SaaS application in minutes, not months. The perfect foundation for your next big idea, built with modern architecture.
                    </p>
                </div>
                <!-- Buttons -->
                <div class="mt-8 gap-3 flex justify-center">
                    <a class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-tl from-blue-600 to-violet-600 hover:from-violet-600 hover:to-blue-600 border border-transparent text-white text-sm font-medium rounded-md focus:outline-none focus:ring-1 focus:ring-gray-600 py-3 px-4 dark:focus:ring-offset-gray-800" href="{{ route('register') ?? '#' }}">
                        Get started
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                    <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800" href="#features">
                        Explore Features
                    </a>
                </div>
                <!-- End Buttons -->
            </div>
        </div>
        <!-- End Hero Section -->

        <!-- Features -->
        <div id="features" class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Why choose us?</h2>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">We provide all the tools you need to build and scale your business securely.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Icon Block -->
                <div class="w-full h-full bg-white shadow-lg rounded-lg p-5 dark:bg-neutral-900">
                    <div class="flex items-center gap-x-4 mb-3">
                        <div class="inline-flex justify-center items-center size-[62px] rounded-full border-4 border-blue-50 bg-blue-100 dark:border-blue-900 dark:bg-blue-800">
                            <svg class="flex-shrink-0 size-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                        </div>
                        <div class="flex-shrink-0">
                            <h3 class="block text-lg font-semibold text-gray-800 dark:text-white">Multi-Tenant Isolated</h3>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-neutral-400">Keep your customers' data isolated and secure through robust database-per-tenant architecture.</p>
                </div>
                <!-- End Icon Block -->

                <!-- Icon Block -->
                <div class="w-full h-full bg-white shadow-lg rounded-lg p-5 dark:bg-neutral-900">
                    <div class="flex items-center gap-x-4 mb-3">
                        <div class="inline-flex justify-center items-center size-[62px] rounded-full border-4 border-blue-50 bg-blue-100 dark:border-blue-900 dark:bg-blue-800">
                            <svg class="flex-shrink-0 size-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" x2="12" y1="22.08" y2="12"/></svg>
                        </div>
                        <div class="flex-shrink-0">
                            <h3 class="block text-lg font-semibold text-gray-800 dark:text-white">Central Admin Panel</h3>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-neutral-400">Control your platform, manage customers, modify subscriptions, and inspect the core effortlessly.</p>
                </div>
                <!-- End Icon Block -->

                <!-- Icon Block -->
                <div class="w-full h-full bg-white shadow-lg rounded-lg p-5 dark:bg-neutral-900">
                    <div class="flex items-center gap-x-4 mb-3">
                        <div class="inline-flex justify-center items-center size-[62px] rounded-full border-4 border-blue-50 bg-blue-100 dark:border-blue-900 dark:bg-blue-800">
                            <svg class="flex-shrink-0 size-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        </div>
                        <div class="flex-shrink-0">
                            <h3 class="block text-lg font-semibold text-gray-800 dark:text-white">API Ready & Modern UI</h3>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-neutral-400">Designed with modern aesthetics utilizing Tailwind CSS & Preline. Pre-integrated with Laravel Livewire tools.</p>
                </div>
                <!-- End Icon Block -->
            </div>
        </div>
        <!-- End Features -->

        <!-- Pricing -->
        <div id="pricing" class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Simple, transparent pricing</h2>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">Whatever your status, our offers evolve according to your needs.</p>
            </div>
            
            <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:items-center">
                <!-- Card -->
                <div class="flex flex-col border border-gray-200 text-center rounded-xl p-8 dark:border-neutral-700">
                    <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">Basic</h4>
                    <span class="mt-7 font-bold text-5xl text-gray-800 dark:text-neutral-200">
                        Free
                    </span>
                    <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">Startup forever.</p>

                    <ul class="mt-7 space-y-2.5 text-sm">
                        <li class="flex space-x-2">
                            <svg class="flex-shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            <span class="text-gray-800 dark:text-neutral-400">1 User Dashboard</span>
                        </li>
                        <li class="flex space-x-2">
                            <svg class="flex-shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            <span class="text-gray-800 dark:text-neutral-400">Basic Features</span>
                        </li>
                    </ul>

                    <a class="mt-8 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-blue-900 dark:text-blue-400" href="#">
                        Sign up
                    </a>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="flex flex-col border-2 border-blue-600 text-center shadow-xl rounded-xl p-8 dark:border-blue-700">
                    <p class="mb-3"><span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-xs uppercase font-semibold bg-blue-100 text-blue-800 dark:bg-blue-600 dark:text-white">Most popular</span></p>
                    <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">Growth</h4>
                    <span class="mt-5 font-bold text-5xl text-gray-800 dark:text-neutral-200">
                        <span class="font-bold text-2xl -me-2">$</span>
                        49
                    </span>
                    <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">Per month.</p>

                    <ul class="mt-7 space-y-2.5 text-sm">
                        <li class="flex space-x-2">
                            <svg class="flex-shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            <span class="text-gray-800 dark:text-neutral-400">Up to 10 users</span>
                        </li>
                        <li class="flex space-x-2">
                            <svg class="flex-shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            <span class="text-gray-800 dark:text-neutral-400">Admins Access</span>
                        </li>
                        <li class="flex space-x-2">
                            <svg class="flex-shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            <span class="text-gray-800 dark:text-neutral-400">Advanced Analytics</span>
                        </li>
                    </ul>

                    <a class="mt-8 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                        Sign up
                    </a>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="flex flex-col border border-gray-200 text-center rounded-xl p-8 dark:border-neutral-700">
                    <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">Enterprise</h4>
                    <span class="mt-7 font-bold text-5xl text-gray-800 dark:text-neutral-200">
                        <span class="font-bold text-2xl -me-2">$</span>
                        149
                    </span>
                    <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">For large scale production.</p>

                    <ul class="mt-7 space-y-2.5 text-sm">
                        <li class="flex space-x-2">
                            <svg class="flex-shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            <span class="text-gray-800 dark:text-neutral-400">Unlimited users</span>
                        </li>
                        <li class="flex space-x-2">
                            <svg class="flex-shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            <span class="text-gray-800 dark:text-neutral-400">Custom Deployment</span>
                        </li>
                        <li class="flex space-x-2">
                            <svg class="flex-shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            <span class="text-gray-800 dark:text-neutral-400">24/7 Support</span>
                        </li>
                    </ul>

                    <a class="mt-8 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-blue-900 dark:text-blue-400" href="#">
                        Contact sales
                    </a>
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Pricing -->
    </main>

    <!-- ========== FOOTER ========== -->
    <footer class="mt-auto w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto border-t border-gray-200 dark:border-neutral-700">
        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-5 text-center md:text-start">
            <div>
                <a class="flex-none text-xl font-semibold text-gray-900 dark:text-white" href="#" aria-label="Brand">SaaSFlow</a>
            </div>
            
            <div class="md:mx-auto">
                <p class="text-gray-500 dark:text-neutral-400 text-sm">
                    © {{ date('Y') }} SaaSFlow. All rights reserved.
                </p>
            </div>

            <div class="md:text-end space-x-2">
                <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-100 disabled:opacity-50 dark:text-neutral-400 dark:hover:bg-neutral-800" href="#">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                </a>
                <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-100 disabled:opacity-50 dark:text-neutral-400 dark:hover:bg-neutral-800" href="#">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
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
