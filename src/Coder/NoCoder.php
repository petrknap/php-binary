<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

/**
 * Special implementation of {@see CoderInterface} which does not code
 */
final class NoCoder implements CoderInterface
{
    public function encode(string $decoded): string
    {
        return $decoded;
    }

    public function decode(string $encoded): string
    {
        return $encoded;
    }
}
