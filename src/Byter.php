<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PetrKnap\Shorts\HasRequirements;
use RuntimeException;

final class Byter
{
    use HasRequirements;

    private const ENCODING = '8bit';

    public function __construct()
    {
        self::checkRequirements(
            functions: [
                'mb_strcut',
                'mb_strlen',
            ],
        );
    }

    /**
     * @param int $size1 size of bite in bytes; if negative, bites from the end
     *
     * @return array<string> bites of specified sizes; and remains, if any
     *
     * @throws Exception\ByterCouldNotBiteData
     */
    public function bite(string $data, int $size1, int ...$sizeN): array
    {
        $remains = $data;
        $bites = [];
        foreach ([$size1, ...$sizeN] as $size) {
            if (abs($size) > $this->size($remains)) {
                throw new Exception\ByterCouldNotBiteData(__METHOD__, $data, new RuntimeException(
                    'Remains are smaller than bite',
                ));
            }
            $bite = mb_strcut($remains, 0, $size, encoding: self::ENCODING);
            $remains = mb_strcut($remains, $size, encoding: self::ENCODING);
            if ($size < 0) {
                $bites[] = $remains;
                $remains = $bite;
            } else {
                $bites[] = $bite;
            }
        }
        if ($remains !== '') {
            $bites[] = $remains;
        }
        return $bites;
    }

    /**
     * Backward version of {@see self::bite()}
     *
     * @link https://en.wikipedia.org/wiki/Backwards_(Red_Dwarf)
     */
    public function unbite(string $bite1, string ...$biteN): string
    {
        return implode([$bite1, ...$biteN]);
    }

    /**
     * @return int size in bytes
     */
    public function size(string $data): int
    {
        return mb_strlen($data, encoding: self::ENCODING);
    }
}
