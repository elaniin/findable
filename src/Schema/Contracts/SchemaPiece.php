<?php

namespace Elaniin\Findable\Schema\Contracts;

abstract class SchemaPiece
{
    /**
     * The data type
     *
     * Automatically generated based on the class short name.
     *
     * @link https://schema.org/docs/full.html
     *
     * @var string
     */
    public $type;

    /**
     * The piece data
     *
     * @var Collection
     */
    public $data;

    /**
     * Setup the piece
     *
     * @return void
     */
    public function __construct()
    {
        $this->type = substr(strrchr(static::class, '\\'), 1);
        $this->data = collect([]);
    }

    /**
     * Generate the piece
     *
     * @return static
     */
    public function generate()
    {
        return $this;
    }

    /**
     * Add data to piece
     *
     * @param string $key
     * @param mixed $value
     * @return static
     */
    public function addData(string $key, $value)
    {
        $this->data->put($key, $value);

        return $this;
    }

    /**
     * Get part data
     *
     * @param string $key
     * @return mixed
     */
    public function getData(?string $key = null)
    {
        if ($key) {
            return $this->data->get($key);
        }

        return $this->data;
    }
}
