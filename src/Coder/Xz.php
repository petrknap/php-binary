<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PetrKnap\Shorts\HasRequirements;
use PetrKnap\XzUtils\Xz as Inner;

final class Xz extends Coder
{
    use HasRequirements;

    private int|null $compressionPreset;

    public function __construct()
    {
        self::checkRequirements(
            classes: [
                Inner::class,
            ],
        );
    }

    public function encode(string $decoded, int|null $compressionPreset = null): string
    {
        $this->compressionPreset = $compressionPreset;
        return parent::encode($decoded);
    }

    protected function doEncode(string $decoded): string
    {
        return (new Inner())->compress(
            data: $decoded,
            compressionPreset: $this->compressionPreset,
        );
    }

    protected function doDecode(string $encoded): string
    {
        return (new Inner())->decompress(
            data: $encoded,
        );
    }
}
