<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder\Exception;

use PetrKnap\Shorts\Exception\CouldNotProcessData;

/**
 * @extends CouldNotProcessData<string>
 */
final class CoderCouldNotEncodeData extends CouldNotProcessData implements CoderException
{
}
