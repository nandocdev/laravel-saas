{{-- block-settings/about.blade.php --}}
<div class="space-y-4">
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Título</label>
        <input wire:model="editingSettings.title" type="text" placeholder="Sobre nosotros"
               class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
               style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
    </div>
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Texto</label>
        <textarea wire:model="editingSettings.body" rows="5" placeholder="Descripción de tu empresa..."
                  class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none resize-none"
                  style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)"></textarea>
    </div>
    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">URL de imagen (opcional)</label>
        <input wire:model="editingSettings.image_url" type="text" placeholder="https://..."
               class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
               style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
    </div>
</div>