<?php

namespace Elaniin\Findable\Listeners\Contracts;

use Illuminate\Routing\Route;

interface SeoFieldsListener
{
    /**
     * Check the content type is intended to be findable
     *
     * @param string $blueprintNamespace
     */
    public function checkContentType(string $blueprintNamespace);

    /**
     * Check if the given route is intended to be findable
     *
     * @param Route $route
     */
    public function checkRoute(Route $route): bool;
}
