<?php

namespace Elaniin\Findable\Facades;

use Elaniin\Findable\Storage\GlobalStorage;
use Illuminate\Support\Facades\Facade;

class FindableStorage extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return GlobalStorage::class;
    }
}
