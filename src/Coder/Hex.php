<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

/**
 * @see bin2hex()
 * @see hex2bin()
 */
final class Hex extends Coder
{
    protected function doEncode(string $decoded): string
    {
        return bin2hex($decoded);
    }

    protected function doDecode(string $encoded): string
    {
        $decoded = hex2bin($encoded);
        if ($decoded === false) {
            throw new Exception\CouldNotDecodeData(__METHOD__, $encoded);
        }
        return $decoded;
    }
}
