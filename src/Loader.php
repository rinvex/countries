<?php

/*
 * NOTICE OF LICENSE
 *
 * Part of the Rinvex Country Package.
 *
 * This source file is subject to The MIT License (MIT)
 * that is bundled with this package in the LICENSE file.
 *
 * Package: Rinvex Country Package
 * License: The MIT License (MIT)
 * Link:    https://rinvex.com
 */

namespace Rinvex\Country;

class Loader
{
    /**
     * The countries array.
     *
     * @var array
     */
    protected static $countries;

    /**
     * Get the country by it's ISO 3166-1 alpha-2.
     *
     * @param string $code
     * @param bool   $hydrate
     *
     * @return \Rinvex\Country\Country|array
     */
    public static function country($code, $hydrate = true)
    {
        if (! isset(self::$countries[$code])) {
            self::$countries[$code] = json_decode(self::getFile(__DIR__.'/../resources/data/'.$code.'.json'), true);
        }

        return $hydrate ? new Country(self::$countries[$code]) : self::$countries[$code];
    }

    /**
     * Get all countries short-listed.
     *
     * @param bool $longlist
     * @param bool $hydrate
     *
     * @return array
     */
    public static function countries($longlist = false, $hydrate = false)
    {
        $list = $longlist ? 'longlist' : 'shortlist';

        if (! isset(self::$countries[$list])) {
            self::$countries[$list] = json_decode(self::getFile(__DIR__.'/../resources/data/'.$list.'.json'), true);
        }

        return $hydrate ? array_map(function ($country) {
            return new Country($country);
        }, self::$countries[$list]) : self::$countries[$list];
    }

    /**
     * Filter items by the given key value pair.
     *
     * @param string $key
     * @param mixed  $value
     * @param bool   $strict
     *
     * @return array
     */
    public static function where($key, $value, $strict = true)
    {
        if (! isset(self::$countries['longlist'])) {
            self::$countries['longlist'] = json_decode(self::getFile(__DIR__.'/../resources/data/longlist.json'), true);
        }

        return self::filter(self::$countries['longlist'], function ($item) use ($key, $value, $strict) {
            return $strict ? self::get($item, $key) === $value : self::get($item, $key) == $value;
        });
    }

    /**
     * Run a filter over each of the items.
     *
     * @param array         $items
     * @param callable|null $callback
     *
     * @return array
     */
    public static function filter($items, callable $callback = null)
    {
        if ($callback) {
            $return = [];

            foreach ($items as $key => $value) {
                if ($callback($value, $key)) {
                    $return[$key] = $value;
                }
            }

            return $return;
        }

        return array_filter($items);
    }

    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param mixed        $target
     * @param string|array $key
     * @param mixed        $default
     *
     * @return mixed
     */
    public static function get($target, $key, $default = null)
    {
        if (is_null($key)) {
            return $target;
        }

        $key = is_array($key) ? $key : explode('.', $key);

        while (($segment = array_shift($key)) !== null) {
            if ($segment === '*') {
                if (! is_array($target)) {
                    return value($default);
                }

                $result = self::pluck($target, $key);

                return in_array('*', $key) ? self::collapse($result) : $result;
            }

            if (is_array($target) && array_key_exists($segment, $target)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }

        return $target;
    }

    /**
     * Pluck an array of values from an array.
     *
     * @param array             $array
     * @param string|array      $value
     * @param string|array|null $key
     *
     * @return array
     */
    public static function pluck($array, $value, $key = null)
    {
        $results = [];

        $value = is_string($value) ? explode('.', $value) : $value;

        $key = is_null($key) || is_array($key) ? $key : explode('.', $key);

        foreach ($array as $item) {
            $itemValue = self::get($item, $value);

            // If the key is "null", we will just append the value to the array and keep
            // looping. Otherwise we will key the array using the value of the key we
            // received from the developer. Then we'll return the final array form.
            if (is_null($key)) {
                $results[] = $itemValue;
            } else {
                $itemKey = self::get($item, $key);

                $results[$itemKey] = $itemValue;
            }
        }

        return $results;
    }

    /**
     * Collapse an array of arrays into a single array.
     *
     * @param array $array
     *
     * @return array
     */
    public static function collapse($array)
    {
        $results = [];

        foreach ($array as $values) {
            if (! is_array($values)) {
                continue;
            }

            $results = array_merge($results, $values);
        }

        return $results;
    }

    /**
     * Get contents of the given file path.
     *
     * @param string $filePath
     *
     * @throws \Rinvex\Country\CountryLoaderException
     *
     * @return string
     */
    public static function getFile($filePath)
    {
        if (! file_exists($filePath)) {
            throw CountryLoaderException::invalidCountry();
        }

        return file_get_contents($filePath);
    }
}
