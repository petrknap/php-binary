<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use PetrKnap\Binary\HasRequirementsTrait;
use PetrKnap\Shorts\HasRequirements;

/**
 * @see hash()
 *
 * @link https://en.wikipedia.org/wiki/Checksum
 */
final class Checksum extends Coder implements HasRequirements
{
    use HasRequirementsTrait;

    public const ALGORITHM = 'crc32';
    private const REQUIRED_FUNCTIONS = [
        'mb_strlen',
        'mb_strcut',
    ];

    private string $algorithm;

    public function __construct()
    {
        self::checkRequirements();
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
        return $decoded . $checksum;
    }

    protected function doDecode(string $encoded): string
    {
        $checksumLength = mb_strlen(hash($this->algorithm, '', binary: true), encoding: '8bit');
        $dataLength = mb_strlen($encoded, encoding: '8bit') - $checksumLength;
        $decoded = mb_strcut($encoded, 0, $dataLength, encoding: '8bit');
        if ($this->doEncode($decoded) !== $encoded) {
            throw new Exception\CouldNotDecodeData(__METHOD__, $encoded);
        }
        return $decoded;
    }
}
