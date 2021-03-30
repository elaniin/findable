<?php

namespace Elaniin\Findable\Schema\Pieces;

use Illuminate\Support\Collection;
use Statamic\Sites\Site;
use Elaniin\Findable\Schema\Concerns\GeneratesSameAs;
use Elaniin\Findable\Schema\Contracts\SchemaPiece;
use Elaniin\Findable\Schema\SchemaIds;

class Organization extends SchemaPiece
{
    use GeneratesSameAs;

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
    public function generate(): Organization
    {
        $this->data->put('@type', $this->type);
        $this->data->put('@id', $this->site->absoluteUrl() . SchemaIds::ORGANIZATION);
        $this->data->put('name', $this->generalSettings->get('target_name'));
        $this->data->put('url', $this->site->absoluteUrl());

        if ($logo = $this->generalSettings->get('company_logo')->value()) {
            $imageObject = new ImageObject($this->site, $logo, $this->site->absoluteUrl() . SchemaIds::LOGO);
            $imageObject->generate();

            $this->data->put('logo', $imageObject->getData());
            $this->data->put('image', ['@id' => $imageObject->getData('@id')]);
        }

        // External links.
        $this->data->put('sameAs', $this->getSameAs());

        return $this;
    }
}
