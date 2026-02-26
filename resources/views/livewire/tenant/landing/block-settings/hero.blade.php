{{--
    resources/views/livewire/landing-builder/block-settings/hero.blade.php
    Panel de edición del bloque Hero.
    $settings es wire:model-able vía $editingSettings del componente padre.
--}}

@php $s = fn($key, $default = '') => $settings[$key] ?? $default; @endphp

<div class="space-y-4">

    {{-- Badge --}}
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Badge superior</label>
        <input
            wire:model="editingSettings.badge"
            type="text"
            placeholder="✦ Disponible ahora"
            class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none transition-colors"
            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)"
        >
        <p class="text-[10px] mt-1" style="color:rgba(255,255,255,0.25)">Deja en blanco para ocultarlo.</p>
    </div>

    {{-- Headline --}}
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Titular principal</label>
        <textarea
            wire:model="editingSettings.headline"
            rows="2"
            placeholder="El servicio que tu negocio necesita"
            class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none resize-none transition-colors"
            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)"
        ></textarea>
    </div>

    {{-- Subheadline --}}
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Subtítulo</label>
        <textarea
            wire:model="editingSettings.subheadline"
            rows="2"
            placeholder="Profesional · Confiable · Siempre disponible"
            class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none resize-none transition-colors"
            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)"
        ></textarea>
    </div>

    <div class="h-px" style="background:rgba(255,255,255,0.06)"></div>

    {{-- CTA Principal --}}
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Botón principal — texto</label>
        <input
            wire:model="editingSettings.cta_text"
            type="text"
            placeholder="Comenzar ahora"
            class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none transition-colors"
            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)"
        >
    </div>

    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Botón principal — URL</label>
        <input
            wire:model="editingSettings.cta_url"
            type="text"
            placeholder="#contacto"
            class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none transition-colors"
            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)"
        >
    </div>

    <div class="h-px" style="background:rgba(255,255,255,0.06)"></div>

    {{-- CTA Secundario --}}
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Botón secundario — texto</label>
        <input
            wire:model="editingSettings.cta2_text"
            type="text"
            placeholder="Ver más (opcional)"
            class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none transition-colors"
            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)"
        >
    </div>

    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Botón secundario — URL</label>
        <input
            wire:model="editingSettings.cta2_url"
            type="text"
            placeholder="#servicios"
            class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none transition-colors"
            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)"
        >
    </div>

    <div class="h-px" style="background:rgba(255,255,255,0.06)"></div>

    {{-- Layout --}}
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(255,255,255,0.35)">Disposición</label>
        <div class="grid grid-cols-3 gap-1.5">
            @foreach(['centered' => 'Centrado', 'split' => 'Dividido', 'fullscreen' => 'Full'] as $val => $lbl)
            <button
                wire:click="$set('editingSettings.layout', '{{ $val }}')"
                class="py-2 rounded-lg text-[11px] font-semibold transition-all"
                style="border:1px solid {{ ($settings['layout'] ?? 'centered') === $val ? 'rgba(124,111,247,0.6)' : 'rgba(255,255,255,0.06)' }};
                       background:{{ ($settings['layout'] ?? 'centered') === $val ? 'rgba(124,111,247,0.08)' : 'transparent' }};
                       color:{{ ($settings['layout'] ?? 'centered') === $val ? '#9d93ff' : 'rgba(255,255,255,0.4)' }}"
            >{{ $lbl }}</button>
            @endforeach
        </div>
    </div>

    {{-- Imagen (para layout split) --}}
    @if(($settings['layout'] ?? 'centered') === 'split')
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">URL de imagen</label>
        <input
            wire:model="editingSettings.image_url"
            type="text"
            placeholder="https://..."
            class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none transition-colors"
            style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)"
        >
    </div>
    @endif

</div>