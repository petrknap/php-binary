<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

use PetrKnap\Binary\DecoderInterface;

/**
 * @extends CoderException<DecoderInterface>
 */
interface DecoderException extends CoderException
{
}
