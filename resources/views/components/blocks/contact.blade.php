@props(['data' => []])

<div class="py-24 bg-surface border-t border-line-2 text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <flux:heading size="xl" class="mb-6">{{ $data['heading'] ?? 'Get In Touch' }}</flux:heading>
        <p class="text-lg text-muted-foreground-1 mb-10">{{ $data['description'] ?? 'Have any questions? We would love to hear from you.' }}</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @if(!empty($data['email']))
                <div class="p-6">
                    <div class="size-12 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: color-mix(in srgb, var(--brand-primary), transparent 90%); color: var(--brand-primary)">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="font-bold text-foreground mb-1">Email</h4>
                    <a href="mailto:{{ $data['email'] }}" class="hover:underline" style="color: var(--brand-primary)">{{ $data['email'] }}</a>
                </div>
            @endif
            
            @if(!empty($data['phone']))
                <div class="p-6">
                    <div class="size-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <h4 class="font-bold text-foreground mb-1">Phone</h4>
                    <a href="tel:{{ $data['phone'] }}" class="text-primary hover:underline">{{ $data['phone'] }}</a>
                </div>
            @endif
            
            @if(!empty($data['address']))
                <div class="p-6">
                    <div class="size-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h4 class="font-bold text-foreground mb-1">Address</h4>
                    <p class="text-muted-foreground-1">{{ $data['address'] }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
