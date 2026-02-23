<div class="py-24 sm:py-32" style="background-color: var(--secondary-color);">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $data->title ?? 'Reserva con nosotros' }}</h2>
            <p class="mt-6 text-lg leading-8 text-gray-600">{{ $data->description ?? 'Utiliza nuestro widget para agendar tu cita.' }}</p>
        </div>
        
        <div class="mt-16 sm:mt-20 lg:mt-24 w-full flex justify-center">
            @if(!empty($data->widget_type) && $data->widget_type === 'iframe')
                <!-- Render Iframe Widget -->
                <iframe src="{{ $data->iframe_url }}" width="100%" height="600" frameborder="0" style="border:0; max-width: 800px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);"></iframe>
            @elseif(!empty($data->widget_type) && $data->widget_type === 'js')
                <!-- Render JS Container -->
                <div id="{{ $data->container_id ?? 'reservation-widget-container' }}"></div>
                <script src="{{ $data->script_url }}"></script>
                @if(!empty($data->init_script))
                    <script>
                        {!! $data->init_script !!}
                    </script>
                @endif
            @else
                <!-- Default internal logic (reservation widget system should be linked here without coupling to landing) -->
                <div class="p-8 border rounded shadow-sm text-center">Configura el origen de tu widget (iframe o JS) en los settings del bloque.</div>
            @endif
        </div>
    </div>
</div>
