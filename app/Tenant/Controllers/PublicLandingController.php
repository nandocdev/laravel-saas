<?php

namespace App\Tenant\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TenantLanding;
use App\Tenant\Services\LandingRendererService;
use Illuminate\Http\Request;

class PublicLandingController extends Controller
{
    /**
     * Renderiza la landing page pública del tenant.
     */
    public function show(Request $request, LandingRendererService $renderer)
    {
        // Obtener la landing o crear una por defecto si no existe
        $landing = TenantLanding::firstOrCreate(
            [], // El scope del tenant ya filtra a su propia BD
            [
                'template_key' => 'corporate',
                'status' => 'draft',
                'font_family' => 'instrument',
                'primary_color' => '#6366f1',
            ]
        );

        // Si la landing es borrador y no es una vista previa explícita (p.ej. desde el editor)
        // abortamos con error 404 (o mostrar página 'próximamente').
        $isPreview = $request->query('preview') === 'true' && auth()->check();

        if ($landing->status !== 'published' && !$isPreview) {
            abort(404, 'La página no está disponible.');
        }

        // Si no hay bloques, aplicamos el template por defecto
        if ($landing->blocks()->count() === 0) {
            // Esto solo debe ocurrir la primera vez si el usuario no ha abierto el editor
            // En la vida real, se crearía al crear el tenant (seeder o listener)
            // Asumimos que el modelo TenantLanding tiene un metodo applyTemplate
            if (method_exists($landing, 'applyTemplate')) {
                $landing->applyTemplate($landing->template_key);
                $landing->refresh();
            }
        }

        // Compilar datos para la vista usando el servicio
        $payload = $renderer->compile($landing);

        // El servicio renderer ya no inyecta preview true, lo controlamos desde acá
        $payload['isPublished'] = $landing->status === 'published';

        return view('tenant.landing.public', $payload);
    }
}
