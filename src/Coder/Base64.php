<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PetrKnap\Optional\OptionalString;

/**
 * @see base64_encode()
 * @see base64_decode()
 */
final class Base64 extends Coder
{
    private const URL_REPLACE_TABLE = [
        ['+', '/', '='],
        ['-', '_', ''],
    ];

    private bool $urlSafe;

    public function encode(string $decoded, bool|null $urlSafe = null): string
    {
        $this->urlSafe = $urlSafe ?? false;
        return parent::encode($decoded);
    }

    protected function doEncode(string $decoded): string
    {
        $encoded = base64_encode($decoded);
        if ($this->urlSafe) {
            $encoded = str_replace(self::URL_REPLACE_TABLE[0], self::URL_REPLACE_TABLE[1], $encoded);
        }
        return $encoded;
    }

    protected function doDecode(string $encoded): string
    {
        return OptionalString::ofFalsable(base64_decode(
            str_replace(self::URL_REPLACE_TABLE[1], self::URL_REPLACE_TABLE[0], $encoded),
            strict: true,
        ))->orElseThrow(
            static fn () => new Exception\CoderCouldNotDecodeData(__METHOD__, $encoded),
        );
    }
}
