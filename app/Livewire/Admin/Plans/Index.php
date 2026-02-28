<?php

namespace App\Livewire\Admin\Plans;

use App\Central\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Index extends Component
{
    public string $search = '';

    public function toggleActive(Plan $plan): void
    {
        $plan->update(['is_active' => ! $plan->is_active]);
    }

    public function deletePlan(Plan $plan): void
    {
        $plan->delete();
    }

    public function render()
    {
        $plans = Plan::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy('price')
            ->get();

        return view('livewire.admin.plans.index', [
            'plans' => $plans,
        ])->title('Plans — Admin Panel');
    }
}
