<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer\Exception;

use PetrKnap\Binary\Exception\CouldNotProcessData;

/**
 * @template TData of mixed
 *
 * @extends CouldNotProcessData<TData>
 */
final class SerializerCouldNotSerializeData extends CouldNotProcessData implements SerializerException
{
}
