<?php

namespace Elaniin\Findable\Http\Controllers\CP;

use Statamic\CP\Breadcrumbs;
use Statamic\Facades\Site;
use Elaniin\Findable\Blueprints\CP\WebmasterSettingsBlueprint;
use Elaniin\Findable\Facades\FindableStorage;
use Elaniin\Findable\Http\Controllers\CP\Controller;

class WebmasterSettingsController extends Controller
{
    public function index()
    {
        $this->authorize('manage webmaster settings');

        $data = $this->getData();

        $blueprint = $this->getBlueprint();
        $fields = $blueprint->fields()->addValues($data)->preProcess();

        $crumbs = Breadcrumbs::make([
            ['text' => __('home'), 'url' => url(config('statamic.cp.route'))],
            ['text' => __('findable::settings/webmaster.index'), 'url' => cp_route('findable.webmaster.index')],
        ]);

        return view('findable::cp.settings.index', [
            'blueprint' => $blueprint->toPublishArray(),
            'crumbs' => $crumbs,
            'meta' => $fields->meta(),
            'title' => __('findable::settings/webmaster.index'),
            'values' => $fields->values(),
            'action' => cp_route('findable.webmaster.store'),
        ]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $this->authorize('manage webmaster settings');

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
        return WebmasterSettingsBlueprint::requestBlueprint();
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        return FindableStorage::getYaml('settings.webmaster', Site::selected());
    }

    /**
     * @inheritdoc
     */
    public function putData($data)
    {
        return FindableStorage::putYaml('settings.webmaster', Site::selected(), $data);
    }
}
