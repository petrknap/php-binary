<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

final class EncoderTest extends TestCase
{
    public function testEncodesBase64(): void
    {
        self::assertBinarySame(
            Coder\Base64Test::getEncodedData(),
            (new Encoder(Coder\Base64Test::getDecodedData()))->base64()->data,
        );
    }

    public function testEncodesChecksum(): void
    {
        self::assertBinarySame(
            Coder\ChecksumTest::getEncodedData(),
            (new Encoder(Coder\ChecksumTest::getDecodedData()))->checksum()->data,
        );
    }

    public function testEncodesHex(): void
    {
        self::assertBinarySame(
            Coder\HexTest::getEncodedData(),
            (new Encoder(Coder\HexTest::getDecodedData()))->hex()->data,
        );
    }

    public function testEncodesZlib(): void
    {
        self::assertBinarySame(
            Coder\ZlibTest::getEncodedData(),
            (new Encoder(Coder\ZlibTest::getDecodedData()))->zlib()->data,
        );
    }
}
