<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PetrKnap\Optional\OptionalString;
use PetrKnap\Shorts\HasRequirements;

/**
 * @see zlib_encode()
 * @see zlib_decode()
 */
final class Zlib extends Coder
{
    use HasRequirements;

    public const ENCODING = ZLIB_ENCODING_RAW;
    public const LEVEL = -1;
    public const MAX_LENGTH = 0;

    private int $encoding;
    private int $level;
    private int $maxLength;

    public function __construct()
    {
        self::checkRequirements(
            functions: [
                'zlib_encode',
                'zlib_decode',
            ],
            constants: [
                'ZLIB_ENCODING_RAW',
            ],
        );
    }

    public function encode(string $decoded, ?int $encoding = null, ?int $level = null): string
    {
        $this->encoding = $encoding ?? self::ENCODING;
        $this->level = $level ?? self::LEVEL;
        return parent::encode($decoded);
    }

    public function decode(string $encoded, ?int $maxLength = null): string
    {
        $this->maxLength = $maxLength ?? self::MAX_LENGTH;
        return parent::decode($encoded);
    }

    protected function doEncode(string $decoded): string
    {
        return OptionalString::ofFalsable(zlib_encode($decoded, $this->encoding, $this->level))->orElseThrow(
            static fn () => new Exception\CouldNotEncodeData(__METHOD__, $decoded),
        );
    }

    protected function doDecode(string $encoded): string
    {
        return OptionalString::ofFalsable(zlib_decode($encoded, $this->maxLength))->orElseThrow(
            static fn () => new Exception\CouldNotDecodeData(__METHOD__, $encoded),
        );
    }
}
