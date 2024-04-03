<?php declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

use PetrKnap\Shorts\Exception\MissingRequirement;

final class IgbinaryTest extends SerializerTestCase
{
    public static function getSerialized(): string
    {
        return base64_decode(''); // @TODO
    }

    public static function getSerializer(): SerializerInterface
    {
        try {
            return new Igbinary();
        } catch (MissingRequirement $reason) {
            self::markTestSkipped($reason->getMessage());
        }
    }
}
