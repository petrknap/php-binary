<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @see https://datatracker.ietf.org/doc/html/rfc20
 *
 * @todo upgrade to PHP 8.2, move values to cases and move `values of cases` region under `groups of cases` region
 */
enum Ascii: string
{
    #region values of cases
    public const FILE_SEPARATOR = "\x1C";
    public const GROUP_SEPARATOR = "\x1D";
    public const NULL = "\x00";
    public const RECORD_SEPARATOR = "\x1E";
    public const UNIT_SEPARATOR = "\x1F";
    #endregion

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

    #region groups of cases
    /**
     * Used to separate and qualify information in a logical sense
     */
    public const INFORMATION_SEPARATORS = [
        self::FileSeparator,
        self::GroupSeparator,
        self::RecordSeparator,
        self::UnitSeparator,
    ];
    #endregion

    /**
     * @see implode()
     */
    public function join(string $element1, string ...$elementN): string
    {
        return implode($this->value, [$element1, ...$elementN]);
    }
}
