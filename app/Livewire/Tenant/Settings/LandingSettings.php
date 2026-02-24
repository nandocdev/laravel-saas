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
                    'data' => $block['data'] ?? [],
                ];
            }
        } else {
            // Fallback for first time or old flat fields
            $this->blocks[] = [
                'type' => 'hero',
                'data' => [
                    'title' => $tenant->landing_headline ?? $tenant->company_name ?? 'Welcome',
                    'subtitle' => $tenant->landing_description ?? 'The best solutions for your business.',
                    'cta_text' => $tenant->landing_cta ?? 'Contact Us',
                    'cta_link' => '#contact',
                ],
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
            'pricing' => ['heading' => 'Pricing', 'items' => [['name' => 'Basic', 'price' => '10', 'popular' => false, 'features' => ['A', 'B'], 'cta_text' => 'Choose Plan', 'cta_link' => '#']]],
            'faq' => ['heading' => 'FAQ', 'items' => [['question' => 'What is this?', 'answer' => 'An answer']]],
            'contact' => ['heading' => 'Contact Us', 'description' => 'Drop us a line.', 'email' => 'hello@example.com', 'phone' => '', 'address' => ''],
            default => []
        };

        $this->blocks[] = [
            'type' => $this->newBlockType,
            'data' => $defaultData,
        ];

        $this->newBlockType = '';
    }

    public function removeBlock($index)
    {
        unset($this->blocks[$index]);
        $this->blocks = array_values($this->blocks); // Re-index array
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

    // Array manipulation helpers for inner repeater items (features, testimonials, etc)
    public function addRepeaterItem($blockIndex, $key, $defaultItem)
    {
        if (!isset($this->blocks[$blockIndex]['data'][$key])) {
            $this->blocks[$blockIndex]['data'][$key] = [];
        }
        $this->blocks[$blockIndex]['data'][$key][] = $defaultItem;
    }

    public function removeRepeaterItem($blockIndex, $key, $itemIndex)
    {
        unset($this->blocks[$blockIndex]['data'][$key][$itemIndex]);
        $this->blocks[$blockIndex]['data'][$key] = array_values($this->blocks[$blockIndex]['data'][$key]);
    }

    public function addPricingFeature($blockIndex, $pricingItemIndex)
    {
        if (!isset($this->blocks[$blockIndex]['data']['items'][$pricingItemIndex]['features'])) {
            $this->blocks[$blockIndex]['data']['items'][$pricingItemIndex]['features'] = [];
        }
        $this->blocks[$blockIndex]['data']['items'][$pricingItemIndex]['features'][] = 'New Feature';
    }

    public function removePricingFeature($blockIndex, $pricingItemIndex, $featureIndex)
    {
        unset($this->blocks[$blockIndex]['data']['items'][$pricingItemIndex]['features'][$featureIndex]);
        $this->blocks[$blockIndex]['data']['items'][$pricingItemIndex]['features'] = array_values($this->blocks[$blockIndex]['data']['items'][$pricingItemIndex]['features']);
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
            $parsedBlocks[] = [
                'type' => $block['type'],
                'data' => $block['data'] ?? [],
            ];
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
