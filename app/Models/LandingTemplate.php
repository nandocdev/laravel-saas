<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingTemplate extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'preview_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function tenantSettings()
    {
        return $this->hasMany(TenantLandingSetting::class, 'template_id');
    }
}
