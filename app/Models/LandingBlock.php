<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandingBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_landing_id',
        'block_type',
        'order',
        'is_active',
        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings'  => 'array',
        'order'     => 'integer',
    ];

    // ─────────────────────────────────────────
    // Meta: etiquetas, íconos y colores
    // Usados en el sidebar del editor
    // ─────────────────────────────────────────

    private const META = [
        'hero'          => ['emoji' => '🏠', 'label' => 'Hero',           'tag' => 'Portada · CTA principal',   'color' => '#6366f1'],
        'services'      => ['emoji' => '⭐', 'label' => 'Servicios',       'tag' => 'Lo que ofrecemos',          'color' => '#0ea5e9'],
        'gallery'       => ['emoji' => '🖼️', 'label' => 'Galería',         'tag' => 'Fotos y portafolio',        'color' => '#8b5cf6'],
        'testimonials'  => ['emoji' => '💬', 'label' => 'Testimonios',     'tag' => 'Opiniones de clientes',     'color' => '#f59e0b'],
        'pricing'       => ['emoji' => '💰', 'label' => 'Precios',          'tag' => 'Planes y tarifas',          'color' => '#22c55e'],
        'faq'           => ['emoji' => '❓', 'label' => 'FAQ',              'tag' => 'Preguntas frecuentes',      'color' => '#06b6d4'],
        'cta'           => ['emoji' => '⚡', 'label' => 'CTA',              'tag' => 'Llamada a la acción',       'color' => '#f97316'],
        'contact'       => ['emoji' => '✉️', 'label' => 'Contacto',         'tag' => 'Formulario · datos',        'color' => '#ec4899'],
        'about'         => ['emoji' => '🏢', 'label' => 'Nosotros',         'tag' => 'Historia · equipo',         'color' => '#84cc16'],
        'story'         => ['emoji' => '📖', 'label' => 'Historia',          'tag' => 'Timeline · hitos',          'color' => '#a78bfa'],
        'achievements'  => ['emoji' => '🏆', 'label' => 'Logros',           'tag' => 'Estadísticas · métricas',   'color' => '#fbbf24'],
        'catalog'       => ['emoji' => '🗂️', 'label' => 'Catálogo',         'tag' => 'Productos · servicios',     'color' => '#34d399'],
        'trust'         => ['emoji' => '🛡️', 'label' => 'Confianza',        'tag' => 'Logos · certificaciones',   'color' => '#60a5fa'],
    ];

    public function getEmoji(): string
    {
        return self::META[$this->block_type]['emoji'] ?? '📦';
    }

    public function getLabel(): string
    {
        return self::META[$this->block_type]['label']
            ?? config("landing_templates.block_labels.{$this->block_type}", ucfirst($this->block_type));
    }

    public function getTag(): string
    {
        return self::META[$this->block_type]['tag'] ?? $this->block_type;
    }

    public function getColorHex(): string
    {
        return self::META[$this->block_type]['color'] ?? '#6b7280';
    }

    // ─────────────────────────────────────────
    // Settings helper
    // ─────────────────────────────────────────

    /**
     * Acceso seguro a cualquier clave dentro de settings[].
     * Soporta dot notation: $block->setting('items.0.title')
     */
    public function setting(string $key, mixed $default = null): mixed
    {
        return data_get($this->settings, $key, $default);
    }

    // ─────────────────────────────────────────
    // Relations
    // ─────────────────────────────────────────

    public function landing(): BelongsTo
    {
        return $this->belongsTo(TenantLanding::class, 'tenant_landing_id');
    }
}
