<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PHPUnit\Framework\Attributes\DataProvider;

final class BinariableTest extends TestCase
{
    public const BINARY = b'binary';

    public function testNativeConversionWorks(): void
    {
        self::assertBinarySame(
            self::BINARY,
            (string) self::getInstance(),
        );
    }

    public function testNativeComparisonWorks(): void
    {
        self::assertTrue(self::BINARY == self::getInstance());
    }

    #[DataProvider('unionTypeDataProvider')]
    public function testConversionHelperWorks(BinariableInterface|string $data): void
    {
        self::assertBinarySame(
            self::BINARY,
            Binary::asBinary($data),
        );
    }

    public static function unionTypeDataProvider(): array
    {
        $instance = self::getInstance();
        return [
            BinariableInterface::class => [$instance],
            'binary' => [$instance->toBinary()],
        ];
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
