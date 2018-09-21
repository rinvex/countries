<?php

declare(strict_types=1);

namespace Rinvex\Country;

use Exception;

class CountryLoaderException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @return static
     */
    public static function invalidCountry()
    {
        return new static('Country code may be misspelled, invalid, or data not found on server!');
    }
}
