<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PHPUnit\Framework\Attributes\DataProvider;

final class Base64Test extends CoderTestCase
{
    public static function data(): array
    {
        $data = self::getDecodedData();
        return [
            'URL unsafe' => [$data, CoderTestCase::DATA_BASE64, false],
            'URL safe' => [$data, '2jmj7l5rSw0yVb_vlWAYkK_YBwnaOaPuXmtLDTJVv--VYBiQr9gHCdo5o-5ea0sNMlW_75VgGJCv2AcJ', true],
        ];
    }

    #[DataProvider('data')]
    public function testEncodes(string $decoded, string $encoded, bool $urlSafe): void
    {
        self::assertBinarySame(
            $encoded,
            (new Base64())->encode(
                $decoded,
                urlSafe: $urlSafe,
            ),
        );
    }

    #[DataProvider('data')]
    public function testDecodes(string $decoded, string $encoded): void
    {
        self::assertBinarySame(
            $decoded,
            (new Base64())->decode(
                $encoded,
            ),
        );
    }

    #[DataProvider('dataDecodeThrows')]
    public function testDecodeThrows(string $data): void
    {
        self::expectException(Exception\CoderCouldNotDecodeData::class);

        (new Base64())->decode(
            $data,
        );
    }

    public static function dataDecodeThrows(): array
    {
        return [
            'wrong data' => ['?'],
        ];
    }
}
