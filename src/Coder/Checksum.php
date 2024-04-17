<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PetrKnap\Binary\Byter;

/**
 * @see hash()
 *
 * @link https://en.wikipedia.org/wiki/Checksum
 */
final class Checksum extends Coder
{
    public const ALGORITHM = 'crc32';

    private string $algorithm;
    private readonly Byter $byter;

    public function __construct()
    {
        $this->byter = new Byter();
    }

    public function encode(string $decoded, ?string $algorithm = null): string
    {
        $this->algorithm = $algorithm ?? self::ALGORITHM;
        return parent::encode($decoded);
    }

    public function decode(string $encoded, ?string $algorithm = null): string
    {
        $this->algorithm = $algorithm ?? self::ALGORITHM;
        return parent::decode($encoded);
    }

    protected function doEncode(string $decoded): string
    {
        $checksum = hash($this->algorithm, $decoded, binary: true);
        return $this->byter->unbite($decoded, $checksum);
    }

    protected function doDecode(string $encoded): string
    {
        $checksumLength = $this->byter->size(hash($this->algorithm, '', binary: true));
        [,$decoded] = $this->byter->bite($encoded, -$checksumLength);
        if ($this->doEncode($decoded) !== $encoded) {
            throw new Exception\CouldNotDecodeData(__METHOD__, $encoded);
        }
        return $decoded;
    }
}
