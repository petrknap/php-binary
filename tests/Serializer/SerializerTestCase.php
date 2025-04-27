<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

use PetrKnap\Binary\TestCase;
use stdClass;

abstract class SerializerTestCase extends TestCase
{
    public function testSerializesSerializable(): void
    {
        self::assertBinarySame(
            static::getSerialized(),
            static::getSerializer()->serialize(self::getSerializable()),
        );
    }

    public function testSerializeThrowsOnNonserializable(): void
    {
        self::expectException(Exception\SerializerCouldNotSerializeData::class);

        static::getSerializer()->serialize(new class () {
        });
    }

    public function testUnserializesSerialized(): void
    {
        self::assertEquals(
            self::getSerializable(),
            static::getSerializer()->unserialize(static::getSerialized()),
        );
    }

    public function testSerializeThrowsOnNonserialized(): void
    {
        self::expectException(Exception\SerializerCouldNotUnserializeData::class);

        static::getSerializer()->unserialize('?' . static::getSerialized());
    }

    private static function getSerializable(): stdClass
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

    abstract protected static function getSerialized(): string;

    abstract protected static function getSerializer(): SerializerInterface;
}
