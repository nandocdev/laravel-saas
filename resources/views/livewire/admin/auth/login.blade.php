<div class="min-h-screen flex items-center justify-center bg-background px-4">
    <div class="w-full max-w-sm">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 text-2xl font-bold text-foreground">
                <span class="size-8 rounded-lg bg-primary flex items-center justify-center">
                    <svg class="size-5 text-primary-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </span>
                SaaSFlow
            </a>
            <p class="mt-2 text-sm text-muted-foreground-1">Admin Panel</p>
        </div>

        <!-- Card -->
        <div class="bg-card border border-card-line rounded-2xl shadow-2xs p-6 sm:p-8">
            <h2 class="text-lg font-bold text-foreground text-center mb-6">Sign in to Admin</h2>

            <form wire:submit="authenticate" class="space-y-5">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-foreground mb-1.5">Email address</label>
                    <input wire:model="email" type="email" id="email" autocomplete="email" required
                           class="py-3 px-4 block w-full border border-line-2 rounded-lg text-sm text-foreground bg-background placeholder-muted-foreground-1 focus:border-primary focus:ring-primary disabled:opacity-50 disabled:pointer-events-none"
                           placeholder="admin@saasflow.dev">
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-foreground mb-1.5">Password</label>
                    <input wire:model="password" type="password" id="password" required
                           class="py-3 px-4 block w-full border border-line-2 rounded-lg text-sm text-foreground bg-background placeholder-muted-foreground-1 focus:border-primary focus:ring-primary disabled:opacity-50 disabled:pointer-events-none"
                           placeholder="••••••••">
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember -->
                <div class="flex items-center">
                    <input wire:model="remember" type="checkbox" id="remember"
                           class="shrink-0 border border-line-3 rounded text-primary focus:ring-primary disabled:opacity-50 disabled:pointer-events-none">
                    <label for="remember" class="text-sm text-muted-foreground-1 ms-2">Remember me</label>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus disabled:opacity-50 disabled:pointer-events-none transition-all"
                        wire:loading.attr="disabled">
                    <span wire:loading.remove>Sign in</span>
                    <span wire:loading>
                        <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Signing in...
                    </span>
                </button>
            </form>
        </div>

        <p class="mt-6 text-center text-xs text-muted-foreground-1">
            <a href="/" class="text-primary hover:text-primary-hover transition-colors">← Back to site</a>
        </p>
    </div>
</div>
