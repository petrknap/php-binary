<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

interface CoderInterface
{
    /**
     * @throws Exception\CouldNotEncodeData
     */
    public function encode(string $decoded): string;

    /**
     * @throws Exception\CouldNotDecodeData
     */
    public function decode(string $encoded): string;
}
