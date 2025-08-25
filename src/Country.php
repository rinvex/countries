<?php

declare(strict_types=1);

namespace Rinvex\Country;

use Locale;
use Exception;
use DateTimeZone;
use ResourceBundle;

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
     * @throws Exception
     */
    public function __construct($attributes)
    {
        // Set the attributes
        $this->setAttributes($attributes);

        // Check required mandatory attributes
        if (empty($this->getName()) || empty($this->getOfficialName())
            || empty($this->getNativeName()) || empty($this->getNativeOfficialName())
            || empty($this->getIsoAlpha2()) || empty($this->getIsoAlpha3())) {
            throw new Exception('Missing mandatory country attributes!');
        }
    }

    public static function makeFormNafathAppNationalityCode($code, $hydrate = true): self|array
    {
        // throw exception code not found
        if (! $code) {
            throw new Exception('Nationality code not found');
        }

        // get all countries on the file
        $countries = json_decode(file_get_contents(__DIR__.'/../resources/data/shortlist.json'), true);

        // make it as a laravel collection
        $countries = collect($countries);

        // search on the collection using nafath app code
        $country = $countries->where('nafath_app_nationality_code', $code)->first();

        // get all the attributes and construct the object or throw exception country not found
        if (! $country) {
            throw new Exception('Country not found');
        }

        return CountryLoader::country($country['iso_3166_1_alpha2'], $hydrate);
    }

    /**
     * Set the attributes.
     *
     * @param array $attributes
     *
     * @return $this
     */
    public function setAttributes($attributes): static
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Get the attributes.
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * Set single attribute.
     *
     * @param string $key
     *
     * @return $this
     */
    public function set($key, mixed $value): static
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Get an item from attributes array using "dot" notation.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key, mixed $default = null)
    {
        $array = $this->attributes;

        if (is_null($key)) {
            return $array;
        }

        if (array_key_exists($key, $array)) {
            return $array[$key] ?? $default;
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }

    /**
     * Get the common name.
     */
    public function getName(): ?string
    {
        return $this->get('name.common') ?: $this->get('name');
    }

    /**
     * Get the official name.
     */
    public function getOfficialName(): ?string
    {
        return $this->get('name.official') ?: $this->get('official_name');
    }

    /**
     * Get the given native name or fallback to first native name.
     *
     * @param string|null $languageCode
     */
    public function getNativeName($languageCode = null): ?string
    {
        $languageCode = $languageCode ? mb_strtolower($languageCode) : null;

        return $this->get("name.native.{$languageCode}.common")
            ?? (current($this->get('name.native', []))['common'] ?? $this->get('native_name'));
    }

    /**
     * Get the given native official name or fallback to first native official name.
     *
     * @param string|null $languageCode
     */
    public function getNativeOfficialName($languageCode = null): ?string
    {
        $languageCode = $languageCode ? mb_strtolower($languageCode) : null;

        return $this->get("name.native.{$languageCode}.official")
            ?? (current($this->get('name.native', []))['official'] ?? $this->get('native_official_name'));
    }

    /**
     * Get the native names.
     */
    public function getNativeNames(): ?array
    {
        return $this->get('name.native');
    }

    /**
     * Get the demonym.
     */
    public function getDemonym(): ?string
    {
        return $this->get('demonym');
    }

    /**
     * Get the capital.
     */
    public function getCapital(): ?string
    {
        return $this->get('capital');
    }

    /**
     * Get the ISO 3166-1 alpha2.
     *
     * @return string|null
     */
    public function getIsoAlpha2()
    {
        return $this->get('iso_3166_1_alpha2');
    }

    /**
     * Get the ISO 3166-1 alpha3.
     *
     * @return string|null
     */
    public function getIsoAlpha3()
    {
        return $this->get('iso_3166_1_alpha3');
    }

    /**
     * Get the ISO 3166-1 numeric.
     */
    public function getIsoNumeric(): ?string
    {
        return $this->get('iso_3166_1_numeric');
    }

    /**
     * Get the given currency or fallback to first currency.
     *
     * @param string|null $currency
     */
    public function getCurrency($currency = null): ?array
    {
        $currency = $currency ? mb_strtoupper($currency) : null;

        return $this->get("currency.{$currency}") ?: (current($this->get('currency', [])) ?: null);
    }

    /**
     * Get the currencies.
     */
    public function getCurrencies(): ?array
    {
        return $this->get('currency');
    }

    /**
     * Get the TLD.
     */
    public function getTld(): ?string
    {
        return current($this->get('tld', [])) ?: null;
    }

    /**
     * Get the TLDs.
     */
    public function getTlds(): ?array
    {
        return $this->get('tld');
    }

    /**
     * Get the alternative spellings.
     */
    public function getAltSpellings(): ?array
    {
        return $this->get('alt_spellings');
    }

    /**
     * Get the given language or fallback to first language.
     *
     * @param string|null $languageCode
     */
    public function getLanguage($languageCode = null): ?string
    {
        $languageCode = $languageCode ? mb_strtolower($languageCode) : null;

        return $this->get("languages.{$languageCode}") ?: (current($this->get('languages', [])) ?: null);
    }

    /**
     * Get the languages.
     */
    public function getLanguages(): ?array
    {
        return $this->get('languages');
    }

    /**
     * Get the translations.
     */
    public function getTranslations(): array
    {
        // Get english name
        $name = [
            'eng' => [
                'common' => $this->getName(),
                'official' => $this->getOfficialName(),
            ],
        ];

        // Get native names
        $natives = $this->getNativeNames() ?: [];

        // Get other translations
        $file = __DIR__.'/../resources/translations/'.mb_strtolower((string) $this->getIsoAlpha2()).'.json';
        $translations = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

        // Merge all names together
        $result = array_merge($translations, $natives, $name);

        // Sort alphabetically
        ksort($result);

        return $result;
    }

    /**
     * Get the translation.
     *
     * @param string|null $languageCode
     */
    public function getTranslation($languageCode = null): array
    {
        return $this->getTranslations()[$languageCode] ?? current($this->getTranslations());
    }

    /**
     * Get the geodata.
     */
    public function getGeodata(): ?array
    {
        return $this->get('geo');
    }

    /**
     * Get the continent.
     */
    public function getContinent(): ?string
    {
        return current($this->get('geo.continent', [])) ?: null;
    }

    /**
     * Determine whether the country uses postal code.
     *
     * @return bool|null
     */
    public function usesPostalCode()
    {
        return $this->get('geo.postal_code');
    }

    /**
     * Get the latitude.
     */
    public function getLatitude(): ?string
    {
        return $this->get('geo.latitude');
    }

    /**
     * Get the longitude.
     */
    public function getLongitude(): ?string
    {
        return $this->get('geo.longitude');
    }

    /**
     * Get the described latitude.
     */
    public function getLatitudeDesc(): ?string
    {
        return $this->get('geo.latitude_desc');
    }

    /**
     * Get the described longitude.
     */
    public function getLongitudeDesc(): ?string
    {
        return $this->get('geo.longitude_desc');
    }

    /**
     * Get the maximum latitude.
     */
    public function getMaxLatitude(): ?string
    {
        return $this->get('geo.max_latitude');
    }

    /**
     * Get the maximum longitude.
     */
    public function getMaxLongitude(): ?string
    {
        return $this->get('geo.max_longitude');
    }

    /**
     * Get the minimum latitude.
     */
    public function getMinLatitude(): ?string
    {
        return $this->get('geo.min_latitude');
    }

    /**
     * Get the minimum longitude.
     */
    public function getMinLongitude(): ?string
    {
        return $this->get('geo.min_longitude');
    }

    /**
     * Get the area.
     */
    public function getArea(): ?int
    {
        return $this->get('geo.area');
    }

    /**
     * Get the region.
     */
    public function getRegion(): ?string
    {
        return $this->get('geo.region');
    }

    /**
     * Get the subregion.
     */
    public function getSubregion(): ?string
    {
        return $this->get('geo.subregion');
    }

    /**
     * Get the world region.
     */
    public function getWorldRegion(): ?string
    {
        return $this->get('geo.world_region');
    }

    /**
     * Get the region code.
     */
    public function getRegionCode(): ?string
    {
        return $this->get('geo.region_code');
    }

    /**
     * Get the subregion code.
     */
    public function getSubregionCode(): ?string
    {
        return $this->get('geo.subregion_code');
    }

    /**
     * Check the landlock status.
     *
     * @return bool|null
     */
    public function isLandlocked()
    {
        return $this->get('geo.landlocked');
    }

    /**
     * Get the borders.
     */
    public function getBorders(): ?array
    {
        return $this->get('geo.borders');
    }

    /**
     * Determine whether the country is independent.
     */
    public function isIndependent(): ?string
    {
        return $this->get('geo.independent');
    }

    /**
     * Get the given calling code or fallback to first calling code.
     */
    public function getCallingCode(): ?string
    {
        return current($this->get('dialling.calling_code', [])) ?: (current($this->get('calling_code', [])) ?: null);
    }

    /**
     * Get the calling codes.
     */
    public function getCallingCodes(): ?array
    {
        return $this->get('dialling.calling_code');
    }

    /**
     * Get the national prefix.
     */
    public function getNationalPrefix(): ?string
    {
        return $this->get('dialling.national_prefix');
    }

    /**
     * Get the national number length.
     */
    public function getNationalNumberLength(): ?int
    {
        return current($this->get('dialling.national_number_lengths', [])) ?: null;
    }

    /**
     * Get the national number lengths.
     */
    public function getNationalNumberLengths(): ?array
    {
        return $this->get('dialling.national_number_lengths');
    }

    /**
     * Get the national destination code length.
     */
    public function getNationalDestinationCodeLength(): ?int
    {
        return current($this->get('dialling.national_destination_code_lengths', [])) ?: null;
    }

    /**
     * Get the national destination code lengths.
     */
    public function getnationaldestinationcodelengths(): ?array
    {
        return $this->get('dialling.national_destination_code_lengths');
    }

    /**
     * Get the international prefix.
     */
    public function getInternationalPrefix(): ?string
    {
        return $this->get('dialling.international_prefix');
    }

    /**
     * Get the extras.
     */
    public function getExtra(): ?array
    {
        return $this->get('extra');
    }

    /**
     * Get the geonameid.
     */
    public function getGeonameid(): ?int
    {
        return $this->get('extra.geonameid');
    }

    /**
     * Get the edgar code.
     */
    public function getEdgar(): ?string
    {
        return $this->get('extra.edgar');
    }

    /**
     * Get the itu code.
     */
    public function getItu(): ?string
    {
        return $this->get('extra.itu');
    }

    /**
     * Get the marc code.
     */
    public function getMarc(): ?string
    {
        return $this->get('extra.marc');
    }

    /**
     * Get the wmo code.
     */
    public function getWmo(): ?string
    {
        return $this->get('extra.wmo');
    }

    /**
     * Get the ds code.
     */
    public function getDs(): ?string
    {
        return $this->get('extra.ds');
    }

    /**
     * Get the fifa code.
     */
    public function getFifa(): ?string
    {
        return $this->get('extra.fifa');
    }

    /**
     * Get the fips code.
     */
    public function getFips(): ?string
    {
        return $this->get('extra.fips');
    }

    /**
     * Get the gaul code.
     */
    public function getGaul(): ?int
    {
        return $this->get('extra.gaul');
    }

    /**
     * Get the ioc code.
     */
    public function getIoc(): ?string
    {
        return $this->get('extra.ioc');
    }

    /**
     * Get the cowc code.
     */
    public function getCowc(): ?string
    {
        return $this->get('extra.cowc');
    }

    /**
     * Get the cown code.
     */
    public function getCown(): ?int
    {
        return $this->get('extra.cown');
    }

    /**
     * Get the fao code.
     */
    public function getFao(): ?int
    {
        return $this->get('extra.fao');
    }

    /**
     * Get the imf code.
     */
    public function getImf(): ?int
    {
        return $this->get('extra.imf');
    }

    /**
     * Get the ar5 code.
     *
     * @return string|null
     */
    public function getAr5()
    {
        return $this->get('extra.ar5');
    }

    /**
     * Get the address format.
     */
    public function getAddressFormat(): ?string
    {
        return $this->get('extra.address_format');
    }

    /**
     * Determine whether the country is EU member.
     *
     * @return bool|null
     */
    public function isEuMember()
    {
        return $this->get('extra.eu_member');
    }

    /**
     * Determine whether the country has data protection.
     *
     * @return string|null
     */
    public function getDataProtection()
    {
        return $this->get('extra.data_protection');
    }

    /**
     * Get the VAT rates.
     */
    public function getVatRates(): ?array
    {
        return $this->get('extra.vat_rates');
    }

    /**
     * Get the emoji.
     */
    public function getEmoji(): ?string
    {
        return $this->get('extra.emoji') ?: $this->get('emoji');
    }

    /**
     * Get the geographic data structure.
     */
    public function getGeoJson(): ?string
    {
        if (! ($code = $this->getIsoAlpha2())) {
            return null;
        }

        return file_exists($file = __DIR__.'/../resources/geodata/'.mb_strtolower($code).'.json') ? file_get_contents($file) : null;
    }

    /**
     * Get the flag.
     */
    public function getFlag(): ?string
    {
        if (! ($code = $this->getIsoAlpha2())) {
            return null;
        }

        return file_exists($file = __DIR__.'/../resources/flags/'.mb_strtolower($code).'.svg') ? file_get_contents($file) : null;
    }

    /**
     * Get the divisions.
     */
    public function getDivisions(): ?array
    {
        if (! ($code = $this->getIsoAlpha2())) {
            return null;
        }

        return file_exists($file = __DIR__.'/../resources/divisions/'.mb_strtolower($code).'.json') ? json_decode(file_get_contents($file), true) : null;
    }

    /**
     * Get the divisions.
     *
     * @param string $division
     */
    public function getDivision($division): ?array
    {
        return ! empty($this->getDivisions()) && isset($this->getDivisions()[$division])
            ? $this->getDivisions()[$division] : null;
    }

    /**
     * Get the timezones.
     *
     * @return array|null
     */
    public function getTimezones()
    {
        if (! ($code = $this->getIsoAlpha2())) {
            return;
        }

        return DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $code);
    }

    /**
     * Get the locales.
     *
     * @return array|null
     */
    public function getLocales()
    {
        if (! ($code = $this->getIsoAlpha2())) {
            return;
        }

        $locales = [];
        foreach (ResourceBundle::getLocales('') as $localeCode) {
            if ($code === Locale::getRegion($localeCode)) {
                $locales[] = $localeCode;
            }
        }

        return $locales;
    }
}
