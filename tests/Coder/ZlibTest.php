<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PetrKnap\Shorts\Exception\MissingRequirement;
use PHPUnit\Framework\Attributes\DataProvider;

final class ZlibTest extends CoderTestCase
{
    public static function data(): array
    {
        $data = self::getDecodedData();
        return [
            'raw' => [$data, base64_decode('u2W5+F1ctjevUej+91MTJCasv8HOeYtIMQA='), ZLIB_ENCODING_RAW],
            'deflate' => [$data, base64_decode('eJy7Zbn4XVy2N69R6P73UxMkJqy/wc55i0gxAF0bG4s='), ZLIB_ENCODING_DEFLATE],
            'gzip' => [$data, base64_decode('H4sIAAAAAAAAA7tlufhdXLY3r1Ho/vdTEyQmrL/BznmLSDEAqyp39zwAAAA='), ZLIB_ENCODING_GZIP],
        ];
    }

    #[DataProvider('data')]
    public function testEncodes(string $decoded, string $encoded, int $encoding): void
    {
        self::assertSame(
            $encoded,
            self::getZlib()->encode(
                $decoded,
                encoding: $encoding,
            ),
        );
    }

    #[DataProvider('dataEncodeThrows')]
    public function testEncodeThrows(?int $encoding, ?int $level): void
    {
        self::expectException(Exception\CouldNotEncodeData::class);

        self::getZlib()->encode(
            self::getDecodedData(),
            encoding: $encoding,
            level: $level,
        );
    }

    public static function dataEncodeThrows(): array
    {
        return [
            'wrong encoding' => [0, null],
            'wrong level' => [null, -2],
        ];
    }

    #[DataProvider('data')]
    public function testDecodes(string $decoded, string $encoded): void
    {
        self::assertSame(
            $decoded,
            self::getZlib()->decode(
                $encoded,
            ),
        );
    }

    #[DataProvider('dataDecodeThrows')]
    public function testDecodeThrows(string $data, ?int $maxLength): void
    {
        self::expectException(Exception\CouldNotDecodeData::class);

        self::getZlib()->decode(
            $data,
            maxLength: $maxLength,
        );
    }

    public static function dataDecodeThrows(): array
    {
        return [
            'wrong data' => ['AwA=', null],
            'wrong maximal length' => [base64_decode('AwA='), -1],
        ];
    }

    private static function getZlib(): Zlib
    {
        try {
            return new Zlib();
        } catch (MissingRequirement $reason) {
            self::markTestSkipped($reason->getMessage());
        }
    }
}
