<?php

return [

    'singular' => 'General',
    'plural'   => 'Generales',

    // Control Panel
    'index' => 'Configuración General',

    'fields' => [
        'titles_section' => [
            'display'  => 'Títulos',
            'instruct' => 'Controla cómo lucen los títulos',
        ],
        'title_separator' => [
            'display'  => 'Separador de título',
            'instruct' => 'Configura el caracter quee separa el nombre de las páginas del nombre del sitio'
        ],
        'site_name' => [
            'display'  => 'Nombre del sitio',
            'instruct' => 'Configura el nombre del sitio. Es utilizado en los meta títulos generados así como ' .
                'también en la propiedad del nombre de sitio en OpenGraph.'
        ],
        'favicon_section' => [
            'display'  => 'Favicon',
            'instruct' => 'Sube un ícono para mostrar en resultados de búsqueda y en el navegador. Se recomienda ' .
                'que las dimensiones del favicon sean:<ul><li>Múltiplo de 48px en dimensions cuadradas</li>' .
                '<li>Formato soportado, se recomienda `.png`</li></ul>'
        ],
        'global_favicon' => [
            'display' => 'Favicon Global',
        ],
        'default_og_section' => [
            'display'  => 'OpenGraph',
            'instruct' => 'Propiedades de OpenGraph predeterminadas. También puede ser configurado individualmente ' .
                'por página.'
        ],
        'default_og_image' => [
            'display'  => 'Imagen',
            'instruct' => 'Selecciona una imagen para OpenGraph predeterminada en caso de que una entrada de blog ' .
                'o página no tengan una configurada. Tamaño recomendado `1.91:1` (ejemplo: `1200x627`).'
        ],
        'knowledge_graph_section' => [
            'display' => 'Base de Conocimientos de OpenGraph',
        ],
        'company_or_person' => [
            'company'  => 'Compañía',
            'person'   => 'Persona',
            'display'  => '¿Compañía o Persona?',
            'instruct' => 'Selecciona si este sitio representa una compañía o persona.'
        ],
        'target_name' => [
            'display'  => 'Nombre',
            'instruct' => 'Ingresa el nombre de la persona/compañía aquí.'
        ],
        'company_logo' => [
            'display' => 'Logo de la compañía',
        ],
        'external_links' => [
            'display' => 'Enlaces Externos',
            'instruct' => 'Enlaces externos relacionados como perfiles sociales, sitios web, etc.',
            'add_row' => 'Añadir enlace',
        ],
        'disable_authors' => [
            'display' => 'Deshabilitar Autores',
            'instruct' => 'Oculta el texto "Escrito por" en analizadores de OpenGraph compatibles (como Slack o Twitter).',
        ],
        'noindex_section' => [
            'display' => 'No Indexar',
            'instruct' => 'Si enciendes esta funcionalidad **el sitio entero** será excluido de motores de búsqueda. ' .
                'También puede ser configurado individualmente por página.',
        ],
        'noindex_site' => [
            'display' => 'No Indexar',
            'instruct' => 'Impedir indexación del sitio web.',
        ],
    ]

];
