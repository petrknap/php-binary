<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

interface SerializerInterface
{
    /**
     * @throws Exception\CouldNotSerializeData
     */
    public function serialize(mixed $serializable): string;

    /**
     * @throws Exception\CouldNotUnserializeData
     */
    public function unserialize(string $serialized): mixed;
}
