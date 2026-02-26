<?php

namespace App\Livewire\Tenant\Landing;

use App\Models\LandingBlock;
use App\Models\TenantLanding;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * LandingBuilder
 *
 * Componente principal del editor visual de landing pages por tenant.
 * Gestiona: plantillas, bloques (orden, visibilidad, contenido) y estilos globales.
 *
 * Variables de BD → ver migration y sección "MAPA DE BD" al final del archivo.
 */

class LandingBuilder extends Component
{
    // ═══════════════════════════════════════════
    // ESTADO DE UI  (no persisten en BD)
    // ═══════════════════════════════════════════

    public string  $activeTab      = 'sections'; // template | sections | style
    public string  $viewport       = 'desktop';  // desktop | tablet | mobile
    public ?int    $selectedBlockId = null;
    public bool    $editPanelOpen  = false;
    public bool    $saving         = false;
    public ?string $activePicker   = null;        // primary | neutral | accent

    // ═══════════════════════════════════════════
    // MODELO PRINCIPAL
    // ═══════════════════════════════════════════

    public TenantLanding $landing;

    // ═══════════════════════════════════════════
    // PROPIEDADES BINDEADAS A BD
    // Tabla: tenant_landings
    // ═══════════════════════════════════════════

    /** tenant_landings.template_key — corporate|visual|conversion|storytelling|catalog|minimal */
    public string $templateKey = 'corporate';

    /** tenant_landings.status — draft|published */
    public string $status = 'draft';

    /** tenant_landings.primary_color — color hex del botón principal y marca */
    public string $colorPrimary = '#6366f1';

    /** tenant_landings.font_family — instrument|slab|sans|mono */
    public string $fontFamily = 'instrument';

    // ─── global_settings JSON (dentro de tenant_landings.global_settings) ───

    /** global_settings.site_name — nombre del sitio que aparece en navbar y footer */
    public string $siteName = 'MiEmpresa';

    /** global_settings.color_neutral — fondos, bordes, textos secundarios */
    public string $colorNeutral = '#e2e8f0';

    /** global_settings.color_accent — badges, highlights, detalles */
    public string $colorAccent = '#f97316';

    /** global_settings.bg_mode — light|soft|dark */
    public string $bgMode = 'light';

    // ═══════════════════════════════════════════
    // EDICIÓN DE BLOQUE (panel lateral)
    // ═══════════════════════════════════════════

    /** ID del LandingBlock que está siendo editado */
    public ?int $editingBlockId = null;

    /**
     * Copia mutable de landing_blocks.settings del bloque en edición.
     * Se persiste al pulsar "Guardar sección".
     */
    public array $editingSettings = [];

    // ═══════════════════════════════════════════
    // MOUNT
    // ═══════════════════════════════════════════

    public function mount(): void
    {
        $this->landing = TenantLanding::firstOrCreate(
            [], // scope del tenant ya aplicado por middleware
            [
                'template_key'    => 'corporate',
                'status'          => 'draft',
                'primary_color'   => '#6366f1',
                'font_family'     => 'instrument',
                'global_settings' => [
                    'site_name'     => 'MiEmpresa',
                    'color_neutral' => '#e2e8f0',
                    'color_accent'  => '#f97316',
                    'bg_mode'       => 'light',
                ],
            ]
        );

        // Inicializa con template por defecto si no hay bloques
        if ($this->landing->blocks()->count() === 0) {
            $this->landing->applyTemplate($this->landing->template_key);
            $this->landing->refresh();
        }

        $this->pullFromModel();
    }

    /**
     * Carga todas las propiedades desde el modelo a las props públicas.
     * Única fuente de verdad → BD.
     */
    private function pullFromModel(): void
    {
        $gs = $this->landing->global_settings ?? [];

        $this->templateKey   = $this->landing->template_key;
        $this->status        = $this->landing->status;
        $this->colorPrimary  = $this->landing->primary_color;
        $this->fontFamily    = $this->landing->font_family;
        $this->siteName      = $gs['site_name']     ?? 'MiEmpresa';
        $this->colorNeutral  = $gs['color_neutral']  ?? '#e2e8f0';
        $this->colorAccent   = $gs['color_accent']   ?? '#f97316';
        $this->bgMode        = $gs['bg_mode']        ?? 'light';
    }

    // ═══════════════════════════════════════════
    // COMPUTED
    // ═══════════════════════════════════════════

    #[Computed]
    public function blocks()
    {
        return $this->landing->blocks()->orderBy('order')->get();
    }

    #[Computed]
    public function editingBlock(): ?LandingBlock
    {
        return $this->editingBlockId ? LandingBlock::find($this->editingBlockId) : null;
    }

    #[Computed]
    public function availableTemplates(): array
    {
        return collect(config('landing_templates'))
            ->except(['block_labels', 'block_icons', 'available_blocks'])
            ->map(fn($t, $k) => array_merge($t, ['key' => $k]))
            ->values()
            ->toArray();
    }

    #[Computed]
    public function availableBlockTypes(): array
    {
        $labels = config('landing_templates.block_labels', []);
        $icons  = config('landing_templates.block_icons', []);
        $inUse  = $this->blocks->pluck('block_type')->toArray();

        return collect(config('landing_templates.available_blocks', []))
            ->map(fn($type) => [
                'type'   => $type,
                'label'  => $labels[$type] ?? ucfirst($type),
                'icon'   => $icons[$type]  ?? 'M4 6h16M4 12h16M4 18h16',
                'in_use' => in_array($type, $inUse),
            ])
            ->toArray();
    }

    // ═══════════════════════════════════════════
    // TAB: PLANTILLA
    // ═══════════════════════════════════════════

    public function selectTemplate(string $key): void
    {
        $this->landing->applyTemplate($key);
        $this->landing->refresh();
        $this->templateKey     = $key;
        $this->selectedBlockId = null;
        $this->editPanelOpen   = false;
        unset($this->blocks);

        $this->dispatch('notify', type: 'success', message: 'Plantilla aplicada.');
    }

    // ═══════════════════════════════════════════
    // TAB: SECCIONES — gestión de bloques
    // ═══════════════════════════════════════════

    public function toggleBlock(int $id): void
    {
        $block = LandingBlock::findOrFail($id);
        $block->update(['is_active' => !$block->is_active]);
        unset($this->blocks);
    }

    public function moveBlock(int $id, string $direction): void
    {
        $blocks = $this->landing->blocks()->orderBy('order')->get();
        $index  = $blocks->search(fn($b) => $b->id === $id);

        $swap = match($direction) {
            'up'    => $index > 0                    ? $blocks->get($index - 1) : null,
            'down'  => $index < $blocks->count() - 1 ? $blocks->get($index + 1) : null,
            default => null,
        };

        if (!$swap) return;

        [$blocks[$index]->order, $swap->order] = [$swap->order, $blocks[$index]->order];
        $blocks[$index]->save();
        $swap->save();
        unset($this->blocks);
    }

    /** Llamado desde JS/Alpine tras drag-and-drop. Recibe IDs en el nuevo orden. */
    public function reorderFromDrag(array $orderedIds): void
    {
        foreach ($orderedIds as $i => $id) {
            LandingBlock::where('id', $id)->update(['order' => $i]);
        }
        unset($this->blocks);
    }

    public function addBlock(string $blockType): void
    {
        $maxOrder = $this->landing->blocks()->max('order') ?? -1;

        LandingBlock::create([
            'tenant_landing_id' => $this->landing->id,
            'block_type'        => $blockType,
            'order'             => $maxOrder + 1,
            'is_active'         => true,
            'settings'          => $this->defaultSettingsFor($blockType),
        ]);

        $this->activeTab = 'sections';
        unset($this->blocks);
        $this->dispatch('notify', type: 'success', message: 'Sección añadida.');
    }

    public function deleteBlock(int $id): void
    {
        LandingBlock::findOrFail($id)->delete();

        if ($this->selectedBlockId === $id || $this->editingBlockId === $id) {
            $this->selectedBlockId = null;
            $this->editingBlockId  = null;
            $this->editingSettings = [];
            $this->editPanelOpen   = false;
        }

        // Renumerar
        $this->landing->blocks()->orderBy('order')->get()
            ->each(fn($b, $i) => $b->update(['order' => $i]));

        unset($this->blocks);
        $this->dispatch('notify', type: 'info', message: 'Sección eliminada.');
    }

    // ═══════════════════════════════════════════
    // PANEL DE EDICIÓN DE BLOQUE
    // ═══════════════════════════════════════════

    public function openEditPanel(int $id): void
    {
        $block = LandingBlock::findOrFail($id);
        $this->editingBlockId  = $id;
        $this->editingSettings = $block->settings ?? [];
        $this->editPanelOpen   = true;
        $this->selectedBlockId = $id;
    }

    public function closeEditPanel(): void
    {
        $this->editPanelOpen   = false;
        $this->editingBlockId  = null;
        $this->editingSettings = [];
    }

    /** Persiste los settings del bloque en edición a la BD. */
    public function saveEditingBlock(): void
    {
        if (!$this->editingBlockId) return;

        LandingBlock::findOrFail($this->editingBlockId)
            ->update(['settings' => $this->editingSettings]);

        unset($this->blocks);
        $this->dispatch('notify', type: 'success', message: 'Sección guardada.');
    }

    // ═══════════════════════════════════════════
    // TAB: ESTILO — colores, tipografía, fondo
    // ═══════════════════════════════════════════

    /** Aplica paleta predefinida sin persistir (requiere saveStyle o saveAll). */
    public function applyPalette(string $primary, string $neutral, string $accent): void
    {
        $this->colorPrimary = $primary;
        $this->colorNeutral = $neutral;
        $this->colorAccent  = $accent;
    }

    /** Persiste todo el estilo global a BD. */
    public function saveStyle(): void
    {
        $gs = array_merge($this->landing->global_settings ?? [], [
            'site_name'     => $this->siteName,
            'color_neutral' => $this->colorNeutral,
            'color_accent'  => $this->colorAccent,
            'bg_mode'       => $this->bgMode,
        ]);

        $this->landing->update([
            'primary_color'   => $this->colorPrimary,
            'font_family'     => $this->fontFamily,
            'global_settings' => $gs,
        ]);
    }

    // ═══════════════════════════════════════════
    // PUBLICAR / DESPUBLICAR
    // ═══════════════════════════════════════════

    public function togglePublish(): void
    {
        $newStatus = $this->status === 'published' ? 'draft' : 'published';
        $this->landing->update(['status' => $newStatus]);
        $this->status = $newStatus;

        $this->dispatch('notify',
            type: 'success',
            message: $newStatus === 'published' ? '¡Landing publicada!' : 'Guardada como borrador.'
        );
    }

    // ═══════════════════════════════════════════
    // GUARDAR TODO (footer CTA)
    // ═══════════════════════════════════════════

    public function saveAll(): void
    {
        $this->saving = true;
        $this->saveStyle();

        if ($this->editingBlockId && $this->editingSettings) {
            $this->saveEditingBlock();
        }

        $this->saving = false;
        $this->dispatch('notify', type: 'success', message: 'Todos los cambios guardados.');
    }

    // ═══════════════════════════════════════════
    // HELPERS PRIVADOS
    // ═══════════════════════════════════════════

    private function defaultSettingsFor(string $type): array
    {
        foreach (config('landing_templates') as $template) {
            if (!is_array($template) || !isset($template['blocks'])) continue;
            foreach ($template['blocks'] as $def) {
                if ($def['type'] === $type) return $def['defaults'] ?? [];
            }
        }
        return [];
    }

    // ═══════════════════════════════════════════
    // RENDER
    // ═══════════════════════════════════════════

    public function render()
    {
        return view('livewire.tenant.landing.landing-builder')
            ->layout('layouts.fullscreen'); // sin padding, h-screen
    }
}