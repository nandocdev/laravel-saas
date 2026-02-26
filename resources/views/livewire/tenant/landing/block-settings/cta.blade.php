{{-- block-settings/cta.blade.php --}}
<div class="space-y-4">

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Titular</label>
        <textarea wire:model="editingSettings.title" rows="2" placeholder="¿Listo para empezar?"
                  class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none"></textarea>
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Subtítulo</label>
        <input wire:model="editingSettings.subtitle" type="text" placeholder="Únete a cientos de clientes satisfechos"
               class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none">
    </div>

    <div class="grid grid-cols-2 gap-2">
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Texto botón</label>
            <input wire:model="editingSettings.cta_text" type="text" placeholder="Comenzar ahora"
                   class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none">
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">URL botón</label>
            <input wire:model="editingSettings.cta_url" type="text" placeholder="#contacto"
                   class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none">
        </div>
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Estilo visual</label>
        <div class="grid grid-cols-2 gap-1.5">
            @foreach(['primary-band' => 'Banda color', 'urgent' => 'Urgente', 'soft' => 'Suave', 'promo' => 'Promoción'] as $val => $lbl)
            <button wire:click="$set('editingSettings.style', '{{ $val }}')"
                    class="py-2 rounded-lg text-[11px] font-semibold transition-all"
                    class="py-2 text-xs font-semibold rounded-lg border border-transparent {{ ($settings['style'] ?? 'primary-band') === $val ? 'bg-blue-50 text-blue-600 border-blue-200' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }} transition-colors shadow-sm focus:outline-none"
            >{{ $lbl }}</button>
            @endforeach
        </div>
    </div>

</div>