<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use LogicException;
use PHPUnit\Framework\TestCase;

abstract class CoderTestCase extends TestCase
{
    public const DATA_BASE64 = '2jmj7l5rSw0yVb/vlWAYkK/YBwnaOaPuXmtLDTJVv++VYBiQr9gHCdo5o+5ea0sNMlW/75VgGJCv2AcJ';

    public static function getDecodedData(): string
    {
        return base64_decode(self::DATA_BASE64);
    }

    public static function getEncodedData(): string
    {
        foreach (static::data() as $data) {
            return $data[1];
        }
        throw new LogicException('Empty data set.');
    }

    abstract public static function data(): array;
}
