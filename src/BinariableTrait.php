<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PetrKnap\Shorts\Exception\NotImplemented;

trait BinariableTrait
{
    /**
     * Unfortunately PHP uses string for binary data, so the magic clashes.
     */
    public function __toString(): string
    {
        if (!($this instanceof BinariableInterface)) {
            NotImplemented::throw(BinariableInterface::class);
        }

        $binary = $this->toBinary();
        trigger_error(
            'Returned binary string',
            error_level: E_USER_NOTICE,
        );
        return $binary;
    }
}
