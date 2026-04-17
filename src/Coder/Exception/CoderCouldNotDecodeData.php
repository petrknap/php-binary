<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder\Exception;

use PetrKnap\Binary\Exception\CouldNotProcessData;

/**
 * @extends CouldNotProcessData<string>
 */
final class CoderCouldNotDecodeData extends CouldNotProcessData implements CoderException
{
}
