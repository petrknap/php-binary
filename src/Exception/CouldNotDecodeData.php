<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

use PetrKnap\Binary\DecoderInterface;

/**
 * @extends CouldNotCodeData<DecoderInterface>
 */
final class CouldNotDecodeData extends CouldNotCodeData implements DecoderException
{
}
