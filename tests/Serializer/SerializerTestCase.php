<?php declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

use PHPUnit\Framework\TestCase;
use stdClass;

abstract class SerializerTestCase extends TestCase
{
    public static function getSerializable(): stdClass
    {
        $serializable = new stdClass();
        $serializable->array = [];
        $serializable->binary = 0b0;
        $serializable->float = .0;
        $serializable->int = 0;
        $serializable->null = null;
        $serializable->string = '';

        return $serializable;
    }

    abstract public static function getSerialized(): string;

    abstract public static function getSerializer(): SerializerInterface;

    public function testSerializesSerializable(): void
    {
        self::assertEquals(
            static::getSerialized(),
            static::getSerializer()->serialize(static::getSerializable()),
        );
    }

    public function testSerializeThrowsOnNonserializable(): void
    {
        self::expectException(Exception\CouldNotSerializeData::class);

        static::getSerializer()->serialize(new class () {
        });
    }

    public function testUnserializesSerialized(): void
    {
        self::assertEquals(
            static::getSerializable(),
            static::getSerializer()->unserialize(static::getSerialized()),
        );
    }

    public function testSerializeThrowsOnNonserialized(): void
    {
        self::expectException(Exception\CouldNotUnserializeData::class);

        static::getSerializer()->unserialize('?' . static::getSerialized());
    }
}
