<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @psalm-require-implements BinariableInterface
 */
trait BinariableTrait
{
    /**
     * Unfortunately PHP uses string for binary data, so the magic clashes.
     */
    public function __toString(): string
    {
        $binary = $this->toBinary();
        trigger_error(
            'Returned binary string',
            error_level: E_USER_NOTICE,
        );
        return $binary;
    }
}
