{{--
    resources/views/livewire/landing-builder/block-settings/hero.blade.php
    Panel de edición del bloque Hero.
    $settings es wire:model-able vía $editingSettings del componente padre.
--}}

@php $s = fn($key, $default = '') => $settings[$key] ?? $default; @endphp

<div class="space-y-4">

    {{-- Badge --}}
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Badge superior</label>
        <input
            wire:model="editingSettings.badge"
            type="text"
            placeholder="✦ Disponible ahora"
            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none"
        >
        <p class="text-xs text-gray-400 mt-1">Deja en blanco para ocultarlo.</p>
    </div>

    {{-- Headline --}}
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Titular principal</label>
        <textarea
            wire:model="editingSettings.headline"
            rows="2"
            placeholder="El servicio que tu negocio necesita"
            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none"
        ></textarea>
    </div>

    {{-- Subheadline --}}
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Subtítulo</label>
        <textarea
            wire:model="editingSettings.subheadline"
            rows="2"
            placeholder="Profesional · Confiable · Siempre disponible"
            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none"
        ></textarea>
    </div>

    <div class="h-px my-5 bg-gray-200"></div>

    {{-- CTA Principal --}}
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Botón principal — texto</label>
        <input
            wire:model="editingSettings.cta_text"
            type="text"
            placeholder="Comenzar ahora"
            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none"
        >
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Botón principal — URL</label>
        <input
            wire:model="editingSettings.cta_url"
            type="text"
            placeholder="#contacto"
            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none"
        >
    </div>

    <div class="h-px my-5 bg-gray-200"></div>

    {{-- CTA Secundario --}}
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Botón secundario — texto</label>
        <input
            wire:model="editingSettings.cta2_text"
            type="text"
            placeholder="Ver más (opcional)"
            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none"
        >
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Botón secundario — URL</label>
        <input
            wire:model="editingSettings.cta2_url"
            type="text"
            placeholder="#servicios"
            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none"
        >
    </div>

    <div class="h-px my-5 bg-gray-200"></div>

    {{-- Layout --}}
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Disposición</label>
        <div class="grid grid-cols-3 gap-1.5">
            @foreach(['centered' => 'Centrado', 'split' => 'Dividido', 'fullscreen' => 'Full'] as $val => $lbl)
            <button
                wire:click="$set('editingSettings.layout', '{{ $val }}')"
                class="py-2 text-xs font-semibold rounded-lg border border-transparent {{ ($settings['layout'] ?? 'centered') === $val ? 'bg-blue-50 text-blue-600 border-blue-200' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }} transition-colors shadow-sm focus:outline-none"
            >{{ $lbl }}</button>
            @endforeach
        </div>
    </div>

    {{-- Imagen (para layout split) --}}
    @if(($settings['layout'] ?? 'centered') === 'split')
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">URL de imagen</label>
        <input
            wire:model="editingSettings.image_url"
            type="text"
            placeholder="https://..."
            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none"
        >
    </div>
    @endif

</div>