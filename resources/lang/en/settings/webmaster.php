<?php

return [

    'index' => 'Webmaster Settings',

    'fields' => [
        'site_verification_section' => [
            'display' => 'Site Verification',
            'instruct' => 'You can use the boxes below to verify with the different Webmaster Tools. This feature ' .
                'will add a verification meta tag on your home page.',
        ],
        'bing_verification_code' => [
            'display' => 'Bing Verification Code',
            'instruct' => 'Input the verification code given by Bing Webmaster Tools.',
            'placeholder' => 'E.g.: D8387B50C8235429AC4EAB8BAFD4367C',
        ],
        'google_verification_code' => [
            'display' => 'Google Verification Code',
            'instruct' => 'Input the verification code given by Google Search Console.',
            'placeholder' => 'E.g.: tSax_1e3_QR1375IeJCx07MsPk-x8kVRRXUkSgv7EMU',
        ],
        'yandex_verification_code' => [
            'display' => 'Yandex Verification Code',
            'instruct' => 'Input the verification code given by Yandex Webmaster Tools.',
            'placeholder' => 'E.g.: 12e4d4c78f451588',
        ],

        'marketing_section' => [
            'display' => 'Marketing',
            'instruct' => 'Set up marketing platforms via Google Tag Manager',
        ],
        'gtm_container_id' => [
            'display' => 'Google Tag Manager Container ID',
            'instruct' => 'Enter the container ID from Google Tag Manager.',
            'placeholder' => 'e.g.: GTM-XXXXXXX',
        ]
    ],

];
