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
        return self::serializer()->serialize(serializable: $data);
    }

    /**
     * @see Serializer::unserialize()
     */
    public static function unserialize(string $data): mixed
    {
        return self::serializer()->unserialize(serialized: $data);
    }

    /**
     * @see Serializer\OneWaySelfSerializerInterface::toBinary()
     */
    public static function toBinary(Serializer\OneWaySelfSerializerInterface|string $data): string
    {
        if ($data instanceof Serializer\OneWaySelfSerializerInterface) {
            return $data->toBinary();
        }
        return $data;
    }

    /**
     * @see Byter::bite()
     *
     * @return array<string>
     */
    public static function bite(string $data, int $size1, int ...$sizeN): array
    {
        return self::byter()->bite($data, $size1, ...$sizeN);
    }

    /**
     * @see Byter::unbite()
     */
    public static function unbite(string $bite1, string ...$biteN): string
    {
        return self::byter()->unbite($bite1, ...$biteN);
    }

    private static function serializer(): Serializer
    {
        static $serializer;
        return $serializer ??= new Serializer();
    }

    private static function byter(): Byter
    {
        static $byter;
        return $byter ??= new Byter();
    }
}
