<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

use PetrKnap\Optional\Optional;

/**
 * @see serialize()
 * @see unserialize()
 */
final class Php extends Serializer
{
    protected function doSerialize(mixed $serializable): string
    {
        return serialize($serializable);
    }

    protected function doUnserialize(string $serialized): mixed
    {
        return Optional::ofFalsable(unserialize($serialized))->orElseThrow(
            static fn () => new Exception\CouldNotUnserializeData(__METHOD__, $serialized),
        );
    }
}
