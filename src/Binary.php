<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

final class Binary
{
    public static function encode(string $data): EncoderInterface
    {
        return new Encoder($data);
    }

    public static function decode(string $data): DecoderInterface
    {
        return new Decoder($data);
    }

    /**
     * @see Serializer::serialize()
     */
    public static function serialize(mixed $data): string
    {
        return (new Serializer())->serialize(serializable: $data);
    }

    /**
     * @see Serializer::unserialize()
     */
    public static function unserialize(string $data): mixed
    {
        return (new Serializer())->unserialize(serialized: $data);
    }

    /**
     * @see Byter::bite()
     *
     * @return array<string>
     */
    public static function bite(string $data, int $size1, int ...$sizeN): array
    {
        return (new Byter())->bite($data, $size1, ...$sizeN);
    }

    /**
     * @see Byter::unbite()
     */
    public static function unbite(string $bite1, string ...$biteN): string
    {
        return (new Byter())->unbite($bite1, ...$biteN);
    }
}
