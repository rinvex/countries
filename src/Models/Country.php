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

namespace Rinvex\Country\Models;

class Country
{
    /**
     * The countries array.
     *
     * @var array
     */
    protected $countries;

    /**
     * Create a new Country model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->countries = collect(json_decode(file_get_contents(__DIR__.'/../../resources/data/countries.json'), true));
    }

    /**
     * Find a country by it's ISO 3166-1 alpha-2.
     *
     * @param string $code
     * @param array  $attributes
     *
     * @return array
     */
    public function find($code, array $attributes = [])
    {
        $result = $this->countries->only($code);

        return empty($attributes) ? $result->first() : $result->map(function ($country) use ($attributes) {
            return collect($country)->only($attributes);
        })->first();
    }

    /**
     * Find a country by one of it's attributes.
     *
     * @param string $attribute
     * @param mixed  $value
     * @param array  $attributes
     *
     * @return array
     */
    public function findBy($attribute, $value, array $attributes = [])
    {
        $result = $this->countries->where($attribute, $value);

        return empty($attributes) ? $result->first() : $result->map(function ($country) use ($attributes) {
            return collect($country)->only($attributes)->all();
        })->first();
    }

    /**
     * Find all countries.
     *
     * @param array $attributes
     *
     * @return \Illuminate\Support\Collection
     */
    public function findAll(array $attributes = [])
    {
        $countries = $this->countries;

        return empty($attributes) ? $countries : $countries->map(function ($item) use ($attributes) {
            return collect($item)->only($attributes)->all();
        });
    }
}
