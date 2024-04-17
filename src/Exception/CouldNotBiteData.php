<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

use PetrKnap\Shorts\Exception\CouldNotProcessData;

/**
 * @extends CouldNotProcessData<string>
 */
final class CouldNotBiteData extends CouldNotProcessData implements ByterException
{
}
