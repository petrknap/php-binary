<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

final class Decoder extends Coder
{
    public function base64(): static
    {
        return $this->withData((new Coder\Base64())->decode(
            $this->data,
        ));
    }

    public function checksum(string|null $algorithm = null): static
    {
        return $this->withData((new Coder\Checksum())->decode(
            $this->data,
            algorithm: $algorithm,
        ));
    }

    public function hex(): static
    {
        return $this->withData((new Coder\Hex())->decode(
            $this->data,
        ));
    }

    public function xz(): static
    {
        return $this->withData((new Coder\Xz())->decode(
            $this->data,
        ));
    }

    public function zlib(int|null $maxLength = null): static
    {
        return $this->withData((new Coder\Zlib())->decode(
            $this->data,
            maxLength: $maxLength,
        ));
    }
}
