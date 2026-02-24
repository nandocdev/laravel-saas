<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LandingTemplate extends Component
{
    public array $config;
    public array $blocks;

    /**
     * Create a new component instance.
     */
    public function __construct(?array $config = null)
    {
        $this->config = $config ?? tenant('landing_page_config') ?? $this->getDefaultConfig();
        $this->blocks = $this->config['blocks'] ?? [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.landing-template');
    }

    /**
     * Provide a default configuration if the tenant hasn't set one up.
     */
    protected function getDefaultConfig(): array
    {
        return [
            'template' => 'corporate',
            'blocks' => [
                [
                    'type' => 'hero',
                    'data' => [
                        'title' => tenant('landing_headline') ?? tenant('company_name') ?? 'Welcome',
                        'subtitle' => tenant('landing_description') ?? 'The best solutions for your business.',
                        'cta_text' => tenant('landing_cta') ?? 'Contact Us',
                        'cta_link' => '#contact',
                    ]
                ],
                [
                    'type' => 'features',
                    'data' => [
                        'items' => [
                            ['title' => 'Feature 1', 'description' => 'Description for feature 1'],
                            ['title' => 'Feature 2', 'description' => 'Description for feature 2'],
                            ['title' => 'Feature 3', 'description' => 'Description for feature 3'],
                        ]
                    ]
                ]
            ]
        ];
    }
}
