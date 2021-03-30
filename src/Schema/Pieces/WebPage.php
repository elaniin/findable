<?php

namespace Elaniin\Findable\Schema\Pieces;

use Elaniin\Findable\Concerns\AugmentsData;
use Illuminate\Support\Collection;
use Elaniin\Findable\Concerns\FormatsDate;
use Elaniin\Findable\Schema\Contracts\SchemaPiece;
use Elaniin\Findable\Schema\SchemaIds;

class WebPage extends SchemaPiece
{
    use FormatsDate;
    use AugmentsData;

    /**
     * The data context
     *
     * @var Collection
     */
    public $context;

    /**
     * Setup the piece
     *
     * @param Collection $context
     * @return void
     */
    public function __construct(Collection $context = null)
    {
        parent::__construct();

        $this->context = $context;
    }

    /**
     * @inheritdoc
     */
    public function generate(): WebPage
    {
        $this->data->put('@type', $this->type);
        $this->data->put('@id', $this->context->get('permalink') . SchemaIds::WEBPAGE);
        $this->data->put('url', $this->context->get('permalink'));
        $this->data->put('name', $this->augmented($this->context->get('title')));
        $this->data->put('datePublished', $this->formatIso8601($this->augmented($this->context->get('date')), false));
        $this->data->put('dateModified', $this->formatIso8601($this->context->get('last_modified'), false));
        $this->data->put('description', $this->augmented($this->context->get('meta_description')));
        $this->data->put('inLanguage', $this->context->get('site')->locale());

        return $this;
    }
}
