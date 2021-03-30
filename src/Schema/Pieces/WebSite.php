<?php

namespace Elaniin\Findable\Schema\Pieces;

use Illuminate\Support\Collection;
use Statamic\Sites\Site;
use Elaniin\Findable\Schema\Contracts\SchemaPiece;
use Elaniin\Findable\Schema\SchemaIds;

class WebSite extends SchemaPiece
{
    /**
     * General Settings
     *
     * @var \Illuminate\Support\Collection
     */
    private $generalSettings;

    /**
     * Current site
     *
     * @var \Statamic\Sites\Site
     */
    private $site;

    /**
     * Set up the piece
     *
     * @param Site $site
     * @param Collection $generalSettings
     * @return void
     */
    public function __construct(Site $site, Collection $generalSettings)
    {
        parent::__construct();

        $this->site = $site;
        $this->generalSettings = $generalSettings;
    }

    /**
     * @inheritdoc
     */
    public function generate(): WebSite
    {
        $this->data->put('@type', $this->type);
        $this->data->put('@id', $this->site->absoluteUrl() . SchemaIds::WEBSITE);
        $this->data->put('url', $this->site->absoluteUrl());
        $this->data->put('name', $this->generalSettings->get('site_name')->value());
        $this->data->put('inLanguage', $this->site->locale());

        return $this;
    }
}
