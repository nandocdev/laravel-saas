<?php

namespace App\Livewire\Admin;

use App\Central\Models\Plan;
use App\Central\Models\Subscription;
use App\Models\Tenant;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalTenants' => Tenant::count(),
            'activeTenants' => Subscription::where('status', 'active')->distinct('tenant_id')->count('tenant_id'),
            'totalPlans' => Plan::count(),
            'activePlans' => Plan::where('is_active', true)->count(),
            'recentTenants' => Tenant::with('domains')->latest()->take(5)->get(),
            'recentSubscriptions' => Subscription::with(['tenant', 'plan'])->latest()->take(5)->get(),
            'monthlyRevenue' => Subscription::where('status', 'active')
                ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
                ->sum('plans.price'),
        ])->title('Dashboard — Admin Panel');
    }
}
