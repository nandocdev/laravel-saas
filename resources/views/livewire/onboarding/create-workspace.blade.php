
    <div class="flex h-full w-full flex-1 flex-col justify-center items-center py-10 px-4">
        
        <div class="w-full max-w-lg">
            
            <div class="text-center mb-8">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-primary text-primary-foreground mb-4">
                    <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/></svg>
                </span>
                <flux:heading size="xl">Create your workspace</flux:heading>
                <flux:subheading class="mt-2">This is where your team will work and collaborate.</flux:subheading>
            </div>

            <div class="bg-card border border-card-line rounded-2xl shadow-2xs p-6 sm:p-8">
                <form wire:submit.prevent="createWorkspace" class="space-y-6">

                    <!-- Workspace Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-foreground mb-1.5">Workspace Name</label>
                        <input type="text" id="name" wire:model.live.debounce.300ms="name" required autofocus
                            class="py-3 px-4 block w-full border border-line-2 rounded-lg text-sm text-foreground bg-background placeholder-muted-foreground-1 focus:border-primary focus:ring-primary disabled:opacity-50"
                            placeholder="e.g. Acme Corporation">
                        
                        @error('name')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subdomain Preview -->
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Your Workspace URL</label>
                        
                        <div class="flex rounded-lg shadow-sm">
                            <input type="text" id="domain" wire:model.live="domain" required
                                class="py-3 px-4 block w-full border border-line-2 rounded-s-lg text-sm text-foreground bg-background focus:z-10 focus:border-primary focus:ring-primary disabled:opacity-50"
                                placeholder="acme"
                                @if($submitting) disabled @endif>
                                
                            <span class="py-3 px-4 inline-flex items-center min-w-fit border border-s-0 border-line-2 rounded-e-lg bg-surface text-sm text-muted-foreground-1">
                                .{{ request()->getHost() }}
                            </span>
                        </div>
                        <p class="mt-2 text-xs text-muted-foreground-1">You can always customize your workspace URL later.</p>

                        @error('domain')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-lg bg-primary border text-primary-foreground hover:bg-primary-hover focus:outline-hidden disabled:opacity-50 transition-all">
                        
                        <span wire:loading.remove>Create Workspace</span>
                        
                        <span wire:loading class="flex items-center gap-2">
                            <svg class="animate-spin size-4 text-primary-foreground" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Creating database...
                        </span>
                    </button>
                    
                </form>
            </div>
            
            <p class="mt-6 text-center text-sm text-muted-foreground-1 max-w-sm mx-auto">
                By creating a workspace, you agree to our <a href="#" class="font-medium text-foreground hover:underline">Terms of Service</a> and <a href="#" class="font-medium text-foreground hover:underline">Privacy Policy</a>.
            </p>

        </div>
    </div>
