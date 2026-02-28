@extends('layouts.public')

@section('content')
    <div class="landing-template-corporate" style="
        --primary-color: {{ $settings?->primary_color ?? '#000000' }};
        --secondary-color: {{ $settings?->secondary_color ?? '#ffffff' }};
        --font-family: {{ $settings?->font_family ?? 'Inter, sans-serif' }};
    ">
        @if($settings?->custom_css)
            <style>
                {!! $settings->custom_css !!}
            </style>
        @endif

        <div style="font-family: var(--font-family);">
            @foreach($sections as $section)
                @if(view()->exists("landing.blocks.{$section->section_type}"))
                    @include("landing.blocks.{$section->section_type}", [
                        'data' => (object)$section->content,
                        'tenant' => $tenant
                    ])
                @else
                    <!-- Bloque no encontrado: {{ $section->section_type }} -->
                @endif
            @endforeach
        </div>
    </div>
@endsection
