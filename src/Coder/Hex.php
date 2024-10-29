<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PetrKnap\Optional\OptionalString;

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
        return OptionalString::ofFalsable(hex2bin($encoded))->orElseThrow(
            static fn () => new Exception\CoderCouldNotDecodeData(__METHOD__, $encoded),
        );
    }
}
