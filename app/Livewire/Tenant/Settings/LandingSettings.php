<?php

namespace App\Livewire\Tenant\Settings;

use App\Tenant\Services\LandingConfigService;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class LandingSettings extends Component {
    use WithFileUploads;

    protected LandingConfigService $landingConfigService;

    public $company_name;
    public $logo;
    public $existing_logo;

    public $primary_color = '#644FB5';
    public $secondary_color = '#F5A623';
    public $font = 'Roboto';
    public $custom_css = '';

    public array $blocks = [];
    public $newBlockType = '';

    public $template = 'corporate';

    public array $draftConfig = [];
    public array $persistedConfig = [];

    public function boot(LandingConfigService $landingConfigService): void {
        $this->landingConfigService = $landingConfigService;
    }


    public function mount() {
        $tenant = tenant();
        $this->company_name = $tenant->company_name ?? $tenant->id;

        $this->persistedConfig = $this->landingConfigService->resolveForTenant($tenant);
        $this->draftConfig = $this->persistedConfig;
        $this->hydrateEditorState($this->landingConfigService->toEditorState($this->draftConfig));
    }


    public function updated($name): void {
        if (
            str_starts_with($name, 'blocks.') ||
            in_array($name, ['template', 'primary_color', 'secondary_color', 'font', 'custom_css'], true)
        ) {
            $this->syncDraftFromEditorState();
        }
    }
    public function addBlock($type = null) {
        $type = $type ?? $this->newBlockType;
        if (empty($type)) {
            return;
        }

        $defaultData = $this->landingConfigService->defaultSectionContent((string) $type);

        $this->blocks[] = [
            'id' => uniqid('section_', true),
            'type' => $type,
            'visible' => true,
            'data' => $defaultData,
        ];

        $this->newBlockType = '';
        $this->syncDraftFromEditorState();
    }

    public function removeBlock($index) {
        unset($this->blocks[$index]);
        $this->blocks = array_values($this->blocks); // Re-index array
        $this->syncDraftFromEditorState();
    }

    public function moveBlockUp($index) {
        if ($index > 0) {
            $temp = $this->blocks[$index];
            $this->blocks[$index] = $this->blocks[$index - 1];
            $this->blocks[$index - 1] = $temp;
        }

        $this->syncDraftFromEditorState();
    }

    public function moveBlockDown($index) {
        if ($index < count($this->blocks) - 1) {
            $temp = $this->blocks[$index];
            $this->blocks[$index] = $this->blocks[$index + 1];
            $this->blocks[$index + 1] = $temp;
        }

        $this->syncDraftFromEditorState();
    }

    public function toggleBlockVisibility($index) {
        $this->blocks[$index]['visible'] = !($this->blocks[$index]['visible'] ?? true);
        $this->syncDraftFromEditorState();
    }

    public function addRepeaterItem($blockIndex, $key, $defaultItem) {
        if (!isset($this->blocks[$blockIndex]['data'][$key])) {
            $this->blocks[$blockIndex]['data'][$key] = [];
        }
        $this->blocks[$blockIndex]['data'][$key][] = $defaultItem;
        $this->syncDraftFromEditorState();
    }

    public function removeRepeaterItem($blockIndex, $key, $itemIndex) {
        unset($this->blocks[$blockIndex]['data'][$key][$itemIndex]);
        $this->blocks[$blockIndex]['data'][$key] = array_values($this->blocks[$blockIndex]['data'][$key]);
        $this->syncDraftFromEditorState();
    }

    public function addPricingFeature($blockIndex, $pricingItemIndex) {
        if (!isset($this->blocks[$blockIndex]['data']['items'][$pricingItemIndex]['features'])) {
            $this->blocks[$blockIndex]['data']['items'][$pricingItemIndex]['features'] = [];
        }
        $this->blocks[$blockIndex]['data']['items'][$pricingItemIndex]['features'][] = 'New Feature';
        $this->syncDraftFromEditorState();
    }

    public function removePricingFeature($blockIndex, $pricingItemIndex, $featureIndex) {
        unset($this->blocks[$blockIndex]['data']['items'][$pricingItemIndex]['features'][$featureIndex]);
        $this->blocks[$blockIndex]['data']['items'][$pricingItemIndex]['features'] = array_values($this->blocks[$blockIndex]['data']['items'][$pricingItemIndex]['features']);
        $this->syncDraftFromEditorState();
    }

    public function save() {
        $this->validate([
            'company_name' => 'required|string|max:255',
            'template' => ['required', 'string', Rule::in($this->landingConfigService->availableTemplateKeys())],
            'blocks' => 'array',
        ]);

        $this->syncDraftFromEditorState();

        $tenant = tenant();

        $logoPath = $this->existing_logo;
        if ($this->logo) {
            $logoPath = $this->logo->store('logos', 'public');
        }

        $configToPersist = $this->draftConfig;
        data_set($configToPersist, 'assets.logo', $logoPath);

        $tenant->update([
            'company_name' => $this->company_name,
            'landing_page_config' => $configToPersist,
        ]);

        $this->persistedConfig = $configToPersist;
        $this->draftConfig = $configToPersist;
        $this->existing_logo = $logoPath;

        session()->flash('message', 'Landing page settings updated successfully.');
    }

    private function hydrateEditorState(array $state): void {
        $this->template = $state['template'];
        $this->primary_color = $state['primary_color'];
        $this->secondary_color = $state['secondary_color'];
        $this->font = $state['font'];
        $this->custom_css = $state['custom_css'];
        $this->existing_logo = $state['existing_logo'];
        $this->blocks = $state['blocks'];
    }

    private function syncDraftFromEditorState(): void {
        $this->draftConfig = $this->landingConfigService->fromEditorState([
            'template' => $this->template,
            'primary_color' => $this->primary_color,
            'secondary_color' => $this->secondary_color,
            'font' => $this->font,
            'custom_css' => $this->custom_css,
            'existing_logo' => $this->existing_logo,
            'blocks' => $this->blocks,
        ]);
    }

    #[Layout('layouts.tenant', ['title' => 'Landing Settings'])]
    public function render() {
        return view('livewire.tenant.settings.landing-settings');
    }
}
