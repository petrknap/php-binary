<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

class Decoder extends Coder implements DecoderInterface
{
    public function base64(): static
    {
        return static::create($this, (new Coder\Base64())->decode(
            $this->data,
        ));
    }

    public function checksum(?string $algorithm = null): static
    {
        return static::create($this, (new Coder\Checksum())->decode(
            $this->data,
            algorithm: $algorithm,
        ));
    }

    public function hex(): static
    {
        return static::create($this, (new Coder\Hex())->decode(
            $this->data,
        ));
    }

    public function zlib(?int $maxLength = null): static
    {
        return static::create($this, (new Coder\Zlib())->decode(
            $this->data,
            maxLength: $maxLength,
        ));
    }
}
