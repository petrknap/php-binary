<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

use PetrKnap\Binary\EncoderInterface;

/**
 * @extends CoderException<EncoderInterface>
 */
interface EncoderException extends CoderException
{
}
