<?php

namespace Database\Seeders;

use App\Models\SystemAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SystemAdminSeeder extends Seeder
{
   /**
    * Seed the default system administrator.
    */
   public function run(): void
   {
      SystemAdmin::firstOrCreate(
         ['email' => 'admin@saasflow.dev'],
         [
            'name'     => 'System Admin',
            'password' => Hash::make('password'),
         ]
      );
   }
}
