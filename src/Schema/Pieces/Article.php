<?php

namespace Elaniin\Findable\Schema\Pieces;

use Illuminate\Support\Collection;
use Elaniin\Findable\Concerns\FormatsDate;
use Elaniin\Findable\Schema\Contracts\SchemaPiece;
use Elaniin\Findable\Schema\SchemaIds;

class Article extends SchemaPiece
{
    use FormatsDate;

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
    public function generate(): Article
    {
        $this->data->put('@type', $this->type);
        $this->data->put('@id', $this->context->get('permalink') . SchemaIds::WEBPAGE);
        $this->data->put('url', $this->context->get('permalink'));
        $this->data->put('headline', $this->context->get('title')->value());
        $this->data->put('datePublished', $this->formatIso8601($this->context->get('date')->value(), false));
        $this->data->put('dateModified', $this->formatIso8601($this->context->get('last_modified'), false));
        $this->data->put('description', $this->context->get('meta_description')->value());
        $this->data->put('inLanguage', $this->context->get('site')->locale());

        // Author.
        $author = new Person(
            collect([
                '@id'    => $this->context->get('permalink') . SchemaIds::PERSON,
                'name'   => $this->context->get('author')->value()->name(),
            ])
        );

        $this->data->put('author', $author->getData());

        return $this;
    }
}
