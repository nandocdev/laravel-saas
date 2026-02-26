<?php

namespace App\Tenant\Services;

use App\Models\LandingBlock;
use App\Models\TenantLanding;
use Illuminate\Support\Collection;

/**
 * LandingRendererService
 *
 * Responsabilidad única: compilar todos los datos de una TenantLanding
 * en un payload listo para pasarle a la vista pública `tenant/landing/public.blade.php`.
 *
 * No renderiza HTML directamente — eso es trabajo de la vista Blade.
 * No persiste datos — eso es trabajo del modelo y el LandingBuilder.
 *
 * Uso típico en el controlador público:
 *
 *   $landing  = TenantLanding::firstOrFail();
 *   $renderer = app(LandingRendererService::class);
 *   $payload  = $renderer->compile($landing);
 *
 *   return view('tenant.landing.public', $payload);
 */
class LandingRendererService
{
    // ═══════════════════════════════════════════
    // ENTRY POINT
    // ═══════════════════════════════════════════

    /**
     * Compila la landing completa en un array listo para la vista.
     *
     * @return array{
     *   landing:      TenantLanding,
     *   blocks:       Collection<LandingBlock>,
     *   theme:        array,
     *   meta:         array,
     *   fontUrl:      string,
     *   navItems:     array,
     *   isPublished:  bool,
     * }
     */
    public function compile(TenantLanding $landing): array
    {
        $blocks = $this->resolveBlocks($landing);
        $theme  = $this->resolveTheme($landing);
        $meta   = $this->resolveMeta($landing);

        return [
            'landing'     => $landing,
            'blocks'      => $blocks,
            'theme'       => $theme,
            'meta'        => $meta,
            'fontUrl'     => $this->resolveFontUrl($landing->font_family),
            'navItems'    => $this->resolveNavItems($blocks),
            'isPublished' => $landing->status === 'published',
        ];
    }

    // ═══════════════════════════════════════════
    // BLOCKS
    // ═══════════════════════════════════════════

    /**
     * Devuelve solo los bloques activos, ordenados.
     * Si la landing no está publicada devuelve una colección vacía
     * para que el controlador pueda manejar el 404/draft page.
     */
    public function resolveBlocks(TenantLanding $landing): Collection
    {
        return $landing->blocks()
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    // ═══════════════════════════════════════════
    // THEME
    // ═══════════════════════════════════════════

    /**
     * Compila todas las variables de estilo que la vista necesita.
     *
     * Estructura devuelta:
     * [
     *   'primary'       => '#6366f1',
     *   'neutral'       => '#e2e8f0',
     *   'accent'        => '#f97316',
     *   'bgMode'        => 'light',
     *   'font'          => 'instrument',
     *   'fontStack'     => "'Instrument Serif', serif",
     *
     *   // Colores derivados del bgMode — evitan cálculos en la vista
     *   'bgPage'        => '#ffffff',
     *   'bgSection'     => '#f8fafc',
     *   'bgCard'        => '#f8fafc',
     *   'borderColor'   => '#e5e7eb',
     *   'textPrimary'   => '#1e293b',
     *   'textSecondary' => '#64748b',
     *   'navBg'         => '#ffffff',
     *   'footerBg'      => '#1e293b',
     *
     *   // Helpers para botones
     *   'btnPrimaryBg'  => '#6366f1',
     *   'btnPrimaryText'=> '#ffffff',
     *   'shadowPrimary' => 'rgba(99,102,241,0.35)',
     * ]
     */
    public function resolveTheme(TenantLanding $landing): array
    {
        $gs      = $landing->global_settings ?? [];
        $primary = $landing->primary_color   ?? '#6366f1';
        $neutral = $gs['color_neutral']       ?? '#e2e8f0';
        $accent  = $gs['color_accent']        ?? '#f97316';
        $bgMode  = $gs['bg_mode']             ?? 'light';
        $font    = $landing->font_family      ?? 'instrument';

        // Tokens derivados del bgMode
        $tokens = $this->bgModeTokens($bgMode);

        return array_merge([
            'primary'        => $primary,
            'neutral'        => $neutral,
            'accent'         => $accent,
            'bgMode'         => $bgMode,
            'font'           => $font,
            'fontStack'      => $this->fontStack($font),
            'btnPrimaryBg'   => $primary,
            'btnPrimaryText' => '#ffffff',
            'shadowPrimary'  => $this->hexToRgba($primary, 0.35),
        ], $tokens);
    }

    /**
     * Tokens de color según el bgMode.
     */
    private function bgModeTokens(string $bgMode): array
    {
        return match($bgMode) {
            'dark' => [
                'bgPage'        => '#0f172a',
                'bgSection'     => '#162032',
                'bgCard'        => '#1e293b',
                'borderColor'   => 'rgba(255,255,255,0.07)',
                'textPrimary'   => '#f1f5f9',
                'textSecondary' => '#94a3b8',
                'navBg'         => '#0f172a',
                'footerBg'      => '#020617',
            ],
            'soft' => [
                'bgPage'        => '#f8fafc',
                'bgSection'     => '#f1f5f9',
                'bgCard'        => '#ffffff',
                'borderColor'   => '#e5e7eb',
                'textPrimary'   => '#1e293b',
                'textSecondary' => '#64748b',
                'navBg'         => '#ffffff',
                'footerBg'      => '#1e293b',
            ],
            default => [ // light
                'bgPage'        => '#ffffff',
                'bgSection'     => '#f8fafc',
                'bgCard'        => '#f8fafc',
                'borderColor'   => '#e5e7eb',
                'textPrimary'   => '#1e293b',
                'textSecondary' => '#64748b',
                'navBg'         => '#ffffff',
                'footerBg'      => '#1e293b',
            ],
        };
    }

    // ═══════════════════════════════════════════
    // META (SEO / <head>)
    // ═══════════════════════════════════════════

    /**
     * Compila los metadatos necesarios para el <head> de la página pública.
     *
     * [
     *   'title'       => 'MiEmpresa',
     *   'description' => '...',   // extraído del hero si existe
     *   'faviconUrl'  => null,
     *   'logoUrl'     => null,
     *   'siteName'    => 'MiEmpresa',
     *   'customCss'   => null,
     * ]
     */
    public function resolveMeta(TenantLanding $landing): array
    {
        $gs = $landing->global_settings ?? [];

        // Intenta extraer descripción del bloque hero activo
        $heroBlock   = $landing->blocks()
            ->where('block_type', 'hero')
            ->where('is_active', true)
            ->first();

        $description = $heroBlock
            ? ($heroBlock->setting('subheadline') ?? '')
            : '';

        $siteName = $gs['site_name'] ?? 'Mi Empresa';

        return [
            'title'       => $siteName,
            'description' => $description,
            'faviconUrl'  => $gs['favicon_url'] ?? null,
            'logoUrl'     => $gs['logo_url']    ?? null,
            'siteName'    => $siteName,
            'customCss'   => $gs['custom_css']  ?? null,
        ];
    }

    // ═══════════════════════════════════════════
    // NAVEGACIÓN
    // ═══════════════════════════════════════════

    /**
     * Genera los ítems del navbar automáticamente
     * a partir de los bloques activos que tienen sección visible.
     *
     * Solo se incluyen los tipos que tienen sentido como ancla de navegación.
     */
    public function resolveNavItems(Collection $blocks): array
    {
        $navEligible = [
            'services'     => 'Servicios',
            'pricing'      => 'Precios',
            'about'        => 'Nosotros',
            'testimonials' => 'Testimonios',
            'gallery'      => 'Galería',
            'catalog'      => 'Catálogo',
            'faq'          => 'FAQ',
            'contact'      => 'Contacto',
        ];

        return $blocks
            ->whereIn('block_type', array_keys($navEligible))
            ->map(fn(LandingBlock $b) => [
                'label'  => $navEligible[$b->block_type],
                'anchor' => '#' . $b->block_type,
            ])
            ->values()
            ->toArray();
    }

    // ═══════════════════════════════════════════
    // FUENTES
    // ═══════════════════════════════════════════

    /**
     * Devuelve la URL de Google Fonts para cargar en el <head>.
     */
    public function resolveFontUrl(string $fontFamily): string
    {
        return match($fontFamily) {
            'slab'       => 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700;900&display=swap',
            'sans'       => 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap',
            'mono'       => 'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&display=swap',
            default      => 'https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap',
        };
    }

    /**
     * Devuelve el CSS font-family stack para usar en el <body>.
     */
    public function fontStack(string $fontFamily): string
    {
        return match($fontFamily) {
            'slab'  => "'Roboto Slab', Georgia, serif",
            'sans'  => "'DM Sans', system-ui, sans-serif",
            'mono'  => "'JetBrains Mono', 'Courier New', monospace",
            default => "'Instrument Sans', system-ui, sans-serif",
        };
    }

    // ═══════════════════════════════════════════
    // VALIDACIÓN
    // ═══════════════════════════════════════════

    /**
     * Verifica si la landing es accesible públicamente.
     * Devuelve false si está en draft — el controlador debe hacer abort(404) o mostrar página de draft.
     */
    public function isAccessible(TenantLanding $landing): bool
    {
        return $landing->status === 'published';
    }

    /**
     * Verifica si la landing tiene al menos un bloque activo.
     * Útil para mostrar un estado vacío en el preview del editor.
     */
    public function hasContent(TenantLanding $landing): bool
    {
        return $landing->blocks()->where('is_active', true)->exists();
    }

    // ═══════════════════════════════════════════
    // UTILIDADES PRIVADAS
    // ═══════════════════════════════════════════

    /**
     * Convierte un color hex a rgba con opacidad dada.
     * Usado para generar box-shadows con el color primario del tenant.
     */
    private function hexToRgba(string $hex, float $alpha): string
    {
        $hex = ltrim($hex, '#');

        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }

        [$r, $g, $b] = [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ];

        return "rgba({$r},{$g},{$b},{$alpha})";
    }
}