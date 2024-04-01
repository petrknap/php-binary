<?php declare(strict_types=1);

namespace PetrKnap\Binary;

use PetrKnap\Shorts\Exception\MissingRequirement;
use PHPUnit\Framework\TestCase;

/**
 * @todo add php-igbinary to Dockerfile
 * @todo add ext-igbinary to composer.json#require-dev
 */
final class IgbinarySerializerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        try {
            IgbinarySerializer::checkRequirements();
        } catch (MissingRequirement $reason) {
            self::markTestSkipped($reason->getMessage());
        }
    }

    public function testSerializesData(): void
    {
        SerializerTest::doTestSerializesData(
            new IgbinarySerializer(
                new Encoder(),
                new Decoder(),
            ),
        );
    }
}
