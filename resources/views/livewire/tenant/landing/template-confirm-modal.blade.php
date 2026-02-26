<div>
    @if($show)
    <!-- Modal Backdrop -->
    <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4 transition-opacity" 
         wire:click="cancel">
        
        <!-- Alert Modal Content -->
        <div class="bg-primary-100 border border-primary-200 text-foreground rounded-lg p-4 dark:bg-primary-500/20 dark:border-primary-900 w-full max-w-sm shadow-xl" 
             role="alert" 
             tabindex="-1" 
             aria-labelledby="hs-actions-label"
             wire:click.stop>
             
            <div class="flex">
                <div class="shrink-0">
                    <svg class="shrink-0 size-4 mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                        <path d="M12 9v4"/>
                        <path d="M12 17h.01"/>
                    </svg>
                </div>
                <div class="ms-3">
                    <h3 id="hs-actions-label" class="font-semibold" style="color: var(--text);">
                        ¿Cambiar plantilla base?
                    </h3>
                    <div class="mt-2 text-sm text-muted-foreground-2" style="color: var(--text-2);">
                        Esta acción reemplazará todas las secciones actuales de tu landing page con las de la nueva plantilla. No podrás deshacer esta acción.
                    </div>
                    <div class="mt-4">
                        <div class="flex gap-x-3">
                            <button type="button" wire:click="cancel" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-primary hover:text-primary-hover focus:outline-hidden focus:text-primary-focus disabled:opacity-50 disabled:pointer-events-none" style="color: var(--text-3);">
                                Cancelar
                            </button>
                            <button type="button" wire:click="confirm" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-primary hover:text-primary-hover focus:outline-hidden focus:text-primary-focus disabled:opacity-50 disabled:pointer-events-none" style="color: var(--primary);">
                                Cambiar plantilla
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Alert -->
        
    </div>
    @endif
</div>