<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

interface CoderInterface
{
    /**
     * @throws Exception\CoderCouldNotEncodeData
     */
    public function encode(string $decoded): string;

    /**
     * @throws Exception\CoderCouldNotDecodeData
     */
    public function decode(string $encoded): string;
}
