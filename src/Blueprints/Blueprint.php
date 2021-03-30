<?php

namespace Elaniin\Findable\Blueprints;

interface Blueprint
{
    /**
     * Return an instance of a blueprint, populated with fields
     *
     * @return Statamic\Facades\Blueprint
     */
    public static function requestBlueprint();
}
