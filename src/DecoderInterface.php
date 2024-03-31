<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @extends CoderInterface<Exception\CouldNotDecodeData>
 */
interface DecoderInterface extends CoderInterface
{
    public const ZLIB_MAX_LENGTH = 0;

    public function zlib(int $maxLength = self::ZLIB_MAX_LENGTH): static;
}
