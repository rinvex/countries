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
            if ($longlist) {
                foreach ($country['currency'] as $currency => $details) {
                    $currencies[$currency] = $longlist ? $details : $currency;
                }
            } else {
                $currencies[] = $country['currency'];
            }
        }

        if (! $longlist) {
            $currencies = array_filter(array_unique(static::$currencies[$list]), function ($item) {
                return is_string($item);
            });

            sort($currencies);

            $currencies = array_combine($currencies, $currencies);
        } else {
            ksort($currencies);
        }

        static::$currencies[$list] = $currencies;

        return $currencies;
    }
}
