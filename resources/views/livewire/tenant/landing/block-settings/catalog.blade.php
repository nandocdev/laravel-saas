{{-- block-settings/catalog.blade.php --}}
<div class="space-y-4">
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Título</label>
        <input wire:model="editingSettings.title" type="text" placeholder="Nuestros productos"
               class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
               style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
    </div>
    <label class="flex items-center gap-3 cursor-pointer">
        <div class="relative">
            <input type="checkbox" class="sr-only peer"
                   wire:model="editingSettings.show_price"
                   {{ ($settings['show_price'] ?? true) ? 'checked' : '' }}>
            <div class="w-9 h-5 rounded-full peer-checked:bg-emerald-500 transition-colors" style="background:rgba(255,255,255,0.1)"></div>
            <div class="absolute left-0.5 top-0.5 size-4 rounded-full bg-white shadow transition-transform peer-checked:translate-x-4"></div>
        </div>
        <span class="text-xs font-semibold text-white">Mostrar precios</span>
    </label>
    <div class="h-px" style="background:rgba(255,255,255,0.06)"></div>
    <div>
        <div class="flex items-center justify-between mb-2">
            <label class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,0.35)">Productos</label>
            <button wire:click="$set('editingSettings.items', array_merge($editingSettings['items'] ?? [], [['name'=>'Nuevo producto','price'=>'0','category'=>'','image_url'=>null,'description'=>'']]))"
                    class="text-[10px] font-bold px-2 py-1 rounded-lg"
                    style="background:rgba(124,111,247,0.1); color:#9d93ff; border:1px solid rgba(124,111,247,0.2)">
                + Producto
            </button>
        </div>
        @foreach($settings['items'] ?? [] as $i => $item)
        <div class="mb-2 p-3 rounded-xl" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.06)">
            <div class="flex gap-2 mb-2">
                <input wire:model="editingSettings.items.{{ $i }}.name" type="text" placeholder="Nombre producto"
                       class="flex-1 px-3 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                       style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
                <input wire:model="editingSettings.items.{{ $i }}.price" type="text" placeholder="Precio"
                       class="w-20 px-2 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none text-center"
                       style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
                <button wire:click="$set('editingSettings.items', array_values(array_filter($editingSettings['items'], fn($k) => $k !== {{ $i }}, ARRAY_FILTER_USE_KEY)))"
                        class="size-8 flex items-center justify-center rounded-lg"
                        style="color:rgba(255,255,255,0.2)"
                        onmouseover="this.style.color='#fca5a5'"
                        onmouseout="this.style.color='rgba(255,255,255,0.2)'">
                    <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <input wire:model="editingSettings.items.{{ $i }}.image_url" type="text" placeholder="URL imagen (opcional)"
                   class="w-full px-3 py-1.5 rounded-lg text-xs text-white placeholder-white/20 focus:outline-none"
                   style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
        </div>
        @endforeach
    </div>
</div>