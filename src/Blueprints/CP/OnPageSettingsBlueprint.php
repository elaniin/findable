<?php

namespace Elaniin\Findable\Blueprints\CP;

use Elaniin\Findable\Blueprints\Blueprint as FindableBlueprint;
use Statamic\Facades\Blueprint as StatamicBlueprint;

class OnPageSettingsBlueprint implements FindableBlueprint
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
                            'handle' => 'meta_section',
                            'field'   => [
                                'type'         => 'section',
                                'listable'     => 'hidden',
                                'display'      => __('findable::settings/onpage.fields.meta_section.display'),
                                'instructions' => __('findable::settings/onpage.fields.meta_section.instruct'),
                            ],
                        ],
                        [
                            'handle' => 'meta_title',
                            'field'   => [
                                'type'        => 'text',
                                'display'     => __('findable::settings/onpage.fields.meta_title.display'),
                                'localizable' => true,
                                'default'     => config('findable.default_meta_title'),
                            ],
                        ],
                        [
                            'handle' => 'meta_description',
                            'field'   => [
                                'type'            => 'textarea',
                                'display'         => __('findable::settings/onpage.fields.meta_description.display'),
                                'localizable'     => true,
                                'character_limit' => 160,
                            ],
                        ],
                        [
                            'handle' => 'urls_section',
                            'field'   => [
                                'type'     => 'section',
                                'display'  => __('findable::settings/onpage.fields.urls_section.display'),
                                'listable' => 'hidden',
                            ],
                        ],
                        [
                            'handle' => 'canonical_url',
                            'field'   => [
                                'type'         => 'text',
                                'display'      => __('findable::settings/onpage.fields.canonical_url.display'),
                                'instructions' => __('findable::settings/onpage.fields.canonical_url.instruct'),
                                'listable'     => 'hidden',
                                'localizable'  => true,
                            ],
                        ],
                        [
                            'handle' => 'indexing_section',
                            'field'   => [
                                'type'    => 'section',
                                'display' => __('findable::settings/onpage.fields.indexing_section.display'),
                            ],
                        ],
                        [
                            'handle' => 'noindex_page',
                            'field'   => [
                                'type'         => 'toggle',
                                'display'      => __('findable::settings/onpage.fields.no_index_page.display'),
                                'instructions' => __('findable::settings/onpage.fields.no_index_page.instruct'),
                                'width'        => 50,
                                'localizable'  => true,
                            ],
                        ],
                        [
                            'handle' => 'share_section_og',
                            'field'   => [
                                'type'         => 'section',
                                'display'      => __('findable::settings/onpage.fields.share_section_og.display'),
                                'instructions' => __('findable::settings/onpage.fields.share_section_og.instruct'),
                            ],
                        ],
                        [
                            'handle' => 'og_image',
                            'field'   => [
                                'type'        => 'assets',
                                'display'     => __('findable::settings/onpage.fields.og_image.display'),
                                'max_files'    => 1,
                                'restrict'    => false,
                                'container'   => config('findable.asset_container'),
                                'folder'      => config('findable.asset_folder'),
                                'localizable' => true,
                                'validate' => [
                                    'image'
                                ]
                            ],
                        ],
                        [
                            'handle' => 'share_section_twitter',
                            'field'   => [
                                'type'         => 'section',
                                'display'      => __('findable::settings/onpage.fields.share_section_twitter.display'),
                                'instructions' => __('findable::settings/onpage.fields.share_section_twitter.instruct'),
                                'localizable'  => true,
                            ],
                        ],
                        [
                            'handle' => 'twitter_card_type_page',
                            'field'   => [
                                'type'         => 'select',
                                'display'      => __('findable::settings/onpage.fields.twitter_card_type_page.display'),
                                'instructions' => __(
                                    'findable::settings/onpage.fields.twitter_card_type_page.instruct'
                                ),
                                'localizable'  => true,
                                'default'      => 'summary_large_image',
                                'width'        => 50,
                                'options'      => [
                                    'summary'             => __(
                                        'findable::settings/onpage.fields.twitter_card_type_page.options.summary_card'
                                    ),
                                    'summary_large_image' => __(
                                        'findable::settings/onpage.fields.twitter_card_type_page.options.summary_large_image' // phpcs:ignore
                                    ),
                                ],
                            ],
                        ],

                        [
                            'handle' => 'additional_schema_section',
                            'field'   => [
                                'type'         => 'section',
                                'listable'     => 'hidden',
                                'display'      => __(
                                    'findable::settings/onpage.fields.additional_schema_section.display'
                                ),
                                'instructions' => __(
                                    'findable::settings/onpage.fields.additional_schema_section.instruct'
                                ),
                            ],
                        ],
                        [
                            'handle' => 'additional_schema',
                            'field'   => [
                                'display'       => __(
                                    'findable::settings/onpage.fields.additional_schema.display'
                                ),
                                'instructions'  => __(
                                    'findable::settings/onpage.fields.additional_schema.instruct'
                                ),
                                'theme'         => 'light',
                                'mode'          => 'javascript',
                                'indent_type'   => 'spaces',
                                'indent_size'   => '2',
                                'key_map'       => 'default',
                                'line_numbers'  => true,
                                'line_wrapping' => true,
                                'localizable'   => true,
                                'type'          => 'code',
                                'icon'          => 'code',
                                'listable'      => 'hidden',
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }
}
