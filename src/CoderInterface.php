<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @template TExceptionCouldNotCodeData of Exception\CouldNotCodeData
 */
interface CoderInterface
{
    public const CHECKSUM_ALGORITHM = 'crc32';

    public function getData(): string;

    /**
     * {@see base64_encode()}/{@see base64_decode()} the data
     *
     * @link https://en.wikipedia.org/wiki/Base64
     *
     * @throws TExceptionCouldNotCodeData
     */
    public function base64(): static;

    /**
     * Encodes/decodes the data {@see hash()} into the data
     *
     * @link https://en.wikipedia.org/wiki/Checksum
     *
     * @throws TExceptionCouldNotCodeData
     */
    public function checksum(string $algorithm = self::CHECKSUM_ALGORITHM): static;

    /**
     * {@see zlib_encode()}/{@see zlib_decode()} the data
     *
     * @link https://en.wikipedia.org/wiki/Zlib
     *
     * @throws TExceptionCouldNotCodeData
     */
    public function zlib(): static;
}
