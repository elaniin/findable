<?php

namespace Elaniin\Findable\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Statamic\Entries\EntryCollection;
use Statamic\Facades\Site;
use Elaniin\Findable\Concerns\AccessesSettings;
use Elaniin\Findable\Data\Collection as FindableCollection;
use Elaniin\Findable\Data\Entry as FindableEntry;
use Elaniin\Findable\Sitemap\Sitemap;

class SitemapController extends Controller
{
    use AccessesSettings;

    /**
     * Render the sitemap_index.xml
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getSitemapIndex()->toResponse($request);
    }

    /**
     * Render the {$content_type}_sitemap.xml
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $contentType, Request $request)
    {
        if (! $this->isCollectionAllowed($contentType)) {
            abort(404);
        }

        return $this->getEntrySitemap($contentType)->toResponse($request);
    }

    /**
     * Get the cached sitemap index
     *
     * If the cache does not exist or it's expired, it will re-generate.
     *
     * @return \Spatie\Sitemap\Sitemap
     */
    private function getSitemapIndex()
    {
        if (! $this->isSiteIndexable()) {
            return Sitemap::index(collect());
        }

        $sitemap = Cache::get('sitemap_index');

        if (! $sitemap) {
            $sitemap = Sitemap::index($this->getCollectionHandles());

            Cache::tags(['sitemap', 'sitemap_index'])
                ->add('sitemap_index', $sitemap, config('findable.sitemap_cache_interval'));
        }

        return $sitemap;
    }

    /**
     * Get the cached entry sitemap
     *
     * If the cache does not exist or it's expired, it will re-generate.
     *
     * @param string $contentType
     * @return \Spatie\Sitemap\Sitemap
     */
    private function getEntrySitemap(string $contentType)
    {
        if (! $this->isSiteIndexable()) {
            return Sitemap::collection(new EntryCollection());
        }

        $cacheKey = Site::current() . ".{$contentType}_sitemap"; // e.g.: es.pages_sitemap
        $sitemap = Cache::get($cacheKey);

        if (! $sitemap) {
            $sitemap = Sitemap::collection($this->getCollectionEntries($contentType));

            Cache::tags(['sitemap', 'sitemap_entry'])
                ->add($cacheKey, $sitemap, config('findable.sitemap_cache_interval'));
        }

        return $sitemap;
    }

    /**
     * Get the publicly indexable collection handles.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getCollectionHandles()
    {
        return FindableCollection::public()
            ->map(function ($collection) {
                return $collection->handle();
            });
    }

    /**
     * Get the publicly available entries for the given collection
     *
     * @param string $collectionHandle
     * @return EntryCollection
     */
    private function getCollectionEntries(string $collectionHandle)
    {
        $entries = FindableEntry::public($collectionHandle, Site::current());

        if ($entries->count() > 0) {
            return $entries;
        }

        return new EntryCollection();
    }

    /**
     * Check if the given collection handle is allowed to be in the sitemap
     *
     * @param string $collectionHandle
     * @return bool
     */
    private function isCollectionAllowed(string $collectionHandle)
    {
        $allowedCollections = $this->getCollectionHandles()->toArray();

        return in_array($collectionHandle, $allowedCollections, true);
    }

    /**
     * Check if the site is set to be indexable
     *
     * @return bool
     */
    private function isSiteIndexable()
    {
        return ! (bool) $this->getSettings('general', Site::current())
            ->get('noindex_site')
            ->value();
    }
}
