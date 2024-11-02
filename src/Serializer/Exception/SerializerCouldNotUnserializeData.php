<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer\Exception;

use PetrKnap\Shorts\Exception\CouldNotProcessData;

/**
 * @extends CouldNotProcessData<string>
 */
final class SerializerCouldNotUnserializeData extends CouldNotProcessData implements SerializerException
{
}
