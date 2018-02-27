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
            return array_key_exists(mb_strtolower($value), countries());
        }, 'Country MUST be valid!');
    }
}
