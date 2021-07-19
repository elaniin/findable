<?php

return [

    'fields' => [
        'meta_section' => [
            'display' => 'Meta Datos',
            'instruct' => 'Edita los meta datos de esta página.',
        ],
        'meta_title' => [
            'display' => 'Meta Título',
        ],
        'meta_description' => [
            'display' => 'Meta Descripción',
        ],
        'urls_section' => [
            'display' => 'Opciones de URL',
        ],
        'canonical_url' => [
            'display' => 'URL Canónica',
            'instruct' => 'La fuente preferida de esta página.',
        ],
        'indexing_section' => [
            'display' => 'Indexación and Mapa del Sitio',
        ],
        'no_index_page' => [
            'display' => 'No Indexar',
            'instruct' => 'Evitar que esta página sea indexada por motores de búsqueda.',
        ],
        'share_section_og' => [
            'display' => 'Datos Open Graph',
            'instruct' => 'Controla cómo luce esta página cuando es compartida en sitios web que interpretan datos ' .
                'de OpenGrah (como Facebook, LinkedIn etc).',
        ],
        'og_title' => [
            'display' => 'Título Open Graph',
        ],
        'og_description' => [
            'display' => 'Descripción Open Graph',
        ],
        'og_image' => [
            'display' => 'Imagen Open Graph',
        ],
        'share_section_twitter' => [
            'display' => 'Twitter Sharing Data',
            'instruct' => 'Controla cómo se ve esta página cuando se comparte en Twitter, estos datos se obtendrán ' .
                'automáticamente de Open Graph.',
        ],
        'twitter_card_type_page' => [
            'display' => 'Tipo de Tarjeta Twitter',
            'instruct' => 'Selecciona el tipo de tarjeta de Twitter utilizado al compartir esta página.',
            'options' => [
                'summary_card'        => 'Tarjeta resumida',
                'summary_large_image' => 'Tarjeta resumida con imagen',
            ],
        ],

        'additional_schema_section' => [
            'display' => 'Datos Estructurados',
            'instruct' => 'Configura tipos de esquema adicionales para datos estructurados mejorados.'
        ],
        'additional_schema' => [
            'display' => 'Esquemas Adicionales',
            'instruct' => 'Ingresa el esquema adicional en formato JSON+LD. Puedes crear esquemas adicionales usando ' .
                '[esta herramienta](https://technicalseo.com/tools/schema-markup-generator/).',
        ]
    ]

];
