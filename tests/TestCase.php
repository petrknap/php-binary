<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PHPUnit\Framework\TestCase as Base;

abstract class TestCase extends Base
{
    /**
     * {@see self::assertSame()} but with internal conversion to hexadecimal
     */
    final protected static function assertBinarySame(string $expected, string $actual): void
    {
        self::assertSame(bin2hex($expected), bin2hex($actual));
    }
}
