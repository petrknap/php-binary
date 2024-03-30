<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use Throwable;

class Decoder extends Coder implements DecoderInterface
{
    public function base64(): static
    {
        try {
            $decoded = base64_decode(
                str_replace(self::BASE64_URL_SAFE_MAP[1], self::BASE64_URL_SAFE_MAP[0], $this->data),
                strict: true,
            );
            if ($decoded === false) {
                throw new Exception\CouldNotDecodeData($this, __METHOD__);
            }
            return static::create($this, $decoded);
        } catch (Throwable $reason) {
            throw new Exception\CouldNotDecodeData($this, __METHOD__, $reason);
        }
    }

    public function zlib(int $maxLength = self::ZLIB_MAX_LENGTH): static
    {
        try {
            $decoded = zlib_decode($this->data, $maxLength);
            if ($decoded === false) {
                throw new Exception\CouldNotDecodeData($this, __METHOD__);
            }
            return static::create($this, $decoded);
        } catch (Throwable $reason) {
            throw new Exception\CouldNotDecodeData($this, __METHOD__, $reason);
        }
    }
}
