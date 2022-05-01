<?php

declare(strict_types=1);

namespace Rinvex\Country\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CountryServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        // Add country validation rule
        Validator::extend('country', function ($attribute, $value) {
            return is_string($value) && strlen($value) === 2 && array_key_exists(mb_strtolower($value), countries());
        }, trans('validation.invalid_country'));

        // Add currency validation rule
        Validator::extend('currency', function ($attribute, $value) {
            return is_string($value) && strlen($value) === 3 && array_key_exists(mb_strtoupper($value), currencies());
        }, trans('validation.invalid_currency'));
    }
}
