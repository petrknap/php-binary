<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PHPUnit\Framework\TestCase;

final class BinariableTest extends TestCase
{
    public const DATA = b'data';

    public function testExplicitConversionWorks(): void
    {
        self::assertSame(
            self::DATA,
            self::getBinariable()->toBinary(),
        );
    }

    public function testNativeConversionWorks(): void
    {
        self::assertSame(
            self::DATA,
            (string) self::getBinariable(),
        );
    }

    public function testNativeComparisonWorks(): void
    {
        self::assertTrue(self::DATA == self::getBinariable());
    }

    public function testUnionTypingWorks(): void
    {
        $function = static fn (BinariableInterface|string $parameter): string => (string) $parameter;

        self::assertSame(
            self::DATA,
            $function(self::getBinariable()),
        );
    }

    private function getBinariable(): BinariableInterface
    {
        return new class () implements BinariableInterface {
            use BinariableTrait;

            public function toBinary(): string
            {
                return BinariableTest::DATA;
            }
        };
    }
}
