<?php

namespace Elaniin\Findable\Schema\Concerns;

trait GeneratesSameAs
{
    /**
     * Generate the sameAs array of links
     *
     * @return array
     */
    public function getSameAs()
    {
        $sameAs = [];
        $links = collect($this->generalSettings->get('external_links')->value());

        if ($links->isNotEmpty()) {
            $sameAs = $links->pluck('url')
                ->map(function ($link) {
                    return $link->value();
                })
                ->toArray();
        }

        return $sameAs;
    }
}
