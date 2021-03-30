<?php

namespace Elaniin\Findable;

use Statamic\Events\EntryBlueprintFound;
use Statamic\Events\EntryDeleted;
use Statamic\Events\EntrySaved;
use Statamic\Facades\CP\Nav;
use Statamic\Facades\Permission;
use Statamic\Providers\AddonServiceProvider;
use Elaniin\Findable\Listeners\AppendEntrySeoFieldsListener;
use Elaniin\Findable\Listeners\FlushSitemapCache;
use Elaniin\Findable\Tags\FindableTags;

class ServiceProvider extends AddonServiceProvider
{
    /**
     * Add-on routes
     *
     * @var array
     */
    protected $routes = [
        'cp'  => __DIR__ . '/../routes/cp.php',
        'web' => __DIR__ . '/../routes/web.php',
    ];

    /**
     * Tags registered by this add-on
     *
     * @var array
     */
    protected $tags = [
        FindableTags::class,
    ];

    /**
     * Events listened by this add-on
     *
     * @var array
     */
    protected $listen = [
        EntryBlueprintFound::class => [
            AppendEntrySeoFieldsListener::class,
        ],
        EntrySaved::class => [
            FlushSitemapCache::class,
        ],
        EntryDeleted::class => [
            FlushSitemapCache::class,
        ],
    ];

    /**
     * Boot add-on
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Set up views path
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'findable');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/findable'),
        ], 'views');

        // Set up translations
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'findable');
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/findable'),
        ], 'translations');

        // Load customized addon config
        $this->mergeConfigFrom(__DIR__ . '/../config/findable.php', 'findable');
        $this->publishes([
            __DIR__ . '/../config/findable.php' => config_path('findable.php'),
        ], 'config');

        // Set up permissions
        $this->bootPermissions();

        // Set up navigation
        $this->bootNav();
    }

    /**
     * Boot navigation
     *
     * @return void
     */
    public function bootNav()
    {
        Nav::extend(function ($nav) {
            $nav->content('SEO')
                ->can('manage seo settings')
                ->section('Tools')
                ->route('findable.general.index')
                ->icon('seo-search-graph')
                ->children(
                    [
                        $nav->item(__('findable::general.index'))
                            ->route('findable.general.index')
                            ->can('manage seo settings'),
                        $nav->item(__('findable::webmaster.index'))
                            ->route('findable.webmaster.index')
                            ->can('manage webmaster settings')
                    ]
                );
        });
    }

    /**
     * Add permissions for SEO settings
     *
     * @return void
     */
    public function bootPermissions()
    {
        Permission::group('seo', 'SEO', function () {
            Permission::register('manage seo settings')
                ->label(__('findable::permissions.manage_seo_settings'));
            Permission::register('manage webmaster settings')
                ->label(__('findable::permissions.manage_webmaster_settings'));
        });
    }
}
