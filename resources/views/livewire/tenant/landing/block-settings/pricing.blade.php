{{-- block-settings/pricing.blade.php --}}
<div class="space-y-4">

    <div class="grid grid-cols-2 gap-2">
        <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Título</label>
            <input wire:model="editingSettings.title" type="text" placeholder="Planes y precios"
                   class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                   style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
        </div>
        <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Moneda</label>
            <select wire:model="editingSettings.currency"
                    class="w-full px-3 py-2 rounded-lg text-sm text-white focus:outline-none"
                    style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
                <option value="$">USD ($)</option>
                <option value="€">EUR (€)</option>
                <option value="B/.">PAB (B/.)</option>
                <option value="MXN$">MXN ($)</option>
                <option value="COP$">COP ($)</option>
            </select>
        </div>
    </div>

    <div class="h-px" style="background:rgba(255,255,255,0.06)"></div>

    <div>
        <div class="flex items-center justify-between mb-2">
            <label class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,0.35)">Planes</label>
            <button wire:click="$set('editingSettings.plans', array_merge($editingSettings['plans'] ?? [], [['name'=>'Nuevo Plan','price'=>'0','period'=>'mes','featured'=>false,'cta'=>'Empezar','features'=>['Feature 1']]]))"
                    class="text-[10px] font-bold px-2 py-1 rounded-lg"
                    style="background:rgba(124,111,247,0.1); color:#9d93ff; border:1px solid rgba(124,111,247,0.2)">
                + Plan
            </button>
        </div>

        @foreach($settings['plans'] ?? [] as $i => $plan)
        <div class="mb-3 p-3 rounded-xl {{ ($plan['featured'] ?? false) ? 'ring-1 ring-purple-500/30' : '' }}"
             style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.06)">

            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold" style="color:rgba(255,255,255,0.4)">Plan {{ $i + 1 }}</span>
                <div class="flex items-center gap-2">
                    <label class="flex items-center gap-1.5 cursor-pointer">
                        <input type="checkbox" class="sr-only peer"
                               wire:click="$set('editingSettings.plans.{{ $i }}.featured', !($editingSettings['plans'][{{ $i }}]['featured'] ?? false))"
                               {{ ($plan['featured'] ?? false) ? 'checked' : '' }}>
                        <div class="w-7 h-3.5 rounded-full transition-colors peer-checked:bg-purple-500" style="background:rgba(255,255,255,0.1)"></div>
                        <div class="text-[10px]" style="color:rgba(255,255,255,0.4)">Destacado</div>
                    </label>
                    <button wire:click="$set('editingSettings.plans', array_values(array_filter($editingSettings['plans'], fn($k) => $k !== {{ $i }}, ARRAY_FILTER_USE_KEY)))"
                            class="size-6 flex items-center justify-center rounded"
                            style="color:rgba(255,255,255,0.2)"
                            onmouseover="this.style.color='#fca5a5'"
                            onmouseout="this.style.color='rgba(255,255,255,0.2)'">
                        <svg class="size-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-2 mb-2">
                <input wire:model="editingSettings.plans.{{ $i }}.name" type="text" placeholder="Nombre"
                       class="col-span-1 px-2 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                       style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
                <input wire:model="editingSettings.plans.{{ $i }}.price" type="text" placeholder="Precio"
                       class="px-2 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                       style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
                <input wire:model="editingSettings.plans.{{ $i }}.period" type="text" placeholder="mes/año"
                       class="px-2 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                       style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
            </div>

            <input wire:model="editingSettings.plans.{{ $i }}.cta" type="text" placeholder="Texto del botón"
                   class="w-full mb-2 px-3 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                   style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">

            {{-- Features --}}
            <div class="space-y-1">
                @foreach($plan['features'] ?? [] as $fi => $feature)
                <div class="flex gap-2">
                    <input wire:model="editingSettings.plans.{{ $i }}.features.{{ $fi }}" type="text"
                           placeholder="Característica..."
                           class="flex-1 px-2 py-1 rounded-lg text-xs text-white placeholder-white/20 focus:outline-none"
                           style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.06)">
                    <button wire:click="$set('editingSettings.plans.{{ $i }}.features', array_values(array_filter($editingSettings['plans'][{{ $i }}]['features'], fn($k) => $k !== {{ $fi }}, ARRAY_FILTER_USE_KEY)))"
                            class="size-6 flex items-center justify-center rounded text-[10px]"
                            style="color:rgba(255,255,255,0.2)"
                            onmouseover="this.style.color='#fca5a5'"
                            onmouseout="this.style.color='rgba(255,255,255,0.2)'">✕</button>
                </div>
                @endforeach
                <button wire:click="$set('editingSettings.plans.{{ $i }}.features', array_merge($editingSettings['plans'][{{ $i }}]['features'] ?? [], ['']))"
                        class="text-[10px] font-semibold w-full py-1 rounded-lg transition-all"
                        style="color:rgba(255,255,255,0.3); border:1px dashed rgba(255,255,255,0.1)">
                    + Feature
                </button>
            </div>
        </div>
        @endforeach
    </div>

</div>