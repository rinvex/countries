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
    public function boot(): void
    {
        // Add country validation rule
        Validator::extend('country', fn ($attribute, $value): bool => is_string($value) && mb_strlen($value) === 2 && array_key_exists(mb_strtolower($value), countries()), __('validation.invalid_country'));

        // Add currency validation rule
        Validator::extend('currency', fn ($attribute, $value): bool => is_string($value) && mb_strlen($value) === 3 && array_key_exists(mb_strtoupper($value), currencies()), __('validation.invalid_currency'));
    }
}
