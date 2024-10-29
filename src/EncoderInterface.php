<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @extends CoderInterface<Coder\Exception\CouldNotEncodeData>
 */
interface EncoderInterface extends CoderInterface
{
    public function base64(bool|null $urlSafe = null): static;

    public function zlib(int|null $encoding = null, int|null $level = null): static;
}
