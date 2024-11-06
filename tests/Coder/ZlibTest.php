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
        self::assertBinarySame(
            $encoded,
            (new Zlib())->encode(
                $decoded,
                encoding: $encoding,
            ),
        );
    }

    #[DataProvider('dataEncodeThrows')]
    public function testEncodeThrows(int|null $encoding, int|null $level): void
    {
        self::expectException(Exception\CoderCouldNotEncodeData::class);

        (new Zlib())->encode(
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
        self::assertBinarySame(
            $decoded,
            (new Zlib())->decode(
                $encoded,
            ),
        );
    }

    #[DataProvider('dataDecodeThrows')]
    public function testDecodeThrows(string $data, int|null $maxLength): void
    {
        self::expectException(Exception\CoderCouldNotDecodeData::class);

        (new Zlib())->decode(
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
}
