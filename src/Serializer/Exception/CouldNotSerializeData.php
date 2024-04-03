<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer\Exception;

use PetrKnap\Shorts\Exception\CouldNotProcessData;

/**
 * @extends CouldNotProcessData<mixed>
 */
final class CouldNotSerializeData extends CouldNotProcessData implements SerializerException
{
}
