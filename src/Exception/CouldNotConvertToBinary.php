<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

use PetrKnap\Shorts\Exception\CouldNotProcessData;

/**
 * @extends CouldNotProcessData<object>
 */
final class CouldNotConvertToBinary extends CouldNotProcessData implements BinariableException
{
}
