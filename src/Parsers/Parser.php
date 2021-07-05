<?php

namespace Elaniin\Findable\Parsers;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Statamic\Facades\Entry;
use Statamic\Facades\Site;
use Elaniin\Findable\Concerns\AccessesSettings;
use Elaniin\Findable\Concerns\AugmentsData;
use Elaniin\Findable\Concerns\FormatsDate;
use Elaniin\Findable\Schema\Concerns\GeneratesSameAs;
use Elaniin\Findable\Schema\Pieces\Article;
use Elaniin\Findable\Schema\Pieces\ImageObject;
use Elaniin\Findable\Schema\Pieces\Organization;
use Elaniin\Findable\Schema\Pieces\Person;
use Elaniin\Findable\Schema\Pieces\WebPage;
use Elaniin\Findable\Schema\Pieces\WebSite;
use Elaniin\Findable\Schema\Schema;
use Elaniin\Findable\Schema\SchemaIds;

class Parser
{
    use AccessesSettings;
    use FormatsDate;
    use GeneratesSameAs;
    use AugmentsData;

    /**
     * Context from where the parser has been initialized
     *
     * @var Collection
     */
    protected $context;

    /**
     * General add-on settings object
     *
     * @var Collection
     */
    protected $generalSettings;

    /**
     * @var \Statamic\Eloquent\Entries\Entry
     */
    private $data;

    /**
     * Setup the parser
     *
     * @param Collection $context Current context.
     * @return void
     */
    public function __construct(Collection $context)
    {
        $this->context = $context;
        $this->generalSettings = $this->getSettings(
            'general',
            $this->context->get('site')
        );
    }

    /**
     * Get the page data
     *
     * @return Collection
     */
    public function getPageData(): Collection
    {
        return collect([
            // Globals.
            'favicon'         => $this->generalSettings->get('global_favicon'),
            'site'            => $this->context->get('site'),
            'site_name'       => $this->generalSettings->get('site_name'),
            'disable_authors' => $this->generalSettings->get('disable_authors'),

            // Context.
            'is_home'       => $this->isHome(),
            'title'         => $this->getTitle(),
            'description'   => $this->context->get('meta_description'),
            'permalink'     => $this->context->get('permalink'),
            'published'     => $this->getPublishedDate(),
            'last_modified' => $this->getLastModified(),
            'author'        => $this->context->get('author'),
            'noindex'       => $this->getNoIndex(),
            'canonical_url' => $this->context->get('canonical_url'),
            'locales'       => $this->getLocales(),

            'og_image' => $this->getOpenGraphImage(),
            'og_type'  => $this->getOpenGraphType(),

            'twitter_card_type' => $this->context->get('twitter_card_type_page'),
        ]);
    }

    /**
     * Check if the current page is home
     *
     * @return bool
     */
    private function isHome(): bool
    {
        if (! $this->context->get('is_entry')) {
            return false;
        }

        if (! $this->context->get('page')) {
            return false;
        }

        return $this->context->get('parent') === null;
    }

    /**
     * Get the title for the current query
     *
     * @return string
     */
    private function getTitle(): string
    {
        /**
         * This is the title being overwritten by a middleware, view
         * composer, etc. by using the share() method.
         */
        $metaTitle = $this->context->get('__env')->shared('meta_title') ?? '';

        if (! $metaTitle) {
            if (! $this->context->get('is_term')) {
                $metaTitle = $this->augmented($this->context->get('meta_title'));
            }

            $metaTitle = $metaTitle ?? config('findable.default_meta_title');
        }

        $parsedTitle = $this->parseMergeTags($metaTitle);
        $parsedTitle = trim($parsedTitle, ' |');

        // Use regular title as fallback if the parsed is empty.
        return $parsedTitle ?? $this->augmented($this->context->get('title'));
    }

    /**
     * Parse the merge tags
     *
     * @param string $subject
     * @return string
     */
    private function parseMergeTags(?string $subject): string
    {
        return trim(str_replace(
            [
                '%title%',
                '%separator%',
                '%site_name%',
            ],
            [
                $this->augmented($this->context->get('title')),
                $this->generalSettings->get('title_separator'),
                $this->generalSettings->get('site_name'),
            ],
            $subject
        ));
    }

    /**
     * Get the entry published datetime
     *
     * @return string
     */
    private function getPublishedDate(): string
    {
        if ($this->context->get('is_term')) {
            return '';
        }

        return $this->formatIso8601($this->augmented($this->context->get('date')), false);
    }

    /**
     * Get the entry last modified datetime
     *
     * @return string
     */
    private function getLastModified(): string
    {
        if ($this->context->get('is_term')) {
            return '';
        }

        return $this->formatIso8601($this->augmented($this->context->get('last_modified')), false);
    }

    /**
     * Get the locales of the current entry
     *
     * @return array
     */
    private function getLocales(): Collection
    {
        return Site::all()->map(function ($locale, $key) {
            return $this->getLocale($key);
        })->pipe(function ($locales) {
            return $this->addData($locales);
        })->filter(function ($locale) {
            return $this->excludeCurrent($locale);
        })->values();
    }

    /**
     * Get a single locale array representation.
     *
     * @param  string $key
     * @return array
     */
    private function getLocale(string $key)
    {
        $site = $key instanceof \Statamic\Sites\Site ? $key : Site::get($key);

        return [
            'key'    => $site->handle(),
            'handle' => $site->handle(),
            'name'   => $site->name(),
            'full'   => $site->locale(),
            'short'  => $site->shortLocale(),
        ];
    }

    /**
     * Add data to the locale collection.
     *
     * @param Collection $locales
     */
    private function addData(Collection $locales)
    {
        return $locales->map(function ($locale, $key) {
            if (! $localized = $this->getLocalizedData($key)) {
                return null;
            }

            $localized['locale'] = $locale;
            $localized['current'] = Site::current()->handle();
            $localized['is_current'] = $key === Site::current()->handle();

            return $localized;
        });
    }

    /**
     * Get the localized version of the data object as an array.
     *
     * @param  string $locale
     * @return array
     */
    private function getLocalizedData($locale)
    {
        if (! $data = $this->getData()) {
            return null;
        }

        if (! $localized = $data->in($locale)) {
            return null;
        }

        if (method_exists($localized, 'published') && ! $localized->published()) {
            return null;
        }

        return $localized->toAugmentedArray();
    }

    /**
     * Exclude the current locale
     *
     * @param null|array $locale
     * @return bool
     */
    private function excludeCurrent(?array $locale): bool
    {
        if (! is_array($locale)) {
            return false;
        }

        if (! Arr::has($locale, 'is_current')) {
            return false;
        }

        return ! $locale['is_current'];
    }

    /**
     * Get the data / content object.
     *
     * @return \Statamic\Eloquent\Entries\Entry
     */
    private function getData()
    {
        if (isset($this->data)) {
            return $this->data;
        }

        return $this->data = Entry::find($this->context->get('id'));
    }

    /**
     * Get the robots status
     *
     * @return bool
     */
    private function getNoIndex(): bool
    {
        $noindexSite = $this->generalSettings->get('noindex_site')->value();

        if ($this->context->get('is_term')) {
            return $noindexSite;
        }

        if ($noindexSite === true) {
            return true;
        }

        return (bool) $this->augmented($this->context->get('noindex_page'));
    }

    /**
     * Get the OpenGraph image for the current entry/page
     *
     * @return string
     */
    private function getOpenGraphImage()
    {
        $ogImage = $this->augmented($this->context->get('og_image'));

        if (! $ogImage) {
            $ogImage = $this->generalSettings->get('default_og_image')->value();
        }

        return $ogImage;
    }

    /**
     * Get the OpenGraph object type
     *
     * @link https://ogp.me/#types
     *
     * @return string
     */
    private function getOpenGraphType(): string
    {
        if ($this->context->get('is_term')) {
            return '';
        }

        if ($page = $this->context->get('page')) {
            $page       = collect($page);
            $collection = $page->get('collection')->handle();

            /**
             * We will consider the 'pages' collection (if any) to determine the root since Statamic refers to pages on
             * structures. It's a sort of convention.
             *
             * @link https://statamic.dev/collections
             * @link https://github.com/statamic/cms/src/Structures/Pages.php
             */
            if ($collection === 'pages' && ! $page->get('parent')) {
                return 'website';
            }
        }

        return 'article';
    }

    /**
     * Generate the schema for Structured Data
     *
     * @return array
     */
    public function generateSchema(): array
    {
        if (! $this->context->get('is_entry')) {
            return [];
        }

        // Site owner: Organization/Person.
        $siteOwner = $this->generateOwnerSchema();

        // WebSite.
        $website = $this->generateWebSiteSchema();
        $website->addData('publisher', ['@id' => $siteOwner->getData('@id')]);

        // WebPage.
        $webpage = $this->generateWebPageSchema();
        $webpage->addData('isPartOf', ['@id' => $website->getData('@id')]);
        $webpage->addData('about', ['@id' => $siteOwner->getData('@id')]);

        // Article (Posts collection only).
        $article = null;

        if ($this->context->get('collection')->handle() === 'posts') {
            $article = $this->generateArticleSchema();
            $article->addData('mainEntityOfPage', ['@id' => $webpage->getData('@id')]);
            $article->addData('publisher', ['@id' => $siteOwner->getData('@id')]);
        }

        // Featured image.
        $primaryImage = $this->generateFeaturedImageSchema();

        // Schema Graph
        $schema = new Schema();
        $schema->addGraph($siteOwner);
        $schema->addGraph($website);
        $schema->addGraph($webpage);
        $schema->addGraph($article);

        if ($primaryImage) {
            $webpage->addData('primaryImageOfPage', ['@id' => $primaryImage->getData('@id')]);
            $article->addData('image', ['@id' => $primaryImage->getData('@id')]);

            $schema->addGraph($primaryImage);
        }

        return array_filter([
            $schema->generate(),
            $this->getAdditionalSchema()
        ]);
    }

    /**
     * Generate site owner schema
     *
     * @return Person|Organization
     */
    private function generateOwnerSchema()
    {
        $owner = $this->generalSettings->get('company_or_person')->value();

        if ($owner->value() === 'person') {
            $siteOwner = new Person(
                collect([
                    '@id'    => $this->site->absoluteUrl() . SchemaIds::PERSON,
                    'name'   => $this->generalSettings->get('target_name'),
                    'url'    => $this->site->absoluteUrl(),
                    'sameAs' => $this->getSameAs(),
                ])
            );
        } else {
            $siteOwner = new Organization(
                $this->context->get('site'),
                $this->generalSettings
            );
        }

        return $siteOwner->generate();
    }

    /**
     * Generate website schema
     *
     * @return WebSite
     */
    private function generateWebSiteSchema()
    {
        $website = new WebSite(
            $this->context->get('site'),
            $this->generalSettings
        );

        return $website->generate();
    }

    /**
     * Generate WebPage schema
     *
     * @return WebPage
     */
    private function generateWebPageSchema()
    {
        $webpage = new WebPage($this->context);

        return $webpage->generate();
    }

    /**
     * Generate Article schema
     *
     * @return Article
     */
    private function generateArticleSchema()
    {
        $article = new Article($this->context);

        return $article->generate();
    }

    /**
     * Generate feature image schema if available
     *
     * @return ImageObject|null
     */
    private function generateFeaturedImageSchema()
    {
        $featuredImage = $this->context->get('featured_image');

        if ($featuredImage) {
            $featuredImage = $featuredImage->value();

            $primaryImage = new ImageObject(
                $this->context->get('site'),
                $featuredImage,
                $this->context->get('permalink') . SchemaIds::PRIMARY_IMAGE
            );

            return $primaryImage->generate();
        }

        return null;
    }

    /**
     * Additional Schema
     *
     * @return string|null
     */
    private function getAdditionalSchema()
    {
        $schema = $this->augmented($this->context->get('additional_schema'));

        // Ensure JSON encoding re-encoding the user input.
        $schema = json_decode($schema);

        if (! $schema) {
            return null;
        }

        $schema = json_encode($schema);

        return $schema;
    }
}
