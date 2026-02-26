{{--
    resources/views/livewire/landing-builder/landing-builder.blade.php
    Requiere: layouts/fullscreen.blade.php (h-screen, sin nav, sin padding)
--}}
<div
    class="flex flex-col h-screen overflow-hidden text-slate-800 bg-[#f8fafc]"
    style="background:#0e0e13; font-family:'Instrument Sans',system-ui,sans-serif;"
    x-data="{
        activePicker: null,
        dragId: null,

        primaryPresets: ['#6366f1','#8b5cf6','#3b82f6','#0ea5e9','#06b6d4','#14b8a6','#22c55e','#f59e0b','#ef4444','#ec4899','#1e293b','#18181b'],
        neutralPresets: ['#f1f5f9','#e2e8f0','#cbd5e1','#f5f5f4','#e7e5e4','#d1d5db','#fafaf9','#fef3c7','#d1fae5','#e0f2fe','#fee2e2','#f3f4f6'],
        accentPresets:  ['#f97316','#eab308','#ef4444','#ec4899','#a855f7','#06b6d4','#10b981','#f59e0b','#84cc16','#0ea5e9','#fb7185','#c084fc'],

        quickPalettes: [
            { name:'Índigo',    vibe:'Profesional',  primary:'#6366f1', neutral:'#e2e8f0', accent:'#f97316' },
            { name:'Bosque',    vibe:'Natural',       primary:'#166534', neutral:'#d1fae5', accent:'#f59e0b' },
            { name:'Océano',    vibe:'Tecnológico',  primary:'#0ea5e9', neutral:'#e0f2fe', accent:'#f43f5e' },
            { name:'Artesanal', vibe:'Cálido',        primary:'#b45309', neutral:'#fef3c7', accent:'#6b7280' },
            { name:'Rosa',      vibe:'Editorial',    primary:'#db2777', neutral:'#fce7f3', accent:'#7c3aed' },
            { name:'Violeta',   vibe:'Creativo',     primary:'#7c3aed', neutral:'#f5f3ff', accent:'#22d3ee' },
        ],
    }"
>

{{-- ╔══════════════════════════════════════════╗
     ║  TOPBAR                                  ║
     ╚══════════════════════════════════════════╝ --}}
<header class="flex items-center justify-between px-6 h-14 flex-shrink-0 border-b gap-4 bg-white"
        style="border-color:#e2e8f0;">

    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-sm font-bold text-slate-700 hover:text-slate-900 transition-colors">
            <div class="size-7 rounded-lg flex items-center justify-center flex-shrink-0"
                 style="background:{{ $colorPrimary }}">
                <svg class="size-[14px]" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M13 2 3 14h9l-1 8 10-12h-9z"/>
                </svg>
            </div>
            SaaSFlow
        </a>
        <span class="w-px h-5" style="background:#e2e8f0"></span>
        <span class="text-sm font-medium" style="color:#64748b">Landing Page</span>
    </div>

    <div class="flex items-center gap-2">
        {{-- Status badge --}}
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold border"
              style="{{ $status === 'published'
                ? 'background:rgba(34,197,94,0.1); color:#86efac; border-color:rgba(34,197,94,0.2)'
                : 'background:rgba(234,179,8,0.1); color:#fde68a; border-color:rgba(234,179,8,0.2)' }}">
            <span class="size-1.5 rounded-full {{ $status === 'published' ? 'animate-pulse' : '' }}"
                  style="background:{{ $status === 'published' ? '#86efac' : '#fde68a' }}"></span>
            {{ $status === 'published' ? 'En vivo' : 'Borrador' }}
        </span>

        <a href="{{ route('tenant.landing.preview', ['preview' => 'true']) }}" target="_blank"
           class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold transition-all"
           style="color:#64748b; border:1px solid #e2e8f0; background:white;"
           onmouseover="this.style.background='#f1f5f9'; this.style.color='#0f172a'"
           onmouseout="this.style.background='white'; this.style.color='#64748b'"
        >
            <svg class="size-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            Vista previa
        </a>

        <button wire:click="togglePublish"
                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold border transition-all"
                style="{{ $status === 'published'
                    ? 'background:rgba(239,68,68,0.1); color:#fca5a5; border-color:rgba(239,68,68,0.2)'
                    : 'background:rgba(34,197,94,0.1); color:#86efac; border-color:rgba(34,197,94,0.2)' }}"
        >
            @if($status === 'published')
                <svg class="size-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                Despublicar
            @else
                <svg class="size-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                Publicar
            @endif
        </button>
    </div>
</header>

{{-- ╔══════════════════════════════════════════╗
     ║  MAIN: SIDEBAR + CANVAS                  ║
     ╚══════════════════════════════════════════╝ --}}
<div class="flex flex-1 overflow-hidden">

    {{-- ┌─────────────────────────────────────┐
         │  SIDEBAR                            │
         └─────────────────────────────────────┘ --}}
    <aside class="w-[360px] flex-shrink-0 flex flex-col overflow-hidden"
           style="background:white; border-right:1px solid #e2e8f0">

        {{-- Tabs --}}
        <nav class="flex px-1 gap-0.5 border-b flex-shrink-0" style="border-color:#e2e8f0; background:white">
            @foreach([
                'template' => 'Plantilla',
                'sections' => 'Secciones',
                'style'    => 'Estilo',
            ] as $tab => $label)
                <button wire:click="$set('activeTab', '{{ $tab }}')"
                        class="flex-1 py-3 text-xs font-semibold transition-all border-b-2 -mb-px"
                        style="{{ $activeTab === $tab
                            ? 'color:#4f46e5; border-color:#4f46e5;'
                            : 'color:#64748b; border-color:transparent;' }}"
                >{{ $label }}</button>
            @endforeach
        </nav>

        {{-- Scrollable body --}}
        <div class="flex-1 overflow-y-auto" style="scrollbar-width:thin; scrollbar-color:#e2e8f0 transparent">

            {{-- ══════════════ TAB: PLANTILLA ══════════════ --}}
            @if($activeTab === 'template')
            <div class="p-5">
                <p class="text-[10px] font-bold uppercase tracking-widest mb-3" style="color:#64748b">
                    Elige tu plantilla base
                </p>

                <div class="grid grid-cols-2 gap-2 mb-5">
                    @foreach($this->availableTemplates as $tpl)
                    <button
                        wire:click="selectTemplate('{{ $tpl['key'] }}')"
                        @if($templateKey !== $tpl['key'])
                            wire:confirm="¿Cambiar plantilla? Se reemplazarán las secciones actuales."
                        @endif
                        class="relative rounded-xl overflow-hidden aspect-video cursor-pointer transition-all hover:-translate-y-0.5 group text-left"
                        style="border:2px solid {{ $templateKey === $tpl['key'] ? '#4f46e5' : '#e2e8f0' }};
                               {{ $templateKey === $tpl['key'] ? 'box-shadow:0 0 0 1px #4f46e5, 0 8px 24px rgba(79,70,229,0.15)' : '' }}"
                    >
                        {{-- Mini preview por template --}}
                        @switch($tpl['key'])
                            @case('corporate')
                            <div class="w-full h-full flex flex-col" style="background:#f8fafc">
                                <div class="flex items-center gap-1 px-2 py-1.5" style="background:white; border-bottom:1px solid #e5e7eb">
                                    <div class="h-1 w-6 rounded-full" style="background:{{ $colorPrimary }}"></div>
                                    <div class="flex-1"></div>
                                    <div class="h-1.5 w-4 rounded-sm" style="background:{{ $colorPrimary }}"></div>
                                </div>
                                <div class="flex-1 flex flex-col items-center justify-center gap-1 px-3" style="background:linear-gradient(135deg,{{ $colorPrimary }}08,white)">
                                    <div class="h-1.5 w-3/5 rounded-full bg-gray-800"></div>
                                    <div class="h-1 w-4/5 rounded-full bg-gray-300"></div>
                                    <div class="h-2 w-8 rounded-md mt-1" style="background:{{ $colorPrimary }}"></div>
                                </div>
                                <div class="grid grid-cols-3 gap-1 p-2">
                                    @for($i=0;$i<3;$i++)<div class="h-4 rounded" style="background:white;border:1px solid #e5e7eb"></div>@endfor
                                </div>
                            </div>
                            @break
                            @case('visual')
                            <div class="w-full h-full relative" style="background:linear-gradient(135deg,#1a1a2e,#16213e)">
                                <div class="absolute inset-0 opacity-70" style="background:url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=300&q=50') center/cover"></div>
                                <div class="absolute inset-0 flex flex-col justify-end p-2" style="background:linear-gradient(to top,rgba(0,0,0,0.8),transparent)">
                                    <div class="h-1.5 w-3/4 rounded-full bg-white mb-1"></div>
                                    <div class="h-1 w-1/2 rounded-full mb-2" style="background:rgba(255,255,255,0.4)"></div>
                                    <div class="h-2 w-8 rounded-md" style="background:{{ $colorAccent }}"></div>
                                </div>
                            </div>
                            @break
                            @case('conversion')
                            <div class="w-full h-full flex flex-col" style="background:#fafafa">
                                <div class="flex items-center justify-between px-2 py-1.5" style="background:{{ $colorPrimary }}">
                                    <div class="h-1 w-5 rounded-full" style="background:#475569"></div>
                                    <div class="h-2 w-5 rounded-sm" style="background:{{ $colorAccent }}"></div>
                                </div>
                                <div class="flex-1 flex flex-col items-center justify-center gap-1 px-3">
                                    <div class="h-1.5 w-1/2 rounded-full" style="background:#1e1e2e"></div>
                                    <div class="h-1 w-3/4 rounded-full bg-gray-300"></div>
                                    <div class="h-2 w-10 rounded-md mt-1" style="background:{{ $colorPrimary }}"></div>
                                </div>
                            </div>
                            @break
                            @case('catalog')
                            <div class="w-full h-full flex flex-col" style="background:#f0fdf4">
                                <div class="flex items-center gap-1 px-2 py-1" style="background:white; border-bottom:1px solid #dcfce7">
                                    <div class="h-1 w-5 rounded-full" style="background:#16a34a"></div>
                                    <div class="flex-1 h-1 rounded-full" style="background:#dcfce7"></div>
                                </div>
                                <div class="grid grid-cols-3 gap-1 p-2 flex-1">
                                    @for($i=0;$i<6;$i++)
                                    <div class="rounded flex flex-col p-1" style="background:white; border:1px solid #dcfce7">
                                        <div class="h-3 w-full rounded mb-1" style="background:#dcfce7"></div>
                                        <div class="h-1 w-3/5 rounded" style="background:#9ca3af"></div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                            @break
                            @case('storytelling')
                            <div class="w-full h-full flex items-center gap-3 px-3" style="background:#fffbeb">
                                <div class="size-9 rounded-full flex-shrink-0" style="background:linear-gradient(135deg,#f59e0b,#d97706)"></div>
                                <div class="flex-1">
                                    <div class="h-1.5 w-3/4 rounded-full mb-1" style="background:#1e1e2e"></div>
                                    <div class="h-1 w-full rounded-full mb-2 bg-gray-300"></div>
                                    <div class="h-2 w-8 rounded-md" style="background:#f59e0b"></div>
                                </div>
                            </div>
                            @break
                            @default
                            <div class="w-full h-full flex flex-col items-center justify-center gap-2" style="background:white">
                                <div class="h-2 w-1/2 rounded-full" style="background:#1e1e2e"></div>
                                <div class="h-1 w-3/4 rounded-full bg-gray-300"></div>
                                <div class="h-2 w-8 rounded-md mt-1" style="background:#475569"></div>
                            </div>
                        @endswitch

                        {{-- Hover overlay --}}
                        <div class="absolute inset-0 flex flex-col justify-end p-2 transition-opacity {{ $templateKey === $tpl['key'] ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"
                             style="background:linear-gradient(to top, rgba(0,0,0,0.82), rgba(0,0,0,0.25), transparent)">
                            <p class="text-[11px] font-bold text-white leading-tight">{{ $tpl['name'] }}</p>
                            <p class="text-[9px]" style="color:#475569">{{ $tpl['vibe'] ?? ($tpl['description'] ?? '') }}</p>
                        </div>

                        {{-- Check activo --}}
                        @if($templateKey === $tpl['key'])
                        <div class="absolute top-1.5 right-1.5 size-5 rounded-full flex items-center justify-center shadow"
                             style="background:#7c6ff7">
                            <svg class="size-3" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        </div>
                        @endif
                    </button>
                    @endforeach
                </div>

                {{-- Plantilla activa pill --}}
                <div class="flex items-center gap-3 p-3 rounded-xl" style="background:#f8fafc; border:1px solid #e2e8f0">
                    <div class="size-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(79,70,229,0.1)">
                        <svg class="size-4" fill="none" stroke="#9d93ff" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-slate-800 truncate">
                            {{ collect($this->availableTemplates)->firstWhere('key', $templateKey)['name'] ?? $templateKey }}
                        </p>
                        <p class="text-[10px]" style="color:#94a3b8">Plantilla activa</p>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(79,70,229,0.1); color:#4f46e5">Activa</span>
                </div>
            </div>
            @endif

            {{-- ══════════════ TAB: SECCIONES ══════════════ --}}
            @if($activeTab === 'sections')
            <div class="p-5">
                <p class="text-[10px] font-bold uppercase tracking-widest mb-1" style="color:#64748b">Secciones</p>
                <p class="text-[11px] mb-4" style="color:#94a3b8">Arrastra · activa/desactiva · edita</p>

                <div class="space-y-1.5 mb-3">
                    @foreach($this->blocks as $block)
                    <div
                        wire:key="block-{{ $block->id }}"
                        draggable="true"
                        x-on:dragstart="dragId = {{ $block->id }}"
                        x-on:dragend="dragId = null"
                        x-on:dragover.prevent
                        x-on:drop.prevent="
                            const ids = [...document.querySelectorAll('[data-block]')].map(el => +el.dataset.block);
                            $wire.reorderFromDrag(ids)
                        "
                        data-block="{{ $block->id }}"
                        class="group flex items-center gap-2 px-3 py-2.5 rounded-xl cursor-pointer transition-all select-none"
                        style="border:1px solid {{ $selectedBlockId === $block->id ? 'rgba(79,70,229,0.5)' : '#e2e8f0' }};
                               background:{{ $selectedBlockId === $block->id ? 'rgba(79,70,229,0.05)' : 'transparent' }};
                               opacity:{{ $block->is_active ? '1' : '0.4' }}"
                        wire:click="$set('selectedBlockId', {{ $selectedBlockId === $block->id ? 'null' : $block->id }})"
                    >
                        {{-- Drag handle --}}
                        <div class="flex-shrink-0 cursor-grab active:cursor-grabbing" style="color:#94a3b8">
                            <svg class="size-3.5" fill="currentColor" viewBox="0 0 24 24"><circle cx="9" cy="5" r="1.5"/><circle cx="15" cy="5" r="1.5"/><circle cx="9" cy="12" r="1.5"/><circle cx="15" cy="12" r="1.5"/><circle cx="9" cy="19" r="1.5"/><circle cx="15" cy="19" r="1.5"/></svg>
                        </div>

                        {{-- Icon --}}
                        <div class="size-7 rounded-lg flex items-center justify-center flex-shrink-0 text-sm"
                             style="background:{{ $block->getColorHex() }}20">
                            {{ $block->getEmoji() }}
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-semibold text-slate-900 leading-none truncate">{{ $block->getLabel() }}</p>
                            <p class="text-[10px] mt-0.5 truncate" style="color:#94a3b8">{{ $block->getTag() }}</p>
                        </div>

                        {{-- Flechas orden (hover) --}}
                        <div class="hidden group-hover:flex items-center gap-0.5">
                            <button wire:click.stop="moveBlock({{ $block->id }}, 'up')"
                                    class="size-5 flex items-center justify-center rounded transition-all"
                                    style="color:#94a3b8"
                                    onmouseover="this.style.color='#0f172a'; this.style.background='#f1f5f9'"
                                    onmouseout="this.style.color='#94a3b8'; this.style.background='transparent'">
                                <svg class="size-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M5 15l7-7 7 7"/></svg>
                            </button>
                            <button wire:click.stop="moveBlock({{ $block->id }}, 'down')"
                                    class="size-5 flex items-center justify-center rounded transition-all"
                                    style="color:#94a3b8"
                                    onmouseover="this.style.color='#0f172a'; this.style.background='#f1f5f9'"
                                    onmouseout="this.style.color='#94a3b8'; this.style.background='transparent'">
                                <svg class="size-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        </div>

                        {{-- Toggle --}}
                        <label class="relative inline-flex items-center cursor-pointer flex-shrink-0" x-on:click.stop>
                            <input type="checkbox" class="sr-only peer"
                                   {{ $block->is_active ? 'checked' : '' }}
                                   wire:click.stop="toggleBlock({{ $block->id }})">
                            <div class="w-8 h-4 rounded-full transition-colors peer-checked:bg-emerald-500"
                                 style="background:#e2e8f0"></div>
                            <div class="absolute left-0.5 top-0.5 size-3 rounded-full bg-white shadow transition-transform peer-checked:translate-x-4"></div>
                        </label>

                        {{-- Edit --}}
                        <button wire:click.stop="openEditPanel({{ $block->id }})"
                                class="flex items-center gap-1 px-2 py-1 rounded-lg text-[10px] font-semibold flex-shrink-0 transition-all"
                                style="color:#64748b; background:white; border:1px solid #e2e8f0"
                                onmouseover="this.style.color='#0f172a'; this.style.background='#f8fafc'"
                                onmouseout="this.style.color='#64748b'; this.style.background='white'">
                            <svg class="size-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4z"/></svg>
                            Editar
                        </button>

                        {{-- Delete (solo hover) --}}
                        <button wire:click.stop="deleteBlock({{ $block->id }})"
                                wire:confirm="¿Eliminar esta sección?"
                                class="flex-shrink-0 size-6 hidden group-hover:flex items-center justify-center rounded-lg transition-all"
                                style="color:#94a3b8"
                                onmouseover="this.style.color='#fca5a5'; this.style.background='rgba(239,68,68,0.1)'"
                                onmouseout="this.style.color='rgba(255,255,255,0.2)'; this.style.background='transparent'">
                            <svg class="size-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                        </button>
                    </div>
                    @endforeach
                </div>

                {{-- Add section --}}
                <button wire:click="$set('activeTab', 'add')"
                        class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-xs font-semibold transition-all"
                        style="border:1px dashed rgba(255,255,255,0.1); color:#94a3b8; background:transparent"
                        onmouseover="this.style.borderColor='rgba(79,70,229,0.5)'; this.style.color='#9d93ff'; this.style.background='rgba(124,111,247,0.05)'"
                        onmouseout="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.color='#94a3b8'; this.style.background='transparent'">
                    <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Añadir nueva sección
                </button>
            </div>
            @endif

            {{-- ══════════════ TAB: ESTILO ══════════════ --}}
            @if($activeTab === 'style')
            <div class="p-5 space-y-5">

                {{-- Nombre del sitio --}}
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest mb-2" style="color:#64748b">Nombre del sitio</p>
                    <input wire:model.blur="siteName" type="text"
                           class="w-full px-3 py-2 rounded-lg text-sm text-slate-900 placeholder-slate-400 focus:outline-none transition-colors"
                           style="background:white; border:1px solid #e2e8f0"
                           placeholder="MiEmpresa">
                </div>

                <div class="h-px" style="background:#e2e8f0"></div>

                {{-- 3 Color pickers --}}
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest mb-3" style="color:#64748b">Colores</p>

                    @foreach([
                        ['prop' => 'colorPrimary', 'alpine' => 'primary', 'presets' => 'primaryPresets', 'label' => '🎨 Color de marca',  'hint' => 'Botones · CTA'],
                        ['prop' => 'colorNeutral', 'alpine' => 'neutral', 'presets' => 'neutralPresets', 'label' => '🖼️ Color base',      'hint' => 'Fondos · Bordes'],
                        ['prop' => 'colorAccent',  'alpine' => 'accent',  'presets' => 'accentPresets',  'label' => '✨ Acento',           'hint' => 'Badges · Detalles'],
                    ] as $c)
                    <div class="mb-3">
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-xs font-semibold text-slate-900">{{ $c['label'] }}</span>
                            <span class="text-[10px]" style="color:#94a3b8">{{ $c['hint'] }}</span>
                        </div>

                        {{-- Picker trigger --}}
                        <button @click="activePicker = activePicker === '{{ $c['alpine'] }}' ? null : '{{ $c['alpine'] }}'"
                                class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-xl transition-all"
                                style="background:white; border:1px solid #e2e8f0">
                            <div class="size-7 rounded-md flex-shrink-0"
                                 style="background:{{ ${'color'.ucfirst($c['alpine'])} }}; box-shadow:inset 0 0 0 1px rgba(255,255,255,0.1)"></div>
                            <span class="font-mono text-xs text-slate-900 flex-1 text-left">{{ strtoupper(${'color'.ucfirst($c['alpine'])}) }}</span>
                            <svg class="size-4" fill="none" stroke="rgba(255,255,255,0.25)" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        {{-- Presets panel --}}
                        <div x-show="activePicker === '{{ $c['alpine'] }}'"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 -translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="mt-1.5 p-2.5 rounded-xl flex flex-wrap gap-1.5 items-center"
                             style="background:rgba(255,255,255,0.04); border:1px solid #e2e8f0">
                            <template x-for="color in {{ $c['presets'] }}" :key="color">
                                <button @click="$wire.set('{{ $c['prop'] }}', color); activePicker = null"
                                        class="size-6 rounded-full transition-all hover:scale-110 flex-shrink-0"
                                        :style="`background:${color}; border:2px solid ${ '{{ ${'color'.ucfirst($c['alpine'])} }}' === color ? 'white' : 'transparent' }`">
                                </button>
                            </template>
                            {{-- Native color input --}}
                            <input type="color"
                                   value="{{ ${'color'.ucfirst($c['alpine'])} }}"
                                   @input="$wire.set('{{ $c['prop'] }}', $event.target.value)"
                                   class="size-6 rounded-full cursor-pointer border-0 p-0 bg-transparent"
                                   style="appearance:none; -webkit-appearance:none;">
                            {{-- Hex input --}}
                            <input type="text"
                                   value="{{ ${'color'.ucfirst($c['alpine'])} }}"
                                   @change="if(/^#[0-9a-fA-F]{6}$/.test($event.target.value)) $wire.set('{{ $c['prop'] }}', $event.target.value)"
                                   class="font-mono text-[10px] px-2 py-1 rounded-lg text-slate-900 focus:outline-none"
                                   style="width:76px; background:white; border:1px solid #e2e8f0"
                                   maxlength="7" placeholder="#000000">
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="h-px" style="background:#e2e8f0"></div>

                {{-- Tipografía --}}
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest mb-2" style="color:#64748b">Tipografía</p>
                    <div class="grid grid-cols-2 gap-1.5">
                        @foreach([
                            ['key' => 'instrument', 'name' => 'Instrument', 'sample' => 'Elegante'],
                            ['key' => 'slab',       'name' => 'Roboto Slab','sample' => 'Con serifa'],
                            ['key' => 'sans',       'name' => 'DM Sans',    'sample' => 'Moderna'],
                            ['key' => 'mono',       'name' => 'Mono',       'sample' => 'Técnica'],
                        ] as $font)
                        <button wire:click="$set('fontFamily', '{{ $font['key'] }}')"
                                class="py-2.5 px-3 rounded-xl text-center transition-all"
                                style="border:1px solid {{ $fontFamily === $font['key'] ? 'rgba(79,70,229,0.5)' : '#e2e8f0' }};
                                       background:{{ $fontFamily === $font['key'] ? 'rgba(79,70,229,0.05)' : 'transparent' }}">
                            <p class="text-sm font-bold leading-none mb-0.5"
                               style="color:{{ $fontFamily === $font['key'] ? '#9d93ff' : '#475569' }}">{{ $font['name'] }}</p>
                            <p class="text-[9px]" style="color:#94a3b8">{{ $font['sample'] }}</p>
                        </button>
                        @endforeach
                    </div>
                </div>

                <div class="h-px" style="background:#e2e8f0"></div>

                {{-- Fondo --}}
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest mb-2" style="color:#64748b">Estilo de fondo</p>
                    <div class="grid grid-cols-3 gap-1.5">
                        @foreach(['light' => ['☀️','Claro'], 'soft' => ['🌤️','Suave'], 'dark' => ['🌙','Oscuro']] as $key => [$icon, $label])
                        <button wire:click="$set('bgMode', '{{ $key }}')"
                                class="py-2.5 rounded-xl text-center transition-all"
                                style="border:1px solid {{ $bgMode === $key ? 'rgba(79,70,229,0.5)' : '#e2e8f0' }};
                                       background:{{ $bgMode === $key ? 'rgba(79,70,229,0.05)' : 'transparent' }}">
                            <div class="text-lg">{{ $icon }}</div>
                            <div class="text-[10px] font-semibold" style="color:{{ $bgMode === $key ? '#9d93ff' : 'rgba(255,255,255,0.4)' }}">{{ $label }}</div>
                        </button>
                        @endforeach
                    </div>
                </div>

                <div class="h-px" style="background:#e2e8f0"></div>

                {{-- Paletas rápidas --}}
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest mb-2" style="color:#64748b">Paletas listas</p>
                    <div class="grid grid-cols-2 gap-1.5" x-data>
                        <template x-for="p in quickPalettes" :key="p.name">
                            <button @click="$wire.applyPalette(p.primary, p.neutral, p.accent)"
                                    class="flex items-center gap-2 p-2.5 rounded-xl transition-all text-left"
                                    :style="{
                                        border: '1px solid ' + ('{{ $colorPrimary }}' === p.primary ? p.primary + '50' : '#e2e8f0'),
                                        background: '{{ $colorPrimary }}' === p.primary ? p.primary + '12' : 'transparent',
                                    }">
                                <div class="flex gap-0.5 flex-shrink-0">
                                    <div class="w-3 h-7 rounded-l-md" :style="`background:${p.primary}`"></div>
                                    <div class="w-3 h-7"              :style="`background:${p.neutral}`"></div>
                                    <div class="w-3 h-7 rounded-r-md" :style="`background:${p.accent}`"></div>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold text-slate-900" x-text="p.name"></p>
                                    <p class="text-[10px]" style="color:#94a3b8" x-text="p.vibe"></p>
                                </div>
                            </button>
                        </template>
                    </div>
                </div>

            </div>
            @endif

        </div>{{-- /scrollable --}}

        {{-- Footer --}}
        <div class="flex gap-2 p-4 flex-shrink-0" style="border-top:1px solid #e2e8f0; background:white">
            <button wire:click="$set('colorPrimary', collect(['#6366f1','#0ea5e9','#22c55e','#db2777','#7c3aed','#dc2626'])->random())"
                    class="flex items-center justify-center p-2.5 rounded-xl transition-all"
                    style="border:1px solid #e2e8f0; color:#64748b; background:transparent"
                    title="Paleta aleatoria">
                <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="16 3 21 3 21 8"/><line x1="4" y1="20" x2="21" y2="3"/><polyline points="21 16 21 21 16 21"/><line x1="15" y1="15" x2="21" y2="21"/></svg>
            </button>
            <button wire:click="saveAll" wire:loading.attr="disabled"
                    class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-bold text-white transition-all hover:opacity-90 disabled:opacity-50"
                    style="background:{{ $colorPrimary }}; box-shadow:0 4px 16px {{ $colorPrimary }}40">
                <span wire:loading.remove wire:target="saveAll">
                    <svg class="size-3.5 inline mr-1" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                    Guardar cambios
                </span>
                <span wire:loading wire:target="saveAll">Guardando...</span>
            </button>
        </div>
    </aside>

    {{-- ┌─────────────────────────────────────┐
         │  CANVAS                             │
         └─────────────────────────────────────┘ --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Canvas toolbar --}}
        <div class="flex items-center justify-between px-5 py-2.5 flex-shrink-0"
             style="background:white; border-bottom:1px solid #e2e8f0">

            {{-- Viewport --}}
            <div class="flex p-1 gap-0.5 rounded-xl" style="background:#f1f5f9; border:1px solid #e2e8f0">
                @foreach(['desktop' => 'Escritorio', 'tablet' => 'Tablet', 'mobile' => 'Móvil'] as $vp => $label)
                <button wire:click="$set('viewport', '{{ $vp }}')"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold transition-all"
                        style="{{ $viewport === $vp
                            ? 'background:white; color:#0f172a; box-shadow:0 1px 4px rgba(0,0,0,0.3)'
                            : 'color:#94a3b8' }}">
                    {{ $label }}
                </button>
                @endforeach
            </div>

            <div class="text-xs" style="color:#94a3b8">
                {{ collect($this->availableTemplates)->firstWhere('key', $templateKey)['name'] ?? $templateKey }}
                <span style="color:rgba(0,0,0,0.1)">·</span>
                <span class="font-semibold" style="color:#475569">
                    {{ $this->blocks->where('is_active', true)->count() }} activas
                </span>
            </div>

            <a href="{{ route('tenant.landing.preview', ['preview' => 'true']) }}" target="_blank"
               class="size-8 flex items-center justify-center rounded-lg transition-all"
               style="border:1px solid #e2e8f0; color:#94a3b8"
               title="Abrir en nueva pestaña">
                <svg class="size-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
        </div>

        {{-- Canvas area --}}
        <div class="flex-1 overflow-auto flex items-start justify-center p-8"
             style="background: radial-gradient(circle at 20% 20%, {{ $colorPrimary }}15, transparent 50%), radial-gradient(circle at 80% 80%, {{ $colorAccent }}10, transparent 40%), #f8fafc;
                    background-image: radial-gradient(rgba(0,0,0,0.06) 1px, transparent 1px);
                    background-size: 24px 24px;">

            {{-- Preview window --}}
            <div class="bg-white rounded-2xl overflow-hidden transition-all duration-300 w-full"
                 style="max-width: {{ $viewport === 'mobile' ? '390px' : ($viewport === 'tablet' ? '768px' : '1200px') }};
                        box-shadow: 0 0 0 1px rgba(0,0,0,0.05), 0 32px 80px rgba(0,0,0,0.1)">

                {{-- Browser chrome --}}
                <div class="flex items-center gap-2 px-3 py-2 border-b" style="background:#f0f0f0; border-color:#e0e0e0">
                    <div class="flex gap-1.5">
                        <div class="size-2.5 rounded-full" style="background:#ff5f56"></div>
                        <div class="size-2.5 rounded-full" style="background:#ffbd2e"></div>
                        <div class="size-2.5 rounded-full" style="background:#27c93f"></div>
                    </div>
                    <div class="flex-1 bg-white rounded px-3 py-1 text-[10px] text-gray-400 font-mono border border-gray-200">
                        {{ strtolower(preg_replace('/\s+/', '', $siteName ?: 'miempresa')) }}.saasflow.io
                    </div>
                </div>

                {{-- Live preview bloques --}}
                @include('components.tenant.landing.live-preview', [
                    'blocks'         => $this->blocks,
                    'colorPrimary'   => $colorPrimary,
                    'colorNeutral'   => $colorNeutral,
                    'colorAccent'    => $colorAccent,
                    'bgMode'         => $bgMode,
                    'siteName'       => $siteName,
                    'selectedBlockId'=> $selectedBlockId,
                ])

            </div>
        </div>
    </div>

</div>{{-- /main --}}

{{-- ╔══════════════════════════════════════════╗
     ║  EDIT PANEL (slide-in derecha)           ║
     ╚══════════════════════════════════════════╝ --}}
<div class="fixed top-14 right-0 bottom-0 w-80 flex flex-col z-40 transition-transform duration-300 {{ $editPanelOpen ? 'translate-x-0' : 'translate-x-full' }}"
     style="background:white; border-left:1px solid rgba(255,255,255,0.1); box-shadow:-8px 0 32px rgba(0,0,0,0.1)">

    {{-- Header --}}
    <div class="flex items-center justify-between px-4 py-3 flex-shrink-0" style="border-bottom:1px solid #e2e8f0">
        <p class="text-sm font-bold text-slate-900">
            @if($this->editingBlock){{ $this->editingBlock->getEmoji() }} {{ $this->editingBlock->getLabel() }}@endif
        </p>
        <button wire:click="closeEditPanel" class="size-7 flex items-center justify-center rounded-lg transition-all"
                style="color:#94a3b8"
                onmouseover="this.style.color='#0f172a'; this.style.background='#e2e8f0'"
                onmouseout="this.style.color='#94a3b8'; this.style.background='transparent'">
            <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- Settings form --}}
    <div class="flex-1 overflow-y-auto p-4" style="scrollbar-width:thin; scrollbar-color:#e2e8f0 transparent">
        @if($this->editingBlock)
            @includeIf('livewire.tenant.landing.block-settings.' . $this->editingBlock->block_type, [
                'block'    => $this->editingBlock,
                'settings' => $editingSettings,
            ])
        @endif
    </div>

    {{-- Save --}}
    <div class="p-4 flex-shrink-0" style="border-top:1px solid #e2e8f0; background:white">
        <button wire:click="saveEditingBlock"
                class="w-full py-2.5 rounded-xl text-sm font-bold text-white transition-all hover:opacity-90"
                style="background:{{ $colorPrimary }}">
            Guardar sección
        </button>
    </div>
</div>

{{-- Backdrop --}}
@if($editPanelOpen)
<div class="fixed inset-0 z-30 bg-black/20" wire:click="closeEditPanel"></div>
@endif

{{-- ╔══════════════════════════════════════════╗
     ║  TOAST                                   ║
     ╚══════════════════════════════════════════╝ --}}
<div
    x-data="{ show:false, msg:'', type:'success' }"
    @notify.window="show=true; msg=$event.detail.message; type=$event.detail.type; setTimeout(()=>show=false,2800)"
    x-show="show"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-end="opacity-0"
    class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold"
    :class="{
        'text-emerald-600': type==='success',
        'text-amber-600':   type==='info',
        'text-red-600':     type==='error',
    }"
    style="display:none; background:white; border:1px solid #e2e8f0; box-shadow:0 8px 32px rgba(0,0,0,0.15); white-space:nowrap"
>
    <span x-text="type==='success'?'✓':(type==='info'?'ℹ':'✕')"></span>
    <span x-text="msg"></span>
</div>

</div>{{-- /root --}}