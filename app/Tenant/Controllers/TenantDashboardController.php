<?php

namespace App\Tenant\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TenantDashboardController extends Controller
{
   /**
    * Show the tenant dashboard.
    */
   public function index(Request $request)
   {
      $tenant = tenant();

      return view('tenant.dashboard', [
         'tenant'     => $tenant,
         'totalUsers' => User::count(),
         'user'       => $request->user(),
      ]);
   }
}
