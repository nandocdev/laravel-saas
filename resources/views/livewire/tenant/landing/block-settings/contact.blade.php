{{-- block-settings/contact.blade.php --}}
<div class="space-y-4">

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Título</label>
        <input wire:model="editingSettings.title" type="text" placeholder="Contáctanos"
               class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none">
    </div>

    <div class="h-px my-5 bg-gray-200"></div>

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">📧 Email</label>
        <input wire:model="editingSettings.email" type="email" placeholder="hola@empresa.com"
               class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none">
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">📞 Teléfono</label>
        <input wire:model="editingSettings.phone" type="tel" placeholder="+507 6000-0000"
               class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none">
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">📍 Dirección</label>
        <input wire:model="editingSettings.address" type="text" placeholder="Ciudad de Panamá, Panamá"
               class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none">
    </div>

    <div class="h-px my-5 bg-gray-200"></div>

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