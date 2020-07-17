<?php

declare(strict_types=1);

namespace Rinvex\Country\Tests\Unit;

use Exception;
use Rinvex\Country\Country;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    /** @var array */
    protected $shortAttributes;

    /** @var array */
    protected $longAttributes;

    /** @var \Rinvex\Country\Country */
    protected $shortCountry;

    /** @var \Rinvex\Country\Country */
    protected $longCountry;

    protected function setUp(): void
    {
        parent::setUp();

        $this->shortAttributes = [
            'name' => 'Egypt',
            'official_name' => 'Arab Republic of Egypt',
            'native_name' => 'مصر',
            'native_official_name' => 'جمهورية مصر العربية',
            'iso_3166_1_alpha2' => 'EG',
            'iso_3166_1_alpha3' => 'EGY',
            'calling_code' => ['20'],
            'emoji' => '🇪🇬',
        ];

        $this->longAttributes = [
            'name' => [
                'common' => 'Egypt',
                'official' => 'Arab Republic of Egypt',
                'native' => [
                    'ara' => [
                        'common' => 'مصر',
                        'official' => 'جمهورية مصر العربية',
                    ],
                ],
            ],
            'demonym' => 'Egyptian',
            'capital' => 'Cairo',
            'iso_3166_1_alpha2' => 'EG',
            'iso_3166_1_alpha3' => 'EGY',
            'iso_3166_1_numeric' => '818',
            'currency' => [
                'EGP' => [
                    'iso_4217_code' => 'EGP',
                    'iso_4217_numeric' => 818,
                    'iso_4217_name' => 'Egyptian Pound',
                    'iso_4217_minor_unit' => 2,
                ],
            ],
            'tld' => [
                '.eg',
                '.مصر',
            ],
            'alt_spellings' => [
                'EG',
                'Arab Republic of Egypt',
            ],
            'languages' => [
                'ara' => 'Arabic',
            ],
            'geo' => [
                'continent' => [
                    'AF' => 'Africa',
                ],
                'postal_code' => true,
                'latitude' => '27 00 N',
                'latitude_desc' => '26.756103515625',
                'longitude' => '30 00 E',
                'longitude_desc' => '29.86229705810547',
                'max_latitude' => '31.916667',
                'max_longitude' => '36.333333',
                'min_latitude' => '20.383333',
                'min_longitude' => '24.7',
                'area' => 1002450,
                'region' => 'Africa',
                'subregion' => 'Northern Africa',
                'world_region' => 'EMEA',
                'region_code' => '002',
                'subregion_code' => '015',
                'landlocked' => false,
                'borders' => [
                    'ISR',
                    'LBY',
                    'SDN',
                ],
                'independent' => 'Yes',
            ],
            'dialling' => [
                'calling_code' => [
                    '20',
                ],
                'national_prefix' => '0',
                'national_number_lengths' => [
                    9,
                ],
                'national_destination_code_lengths' => [
                    2,
                ],
                'international_prefix' => '00',
            ],
            'extra' => [
                'geonameid' => 357994,
                'edgar' => 'H2',
                'itu' => 'EGY',
                'marc' => 'ua',
                'wmo' => 'EG',
                'ds' => 'ET',
                'fifa' => 'EGY',
                'fips' => 'EG',
                'gaul' => 40765,
                'ioc' => 'EGY',
                'cowc' => 'EGY',
                'cown' => 651,
                'fao' => 59,
                'imf' => 469,
                'ar5' => 'MAF',
                'address_format' => '{{recipient}}\n{{street}}\n{{postalcode}} {{city}}\n{{country}}',
                'eu_member' => null,
                'vat_rates' => null,
                'emoji' => '🇪🇬',
            ],
            'divisions' => [
                'ALX' => [
                    'name' => 'Al Iskandariyah',
                    'alt_names' => [
                        'El Iskandariya',
                        'al-Iskandariyah',
                        'al-Iskandarīyah',
                        'Alexandria',
                        'Alexandrie',
                        'Alexandria',
                    ],
                    'geo' => [
                        'latitude' => 31.2000924,
                        'longitude' => 29.9187387,
                        'min_latitude' => 31.1173177,
                        'min_longitude' => 29.8233701,
                        'max_latitude' => 31.330904,
                        'max_longitude' => 30.0864016,
                    ],
                ],
            ],
        ];

        $this->shortCountry = new Country($this->shortAttributes);
        $this->longCountry = new Country($this->longAttributes);
    }

    /** @test */
    public function it_throws_an_exception_when_missing_mandatory_attributes()
    {
        $this->expectException(Exception::class);

        new Country([]);
    }

    /** @test */
    public function it_sets_attributes_once_instantiated()
    {
        $this->assertEquals($this->shortAttributes['name'], $this->shortCountry->getName());
        $this->assertEquals($this->shortAttributes['official_name'], $this->shortCountry->getOfficialName());
        $this->assertEquals($this->shortAttributes['native_name'], $this->shortCountry->getNativeName());
        $this->assertEquals($this->shortAttributes['native_official_name'], $this->shortCountry->getNativeOfficialName());
        $this->assertEquals('EG', $this->shortCountry->getIsoAlpha2());
        $this->assertEquals('EGY', $this->shortCountry->getIsoAlpha3());
    }

    /** @test */
    public function it_gets_attributes()
    {
        $this->assertEquals($this->shortAttributes, $this->shortCountry->getAttributes());
    }

    /** @test */
    public function it_sets_attributes()
    {
        $this->shortCountry->setAttributes(['capital' => 'Cairo']);

        $this->assertEquals('Cairo', $this->shortCountry->getCapital());
    }

    /** @test */
    public function it_gets_dotted_attribute()
    {
        $this->assertEquals($this->shortAttributes['calling_code'], $this->shortCountry->get('calling_code'));
        $this->assertEquals($this->longAttributes['name']['native']['ara']['common'], $this->longCountry->get('name.native.ara.common'));
    }

    /** @test */
    public function it_gets_default_when_missing_value()
    {
        $this->assertEquals('default', $this->shortCountry->get('unknown', 'default'));
    }

    /** @test */
    public function it_gets_all_attributes_when_missing_key()
    {
        $this->assertEquals($this->shortAttributes, $this->shortCountry->get(null));
    }

    /** @test */
    public function it_sets_attribute()
    {
        $this->shortCountry->set('capital', 'Cairo');

        $this->assertEquals('Cairo', $this->shortCountry->getCapital());
    }

    /** @test */
    public function its_fluently_chainable_when_sets_attributes()
    {
        $this->assertEquals($this->shortCountry, $this->shortCountry->setAttributes([]));
    }

    /** @test */
    public function it_returns_name_from_longlist()
    {
        $this->assertEquals($this->longAttributes['name']['common'], $this->longCountry->getName());
    }

    /** @test */
    public function it_returns_name_from_shortlist()
    {
        $this->assertEquals($this->shortAttributes['name'], $this->shortCountry->getName());
    }

    /** @test */
    public function it_returns_null_when_missing_name()
    {
        $this->shortCountry->setAttributes([]);

        $this->assertNull($this->shortCountry->getName());
    }

    /** @test */
    public function it_returns_official_name_from_longlist()
    {
        $this->assertEquals($this->longAttributes['name']['official'], $this->longCountry->getOfficialName());
    }

    /** @test */
    public function it_returns_official_name_from_shortlist()
    {
        $this->assertEquals($this->shortAttributes['official_name'], $this->shortCountry->getOfficialName());
    }

    /** @test */
    public function it_returns_null_when_missing_official_name()
    {
        $this->shortCountry->setAttributes([]);

        $this->assertNull($this->shortCountry->getOfficialName());
    }

    /** @test */
    public function it_returns_native_name_from_longlist()
    {
        $this->assertEquals($this->longAttributes['name']['native']['ara']['common'], $this->longCountry->getNativeName());
    }

    /** @test */
    public function it_returns_native_name_from_shortlist()
    {
        $this->assertEquals($this->shortAttributes['native_name'], $this->shortCountry->getNativeName());
    }

    /** @test */
    public function it_returns_null_when_missing_native_name()
    {
        $this->shortCountry->setAttributes([]);

        $this->assertNull($this->shortCountry->getNativeName());
    }

    /** @test */
    public function it_returns_native_official_name_from_longlist()
    {
        $this->assertEquals($this->longAttributes['name']['native']['ara']['official'], $this->longCountry->getNativeOfficialName());
    }

    /** @test */
    public function it_returns_native_official_name_from_shortlist()
    {
        $this->assertEquals($this->shortAttributes['native_official_name'], $this->shortCountry->getNativeOfficialName());
    }

    /** @test */
    public function it_returns_null_when_missing_native_official_name()
    {
        $this->shortCountry->setAttributes([]);

        $this->assertNull($this->shortCountry->getNativeOfficialName());
    }

    /** @test */
    public function it_returns_array_of_native_names_from_longlist()
    {
        $this->assertNotEmpty($this->longCountry->getNativeNames());
        $this->assertEquals(current($this->longAttributes['name']['native']), current($this->longCountry->getNativeNames()));
    }

    /** @test */
    public function it_returns_null_when_missing_native_names()
    {
        $this->shortCountry->setAttributes([]);

        $this->assertNull($this->shortCountry->getNativeNames());
    }

    /** @test */
    public function it_returns_demonym()
    {
        $this->assertEquals($this->longAttributes['demonym'], $this->longCountry->getDemonym());
    }

    /** @test */
    public function it_returns_null_when_missing_demonym()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getDemonym());
    }

    /** @test */
    public function it_returns_capital()
    {
        $this->assertEquals($this->longAttributes['capital'], $this->longCountry->getCapital());
    }

    /** @test */
    public function it_returns_null_when_missing_capital()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getCapital());
    }

    /** @test */
    public function it_returns_isoalpha2()
    {
        $this->assertEquals($this->longAttributes['iso_3166_1_alpha2'], $this->longCountry->getIsoAlpha2());
    }

    /** @test */
    public function it_returns_null_when_missing_isoalpha2()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getIsoAlpha2());
    }

    /** @test */
    public function it_returns_isoalpha3()
    {
        $this->assertEquals($this->longAttributes['iso_3166_1_alpha3'], $this->longCountry->getIsoAlpha3());
    }

    /** @test */
    public function it_returns_null_when_missing_isoalpha3()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getIsoAlpha3());
    }

    /** @test */
    public function it_returns_isonumeric()
    {
        $this->assertEquals($this->longAttributes['iso_3166_1_numeric'], $this->longCountry->getIsoNumeric());
    }

    /** @test */
    public function it_returns_null_when_missing_isonumeric()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getIsoNumeric());
    }

    /** @test */
    public function it_returns_currency()
    {
        $this->assertEquals($this->longAttributes['currency']['EGP'], $this->longCountry->getCurrency());
    }

    /** @test */
    public function it_returns_first_currency_when_missing_requested_currency()
    {
        $this->assertEquals($this->longAttributes['currency']['EGP'], $this->longCountry->getCurrency('USD'));
    }

    /** @test */
    public function it_returns_null_when_missing_currency()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getCurrency());
    }

    /** @test */
    public function it_returns_currencies()
    {
        $this->assertEquals($this->longAttributes['currency'], $this->longCountry->getCurrencies());
    }

    /** @test */
    public function it_returns_null_when_missing_currencies()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getCurrencies());
    }

    /** @test */
    public function it_returns_tld()
    {
        $this->assertEquals(current($this->longAttributes['tld']), $this->longCountry->getTld());
    }

    /** @test */
    public function it_returns_null_when_missing_tld()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getTld());
    }

    /** @test */
    public function it_returns_tlds()
    {
        $this->assertEquals($this->longAttributes['tld'], $this->longCountry->getTlds());
    }

    /** @test */
    public function it_returns_null_when_missing_tlds()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getTlds());
    }

    /** @test */
    public function it_returns_altspellings()
    {
        $this->assertEquals($this->longAttributes['alt_spellings'], $this->longCountry->getAltSpellings());
    }

    /** @test */
    public function it_returns_null_when_missing_altspellings()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getAltSpellings());
    }

    /** @test */
    public function it_returns_language()
    {
        $this->assertEquals($this->longAttributes['languages']['ara'], $this->longCountry->getLanguage());
    }

    /** @test */
    public function it_returns_first_currency_when_missing_requested_language()
    {
        $this->assertEquals($this->longAttributes['languages']['ara'], $this->longCountry->getLanguage('eng'));
    }

    /** @test */
    public function it_returns_null_when_missing_language()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getLanguage());
    }

    /** @test */
    public function it_returns_languages()
    {
        $this->assertEquals($this->longAttributes['languages'], $this->longCountry->getLanguages());
    }

    /** @test */
    public function it_returns_null_when_missing_languages()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getLanguages());
    }

    /** @test */
    public function it_returns_translation()
    {
        $this->assertEquals($this->longAttributes['name']['native']['ara'], $this->longCountry->getTranslation());
    }

    /** @test */
    public function it_returns_first_translation_when_missing_requested_translation()
    {
        $this->assertEquals($this->longAttributes['name']['native']['ara'], $this->longCountry->getTranslation('ara'));
    }

    /** @test */
    public function it_returns_translations()
    {
        $this->assertEquals($this->longAttributes['name']['native']['ara'], $this->longCountry->getTranslations()['ara']);
    }

    /** @test */
    public function it_returns_first_translation_when_missing_requested_translations()
    {
        $this->assertEquals($this->longAttributes['name']['native']['ara'], $this->longCountry->getTranslation('ara'));
    }

    /** @test */
    public function it_returns_geodata()
    {
        $this->assertEquals($this->longAttributes['geo'], $this->longCountry->getGeodata());
    }

    /** @test */
    public function it_returns_null_when_missing_geodata()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getGeodata());
    }

    /** @test */
    public function it_returns_continent()
    {
        $this->assertEquals(current($this->longAttributes['geo']['continent']), $this->longCountry->getContinent());
    }

    /** @test */
    public function it_returns_null_when_missing_continent()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getContinent());
    }

    /** @test */
    public function it_returns_postal_code()
    {
        $this->assertEquals($this->longAttributes['geo']['postal_code'], $this->longCountry->usesPostalCode());
    }

    /** @test */
    public function it_returns_null_when_missing_postal_code()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->usesPostalCode());
    }

    /** @test */
    public function it_returns_latitude()
    {
        $this->assertEquals($this->longAttributes['geo']['latitude'], $this->longCountry->getLatitude());
    }

    /** @test */
    public function it_returns_null_when_missing_latitude()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getLatitude());
    }

    /** @test */
    public function it_returns_latitude_desc()
    {
        $this->assertEquals($this->longAttributes['geo']['latitude_desc'], $this->longCountry->getLatitudeDesc());
    }

    /** @test */
    public function it_returns_null_when_missing_latitude_desc()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getLatitudeDesc());
    }

    /** @test */
    public function it_returns_max_latitude()
    {
        $this->assertEquals($this->longAttributes['geo']['max_latitude'], $this->longCountry->getMaxLatitude());
    }

    /** @test */
    public function it_returns_null_when_missing_lmax_latitude()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getMaxLatitude());
    }

    /** @test */
    public function it_returns_longitude()
    {
        $this->assertEquals($this->longAttributes['geo']['longitude'], $this->longCountry->getLongitude());
    }

    /** @test */
    public function it_returns_null_when_missing_longitude()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getLongitude());
    }

    /** @test */
    public function it_returns_longitude_desc()
    {
        $this->assertEquals($this->longAttributes['geo']['longitude_desc'], $this->longCountry->getLongitudeDesc());
    }

    /** @test */
    public function it_returns_null_when_missing_longitude_desc()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getLongitudeDesc());
    }

    /** @test */
    public function it_returns_max_longitude()
    {
        $this->assertEquals($this->longAttributes['geo']['max_longitude'], $this->longCountry->getMaxLongitude());
    }

    /** @test */
    public function it_returns_null_when_missing_max_longitude()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getMaxLongitude());
    }

    /** @test */
    public function it_returns_min_longitude()
    {
        $this->assertEquals($this->longAttributes['geo']['min_longitude'], $this->longCountry->getMinLongitude());
    }

    /** @test */
    public function it_returns_null_when_missing_min_longitude()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getMinLongitude());
    }

    /** @test */
    public function it_returns_min_latitude()
    {
        $this->assertEquals($this->longAttributes['geo']['min_latitude'], $this->longCountry->getMinLatitude());
    }

    /** @test */
    public function it_returns_null_when_missing_min_latitude()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getMinLatitude());
    }

    /** @test */
    public function it_returns_area()
    {
        $this->assertEquals($this->longAttributes['geo']['area'], $this->longCountry->getArea());
    }

    /** @test */
    public function it_returns_null_when_missing_area()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getArea());
    }

    /** @test */
    public function it_returns_region()
    {
        $this->assertEquals($this->longAttributes['geo']['region'], $this->longCountry->getRegion());
    }

    /** @test */
    public function it_returns_null_when_missing_region()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getRegion());
    }

    /** @test */
    public function it_returns_subregion()
    {
        $this->assertEquals($this->longAttributes['geo']['subregion'], $this->longCountry->getSubregion());
    }

    /** @test */
    public function it_returns_null_when_missing_subregion()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getSubregion());
    }

    /** @test */
    public function it_returns_world_region()
    {
        $this->assertEquals($this->longAttributes['geo']['world_region'], $this->longCountry->getWorldRegion());
    }

    /** @test */
    public function it_returns_null_when_missing_world_region()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getWorldRegion());
    }

    /** @test */
    public function it_returns_region_code()
    {
        $this->assertEquals($this->longAttributes['geo']['region_code'], $this->longCountry->getRegionCode());
    }

    /** @test */
    public function it_returns_null_when_missing_region_code()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getRegionCode());
    }

    /** @test */
    public function it_returns_subregion_code()
    {
        $this->assertEquals($this->longAttributes['geo']['subregion_code'], $this->longCountry->getSubregionCode());
    }

    /** @test */
    public function it_returns_null_when_missing_subregion_code()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getSubregionCode());
    }

    /** @test */
    public function it_returns_landlocked_status()
    {
        $this->assertEquals($this->longAttributes['geo']['landlocked'], $this->longCountry->isLandlocked());
    }

    /** @test */
    public function it_returns_null_when_missing_landlocked_status()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->isLandlocked());
    }

    /** @test */
    public function it_returns_borders()
    {
        $this->assertEquals($this->longAttributes['geo']['borders'], $this->longCountry->getBorders());
    }

    /** @test */
    public function it_returns_null_when_missing_borders()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getBorders());
    }

    /** @test */
    public function it_returns_independent_status()
    {
        $this->assertEquals($this->longAttributes['geo']['independent'], $this->longCountry->isIndependent());
    }

    /** @test */
    public function it_returns_null_when_missing_independent_status()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->isIndependent());
    }

    /** @test */
    public function it_returns_calling_code_from_longlist()
    {
        $this->assertEquals(current($this->longAttributes['dialling']['calling_code']), $this->longCountry->getCallingCode());
    }

    /** @test */
    public function it_returns_calling_code_from_shortlist()
    {
        $this->assertEquals(current($this->shortAttributes['calling_code']), $this->shortCountry->getCallingCode());
    }

    /** @test */
    public function it_returns_null_when_missing_calling_code()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getCallingCode());
    }

    /** @test */
    public function it_returns_calling_codes()
    {
        $this->assertEquals($this->longAttributes['dialling']['calling_code'], $this->longCountry->getCallingCodes());
    }

    /** @test */
    public function it_returns_null_when_missing_calling_codes()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getCallingCodes());
    }

    /** @test */
    public function it_returns_national_prefix()
    {
        $this->assertEquals($this->longAttributes['dialling']['national_prefix'], $this->longCountry->getNationalPrefix());
    }

    /** @test */
    public function it_returns_null_when_missing_national_prefix()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getNationalPrefix());
    }

    /** @test */
    public function it_returns_national_number_length()
    {
        $this->assertEquals(current($this->longAttributes['dialling']['national_number_lengths']), $this->longCountry->getNationalNumberLength());
    }

    /** @test */
    public function it_returns_null_when_missing_national_number_length()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getNationalNumberLength());
    }

    /** @test */
    public function it_returns_national_number_lengths()
    {
        $this->assertEquals($this->longAttributes['dialling']['national_number_lengths'], $this->longCountry->getNationalNumberLengths());
    }

    /** @test */
    public function it_returns_null_when_missing_national_number_lengths()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getNationalNumberLengths());
    }

    /** @test */
    public function it_returns_national_destination_code_length()
    {
        $this->assertEquals(current($this->longAttributes['dialling']['national_destination_code_lengths']), $this->longCountry->getNationalDestinationCodeLength());
    }

    /** @test */
    public function it_returns_null_when_missing_national_destination_code_length()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getNationalDestinationCodeLength());
    }

    /** @test */
    public function it_returns_national_destination_code_lengths()
    {
        $this->assertEquals($this->longAttributes['dialling']['national_destination_code_lengths'], $this->longCountry->getNationalDestinationCodeLengths());
    }

    /** @test */
    public function it_returns_null_when_missing_national_destination_code_lengths()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getNationalDestinationCodeLengths());
    }

    /** @test */
    public function it_returns_international_prefix()
    {
        $this->assertEquals($this->longAttributes['dialling']['international_prefix'], $this->longCountry->getInternationalPrefix());
    }

    /** @test */
    public function it_returns_null_when_missing_international_prefix()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getInternationalPrefix());
    }

    /** @test */
    public function it_returns_extra()
    {
        $this->assertEquals($this->longAttributes['extra'], $this->longCountry->getExtra());
    }

    /** @test */
    public function it_returns_null_when_missing_extra()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getExtra());
    }

    /** @test */
    public function it_returns_geonameid()
    {
        $this->assertEquals($this->longAttributes['extra']['geonameid'], $this->longCountry->getGeonameid());
    }

    /** @test */
    public function it_returns_null_when_missing_geonameid()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getGeonameid());
    }

    /** @test */
    public function it_returns_edgar()
    {
        $this->assertEquals($this->longAttributes['extra']['edgar'], $this->longCountry->getEdgar());
    }

    /** @test */
    public function it_returns_null_when_missing_edgar()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getEdgar());
    }

    /** @test */
    public function it_returns_itu()
    {
        $this->assertEquals($this->longAttributes['extra']['itu'], $this->longCountry->getItu());
    }

    /** @test */
    public function it_returns_null_when_missing_itu()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getItu());
    }

    /** @test */
    public function it_returns_marc()
    {
        $this->assertEquals($this->longAttributes['extra']['marc'], $this->longCountry->getMarc());
    }

    /** @test */
    public function it_returns_null_when_missing_marc()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getMarc());
    }

    /** @test */
    public function it_returns_wmo()
    {
        $this->assertEquals($this->longAttributes['extra']['wmo'], $this->longCountry->getWmo());
    }

    /** @test */
    public function it_returns_null_when_missing_wmo()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getWmo());
    }

    /** @test */
    public function it_returns_ds()
    {
        $this->assertEquals($this->longAttributes['extra']['ds'], $this->longCountry->getDs());
    }

    /** @test */
    public function it_returns_null_when_missing_ds()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getDs());
    }

    /** @test */
    public function it_returns_fifa()
    {
        $this->assertEquals($this->longAttributes['extra']['fifa'], $this->longCountry->getFifa());
    }

    /** @test */
    public function it_returns_null_when_missing_fifa()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getFifa());
    }

    /** @test */
    public function it_returns_fips()
    {
        $this->assertEquals($this->longAttributes['extra']['fips'], $this->longCountry->getFips());
    }

    /** @test */
    public function it_returns_null_when_missing_fips()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getFips());
    }

    /** @test */
    public function it_returns_gaul()
    {
        $this->assertEquals($this->longAttributes['extra']['gaul'], $this->longCountry->getGaul());
    }

    /** @test */
    public function it_returns_null_when_missing_gaul()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getGaul());
    }

    /** @test */
    public function it_returns_ioc()
    {
        $this->assertEquals($this->longAttributes['extra']['ioc'], $this->longCountry->getIoc());
    }

    /** @test */
    public function it_returns_null_when_missing_ioc()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getIoc());
    }

    /** @test */
    public function it_returns_cowc()
    {
        $this->assertEquals($this->longAttributes['extra']['cowc'], $this->longCountry->getCowc());
    }

    /** @test */
    public function it_returns_null_when_missing_cowc()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getCowc());
    }

    /** @test */
    public function it_returns_cown()
    {
        $this->assertEquals($this->longAttributes['extra']['cown'], $this->longCountry->getCown());
    }

    /** @test */
    public function it_returns_null_when_missing_cown()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getCown());
    }

    /** @test */
    public function it_returns_fao()
    {
        $this->assertEquals($this->longAttributes['extra']['fao'], $this->longCountry->getFao());
    }

    /** @test */
    public function it_returns_null_when_missing_fao()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getFao());
    }

    /** @test */
    public function it_returns_imf()
    {
        $this->assertEquals($this->longAttributes['extra']['imf'], $this->longCountry->getImf());
    }

    /** @test */
    public function it_returns_null_when_missing_imf()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getImf());
    }

    /** @test */
    public function it_returns_ar5()
    {
        $this->assertEquals($this->longAttributes['extra']['ar5'], $this->longCountry->getAr5());
    }

    /** @test */
    public function it_returns_null_when_missing_ar5()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getAr5());
    }

    /** @test */
    public function it_returns_address_format()
    {
        $this->assertEquals($this->longAttributes['extra']['address_format'], $this->longCountry->getAddressFormat());
    }

    /** @test */
    public function it_returns_null_when_missing_address_format()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getAddressFormat());
    }

    /** @test */
    public function it_returns_whether_eu_member()
    {
        $this->assertEquals($this->longAttributes['extra']['eu_member'], $this->longCountry->isEuMember());
    }

    /** @test */
    public function it_returns_null_when_missing_eu_member_status()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->isEuMember());
    }

    /** @test */
    public function it_returns_vat_rates()
    {
        $this->assertEquals($this->longAttributes['extra']['vat_rates'], $this->longCountry->getVatRates());
    }

    /** @test */
    public function it_returns_null_when_missing_vat_rates()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getVatRates());
    }

    /** @test */
    public function it_returns_emoji_from_longlist()
    {
        $this->assertEquals($this->longAttributes['extra']['emoji'], $this->longCountry->getEmoji());
    }

    /** @test */
    public function it_returns_emoji_from_shortlist()
    {
        $this->assertEquals($this->shortAttributes['emoji'], $this->shortCountry->getEmoji());
    }

    /** @test */
    public function it_returns_null_when_missing_emoji()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getEmoji());
    }

    /** @test */
    public function it_returns_geojson()
    {
        $file = __DIR__.'/../../resources/geodata/'.mb_strtolower($this->longCountry->getIsoAlpha2()).'.json';

        $this->assertEquals(file_get_contents($file), $this->longCountry->getGeoJson());
    }

    /** @test */
    public function it_returns_null_when_missing_geojson()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getGeoJson());
    }

    /** @test */
    public function it_returns_flag()
    {
        $file = __DIR__.'/../../resources/flags/'.mb_strtolower($this->longCountry->getIsoAlpha2()).'.svg';

        $this->assertEquals(file_get_contents($file), $this->longCountry->getFlag());
    }

    /** @test */
    public function it_returns_null_when_missing_flag()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getFlag());
    }

    /** @test */
    public function it_returns_divisions()
    {
        $file = __DIR__.'/../../resources/divisions/'.mb_strtolower($this->longCountry->getIsoAlpha2()).'.json';

        $this->assertEquals(json_decode(file_get_contents($file), true), $this->longCountry->getDivisions());
    }

    /** @test */
    public function it_returns_null_when_missing_divisions()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getDivisions());
    }

    /** @test */
    public function it_returns_division()
    {
        $this->assertEquals($this->longAttributes['divisions']['ALX'], $this->longCountry->getDivision('ALX'));
    }

    /** @test */
    public function it_returns_null_when_missing_division()
    {
        $this->longCountry->setAttributes([]);

        $this->assertNull($this->longCountry->getDivisions());
    }

    /** @test */
    public function it_returns_timezones()
    {
        $this->assertEquals(['Africa/Cairo'], $this->shortCountry->getTimezones());
    }

    /** @test */
    public function it_returns_null_when_missing_timezones()
    {
        $this->shortCountry->setAttributes([]);

        $this->assertNull($this->shortCountry->getTimezones());
    }

    /** @test */
    public function it_returns_locales()
    {
        $this->assertEquals(['ar_EG'], $this->shortCountry->getLocales());
    }

    /** @test */
    public function it_returns_null_when_missing_locales()
    {
        $this->shortCountry->setAttributes([]);

        $this->assertNull($this->shortCountry->getLocales());
    }
}
