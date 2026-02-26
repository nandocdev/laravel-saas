<?php

namespace App\Tenant\Landing\Renderers;

use App\Tenant\Landing\Support\LandingRegistry;

final class LandingRenderer {
   public function __construct(private readonly LandingRegistry $registry) {
   }

   public function renderTemplate(array $config): array {
      $style = (array) ($config['style'] ?? []);
      $sections = collect((array) ($config['sections'] ?? []))
         ->sortBy(fn(array $section): int => (int) ($section['order'] ?? 0))
         ->map(fn(array $section): ?array => $this->renderSection($section, $style))
         ->filter()
         ->values()
         ->all();

      return [
         'template' => (string) ($config['template'] ?? config('landing.defaults.template', 'corporate')),
         'templateView' => $this->registry->templateView((string) ($config['template'] ?? 'corporate')),
         'style' => $style,
         'assets' => (array) ($config['assets'] ?? []),
         'sections' => $sections,
         'config' => $config,
      ];
   }

   public function renderSection(array $section, array $style): ?array {
      $isActive = (bool) ($section['active'] ?? true);
      if (! $isActive) {
         return null;
      }

      $key = (string) ($section['key'] ?? '');
      $component = $this->registry->sectionComponent($key);
      if (! $component) {
         return null;
      }

      return [
         'key' => $key,
         'order' => (int) ($section['order'] ?? 0),
         'component' => $component,
         'content' => (array) ($section['content'] ?? []),
         'style' => $style,
      ];
   }
}
