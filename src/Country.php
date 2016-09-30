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

use Exception;

class Country
{
    /**
     * The attributes array.
     *
     * @var array
     */
    protected $attributes;

    /**
     * Create a new Country instance.
     *
     * @param array $attributes
     *
     * @throws \Exception
     *
     * @return void
     */
    public function __construct($attributes)
    {
        // Set the attributes
        $this->setAttributes($attributes);

        // Check required mandatory attributes
        if (! $this->getName() || ! $this->getOfficialName()
            || ! $this->getNativeName() || ! $this->getNativeOfficialName()
            || ! $this->getIsoAlpha2() || ! $this->getIsoAlpha3()) {
            throw new Exception('Missing mandatory country attributes!');
        }
    }

    /**
     * Set the attributes.
     *
     * @param array $attributes
     *
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Get the attributes.
     *
     * @return array|null
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Get the common name.
     *
     * @return string|null
     */
    public function getName()
    {
        return isset($this->attributes['name']['common']) ? $this->attributes['name']['common']
            : (isset($this->attributes['name']) ? $this->attributes['name'] : null);
    }

    /**
     * Get the official name.
     *
     * @return string|null
     */
    public function getOfficialName()
    {
        return isset($this->attributes['name']['official']) ? $this->attributes['name']['official']
            : (isset($this->attributes['official_name']) ? $this->attributes['official_name'] : null);
    }

    /**
     * Get the given native name or fallback to first native name.
     *
     * @param string $language
     *
     * @return string|null
     */
    public function getNativeName($language = null)
    {
        $language = $language ? strtolower($language) : null;

        return isset($this->attributes['name']['native'][$language]['common']) ? $this->attributes['name']['native'][$language]['common']
            : (isset($this->attributes['name']['native']) ? current($this->attributes['name']['native'])['common']
                : (isset($this->attributes['native_name']) ? $this->attributes['native_name'] : null));
    }

    /**
     * Get the given native official name or fallback to first native official name.
     *
     * @param string $language
     *
     * @return string|null
     */
    public function getNativeOfficialName($language = null)
    {
        $language = $language ? strtolower($language) : null;

        return isset($this->attributes['name']['native'][$language]['official']) ? $this->attributes['name']['native'][$language]['official']
            : (isset($this->attributes['name']['native']) ? current($this->attributes['name']['native'])['official']
                : (isset($this->attributes['native_official_name']) ? $this->attributes['native_official_name'] : null));
    }

    /**
     * Get the native names.
     *
     * @return array|null
     */
    public function getNativeNames()
    {
        return isset($this->attributes['name']['native']) ? $this->attributes['name']['native'] : null;
    }

    /**
     * Get the demonym.
     *
     * @return string|null
     */
    public function getDemonym()
    {
        return isset($this->attributes['demonym']) ? $this->attributes['demonym'] : null;
    }

    /**
     * Get the capital.
     *
     * @return string|null
     */
    public function getCapital()
    {
        return isset($this->attributes['capital']) ? $this->attributes['capital'] : null;
    }

    /**
     * Get the ISO 3166-1 alpha2.
     *
     * @return string|null
     */
    public function getIsoAlpha2()
    {
        return isset($this->attributes['iso_3166_1_alpha2']) ? $this->attributes['iso_3166_1_alpha2'] : null;
    }

    /**
     * Get the ISO 3166-1 alpha3.
     *
     * @return string|null
     */
    public function getIsoAlpha3()
    {
        return isset($this->attributes['iso_3166_1_alpha3']) ? $this->attributes['iso_3166_1_alpha3'] : null;
    }

    /**
     * Get the ISO 3166-1 numeric.
     *
     * @return string|null
     */
    public function getIsoNumeric()
    {
        return isset($this->attributes['iso_3166_1_numeric']) ? $this->attributes['iso_3166_1_numeric'] : null;
    }

    /**
     * Get the given currency or fallback to first currency.
     *
     * @param string $currency
     *
     * @return string|null
     */
    public function getCurrency($currency = null)
    {
        if (! isset($this->attributes['currency'])) {
            return;
        }

        $currency = $currency ? strtoupper($currency) : null;

        return isset($this->attributes['currency'][$currency]) ? $this->attributes['currency'][$currency]
            : (isset($this->attributes['currency']) ? current($this->attributes['currency']) : null);
    }

    /**
     * Get the currencies.
     *
     * @return array|null
     */
    public function getCurrencies()
    {
        return isset($this->attributes['currency']) ? $this->attributes['currency'] : null;
    }

    /**
     * Get the TLD.
     *
     * @return string|null
     */
    public function getTld()
    {
        return isset($this->attributes['tld']) ? current($this->attributes['tld']) : null;
    }

    /**
     * Get the TLDs.
     *
     * @return string|null
     */
    public function getTlds()
    {
        return isset($this->attributes['tld']) ? $this->attributes['tld'] : null;
    }

    /**
     * Get the alternative spellings.
     *
     * @return string|null
     */
    public function getAltSpellings()
    {
        return isset($this->attributes['alt_spellings']) ? $this->attributes['alt_spellings'] : null;
    }

    /**
     * Get the given language or fallback to first language.
     *
     * @param string $language
     *
     * @return string|null
     */
    public function getLanguage($language = null)
    {
        if (! isset($this->attributes['languages'])) {
            return;
        }

        $language = $language ? strtolower($language) : null;

        return isset($this->attributes['languages'][$language]) ? $this->attributes['languages'][$language]
            : (isset($this->attributes['languages']) ? current($this->attributes['languages']) : null);
    }

    /**
     * Get the languages.
     *
     * @return string|null
     */
    public function getLanguages()
    {
        return isset($this->attributes['languages']) ? $this->attributes['languages'] : null;
    }

    /**
     * Get the translation.
     *
     * @param string $language
     *
     * @return array|null
     */
    public function getTranslation($language = null)
    {
        return ! empty($this->getTranslations()) && isset($this->getTranslations()[$language]) ? $this->getTranslations()[$language] : current($this->getTranslations());
    }

    /**
     * Get the translations.
     *
     * @return array|null
     */
    public function getTranslations()
    {
        // Get english name
        $name = [
            'eng' => [
                'common'   => $this->getName(),
                'official' => $this->getOfficialName(),
            ],
        ];

        // Get native names
        $natives = $this->getNativeNames() ?: [];

        // Get other translations
        $file         = __DIR__.'/../resources/data/'.$this->getIsoAlpha2().'.translations.json';
        $translations = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

        // Merge all names together
        $result = array_merge($translations, $natives, $name);

        // Sort alphabetically
        ksort($result);

        return $result;
    }

    /**
     * Get the geodata.
     *
     * @return array|null
     */
    public function getGeodata()
    {
        return isset($this->attributes['geo']) ? $this->attributes['geo'] : null;
    }

    /**
     * Get the continent.
     *
     * @return string|null
     */
    public function getContinent()
    {
        return isset($this->attributes['geo']['continent']) ? current($this->attributes['geo']['continent']) : null;
    }

    /**
     * Determine whether the country uses postal code.
     *
     * @return bool
     */
    public function usesPostalCode()
    {
        return isset($this->attributes['geo']['postal_code']) ? (bool) $this->attributes['geo']['postal_code'] : null;
    }

    /**
     * Get the latitude.
     *
     * @return string|null
     */
    public function getLatitude()
    {
        return isset($this->attributes['geo']['latitude']) ? $this->attributes['geo']['latitude'] : null;
    }

    /**
     * Get the described latitude.
     *
     * @return string|null
     */
    public function getLatitudeDesc()
    {
        return isset($this->attributes['geo']['latitude_desc']) ? $this->attributes['geo']['latitude_desc'] : null;
    }

    /**
     * Get the maximum latitude.
     *
     * @return string|null
     */
    public function getMaxLatitude()
    {
        return isset($this->attributes['geo']['max_latitude']) ? $this->attributes['geo']['max_latitude'] : null;
    }

    /**
     * Get the maximum longitude.
     *
     * @return string|null
     */
    public function getMaxLongitude()
    {
        return isset($this->attributes['geo']['max_longitude']) ? $this->attributes['geo']['max_longitude'] : null;
    }

    /**
     * Get the minimum latitude.
     *
     * @return string|null
     */
    public function getMinLatitude()
    {
        return isset($this->attributes['geo']['min_latitude']) ? $this->attributes['geo']['min_latitude'] : null;
    }

    /**
     * Get the minimum longitude.
     *
     * @return string|null
     */
    public function getMinLongitude()
    {
        return isset($this->attributes['geo']['min_longitude']) ? $this->attributes['geo']['min_longitude'] : null;
    }

    /**
     * Get the area.
     *
     * @return int|null
     */
    public function getArea()
    {
        return isset($this->attributes['geo']['area']) ? $this->attributes['geo']['area'] : null;
    }

    /**
     * Get the region.
     *
     * @return string|null
     */
    public function getRegion()
    {
        return isset($this->attributes['geo']['region']) ? $this->attributes['geo']['region'] : null;
    }

    /**
     * Get the subregion.
     *
     * @return string|null
     */
    public function getSubregion()
    {
        return isset($this->attributes['geo']['subregion']) ? $this->attributes['geo']['subregion'] : null;
    }

    /**
     * Get the world region.
     *
     * @return string|null
     */
    public function getWorldRegion()
    {
        return isset($this->attributes['geo']['world_region']) ? $this->attributes['geo']['world_region'] : null;
    }

    /**
     * Get the region code.
     *
     * @return string|null
     */
    public function getRegionCode()
    {
        return isset($this->attributes['geo']['region_code']) ? $this->attributes['geo']['region_code'] : null;
    }

    /**
     * Get the subregion code.
     *
     * @return string|null
     */
    public function getSubregionCode()
    {
        return isset($this->attributes['geo']['subregion_code']) ? $this->attributes['geo']['subregion_code'] : null;
    }

    /**
     * Check the landlock status.
     *
     * @return bool
     */
    public function isLandlocked()
    {
        return isset($this->attributes['geo']['landlocked']) ? (bool) $this->attributes['geo']['landlocked'] : null;
    }

    /**
     * Get the borders.
     *
     * @return array|null
     */
    public function getBorders()
    {
        return isset($this->attributes['geo']['borders']) ? $this->attributes['geo']['borders'] : null;
    }

    /**
     * Determine whether the country is independent.
     *
     * @return string|null
     */
    public function isIndependent()
    {
        return isset($this->attributes['geo']['independent']) ? $this->attributes['geo']['independent'] : null;
    }

    /**
     * Get the given calling code or fallback to first calling code.
     *
     * @return string|null
     */
    public function getCallingCode()
    {
        return isset($this->attributes['dialling']['calling_code']) ? current($this->attributes['dialling']['calling_code'])
            : (isset($this->attributes['calling_code']) ? $this->attributes['calling_code'] : null);
    }

    /**
     * Get the calling codes.
     *
     * @return array|null
     */
    public function getCallingCodes()
    {
        return isset($this->attributes['dialling']['calling_code']) ? $this->attributes['dialling']['calling_code'] : null;
    }

    /**
     * Get the national prefix.
     *
     * @return string|null
     */
    public function getNationalPrefix()
    {
        return isset($this->attributes['dialling']['national_prefix']) ? $this->attributes['dialling']['national_prefix'] : null;
    }

    /**
     * Get the national number length.
     *
     * @return int|null
     */
    public function getNationalNumberLength()
    {
        return isset($this->attributes['dialling']['national_number_lengths']) ? current($this->attributes['dialling']['national_number_lengths']) : null;
    }

    /**
     * Get the national number lengths.
     *
     * @return array|null
     */
    public function getNationalNumberLengths()
    {
        return isset($this->attributes['dialling']['national_number_lengths']) ? $this->attributes['dialling']['national_number_lengths'] : null;
    }

    /**
     * Get the national destination code length.
     *
     * @return int|null
     */
    public function getNationalDestinationCodeLength()
    {
        return isset($this->attributes['dialling']['national_destination_code_lengths']) ? current($this->attributes['dialling']['national_destination_code_lengths']) : null;
    }

    /**
     * Get the national destination code lengths.
     *
     * @return array|null
     */
    public function getNationalDestinationCodeLengths()
    {
        return isset($this->attributes['dialling']['national_destination_code_lengths']) ? $this->attributes['dialling']['national_destination_code_lengths'] : null;
    }

    /**
     * Get the international prefix.
     *
     * @return string|null
     */
    public function getInternationalPrefix()
    {
        return isset($this->attributes['dialling']['international_prefix']) ? $this->attributes['dialling']['international_prefix'] : null;
    }

    /**
     * Get the extras.
     *
     * @return array|null
     */
    public function getExtra()
    {
        return isset($this->attributes['extra']) ? $this->attributes['extra'] : null;
    }

    /**
     * Get the geonameid.
     *
     * @return int|null
     */
    public function getGeonameid()
    {
        return isset($this->attributes['extra']['geonameid']) ? $this->attributes['extra']['geonameid'] : null;
    }

    /**
     * Get the edgar code.
     *
     * @return string|null
     */
    public function getEdgar()
    {
        return isset($this->attributes['extra']['edgar']) ? $this->attributes['extra']['edgar'] : null;
    }

    /**
     * Get the itu code.
     *
     * @return string|null
     */
    public function getItu()
    {
        return isset($this->attributes['extra']['itu']) ? $this->attributes['extra']['itu'] : null;
    }

    /**
     * Get the marc code.
     *
     * @return string|null
     */
    public function getMarc()
    {
        return isset($this->attributes['extra']['marc']) ? $this->attributes['extra']['marc'] : null;
    }

    /**
     * Get the wmo code.
     *
     * @return string|null
     */
    public function getWmo()
    {
        return isset($this->attributes['extra']['wmo']) ? $this->attributes['extra']['wmo'] : null;
    }

    /**
     * Get the ds code.
     *
     * @return string|null
     */
    public function getDs()
    {
        return isset($this->attributes['extra']['ds']) ? $this->attributes['extra']['ds'] : null;
    }

    /**
     * Get the fifa code.
     *
     * @return string|null
     */
    public function getFifa()
    {
        return isset($this->attributes['extra']['fifa']) ? $this->attributes['extra']['fifa'] : null;
    }

    /**
     * Get the fips code.
     *
     * @return string|null
     */
    public function getFips()
    {
        return isset($this->attributes['extra']['fips']) ? $this->attributes['extra']['fips'] : null;
    }

    /**
     * Get the gaul code.
     *
     * @return int|null
     */
    public function getGaul()
    {
        return isset($this->attributes['extra']['gaul']) ? $this->attributes['extra']['gaul'] : null;
    }

    /**
     * Get the ioc code.
     *
     * @return string|null
     */
    public function getIoc()
    {
        return isset($this->attributes['extra']['ioc']) ? $this->attributes['extra']['ioc'] : null;
    }

    /**
     * Get the cowc code.
     *
     * @return string|null
     */
    public function getCowc()
    {
        return isset($this->attributes['extra']['cowc']) ? $this->attributes['extra']['cowc'] : null;
    }

    /**
     * Get the cown code.
     *
     * @return int|null
     */
    public function getCown()
    {
        return isset($this->attributes['extra']['cown']) ? $this->attributes['extra']['cown'] : null;
    }

    /**
     * Get the fao code.
     *
     * @return int|null
     */
    public function getFao()
    {
        return isset($this->attributes['extra']['fao']) ? $this->attributes['extra']['fao'] : null;
    }

    /**
     * Get the imf code.
     *
     * @return int|null
     */
    public function getImf()
    {
        return isset($this->attributes['extra']['imf']) ? $this->attributes['extra']['imf'] : null;
    }

    /**
     * Get the ar5 code.
     *
     * @return string|null
     */
    public function getAr5()
    {
        return isset($this->attributes['extra']['ar5']) ? $this->attributes['extra']['ar5'] : null;
    }

    /**
     * Get the address format.
     *
     * @return string|null
     */
    public function getAddressFormat()
    {
        return isset($this->attributes['extra']['address_format']) ? $this->attributes['extra']['address_format'] : null;
    }

    /**
     * Determine whether the country is EU member.
     *
     * @return bool
     */
    public function isEuMember()
    {
        return isset($this->attributes['extra']['eu_member']) ? (bool) $this->attributes['extra']['eu_member'] : null;
    }

    /**
     * Get the VAT rates.
     *
     * @return array|null
     */
    public function getVatRates()
    {
        return isset($this->attributes['extra']['vat_rates']) ? $this->attributes['extra']['vat_rates'] : null;
    }

    /**
     * Get the emoji.
     *
     * @return array|null
     */
    public function getEmoji()
    {
        return isset($this->attributes['extra']['emoji']) ? $this->attributes['extra']['emoji']
            : (isset($this->attributes['emoji']) ? $this->attributes['emoji'] : null);
    }

    /**
     * Get the geographic data structure.
     *
     * @return string|null
     */
    public function getGeoJson()
    {
        $file = __DIR__.'/../resources/data/'.$this->getIsoAlpha2().'.geo.json';

        return file_exists($file) ? file_get_contents($file) : null;
    }

    /**
     * Get the flag.
     *
     * @return string|null
     */
    public function getFlag()
    {
        $file = __DIR__.'/../resources/data/'.$this->getIsoAlpha2().'.svg';

        return file_exists($file) ? file_get_contents($file) : null;
    }

    /**
     * Get the divisions.
     *
     * @param string $division
     *
     * @return array|null
     */
    public function getDivision($division = null)
    {
        return ! empty($this->getDivisions()) && isset($this->getDivisions()[$division]) ? $this->getDivisions()[$division] : null;
    }

    /**
     * Get the divisions.
     *
     * @return array|null
     */
    public function getDivisions()
    {
        $file = __DIR__.'/../resources/data/'.$this->getIsoAlpha2().'.divisions.json';

        return file_exists($file) ? json_decode(file_get_contents($file), true) : null;
    }
}
