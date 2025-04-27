<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PHPUnit\Framework\Attributes\DataProvider;

final class ChecksumTest extends CoderTestCase
{
    public static function data(): array
    {
        $data = self::getDecodedData();
        return [
            'crc32' => [$data, $data . hex2bin('95a41ef8'), 'crc32'],
            'sha1' => [$data, $data . hex2bin('d0dc1cf9bf61884f8e7982e0b1b87954bd9ee9c7'), 'sha1'],
        ];
    }

    #[DataProvider('data')]
    public function testEncodes(string $decoded, string $encoded, string $algorithm): void
    {
        self::assertBinarySame(
            $encoded,
            (new Checksum())->encode(
                $decoded,
                algorithm: $algorithm,
            ),
        );
    }

    #[DataProvider('dataEncodeThrows')]
    public function testEncodeThrows(string $algorithm): void
    {
        self::expectException(Exception\CoderCouldNotEncodeData::class);

        (new Checksum())->encode(
            self::getDecodedData(),
            algorithm: $algorithm,
        );
    }

    public static function dataEncodeThrows(): array
    {
        return [
            'wrong algorithm' => ['?'],
        ];
    }

    #[DataProvider('data')]
    public function testDecodes(string $decoded, string $encoded, string $algorithm): void
    {
        self::assertBinarySame(
            $decoded,
            (new Checksum())->decode(
                $encoded,
                algorithm: $algorithm,
            ),
        );
    }

    #[DataProvider('dataDecodeThrows')]
    public function testDecodeThrows(string $data, string $algorithm): void
    {
        self::expectException(Exception\CoderCouldNotDecodeData::class);

        (new Checksum())->decode(
            $data,
            algorithm: $algorithm,
        );
    }

    public static function dataDecodeThrows(): array
    {
        return [
            'wrong algorithm' => [self::getEncodedData(), '?'],
            'short data' => ['?', Checksum::DEFAULT_ALGORITHM],
            'wrong data' => [self::getDecodedData(), Checksum::DEFAULT_ALGORITHM],
            'wrong checksum' => ['?' . self::getEncodedData(), Checksum::DEFAULT_ALGORITHM],
        ];
    }
}
