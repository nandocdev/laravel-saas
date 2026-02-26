{{-- block-settings/trust.blade.php --}}
<div class="space-y-4">
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Título / leyenda (opcional)</label>
        <input wire:model="editingSettings.title" type="text" placeholder="Empresas que confían en nosotros"
               class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
               style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
    </div>
    <div>
        <div class="flex items-center justify-between mb-2">
            <label class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,0.35)">Logos / marcas</label>
            <button wire:click="$set('editingSettings.items', array_merge($editingSettings['items'] ?? [], [['icon'=>'🏢','title'=>'Empresa']]))"
                    class="text-[10px] font-bold px-2 py-1 rounded-lg"
                    style="background:rgba(124,111,247,0.1); color:#9d93ff; border:1px solid rgba(124,111,247,0.2)">
                + Añadir
            </button>
        </div>
        <p class="text-[10px] mb-2" style="color:rgba(255,255,255,0.25)">Usa un emoji como logo, o deja vacío si usas image_url.</p>
        @foreach($settings['items'] ?? [] as $i => $item)
        <div class="flex gap-2 mb-1.5">
            <input wire:model="editingSettings.items.{{ $i }}.icon" type="text" placeholder="🏢"
                   class="w-12 px-2 py-1.5 rounded-lg text-center text-base focus:outline-none"
                   style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
            <input wire:model="editingSettings.items.{{ $i }}.title" type="text" placeholder="Nombre empresa"
                   class="flex-1 px-3 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                   style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
            <button wire:click="$set('editingSettings.items', array_values(array_filter($editingSettings['items'], fn($k) => $k !== {{ $i }}, ARRAY_FILTER_USE_KEY)))"
                    class="size-7 flex items-center justify-center rounded-lg"
                    style="color:rgba(255,255,255,0.2)"
                    onmouseover="this.style.color='#fca5a5'"
                    onmouseout="this.style.color='rgba(255,255,255,0.2)'">
                <svg class="size-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
        </div>
        @endforeach
    </div>
</div>