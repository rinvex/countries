<?php

declare(strict_types=1);

namespace Rinvex\Country\Tests\Unit;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

class DivisionsTest extends TestCase
{
    /**
     * Countries whose remaining "~" keys have no ISO 3166-2 code to use instead:
     * the Cayman Islands and the French Southern Territories have no ISO
     * subdivisions, and Skopje, Umm Sa'id, Shariff Kabunsuan and the old
     * Laayoune-Boujdour-Sakia El Hamra region have no current code.
     */
    protected const PLACEHOLDERS_WITHOUT_ISO_CODE = ['ky', 'ma', 'mk', 'ph', 'qa', 'tf'];

    #[Test]
    public function it_never_prefixes_division_codes_with_the_country_code(): void
    {
        foreach ($this->divisionFiles() as $country => $divisions) {
            foreach (array_keys($divisions) as $code) {
                $this->assertStringStartsNotWith(mb_strtoupper($country).'-', (string) $code, "{$country}: {$code}");
            }
        }
    }

    #[Test]
    public function it_uses_iso_codes_instead_of_placeholders(): void
    {
        foreach ($this->divisionFiles() as $country => $divisions) {
            if (in_array($country, self::PLACEHOLDERS_WITHOUT_ISO_CODE, true)) {
                continue;
            }

            foreach (array_keys($divisions) as $code) {
                $this->assertStringNotContainsString('~', (string) $code, "{$country}: {$code}");
            }
        }
    }

    #[Test]
    public function it_names_every_division(): void
    {
        foreach ($this->divisionFiles() as $country => $divisions) {
            foreach ($divisions as $code => $division) {
                $this->assertNotEmpty($division['name'] ?? null, "{$country}: {$code}");
            }
        }
    }

    #[Test]
    public function it_returns_former_placeholder_divisions_by_their_iso_code(): void
    {
        $this->assertSame('Lima Metropolitana', country('pe')->getDivision('LMA')['name']);
        $this->assertSame('Santa Elena', country('ec')->getDivision('SE')['name']);
        $this->assertSame('Chatham Islands', country('nz')->getDivision('CIT')['name']);
        $this->assertSame('Ashgabat', country('tm')->getDivision('S')['name']);
        $this->assertSame('Østfold', country('no')->getDivision('01')['name']);
        $this->assertSame('Central Singapore', country('sg')->getDivision('01')['name']);
        $this->assertNull(country('pe')->getDivision('X1~'));
    }

    /**
     * @return array<string, array>
     */
    protected function divisionFiles(): array
    {
        $files = [];

        foreach (glob(__DIR__.'/../../resources/divisions/*.json') as $file) {
            $files[basename($file, '.json')] = json_decode(file_get_contents($file), true);
        }

        return $files;
    }
}
