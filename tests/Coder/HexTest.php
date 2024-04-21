<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PHPUnit\Framework\Attributes\DataProvider;

final class HexTest extends CoderTestCase
{
    public static function data(): array
    {
        return [
            [
                self::getDecodedData(),
                'da39a3ee5e6b4b0d3255bfef95601890afd80709da39a3ee5e6b4b0d3255bfef95601890afd80709da39a3ee5e6b4b0d3255bfef95601890afd80709',
            ],
        ];
    }

    #[DataProvider('data')]
    public function testEncodes(string $decoded, string $encoded): void
    {
        self::assertSame(
            $encoded,
            (new Hex())->encode(
                $decoded,
            ),
        );
    }

    #[DataProvider('data')]
    public function testDecodes(string $decoded, string $encoded): void
    {
        self::assertSame(
            $decoded,
            (new Hex())->decode(
                $encoded,
            ),
        );
    }

    #[DataProvider('dataDecodeThrows')]
    public function testDecodeThrows(string $data): void
    {
        self::expectException(Exception\CouldNotDecodeData::class);

        (new Hex())->decode(
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
