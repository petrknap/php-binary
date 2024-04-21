<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use Stringable;

interface BinariableInterface extends Stringable
{
    /**
     * @return string binary representation of this instance
     *
     * @throws Exception\CouldNotConvertToBinary
     */
    public function toBinary(): string;
}
