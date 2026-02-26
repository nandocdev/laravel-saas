{{-- block-settings/cta.blade.php --}}
<div class="space-y-4">

    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Titular</label>
        <textarea wire:model="editingSettings.title" rows="2" placeholder="¿Listo para empezar?"
                  class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none resize-none"
                  style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)"></textarea>
    </div>

    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Subtítulo</label>
        <input wire:model="editingSettings.subtitle" type="text" placeholder="Únete a cientos de clientes satisfechos"
               class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
               style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
    </div>

    <div class="grid grid-cols-2 gap-2">
        <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Texto botón</label>
            <input wire:model="editingSettings.cta_text" type="text" placeholder="Comenzar ahora"
                   class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                   style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
        </div>
        <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">URL botón</label>
            <input wire:model="editingSettings.cta_url" type="text" placeholder="#contacto"
                   class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                   style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
        </div>
    </div>

    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(255,255,255,0.35)">Estilo visual</label>
        <div class="grid grid-cols-2 gap-1.5">
            @foreach(['primary-band' => 'Banda color', 'urgent' => 'Urgente', 'soft' => 'Suave', 'promo' => 'Promoción'] as $val => $lbl)
            <button wire:click="$set('editingSettings.style', '{{ $val }}')"
                    class="py-2 rounded-lg text-[11px] font-semibold transition-all"
                    style="border:1px solid {{ ($settings['style'] ?? 'primary-band') === $val ? 'rgba(124,111,247,0.6)' : 'rgba(255,255,255,0.06)' }};
                           background:{{ ($settings['style'] ?? 'primary-band') === $val ? 'rgba(124,111,247,0.08)' : 'transparent' }};
                           color:{{ ($settings['style'] ?? 'primary-band') === $val ? '#9d93ff' : 'rgba(255,255,255,0.4)' }}"
            >{{ $lbl }}</button>
            @endforeach
        </div>
    </div>

</div>