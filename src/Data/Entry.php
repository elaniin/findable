<?php

namespace Elaniin\Findable\Data;

use Statamic\Facades\Entry as EntryFacade;
use Statamic\Sites\Site;

class Entry
{
    /**
     * Get all the entries for the given collection in the given site that are publicly indexable
     *
     * @param string $collectionHandle
     * @param Site $site
     * @return \Statamic\Entries\EntryCollection
     */
    public static function public(string $collectionHandle, Site $site)
    {
        return EntryFacade::query()
            ->where('collection', $collectionHandle)
            ->where('site', $site)
            ->whereJsonDoesntContain('data', ['noindex_page' => true])
            ->get();
    }
}
