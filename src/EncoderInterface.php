<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @extends CoderInterface<Coder\Exception\CouldNotEncodeData>
 */
interface EncoderInterface extends CoderInterface
{
    public function base64(?bool $urlSafe = null): static;

    public function zlib(?int $encoding = null, ?int $level = null): static;
}
