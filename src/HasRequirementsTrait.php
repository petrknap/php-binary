<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PetrKnap\Shorts\Exception\MissingRequirement;
use PetrKnap\Shorts\HasRequirements;

/**
 * @internal
 *
 * @see HasRequirements
 */
trait HasRequirementsTrait
{
    public function __construct()
    {
        self::checkRequirements();
    }

    public static function checkRequirements(): void
    {
        foreach (self::REQUIRED_FUNCTIONS as $function) {
            if (!function_exists($function)) {
                throw new MissingRequirement(self::class, 'function', $function);
            }
        }
    }
}
