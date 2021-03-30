<?php

namespace Elaniin\Findable\Blueprints\CP;

use Elaniin\Findable\Blueprints\Blueprint as FindableBlueprint;
use Statamic\Facades\Blueprint as StatamicBlueprint;

class WebmasterSettingsBlueprint implements FindableBlueprint
{
    /**
     * @inheritDoc
     */
    public static function requestBlueprint()
    {
        return StatamicBlueprint::make()->setContents([
            'sections' => [
                'main' => [
                    'fields' => [
                        [
                            'handle' => 'site_verification_section',
                            'field'   => [
                                'type'         => 'section',
                                'display'      => __(
                                    'findable::settings/webmaster.fields.site_verification_section.display'
                                ),
                                'instructions' => __(
                                    'findable::settings/webmaster.fields.site_verification_section.instruct'
                                ),
                                'listable'     => 'hidden',
                            ],
                        ],
                        [
                            'handle' => 'bing_verification_code',
                            'field'   => [
                                'type'         => 'text',
                                'display'      => __(
                                    'findable::settings/webmaster.fields.bing_verification_code.display'
                                ),
                                'instructions' => __(
                                    'findable::settings/webmaster.fields.bing_verification_code.instruct'
                                ),
                                'placeholder' => __(
                                    'findable::settings/webmaster.fields.bing_verification_code.placeholder'
                                ),
                            ],
                        ],
                        [
                            'handle' => 'google_verification_code',
                            'field'   => [
                                'type'         => 'text',
                                'display'      => __(
                                    'findable::settings/webmaster.fields.google_verification_code.display'
                                ),
                                'instructions' => __(
                                    'findable::settings/webmaster.fields.google_verification_code.instruct'
                                ),
                                'placeholder' => __(
                                    'findable::settings/webmaster.fields.google_verification_code.placeholder'
                                ),
                            ],
                        ],
                        [
                            'handle' => 'yandex_verification_code',
                            'field'   => [
                                'type'         => 'text',
                                'display'      => __(
                                    'findable::settings/webmaster.fields.yandex_verification_code.display'
                                ),
                                'instructions' => __(
                                    'findable::settings/webmaster.fields.yandex_verification_code.instruct'
                                ),
                                'placeholder' => __(
                                    'findable::settings/webmaster.fields.yandex_verification_code.placeholder'
                                ),
                            ],
                        ],

                        [
                            'handle' => 'marketing_section',
                            'field'   => [
                                'type'         => 'section',
                                'display'      => __(
                                    'findable::settings/webmaster.fields.marketing_section.display'
                                ),
                                'instructions' => __(
                                    'findable::settings/webmaster.fields.marketing_section.instruct'
                                ),
                                'listable'     => 'hidden',
                            ],
                        ],
                        [
                            'handle' => 'gtm_container_id',
                            'field'   => [
                                'type'         => 'text',
                                'display'      => __(
                                    'findable::settings/webmaster.fields.gtm_container_id.display'
                                ),
                                'instructions' => __(
                                    'findable::settings/webmaster.fields.gtm_container_id.instruct'
                                ),
                                'placeholder' => __(
                                    'findable::settings/webmaster.fields.gtm_container_id.placeholder'
                                ),
                                'validate' => [
                                    'regex:/^GTM-[A-Z0-9]{1,7}$/'
                                ]
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }
}
