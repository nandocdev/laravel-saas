<?php

namespace App\Livewire\Admin\Plans;

use App\Central\Models\Plan;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.admin')]
class Form extends Component
{
   public ?Plan $plan = null;

   #[Validate('required|string|max:255')]
   public string $name = '';

   #[Validate('nullable|string|max:500')]
   public string $description = '';

   #[Validate('required|numeric|min:0')]
   public string $price = '0.00';

   #[Validate('required|string|size:3')]
   public string $currency = 'USD';

   #[Validate('required|in:monthly,yearly,lifetime')]
   public string $billing_cycle = 'monthly';

   #[Validate('nullable|string')]
   public string $features = '';

   public bool $is_active = true;

   public function mount(?Plan $plan = null): void
   {
      if ($plan && $plan->exists) {
         $this->plan = $plan;
         $this->name = $plan->name;
         $this->description = $plan->description ?? '';
         $this->price = (string) $plan->price;
         $this->currency = $plan->currency;
         $this->billing_cycle = $plan->billing_cycle;
         $this->features = $plan->features ? implode("\n", $plan->features) : '';
         $this->is_active = $plan->is_active;
      }
   }

   public function save(): void
   {
      $this->validate();

      $data = [
         'name'          => $this->name,
         'slug'          => Str::slug($this->name),
         'description'   => $this->description ?: null,
         'price'         => $this->price,
         'currency'      => $this->currency,
         'billing_cycle' => $this->billing_cycle,
         'features'      => $this->features
            ? array_map('trim', explode("\n", $this->features))
            : null,
         'is_active'     => $this->is_active,
      ];

      if ($this->plan) {
         $this->plan->update($data);
         session()->flash('success', 'Plan updated successfully.');
      } else {
         Plan::create($data);
         session()->flash('success', 'Plan created successfully.');
      }

      $this->redirect(route('admin.plans.index'), navigate: true);
   }

   public function render()
   {
      $title = $this->plan ? 'Edit Plan' : 'Create Plan';

      return view('livewire.admin.plans.form')
         ->title("{$title} — Admin Panel");
   }
}
