<?php

return [

    'index' => 'Ajustes de Webmaster',

    'fields' => [
        'site_verification_section' => [
            'display' => 'Verificación del Sitio',
            'instruct' => 'Puedes usar las cajas de abajo para verificar con diferentes herramientas de webmaster. ' .
                'Esta característica añadirá una meta etiqueta de verificación en tu página de inicio.',
        ],
        'bing_verification_code' => [
            'display' => 'Código de Verificación de Bing',
            'instruct' => 'Ingresa el código de verificación obtenido en Bing Webmaster Tools.',
            'placeholder' => 'Ejemplo: D8387B50C8235429AC4EAB8BAFD4367C',
        ],
        'google_verification_code' => [
            'display' => 'Código de Verificación de Google',
            'instruct' => 'Ingresa el código de verificación obtenido en Google Search Console.',
            'placeholder' => 'Ejemplo: tSax_1e3_QR1375IeJCx07MsPk-x8kVRRXUkSgv7EMU',
        ],
        'yandex_verification_code' => [
            'display' => 'Código de Verificación de Yandex',
            'instruct' => 'Ingresa el código de verificación obtenido en Yandex Webmaster Tools.',
            'placeholder' => 'Ejemplo: 12e4d4c78f451588',
        ],

        'marketing_section' => [
            'display' => 'Mercadeo',
            'instruct' => 'Configura herramientas de mercadeo mediante Google Tag Manager',
        ],
        'gtm_container_id' => [
            'display' => 'ID del contenedor de Google Tag Manager',
            'instruct' => 'Ingresa el ID del contenedor de Google Tag Manager.',
            'placeholder' => 'Ejemplo: GTM-XXXXXXX',
        ]
    ],

];
