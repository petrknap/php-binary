<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @extends CoderInterface<Exception\CouldNotEncodeData>
 */
interface EncoderInterface extends CoderInterface
{
    public const BASE64_URL_SAFE = false;
    public const ZLIB_ENCODING = ZLIB_ENCODING_RAW;
    public const ZLIB_LEVEL = -1;

    public function base64(bool $urlSafe = self::BASE64_URL_SAFE): static;

    public function zlib(int $encoding = self::ZLIB_ENCODING, int $level = self::ZLIB_LEVEL): static;
}
