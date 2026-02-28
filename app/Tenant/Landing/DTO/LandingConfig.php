<?php

namespace App\Tenant\Landing\DTO;

final class LandingConfig {
   public function __construct(
      public readonly string $template,
      public readonly array $style,
      public readonly array $sections,
      public readonly array $assets = [],
   ) {
   }

   public static function fromArray(array $data): self {
      return new self(
         template: (string) ($data['template'] ?? config('landing.defaults.template', 'corporate')),
         style: (array) ($data['style'] ?? []),
         sections: (array) ($data['sections'] ?? []),
         assets: (array) ($data['assets'] ?? []),
      );
   }

   public function toArray(): array {
      return [
         'template' => $this->template,
         'style' => $this->style,
         'sections' => $this->sections,
         'assets' => $this->assets,
      ];
   }
}
