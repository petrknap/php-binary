<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

use PetrKnap\Binary\EncoderInterface;

/**
 * @extends CouldNotCodeData<EncoderInterface>
 */
final class CouldNotEncodeData extends CouldNotCodeData implements EncoderException
{
}
