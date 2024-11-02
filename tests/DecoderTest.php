<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

final class DecoderTest extends TestCase
{
    public function testDecodesBase64(): void
    {
        self::assertBinarySame(
            Coder\Base64Test::getDecodedData(),
            (new Decoder(Coder\Base64Test::getEncodedData()))->base64()->data,
        );
    }

    public function testDecodesChecksum(): void
    {
        self::assertBinarySame(
            Coder\ChecksumTest::getDecodedData(),
            (new Decoder(Coder\ChecksumTest::getEncodedData()))->checksum()->data,
        );
    }

    public function testDecodesHex(): void
    {
        self::assertBinarySame(
            Coder\HexTest::getDecodedData(),
            (new Decoder(Coder\HexTest::getEncodedData()))->hex()->data,
        );
    }

    public function testDecodesXz(): void
    {
        self::assertBinarySame(
            Coder\XzTest::getDecodedData(),
            (new Decoder(Coder\XzTest::getEncodedData()))->xz()->data,
        );
    }

    public function testDecodesZlib(): void
    {
        self::assertBinarySame(
            Coder\ZlibTest::getDecodedData(),
            (new Decoder(Coder\ZlibTest::getEncodedData()))->zlib()->data,
        );
    }
}
