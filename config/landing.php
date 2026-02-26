<?php

return [
   'templates' => [
      'corporate' => 'templates.corporate',
      'visual' => 'templates.visual',
      'conversion' => 'templates.conversion',
      'storytelling' => 'templates.storytelling',
      'catalog' => 'templates.catalog',
      'onepage' => 'templates.onepage',
   ],

   'sections' => [
      'hero' => [
         'component' => 'blocks.hero',
         'defaults' => [
            'title' => 'Welcome',
            'subtitle' => 'The best solutions for your business.',
            'cta_text' => 'Contact Us',
            'cta_link' => '#contact',
         ],
      ],
      'features' => [
         'component' => 'blocks.features',
         'defaults' => [
            'items' => [
               ['title' => 'Feature 1', 'description' => 'Description for feature 1'],
               ['title' => 'Feature 2', 'description' => 'Description for feature 2'],
               ['title' => 'Feature 3', 'description' => 'Description for feature 3'],
            ],
         ],
      ],
      'testimonials' => [
         'component' => 'blocks.testimonials',
         'defaults' => [
            'heading' => 'Testimonials',
            'items' => [
               ['name' => 'John Doe', 'role' => 'CEO', 'quote' => 'Great!'],
            ],
         ],
      ],
      'pricing' => [
         'component' => 'blocks.pricing',
         'defaults' => [
            'heading' => 'Pricing',
            'items' => [
               [
                  'name' => 'Basic',
                  'price' => '10',
                  'popular' => false,
                  'features' => ['A', 'B'],
                  'cta_text' => 'Choose Plan',
                  'cta_link' => '#',
               ],
            ],
         ],
      ],
      'faq' => [
         'component' => 'blocks.faq',
         'defaults' => [
            'heading' => 'FAQ',
            'items' => [
               ['question' => 'What is this?', 'answer' => 'An answer'],
            ],
         ],
      ],
      'contact' => [
         'component' => 'blocks.contact',
         'defaults' => [
            'heading' => 'Contact Us',
            'description' => 'Drop us a line.',
            'email' => 'hello@example.com',
            'phone' => '',
            'address' => '',
         ],
      ],
   ],

   'defaults' => [
      'template' => 'corporate',
      'style' => [
         'primary' => '#644FB5',
         'neutral' => '#F8FAFC',
         'accent' => '#F5A623',
         'font' => 'Roboto',
         'bgMode' => 'grid',
         'custom_css' => '',
      ],
      'assets' => [
         'logo' => null,
      ],
   ],
];
