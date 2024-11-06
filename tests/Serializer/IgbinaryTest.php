<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

final class IgbinaryTest extends SerializerTestCase
{
    public static function getSerialized(): string
    {
        return base64_decode('AAAAAhcIc3RkQ2xhc3MUBhEFYXJyYXkUABEGYmluYXJ5BgARBWZsb2F0DAAAAAAAAAAAEQNpbnQGABEEbnVsbAARBnN0cmluZw0=');
    }

    public static function getSerializer(): SerializerInterface
    {
        return new Igbinary();
    }
}
