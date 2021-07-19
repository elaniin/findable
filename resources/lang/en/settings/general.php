<?php

return [

    'singular' => 'General',
    'plural'   => 'Generals',

    // Control Panel
    'index' => 'General Settings',

    'fields' => [
        'titles_section' => [
            'display'  => 'Titles',
            'instruct' => 'Control how your site titles appear.',
        ],
        'title_separator' => [
            'display'  => 'Title Separator',
            'instruct' => 'Set the character to separate the site and page names in the meta title.'
        ],
        'site_name' => [
            'display'  => 'Website Name',
            'instruct' => 'Set the name for the website. This will be used in generated meta titles as well as the ' .
                'Open Graph site name property.'
        ],
        'favicon_section' => [
            'display'  => 'Favicon',
            'instruct' => 'Upload a favicon to show in search results and the browser. It is recommended that your ' .
                'favicon is:<ul><li>A multiple of 48px square in dimensions</li><li>A supported favicon file format, ' .
                'we recommend using `.png`</li></ul>'
        ],
        'global_favicon' => [
            'display' => 'Global Favicon',
        ],
        'default_og_section' => [
            'display'  => 'Open Graph',
            'instruct' => 'Default Open Graph properties. This can also be configured on a per-page basis.'
        ],
        'default_og_image' => [
            'display'  => 'Image',
            'instruct' => 'Select the default Open Graph image in case a page or post do not have that set up. ' .
                'Recommended size `1.91:1` (e.g. `1200x627`).'
        ],
        'knowledge_graph_section' => [
            'display' => 'Base Knowledge Graph Data',
        ],
        'company_or_person' => [
            'company'  => 'Company',
            'person'   => 'Person',
            'display'  => 'Company or Person?',
            'instruct' => 'Select whether the content on this website represents a company or a person.'
        ],
        'target_name' => [
            'display'  => 'Target Name',
            'instruct' => 'Enter the person/company name here.'
        ],
        'company_logo' => [
            'display' => 'Company Logo',
        ],
        'external_links' => [
            'display' => 'External Links',
            'instruct' => 'External links related to this target such as social profiles, websites, etc.',
            'add_row' => 'Add Link',
        ],
        'disable_authors' => [
            'display' => 'Disable Authors',
            'instruct' => 'Hide the "Written by" text in compatible Open Graph parsers (like Slack or Twitter).',
        ],
        'noindex_section' => [
            'display' => 'No Index',
            'instruct' => 'Set to `true` to exclude the **whole site** from search engine indexing - this can also ' .
                'be configured on a per-page basis.',
        ],
        'noindex_site' => [
            'display' => 'No Index',
            'instruct' => 'Prevent indexing across the entire site.',
        ],
    ]

];
