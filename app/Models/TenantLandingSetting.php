<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantLandingSetting extends Model
{
    protected $table = 'tenant_landing_settings';

    protected $fillable = [
        'tenant_id',
        'template_id',
        'primary_color',
        'secondary_color',
        'font_family',
        'custom_css',
    ];

    public function template()
    {
        return $this->belongsTo(LandingTemplate::class, 'template_id');
    }
}
