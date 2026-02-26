{{-- block-settings/about.blade.php --}}
<div class="space-y-4">
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Título</label>
        <input wire:model="editingSettings.title" type="text" placeholder="Sobre nosotros"
               class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none">
    </div>
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Texto</label>
        <textarea wire:model="editingSettings.body" rows="5" placeholder="Descripción de tu empresa..."
                  class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none"></textarea>
    </div>
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">URL de imagen (opcional)</label>
        <input wire:model="editingSettings.image_url" type="text" placeholder="https://..."
               class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:pointer-events-none">
    </div>
</div>