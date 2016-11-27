# Rinvex Country

**Rinvex Country** is a simple and lightweight package for retrieving country details with flexibility. A whole bunch of data including name, demonym, capital, iso codes, dialling codes, geo data, currencies, flags, emoji, and other attributes for all 250 countries worldwide at your fingertips.

[![Packagist](https://img.shields.io/packagist/v/rinvex/country.svg?label=Packagist&style=flat-square)](https://packagist.org/packages/rinvex/country)
[![VersionEye Dependencies](https://img.shields.io/versioneye/d/php/rinvex:country.svg?label=Dependencies&style=flat-square)](https://www.versioneye.com/php/rinvex:country/)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/rinvex/country.svg?label=Scrutinizer&style=flat-square)](https://scrutinizer-ci.com/g/rinvex/country/)
[![Code Climate](https://img.shields.io/codeclimate/github/rinvex/country.svg?label=CodeClimate&style=flat-square)](https://codeclimate.com/github/rinvex/country)
[![Travis](https://img.shields.io/travis/rinvex/country.svg?label=TravisCI&style=flat-square)](https://travis-ci.org/rinvex/country)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/f2dca242-eb65-4bcc-8481-cd27ea16c804.svg?label=SensioLabs&style=flat-square)](https://insight.sensiolabs.com/projects/f2dca242-eb65-4bcc-8481-cd27ea16c804)
[![StyleCI](https://styleci.io/repos/66037019/shield)](https://styleci.io/repos/66037019)
[![License](https://img.shields.io/packagist/l/rinvex/country.svg?label=License&style=flat-square)](https://github.com/rinvex/country/blob/develop/LICENSE)


## Usage

Install via `composer require rinvex/country`, then use as follows:
```php
use Rinvex\Country\Loader;

// Find a country by it's ISO 3166-1 alpha-2 (full country details)
$egypt = country('eg'); // OR
$egypt = Loader::country('eg');

// Find all countries as array (short-listed, common country details)
$countries = countries(); // OR
$countries = Loader::countries();
```

> **Note:** This package is framework-agnostic, so it's compatible with any PHP framework whatsoever without any dependencies at all, except for the PHP version itself **>=5.5.9**. Awesome, huh? :smiley:


## Table Of Contents

- [Country Object](#country-object)
- [Country Details](#country-details)
- [Features Explained](#features-explained)
- [Data Sources](#data-sources)
- [Changelog](#changelog)
- [Support](#support)
- [Contributing & Protocols](#contributing--protocols)
- [Security Vulnerabilities](#security-vulnerabilities)
- [About Rinvex](#about-rinvex)
- [License](#license)


## Country Object

Get country attributes (self-descriptive):
```php
$egypt = country('eg');

$egypt->getName(); // Egypt
$egypt->getOfficialName(); // Arab Republic of Egypt
$egypt->getNativeName(); // مصر
$egypt->getNativeOfficialName(); // جمهورية مصر العربية
$egypt->getNativeNames(); // {"ara":{"official":"جمهورية مصر العربية","common":"مصر"}}
$egypt->getDemonym(); // Egyptian
$egypt->getCapital(); // Cairo
$egypt->getIsoAlpha2(); // EG
$egypt->getIsoAlpha3(); // EGY
$egypt->getIsoNumeric(); // 818
$egypt->getCurrency(); // {"iso_4217_code":"EGP","iso_4217_numeric":818,"iso_4217_name":"Egyptian Pound","iso_4217_minor_unit":2}
$egypt->getCurrencies(); // {"EGP":{"iso_4217_code":"EGP","iso_4217_numeric":818,"iso_4217_name":"Egyptian Pound","iso_4217_minor_unit":2}}
$egypt->getTld(); // .eg
$egypt->getTlds(); // [".eg",".مصر"]
$egypt->getAltSpellings(); // ["EG","Arab Republic of Egypt"]
$egypt->getLanguage(); // Arabic
$egypt->getLanguages(); // {"ara":"Arabic"}
$egypt->getTranslation(); // {"official":"جمهورية مصر العربية","common":"مصر"}
$egypt->getTranslations(); // {"ara":{"official":"جمهورية مصر العربية","common":"مصر"},"cym":{"official":"Arab Republic of Egypt","common":"Yr Aifft"},"deu":{"official":"Arabische Republik Ägypten","common":"Ägypten"},"fra":{"official":"République arabe d'Égypte","common":"Égypte"},"hrv":{"official":"Arapska Republika Egipat","common":"Egipat"},"ita":{"official":"Repubblica araba d'Egitto","common":"Egitto"},"jpn":{"official":"エジプト·アラブ共和国","common":"エジプト"},"nld":{"official":"Arabische Republiek Egypte","common":"Egypte"},"por":{"official":"República Árabe do Egipto","common":"Egito"},"rus":{"official":"Арабская Республика Египет","common":"Египет"},"spa":{"official":"República Árabe de Egipto","common":"Egipto"},"fin":{"official":"Egyptin arabitasavalta","common":"Egypti"}}
$egypt->getGeodata(); // {"continent":{"AF":"Africa"},"postal_code":true,"latitude":"27 00 N","latitude_dec":"26.756103515625","longitude":"30 00 E","longitude_dec":"29.86229705810547","max_latitude":"31.916667","max_longitude":"36.333333","min_latitude":"20.383333","min_longitude":"24.7","area":1002450,"region":"Africa","subregion":"Northern Africa","world_region":"EMEA","region_code":"002","subregion_code":"015","landlocked":false,"borders":["ISR","LBY","SDN"],"independent":"Yes"}
$egypt->getContinent(); // Africa
$egypt->usesPostalCode(); // true
$egypt->getLatitude(); // 27 00 N
$egypt->getLongitude(); // 30 00 E
$egypt->getLatitudeDesc(); // 26.756103515625
$egypt->getLongitudeDesc(); // 29.86229705810547
$egypt->getMaxLatitude(); // 31.916667
$egypt->getMaxLongitude(); // 36.333333
$egypt->getMinLatitude(); // 20.383333
$egypt->getMinLongitude(); // 24.7
$egypt->getArea(); // 1002450
$egypt->getRegion(); // Africa
$egypt->getSubregion(); // Northern Africa
$egypt->getWorldRegion(); // EMEA
$egypt->getRegionCode(); // 002
$egypt->getSubregionCode(); // 015
$egypt->isLandlocked(); // false
$egypt->getBorders(); // ["ISR","LBY","SDN"]
$egypt->isIndependent(); // Yes
$egypt->getCallingCode(); // 20
$egypt->getCallingCodes(); // ["20"]
$egypt->getNationalPrefix(); // 0
$egypt->getNationalNumberLength(); // 9
$egypt->getNationalNumberLengths(); // [9]
$egypt->getNationalDestinationCodeLength(); // 2
$egypt->getnationaldestinationcodelengths(); // [2]
$egypt->getInternationalPrefix(); // "00"
$egypt->getExtra(); // {"geonameid":357994,"edgar":"H2","itu":"EGY","marc":"ua","wmo":"EG","ds":"ET","fifa":"EGY","fips":"EG","gaul":40765,"ioc":"EGY","cowc":"EGY","cown":651,"fao":59,"imf":469,"ar5":"MAF","address_format":"{{recipient}}\n{{street}}\n{{postalcode}} {{city}}\n{{country}}","eu_member":null,"vat_rates":null,"emoji":"🇪🇬"}
$egypt->getGeonameid(); // 357994
$egypt->getEdgar(); // H2
$egypt->getItu(); // EGY
$egypt->getMarc(); // ua
$egypt->getWmo(); // EG
$egypt->getDs(); // ET
$egypt->getFifa(); // EGY
$egypt->getFips(); // EG
$egypt->getGaul(); // 40765
$egypt->getIoc(); // EGY
$egypt->getCowc(); // EGY
$egypt->getCown(); // 651
$egypt->getFao(); // 59
$egypt->getImf(); // 469
$egypt->getAr5(); // MAF
$egypt->getAddressFormat(); // {{recipient}}\n{{street}}\n{{postalcode}} {{city}}\n{{country}}
$egypt->isEuMember(); // null
$egypt->getVatRates(); // null
$egypt->getEmoji(); // 🇪🇬
$egypt->getGeoJson(); // GeoJson data returned as string
$egypt->getFlag(); // SVG data returned as string
$egypt->getDivisions(); // Divisions returned as array
$egypt->getDivision("ALX"); // {"name":"Al Iskandariyah","alt_names":["El Iskandariya","al-Iskandariyah","al-Iskandarīyah","Alexandria","Alexandrie","Alexandria"],"geo":{"latitude":31.2000924,"longitude":29.9187387,"min_latitude":31.1173177,"min_longitude":29.8233701,"max_latitude":31.330904,"max_longitude":30.0864016}}
```

> **Note:** When retrieving single country, you'll get the full country details just like the previous example. But when retrieving all countries, you'll get a short-listed result set with common country details for better performance.


## Country Details

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
            "latitude_desc": "26.756103515625",
            "longitude": "30 00 E",
            "longitude_desc": "29.86229705810547",
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
            "emoji": "🇪🇬"
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
    - `address_format` - Address forma
    - `eu_member` - European Union Member
    - `vat_rates` - Value-Added Tax
    - `emoji` - Emoji Flag


## Data Sources

- Currency Data (27th Sep, 2016): http://www.currency-iso.org
- Emoji Flags (27th Sep, 2016): http://unicode.org/emoji/charts/full-emoji-list.html
- World Borders (27th Sep, 2016): http://thematicmapping.org/downloads/world_borders.php
- GeoJson & SVG Flags (27th Sep, 2016): https://github.com/mledoze/countries/tree/master/data
- Main Country Data, Regions, and Subdivisions (27th Sep, 2016): https://github.com/hexorx/countries
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
