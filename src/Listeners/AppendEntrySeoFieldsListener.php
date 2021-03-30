<?php

namespace Elaniin\Findable\Listeners;

use Illuminate\Routing\Route;
use Statamic\Events\EntryBlueprintFound;
use Elaniin\Findable\Blueprints\CP\OnPageSettingsBlueprint;
use Elaniin\Findable\Listeners\Contracts\SeoFieldsListener;

class AppendEntrySeoFieldsListener implements SeoFieldsListener
{
    /**
     * @param EntryBlueprintFound $event
     * @return void
     */
    public function handle(EntryBlueprintFound $event)
    {
        // Avoid settings outside entries.
        if (! $this->checkRoute(request()->route())) {
            return null;
        }

        if ($this->checkContentType($event->blueprint->namespace())) {
            $contents = $event->blueprint->contents();

            $pageSettingsBlueprint = OnPageSettingsBlueprint::requestBlueprint();
            $pageFields = $pageSettingsBlueprint->contents()['sections']['main'];

            $contents['sections']['SEO'] = $pageFields;

            $event->blueprint->setContents($contents);
        }
    }

    /**
     * @inheritdoc
     */
    public function checkContentType(string $blueprintNamespace): bool
    {
        $namespace           = explode('.', $blueprintNamespace);
        $collectionHandle    = $namespace[1] ?? null;
        $excludedCollections = config('findable.excluded_collections', []);

        return ! \in_array($collectionHandle, $excludedCollections);
    }

    /**
     * @inheritdoc
     */
    public function checkRoute(?Route $route): bool
    {
        if (! $route) {
            return false;
        }

        return $route->named(
            'statamic.cp.collections.entries.create',
            'statamic.cp.collections.entries.edit',
            'statamic.cp.collections.entries.update',
            'statamic.site' // Frontend.
        );
    }
}
