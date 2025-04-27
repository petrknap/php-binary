<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PHPUnit\Framework\TestCase;

final class DecoderTest extends TestCase
{
    public function testDecodesBase64(): void
    {
        self::assertSame(
            Coder\Base64Test::getDecodedData(),
            (new Decoder(Coder\Base64Test::getEncodedData()))->base64()->data,
        );
    }

    public function testDecodesChecksum(): void
    {
        self::assertSame(
            Coder\ChecksumTest::getDecodedData(),
            (new Decoder(Coder\ChecksumTest::getEncodedData()))->checksum()->data,
        );
    }

    public function testDecodesHex(): void
    {
        self::assertSame(
            Coder\HexTest::getDecodedData(),
            (new Decoder(Coder\HexTest::getEncodedData()))->hex()->data,
        );
    }

    public function testDecodesZlib(): void
    {
        self::assertSame(
            Coder\ZlibTest::getDecodedData(),
            (new Decoder(Coder\ZlibTest::getEncodedData()))->zlib()->data,
        );
    }
}
