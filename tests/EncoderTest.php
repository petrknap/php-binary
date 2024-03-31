<?php declare(strict_types=1);

namespace PetrKnap\Binary;

use PHPUnit\Framework\Attributes\DataProvider;

final class EncoderTest extends CoderTestCase
{
    #[DataProvider('dataBase64')]
    public function testEncodesBase64(string $decoded, string $encoded, bool $urlSafe): void
    {
        self::assertSame(
            $encoded,
            (new Encoder($decoded))->base64($urlSafe)->getData(),
        );
    }

    #[DataProvider('dataZlib')]
    public function testEncodesZlib(string $decoded, string $encoded, int $encoding, int $level): void
    {
        self::assertSame(
            base64_encode($encoded),
            base64_encode((new Encoder($decoded))->zlib(encoding: $encoding, level: $level)->getData()),
        );
    }

    #[DataProvider('dataZlibThrows')]
    public function testZlibThrows(int $encoding, int $level): void
    {
        self::expectException(Exception\CouldNotEncodeData::class);

        (new Encoder('data'))->zlib($encoding, $level);
    }

    public static function dataZlibThrows(): array
    {
        return [
            'wrong encoding' => [0, EncoderInterface::ZLIB_LEVEL],
            'wrong level' => [EncoderInterface::ZLIB_ENCODING, -2],
        ];
    }
}
