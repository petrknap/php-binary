<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @extends CoderInterface<Coder\Exception\CouldNotDecodeData>
 */
interface DecoderInterface extends CoderInterface
{
    public function zlib(?int $maxLength = null): static;
}
