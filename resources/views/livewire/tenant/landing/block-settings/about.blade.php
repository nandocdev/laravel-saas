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
        <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Imagen (opcional)</label>
        
        <div class="max-w-sm w-full space-y-3">
            <label class="block">
                <span class="sr-only">Elegir imagen</span>
                <input type="file" wire:model="imageUpload" accept="image/*" class="block w-full text-sm text-gray-500 focus:outline-hidden
                file:me-4 file:py-2 file:px-4
                file:rounded-lg file:border-0
                file:text-sm file:font-semibold
                file:cursor-pointer
                file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100
                file:disabled:opacity-50 file:disabled:pointer-events-none" style="file:background:var(--primary);file:color:white;">
            </label>
        </div>

        <div wire:loading wire:target="imageUpload" class="mt-2 text-xs text-indigo-500 font-medium">Subiendo...</div>

        @if ($imageUpload)
            <div class="mt-2 text-sm text-green-600 font-medium tracking-tight">
                ✓ Nueva imagen lista para guardar
            </div>
        @elseif(!empty($editingSettings['image_url']))
            <div class="mt-3 bg-gray-50 p-2 rounded-lg border border-gray-100 inline-block">
                <p class="text-[10px] text-gray-400 font-medium uppercase mb-1">Imagen actual</p>
                <img src="{{ $editingSettings['image_url'] }}" alt="Imagen actual" class="max-h-16 w-auto rounded shadow-sm">
            </div>
        @endif
    </div>
</div>