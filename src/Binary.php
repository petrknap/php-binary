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
        return self::getSerializer()->serialize(serializable: $data);
    }

    public static function unserialize(string $data): mixed
    {
        return self::getSerializer()->unserialize(serialized: $data);
    }

    private static function getSerializer(): Serializer
    {
        static $serializer;
        return $serializer ??= new Serializer(
            new Encoder(),
            new Decoder(),
        );
    }
}
