<?php declare(strict_types=1);

namespace PetrKnap\Binary;

use PetrKnap\Shorts\PhpUnit\MarkdownFileTestInterface;
use PetrKnap\Shorts\PhpUnit\MarkdownFileTestTrait;
use PHPUnit\Framework\TestCase;

class ReadmeTest extends TestCase implements MarkdownFileTestInterface
{
    use MarkdownFileTestTrait;

    public static function getPathToMarkdownFile(): string
    {
        return __DIR__ . '/../README.md';
    }

    public static function getExpectedOutputsOfPhpExamples(): iterable
    {
        return [
            'coder' => 'Data was coded into `a8vMFCssyD2Rs5BB0Evt6tJv10J_b2Aoui0tcXT69aaPP9oIyB-fLeAHAA` successfully.',
            'serializer' => 'Data was serialized into `S7QysqoutjKxUiqpLEhVsi62srRSysxNTE/VL8hLB/GBUimJJYkgpoWxlVJngJ87L5cUFwMDA6+nh0sQkGYEYQ42ICkveqQTxCkOcndiWHdO5iVYlYtjiER48o/9Ux7aM7C9Z1qixnnFBCjB4Onq57LOKaFJyboWAA==` successfully.',
        ];
    }
}
