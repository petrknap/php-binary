<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PetrKnap\Shorts\Exception;

/**
 * @internal please use subinterface
 *
 * @template TExceptionCouldNotProcessData of Exception\CouldNotProcessData
 */
interface CoderInterface
{
    public function withData(string $data): static;

    public function getData(): string;

    /**
     * @see Coder\Base64
     *
     * @throws TExceptionCouldNotProcessData
     */
    public function base64(): static;

    /**
     * @see Coder\Checksum
     *
     * @throws TExceptionCouldNotProcessData
     */
    public function checksum(?string $algorithm = null): static;

    /**
     * @see Coder\Hex
     *
     * @throws TExceptionCouldNotProcessData
     */
    public function hex(): static;

    /**
     * @see Coder\zlib
     *
     * @throws TExceptionCouldNotProcessData
     */
    public function zlib(): static;
}
