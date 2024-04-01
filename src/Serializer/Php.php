<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

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
        $serializable = unserialize($serialized);
        if ($serializable === false) {
            throw throw new Exception\CouldNotUnserializeData(__METHOD__, $serialized);
        }
        return $serializable;
    }
}
