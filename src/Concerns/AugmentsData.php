<?php

namespace Elaniin\Findable\Concerns;

trait AugmentsData
{
    /**
     * Get the augmented value of a variable
     *
     * @param mixed $value
     * @return mixed
     */
    public function augmented($value)
    {
        if ($value instanceof \Statamic\Fields\Value) {
            return $value->value();
        }

        return $value;
    }
}
