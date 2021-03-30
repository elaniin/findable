<?php

namespace Elaniin\Findable\Concerns;

use Statamic\Sites\Site;
use Elaniin\Findable\Blueprints\CP\GeneralSettingsBlueprint;
use Elaniin\Findable\Blueprints\CP\WebmasterSettingsBlueprint;
use Elaniin\Findable\Facades\FindableStorage;

trait AccessesSettings
{
    /**
     * Blueprints linked to settings sections
     *
     * @var array
     */
    protected $blueprints = [
        'general' => GeneralSettingsBlueprint::class,
        'webmaster' => WebmasterSettingsBlueprint::class,
    ];

    /**
     * Get the settings of the given section
     *
     * @param string $section Section name.
     * @return \Illuminate\Support\Collection|null
     */
    public function getSettings(string $section, ?Site $site)
    {
        if (! isset($this->blueprints[$section])) {
            return null;
        }

        $blueprint = $this->blueprints[$section]::requestBlueprint();

        $settings = FindableStorage::getYaml(
            'settings.' . $section,
            $site
        );

        return $blueprint->fields()->addValues($settings)->augment()->values();
    }
}
