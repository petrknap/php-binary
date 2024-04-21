<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PetrKnap\Shorts\Exception\MissingRequirement;
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
        self::assertSame(
            $encoded,
            self::getChecksum()->encode(
                $decoded,
                algorithm: $algorithm,
            ),
        );
    }

    #[DataProvider('dataEncodeThrows')]
    public function testEncodeThrows(string $algorithm): void
    {
        self::expectException(Exception\CouldNotEncodeData::class);

        self::getChecksum()->encode(
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
        self::assertSame(
            $decoded,
            self::getChecksum()->decode(
                $encoded,
                algorithm: $algorithm,
            ),
        );
    }

    #[DataProvider('dataDecodeThrows')]
    public function testDecodeThrows(string $data, string $algorithm): void
    {
        self::expectException(Exception\CouldNotDecodeData::class);

        self::getChecksum()->decode(
            $data,
            algorithm: $algorithm,
        );
    }

    public static function dataDecodeThrows(): array
    {
        return [
            'wrong algorithm' => [self::getEncodedData(), '?'],
            'short data' => ['?', Checksum::ALGORITHM],
            'wrong data' => [self::getDecodedData(), Checksum::ALGORITHM],
            'wrong checksum' => ['?' . self::getEncodedData(), Checksum::ALGORITHM],
        ];
    }

    private static function getChecksum(): Checksum
    {
        try {
            return new Checksum();
        } catch (MissingRequirement $reason) {
            self::markTestSkipped($reason->getMessage());
        }
    }
}
