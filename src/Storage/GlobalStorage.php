<?php

namespace Elaniin\Findable\Storage;

use Statamic\Sites\Site as SiteObject;
use Statamic\Facades\File;
use Statamic\Facades\Site;
use Statamic\Facades\YAML;

class GlobalStorage implements Storage
{
    public const PREFIX = 'findable';

    /**
     * Retrieve YAML data from storage
     *
     * @param string $handle
     * @param Site $site
     * @param bool $returnCollection
     *
     * @return array|Collection
     */
    public static function getYaml(string $handle, SiteObject $site, bool $returnCollection = false)
    {
        $path = storage_path(implode('/', [
            'statamic/addons/' . self::PREFIX,
            "{$handle}.yaml",
        ]));

        $data = YAML::parse(File::get($path));

        $siteData = collect($data)->get($site->handle());

        if ($returnCollection) {
            return collect($siteData);
        }

        return collect($siteData)->toArray() ?: [];
    }

    /**
     * Retrieve YAML data from storage but back up using the default site
     *
     * @param string $handle
     * @param Site $site
     * @param bool $returnCollection
     *
     * @return array
     */
    public function getYamlWithBackup(string $handle, SiteObject $site, bool $returnCollection = false)
    {
        $storage = self::getYaml($handle, $site, true);

        if (Site::hasMultiple() && $site !== Site::default()) {
            $defaultStorage = self::getYaml($handle, Site::default(), true);
            $storage = $defaultStorage->merge($storage);
        }

        if ($returnCollection) {
            return $storage;
        }

        return $storage->toArray() ?: [];
    }

    /**
     * Put YAML data into storage
     *
     * @param string $handle
     * @param Site $site
     * @param array $data
     *
     * @return void
     */
    public static function putYaml(string $handle, SiteObject $site, array $data)
    {
        $path = storage_path(implode('/', [
            'statamic/addons/' . self::PREFIX,
            "{$handle}.yaml",
        ]));

        $existing = collect(YAML::parse(File::get($path)));

        $combinedData = $existing->merge([
            "{$site->handle()}" => $data,
        ]);

        File::put($path, YAML::dump($combinedData->toArray()));
    }
}
