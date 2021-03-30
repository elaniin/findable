<?php

namespace Elaniin\Findable\Http\Controllers\CP;

use Statamic\CP\Breadcrumbs;
use Statamic\Facades\Site;
use Elaniin\Findable\Blueprints\CP\GeneralSettingsBlueprint;
use Elaniin\Findable\Facades\FindableStorage;
use Elaniin\Findable\Http\Controllers\CP\Controller;

class GeneralSettingsController extends Controller
{
    public function index()
    {
        $this->authorize('manage seo settings');

        $data = $this->getData();

        $blueprint = $this->getBlueprint();
        $fields = $blueprint->fields()->addValues($data)->preProcess();

        $crumbs = Breadcrumbs::make([
            ['text' => __('home'), 'url' => url(config('statamic.cp.route'))],
            ['text' => __('findable::settings/general.index'), 'url' => cp_route('findable.general.index')],
        ]);

        return view('findable::cp.settings.index', [
            'blueprint' => $blueprint->toPublishArray(),
            'crumbs' => $crumbs,
            'meta' => $fields->meta(),
            'title' => __('findable::settings/general.index'),
            'values' => $fields->values(),
            'action' => cp_route('findable.general.store'),
        ]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $this->authorize('manage seo settings');

        $blueprint = $this->getBlueprint();

        $fields = $blueprint->fields()->addValues($request->all());
        $fields->validate();

        $this->putData($fields->process()->values()->toArray());
    }

    /**
     * @inheritdoc
     */
    public function getBlueprint()
    {
        return GeneralSettingsBlueprint::requestBlueprint();
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        return FindableStorage::getYaml('settings.general', Site::selected());
    }

    /**
     * @inheritdoc
     */
    public function putData($data)
    {
        return FindableStorage::putYaml('settings.general', Site::selected(), $data);
    }
}
