<?php

namespace Elaniin\Findable\Schema;

use Elaniin\Findable\Schema\Contracts\SchemaPiece;

class Schema
{
    /**
     * The main schema
     *
     * @var \Illuminate\Support\Collection
     */
    protected $schema;

    /**
     * The graph
     *
     * @var \Illuminate\Support\Collection
     */
    protected $graph;

    /**
     * Setup the schema holder
     *
     * @param SchemaPiece[] $schemaPieces
     * @return void
     */
    public function __construct()
    {
        $this->graph  = collect([]);
        $this->schema = collect([
            '@context' => 'https://schema.org',
        ]);
    }

    /**
     * Add graph
     *
     * @param SchemaPiece $schemaPiece
     * @return \Illuminate\Support\Collection
     */
    public function addGraph(?SchemaPiece $schemaPiece)
    {
        if ($schemaPiece) {
            $this->graph->push($schemaPiece);
        }
    }

    /**
     * Expand schemas to add them to the graph
     *
     * @return \Illuminate\Support\Collection
     */
    public function expandGraphs()
    {
        return $this->graph->map(function (SchemaPiece $graph) {
            return $graph->getData();
        });
    }

    /**
     * Generate the main JSON+LD object
     *
     * @return string
     */
    public function generate()
    {
        $this->schema->put('@graph', $this->expandGraphs());

        return $this->schema->toJson();
    }
}
