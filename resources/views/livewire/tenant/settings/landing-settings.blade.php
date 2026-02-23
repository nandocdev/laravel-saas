<div>
    <flux:heading size="xl">Landing Page</flux:heading>
    <flux:subheading>Manage your public-facing landing page configuration.</flux:subheading>

    <div class="mt-6 max-w-3xl">
        <form wire:submit="save" class="space-y-6">
            @if (session()->has('message'))
                <div class="p-4 bg-green-50 text-green-700 dark:bg-green-900/50 dark:text-green-400 rounded-lg text-sm mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <flux:card>
                <div class="space-y-6">
                    <flux:input wire:model="company_name" label="Company Name" placeholder="My SaaS Inc." />
                    
                    <flux:input wire:model="landing_headline" label="Hero Headline" placeholder="Welcome to our platform" />
                    
                    <flux:textarea wire:model="landing_description" label="Hero Description" placeholder="Your tailored experience starts here..." rows="4" />
                    
                    <flux:input wire:model="landing_cta" label="Call to Action Text" placeholder="Get Started" />
                </div>
                
                <div class="mt-6 flex justify-end gap-x-2 border-t border-line-2 pt-6">
                    <flux:button type="submit" variant="primary">Save Changes</flux:button>
                </div>
            </flux:card>
        </form>
    </div>
</div>
