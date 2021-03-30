<?php

namespace Elaniin\Findable\Schema\Pieces;

use Statamic\Assets\Asset;
use Statamic\Sites\Site;
use Elaniin\Findable\Schema\Contracts\SchemaPiece;

class ImageObject extends SchemaPiece
{
    /**
     * Current site
     *
     * @var \Statamic\Sites\Site
     */
    private $site;

    /**
     * Image (hopefully) asset
     *
     * @var Asset
     */
    private $image;

    /**
     * Graph ID
     *
     * @var Asset
     */
    private $id;

    /**
     * Set up the piece
     *
     * @param Asset $image
     * @param string $id
     * @return void
     */
    public function __construct(Site $site, Asset $image, string $id)
    {
        parent::__construct();

        $this->site = $site;
        $this->image = $image;
        $this->id = $id;
    }

    /**
     * @inheritdoc
     */
    public function generate(): ImageObject
    {
        $this->data->put('@type', $this->type);
        $this->data->put('@id', $this->id);
        $this->data->put('inLanguage', $this->site->locale());
        $this->data->put('url', $this->image->absoluteUrl());
        $this->data->put('width', $this->image->width());
        $this->data->put('height', $this->image->height());
        $this->data->put('caption', $this->image->data()->get('alt'));

        return $this;
    }
}
