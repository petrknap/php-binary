<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

final class SerializerTest extends Serializer\SerializerTestCase
{
    protected static function getSerialized(): string
    {
        return base64_decode('NYtJCoAwEAT/0i8IuCA9R+/6hhFRAiFCJh4k+HdDwGNVV6+cCMv7HNQMHFmMA6Ep6QNROpbXqsbmo6aqPJ205AiXZsjeuCN8zP/aE/EOAbJI+1pOPp6o4AjI+wE=');
    }

    protected static function getSerializer(): Serializer\SerializerInterface
    {
        return new Serializer();
    }
}
