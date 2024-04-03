<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

use PetrKnap\Binary\HasRequirementsTrait;
use PetrKnap\Shorts\HasRequirements;

/**
 * @see igbinary_serialize()
 * @see igbinary_unserialize()
 */
final class Igbinary extends Serializer implements HasRequirements
{
    use HasRequirementsTrait;

    private const REQUIRED_FUNCTIONS = [
        'igbinary_serialize',
        'igbinary_unserialize',
    ];

    protected function doSerialize(mixed $serializable): string
    {
        $serialized = igbinary_serialize($serializable);
        if ($serialized === null) {
            throw new Exception\CouldNotSerializeData(__METHOD__, $serializable);
        }
        return $serialized;
    }

    protected function doUnserialize(string $serialized): mixed
    {
        $serializable = igbinary_unserialize($serialized);
        if ($serializable === null || $serializable === false) {
            throw new Exception\CouldNotUnserializeData(__METHOD__, $serialized);
        }
        return $serializable;
    }
}
