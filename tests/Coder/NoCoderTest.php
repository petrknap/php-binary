<?php declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PHPUnit\Framework\Attributes\DataProvider;

final class NoCoderTest extends CoderTestCase
{
    public static function data(): array
    {
        return [[self::getDecodedData()]];
    }

    #[DataProvider('data')]
    public function testEncodes(string $data): void
    {
        self::assertSame(
            $data,
            (new NoCoder())->encode($data),
        );
    }

    #[DataProvider('data')]
    public function testDecodes(string $data): void
    {
        self::assertSame(
            $data,
            (new NoCoder())->decode($data),
        );
    }
}
