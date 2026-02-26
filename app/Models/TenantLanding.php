<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TenantLanding extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_key',
        'status',
        'primary_color',
        'font_family',
        'global_settings',
    ];

    /**
     * Aplica un template predefinido eliminando los bloques anteriores.
     */
    public function applyTemplate(string $templateKey): void
    {
        $template = config("landing_templates.{$templateKey}");
        if (!$template) {
            return;
        }

        $this->update(['template_key' => $templateKey]);
        
        // Limpiar bloques anteriores
        $this->blocks()->delete();

        // Creamos cada bloque como entidad relacionada (haciendo uso del hasMany)
        // Ya que json_encode es el formato crudo para DB pero al usar create() 
        // espera el array decodificado debido al cast en el modelo LandingBlock.
        foreach ($template['blocks'] as $index => $block) {
            $this->blocks()->create([
                'block_type' => $block['type'],
                'order'      => $index,
                'is_active'  => true,
                // Al usar create(), el cast lo convierte a JSON internamente. 
                // Por lo tanto le pasamos un array.
                'settings'   => $block['defaults'] ?? [],
            ]);
        }
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'global_settings' => 'array',
        ];
    }

    /**
     * Get the blocks for the landing page.
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(LandingBlock::class)->orderBy('order');
    }
}
