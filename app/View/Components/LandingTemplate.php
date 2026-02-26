<?php

namespace App\View\Components;

use App\Tenant\Landing\Renderers\LandingRenderer;
use App\Tenant\Services\LandingConfigService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LandingTemplate extends Component {
    public array $config;
    public array $style = [];
    public array $sections = [];
    public string $templateView = 'templates.corporate';

    /**
     * Create a new component instance.
     */
    public function __construct(?array $config = null) {
        /** @var LandingConfigService $configService */
        $configService = app(LandingConfigService::class);
        /** @var LandingRenderer $renderer */
        $renderer = app(LandingRenderer::class);

        $normalized = $config
            ? $configService->normalize($config, tenant())
            : $configService->resolveForTenant(tenant());

        $rendered = $renderer->renderTemplate($normalized);

        $this->config = $normalized;
        $this->style = (array) ($rendered['style'] ?? []);
        $this->sections = (array) ($rendered['sections'] ?? []);
        $this->templateView = (string) ($rendered['templateView'] ?? 'templates.corporate');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('components.landing-template');
    }
}
