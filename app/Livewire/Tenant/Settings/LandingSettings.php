<?php

namespace App\Livewire\Tenant\Settings;

use Livewire\Component;

class LandingSettings extends Component
{
    public $company_name;

    public $landing_headline;

    public $landing_description;

    public $landing_cta;

    public function mount()
    {
        $tenant = tenant();
        $this->company_name = $tenant->company_name ?? $tenant->id;
        $this->landing_headline = $tenant->landing_headline;
        $this->landing_description = $tenant->landing_description;
        $this->landing_cta = $tenant->landing_cta;
    }

    public function save()
    {
        $this->validate([
            'company_name' => 'required|string|max:255',
            'landing_headline' => 'nullable|string|max:255',
            'landing_description' => 'nullable|string|max:1000',
            'landing_cta' => 'nullable|string|max:50',
        ]);

        $tenant = tenant();

        $tenant->update([
            'company_name' => $this->company_name,
            'landing_headline' => $this->landing_headline,
            'landing_description' => $this->landing_description,
            'landing_cta' => $this->landing_cta,
        ]);

        session()->flash('message', 'Landing page settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.tenant.settings.landing-settings')
            ->layout('layouts.tenant', ['title' => 'Landing Settings']);
    }
}
