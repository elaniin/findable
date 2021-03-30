<?php

namespace Elaniin\Findable\Schema\Pieces;

use Illuminate\Support\Collection;
use Elaniin\Findable\Schema\Concerns\GeneratesSameAs;
use Elaniin\Findable\Schema\Contracts\SchemaPiece;

class Person extends SchemaPiece
{
    use GeneratesSameAs;

    /**
     * Person data
     *
     * @var \Illuminate\Support\Collection
     */
    public $data;

    /**
     * Set up the piece
     *
     * @param Site $site
     * @param Collection $data
     * @return void
     */
    public function __construct(Collection $data)
    {
        parent::__construct();

        $this->data = $data;
    }

    /**
     * @inheritdoc
     */
    public function generate(): Person
    {
        $this->data->put('@type', $this->type);
        $this->data->put('@id', $this->id);
        $this->data->put('name', $this->data->get('name'));
        $this->data->put('url', $this->data->get('url'));

        // External links.
        $this->data->put('sameAs', $this->data->get('sameAs'));

        return $this;
    }
}
