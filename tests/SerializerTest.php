<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PetrKnap\Shorts\Exception\MissingRequirement;

final class SerializerTest extends Serializer\SerializerTestCase
{
    public static function getSerialized(): string
    {
        return base64_decode('NYtJCoAwEAT/0i8IuCA9R+/6hhFRAiFCJh4k+HdDwGNVV6+cCMv7HNQMHFmMA6Ep6QNROpbXqsbmo6aqPJ205AiXZsjeuCN8zP/aE/EOAbJI+1pOPp6o4AjI+wE=');
    }

    public static function getSerializer(): Serializer\SerializerInterface
    {
        try {
            return new Serializer();
        } catch (MissingRequirement $reason) {
            self::markTestSkipped($reason->getMessage());
        }
    }
}
