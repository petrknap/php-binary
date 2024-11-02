<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @internal shared logic
 */
abstract class Coder
{
    final public function __construct(
        public readonly string $data = '',
    ) {
    }

    final public function withData(string $data): static
    {
        return new static($data);
    }

    /**
     * @deprecated use readonly property $data
     */
    final public function getData(): string
    {
        return $this->data;
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
}
