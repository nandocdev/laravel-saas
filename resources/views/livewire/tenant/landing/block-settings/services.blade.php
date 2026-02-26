{{-- block-settings/services.blade.php --}}
<div class="space-y-4">

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Título de sección</label>
        <input wire:model="editingSettings.title" type="text" placeholder="Lo que ofrecemos"
               class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none">
    </div>

    {{-- Layout --}}
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Disposición</label>
        <div class="grid grid-cols-2 gap-1.5">
            @foreach(['cards-3' => '3 Columnas', 'cards-2' => '2 Columnas', 'bullets' => 'Lista', 'featured' => 'Destacado'] as $val => $lbl)
            <button wire:click="$set('editingSettings.layout', '{{ $val }}')"
                    class="py-2 rounded-lg text-[11px] font-semibold transition-all"
                    class="py-2 text-xs font-semibold rounded-lg border border-transparent {{ ($settings['layout'] ?? 'cards-3') === $val ? 'bg-blue-50 text-blue-600 border-blue-200' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }} transition-colors shadow-sm focus:outline-none"
            >{{ $lbl }}</button>
            @endforeach
        </div>
    </div>

    <div class="h-px my-5 bg-gray-200"></div>

    {{-- Items dinámicos --}}
    <div>
        <div class="flex items-center justify-between mb-2">
            <label class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,0.35)">Servicios</label>
            <button
                wire:click="$set('editingSettings.items', array_merge($editingSettings['items'] ?? [], [['icon'=>'📦','title'=>'Nuevo servicio','description'=>'']]))"
                class="text-[10px] font-bold px-2 py-1 rounded-lg transition-all"
                style="background:rgba(124,111,247,0.1); color:#9d93ff; border:1px solid rgba(124,111,247,0.2)">
                + Añadir
            </button>
        </div>

        @foreach($settings['items'] ?? [] as $i => $item)
        <div class="mb-2 p-3 rounded-xl" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.06)">
            <div class="flex gap-2 mb-2">
                <input wire:model="editingSettings.items.{{ $i }}.icon" type="text" placeholder="🛡️"
                       class="w-12 px-2 py-1.5 rounded-lg text-center text-base focus:outline-none"
                       style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
                <input wire:model="editingSettings.items.{{ $i }}.title" type="text" placeholder="Nombre del servicio"
                       class="flex-1 px-3 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                       style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
                <button wire:click="$set('editingSettings.items', array_values(array_filter($editingSettings['items'], fn($k) => $k !== {{ $i }}, ARRAY_FILTER_USE_KEY)))"
                        class="size-8 flex items-center justify-center rounded-lg flex-shrink-0 transition-all"
                        style="color:rgba(255,255,255,0.25)"
                        onmouseover="this.style.color='#fca5a5';this.style.background='rgba(239,68,68,0.1)'"
                        onmouseout="this.style.color='rgba(255,255,255,0.25)';this.style.background='transparent'">
                    <svg class="size-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <textarea wire:model="editingSettings.items.{{ $i }}.description" rows="2" placeholder="Descripción del servicio..."
                      class="w-full px-3 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none resize-none"
                      style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)"></textarea>
        </div>
        @endforeach
    </div>

</div>