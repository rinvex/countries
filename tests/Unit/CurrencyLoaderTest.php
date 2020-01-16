<?php

declare(strict_types=1);

namespace Rinvex\Country\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Rinvex\Country\CurrencyLoader;

class CurrencyLoaderTest extends TestCase
{
    /** @var array */
    protected static $methods;

    /** @test */
    public function it_returns_courrencies_longlist()
    {
        $this->assertEquals(165, count(CurrencyLoader::curriencies(true)));
        $this->assertArrayHasKey('EGP', CurrencyLoader::curriencies());
        $this->assertIsArray(CurrencyLoader::curriencies(true)['EGP']);
        $this->assertEquals('EGP', CurrencyLoader::curriencies(true)['EGP']['iso_4217_code']);
        $this->assertEquals('818', CurrencyLoader::curriencies(true)['EGP']['iso_4217_numeric']);
        $this->assertEquals('Egyptian Pound', CurrencyLoader::curriencies(true)['EGP']['iso_4217_name']);
        $this->assertEquals('2', CurrencyLoader::curriencies(true)['EGP']['iso_4217_minor_unit']);
    }

    /** @test */
    public function it_returns_courrencies_shortlist()
    {
        $this->assertEquals(165, count(CurrencyLoader::curriencies()));
        $this->assertArrayHasKey('EGP', CurrencyLoader::curriencies());
        $this->assertIsString(CurrencyLoader::curriencies()['EGP']);
        $this->assertEquals('EGP', CurrencyLoader::curriencies()['EGP']);
    }
}
