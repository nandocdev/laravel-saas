<?php

namespace App\Tenant\Services;

use App\Tenant\Landing\DTO\LandingConfig;
use App\Tenant\Landing\Support\LandingRegistry;

final class LandingConfigService {
   public function __construct(private readonly LandingRegistry $registry) {
   }

   public function resolveForTenant(mixed $tenant): array {
      $raw = $tenant?->landing_page_config;

      if (is_string($raw)) {
         $raw = json_decode($raw, true);
      }

      return $this->normalize(is_array($raw) ? $raw : null, $tenant);
   }

   public function normalize(?array $rawConfig, mixed $tenant = null): array {
      $defaults = (array) config('landing.defaults', []);
      $template = (string) ($rawConfig['template'] ?? $defaults['template'] ?? 'corporate');
      if (! in_array($template, $this->registry->availableTemplateKeys(), true)) {
         $template = (string) ($defaults['template'] ?? 'corporate');
      }

      $rawStyle = (array) ($rawConfig['style'] ?? []);
      $legacyColors = (array) ($rawConfig['colors'] ?? []);

      $style = [
         'primary' => (string) ($rawStyle['primary'] ?? $legacyColors['primary'] ?? data_get($defaults, 'style.primary', '#644FB5')),
         'neutral' => (string) ($rawStyle['neutral'] ?? $legacyColors['neutral'] ?? data_get($defaults, 'style.neutral', '#F8FAFC')),
         'accent' => (string) ($rawStyle['accent'] ?? $legacyColors['secondary'] ?? data_get($defaults, 'style.accent', '#F5A623')),
         'font' => (string) ($rawStyle['font'] ?? data_get($defaults, 'style.font', 'Roboto')),
         'bgMode' => (string) ($rawStyle['bgMode'] ?? data_get($defaults, 'style.bgMode', 'grid')),
         'custom_css' => (string) ($rawStyle['custom_css'] ?? data_get($defaults, 'style.custom_css', '')),
      ];

      $assets = [
         'logo' => data_get($rawConfig, 'assets.logo', $rawConfig['logo'] ?? data_get($defaults, 'assets.logo')),
      ];

      $sections = $this->normalizeSections($rawConfig, $tenant);

      return LandingConfig::fromArray([
         'template' => $template,
         'style' => $style,
         'sections' => $sections,
         'assets' => $assets,
      ])->toArray();
   }

   public function toEditorState(array $config): array {
      $sections = collect((array) ($config['sections'] ?? []))
         ->sortBy('order')
         ->values()
         ->all();

      return [
         'template' => (string) ($config['template'] ?? 'corporate'),
         'primary_color' => (string) data_get($config, 'style.primary', '#644FB5'),
         'secondary_color' => (string) data_get($config, 'style.accent', '#F5A623'),
         'font' => (string) data_get($config, 'style.font', 'Roboto'),
         'custom_css' => (string) data_get($config, 'style.custom_css', ''),
         'existing_logo' => data_get($config, 'assets.logo'),
         'blocks' => array_map(function (array $section): array {
            return [
               'id' => uniqid('section_', true),
               'type' => $section['key'],
               'visible' => (bool) ($section['active'] ?? true),
               'data' => (array) ($section['content'] ?? []),
               'order' => (int) ($section['order'] ?? 0),
            ];
         }, $sections),
      ];
   }

   public function fromEditorState(array $state): array {
      $blocks = array_values((array) ($state['blocks'] ?? []));

      $sections = [];
      foreach ($blocks as $index => $block) {
         $key = (string) ($block['type'] ?? '');
         if (! $this->registry->hasSection($key)) {
            continue;
         }

         $sections[] = [
            'key' => $key,
            'active' => (bool) ($block['visible'] ?? true),
            'order' => $index + 1,
            'content' => $this->mergeSectionContentWithDefaults($key, (array) ($block['data'] ?? [])),
         ];
      }

      return [
         'template' => (string) ($state['template'] ?? config('landing.defaults.template', 'corporate')),
         'style' => [
            'primary' => (string) ($state['primary_color'] ?? data_get(config('landing.defaults'), 'style.primary', '#644FB5')),
            'neutral' => (string) data_get(config('landing.defaults'), 'style.neutral', '#F8FAFC'),
            'accent' => (string) ($state['secondary_color'] ?? data_get(config('landing.defaults'), 'style.accent', '#F5A623')),
            'font' => (string) ($state['font'] ?? data_get(config('landing.defaults'), 'style.font', 'Roboto')),
            'bgMode' => (string) data_get(config('landing.defaults'), 'style.bgMode', 'grid'),
            'custom_css' => (string) ($state['custom_css'] ?? ''),
         ],
         'assets' => [
            'logo' => $state['existing_logo'] ?? null,
         ],
         'sections' => $sections,
      ];
   }

   public function defaultSectionContent(string $sectionKey): array {
      return $this->registry->sectionDefaults($sectionKey);
   }

   public function availableTemplateKeys(): array {
      return $this->registry->availableTemplateKeys();
   }

   public function availableSectionKeys(): array {
      return $this->registry->availableSectionKeys();
   }

   private function normalizeSections(?array $rawConfig, mixed $tenant = null): array {
      $sections = [];
      $rawSections = (array) ($rawConfig['sections'] ?? []);

      if ($rawSections !== []) {
         foreach ($rawSections as $index => $section) {
            $key = (string) ($section['key'] ?? '');
            if (! $this->registry->hasSection($key)) {
               continue;
            }

            $sections[] = [
               'key' => $key,
               'active' => (bool) ($section['active'] ?? true),
               'order' => (int) ($section['order'] ?? ($index + 1)),
               'content' => $this->mergeSectionContentWithDefaults($key, (array) ($section['content'] ?? [])),
            ];
         }
      }

      $legacyBlocks = (array) ($rawConfig['blocks'] ?? []);
      if ($sections === [] && $legacyBlocks !== []) {
         foreach ($legacyBlocks as $index => $block) {
            $key = (string) ($block['type'] ?? '');
            if (! $this->registry->hasSection($key)) {
               continue;
            }

            $sections[] = [
               'key' => $key,
               'active' => (bool) ($block['visible'] ?? true),
               'order' => $index + 1,
               'content' => $this->mergeSectionContentWithDefaults($key, (array) ($block['data'] ?? [])),
            ];
         }
      }

      if ($sections === []) {
         $sections = [[
            'key' => 'hero',
            'active' => true,
            'order' => 1,
            'content' => $this->mergeSectionContentWithDefaults('hero', [
               'title' => (string) ($tenant?->company_name ?? $tenant?->id ?? 'Welcome'),
               'subtitle' => 'The best solutions for your business.',
               'cta_text' => 'Contact Us',
               'cta_link' => '#contact',
            ]),
         ]];
      }

      return collect($sections)
         ->sortBy('order')
         ->values()
         ->map(function (array $section, int $index): array {
            $section['order'] = $index + 1;

            return $section;
         })
         ->all();
   }

   private function mergeSectionContentWithDefaults(string $sectionKey, array $content): array {
      $defaults = $this->registry->sectionDefaults($sectionKey);

      return array_replace_recursive($defaults, $content);
   }
}
