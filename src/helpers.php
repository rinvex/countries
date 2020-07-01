<?php

declare(strict_types=1);

use Rinvex\Country\CountryLoader;
use Rinvex\Country\CurrencyLoader;

if (! function_exists('country')) {
    /**
     * Get the country by it's ISO 3166-1 alpha-2.
     *
     * @param string $code
     * @param bool   $hydrate
     *
     * @return \Rinvex\Country\Country|array
     */
    function country($code, $hydrate = true)
    {
        return CountryLoader::country($code, $hydrate);
    }
}

if (! function_exists('countries')) {
    /**
     * Get all countries short-listed.
     *
     * @param bool $longlist
     * @param bool $hydrate
     *
     * @return array
     */
    function countries($longlist = false, $hydrate = false)
    {
        return CountryLoader::countries($longlist, $hydrate);
    }
}

if (! function_exists('currencies')) {
    /**
     * Get all countries short-listed.
     *
     * @param bool $longlist
     * @param bool $hydrate
     *
     * @return array
     */
    function currencies($longlist = false)
    {
        return CurrencyLoader::currencies($longlist);
    }
}
