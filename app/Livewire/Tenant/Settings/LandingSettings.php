<?php

namespace App\Livewire\Tenant\Settings;

use Livewire\Component;

class LandingSettings extends Component
{
    public $company_name;
    public array $blocks = [];
    public $newBlockType = '';

    public $template = 'corporate';

    public function mount()
    {
        $tenant = tenant();
        $this->company_name = $tenant->company_name ?? $tenant->id;

        $config = $tenant->landing_page_config;
        $this->template = $config['template'] ?? 'corporate';

        if (is_array($config) && isset($config['blocks'])) {
            foreach ($config['blocks'] as $block) {
                $this->blocks[] = [
                    'type' => $block['type'],
                    'json_data' => json_encode($block['data'] ?? [], JSON_PRETTY_PRINT),
                ];
            }
        } else {
            // Fallback for first time or old flat fields
            $this->blocks[] = [
                'type' => 'hero',
                'json_data' => json_encode([
                    'title' => $tenant->landing_headline ?? $tenant->company_name ?? 'Welcome',
                    'subtitle' => $tenant->landing_description ?? 'The best solutions for your business.',
                    'cta_text' => $tenant->landing_cta ?? 'Contact Us',
                    'cta_link' => '#contact',
                ], JSON_PRETTY_PRINT),
            ];
        }
    }

    public function addBlock()
    {
        if (empty($this->newBlockType)) return;

        $defaultData = match ($this->newBlockType) {
            'hero' => ['title' => 'New Hero', 'subtitle' => 'Description here', 'cta_text' => 'Click Here', 'cta_link' => '#'],
            'features' => ['items' => [['title' => 'Feature 1', 'description' => '...']]],
            'testimonials' => ['heading' => 'Testimonials', 'items' => [['name' => 'John Doe', 'role' => 'CEO', 'quote' => 'Great!']]],
            'pricing' => ['heading' => 'Pricing', 'items' => [['name' => 'Basic', 'price' => '10', 'features' => ['A', 'B'], 'cta_link' => '#']]],
            'faq' => ['heading' => 'FAQ', 'items' => [['question' => 'What is this?', 'answer' => 'An answer']]],
            'contact' => ['heading' => 'Contact Us', 'email' => 'hello@example.com'],
            default => []
        };

        $this->blocks[] = [
            'type' => $this->newBlockType,
            'json_data' => json_encode($defaultData, JSON_PRETTY_PRINT),
        ];

        $this->newBlockType = '';
    }

    public function removeBlock($index)
    {
        unset($this->blocks[$index]);
        $this->blocks = array_values($this->blocks);
    }

    public function moveBlockUp($index)
    {
        if ($index > 0) {
            $temp = $this->blocks[$index];
            $this->blocks[$index] = $this->blocks[$index - 1];
            $this->blocks[$index - 1] = $temp;
        }
    }

    public function moveBlockDown($index)
    {
        if ($index < count($this->blocks) - 1) {
            $temp = $this->blocks[$index];
            $this->blocks[$index] = $this->blocks[$index + 1];
            $this->blocks[$index + 1] = $temp;
        }
    }

    public function save()
    {
        $this->validate([
            'company_name' => 'required|string|max:255',
            'template' => 'required|string|in:corporate,visual,conversion,storytelling,catalog,onepage',
            'blocks' => 'array',
        ]);

        $parsedBlocks = [];
        foreach ($this->blocks as $block) {
            $data = json_decode($block['json_data'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $parsedBlocks[] = [
                    'type' => $block['type'],
                    'data' => $data,
                ];
            } else {
                $this->addError("blocks.{$block['type']}", "Invalid JSON in {$block['type']} block.");
                return;
            }
        }

        $tenant = tenant();

        $tenant->update([
            'company_name' => $this->company_name,
            'landing_page_config' => ['template' => $this->template, 'blocks' => $parsedBlocks],
        ]);

        session()->flash('message', 'Landing page settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.tenant.settings.landing-settings')
            ->layout('layouts.tenant', ['title' => 'Landing Settings']);
    }
}
