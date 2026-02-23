<?php

namespace App\Livewire\Onboarding;

use App\Central\Models\Plan;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateWorkspace extends Component
{
   public $name = '';
   public $domain = '';
   public $submitting = false;

   public function updatedName($value)
   {
      if (!$this->submitting) {
         $this->domain = Str::slug($value);
      }
   }

   public function rules()
   {
      return [
         'name' => 'required|string|max:255',
         'domain' => 'required|string|alpha_dash|max:63|unique:domains,domain',
      ];
   }

   public function createWorkspace()
   {
      $this->validate();
      $this->submitting = true;

      $tenantId = Str::slug($this->domain);
      $host = request()->getHost();
      $host = $host === '127.0.0.1' ? 'localhost' : $host;
      $fullDomain = $tenantId . '.' . $host;

      // 1. Verify if domain actually exists in domains table
      if (\Illuminate\Support\Facades\DB::table('domains')->where('domain', $fullDomain)->exists()) {
         $this->addError('domain', 'This workspace domain is already taken.');
         $this->submitting = false;
         return;
      }

      try {
         DB::beginTransaction();

         // 2. Create the Tenant in the central DB
         $tenant = Tenant::create([
            'id' => $tenantId,
            'user_id' => auth()->id(), // Associate the central user
         ]);

         // 3. Create the Domain for the tenant
         $tenant->domains()->create([
            'domain' => $fullDomain,
         ]);

         // 4. Create an active Free/Starter subscription for the new tenant
         $plan = Plan::firstOrCreate(
            ['slug' => 'starter'],
            ['name' => 'Starter', 'price' => 0, 'currency' => 'USD', 'billing_cycle' => 'monthly', 'is_active' => true]
         );

         $tenant->subscriptions()->create([
            'plan_id' => $plan->id,
            'status' => 'active',
            'starts_at' => now(),
         ]);

         DB::commit();

         // 5. Run within the tenant context to seed the admin user
         /** @var \App\Models\User $centralUser */
         $centralUser = auth()->user();

         $tenant->run(function () use ($centralUser) {
            // We create the user in the isolated tenant database
            \App\Models\User::firstOrCreate(
               ['email' => $centralUser->email],
               [
                  'name' => $centralUser->name,
                  // We copy the same central hashed password, or set a random one using config magic links (for now copy password)
                  'password' => $centralUser->password,
                  'email_verified_at' => now(),
               ]
            );
         });

         // Redirect the user to their new tenant login
         $protocol = request()->isSecure() ? 'https://' : 'http://';
         $port = request()->getPort() != 80 && request()->getPort() != 443 ? ':' . request()->getPort() : '';
         return redirect()->to($protocol . $fullDomain . $port . '/login');
      } catch (\Exception $e) {
         DB::rollBack();
         $this->addError('name', 'An error occurred while creating your workspace. Please try again.');
         $this->submitting = false;
      }
   }

   public function render()
   {
      return view('livewire.onboarding.create-workspace')
         ->layout('layouts.app', ['title' => 'Create Workspace']);
   }
}
