<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

interface SerializerInterface
{
    /**
     * @throws Exception\SerializerCouldNotSerializeData
     */
    public function serialize(mixed $serializable): string;

    /**
     * @throws Exception\SerializerCouldNotUnserializeData
     */
    public function unserialize(string $serialized): mixed;
}
