# Rinvex Country

**Rinvex Country** is a simple and lightweight package for retrieving country details with flexibility. A whole bunch of data including name, demonym, capital, iso codes, dialling codes, geo data, currencies, and other attributes for all 250 countries worldwide at your fingertips.

[![Packagist](https://img.shields.io/packagist/v/rinvex/country.svg?label=Packagist&style=flat-square)](https://packagist.org/packages/rinvex/country)
[![License](https://img.shields.io/packagist/l/rinvex/country.svg?label=License&style=flat-square)](https://github.com/rinvex/country/blob/develop/LICENSE)
[![VersionEye Dependencies](https://img.shields.io/versioneye/d/php/rinvex:country.svg?label=Dependencies&style=flat-square)](https://www.versioneye.com/php/rinvex:country/)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/rinvex/country.svg?label=Scrutinizer&style=flat-square)](https://scrutinizer-ci.com/g/rinvex/country/)
[![Code Climate](https://img.shields.io/codeclimate/github/rinvex/country.svg?label=CodeClimate&style=flat-square)](https://codeclimate.com/github/rinvex/country)
[![StyleCI](https://styleci.io/repos/66037019/shield)](https://styleci.io/repos/66037019)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/f2dca242-eb65-4bcc-8481-cd27ea16c804.svg?label=SensioLabs&style=flat-square)](https://insight.sensiolabs.com/projects/f2dca242-eb65-4bcc-8481-cd27ea16c804)


## Quick Example (TL;DR)

Install via `composer require rinvex/country`, then use as follows:
```php
use Rinvex\Country\Models\Country;

// Find a country by it's ISO 3166-1 alpha-2
$egypt = (new Country)->find('EG');

// Find a country by one of its attributes
$usa = (new Country)->findBy('capital', 'Washington D.C.');

// Find all countries
$countries = (new Country)->findAll();

// Retrieve only `name`, `demonym`, and `currency` attributes of "Japan":
$japan = (new Country)->find('JP', ['name', 'demonym', 'currency']);

// Utilize Laravel Collections to get an array of all country names, with their 'iso_3166_1_alpha2' as the array keys
$allCountries = (new Country)->findAll()->pluck('name.common', 'iso_3166_1_alpha2');
```

---

**Mission accomplished! You're good to use this package right now! :white_check_mark:**

**Unless you're new to this kind of stuff, you can skip the following steps! :wink:**

---


## Table Of Contents

- [Installation](#installation)
    - [Compatibility](#compatibility)
    - [Prerequisites](#prerequisites)
    - [Require Package](#require-package)
    - [Install Dependencies](#install-dependencies)
- [Integration](#integration)
    - [Native Integration](#native-integration)
    - [Laravel Integration](#laravel-integration)
- [Usage](#usage)
- [Country Example](#country-example)
- [Features Explained](#features-explained)
- [Inspired By](#inspired-by)
- [Changelog](#changelog)
- [Support](#support)
- [Contributing & Protocols](#contributing--protocols)
- [Security Vulnerabilities](#security-vulnerabilities)
- [About Rinvex](#about-rinvex)
- [License](#license)


## Installation

The best and easiest way to install this package is through [Composer](https://getcomposer.org/).

### Compatibility

This package fully compatible with **Laravel** `5.1.*`, `5.2.*`, and `5.3.*`.

While this package tends to be framework-agnostic, it embraces Laravel culture and best practices to some extent. It's tested mainly with Laravel but you still can use it with other frameworks or even without any framework if you want.

### Prerequisites

```json
"php": ">=5.5.9",
"illuminate/support": "5.1.*|5.2.*|5.3.*"
```

### Require Package

Open your application's `composer.json` file and add the following line to the `require` array:
```json
"rinvex/country": "1.0.*"
```

> **Note:** Make sure that after the required changes your `composer.json` file is valid by running `composer validate`.

### Install Dependencies

On your terminal run `composer install` or `composer update` command according to your application's status to install the new requirements.

> **Note:** Checkout Composer's [Basic Usage](https://getcomposer.org/doc/01-basic-usage.md) documentation for further details.


## Integration

**Rinvex Country** package is framework-agnostic and as such can be integrated easily natively or with your favorite framework.

### Native Integration

Integrating the package outside of a framework is incredibly easy, just require the `vendor/autoload.php` file to autoload the package.

> **Note:** Checkout Composer's [Autoloading](https://getcomposer.org/doc/01-basic-usage.md#autoloading) documentation for further details.

### Laravel Integration

Integrating the package inside Laravel framework takes much less work, actually it doesn't require any integration steps after installation. Just jump directly to the [Usage](#usage) section. Awesome, huh?


## Usage

Using this package is pretty easy, and straightforward. It provides you with few simple and intuitive API.

First you need to import `Rinvex\Country\Models\Country` class in your file, then you can use any of the `Country` class methods, as follows:
```php
use Rinvex\Country\Models\Country;
```

The `find` method finds a country by it's ISO 3166-1 alpha-2, and returns an array of first result:
```php
$egypt = (new Country)->find('EG');
```

The `findBy` method finds a country by one of it's attributes, and returns an array of first result:
```php
$usa = (new Country)->findBy('capital', 'Washington D.C.');
```

The `findAll` method finds all countries, and returns a collection of all results:
```php
$countries = (new Country)->findAll();
```

This package utilizes [Laravel Collections](https://laravel.com/docs/5.2/collections), so you can just manipulate `findAll` method results the way you need. Example:
```php
// Get an array of all country names, with their 'iso_3166_1_alpha2' as the array keys
$allCountries = (new Country)->findAll()->pluck('name.common', 'iso_3166_1_alpha2');
```

> **Note:** All `find*` methods have an optional parameter for retrieved columns/attributes, see the following example:

Retrieve only `name`, `demonym`, and `currency` attributes of "Japan":
```php
$japan = (new Country)->find('JP', ['name', 'demonym', 'currency']);
```


## Country Example

```json
{
    "EG": {
        "name": {
            "common": "Egypt",
            "official": "Arab Republic of Egypt",
            "native": {
                "ara": {
                    "official": "جمهورية مصر العربية",
                    "common": "مصر"
                }
            }
        },
        "demonym": "Egyptian",
        "capital": "Cairo",
        "iso_3166_1_alpha2": "EG",
        "iso_3166_1_alpha3": "EGY",
        "iso_3166_1_numeric": "818",
        "currency": {
            "EGP": {
                "iso_4217_code": "EGP",
                "iso_4217_numeric": 818,
                "iso_4217_name": "Egyptian Pound",
                "iso_4217_minor_unit": 2
            }
        },
        "tld": [
            ".eg",
            ".مصر"
        ],
        "alt_spellings": [
            "EG",
            "Arab Republic of Egypt"
        ],
        "languages": {
            "ara": "Arabic"
        },
        "translations": {
            "cym": {
                "official": "Arab Republic of Egypt",
                "common": "Yr Aifft"
            },
            "deu": {
                "official": "Arabische Republik Ägypten",
                "common": "Ägypten"
            },
            "fra": {
                "official": "République arabe d'Égypte",
                "common": "Égypte"
            },
            "hrv": {
                "official": "Arapska Republika Egipat",
                "common": "Egipat"
            },
            "ita": {
                "official": "Repubblica araba d'Egitto",
                "common": "Egitto"
            },
            "jpn": {
                "official": "エジプト·アラブ共和国",
                "common": "エジプト"
            },
            "nld": {
                "official": "Arabische Republiek Egypte",
                "common": "Egypte"
            },
            "por": {
                "official": "República Árabe do Egipto",
                "common": "Egito"
            },
            "rus": {
                "official": "Арабская Республика Египет",
                "common": "Египет"
            },
            "spa": {
                "official": "República Árabe de Egipto",
                "common": "Egipto"
            },
            "fin": {
                "official": "Egyptin arabitasavalta",
                "common": "Egypti"
            }
        },
        "geo": {
            "continent": {
                "AF": "Africa"
            },
            "postal_code": true,
            "latitude": "27 00 N",
            "latitude_dec": "26.756103515625",
            "longitude": "30 00 E",
            "longitude_dec": "29.86229705810547",
            "max_latitude": "31.916667",
            "max_longitude": "36.333333",
            "min_latitude": "20.383333",
            "min_longitude": "24.7",
            "area": 1002450,
            "region": "Africa",
            "subregion": "Northern Africa",
            "world_region": "EMEA",
            "region_code": "002",
            "subregion_code": "015",
            "landlocked": false,
            "borders": [
                "ISR",
                "LBY",
                "SDN"
            ],
            "independent": "Yes"
        },
        "dialling": {
            "calling_code": [
                "20"
            ],
            "national_prefix": "0",
            "national_number_lengths": [
                9
            ],
            "national_destination_code_lengths": [
                2
            ],
            "international_prefix": "00"
        },
        "extra": {
            "geonameid": 357994,
            "edgar": "H2",
            "itu": "EGY",
            "marc": "ua",
            "wmo": "EG",
            "ds": "ET",
            "fifa": "EGY",
            "fips": "EG",
            "gaul": 40765,
            "ioc": "EGY",
            "cowc": "EGY",
            "cown": 651,
            "fao": 59,
            "imf": 469,
            "ar5": "MAF",
            "address_format": "{{recipient}}\n{{street}}\n{{postalcode}} {{city}}\n{{country}}",
            "eu_member": null,
            "vat_rates": null,
            "emoji": "🇪🇬",
            "emoji_unicode": "U+1F1EA U+1F1EC"
        }
    }
}
```


## Features Explained

- Country data are all stored here: `resources/data/countries.json`.
- `name`
    - `common` - common name in english
    - `official` - official name in english
    - `native` - list of all native names
        - key: three-letter ISO 639-3 language alpha code
        - value: name object
            - key: `official` - official name translation
            - key: `common` - common name translation
- `demonym` - name of residents
- `capital` - capital city
- `iso_3166_1_alpha2` - code ISO 3166-1 alpha-2
- `iso_3166_1_alpha3` -code ISO  3166-1 alpha-3
- `iso_3166_1_numeric` - code ISO 3166-1 numeric
- `currency` - ISO 4217 currency code(s)
    - key: three-letter ISO 4217 currency code
    - value: currency object
        - key: `iso_4217_code` - three-letter ISO 4217 currency alpha code
        - key: `iso_4217_numeric` - three-number ISO 4217 currency numeric code
        - key: `iso_4217_name` - official ISO 4217 currency name
        - key: `iso_4217_minor_unit` - minor currency unit
- `tld` - country code top-level domain
- `alt_spellings` - alternative spellings
- `languages` - list of official languages
    - key: three-letter ISO 639-3 language code
    - value: name of the language in english
- `translations` - list of name translations
    - key: three-letter ISO 639-3 language code
    - value: name object
        - key: `official` - official name translation
        - key: `common` - common name translation
- `geo`
    - `continent` - continents that country lies in
        - key: two-letter continent code
        - value: name of the continent in english
    - `postal_code` - geographical area postal code
    - `latitude` - short form of latitude coordinate point
    - `latitude_dec` - described latitude coordinate point
    - `longitude` - short form of longitude coordinate point
    - `longitude_dec` - described longitude coordinate point
    - `max_latitude` - maximum latitude coordinate point
    - `max_longitude` - maximum longitude coordinate point
    - `min_latitude` - minimum latitude coordinate point
    - `min_longitude` - minimum longitude coordinate point
    - `area` - land area in km²
    - `region` - geographical region
    - `subregion` - geographical sub-region
    - `world_region` - geographical world region
    - `region_code` - geographical region numeric code
    - `subregion_code` - geographical sub-region numeric code 
    - `landlocked` - landlocked status
    - `borders` - land borders
    - `independent` - independent status
- `dialling`
    - `calling_code` - calling code(s)
    - `national_prefix` - national prefix
    - `national_number_lengths` - national number lengths
    - `national_destination_code_lengths` - national destination code lengths 
    - `international_prefix` - international prefix
- `extra`
    - `geonameid` - Geoname ID
    - `edgar` - Electronic Data Gathering, Analysis, and Retrieval system
    - `itu` - Codes assigned by the International Telecommunications Union
    - `marc` - MAchine-Readable Cataloging codes from the Library of Congress
    - `wmo` - Country abbreviations by the World Meteorological Organization
    - `ds` - Distinguishing signs of vehicles in international traffic
    - `fifa` - Codes assigned by the Fédération Internationale de Football Association
    - `fips` - Codes from the U.S. Federal Information Processing Standard
    - `gaul` - Global Administrative Unit Layers from the Food and Agriculture Organization
    - `ioc` - Codes assigned by the International Olympics Committee
    - `cowc` - Correlates of War character
    - `cown` - Correlates of War numeric
    - `fao` - Food and Agriculture Organization 
    - `imf` - International Monetary Fund 
    - `ar5` - Fifth Assessment Report (AR5) 
    - `address_format` - Address forma
    - `eu_member` - European Union Member
    - `vat_rates` - Value-Added Tax
    - `emoji` - Emoji Flag
    - `emoji_unicode` - Emoji Flag Unicode


## Inspired By

This package has been inspired by, and used some country data of the following open-source projects:

- https://en.wikipedia.org
- https://github.com/hexorx/countries
- https://github.com/mledoze/countries
- https://github.com/annexare/Countries
- https://github.com/umpirsky/country-list
- https://github.com/datasets/country-list
- https://github.com/datasets/country-codes
- https://github.com/sripaulgit/country-codes
- https://github.com/alexrabarts/iso_country_codes
- https://github.com/vincentarelbundock/countrycode
- https://github.com/lukes/ISO-3166-Countries-with-Regional-Codes


## Changelog

Refer to the [Changelog](CHANGELOG.md) for a full history of the project.


## Support

The following support channels are available at your fingertips:

- [Chat on Slack](http://chat.rinvex.com)
- [Help on Email](mailto:help@rinvex.com)
- [Follow on Twitter](https://twitter.com/rinvex)


## Contributing & Protocols

Thank you for considering contributing to this project! The contribution guide can be found in [CONTRIBUTING.md](CONTRIBUTING.md).

Bug reports, feature requests, and pull requests are very welcome.

- [Versioning](CONTRIBUTING.md#versioning)
- [Support Policy](CONTRIBUTING.md#support-policy)
- [Coding Standards](CONTRIBUTING.md#coding-standards)
- [Pull Requests](CONTRIBUTING.md#pull-requests)


## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to help@rinvex.com. All security vulnerabilities will be promptly addressed.


## About Rinvex

Rinvex is a software solutions startup, specialized in integrated enterprise solutions for SMEs established in Alexandria, Egypt since June 2016. We believe that our drive The Value, The Reach, and The Impact is what differentiates us and unleash the endless possibilities of our philosophy through the power of software. We like to call it Innovation At The Speed Of Life. That’s how we do our share of advancing humanity.


## License

This software is released under [The MIT License (MIT)](LICENSE).

(c) 2016 Rinvex LLC, Some rights reserved.
