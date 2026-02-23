<?php

namespace App\Livewire\Tenant;

use Livewire\Component;

class PublicLanding extends Component
{
   public function render()
   {
      return view('livewire.tenant.public-landing')
         ->layout('layouts.public', ['title' => tenant('company_name') ?? tenant('id') . ' | Welcome']);
   }
}
