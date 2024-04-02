<?php declare(strict_types=1);

namespace PetrKnap\Binary;

use PHPUnit\Framework\TestCase;

final class EncoderTest extends TestCase
{
    public function testEncodesBase64(): void
    {
        self::assertSame(
            Coder\Base64Test::getEncodedData(),
            (new Encoder(Coder\Base64Test::getDecodedData()))->base64()->getData(),
        );
    }

    public function testEncodesChecksum(): void
    {
        self::assertSame(
            Coder\ChecksumTest::getEncodedData(),
            (new Encoder(Coder\ChecksumTest::getDecodedData()))->checksum()->getData(),
        );
    }

    public function testEncodesHex(): void
    {
        self::assertSame(
            Coder\HexTest::getEncodedData(),
            (new Encoder(Coder\HexTest::getDecodedData()))->hex()->getData(),
        );
    }

    public function testEncodesZlib(): void
    {
        self::assertSame(
            Coder\ZlibTest::getEncodedData(),
            (new Encoder(Coder\ZlibTest::getDecodedData()))->zlib()->getData(),
        );
    }
}
