<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @see https://datatracker.ietf.org/doc/html/rfc20
 */
enum Ascii: string
{
    public const FILE_SEPARATOR = "\x1C";
    public const GROUP_SEPARATOR = "\x1D";
    public const NULL = "\x00";
    public const RECORD_SEPARATOR = "\x1E";
    public const UNIT_SEPARATOR = "\x1F";

    case FileSeparator = self::FILE_SEPARATOR;
    case GroupSeparator = self::GROUP_SEPARATOR;
    case Null = self::NULL;
    case RecordSeparator = self::RECORD_SEPARATOR;
    case UnitSeparator = self::UNIT_SEPARATOR;

    /**
     * @see implode()
     */
    public function join(string $element1, string ...$elementN): string
    {
        return implode($this->value, [$element1, ...$elementN]);
    }
}
