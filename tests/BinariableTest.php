<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PHPUnit\Framework\TestCase;

final class BinariableTest extends TestCase
{
    public const BINARY = b'binary';

    public function testNativeConversionWorks(): void
    {
        self::assertSame(
            self::BINARY,
            (string) self::getInstance(),
        );
    }

    public function testNativeComparisonWorks(): void
    {
        self::assertTrue(self::BINARY == self::getInstance());
    }

    public function testUnionTypingWorks(): void
    {
        $function = static fn (BinariableInterface|string $parameter): string => (string) $parameter;

        self::assertSame(
            self::BINARY,
            $function(self::getInstance()),
        );
    }

    private static function getInstance(): BinariableInterface
    {
        return new class () implements BinariableInterface {
            use BinariableTrait;

            public function toBinary(): string
            {
                return BinariableTest::BINARY;
            }
        };
    }
}
