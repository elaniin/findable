<?php

namespace Elaniin\Findable\Robots;

class Robots
{
    /**
     * Get the robots.txt noindex content
     *
     * @return string
     */
    public static function getNoIndex(): string
    {
        return self::getUA() . 'Disallow: /';
    }

    /**
     * Get the robots.txt index content
     *
     * @return string
     */
    public static function getIndex(): string
    {
        $cpRoot = config('statamic.cp.route');

        return self::getUA() . "Disallow: /{$cpRoot}/";
    }

    /**
     * Get the robots.txt user agent line
     *
     * @return string
     */
    private static function getUA(): string
    {
        return 'User-agent: *' . PHP_EOL;
    }
}
