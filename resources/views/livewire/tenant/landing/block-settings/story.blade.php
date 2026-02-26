{{-- block-settings/story.blade.php --}}
<div class="space-y-4">
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Título</label>
        <input wire:model="editingSettings.title" type="text" placeholder="Nuestra historia"
               class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none">
    </div>
    <div>
        <div class="flex items-center justify-between mb-2">
            <label class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,0.35)">Hitos del timeline</label>
            <button wire:click="$set('editingSettings.milestones', array_merge($editingSettings['milestones'] ?? [], [['year'=>date('Y'),'event'=>'']]))"
                    class="text-[10px] font-bold px-2 py-1 rounded-lg"
                    style="background:rgba(124,111,247,0.1); color:#9d93ff; border:1px solid rgba(124,111,247,0.2)">
                + Hito
            </button>
        </div>
        @foreach($settings['milestones'] ?? [] as $i => $m)
        <div class="flex gap-2 mb-1.5">
            <input wire:model="editingSettings.milestones.{{ $i }}.year" type="text" placeholder="Año"
                   class="w-16 px-2 py-1.5 rounded-lg text-xs text-white placeholder-white/20 focus:outline-none text-center"
                   style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
            <input wire:model="editingSettings.milestones.{{ $i }}.event" type="text" placeholder="Descripción del hito"
                   class="flex-1 px-3 py-1.5 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
                   style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
            <button wire:click="$set('editingSettings.milestones', array_values(array_filter($editingSettings['milestones'], fn($k) => $k !== {{ $i }}, ARRAY_FILTER_USE_KEY)))"
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