<?php

declare(strict_types=1);

namespace Rinvex\Country;

class CurrencyLoader
{
    protected static $curriencies = [];

    /**
     * Retrive all the curriencies of all countries.
     *
     * @param bool $longlist states if need all the details of the curriencies or only the keys
     *
     * @throws \Rinvex\Country\CountryLoaderException
     *
     * @return array
     */
    public static function curriencies($longlist = false): array
    {
        $list = $longlist ? 'longlist' : 'shortlist';

        if (! isset(static::$curriencies[$list])) {
            $countries = CountryLoader::countries($longlist);

            foreach ($countries as $country) {
                if ($longlist) {
                    foreach ($country['currency'] as $currency => $details) {
                        static::$curriencies[$list][$currency] = $longlist ? $details : $currency;
                    }
                } else {
                    static::$curriencies[$list][] = $country['currency'];
                }
            }
        }

        return static::$curriencies[$list];
    }
}
