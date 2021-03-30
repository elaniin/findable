<?php

use Illuminate\Support\Facades\Route;
use Statamic\Facades\Site;
use Statamic\Facades\URL;

Route::namespace('\Elaniin\Findable\Http\Controllers\Web')
    ->group(function () {
        Route::get('robots.txt', 'RobotsTxtController@index')
            ->name('robots.txt');

        Route::redirect('sitemap.xml', 'sitemap_index.xml');
        Route::get('sitemap_index.xml', 'SitemapController@index')
            ->name('sitemap.index');
        Route::get('{content_type}_sitemap.xml', 'SitemapController@show')
            ->where('content_type', '[a-z_]+')
            ->name('sitemap.show');

        // Add robots.txt and sitemap to all sites.
        $roots = Site::all()
            ->map(function ($site) {
                return URL::makeRelative($site->url());
            })->filter(function ($root) {
                return $root !== '/';
            })->unique();

        $roots->each(function ($root) {
            Route::get("${root}/robots.txt", 'RobotsTxtController@index')
                ->name("${root}.robots.txt");

            Route::redirect("${root}/sitemap.xml", "${root}/sitemap_index.xml");
            Route::get("${root}/sitemap_index.xml", 'SitemapController@index')
                ->name("${root}.sitemap.index");
            Route::get("${root}/{content_type}_sitemap.xml", 'SitemapController@show')
                ->where('content_type', '[a-z_]+')
                ->name("${root}.sitemap.show");
        });
    });
