<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use Throwable;

class Encoder extends Coder implements EncoderInterface
{
    public function base64(bool $urlSafe = self::BASE64_URL_SAFE): static
    {
        try {
            $encoded = base64_encode($this->data);
            if ($urlSafe) {
                $encoded = str_replace(self::BASE64_URL_SAFE_MAP[0], self::BASE64_URL_SAFE_MAP[1], $encoded);
            }
            return static::create($this, $encoded);
        } catch (Throwable $reason) {
            throw new Exception\CouldNotEncodeData($this, __METHOD__, $reason);
        }
    }

    public function checksum(string $algorithm = self::CHECKSUM_ALGORITHM): static
    {
        try {
            $checksum = hash($algorithm, $this->data, binary: true);
            return static::create($this, $this->data . $checksum);
        } catch (Throwable $reason) {
            throw new Exception\CouldNotEncodeData($this, __METHOD__, $reason);
        }
    }

    public function zlib(int $encoding = self::ZLIB_ENCODING, int $level = self::ZLIB_LEVEL): static
    {
        try {
            $encoded = zlib_encode($this->data, $encoding, $level);
            if ($encoded === false) {
                throw new Exception\CouldNotEncodeData($this, __METHOD__);
            }
            return static::create($this, $encoded);
        } catch (Throwable $reason) {
            throw new Exception\CouldNotEncodeData($this, __METHOD__, $reason);
        }
    }
}
