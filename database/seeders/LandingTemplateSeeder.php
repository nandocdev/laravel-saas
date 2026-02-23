<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LandingTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\LandingTemplate::insert([
            [
                'name' => 'Clásica Corporativa',
                'slug' => 'corporate',
                'description' => 'Diseño limpio, formal, profesional. Ideal para consultorios, abogados, agencias, servicios B2B.',
                'preview_image' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Visual / Experiencia',
                'slug' => 'visual',
                'description' => 'Impacto visual fuerte, mucho protagonismo de imágenes. Ideal para restaurantes, barberías, spas.',
                'preview_image' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Conversión Directa',
                'slug' => 'conversion',
                'description' => 'Optimizado 100% para convertir rápido. Menos storytelling, más acción.',
                'preview_image' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
