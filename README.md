# Rinvex Country

**Rinvex Country** is a simple and lightweight package for retrieving country details with flexibility. A whole bunch of data including name, demonym, capital, iso codes, dialling codes, geo data, currencies, flags, emoji, and other attributes for all 250 countries worldwide at your fingertips.

[![Packagist](https://img.shields.io/packagist/v/rinvex/countries.svg?label=Packagist&style=flat-square)](https://packagist.org/packages/rinvex/countries)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/rinvex/countries.svg?label=Scrutinizer&style=flat-square)](https://scrutinizer-ci.com/g/rinvex/countries/)
[![Travis](https://img.shields.io/travis/rinvex/countries.svg?label=TravisCI&style=flat-square)](https://travis-ci.org/rinvex/countries)
[![StyleCI](https://styleci.io/repos/66037019/shield)](https://styleci.io/repos/66037019)
[![License](https://img.shields.io/packagist/l/rinvex/countries.svg?label=License&style=flat-square)](https://github.com/rinvex/countries/blob/develop/LICENSE)


## Usage

Install via `composer require rinvex/countries`, then use intuitively:

```php
// Get single country
$egypt = country('eg');

// Get country name                                 // Get country native name
echo $egypt->getName();                             echo $egypt->getNativeName();

// Get country official name                        // Get country ISO 3166-1 alpha2 code
echo $egypt->getOfficialName();                     echo $egypt->getIsoAlpha2();

// Get country area                                 // Get country borders
echo $egypt->getArea();                             echo $egypt->getBorders();

// Get country currencies                           // Get country languages
echo $egypt->getCurrencies();                       echo $egypt->getLanguages();

// Get country emoji                                // Get country flag
echo $egypt->getEmoji();                            echo $egypt->getFlag();


// Get all countries                                // Get countries with where condition (continent: Oceania)
$countries = countries();                           $whereCountries = \Rinvex\Country\CountryLoader::where('geo.continent', ['OC' => 'Oceania']);
```

> **Note:** This package is framework-agnostic, so it's compatible with any PHP framework whatsoever without any dependencies at all, except for the PHP version itself **^7.0**. Awesome, huh? :smiley:


## Table Of Contents

- [Advanced Usage](#advanced-usage)
- [Features Explained](#features-explained)
- [Data Sources](#data-sources)
- [Upgrade](#upgrade)
- [Changelog](#changelog)
- [Support](#support)
- [Contributing & Protocols](#contributing--protocols)
- [Security Vulnerabilities](#security-vulnerabilities)
- [About Rinvex](#about-rinvex)
- [License](#license)


## Advanced Usage

Get country attributes (self-descriptive):

```php
$egypt = country('eg');

// Egypt                                            // مصر
$egypt->getName();                                  $egypt->getNativeName();

// Arab Republic of Egypt                           // جمهورية مصر العربية
$egypt->getOfficialName();                          $egypt->getNativeOfficialName();

// Egyptian                                         // Cairo
$egypt->getDemonym();                               $egypt->getCapital();

// EG                                               // EGY
$egypt->getIsoAlpha2();                             $egypt->getIsoAlpha3();

// 818                                              // .eg
$egypt->getIsoNumeric();                            $egypt->getTld();

// [".eg",".مصر"]                                   // ["EG","Arab Republic of Egypt"]
$egypt->getTlds();                                  $egypt->getAltSpellings();

// Arabic                                           // {"ara":"Arabic"}
$egypt->getLanguage();                              $egypt->getLanguages();

// Africa                                           // true
$egypt->getContinent();                             $egypt->usesPostalCode();

// 27 00 N                                          // 30 00 E
$egypt->getLatitude();                              $egypt->getLongitude();

// 26.756103515625                                  // 29.86229705810547
$egypt->getLatitudeDesc();                          $egypt->getLongitudeDesc();

// 31.916667                                        // 36.333333
$egypt->getMaxLatitude();                           $egypt->getMaxLongitude();

// 20.383333                                        // 24.7
$egypt->getMinLatitude();                           $egypt->getMinLongitude();

// 1002450                                          // Africa
$egypt->getArea();                                  $egypt->getRegion();

// Northern Africa                                  // EMEA
$egypt->getSubregion();                             $egypt->getWorldRegion();

// 002                                              // 015
$egypt->getRegionCode();                            $egypt->getSubregionCode();

// false                                            // ["ISR","LBY","SDN"]
$egypt->isLandlocked();                             $egypt->getBorders();

// Yes                                              // 20
$egypt->isIndependent();                            $egypt->getCallingCode();

// ["20"]                                           // 0
$egypt->getCallingCodes();                          $egypt->getNationalPrefix();

// 9                                                // [9]
$egypt->getNationalNumberLength();                  $egypt->getNationalNumberLengths();

// 2                                                // [2]
$egypt->getNationalDestinationCodeLength();         $egypt->getnationaldestinationcodelengths();

// "00"                                             // {{recipient}}\n{{street}}\n{{postalcode}} {{city}}\n{{country}}
$egypt->getInternationalPrefix();                   $egypt->getAddressFormat();

// 357994                                           // H2
$egypt->getGeonameid();                             $egypt->getEdgar();

// EGY                                              // ua
$egypt->getItu();                                   $egypt->getMarc();

// EG                                               // ET
$egypt->getWmo();                                   $egypt->getDs();

// EGY                                              // EG
$egypt->getFifa();                                  $egypt->getFips();

// 40765                                            // EGY
$egypt->getGaul();                                  $egypt->getIoc();

// EGY                                              // 651
$egypt->getCowc();                                  $egypt->getCown();

// 59                                               // 469
$egypt->getFao();                                   $egypt->getImf();

// MAF                                              // null
$egypt->getAr5();                                   $egypt->isEuMember();

// null                                             // 🇪🇬
$egypt->getVatRates();                              $egypt->getEmoji();

// GeoJson data returned as string                  // SVG data returned as string
$egypt->getGeoJson();                               $egypt->getFlag();

// Divisions returned as array                      // {"official":"جمهورية مصر العربية","common":"مصر"}
$egypt->getDivisions();                             $egypt->getTranslation();

// ['Africa/Cairo']                                 // ['ar_EG']
$egypt->getTimezones();                             $egypt->getLocales();

// Other                                            // {"ara":{"official":"جمهورية مصر العربية","common":"مصر"}}
$egypt->getDataProtection()                         $egypt->getNativeNames();

// {"iso_4217_code":"EGP","iso_4217_numeric":818,"iso_4217_name":"Egyptian Pound","iso_4217_minor_unit":2}
$egypt->getCurrency();

// {"EGP":{"iso_4217_code":"EGP","iso_4217_numeric":818,"iso_4217_name":"Egyptian Pound","iso_4217_minor_unit":2}}
$egypt->getCurrencies();

// {"ara":{"official":"جمهورية مصر العربية","common":"مصر"},"cym":{"official":"Arab Republic of Egypt","common":"Yr Aifft"},"deu":{"official":"Arabische Republik Ägypten","common":"Ägypten"},"fra":{"official":"République arabe d'Égypte","common":"Égypte"},"hrv":{"official":"Arapska Republika Egipat","common":"Egipat"},"ita":{"official":"Repubblica araba d'Egitto","common":"Egitto"},"jpn":{"official":"エジプト·アラブ共和国","common":"エジプト"},"nld":{"official":"Arabische Republiek Egypte","common":"Egypte"},"por":{"official":"República Árabe do Egipto","common":"Egito"},"rus":{"official":"Арабская Республика Египет","common":"Египет"},"spa":{"official":"República Árabe de Egipto","common":"Egipto"},"fin":{"official":"Egyptin arabitasavalta","common":"Egypti"}}
$egypt->getTranslations();

// {"continent":{"AF":"Africa"},"postal_code":true,"latitude":"27 00 N","latitude_dec":"26.756103515625","longitude":"30 00 E","longitude_dec":"29.86229705810547","max_latitude":"31.916667","max_longitude":"36.333333","min_latitude":"20.383333","min_longitude":"24.7","area":1002450,"region":"Africa","subregion":"Northern Africa","world_region":"EMEA","region_code":"002","subregion_code":"015","landlocked":false,"borders":["ISR","LBY","SDN"],"independent":"Yes"}
$egypt->getGeodata();

// {"geonameid":357994,"edgar":"H2","itu":"EGY","marc":"ua","wmo":"EG","ds":"ET","fifa":"EGY","fips":"EG","gaul":40765,"ioc":"EGY","cowc":"EGY","cown":651,"fao":59,"imf":469,"ar5":"MAF","address_format":"{{recipient}}\n{{street}}\n{{postalcode}} {{city}}\n{{country}}","eu_member":null,"data_protection":"Other","vat_rates":null,"emoji":"🇪🇬"}
$egypt->getExtra();

// {"name":"Al Iskandariyah","alt_names":["El Iskandariya","al-Iskandariyah","al-Iskandarīyah","Alexandria","Alexandrie","Alexandria"],"geo":{"latitude":31.2000924,"longitude":29.9187387,"min_latitude":31.1173177,"min_longitude":29.8233701,"max_latitude":31.330904,"max_longitude":30.0864016}}
$egypt->getDivision("ALX");
```

> **Note:** When retrieving single country, you'll get the full country details just like the previous example. But when retrieving all countries, you'll get a short-listed result set with common country details for better performance.


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
    - `postal_code` - whether the country uses postal codes
    - `latitude` - short form of latitude coordinate point
    - `latitude_desc` - described latitude coordinate point
    - `longitude` - short form of longitude coordinate point
    - `longitude_desc` - described longitude coordinate point
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
    - `landlocked` - landlock status
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
    - `address_format` - Address format
    - `eu_member` - European Union Member
    - `data_protection` - Data Protection
    - `vat_rates` - Value-Added Tax
    - `emoji` - Emoji Flag


## Data Sources

- Currency Data (27th Sep, 2016): http://www.currency-iso.org
- Emoji Flags (27th Sep, 2016): http://unicode.org/emoji/charts/full-emoji-list.html
- World Borders (27th Sep, 2016): http://thematicmapping.org/downloads/world_borders.php
- GeoJson & SVG Flags (27th Sep, 2016): https://github.com/mledoze/countries/tree/master/data
- Main Country Data, Regions, and Divisions (27th Sep, 2016): https://github.com/hexorx/countries
- Other Resources:
    - https://en.wikipedia.org
    - https://github.com/annexare/Countries
    - https://github.com/umpirsky/country-list
    - https://github.com/datasets/country-list
    - https://github.com/datasets/country-codes
    - https://github.com/sripaulgit/country-codes
    - https://github.com/alexrabarts/iso_country_codes
    - https://github.com/vincentarelbundock/countrycode
    - https://github.com/lukes/ISO-3166-Countries-with-Regional-Codes


## Upgrade

- **Upgrading To `v3.x` From `v2.x`**

  No major changes, same API with 100% backward compatibility. Note that **PHP v7.0** is now minimum requirement.

- **Upgrading To `v2.x` From `v1.x`**

  Whole package re-written from scratch, just drop any previous code and start using the new clean, and intuitive API.


## Changelog

Refer to the [Changelog](CHANGELOG.md) for a full history of the project.


## Support

The following support channels are available at your fingertips:

- [Chat on Slack](https://bit.ly/rinvex-slack)
- [Help on Email](mailto:help@rinvex.com)
- [Follow on Twitter](https://twitter.com/rinvex)


## Contributing & Protocols

Thank you for considering contributing to this project! The contribution guide can be found in [CONTRIBUTING.md](CONTRIBUTING.md).

Bug reports, feature requests, and pull requests are very welcome.

- [Versioning](CONTRIBUTING.md#versioning)
- [Pull Requests](CONTRIBUTING.md#pull-requests)
- [Coding Standards](CONTRIBUTING.md#coding-standards)
- [Feature Requests](CONTRIBUTING.md#feature-requests)
- [Git Flow](CONTRIBUTING.md#git-flow)


## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to [help@rinvex.com](help@rinvex.com). All security vulnerabilities will be promptly addressed.


## About Rinvex

Rinvex is a software solutions startup, specialized in integrated enterprise solutions for SMEs established in Alexandria, Egypt since June 2016. We believe that our drive The Value, The Reach, and The Impact is what differentiates us and unleash the endless possibilities of our philosophy through the power of software. We like to call it Innovation At The Speed Of Life. That’s how we do our share of advancing humanity.


## License

This software is released under [The MIT License (MIT)](LICENSE).

(c) 2016-2022 Rinvex LLC, Some rights reserved.
