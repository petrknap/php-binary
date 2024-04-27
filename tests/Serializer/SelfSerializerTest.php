<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

use PHPUnit\Framework\TestCase;

final class SelfSerializerTest extends TestCase
{
    public function testSerializationWorks(): void
    {
        self::assertEquals(
            SelfSerializingDataObject::BINARY_B64,
            base64_encode(SelfSerializingDataObject::getInstance()->toBinary()),
        );
    }

    public function testUnserializationWorks(): void
    {
        self::assertEquals(
            SelfSerializingDataObject::getInstance(),
            SelfSerializingDataObject::fromBinary(base64_decode(SelfSerializingDataObject::BINARY_B64)),
        );
    }
}
