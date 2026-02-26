<?php

namespace App\Livewire\Tenant\Landing;

use Livewire\Component;

class TemplateConfirmModal extends Component
{
    public bool $show = false;
    public string $pendingTemplateKey = '';

    #[\Livewire\Attributes\On('confirmTemplateChange')]
    public function openModal($key): void
    {
        if (is_array($key)) {
            $key = $key['key'] ?? '';
        }
        $this->pendingTemplateKey = (string)$key;
        $this->show = true;
    }

    public function confirm(): void
    {
        $this->dispatch('templateSelected', key: $this->pendingTemplateKey);
        $this->show = false;
        $this->pendingTemplateKey = '';
    }

    public function cancel(): void
    {
        $this->show = false;
        $this->pendingTemplateKey = '';
    }

    public function render()
    {
        return view('livewire.tenant.landing.template-confirm-modal');
    }
}
