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
            'coders' => 'Data was coded into `a8vMFCssyD2Rs5BB0Evt6tJv10J_b2Aoui0tcXT69aaPP9oIyB-fLeAHAA` successfully.',
        ];
    }
}
