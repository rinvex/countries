<?php

declare(strict_types=1);

namespace Rinvex\Country;

class CurrencyLoader
{
    protected static $currencies = [];

    /**
     * Retrive all the currencies of all countries.
     *
     * @param bool $longlist states if need all the details of the currencies or only the keys
     *
     * @throws \Rinvex\Country\CountryLoaderException
     *
     * @return array
     */
    public static function currencies($longlist = false): array
    {
        $list = $longlist ? 'longlist' : 'shortlist';

        if (! isset(static::$currencies[$list])) {
            $countries = CountryLoader::countries($longlist);

            foreach ($countries as $country) {
                if ($longlist) {
                    foreach ($country['currency'] as $currency => $details) {
                        ! $currency || static::$currencies[$list][$currency] = $longlist ? $details : $currency;
                    }
                } else {
                    ! $country['currency'] || static::$currencies[$list][$country['currency']] = $country['currency'];
                }
            }
        }

        $currencies = static::$currencies[$list];

        ksort($currencies);

        return $currencies;
    }
}
