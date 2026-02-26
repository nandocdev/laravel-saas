{{--
    resources/views/components/landing-builder/live-preview.blade.php

    Props recibidas desde el builder principal:
      $blocks          — Collection<LandingBlock> ordenados
      $colorPrimary    — hex string
      $colorNeutral    — hex string
      $colorAccent     — hex string
      $bgMode          — light | soft | dark
      $siteName        — string
      $selectedBlockId — int|null  (resalta el bloque en edición)

    Este componente es el "cuerpo" de la landing renderizado en miniatura.
    Escala visual para que quepa dentro del preview window del builder.
    En producción se usa el mismo set de sub-vistas con estilos reales.
--}}

@php
    // ── Helpers de color según bgMode ──────────────────
    $bgPage = match($bgMode) {
        'dark' => '#0f172a',
        'soft' => '#f8fafc',
        default => '#ffffff',
    };
    $textPrimary = $bgMode === 'dark' ? '#f1f5f9' : '#1e293b';
    $textSecondary = $bgMode === 'dark' ? '#94a3b8' : '#64748b';
    $cardBg = match($bgMode) {
        'dark' => '#1e293b',
        'soft' => '#ffffff',
        default => '#f8fafc',
    };
    $cardBorder = $bgMode === 'dark' ? 'rgba(255,255,255,0.07)' : '#e5e7eb';
    $sectionAlt = match($bgMode) {
        'dark' => '#162032',
        'soft' => '#f1f5f9',
        default => '#f8fafc',
    };
@endphp

<div style="font-family: 'DM Sans', system-ui, sans-serif; background: {{ $bgPage }}; color: {{ $textPrimary }}; font-size: 14px; line-height: 1.6;">

    {{-- ═══════ NAVBAR ═══════ --}}
    <nav style="background: {{ $bgMode === 'dark' ? '#0f172a' : 'white' }}; border-bottom: 1px solid {{ $cardBorder }}; padding: 12px 32px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 10;">
        <div style="font-weight: 800; font-size: 16px; color: {{ $colorPrimary }}; display: flex; align-items: center; gap: 6px;">
            <span style="display:inline-block; width:22px; height:22px; background:{{ $colorPrimary }}; border-radius:6px;"></span>
            {{ $siteName ?: 'Mi Empresa' }}
        </div>
        <div style="display: flex; gap: 20px; align-items: center;">
            @foreach(['Servicios','Nosotros','Precios','Contacto'] as $navItem)
                <span style="font-size: 13px; color: {{ $textSecondary }}; font-weight: 500; cursor: pointer;">{{ $navItem }}</span>
            @endforeach
            <span style="background: {{ $colorPrimary }}; color: white; padding: 6px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; cursor: pointer;">
                Empezar
            </span>
        </div>
    </nav>

    {{-- ═══════ BLOQUES ACTIVOS ═══════ --}}
    @foreach($blocks->where('is_active', true) as $block)

        {{-- Wrapper del bloque con highlight si está seleccionado --}}
        <div style="position: relative; {{ $selectedBlockId === $block->id ? 'outline: 2px solid '.$colorPrimary.'; outline-offset: -2px;' : '' }}">

            @if($selectedBlockId === $block->id)
                <div style="position: absolute; top: 0; left: 0; background: {{ $colorPrimary }}; color: white; font-size: 10px; font-weight: 700; padding: 2px 10px; border-radius: 0 0 6px 0; z-index: 5; font-family: 'DM Mono', monospace;">
                    {{ $block->getEmoji() }} {{ $block->getLabel() }}
                </div>
            @endif

            @switch($block->block_type)

                {{-- ─── HERO ─── --}}
                @case('hero')
                <section style="padding: 72px 48px; text-align: center; background: linear-gradient(135deg, {{ $colorPrimary }}10, {{ $bgPage }}, {{ $colorAccent }}08); position: relative; overflow: hidden;">
                    {{-- Grid dots decorativos --}}
                    <div style="position:absolute;inset:0;background-image:radial-gradient({{ $colorPrimary }}15 1px,transparent 1px);background-size:28px 28px;pointer-events:none;"></div>
                    <div style="position: relative; z-index: 1; max-width: 640px; margin: 0 auto;">
                        @if($block->setting('badge'))
                            <div style="display: inline-block; background: {{ $colorAccent }}15; color: {{ $colorAccent }}; border: 1px solid {{ $colorAccent }}30; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; margin-bottom: 20px;">
                                {{ $block->setting('badge') }}
                            </div>
                        @endif
                        <h1 style="font-size: 38px; font-weight: 900; line-height: 1.1; margin-bottom: 16px; letter-spacing: -0.03em; color: {{ $textPrimary }};">
                            {{ $block->setting('headline', 'El servicio que tu negocio necesita') }}
                        </h1>
                        <p style="font-size: 17px; color: {{ $textSecondary }}; margin-bottom: 32px; line-height: 1.6;">
                            {{ $block->setting('subheadline', 'Profesional · Confiable · Siempre disponible') }}
                        </p>
                        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                            <button style="background: {{ $colorPrimary }}; color: white; padding: 12px 28px; border-radius: 10px; font-size: 15px; font-weight: 700; border: none; cursor: pointer; box-shadow: 0 4px 20px {{ $colorPrimary }}40;">
                                {{ $block->setting('cta_text', 'Comenzar ahora') }}
                            </button>
                            @if($block->setting('cta2_text'))
                                <button style="background: transparent; color: {{ $textPrimary }}; padding: 12px 28px; border-radius: 10px; font-size: 15px; font-weight: 600; border: 1.5px solid {{ $cardBorder }}; cursor: pointer;">
                                    {{ $block->setting('cta2_text') }}
                                </button>
                            @endif
                        </div>
                    </div>
                </section>
                @break

                {{-- ─── SERVICES ─── --}}
                @case('services')
                <section style="padding: 64px 48px; background: {{ $sectionAlt }};">
                    <h2 style="text-align: center; font-size: 28px; font-weight: 800; margin-bottom: 8px; letter-spacing: -0.02em;">
                        {{ $block->setting('title', 'Lo que ofrecemos') }}
                    </h2>
                    <p style="text-align: center; color: {{ $textSecondary }}; margin-bottom: 40px; font-size: 15px;">
                        Soluciones diseñadas para tu negocio
                    </p>
                    <div style="display: grid; grid-template-columns: repeat({{ min(count($block->setting('items', [['icon'=>'🛡️','title'=>'Servicio 1','description'=>'Descripción del servicio'], ['icon'=>'⚡','title'=>'Servicio 2','description'=>'Descripción del servicio'], ['icon'=>'🎯','title'=>'Servicio 3','description'=>'Descripción del servicio']])), 3) }}, 1fr); gap: 20px; max-width: 900px; margin: 0 auto;">
                        @foreach($block->setting('items', [
                            ['icon' => '🛡️', 'title' => 'Servicio 1', 'description' => 'Descripción breve del servicio que ofreces.'],
                            ['icon' => '⚡', 'title' => 'Servicio 2', 'description' => 'Descripción breve del servicio que ofreces.'],
                            ['icon' => '🎯', 'title' => 'Servicio 3', 'description' => 'Descripción breve del servicio que ofreces.'],
                        ]) as $item)
                            <div style="background: {{ $cardBg }}; border: 1px solid {{ $cardBorder }}; border-radius: 16px; padding: 28px 24px; transition: all 0.2s;">
                                <div style="font-size: 28px; margin-bottom: 14px;">{{ $item['icon'] ?? '📦' }}</div>
                                <h3 style="font-size: 16px; font-weight: 800; margin-bottom: 8px;">{{ $item['title'] ?? 'Servicio' }}</h3>
                                <p style="font-size: 13px; color: {{ $textSecondary }}; line-height: 1.5;">{{ $item['description'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
                @break

                {{-- ─── GALLERY ─── --}}
                @case('gallery')
                <section style="padding: 64px 48px; background: {{ $bgPage }};">
                    @if($block->setting('title'))
                        <h2 style="text-align: center; font-size: 28px; font-weight: 800; margin-bottom: 36px; letter-spacing: -0.02em;">
                            {{ $block->setting('title') }}
                        </h2>
                    @endif
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; max-width: 900px; margin: 0 auto;">
                        @forelse($block->setting('images', []) as $image)
                            <div style="aspect-ratio: 4/3; border-radius: 12px; overflow: hidden; background: {{ $colorPrimary }}15;">
                                <img src="{{ $image['url'] }}" alt="{{ $image['alt'] ?? '' }}" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                        @empty
                            @for($i = 0; $i < 6; $i++)
                                <div style="aspect-ratio: 4/3; border-radius: 12px; background: linear-gradient(135deg, {{ $colorPrimary }}20, {{ $colorAccent }}15); border: 1px solid {{ $cardBorder }}; display: flex; align-items: center; justify-content: center; font-size: 24px; color: {{ $textSecondary }};">🖼️</div>
                            @endfor
                        @endforelse
                    </div>
                </section>
                @break

                {{-- ─── TESTIMONIALS ─── --}}
                @case('testimonials')
                <section style="padding: 64px 48px; background: {{ $sectionAlt }};">
                    <h2 style="text-align: center; font-size: 28px; font-weight: 800; margin-bottom: 36px; letter-spacing: -0.02em;">
                        {{ $block->setting('title', 'Lo que dicen nuestros clientes') }}
                    </h2>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; max-width: 900px; margin: 0 auto;">
                        @foreach($block->setting('items', [
                            ['text' => 'Increíble servicio, superó todas nuestras expectativas. Lo recomiendo al 100%.', 'author' => 'María García', 'role' => 'CEO, StartupXYZ', 'rating' => 5],
                            ['text' => 'La mejor decisión que tomamos para nuestro negocio. Resultados desde el primer día.', 'author' => 'Carlos López', 'role' => 'Director, EmpresaABC', 'rating' => 5],
                        ]) as $item)
                            <div style="background: {{ $cardBg }}; border: 1px solid {{ $cardBorder }}; border-radius: 16px; padding: 24px;">
                                {{-- Stars --}}
                                <div style="margin-bottom: 12px; color: {{ $colorAccent }}; font-size: 14px;">
                                    @for($s = 0; $s < ($item['rating'] ?? 5); $s++)★@endfor
                                </div>
                                <p style="font-size: 14px; color: {{ $textPrimary }}; line-height: 1.6; margin-bottom: 16px; font-style: italic;">
                                    "{{ $item['text'] }}"
                                </p>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 36px; height: 36px; border-radius: 50%; background: {{ $colorPrimary }}20; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 800; color: {{ $colorPrimary }}; flex-shrink: 0;">
                                        {{ strtoupper(substr($item['author'] ?? 'A', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-size: 13px; font-weight: 700;">{{ $item['author'] ?? '' }}</div>
                                        <div style="font-size: 11px; color: {{ $textSecondary }};">{{ $item['role'] ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                @break

                {{-- ─── PRICING ─── --}}
                @case('pricing')
                <section style="padding: 64px 48px; background: {{ $bgPage }};">
                    <h2 style="text-align: center; font-size: 28px; font-weight: 800; margin-bottom: 36px; letter-spacing: -0.02em;">
                        {{ $block->setting('title', 'Planes y precios') }}
                    </h2>
                    <div style="display: grid; grid-template-columns: repeat({{ count($block->setting('plans', [[],[],[]])) }}, 1fr); gap: 20px; max-width: 900px; margin: 0 auto;">
                        @foreach($block->setting('plans', [
                            ['name' => 'Básico', 'price' => '29', 'period' => 'mes', 'featured' => false, 'cta' => 'Empezar', 'features' => ['Feature 1', 'Feature 2', 'Feature 3']],
                            ['name' => 'Pro', 'price' => '79', 'period' => 'mes', 'featured' => true, 'cta' => 'Elegir Pro', 'features' => ['Todo en Básico', 'Feature 4', 'Feature 5', 'Feature 6']],
                            ['name' => 'Enterprise', 'price' => '199', 'period' => 'mes', 'featured' => false, 'cta' => 'Contactar', 'features' => ['Todo en Pro', 'Feature 7', 'Feature 8', 'Soporte 24/7']],
                        ]) as $plan)
                            <div style="background: {{ ($plan['featured'] ?? false) ? $colorPrimary : $cardBg }}; border: 2px solid {{ ($plan['featured'] ?? false) ? $colorPrimary : $cardBorder }}; border-radius: 20px; padding: 28px 24px; position: relative; {{ ($plan['featured'] ?? false) ? 'box-shadow: 0 8px 32px '.$colorPrimary.'40;' : '' }}">
                                @if($plan['featured'] ?? false)
                                    <div style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: {{ $colorAccent }}; color: white; font-size: 10px; font-weight: 800; padding: 3px 14px; border-radius: 20px;">MÁS POPULAR</div>
                                @endif
                                <div style="font-size: 14px; font-weight: 700; color: {{ ($plan['featured'] ?? false) ? 'rgba(255,255,255,0.8)' : $textSecondary }}; margin-bottom: 8px;">{{ $plan['name'] ?? 'Plan' }}</div>
                                <div style="font-size: 36px; font-weight: 900; color: {{ ($plan['featured'] ?? false) ? 'white' : $textPrimary }}; letter-spacing: -0.04em; margin-bottom: 4px;">
                                    {{ $block->setting('currency', '$') }}{{ $plan['price'] ?? '0' }}
                                    <span style="font-size: 14px; font-weight: 500; opacity: 0.7;">/ {{ $plan['period'] ?? 'mes' }}</span>
                                </div>
                                <div style="margin: 20px 0; border-top: 1px solid {{ ($plan['featured'] ?? false) ? 'rgba(255,255,255,0.15)' : $cardBorder }};"></div>
                                @foreach($plan['features'] ?? [] as $feature)
                                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; font-size: 13px; color: {{ ($plan['featured'] ?? false) ? 'rgba(255,255,255,0.9)' : $textPrimary }};">
                                        <span style="color: {{ ($plan['featured'] ?? false) ? 'rgba(255,255,255,0.9)' : $colorPrimary }}; font-weight: 700;">✓</span>
                                        {{ $feature }}
                                    </div>
                                @endforeach
                                <button style="margin-top: 20px; width: 100%; padding: 10px; border-radius: 10px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; background: {{ ($plan['featured'] ?? false) ? 'white' : $colorPrimary }}; color: {{ ($plan['featured'] ?? false) ? $colorPrimary : 'white' }};">
                                    {{ $plan['cta'] ?? 'Empezar' }}
                                </button>
                            </div>
                        @endforeach
                    </div>
                </section>
                @break

                {{-- ─── FAQ ─── --}}
                @case('faq')
                <section style="padding: 64px 48px; background: {{ $sectionAlt }};">
                    <h2 style="text-align: center; font-size: 28px; font-weight: 800; margin-bottom: 36px; letter-spacing: -0.02em;">
                        {{ $block->setting('title', 'Preguntas frecuentes') }}
                    </h2>
                    <div style="max-width: 680px; margin: 0 auto; display: flex; flex-direction: column; gap: 10px;">
                        @foreach($block->setting('items', [
                            ['question' => '¿Cómo funciona el servicio?', 'answer' => 'Nuestro servicio es simple y rápido. Te registras, configuras tu perfil y empiezas a usar todas las funcionalidades de inmediato.'],
                            ['question' => '¿Hay período de prueba gratuito?', 'answer' => 'Sí, ofrecemos 14 días de prueba gratuita sin necesidad de tarjeta de crédito.'],
                            ['question' => '¿Puedo cancelar en cualquier momento?', 'answer' => 'Por supuesto. Puedes cancelar tu suscripción cuando quieras sin penalizaciones.'],
                        ]) as $i => $faq)
                            <div style="background: {{ $cardBg }}; border: 1px solid {{ $cardBorder }}; border-radius: 12px; overflow: hidden;">
                                <div style="padding: 18px 20px; display: flex; align-items: center; justify-content: space-between; cursor: pointer;">
                                    <span style="font-weight: 700; font-size: 14px;">{{ $faq['question'] }}</span>
                                    <span style="font-size: 18px; color: {{ $colorPrimary }}; flex-shrink: 0; margin-left: 12px;">{{ $i === 0 ? '−' : '+' }}</span>
                                </div>
                                @if($i === 0)
                                <div style="padding: 0 20px 18px; font-size: 13px; color: {{ $textSecondary }}; line-height: 1.6; border-top: 1px solid {{ $cardBorder }}; padding-top: 14px;">
                                    {{ $faq['answer'] }}
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
                @break

                {{-- ─── CTA ─── --}}
                @case('cta')
                <section style="padding: 60px 48px; text-align: center; background: {{ $colorPrimary }}; position: relative; overflow: hidden;">
                    <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.08) 1px,transparent 1px);background-size:24px 24px;pointer-events:none;"></div>
                    <div style="position: relative; z-index: 1;">
                        <h2 style="font-size: 30px; font-weight: 900; color: white; margin-bottom: 12px; letter-spacing: -0.02em;">
                            {{ $block->setting('title', '¿Listo para empezar?') }}
                        </h2>
                        @if($block->setting('subtitle'))
                            <p style="color: rgba(255,255,255,0.75); font-size: 16px; margin-bottom: 28px;">
                                {{ $block->setting('subtitle') }}
                            </p>
                        @else
                            <p style="color: rgba(255,255,255,0.75); font-size: 16px; margin-bottom: 28px;">
                                Únete a cientos de clientes que ya confían en nosotros.
                            </p>
                        @endif
                        <button style="background: white; color: {{ $colorPrimary }}; padding: 14px 36px; border-radius: 12px; font-size: 16px; font-weight: 800; border: none; cursor: pointer; box-shadow: 0 8px 32px rgba(0,0,0,0.15);">
                            {{ $block->setting('cta_text', 'Comenzar ahora') }}
                        </button>
                    </div>
                </section>
                @break

                {{-- ─── CONTACT ─── --}}
                @case('contact')
                <section style="padding: 64px 48px; background: {{ $bgPage }};">
                    <h2 style="text-align: center; font-size: 28px; font-weight: 800; margin-bottom: 36px; letter-spacing: -0.02em;">
                        {{ $block->setting('title', 'Contáctanos') }}
                    </h2>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; max-width: 800px; margin: 0 auto; align-items: start;">
                        {{-- Datos --}}
                        <div style="display: flex; flex-direction: column; gap: 16px;">
                            @if($block->setting('email'))
                                <div style="display: flex; align-items: center; gap: 12px; padding: 16px; background: {{ $cardBg }}; border: 1px solid {{ $cardBorder }}; border-radius: 12px;">
                                    <span style="font-size: 20px;">📧</span>
                                    <div>
                                        <div style="font-size: 11px; color: {{ $textSecondary }}; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Email</div>
                                        <div style="font-size: 14px; font-weight: 600;">{{ $block->setting('email') }}</div>
                                    </div>
                                </div>
                            @endif
                            @if($block->setting('phone'))
                                <div style="display: flex; align-items: center; gap: 12px; padding: 16px; background: {{ $cardBg }}; border: 1px solid {{ $cardBorder }}; border-radius: 12px;">
                                    <span style="font-size: 20px;">📞</span>
                                    <div>
                                        <div style="font-size: 11px; color: {{ $textSecondary }}; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Teléfono</div>
                                        <div style="font-size: 14px; font-weight: 600;">{{ $block->setting('phone') }}</div>
                                    </div>
                                </div>
                            @endif
                            @if(!$block->setting('email') && !$block->setting('phone'))
                                <div style="padding: 20px; background: {{ $cardBg }}; border: 1px solid {{ $cardBorder }}; border-radius: 12px; text-align: center; color: {{ $textSecondary }}; font-size: 13px;">
                                    Agrega tus datos de contacto en el panel de edición.
                                </div>
                            @endif
                        </div>
                        {{-- Mini form --}}
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <input placeholder="Tu nombre" style="padding: 12px 16px; border: 1px solid {{ $cardBorder }}; border-radius: 10px; font-size: 14px; background: {{ $cardBg }}; color: {{ $textPrimary }}; width: 100%;">
                            <input placeholder="Tu email" style="padding: 12px 16px; border: 1px solid {{ $cardBorder }}; border-radius: 10px; font-size: 14px; background: {{ $cardBg }}; color: {{ $textPrimary }}; width: 100%;">
                            <textarea placeholder="Tu mensaje..." rows="4" style="padding: 12px 16px; border: 1px solid {{ $cardBorder }}; border-radius: 10px; font-size: 14px; background: {{ $cardBg }}; color: {{ $textPrimary }}; width: 100%; resize: none;"></textarea>
                            <button style="background: {{ $colorPrimary }}; color: white; padding: 12px; border-radius: 10px; font-weight: 700; font-size: 14px; border: none; cursor: pointer;">Enviar mensaje</button>
                        </div>
                    </div>
                </section>
                @break

                {{-- ─── ABOUT ─── --}}
                @case('about')
                <section style="padding: 64px 48px; background: {{ $sectionAlt }};">
                    <div style="display: grid; grid-template-columns: {{ $block->setting('image_url') ? '1fr 1fr' : '1fr' }}; gap: 48px; max-width: 900px; margin: 0 auto; align-items: center;">
                        <div>
                            <h2 style="font-size: 28px; font-weight: 800; margin-bottom: 16px; letter-spacing: -0.02em;">
                                {{ $block->setting('title', 'Sobre nosotros') }}
                            </h2>
                            <p style="font-size: 15px; color: {{ $textSecondary }}; line-height: 1.7;">
                                {{ $block->setting('body', 'Somos un equipo apasionado comprometido con brindar el mejor servicio. Nuestra misión es hacer que tu negocio crezca con las herramientas adecuadas.') }}
                            </p>
                        </div>
                        @if($block->setting('image_url'))
                            <div style="border-radius: 20px; overflow: hidden; aspect-ratio: 4/3;">
                                <img src="{{ $block->setting('image_url') }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @endif
                    </div>
                </section>
                @break

                {{-- ─── ACHIEVEMENTS ─── --}}
                @case('achievements')
                <section style="padding: 48px; background: {{ $bgPage }};">
                    <div style="display: grid; grid-template-columns: repeat({{ count($block->setting('items', [[],[],[],[]])) }}, 1fr); gap: 24px; max-width: 900px; margin: 0 auto; text-align: center;">
                        @foreach($block->setting('items', [
                            ['icon' => '🚀', 'title' => 'Clientes', 'value' => '+500'],
                            ['icon' => '⭐', 'title' => 'Valoración', 'value' => '4.9/5'],
                            ['icon' => '🌍', 'title' => 'Países', 'value' => '12+'],
                            ['icon' => '📈', 'title' => 'Crecimiento', 'value' => '300%'],
                        ]) as $item)
                            <div>
                                <div style="font-size: 28px; margin-bottom: 8px;">{{ $item['icon'] ?? '📊' }}</div>
                                <div style="font-size: 28px; font-weight: 900; color: {{ $colorPrimary }}; letter-spacing: -0.03em;">{{ $item['value'] ?? '—' }}</div>
                                <div style="font-size: 13px; color: {{ $textSecondary }}; margin-top: 4px; font-weight: 600;">{{ $item['title'] ?? '' }}</div>
                            </div>
                        @endforeach
                    </div>
                </section>
                @break

                {{-- ─── CATALOG ─── --}}
                @case('catalog')
                <section style="padding: 64px 48px; background: {{ $sectionAlt }};">
                    <h2 style="text-align: center; font-size: 28px; font-weight: 800; margin-bottom: 36px; letter-spacing: -0.02em;">
                        {{ $block->setting('title', 'Nuestros productos') }}
                    </h2>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; max-width: 900px; margin: 0 auto;">
                        @foreach($block->setting('items', [
                            ['name' => 'Producto 1', 'price' => '99', 'image_url' => null],
                            ['name' => 'Producto 2', 'price' => '149', 'image_url' => null],
                            ['name' => 'Producto 3', 'price' => '199', 'image_url' => null],
                        ]) as $item)
                            <div style="background: {{ $cardBg }}; border: 1px solid {{ $cardBorder }}; border-radius: 16px; overflow: hidden;">
                                <div style="height: 120px; background: linear-gradient(135deg, {{ $colorPrimary }}15, {{ $colorAccent }}10); display: flex; align-items: center; justify-content: center; font-size: 32px;">
                                    @if($item['image_url'] ?? null)
                                        <img src="{{ $item['image_url'] }}" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        🗂️
                                    @endif
                                </div>
                                <div style="padding: 14px 16px;">
                                    <div style="font-size: 14px; font-weight: 700; margin-bottom: 6px;">{{ $item['name'] ?? 'Producto' }}</div>
                                    @if($block->setting('show_price', true) && ($item['price'] ?? null))
                                        <div style="font-size: 18px; font-weight: 900; color: {{ $colorPrimary }};">${{ $item['price'] }}</div>
                                    @endif
                                    <button style="margin-top: 12px; width: 100%; padding: 8px; background: {{ $colorPrimary }}; color: white; border: none; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer;">Ver más</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                @break

                {{-- ─── STORY ─── --}}
                @case('story')
                <section style="padding: 64px 48px; background: {{ $bgPage }};">
                    <h2 style="text-align: center; font-size: 28px; font-weight: 800; margin-bottom: 48px; letter-spacing: -0.02em;">
                        {{ $block->setting('title', 'Nuestra historia') }}
                    </h2>
                    <div style="max-width: 600px; margin: 0 auto; position: relative;">
                        <div style="position: absolute; left: 20px; top: 0; bottom: 0; width: 2px; background: {{ $colorPrimary }}20;"></div>
                        @foreach($block->setting('milestones', [
                            ['year' => '2019', 'event' => 'Fundación de la empresa'],
                            ['year' => '2021', 'event' => 'Primer cliente internacional'],
                            ['year' => '2023', 'event' => 'Alcanzamos 500 clientes'],
                            ['year' => '2024', 'event' => 'Expansión regional'],
                        ]) as $milestone)
                            <div style="display: flex; gap: 24px; margin-bottom: 28px; position: relative;">
                                <div style="width: 40px; height: 40px; background: {{ $colorPrimary }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 11px; font-weight: 800; color: white; z-index: 1;">
                                    {{ substr($milestone['year'] ?? '', -2) }}
                                </div>
                                <div style="background: {{ $cardBg }}; border: 1px solid {{ $cardBorder }}; border-radius: 12px; padding: 16px 20px; flex: 1;">
                                    <div style="font-size: 12px; font-weight: 700; color: {{ $colorPrimary }}; margin-bottom: 4px;">{{ $milestone['year'] ?? '' }}</div>
                                    <div style="font-size: 14px; font-weight: 600;">{{ $milestone['event'] ?? '' }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                @break

                {{-- ─── TRUST ─── --}}
                @case('trust')
                <section style="padding: 40px 48px; background: {{ $sectionAlt }}; text-align: center;">
                    @if($block->setting('title'))
                        <p style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: {{ $textSecondary }}; margin-bottom: 24px;">
                            {{ $block->setting('title') }}
                        </p>
                    @endif
                    <div style="display: flex; justify-content: center; align-items: center; gap: 40px; flex-wrap: wrap; opacity: 0.5; filter: grayscale(100%);">
                        @foreach($block->setting('items', [
                            ['icon' => '🏢', 'title' => 'Empresa A'],
                            ['icon' => '🌐', 'title' => 'Empresa B'],
                            ['icon' => '🏆', 'title' => 'Empresa C'],
                            ['icon' => '⭐', 'title' => 'Empresa D'],
                            ['icon' => '🚀', 'title' => 'Empresa E'],
                        ]) as $item)
                            <div style="display: flex; align-items: center; gap: 8px; font-weight: 800; font-size: 15px;">
                                <span style="font-size: 20px;">{{ $item['icon'] ?? '🏢' }}</span>
                                {{ $item['title'] ?? '' }}
                            </div>
                        @endforeach
                    </div>
                </section>
                @break

                {{-- ─── FALLBACK ─── --}}
                @default
                <section style="padding: 48px; background: {{ $sectionAlt }}; text-align: center; border: 2px dashed {{ $cardBorder }}; margin: 8px 24px; border-radius: 16px;">
                    <div style="font-size: 28px; margin-bottom: 8px;">{{ $block->getEmoji() }}</div>
                    <p style="font-size: 13px; color: {{ $textSecondary }}; font-weight: 600;">{{ $block->getLabel() }}</p>
                    <p style="font-size: 11px; color: {{ $textSecondary }}; opacity: 0.5; margin-top: 4px;">Bloque sin preview definido</p>
                </section>

            @endswitch

        </div>{{-- /block wrapper --}}

    @endforeach

    {{-- ═══════ FOOTER ═══════ --}}
    <footer style="background: {{ $bgMode === 'dark' ? '#020617' : '#1e293b' }}; color: rgba(255,255,255,0.5); padding: 28px 48px; display: flex; align-items: center; justify-content: space-between; font-size: 13px;">
        <div style="display: flex; align-items: center; gap: 8px; font-weight: 700; color: white;">
            <span style="display:inline-block; width:18px; height:18px; background:{{ $colorPrimary }}; border-radius:4px;"></span>
            {{ $siteName ?: 'Mi Empresa' }}
        </div>
        <div>© {{ date('Y') }} · Todos los derechos reservados</div>
        <div style="display: flex; gap: 8px;">
            <span style="width: 8px; height: 8px; border-radius: 50%; background: {{ $colorPrimary }}; display: inline-block;"></span>
            <span style="width: 8px; height: 8px; border-radius: 50%; background: {{ $colorAccent }}; display: inline-block;"></span>
            <span style="width: 8px; height: 8px; border-radius: 50%; background: {{ $colorNeutral }}; display: inline-block;"></span>
        </div>
    </footer>

</div>