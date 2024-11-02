<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PHPUnit\Framework\Attributes\DataProvider;

final class ByterTest extends TestCase
{
    #[DataProvider('dataBitesData')]
    public function testBitesData(array $expected, array $sizes): void
    {
        self::assertSame(
            $expected,
            (new Byter())->bite(self::getData(), ...$sizes),
        );
    }

    public static function dataBitesData(): array
    {
        return [
            'one left bite' => [[hex2bin('0102'), hex2bin('030405')], [2]],
            'one right bite' => [[hex2bin('0405'), hex2bin('010203')], [-2]],
            'empty bite' => [['', hex2bin('0102030405')], [0]],
            'full bite' => [[hex2bin('0102030405')], [5]],
            'many bites' => [[hex2bin('0102'), hex2bin('0405'), '', hex2bin('03')], [2, -2, 0, 1]],
        ];
    }

    public function testBiteThrowsWhenThereIsNotEnoughData(): void
    {
        self::expectException(Exception\ByterCouldNotBiteData::class);

        $data = self::getData();
        $byter = new Byter();
        $byter->bite(
            $data,
            $byter->size($data) + 1,
        );
    }

    public function testUnbitesBites(): void
    {
        self::assertBinarySame(
            self::getData(),
            (new Byter())->unbite(hex2bin('0102'), hex2bin('030405')),
        );
    }

    public function testReturnsSizeOfData(): void
    {
        self::assertSame(
            5,
            (new Byter())->size(self::getData()),
        );
    }

    private static function getData(): string
    {
        return hex2bin('0102030405');
    }
}
