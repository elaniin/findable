<?php

namespace Elaniin\Findable\Data;

use Statamic\Facades\Collection as CollectionFacade;
use Statamic\Entries\Collection as StatamicCollection;

class Collection
{
    /**
     * Get all the collections that are publicly indexable.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function public()
    {
        return CollectionFacade::all()
            ->filter(function (StatamicCollection $collection) {
                return ! in_array($collection->handle(), config('findable.excluded_collections'));
            });
    }
}
