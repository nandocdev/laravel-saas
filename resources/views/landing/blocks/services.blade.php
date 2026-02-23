<div class="bg-white py-24 sm:py-32" style="background-color: var(--secondary-color);">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:text-center">
            <h2 class="text-base font-semibold leading-7" style="color: var(--primary-color);">{{ $data->badge ?? 'Servicios' }}</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $data->title ?? 'Lo que ofrecemos' }}</p>
            <p class="mt-6 text-lg leading-8 text-gray-600">{{ $data->description ?? '' }}</p>
        </div>
        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                @if(!empty($data->services) && is_array($data->services))
                    @foreach($data->services as $service)
                        <div class="relative pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg" style="background-color: var(--primary-color);">
                                    @if(!empty($service['icon_svg']))
                                        {!! $service['icon_svg'] !!}
                                    @else
                                        <!-- Default icon -->
                                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2.25v19.5m9.75-9.75H2.25" />
                                        </svg>
                                    @endif
                                </div>
                                {{ $service['title'] ?? 'Servicio' }}
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">{{ $service['description'] ?? '' }}</dd>
                        </div>
                    @endforeach
                @endif
            </dl>
        </div>
    </div>
</div>
