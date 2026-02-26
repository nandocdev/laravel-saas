{{-- block-settings/gallery.blade.php --}}
<div class="space-y-4">
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Título (opcional)</label>
        <input wire:model="editingSettings.title" type="text" placeholder="Galería"
               class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none">
    </div>
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Disposición</label>
        <div class="grid grid-cols-2 gap-1.5">
            @foreach(['masonry' => 'Masonry', 'grid-2' => '2 cols', 'grid-3' => '3 cols', 'grid-4' => '4 cols'] as $val => $lbl)
            <button wire:click="$set('editingSettings.layout', '{{ $val }}')"
                    class="py-2 rounded-lg text-[11px] font-semibold transition-all"
                    class="py-2 text-xs font-semibold rounded-lg border border-transparent {{ ($settings['layout'] ?? 'grid-3') === $val ? 'bg-blue-50 text-blue-600 border-blue-200' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }} transition-colors shadow-sm focus:outline-none"
            >{{ $lbl }}</button>
            @endforeach
        </div>
    </div>
    <div>
        <div class="flex items-center justify-between mb-2">
            <label class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,0.35)">Imágenes</label>
            <button wire:click="$set('editingSettings.images', array_merge($editingSettings['images'] ?? [], [['url'=>'','alt'=>'']]))"
                    class="text-[10px] font-bold px-2 py-1 rounded-lg"
                    style="background:rgba(124,111,247,0.1); color:#9d93ff; border:1px solid rgba(124,111,247,0.2)">
                + Añadir
            </button>
        </div>
        @foreach($settings['images'] ?? [] as $i => $img)
        <div class="flex gap-2 mb-1.5">
            <input wire:model="editingSettings.images.{{ $i }}.url" type="text" placeholder="URL imagen"
                   class="flex-1 px-3 py-1.5 rounded-lg text-xs text-white placeholder-white/20 focus:outline-none"
                   style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
            <input wire:model="editingSettings.images.{{ $i }}.alt" type="text" placeholder="Alt"
                   class="w-20 px-2 py-1.5 rounded-lg text-xs text-white placeholder-white/20 focus:outline-none"
                   style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
            <button wire:click="$set('editingSettings.images', array_values(array_filter($editingSettings['images'], fn($k) => $k !== {{ $i }}, ARRAY_FILTER_USE_KEY)))"
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