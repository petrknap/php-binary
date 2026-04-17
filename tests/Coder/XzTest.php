<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PHPUnit\Framework\Attributes\DataProvider;

final class XzTest extends CoderTestCase
{
    public static function data(): array
    {
        $data = self::getDecodedData();
        return [
            'default compression preset' => [$data, base64_decode('/Td6WFoAAATm1rRGBMAkPCEBFgAAAAAAAAAAAPuWV53gADsAHF0AbQ5QbuMJR8+PTPTyAls/0qC2EgdL+OAsyTjgAADBW9je9POxmwABQDyphpD/H7bzfQEAAAAABFla'), null],
            'compression preset 0' => [$data, base64_decode('/Td6WFoAAATm1rRGA8AkPCEBDAAAAAAAhAE4x+AAOwAcXQBtDlBu4wlHz49M9PICWz/SoLYSB0v44CzJOOAAAMFb2N7087GbAAE8PFOwGnwftvN9AQAAAAAEWVo='), 0],
            'compression preset 9' => [$data, base64_decode('/Td6WFoAAATm1rRGBMAkPCEBHAAAAAAAAAAAADIGdYrgADsAHF0AbQ5QbuMJR8+PTPTyAls/0qC2EgdL+OAsyTjgAADBW9je9POxmwABQDyphpD/H7bzfQEAAAAABFla'), 9],
        ];
    }

    #[DataProvider('data')]
    public function testEncodes(string $decoded, string $encoded, int|null $compressionPreset): void
    {
        self::assertBinarySame(
            $encoded,
            (new Xz())->encode(
                $decoded,
                compressionPreset: $compressionPreset,
            ),
        );
    }

    #[DataProvider('data')]
    public function testDecodes(string $decoded, string $encoded): void
    {
        self::assertBinarySame(
            $decoded,
            (new Xz())->decode(
                $encoded,
            ),
        );
    }
}
