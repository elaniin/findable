<?php

return [

    'fields' => [
        'meta_section' => [
            'display' => 'Meta Data',
            'instruct' => 'Edit the meta data for this specific page.',
        ],
        'meta_title' => [
            'display' => 'Meta Title',
        ],
        'meta_description' => [
            'display' => 'Meta Description',
        ],
        'urls_section' => [
            'display' => 'URL Options',
        ],
        'canonical_url' => [
            'display' => 'Canonical URL',
            'instruct' => 'The source or preferred version of this page.',
        ],
        'indexing_section' => [
            'display' => 'Indexing and Sitemaps',
        ],
        'no_index_page' => [
            'display' => 'No Index',
            'instruct' => 'Prevent this page from being indexed by search engines.',
        ],
        'share_section_og' => [
            'display' => 'Open Graph Sharing Data',
            'instruct' => 'Control how this page looks when shared on websites which interpret Open Graph data ' .
                '(Facebook, LinkedIn etc).',
        ],
        'og_title' => [
            'display' => 'Open Graph Title',
        ],
        'og_description' => [
            'display' => 'Open Graph Description',
        ],
        'og_image' => [
            'display' => 'Open Graph Image',
        ],
        'share_section_twitter' => [
            'display' => 'Twitter Sharing Data',
            'instruct' => 'Control how this page looks when shared on Twitter, this data will automatically get ' .
                'inherited from the OG data.',
        ],
        'twitter_card_type_page' => [
            'display' => 'Twitter Card Type',
            'instruct' => 'Select which type of twitter card should show when this page is shared.',
            'options' => [
                'summary_card'        => 'Summary card',
                'summary_large_image' => 'Summary with large image',
            ],
        ],

        'additional_schema_section' => [
            'display' => 'Structured Data',
            'instruct' => 'Set additional schema types for enhanced structured data.'
        ],
        'additional_schema' => [
            'display' => 'Additional Schema',
            'instruct' => 'Enter the additional structured data/schema in JSON+LD format. You can create additional ' .
                'schemas using [this tool](https://technicalseo.com/tools/schema-markup-generator/).',
        ]
    ]

];
