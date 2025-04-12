<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @see https://datatracker.ietf.org/doc/html/rfc20
 *
 * @todo upgrade to PHP 8.2 and move values to cases
 */
enum Ascii: string
{
    public const FILE_SEPARATOR = "\x1C";
    public const GROUP_SEPARATOR = "\x1D";
    public const NULL = "\x00";
    public const RECORD_SEPARATOR = "\x1E";
    public const UNIT_SEPARATOR = "\x1F";

    /**
     * Separates different files (databases)
     */
    case FileSeparator = self::FILE_SEPARATOR;
    /**
     * Separates different groups (tables) of the same file (database)
     */
    case GroupSeparator = self::GROUP_SEPARATOR;
    case Null = self::NULL;
    /**
     * Separates different records (rows) of the same group (table)
     */
    case RecordSeparator = self::RECORD_SEPARATOR;
    /**
     * Separates different units (columns) of the same record (row)
     */
    case UnitSeparator = self::UNIT_SEPARATOR;

    /**
     * @see implode()
     */
    public function join(string $element1, string ...$elementN): string
    {
        return implode($this->value, [$element1, ...$elementN]);
    }
}
