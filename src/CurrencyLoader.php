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

        if (isset(static::$currencies[$list])) {
            return static::$currencies[$list];
        }

        $countries = CountryLoader::countries($longlist);
        $currencies = [];

        foreach ($countries as $country) {
            if (empty($country['currency'])) {
                continue;
            }

            if ($longlist) {
                foreach ($country['currency'] as $currency => $details) {
                    $currencies[$currency] = $details;
                }
            } else {
                $currencies[$country['currency']] = $country['currency'];
            }
        }

        ksort($currencies);

        static::$currencies[$list] = $currencies;

        return $currencies;
    }
}
