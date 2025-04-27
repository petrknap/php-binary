<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

use PetrKnap\Binary\TestCase;
use stdClass;

final class SelfSerializerTest extends TestCase
{
    private const SERIALIZED_INSTANCE_B64 = 'S7QysarOtDKwzrQyBGN/KwsrpeKSFOecxOJiJStDq+piK2MrpbT8fCVrMCspsUjJujbTygjINTQxtVLy3mK0cdW5LUYbgJgpyTm7Xptbe+mjSSLP5xx5lKSq7bz6VZJ2svbSLX9qVLMNtDU3epzcJbZkz41Td454nazuvngs9Pk2iVyGpG0qz99U5ea9Xdqv1mkzv/hJ4KRV2z6/Cve8dfKW9/Y/KwPPml24dudFYdH0m0+D1fM+ro+sfHxFVt/XO9W5Njo4jNeNTXUBc8/av2uyGZWAHjG29rOuBQA=';

    public function testSerializationWorks(): void
    {
        self::assertBinarySame(
            base64_decode(self::SERIALIZED_INSTANCE_B64),
            self::getInstance()->toBinary(),
        );
    }

    public function testUnserializationWorks(): void
    {
        self::assertEquals(
            self::getInstance(),
            Some\SelfSerializer::fromBinary(base64_decode(self::SERIALIZED_INSTANCE_B64)),
        );
    }

    private static function getInstance(): SelfSerializerInterface
    {
        $stdClass = new stdClass();
        $stdClass->foo = 'bar';

        $instance = new Some\SelfSerializer(
            1,
            $stdClass,
            new Some\SelfSerializer(
                2,
                $stdClass,
                new Some\SelfSerializer(
                    3,
                    $stdClass,
                    null,
                    'value',
                ),
                null,
            ),
            null,
        );

        $instance->innerInstance->innerInstance->variable = 'changed';

        return $instance;
    }
}
