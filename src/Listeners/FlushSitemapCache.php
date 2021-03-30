<?php

namespace Elaniin\Findable\Listeners;

use Illuminate\Support\Facades\Cache;

class FlushSitemapCache
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        Cache::tags('sitemap')->flush();
    }
}
