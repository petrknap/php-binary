<?php declare(strict_types=1);

namespace PetrKnap\Binary;

use PHPUnit\Framework\Attributes\DataProvider;

final class DecoderTest extends CoderTestCase
{
    #[DataProvider('dataBase64')]
    public function testDecodesBase64(string $decoded, string $encoded): void
    {
        self::assertSame(
            $decoded,
            (new Decoder($encoded))->base64()->getData(),
        );
    }

    #[DataProvider('dataBase64Throws')]
    public function testBase64Throws(string $data): void
    {
        self::expectException(Exception\CouldNotDecodeData::class);

        (new Decoder($data))->base64();
    }

    public static function dataBase64Throws(): array
    {
        return [
            'wrong data' => ['?'],
        ];
    }

    #[DataProvider('dataZlib')]
    public function testDecodesZlib(string $decoded, string $encoded): void
    {
        self::assertSame(
            $decoded,
            (new Decoder($encoded))->zlib()->getData(),
        );
    }

    #[DataProvider('dataZlibThrows')]
    public function testZlibThrows(string $data, int $maxLength): void
    {
        self::expectException(Exception\CouldNotDecodeData::class);

        (new Decoder($data))->zlib($maxLength);
    }

    public static function dataZlibThrows(): array
    {
        return [
            'wrong data' => ['AwA=', DecoderInterface::ZLIB_MAX_LENGTH],
            'wrong maximal length' => [base64_decode('AwA='), -1],
        ];
    }
}
