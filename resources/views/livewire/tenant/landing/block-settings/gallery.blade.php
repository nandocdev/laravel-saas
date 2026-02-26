{{-- block-settings/gallery.blade.php --}}
<div class="space-y-4">
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Título (opcional)</label>
        <input wire:model="editingSettings.title" type="text" placeholder="Galería"
               class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
               style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
    </div>
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(255,255,255,0.35)">Disposición</label>
        <div class="grid grid-cols-2 gap-1.5">
            @foreach(['masonry' => 'Masonry', 'grid-2' => '2 cols', 'grid-3' => '3 cols', 'grid-4' => '4 cols'] as $val => $lbl)
            <button wire:click="$set('editingSettings.layout', '{{ $val }}')"
                    class="py-2 rounded-lg text-[11px] font-semibold transition-all"
                    style="border:1px solid {{ ($settings['layout'] ?? 'grid-3') === $val ? 'rgba(124,111,247,0.6)' : 'rgba(255,255,255,0.06)' }};
                           background:{{ ($settings['layout'] ?? 'grid-3') === $val ? 'rgba(124,111,247,0.08)' : 'transparent' }};
                           color:{{ ($settings['layout'] ?? 'grid-3') === $val ? '#9d93ff' : 'rgba(255,255,255,0.4)' }}"
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