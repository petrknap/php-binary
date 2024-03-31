<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @template TExceptionCouldNotCodeData of Exception\CouldNotCodeData
 */
interface CoderInterface
{
    public function getData(): string;

    /**
     * {@see base64_encode()}/{@see base64_decode()} data
     *
     * @link https://en.wikipedia.org/wiki/Base64
     *
     * @throws TExceptionCouldNotCodeData
     */
    public function base64(): static;

    /**
     * {@see zlib_encode()}/{@see zlib_decode()} data
     *
     * @link https://en.wikipedia.org/wiki/Zlib
     *
     * @throws TExceptionCouldNotCodeData
     */
    public function zlib(): static;
}
