<?php

namespace Elaniin\Findable\Storage;

use Statamic\Sites\Site;

interface Storage
{
    public static function getYaml(string $handle, Site $site, bool $returnCollection);

    public static function putYaml(string $handle, Site $site, array $data);
}
