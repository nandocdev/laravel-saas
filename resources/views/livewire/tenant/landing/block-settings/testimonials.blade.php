{{-- block-settings/testimonials.blade.php --}}
<div class="space-y-4">

    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Título</label>
        <input wire:model="editingSettings.title" type="text" placeholder="Lo que dicen nuestros clientes"
               class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
               style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
    </div>

    {{-- Layout --}}
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(255,255,255,0.35)">Disposición</label>
        <div class="grid grid-cols-3 gap-1.5">
            @foreach(['grid' => 'Cuadrícula', 'slider' => 'Slider', 'featured' => 'Destacado'] as $val => $lbl)
            <button wire:click="$set('editingSettings.layout', '{{ $val }}')"
                    class="py-2 rounded-lg text-[11px] font-semibold transition-all"
                    style="border:1px solid {{ ($settings['layout'] ?? 'grid') === $val ? 'rgba(124,111,247,0.6)' : 'rgba(255,255,255,0.06)' }};
                           background:{{ ($settings['layout'] ?? 'grid') === $val ? 'rgba(124,111,247,0.08)' : 'transparent' }};
                           color:{{ ($settings['layout'] ?? 'grid') === $val ? '#9d93ff' : 'rgba(255,255,255,0.4)' }}"
            >{{ $lbl }}</button>
            @endforeach
        </div>
    </div>

    <div class="h-px" style="background:rgba(255,255,255,0.06)"></div>

    {{-- Items --}}
    <div>
        <div class="flex items-center justify-between mb-2">
            <label class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,0.35)">Testimonios</label>
            <button wire:click="$set('editingSettings.items', array_merge($editingSettings['items'] ?? [], [['text'=>'','author'=>'','role'=>'','rating'=>5]]))"
                    class="text-[10px] font-bold px-2 py-1 rounded-lg"
                    style="background:rgba(124,111,247,0.1); color:#9d93ff; border:1px solid rgba(124,111,247,0.2)">
                + Añadir
            </button>
        </div>

        @foreach($settings['items'] ?? [] as $i => $item)
        <div class="mb-3 p-3 rounded-xl" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.06)">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold" style="color:rgba(255,255,255,0.4)">Testimonio {{ $i + 1 }}</span>
                <div class="flex items-center gap-1">
                    {{-- Stars --}}
                    @for($s = 1; $s <= 5; $s++)
                        <button wire:click="$set('editingSettings.items.{{ $i }}.rating', {{ $s }})"
                                style="color:{{ ($item['rating'] ?? 5) >= $s ? '#f59e0b' : 'rgba(255,255,255,0.15)' }};
                                       font-size:14px; background:none; border:none; cursor:pointer; padding:0;">★</button>
                    @endfor
                    <button wire:click="$set('editingSettings.items', array_values(array_filter($editingSettings['items'], fn($k) => $k !== {{ $i }}, ARRAY_FILTER_USE_KEY)))"
                            class="size-6 flex items-center justify-center rounded ml-1"
                            style="color:rgba(255,255,255,0.2)"
                            onmouseover="this.style.color='#fca5a5'"
                            onmouseout="this.style.color='rgba(255,255,255,0.2)'">
                        <svg class="size-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
            <textarea wire:model="editingSettings.items.{{ $i }}.text" rows="2" placeholder="El testimonio del cliente..."
                      class="w-full px-3 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none resize-none mb-2"
                      style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)"></textarea>
            <div class="grid grid-cols-2 gap-2">
                <input wire:model="editingSettings.items.{{ $i }}.author" type="text" placeholder="Nombre"
                       class="px-3 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                       style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
                <input wire:model="editingSettings.items.{{ $i }}.role" type="text" placeholder="Cargo · Empresa"
                       class="px-3 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                       style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
            </div>
        </div>
        @endforeach
    </div>

</div>