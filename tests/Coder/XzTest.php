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
            'default compression preset' => [$data, base64_decode('/Td6WFoAAATm1rRGAgAhARYAAAB0L+Wj4AA7ABxdAG0OUG7jCUfPj0z08gJbP9KgthIHS/jgLMk44AAAwVvY3vTzsZsAATg8V3V2GB+2830BAAAAAARZWg=='), null],
            'compression preset 0' => [$data, base64_decode('/Td6WFoAAATm1rRGAgAhAQwAAACPmEGc4AA7ABxdAG0OUG7jCUfPj0z08gJbP9KgthIHS/jgLMk44AAAwVvY3vTzsZsAATg8V3V2GB+2830BAAAAAARZWg=='), 0],
            'compression preset 9' => [$data, base64_decode('/Td6WFoAAATm1rRGAgAhARwAAAAQz1jM4AA7ABxdAG0OUG7jCUfPj0z08gJbP9KgthIHS/jgLMk44AAAwVvY3vTzsZsAATg8V3V2GB+2830BAAAAAARZWg=='), 9],
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
