<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

/**
 * @see base64_encode()
 * @see base64_decode()
 */
final class Base64 extends Coder
{
    public const URL_SAFE = false;
    private const URL_REPLACE_TABLE = [
        ['+', '/', '='],
        ['-', '_', ''],
    ];

    private bool $urlSafe;

    public function encode(string $decoded, ?bool $urlSafe = null): string
    {
        $this->urlSafe = $urlSafe ?? self::URL_SAFE;
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
        $decoded = base64_decode(
            str_replace(self::URL_REPLACE_TABLE[1], self::URL_REPLACE_TABLE[0], $encoded),
            strict: true,
        );
        if ($decoded === false) {
            throw new Exception\CouldNotDecodeData(__METHOD__, $encoded);
        }
        return $decoded;
    }
}
