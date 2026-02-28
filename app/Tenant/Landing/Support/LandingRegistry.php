<?php

namespace App\Tenant\Landing\Support;

final class LandingRegistry {
   public function templateView(string $templateKey): string {
      $templates = (array) config('landing.templates', []);

      return $templates[$templateKey]
         ?? $templates[config('landing.defaults.template', 'corporate')]
         ?? 'templates.corporate';
   }

   public function sectionComponent(string $sectionKey): ?string {
      return data_get(config('landing.sections'), $sectionKey . '.component');
   }

   public function sectionDefaults(string $sectionKey): array {
      return (array) data_get(config('landing.sections'), $sectionKey . '.defaults', []);
   }

   public function hasSection(string $sectionKey): bool {
      return $this->sectionComponent($sectionKey) !== null;
   }

   public function availableTemplateKeys(): array {
      return array_keys((array) config('landing.templates', []));
   }

   public function availableSectionKeys(): array {
      return array_keys((array) config('landing.sections', []));
   }
}
