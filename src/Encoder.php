<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

class Encoder extends Coder implements EncoderInterface
{
    public function base64(?bool $urlSafe = null): static
    {
        return static::create($this, (new Coder\Base64())->encode(
            $this->data,
            urlSafe: $urlSafe,
        ));
    }

    public function checksum(?string $algorithm = null): static
    {
        return static::create($this, (new Coder\Checksum())->encode(
            $this->data,
            algorithm: $algorithm,
        ));
    }

    public function zlib(?int $encoding = null, ?int $level = null): static
    {
        return static::create($this, (new Coder\Zlib())->encode(
            $this->data,
            encoding: $encoding,
            level: $level,
        ));
    }
}
