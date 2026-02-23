<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingSection extends Model
{
    protected $fillable = [
        'tenant_id',
        'section_type',
        'order',
        'is_active',
        'content',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'content' => 'array',
    ];
}
