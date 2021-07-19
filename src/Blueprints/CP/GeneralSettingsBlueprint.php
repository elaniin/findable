<?php

namespace Elaniin\Findable\Blueprints\CP;

use Elaniin\Findable\Blueprints\Blueprint as FindableBlueprint;
use Statamic\Facades\Blueprint as StatamicBlueprint;

class GeneralSettingsBlueprint implements FindableBlueprint
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
                            'handle' => 'titles_section',
                            'field'   => [
                                'type'         => 'section',
                                'display'      => __('findable::settings/general.fields.titles_section.display'),
                                'instructions' => __('findable::settings/general.fields.titles_section.instruct'),
                                'listable'     => 'hidden',
                            ],
                        ],
                        [
                            'handle' => 'title_separator',
                            'field'   => [
                                'type'         => 'select',
                                'display'      => __('findable::settings/general.fields.title_separator.display'),
                                'instructions' => __('findable::settings/general.fields.title_separator.instruct'),
                                'default'      => '|',
                                'options'      => [
                                    '|',
                                    '-',
                                    '~',
                                    '•',
                                    '/',
                                    '//',
                                    '»',
                                    '«',
                                    '>',
                                    '<',
                                    '*',
                                    '+',
                                ],
                                'width' => 33,
                            ],
                        ],
                        [
                            'handle' => 'site_name',
                            'field'   => [
                                'type'         => 'text',
                                'display'      => __('findable::settings/general.fields.site_name.display'),
                                'instructions' => __('findable::settings/general.fields.site_name.instruct'),
                                'width'        => 66,
                            ],
                        ],
                        [
                            'handle' => 'favicon_section',
                            'field'   => [
                                'type'         => 'section',
                                'display'      => __('findable::settings/general.fields.favicon_section.display'),
                                'instructions' => __('findable::settings/general.fields.favicon_section.instruct'),
                                'listable'     => 'hidden',
                            ],
                        ],
                        [
                            'handle' => 'global_favicon',
                            'field'   => [
                                'type'      => 'assets',
                                'display'   => __('findable::settings/general.fields.global_favicon.display'),
                                'max_files'  => 1,
                                'restrict'  => false,
                                'container' => config('findable.asset_container'),
                            ],
                        ],
                        [
                            'handle' => 'default_og_section',
                            'field'   => [
                                'type'         => 'section',
                                'display'      => __('findable::settings/general.fields.default_og_section.display'),
                                'instructions' => __('findable::settings/general.fields.default_og_section.instruct'),
                                'listable'     => 'hidden',
                            ],
                        ],
                        [
                            'handle' => 'default_og_image',
                            'field'   => [
                                'type'         => 'assets',
                                'max_files'    => 1,
                                'restrict'     => false,
                                'display'      => __('findable::settings/general.fields.default_og_image.display'),
                                'instructions' => __('findable::settings/general.fields.default_og_image.instruct'),
                                'container'    => config('findable.asset_container'),
                                'folder'       => config('findable.asset_folder'),
                                'validate' => [
                                    'image'
                                ],
                            ],
                        ],
                        [
                            'handle' => 'disable_authors',
                            'field' => [
                                'type' => 'toggle',
                                'display' => __('findable::settings/general.fields.disable_authors.display'),
                                'instructions' => __('findable::settings/general.fields.disable_authors.instruct'),
                            ],
                        ],
                        [
                            'handle' => 'knowledge_graph_section',
                            'field'   => [
                                'type'     => 'section',
                                'display'  => __('findable::settings/general.fields.knowledge_graph_section.display'),
                                'listable' => 'hidden',
                            ],
                        ],
                        [
                            'handle' => 'company_or_person',
                            'field'   => [
                                'type'         => 'radio',
                                'display'      => __('findable::settings/general.fields.company_or_person.display'),
                                'instructions' => __('findable::settings/general.fields.company_or_person.instruct'),
                                'default'      => 'company',
                                'inline'       => true,
                                'options'      => [
                                    'company' => __('findable::settings/general.fields.company_or_person.company'),
                                    'person'  => __('findable::settings/general.fields.company_or_person.person'),
                                ],
                            ],
                        ],
                        [
                            'handle' => 'target_name',
                            'field'   => [
                                'type' => 'text',
                                'display' => __('findable::settings/general.fields.target_name.display'),
                                'instructions' => __('findable::settings/general.fields.target_name.instruct'),
                                'width' => 50,
                            ],
                        ],
                        [
                            'handle' => 'company_logo',
                            'field'   => [
                                'type'      => 'assets',
                                'max_files'  => 1,
                                'restrict'  => false,
                                'width'     => 50,
                                'display'   => __('findable::settings/general.fields.company_logo.display'),
                                'container' => config('findable.asset_container'),
                                'folder'    => config('findable.asset_folder'),
                                'if'        => [
                                    'company_or_person' => 'equals company',
                                ],
                            ],
                        ],
                        [
                            'handle' => 'external_links',
                            'field' => [
                                'mode' => 'table',
                                'add_row' => __('findable::settings/general.fields.external_links.add_row'),
                                'reorderable' => 'true',
                                'display' => __('findable::settings/general.fields.external_links.display'),
                                'instructions' => __('findable::settings/general.fields.external_links.instruct'),
                                'type' => 'grid',
                                'icon' => 'grid',
                                'listable' => 'hidden',
                                'fields' => [
                                    [
                                        'handle' => 'url',
                                        'field' => [
                                            'input_type' => 'url',
                                            'antlers' => 'false',
                                            'display' => 'URL',
                                            'type' => 'text',
                                            'icon' => 'text',
                                            'listable' => 'hidden',
                                            'validate' => [
                                                'url'
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                        ],
                        [
                            'handle' => 'noindex_section',
                            'field' => [
                                'type' => 'section',
                                'display' => __('findable::settings/general.fields.noindex_section.display'),
                                'instructions' => __('findable::settings/general.fields.noindex_section.instruct'),
                            ],
                        ],
                        [
                            'handle' => 'noindex_site',
                            'field' => [
                                'type' => 'toggle',
                                'display' => __('findable::settings/general.fields.noindex_site.display'),
                                'instructions' => __('findable::settings/general.fields.noindex_site.instruct'),
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }
}
