<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use Stringable;

/**
 * @internal shared logic
 */
abstract class Coder implements Stringable
{
    /**
     * @param string $data may contain binary data
     */
    final public function __construct(
        public readonly string $data = '',
    ) {
    }

    final public function withData(string $data): static
    {
        return new static($data);
    }

    /**
     * @see Coder\Base64
     *
     * @throws Coder\Exception\CoderException
     */
    abstract public function base64(): static;

    /**
     * @see Coder\Checksum
     *
     * @throws Coder\Exception\CoderException
     */
    abstract public function checksum(string|null $algorithm = null): static;

    /**
     * @see Coder\Hex
     *
     * @throws Coder\Exception\CoderException
     */
    abstract public function hex(): static;

    /**
     * @see Coder\Xz
     *
     * @throws Coder\Exception\CoderException
     */
    abstract public function xz(): static;

    /**
     * @see Coder\zlib
     *
     * @throws Coder\Exception\CoderException
     */
    abstract public function zlib(): static;

    /**
     * @note this is just a helper, this class is not supposed to implement {@see BinariableInterface}
     */
    public function __toString(): string
    {
        return $this->data;
    }
}
