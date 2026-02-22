<?php

namespace App\Central\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
   use HasFactory;

   protected $fillable = [
      'name',
      'slug',
      'description',
      'price',
      'currency',
      'billing_cycle',
      'features',
      'is_active',
   ];

   protected function casts(): array
   {
      return [
         'features' => 'array',
         'price' => 'decimal:2',
         'is_active' => 'boolean',
      ];
   }

   public function subscriptions()
   {
      return $this->hasMany(Subscription::class);
   }
}
