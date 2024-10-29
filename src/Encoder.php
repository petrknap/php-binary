<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

final class Encoder extends Coder
{
    public function base64(bool|null $urlSafe = null): static
    {
        return $this->withData((new Coder\Base64())->encode(
            $this->data,
            urlSafe: $urlSafe,
        ));
    }

    public function checksum(string|null $algorithm = null): static
    {
        return $this->withData((new Coder\Checksum())->encode(
            $this->data,
            algorithm: $algorithm,
        ));
    }

    public function hex(): static
    {
        return $this->withData((new Coder\Hex())->encode(
            $this->data,
        ));
    }

    public function zlib(int|null $encoding = null, int|null $level = null): static
    {
        return $this->withData((new Coder\Zlib())->encode(
            $this->data,
            encoding: $encoding,
            level: $level,
        ));
    }
}
