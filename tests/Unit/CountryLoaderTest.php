<?php

declare(strict_types=1);

namespace Rinvex\Country\Tests\Unit;

use ReflectionClass;
use Rinvex\Country\Country;
use PHPUnit\Framework\TestCase;
use Rinvex\Country\CountryLoader;
use PHPUnit\Framework\Attributes\Test;
use Rinvex\Country\CountryLoaderException;

class CountryLoaderTest extends TestCase
{
    /** @var array */
    protected static $methods;

    public static function setUpBeforeClass(): void
    {
        $reflectionClass = new ReflectionClass(CountryLoader::class);
        self::$methods['get'] = $reflectionClass->getMethod('get');
        self::$methods['pluck'] = $reflectionClass->getMethod('pluck');
        self::$methods['filter'] = $reflectionClass->getMethod('filter');
        self::$methods['getFile'] = $reflectionClass->getMethod('getFile');
        self::$methods['collapse'] = $reflectionClass->getMethod('collapse');

        foreach (self::$methods as $method) {
            $method->setAccessible(true);
        }
    }

    public static function tearDownAfterClass(): void
    {
        self::$methods = null;
    }

    #[Test]
    public function it_returns_country_data(): void
    {
        $countryArray = [
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
                'address_format' => "{{recipient}}\n{{street}}\n{{postalcode}} {{city}}\n{{country}}",
                'eu_member' => null,
                'data_protection' => 'Other',
                'vat_rates' => null,
                'emoji' => '🇪🇬',
            ],
        ];

        $this->assertEquals($countryArray, CountryLoader::country('eg', false));
        $this->assertEquals(new Country($countryArray), CountryLoader::country('eg'));
    }

    #[Test]
    public function it_gets_data_with_where_conditions(): void
    {
        $this->assertEquals(['as', 'au', 'ck', 'fj', 'fm', 'gu', 'ki', 'mh', 'mp', 'nc', 'nf', 'nu', 'nr', 'nz', 'pn', 'pw', 'pg', 'pf', 'sb', 'tk', 'tl', 'to', 'tv', 'um', 'vu', 'wf', 'ws'], array_keys(CountryLoader::where('geo.continent', ['OC' => 'Oceania'])));
        $this->assertEquals('Egypt', current(CountryLoader::where('capital', '=', 'Cairo'))['name']['common']);
        $this->assertEquals('Egypt', current(CountryLoader::where('capital', '==', 'Cairo'))['name']['common']);
        $this->assertEquals('Egypt', current(CountryLoader::where('capital', '===', 'Cairo'))['name']['common']);
        $this->assertEquals('Egypt', current(CountryLoader::where('capital', 'invalid-operator', 'Cairo'))['name']['common']);
        $this->assertEquals(['aq', 'ru'], array_keys(CountryLoader::where('geo.area', '>', 12345678)));
        $this->assertEquals(['ru'], array_keys(CountryLoader::where('geo.area', '>=', 17098242)));
        $this->assertEquals(['sj', 'va', 'bq', 'sh'], array_keys(CountryLoader::where('geo.area', '<=', 1)));
        $this->assertEquals(55, count(array_keys(CountryLoader::where('geo.independent', '<>', 'Yes'))));
        $this->assertEquals(45, count(array_keys(CountryLoader::where('geo.landlocked', '!=', false))));
        $this->assertEquals(47, count(array_keys(CountryLoader::where('geo.landlocked', '!==', false))));
        $this->assertEquals(19, count(array_keys(CountryLoader::where('dialling.national_number_lengths.0', '<', 5))));
    }

    #[Test]
    public function it_returns_country_array_shortlist(): void
    {
        $this->assertEquals(250, count(CountryLoader::countries()));
        $this->assertIsArray(CountryLoader::countries()['eg']);
        $this->assertEquals('Egypt', CountryLoader::countries()['eg']['name']);
        $this->assertArrayNotHasKey('geo', CountryLoader::countries()['eg']);
    }

    #[Test]
    public function it_returns_country_hydrated_shortlist(): void
    {
        $this->assertEquals(250, count(CountryLoader::countries(false, true)));
        $this->assertIsObject(CountryLoader::countries(false, true)['eg']);
        $this->assertEquals('Egypt', CountryLoader::countries(false, true)['eg']->getName());
        $this->assertNull(CountryLoader::countries(false, true)['eg']->getGeodata());
    }

    #[Test]
    public function it_returns_country_array_longlist(): void
    {
        $this->assertEquals(250, count(CountryLoader::countries(true)));
        $this->assertIsArray(CountryLoader::countries(true)['eg']);
        $this->assertEquals('Egypt', CountryLoader::countries(true)['eg']['name']['common']);
        $this->assertEquals('🇪🇬', CountryLoader::countries(true)['eg']['extra']['emoji']);
        $this->assertArrayHasKey('geo', CountryLoader::countries(true)['eg']);
    }

    #[Test]
    public function it_returns_country_hydrated_longlist(): void
    {
        $this->assertEquals(250, count(CountryLoader::countries(true, true)));
        $this->assertIsObject(CountryLoader::countries(true, true)['eg']);
        $this->assertEquals('Egypt', CountryLoader::countries(true, true)['eg']->getName());
        $this->assertEquals('🇪🇬', CountryLoader::countries(true, true)['eg']->getEmoji());
        $this->assertIsArray(CountryLoader::countries(true, true)['eg']->getGeodata());
    }

    #[Test]
    public function it_throws_an_exception_when_invalid_country(): void
    {
        $this->expectException(CountryLoaderException::class);

        CountryLoader::country('asd');
    }

    #[Test]
    public function it_filters_data(): void
    {
        $array1 = [['id' => 1, 'name' => 'Hello'], ['id' => 2, 'name' => 'World']];
        $this->assertEquals([1 => ['id' => 2, 'name' => 'World']], self::$methods['filter']->invoke(null, $array1, fn ($item): bool => $item['id'] === 2));

        $array2 = ['', 'Hello', '', 'World'];
        $this->assertEquals(['Hello', 'World'], array_values(self::$methods['filter']->invoke(null, $array2)));

        $array3 = ['id' => 1, 'first' => 'Hello', 'second' => 'World'];
        $this->assertEquals(['first' => 'Hello', 'second' => 'World'], self::$methods['filter']->invoke(null, $array3, fn ($item, $key): bool => $key !== 'id'));
    }

    #[Test]
    public function it_gets_data(): void
    {
        $object = (object) ['users' => ['name' => ['Taylor', 'Otwell']]];
        $array = [(object) ['users' => [(object) ['name' => 'Taylor']]]];
        $dottedArray = ['users' => ['first.name' => 'Taylor', 'middle.name' => null]];
        $this->assertEquals('Taylor', self::$methods['get']->invoke(null, $object, 'users.name.0'));
        $this->assertEquals('Taylor', self::$methods['get']->invoke(null, $array, '0.users.0.name'));
        $this->assertNull(self::$methods['get']->invoke(null, $array, '0.users.3'));
        $this->assertEquals('Not found', self::$methods['get']->invoke(null, $array, '0.users.3', 'Not found'));
        $this->assertEquals('Not found', self::$methods['get']->invoke(null, $array, '0.users.3', fn (): string => 'Not found'));
        $this->assertEquals('Taylor', self::$methods['get']->invoke(null, $dottedArray, ['users', 'first.name']));
        $this->assertNull(self::$methods['get']->invoke(null, $dottedArray, ['users', 'middle.name']));
        $this->assertEquals('Not found', self::$methods['get']->invoke(null, $dottedArray, ['users', 'last.name'], 'Not found'));
    }

    #[Test]
    public function it_returns_target_when_missing_key(): void
    {
        $this->assertEquals(['test'], self::$methods['get']->invoke(null, ['test'], null));
    }

    #[Test]
    public function it_gets_data_with_nested_arrays(): void
    {
        $array = [
            ['name' => 'taylor', 'email' => 'taylorotwell@gmail.com'],
            ['name' => 'abigail'],
            ['name' => 'dayle'],
        ];
        $this->assertEquals(['taylor', 'abigail', 'dayle'], self::$methods['get']->invoke(null, $array, '*.name'));
        $this->assertEquals(['taylorotwell@gmail.com', null, null], self::$methods['get']->invoke(null, $array, '*.email', 'irrelevant'));
        $array = [
            'users' => [
                ['first' => 'taylor', 'last' => 'otwell', 'email' => 'taylorotwell@gmail.com'],
                ['first' => 'abigail', 'last' => 'otwell'],
                ['first' => 'dayle', 'last' => 'rees'],
            ],
            'posts' => null,
        ];
        $this->assertEquals(['taylor', 'abigail', 'dayle'], self::$methods['get']->invoke(null, $array, 'users.*.first'));
        $this->assertEquals(['taylorotwell@gmail.com', null, null], self::$methods['get']->invoke(null, $array, 'users.*.email', 'irrelevant'));
        $this->assertEquals('not found', self::$methods['get']->invoke(null, $array, 'posts.*.date', 'not found'));
        $this->assertNull(self::$methods['get']->invoke(null, $array, 'posts.*.date'));
    }

    #[Test]
    public function it_gets_data_with_nested_double_nested_arrays_and_collapses_result(): void
    {
        $array = [
            'posts' => [
                [
                    'comments' => [
                        ['author' => 'taylor', 'likes' => 4],
                        ['author' => 'abigail', 'likes' => 3],
                    ],
                ],
                [
                    'comments' => [
                        ['author' => 'abigail', 'likes' => 2],
                        ['author' => 'dayle'],
                    ],
                ],
                [
                    'comments' => [
                        ['author' => 'dayle'],
                        ['author' => 'taylor', 'likes' => 1],
                    ],
                ],
            ],
        ];
        $this->assertEquals(['taylor', 'abigail', 'abigail', 'dayle', 'dayle', 'taylor'], self::$methods['get']->invoke(null, $array, 'posts.*.comments.*.author'));
        $this->assertEquals([4, 3, 2, null, null, 1], self::$methods['get']->invoke(null, $array, 'posts.*.comments.*.likes'));
        $this->assertEquals([], self::$methods['get']->invoke(null, $array, 'posts.*.users.*.name', 'irrelevant'));
        $this->assertEquals([], self::$methods['get']->invoke(null, $array, 'posts.*.users.*.name'));
    }

    #[Test]
    public function it_plucks_array(): void
    {
        $data = [
            'post-1' => [
                'comments' => [
                    'tags' => [
                        '#foo', '#bar',
                    ],
                ],
            ],
            'post-2' => [
                'comments' => [
                    'tags' => [
                        '#baz',
                    ],
                ],
            ],
        ];
        $this->assertEquals([
            0 => [
                'tags' => [
                    '#foo', '#bar',
                ],
            ],
            1 => [
                'tags' => [
                    '#baz',
                ],
            ],
        ], self::$methods['pluck']->invoke(null, $data, 'comments'));
        $this->assertEquals([['#foo', '#bar'], ['#baz']], self::$methods['pluck']->invoke(null, $data, 'comments.tags'));
        $this->assertEquals([null, null], self::$methods['pluck']->invoke(null, $data, 'foo'));
        $this->assertEquals([null, null], self::$methods['pluck']->invoke(null, $data, 'foo.bar'));
    }

    #[Test]
    public function it_plucks_array_with_array_and_object_values(): void
    {
        $array = [(object) ['name' => 'taylor', 'email' => 'foo'], ['name' => 'dayle', 'email' => 'bar']];
        $this->assertEquals(['taylor', 'dayle'], self::$methods['pluck']->invoke(null, $array, 'name'));
        $this->assertEquals(['taylor' => 'foo', 'dayle' => 'bar'], self::$methods['pluck']->invoke(null, $array, 'email', 'name'));
    }

    #[Test]
    public function it_plucks_array_with_nested_keys(): void
    {
        $array = [['user' => ['taylor', 'otwell']], ['user' => ['dayle', 'rees']]];
        $this->assertEquals(['taylor', 'dayle'], self::$methods['pluck']->invoke(null, $array, 'user.0'));
        $this->assertEquals(['taylor', 'dayle'], self::$methods['pluck']->invoke(null, $array, ['user', 0]));
        $this->assertEquals(['taylor' => 'otwell', 'dayle' => 'rees'], self::$methods['pluck']->invoke(null, $array, 'user.1', 'user.0'));
        $this->assertEquals(['taylor' => 'otwell', 'dayle' => 'rees'], self::$methods['pluck']->invoke(null, $array, ['user', 1], ['user', 0]));
    }

    #[Test]
    public function it_plucks_array_with_nested_arrays(): void
    {
        $array = [
            [
                'account' => 'a',
                'users' => [
                    ['first' => 'taylor', 'last' => 'otwell', 'email' => 'foo'],
                ],
            ],
            [
                'account' => 'b',
                'users' => [
                    ['first' => 'abigail', 'last' => 'otwell'],
                    ['first' => 'dayle', 'last' => 'rees'],
                ],
            ],
        ];
        $this->assertEquals([['taylor'], ['abigail', 'dayle']], self::$methods['pluck']->invoke(null, $array, 'users.*.first'));
        $this->assertEquals(['a' => ['taylor'], 'b' => ['abigail', 'dayle']], self::$methods['pluck']->invoke(null, $array, 'users.*.first', 'account'));
        $this->assertEquals([['foo'], [null, null]], self::$methods['pluck']->invoke(null, $array, 'users.*.email'));
    }

    #[Test]
    public function it_collapses_array(): void
    {
        $array = [[1], [2], [3], ['foo', 'bar'], ['baz', 'boom']];
        $this->assertEquals([1, 2, 3, 'foo', 'bar', 'baz', 'boom'], self::$methods['collapse']->invoke(null, $array));
    }

    #[Test]
    public function it_gets_file_content(): void
    {
        $this->assertStringEqualsFile(__DIR__.'/../../resources/data/eg.json', self::$methods['getFile']->invoke(null, __DIR__.'/../../resources/data/eg.json'));
    }

    #[Test]
    public function it_throws_an_exception_when_invalid_file(): void
    {
        $this->expectException(CountryLoaderException::class);

        self::$methods['getFile']->invoke(null, __DIR__.'/../resources/data/invalid.json');
    }
}
