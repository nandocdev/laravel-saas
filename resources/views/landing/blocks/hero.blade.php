<div class="relative bg-gray-900 text-white overflow-hidden py-24 sm:py-32" style="background-color: var(--primary-color);">
    @if(!empty($data->image_url))
        <img src="{{ $data->image_url }}" alt="Hero Background" class="absolute inset-0 -z-10 h-full w-full object-cover object-right md:object-center opacity-40">
    @endif
    <div class="mx-auto max-w-7xl px-6 lg:px-8 relative z-10">
        <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">{{ $data->title ?? 'Bienvenido' }}</h2>
            <p class="mt-6 text-lg leading-8 text-gray-300">{{ $data->subtitle ?? 'La plataforma perfecta para tu negocio.' }}</p>
        </div>
        <div class="mx-auto mt-10 max-w-2xl lg:mx-0 lg:max-w-none">
            @if(!empty($data->cta_text))
            <div class="flex gap-x-6">
                <a href="{{ $data->cta_link ?? '#' }}" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" style="color: var(--primary-color)">
                    {{ $data->cta_text }}
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
