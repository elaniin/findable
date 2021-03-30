<?php

namespace Elaniin\Findable\Concerns;

use Illuminate\Support\Carbon;

trait FormatsDate
{
    /**
     * Format date to ISO 8601
     *
     * @param string|Carbon $date
     * @return string
     */
    private function formatIso8601($date, bool $includeTime = true): string
    {
        if (! $date instanceof Carbon) {
            $date = Carbon::createFromTimestamp($date);
        }

        if ($includeTime) {
            return $date->format(\DateTimeInterface::ISO8601);
        }

        return $date->format('Y-m-d');
    }
}
