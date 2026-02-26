{{--
    resources/views/tenant/landing/public.blade.php
    Vista pública principal generada por el módulo Landing Builder.
    El controlador inyecta las variables generadas por LandingRendererService.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $meta['title'] }}</title>
    
    @if($meta['description'])
        <meta name="description" content="{{ $meta['description'] }}">
    @endif
    
    @if($meta['faviconUrl'])
        <link rel="icon" href="{{ $meta['faviconUrl'] }}">
    @endif

    {{-- Fonts preload --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{ $fontUrl }}" rel="stylesheet">

    {{-- Tailwind via CDN para el builder público (aislado del panel) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '{{ $theme['primary'] }}',
                        neutral: '{{ $theme['neutral'] }}',
                        accent: '{{ $theme['accent'] }}',
                        bgPage: '{{ $theme['bgPage'] }}',
                        bgSection: '{{ $theme['bgSection'] }}',
                        bgCard: '{{ $theme['bgCard'] }}',
                        borderColor: '{{ $theme['borderColor'] }}',
                        textPrimary: '{{ $theme['textPrimary'] }}',
                        textSecondary: '{{ $theme['textSecondary'] }}',
                        navBg: '{{ $theme['navBg'] }}',
                        footerBg: '{{ $theme['footerBg'] }}',
                    },
                    fontFamily: {
                        base: {!! $theme['fontStack'] !!},
                    }
                }
            }
        }
    </script>

    {{-- Custom CSS si existe --}}
    @if($meta['customCss'])
        <style>
            {!! $meta['customCss'] !!}
        </style>
    @endif

    <style>
        body {
            font-family: {!! $theme['fontStack'] !!};
            background-color: {{ $theme['bgPage'] }};
            color: {{ $theme['textPrimary'] }};
        }
        
        .btn-primary {
            background-color: {{ $theme['btnPrimaryBg'] }};
            color: {{ $theme['btnPrimaryText'] }};
            box-shadow: 0 4px 14px 0 {{ $theme['shadowPrimary'] }};
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px 0 {{ $theme['shadowPrimary'] }};
        }
        
        .card {
            background-color: {{ $theme['bgCard'] }};
            border: 1px solid {{ $theme['borderColor'] }};
        }
        
        /* Alpine cloak para evitar flashes */
        [x-cloak] { display: none !important; }
    </style>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased min-h-screen flex flex-col">

    {{-- Banner de Borrador (solo visible si no está publicada y el usuario entró por preview) --}}
    @if(!$isPublished)
        <div class="fixed top-0 inset-x-0 z-50 bg-amber-500 text-white font-bold text-center py-2 text-sm shadow-md flex justify-center items-center gap-2">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            Modo Vista Previa — Esta landing está en borrador y no es visible públicamente.
        </div>
    @endif

    {{-- NAVBAR --}}
    <header x-data="{ mobileMenuOpen: false, scrolled: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 20)"
            class="sticky top-0 z-40 transition-all duration-300 {{ !$isPublished ? 'mt-9' : '' }}"
            :class="scrolled ? 'bg-navBg/90 backdrop-blur-md shadow-sm border-b border-borderColor' : 'bg-transparent'">
        
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" aria-label="Top">
            <div class="w-full py-4 flex items-center justify-between">
                
                {{-- Logo o Nombre del Sitio --}}
                <div class="flex items-center">
                    <a href="#" class="flex items-center gap-3">
                        @if($meta['logoUrl'])
                            <img src="{{ $meta['logoUrl'] }}" alt="{{ $meta['siteName'] }}" class="h-8 w-auto">
                        @else
                            <div class="size-8 rounded-lg bg-primary flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold tracking-tighter text-lg leading-none">{{ substr($meta['siteName'], 0, 1) }}</span>
                            </div>
                            <span class="font-bold text-xl tracking-tight text-textPrimary">{{ $meta['siteName'] }}</span>
                        @endif
                    </a>
                </div>
                
                {{-- Navegación Desktop --}}
                <div class="hidden md:flex ml-10 space-x-8 items-center">
                    @foreach($navItems as $item)
                        <a href="{{ $item['anchor'] }}" class="text-base font-medium text-textSecondary hover:text-primary transition-colors">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                    <a href="#cta" class="inline-block bg-primary text-white font-semibold py-2 px-6 rounded-full hover:bg-opacity-90 transition-all shadow-md">
                        Comenzar
                    </a>
                </div>

                {{-- Hamburger móvil --}}
                <div class="-mr-2 flex md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="bg-cardBg rounded-md p-2 inline-flex items-center justify-center text-textSecondary hover:text-primary hover:bg-sectionBg focus:outline-none">
                        <span class="sr-only">Abrir menú</span>
                        <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg class="h-6 w-6" x-show="mobileMenuOpen" x-cloak fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </nav>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenuOpen" x-collapse class="md:hidden bg-navBg border-b border-borderColor shadow-lg absolute w-full left-0">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                @foreach($navItems as $item)
                    <a href="{{ $item['anchor'] }}" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-md text-base font-medium text-textSecondary hover:text-primary hover:bg-sectionBg">
                        {{ $item['label'] }}
                    </a>
                @endforeach
                <a href="#cta" @click="mobileMenuOpen = false" class="block text-center mt-4 bg-primary text-white font-semibold py-3 px-6 rounded-lg">
                    Comenzar ahora
                </a>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT (Los bloques renderizados aquí) --}}
    <main class="flex-grow flex flex-col bg-bgPage text-textPrimary">
        
        @if($blocks->isEmpty())
            <div class="flex-grow flex items-center justify-center p-8 bg-bgSection">
                <div class="text-center max-w-md bg-bgCard p-8 rounded-2xl border border-borderColor shadow-sm">
                    <div class="text-5xl mb-4">🏗️</div>
                    <h2 class="text-2xl font-bold mb-2 text-textPrimary">Aún no hay contenido</h2>
                    <p class="text-textSecondary">Esta landing page aún no tiene secciones activas. Por favor, añade bloques desde el editor.</p>
                </div>
            </div>
        @else
            @foreach($blocks as $block)
                {{-- ID para anclas de navegación --}}
                <div id="{{ $block->block_type }}" class="relative scroll-mt-20">
                    {{-- 
                        Aquí requerimos la vista pública de cada bloque.
                        Como no tenemos esas vistas específicas completamente diseñadas para público,
                        iniciaremos incrustando una vista de "reemplazo" genérica que podemos rellenar
                        o crearemos un componente para renderizarlas basadas en el tipo.
                    --}}
                    @includeIf("tenant.landing.blocks.{$block->block_type}", ['block' => $block, 'settings' => $block->settings, 'theme' => $theme])
                    
                    {{-- Fallback temporal si la vista específica no existe --}}
                    @if(!view()->exists("tenant.landing.blocks.{$block->block_type}"))
                        <section class="py-20 bg-bgSection border-y border-borderColor relative overflow-hidden">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                                <span class="text-6xl mb-4 block">{{ $block->getEmoji() }}</span>
                                <h2 class="text-3xl font-bold mb-4 tracking-tight">{{ $block->setting('title') ?? $block->setting('headline') ?? $block->getLabel() }}</h2>
                                <p class="text-textSecondary max-w-2xl mx-auto opacity-70">
                                    Vista pública del bloque <code>{{ $block->block_type }}</code> no encontrada.<br>
                                    Crea el archivo <code>resources/views/tenant/landing/blocks/{{ $block->block_type }}.blade.php</code>.
                                </p>
                            </div>
                        </section>
                    @endif
                </div>
            @endforeach
        @endif

    </main>

    {{-- FOOTER --}}
    <footer class="bg-footerBg text-gray-400 py-12 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                
                {{-- Identidad --}}
                <div class="flex items-center gap-3">
                    @if($meta['logoUrl'])
                        <img src="{{ $meta['logoUrl'] }}" alt="{{ $meta['siteName'] }}" class="h-8 w-auto grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all">
                    @else
                        <div class="size-8 rounded bg-white/10 flex items-center justify-center">
                            <span class="text-white font-bold">{{ substr($meta['siteName'], 0, 1) }}</span>
                        </div>
                        <span class="font-bold text-lg text-white">{{ $meta['siteName'] }}</span>
                    @endif
                </div>

                {{-- Links --}}
                <div class="flex flex-wrap justify-center gap-6 text-sm">
                    @foreach($navItems as $item)
                        <a href="{{ $item['anchor'] }}" class="hover:text-white transition-colors">{{ $item['label'] }}</a>
                    @endforeach
                </div>

                {{-- Copy --}}
                <div class="text-sm">
                    &copy; {{ date('Y') }} {{ $meta['siteName'] }}. Todos los derechos reservados.
                </div>
            </div>
            
            {{-- Powered By --}}
            <div class="mt-12 pt-8 border-t border-white/10 text-center text-xs text-gray-600 flex justify-center items-center gap-2">
                Creado con
                <span style="color: {{ $theme['primary'] }}" class="font-bold flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    SaaSFlow
                </span>
            </div>
        </div>
    </footer>

</body>
</html>
