<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

/**
 * @extends CouldNotProcessData<string>
 */
final class ByterCouldNotBiteData extends CouldNotProcessData implements ByterException
{
}
