<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Configuración de Landing Page</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Personaliza las secciones y el estilo de tu página de inicio.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('tenant.home') }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                Vista Previa
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M3 12h18" /></svg>
            </a>
            <button wire:click="save" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                Guardar Cambios
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-xl border border-emerald-100 dark:border-emerald-800 text-sm flex items-center gap-3">
             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            {{ session('message') }}
        </div>
    @endif

    <div class="space-y-10">
        {{-- Template Selection --}}
        <section class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm overflow-hidden">
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-2">
                Seleccionar Plantilla
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @php
                    $templates = [
                        ['id' => 'corporate', 'name' => 'Clásica Corporativa', 'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=400&h=250'],
                        ['id' => 'visual', 'name' => 'Visual / Experiencia', 'img' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&q=80&w=400&h=250'],
                        ['id' => 'conversion', 'name' => 'Conversión Directa', 'img' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=400&h=250'],
                        ['id' => 'catalog', 'name' => 'Marketplace / Catálogo', 'img' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&q=80&w=400&h=250'],
                    ];
                @endphp

                @foreach($templates as $tpl)
                    <div 
                        wire:click="$set('template', '{{ $tpl['id'] }}')"
                        class="group relative cursor-pointer rounded-xl overflow-hidden border-2 transition-all duration-200 {{ $template === $tpl['id'] ? 'border-indigo-500 ring-2 ring-indigo-500/20' : 'border-slate-100 hover:border-slate-300' }}"
                    >
                        <img src="{{ $tpl['img'] }}" alt="{{ $tpl['name'] }}" class="w-full h-32 object-cover">
                        <div class="p-3 bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                            <span class="text-xs font-medium text-slate-700 dark:text-slate-300">{{ $tpl['name'] }}</span>
                            @if($template === $tpl['id'])
                                <div class="px-2 py-0.5 bg-indigo-50 dark:bg-indigo-900/30 text-[10px] font-bold text-indigo-600 dark:text-indigo-400 rounded-full border border-indigo-100 dark:border-indigo-800">
                                    Seleccionada
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Main Config Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            {{-- Left Column: Sections --}}
            <div class="lg:col-span-8 space-y-6">
                <h3 class="text-xl font-bold text-slate-800 dark:text-white flex items-center gap-2 px-2">
                    Secciones de la Página
                </h3>

                <div class="space-y-3">
                    @forelse($blocks as $index => $block)
                        <div wire:key="block-row-{{ $block['id'] }}" class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                            <div class="flex items-center p-3 gap-3">
                                {{-- Drag Handle Icon (Visual) + Order Buttons --}}
                                <div class="flex flex-col gap-1 px-1">
                                    <button wire:click="moveBlockUp({{ $index }})" class="text-slate-300 hover:text-indigo-600 transition-colors {{ $index === 0 ? 'opacity-0 cursor-default' : '' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7" /></svg>
                                    </button>
                                    <button wire:click="moveBlockDown({{ $index }})" class="text-slate-300 hover:text-indigo-600 transition-colors {{ $index === count($blocks) - 1 ? 'opacity-0 cursor-default' : '' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                                    </button>
                                </div>

                                {{-- Icon based on type --}}
                                <div class="w-10 h-10 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-600 dark:text-slate-400 capitalize">
                                    @php
                                        $iconPath = match($block['type']) {
                                            'hero' => 'M9.75 17L9 21h6l-.75-4M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                                            'features' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                                            'pricing' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                                            'testimonials' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
                                            'faq' => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.442 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                                            'contact' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                                            default => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'
                                        };
                                    @endphp
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}" /></svg>
                                </div>

                                {{-- Name and Metadata --}}
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-bold text-slate-800 dark:text-slate-100 truncate">
                                        @php
                                            $blockNames = [
                                                'hero' => 'Hero Principal',
                                                'features' => 'Características',
                                                'pricing' => 'Tarifas y Precios',
                                                'testimonials' => 'Testimonios',
                                                'faq' => 'Preguntas (FAQ)',
                                                'contact' => 'Contacto',
                                            ];
                                        @endphp
                                        {{ $blockNames[$block['type']] ?? ucfirst($block['type']) }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 capitalize">{{ $block['type'] }}</div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex items-center gap-3">
                                    {{-- Eye icon --}}
                                    <button class="text-slate-400 hover:text-indigo-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </button>

                                    {{-- Visibility Toggle --}}
                                    <div class="relative inline-flex items-center cursor-pointer" wire:click="toggleBlockVisibility({{ $index }})">
                                        <div class="w-10 h-5 bg-slate-200 dark:bg-slate-700 rounded-full transition-colors {{ $block['visible'] ? 'bg-emerald-500 dark:bg-emerald-600' : '' }}"></div>
                                        <div class="absolute left-0.5 w-4 h-4 bg-white rounded-full transition-transform {{ $block['visible'] ? 'translate-x-5' : '' }}"></div>
                                    </div>

                                    {{-- Edit Button --}}
                                    <flux:modal.trigger name="edit-block-{{ $index }}">
                                        <flux:button size="sm" variant="subtle" class="!text-xs border-slate-200 dark:border-slate-700">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            Editar
                                        </flux:button>
                                    </flux:modal.trigger>
                                    
                                    <button wire:click="removeBlock({{ $index }})" class="p-1.5 text-slate-300 hover:text-red-500 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Edit Modal for this block --}}
                            <flux:modal name="edit-block-{{ $index }}" class="max-w-2xl">
                                <div class="space-y-6">
                                    <div>
                                        <flux:heading size="lg">Editar {{ $blockNames[$block['type']] ?? ucfirst($block['type']) }}</flux:heading>
                                        <flux:subheading>Ajusta el contenido de esta sección.</flux:subheading>
                                    </div>

                                    <div class="space-y-4">
                                        @if($block['type'] === 'hero')
                                            <flux:input wire:model="blocks.{{ $index }}.data.title" label="Título Principal (Headline)" />
                                            <flux:textarea wire:model="blocks.{{ $index }}.data.subtitle" label="Subtítulo / Descripción" rows="3" />
                                            <div class="grid grid-cols-2 gap-4">
                                                <flux:input wire:model="blocks.{{ $index }}.data.cta_text" label="Texto del Botón" />
                                                <flux:input wire:model="blocks.{{ $index }}.data.cta_link" label="Enlace del Botón" />
                                            </div>
                                            
                                        @elseif($block['type'] === 'features')
                                            <div class="space-y-4">
                                                @foreach($block['data']['items'] ?? [] as $itemIndex => $item)
                                                    <div class="p-4 border border-slate-200 dark:border-slate-800 rounded-xl relative space-y-3 bg-slate-50 dark:bg-slate-900/50">
                                                        <div class="absolute top-2 right-2">
                                                            <button type="button" wire:click="removeRepeaterItem({{ $index }}, 'items', {{ $itemIndex }})" class="text-red-400 hover:text-red-600">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                            </button>
                                                        </div>
                                                        <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.title" label="Nombre de Característica" />
                                                        <flux:textarea wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.description" label="Descripción corta" rows="2" />
                                                    </div>
                                                @endforeach
                                                <flux:button type="button" size="sm" variant="subtle" wire:click="addRepeaterItem({{ $index }}, 'items', {title: 'Nueva Función', description: ''})">+ Añadir Característica</flux:button>
                                            </div>

                                        @elseif($block['type'] === 'testimonials')
                                            <flux:input wire:model="blocks.{{ $index }}.data.heading" label="Título de la Sección" />
                                            <div class="space-y-4 mt-4">
                                                @foreach($block['data']['items'] ?? [] as $itemIndex => $item)
                                                    <div class="p-4 border border-slate-200 dark:border-slate-800 rounded-xl relative space-y-3 bg-slate-50 dark:bg-slate-900/50">
                                                        <div class="absolute top-2 right-2">
                                                            <button type="button" wire:click="removeRepeaterItem({{ $index }}, 'items', {{ $itemIndex }})" class="text-red-400 hover:text-red-600">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                            </button>
                                                        </div>
                                                        <div class="grid grid-cols-2 gap-3">
                                                            <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.name" label="Nombre" />
                                                            <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.role" label="Cargo / Empresa" />
                                                        </div>
                                                        <flux:textarea wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.quote" label="Testimonio" rows="2" />
                                                    </div>
                                                @endforeach
                                                <flux:button type="button" size="sm" variant="subtle" wire:click="addRepeaterItem({{ $index }}, 'items', {name: 'Cliente', role: '', quote: ''})">+ Añadir Testimonio</flux:button>
                                            </div>

                                        @elseif($block['type'] === 'pricing')
                                            <flux:input wire:model="blocks.{{ $index }}.data.heading" label="Título de la Sección" />
                                            <div class="space-y-4 mt-4">
                                                @foreach($block['data']['items'] ?? [] as $itemIndex => $item)
                                                    <div class="p-4 border border-slate-200 dark:border-slate-800 rounded-xl relative space-y-3 bg-slate-50 dark:bg-slate-900/50">
                                                        <div class="absolute top-2 right-2">
                                                            <button type="button" wire:click="removeRepeaterItem({{ $index }}, 'items', {{ $itemIndex }})" class="text-red-400 hover:text-red-600">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                            </button>
                                                        </div>
                                                        <div class="grid grid-cols-2 gap-3">
                                                            <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.name" label="Nombre del Plan" />
                                                            <flux:input wire:model="blocks.{{ $index }}.data.items.{{ $itemIndex }}.price" label="Precio" />
                                                        </div>
                                                        <div class="pt-2">
                                                            <flux:switch wire:model.live="blocks.{{ $index }}.data.items.{{ $itemIndex }}.popular" label="Marcar como popular" />
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <flux:button type="button" size="sm" variant="subtle" wire:click="addRepeaterItem({{ $index }}, 'items', {name: 'Nuevo Plan', price: '0', popular: false, features: []})">+ Añadir Plan</flux:button>
                                            </div>

                                        @elseif($block['type'] === 'contact')
                                            <flux:input wire:model="blocks.{{ $index }}.data.heading" label="Título de la Sección" />
                                            <flux:textarea wire:model="blocks.{{ $index }}.data.description" label="Descripción" />
                                            <div class="grid grid-cols-2 gap-4">
                                                <flux:input wire:model="blocks.{{ $index }}.data.email" label="Email de Contacto" />
                                                <flux:input wire:model="blocks.{{ $index }}.data.phone" label="Teléfono" />
                                            </div>
                                            <flux:input wire:model="blocks.{{ $index }}.data.address" label="Dirección Física" />
                                        @endif
                                    </div>

                                    <div class="flex justify-end gap-3 pt-6 border-t border-slate-100 dark:border-slate-800">
                                        <flux:modal.close>
                                            <flux:button variant="ghost">Listo</flux:button>
                                        </flux:modal.close>
                                    </div>
                                </div>
                            </flux:modal>
                        </div>
                    @empty
                        <div class="p-12 text-center border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl">
                            <p class="text-slate-400">No hay secciones configuradas. Añade una para comenzar.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Add Block Button --}}
                <div class="pt-4 flex w-full">
                    <flux:modal.trigger name="add-block-modal">
                        <button 
                            type="button"
                            class="w-full py-4 border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-xl text-slate-400 hover:text-indigo-500 hover:border-indigo-200 dark:hover:border-indigo-900 transition-all flex items-center justify-center gap-2 group"
                        >
                            <svg class="w-5 h-5 group-hover:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            <span class="font-medium">Añadir Nueva Sección</span>
                        </button>
                    </flux:modal.trigger>
                </div>

                {{-- Add Block Modal --}}
                <flux:modal name="add-block-modal" class="max-w-md">
                    <div class="space-y-6">
                        <div>
                            <flux:heading size="lg">Nueva Sección</flux:heading>
                            <flux:subheading>Elige qué tipo de sección quieres añadir a tu landing page.</flux:subheading>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            @php
                                $availableBlocks = [
                                    'hero' => 'Hero / Cabecera',
                                    'features' => 'Funcionalidades',
                                    'testimonials' => 'Testimonios',
                                    'pricing' => 'Precios',
                                    'faq' => 'Preguntas',
                                    'contact' => 'Contacto',
                                ];
                            @endphp
                            @foreach($availableBlocks as $type => $label)
                                <button 
                                    wire:click="addBlock('{{ $type }}')" 
                                    x-on:click="$dispatch('close-modal', { id: 'add-block-modal' })"
                                    class="p-4 border border-slate-200 dark:border-slate-800 rounded-xl hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 text-center transition-all group"
                                >
                                    <div class="text-sm font-bold text-slate-800 dark:text-slate-100 group-hover:text-indigo-600 transition-colors">{{ $label }}</div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </flux:modal>
            </div>

            {{-- Right Column: Style Config --}}
            <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-8">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-2">
                        Configuración de Estilo
                    </h3>

                    <div class="space-y-6">
                        {{-- Logo Upload --}}
                        <div class="space-y-4">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Logo de Empresa</label>
                            <div class="relative group">
                                <div class="w-full h-32 rounded-xl border-2 border-dashed border-slate-200 dark:border-slate-800 flex items-center justify-center bg-slate-50 dark:bg-slate-900/50 overflow-hidden">
                                     @if ($logo)
                                        <img src="{{ $logo->temporaryUrl() }}" class="max-h-24 max-w-[90%] object-contain">
                                    @elseif ($existing_logo)
                                        <img src="{{ asset('storage/' . $existing_logo) }}" class="max-h-24 max-w-[90%] object-contain">
                                    @else
                                        <div class="text-center">
                                            <svg class="w-8 h-8 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                            <span class="text-xs text-slate-400">Subir Logo (.png, .svg)</span>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" wire:model="logo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            </div>
                        </div>

                        {{-- Colors --}}
                        <div class="grid grid-cols-1 gap-4">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Color Primario</label>
                                <div class="flex items-center gap-2 p-2 bg-slate-50 dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                                    <input type="color" wire:model.live="primary_color" class="w-8 h-8 rounded-lg border-none p-0 cursor-pointer overflow-hidden shadow-sm">
                                    <input type="text" wire:model.live="primary_color" class="flex-1 bg-transparent border-none text-xs font-mono font-bold text-slate-600 dark:text-slate-300 focus:ring-0 p-0 uppercase">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Color Secundario</label>
                                <div class="flex items-center gap-2 p-2 bg-slate-50 dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                                    <input type="color" wire:model.live="secondary_color" class="w-8 h-8 rounded-lg border-none p-0 cursor-pointer overflow-hidden shadow-sm">
                                    <input type="text" wire:model.live="secondary_color" class="flex-1 bg-transparent border-none text-xs font-mono font-bold text-slate-600 dark:text-slate-300 focus:ring-0 p-0 uppercase">
                                </div>
                            </div>
                        </div>

                        {{-- Typography --}}
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tipografía</label>
                            <select wire:model="font" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl text-sm font-medium py-3 pl-4 pr-10 focus:ring-indigo-500 focus:border-indigo-500 dark:text-white transition-all shadow-sm">
                                <option value="Roboto">Roboto</option>
                                <option value="Inter">Inter</option>
                                <option value="Outfit">Outfit</option>
                                <option value="Lexend">Lexend</option>
                            </select>
                        </div>

                        {{-- Custom CSS --}}
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">CSS Personalizado</label>
                            <textarea 
                                wire:model="custom_css" 
                                rows="3" 
                                placeholder="/* Estilos extra... */"
                                class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl text-[10px] font-mono py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500 dark:text-white transition-all"
                            ></textarea>
                        </div>
                    </div>
                </div>

                {{-- Action Card --}}
                <div class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-2xl p-6 text-white shadow-xl shadow-indigo-500/20 relative overflow-hidden group">
                    <div class="relative z-10">
                        <h4 class="font-bold text-lg mb-2">Editor en Vivo</h4>
                        <p class="text-indigo-100 text-xs mb-4">Estamos trabajando en un editor visual de arrastrar y soltar para ti.</p>
                        <div class="inline-flex items-center text-[10px] font-bold uppercase tracking-widest bg-white/20 px-2 py-1 rounded">Próximamente</div>
                    </div>
                    <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-125 transition-transform duration-700">
                        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" /></svg>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>


