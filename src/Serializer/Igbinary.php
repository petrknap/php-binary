<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

use PetrKnap\Optional\Optional;
use PetrKnap\Optional\OptionalString;
use PetrKnap\Shorts\HasRequirements;

/**
 * @see igbinary_serialize()
 * @see igbinary_unserialize()
 */
final class Igbinary extends Serializer
{
    use HasRequirements;

    public function __construct()
    {
        self::checkRequirements(
            functions: [
                'igbinary_serialize',
                'igbinary_unserialize',
            ],
        );
    }

    protected function doSerialize(mixed $serializable): string
    {
        return OptionalString::ofFalsable(igbinary_serialize($serializable) ?? false)->orElseThrow(
            static fn () => new Exception\SerializerCouldNotSerializeData(__METHOD__, $serializable),
        );
    }

    protected function doUnserialize(string $serialized): mixed
    {
        return Optional::ofFalsable(igbinary_unserialize($serialized) ?? false)->orElseThrow(
            static fn () => new Exception\SerializerCouldNotUnserializeData(__METHOD__, $serialized),
        );
    }
}
