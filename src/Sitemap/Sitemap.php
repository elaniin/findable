<?php

namespace Elaniin\Findable\Sitemap;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Spatie\Sitemap\Sitemap as SpatieSitemap;
use Spatie\Sitemap\Tags\Url;
use Statamic\Contracts\Entries\Entry;
use Statamic\Entries\EntryCollection;
use Statamic\Facades\Site;

class Sitemap
{
    /**
     * Generate a sitemap index with the given data types
     *
     * @param Collection $dataTypes
     * @return SpatieSitemap
     */
    public static function index(Collection $dataTypes)
    {
        $sitemap = SpatieSitemap::create();
        $siteHandle = Site::default()->handle() === Site::current()->handle()
            ? ''
            : '' . Site::current()->handle();

        $dataTypes->each(function (string $dataType) use ($sitemap, $siteHandle) {
            $sitemap->add(
                Url::create("{$siteHandle}/{$dataType}_sitemap.xml")
                    ->setChangeFrequency('')
                    ->setPriority(0)
                    ->setLastModificationDate(Carbon::now())
            );
        });

        return $sitemap;
    }

    /**
     * Generate a sitemap for the given entry collection
     *
     * @param EntryCollection $entries
     * @return SpatieSitemap
     */
    public static function collection(EntryCollection $entries)
    {
        $sitemap = SpatieSitemap::create();

        $entries
            ->filter(function (Entry $entry) {
                return $entry->get('noindex_page') !== true;
            })
            ->each(function (Entry $entry) use ($sitemap) {
                $sitemap->add(
                    Url::create($entry->url())
                        ->setChangeFrequency('')
                        ->setPriority(0)
                        ->setLastModificationDate(self::getLastModified($entry))
                );
            });

        return $sitemap;
    }

    /**
     * Get the last modified date of the given entry.
     *
     * @param Entry $entry
     * @return DateTimeInterface
     */
    protected static function getLastModified(Entry $entry): DateTimeInterface
    {
        if (\is_int($entry->lastModified())) {
            return Carbon::createFromTimestamp($entry->lastModified());
        }

        return $entry->lastModified();
    }
}
