{{-- block-settings/contact.blade.php --}}
<div class="space-y-4">

    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">Título</label>
        <input wire:model="editingSettings.title" type="text" placeholder="Contáctanos"
               class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
               style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
    </div>

    <div class="h-px" style="background:rgba(255,255,255,0.06)"></div>

    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">📧 Email</label>
        <input wire:model="editingSettings.email" type="email" placeholder="hola@empresa.com"
               class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
               style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
    </div>

    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">📞 Teléfono</label>
        <input wire:model="editingSettings.phone" type="tel" placeholder="+507 6000-0000"
               class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
               style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
    </div>

    <div>
        <label class="block text-[10px] font-bold uppercase tracking-widest mb-1.5" style="color:rgba(255,255,255,0.35)">📍 Dirección</label>
        <input wire:model="editingSettings.address" type="text" placeholder="Ciudad de Panamá, Panamá"
               class="w-full px-3 py-2 rounded-lg text-sm text-white placeholder-white/20 focus:outline-none"
               style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09)">
    </div>

    <div class="h-px" style="background:rgba(255,255,255,0.06)"></div>

    <label class="flex items-center gap-3 cursor-pointer">
        <div class="relative">
            <input type="checkbox" class="sr-only peer"
                   wire:model="editingSettings.show_map"
                   {{ ($settings['show_map'] ?? false) ? 'checked' : '' }}>
            <div class="w-9 h-5 rounded-full peer-checked:bg-emerald-500 transition-colors" style="background:rgba(255,255,255,0.1)"></div>
            <div class="absolute left-0.5 top-0.5 size-4 rounded-full bg-white shadow transition-transform peer-checked:translate-x-4"></div>
        </div>
        <div>
            <p class="text-xs font-semibold text-white">Mostrar mapa</p>
            <p class="text-[10px]" style="color:rgba(255,255,255,0.35)">Embebe un mapa de Google Maps</p>
        </div>
    </label>

</div>