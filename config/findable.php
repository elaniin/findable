<?php

return [
    /*
    |--------------------------------------------------------------------------
    | SEO Assets Container
    |--------------------------------------------------------------------------
    |
    | The asset container where logos/favicon should be uploaded to.
    |
    */
    'asset_container' => 'assets',

    /*
    |--------------------------------------------------------------------------
    | Excluded Collections
    |--------------------------------------------------------------------------
    |
    | Collections not intended to be findable, therefore excluded from sitemaps
    | too.
    |
    */
    'excluded_collections' => [],

    /*
    |--------------------------------------------------------------------------
    | Default Meta Title
    |--------------------------------------------------------------------------
    |
    | The available merge tags are:
    |   - %title%: The title of the current entry.
    |   - %separator%: The title separator.
    |   - %site_name%: The name of the site (set up in SEO General Settings).
    |
    */
    'default_meta_title' => '%title% %separator% %site_name%',

    /*
    |--------------------------------------------------------------------------
    | Sitemap Cache Time Interval
    |--------------------------------------------------------------------------
    |
    | Set for how much time (in seconds) the sitemap cache should be valid.
    |
    */
    'sitemap_cache_interval' => 7200,
];
