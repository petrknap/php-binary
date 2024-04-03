<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

final class Binary
{
    public static function encode(string $data): Encoder
    {
        return new Encoder($data);
    }

    public static function decode(string $data): Decoder
    {
        return new Decoder($data);
    }

    public static function serialize(mixed $data): string
    {
        return (new Serializer())->serialize(serializable: $data);
    }

    public static function unserialize(string $data): mixed
    {
        return (new Serializer())->unserialize(serialized: $data);
    }
}
