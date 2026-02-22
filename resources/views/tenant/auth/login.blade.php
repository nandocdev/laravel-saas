<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="bg-background text-foreground antialiased min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-sm">
        <!-- Logo -->
        <div class="text-center mb-8">
            <span class="inline-flex items-center gap-2 text-2xl font-bold text-foreground">
                <span class="size-8 rounded-lg bg-primary flex items-center justify-center">
                    <svg class="size-5 text-primary-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </span>
                {{ tenant('id') }}
            </span>
            <p class="mt-2 text-sm text-muted-foreground-1">Sign in to your workspace</p>
        </div>

        <!-- Card -->
        <div class="bg-card border border-card-line rounded-2xl shadow-2xs p-6 sm:p-8">
            <h2 class="text-lg font-bold text-foreground text-center mb-6">Welcome back</h2>

            @if($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-400 text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('tenant.login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-foreground mb-1.5">Email address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                           class="py-3 px-4 block w-full border border-line-2 rounded-lg text-sm text-foreground bg-background placeholder-muted-foreground-1 focus:border-primary focus:ring-primary disabled:opacity-50 disabled:pointer-events-none"
                           placeholder="you@company.com">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-foreground mb-1.5">Password</label>
                    <input type="password" name="password" id="password" required autocomplete="current-password"
                           class="py-3 px-4 block w-full border border-line-2 rounded-lg text-sm text-foreground bg-background placeholder-muted-foreground-1 focus:border-primary focus:ring-primary disabled:opacity-50 disabled:pointer-events-none"
                           placeholder="••••••••">
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                               class="shrink-0 border border-line-3 rounded text-primary focus:ring-primary">
                        <label for="remember" class="text-sm text-muted-foreground-1 ms-2">Remember me</label>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus disabled:opacity-50 disabled:pointer-events-none transition-all">
                    Sign in
                </button>
            </form>
        </div>

        <p class="mt-6 text-center text-sm text-muted-foreground-1">
            Don't have an account?
            <a href="{{ route('tenant.register') }}" class="font-semibold text-primary hover:text-primary-hover transition-colors">Create one</a>
        </p>
    </div>

    @livewireScripts
</body>
</html>
