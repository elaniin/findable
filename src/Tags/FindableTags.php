<?php

namespace Elaniin\Findable\Tags;

use Statamic\Facades\Site;
use Statamic\Tags\Tags;
use Elaniin\Findable\Concerns\AccessesSettings;
use Elaniin\Findable\Parsers\Parser;

class FindableTags extends Tags
{
    use AccessesSettings;

    protected static $handle = 'findable';

    /**
     * Data parser
     *
     * @var Parser
     */
    public $dataParser;

    /**
     * Page data
     *
     * Contains the calculated title.
     *
     * @var \Illuminate\Support\Collection
     */
    public $pageData;

    /**
     * Set the page data parser properties
     *
     * Why no in a constructor? Because Tags don't have one, and most
     * importantly, the context is not available on our own either.
     *
     * @return void
     */
    public function setPageDataParser(): void
    {
        if (! isset($this->dataParser)) {
            $this->dataParser = new Parser(collect($this->context));
        }
    }

    /**
     * Return the <head /> tag content required for on-page SEO
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function head(): string
    {
        $this->setPageDataParser();
        $webmasterSettings = $this->getSettings('webmaster', Site::current());

        $data = $this->dataParser->getPageData();

        $data->put('gtm_container_id', $webmasterSettings->get('gtm_container_id'));
        $data->put('bing_verification_code', $webmasterSettings->get('bing_verification_code'));
        $data->put('google_verification_code', $webmasterSettings->get('google_verification_code'));
        $data->put('yandex_verification_code', $webmasterSettings->get('yandex_verification_code'));

        $view = view('findable::tags.head', $data);

        return $this->cleanMarkup($view);
    }

    /**
     * Return the tag content required for on-page SEO on the footer
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function body(): string
    {
        $webmasterSettings = $this->getSettings('webmaster', Site::current());

        $view = view('findable::tags.body', [
            'gtm_container_id' => $webmasterSettings->get('gtm_container_id'),
        ]);

        return $this->cleanMarkup($view);
    }

    /**
     * Return the tag content required for on-page SEO on the footer
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function footer(): string
    {
        $this->setPageDataParser();

        $view = view('findable::tags.footer', [
            'schema' => $this->dataParser->generateSchema(),
        ]);

        return $this->cleanMarkup($view);
    }

    /**
     * Cleanup the markup
     *
     * @param string $markup
     * @return string
     */
    private function cleanMarkup($markup): string
    {
        return preg_replace(
            [
                '/\n{2,}/m',
                '/^[\s\t]*/m'
            ],
            [
                "\n",
                "\t"
            ],
            $markup
        );
    }
}
