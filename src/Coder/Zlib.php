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

    private int $encoding;
    private int|null $level;
    private int|null $maxLength;

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

    public function encode(string $decoded, int|null $encoding = null, int|null $level = null): string
    {
        $this->encoding = $encoding ?? ZLIB_ENCODING_RAW;
        $this->level = $level;
        return parent::encode($decoded);
    }

    public function decode(string $encoded, int|null $maxLength = null): string
    {
        $this->maxLength = $maxLength;
        return parent::decode($encoded);
    }

    protected function doEncode(string $decoded): string
    {
        $encodeArgs = [
            'data' => $decoded,
            'encoding' => $this->encoding,
        ];
        if ($this->level !== null) {
            $encodeArgs['level'] = $this->level;
        }
        return OptionalString::ofFalsable(zlib_encode(...$encodeArgs))->orElseThrow(
            static fn () => new Exception\CoderCouldNotEncodeData(__METHOD__, $decoded),
        );
    }

    protected function doDecode(string $encoded): string
    {
        $decodeArgs = [
            'data' => $encoded,
        ];
        if ($this->maxLength !== null) {
            $decodeArgs['max_length'] = $this->maxLength;
        }
        return OptionalString::ofFalsable(zlib_decode(...$decodeArgs))->orElseThrow(
            static fn () => new Exception\CoderCouldNotDecodeData(__METHOD__, $encoded),
        );
    }
}
