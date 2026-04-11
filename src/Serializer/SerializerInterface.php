<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

interface SerializerInterface
{
    /**
     * @template TSerializable of mixed
     *
     * @param TSerializable $serializable
     *
     * @throws Exception\SerializerCouldNotSerializeData<TSerializable>
     */
    public function serialize(mixed $serializable): string;

    /**
     * @throws Exception\SerializerCouldNotUnserializeData
     */
    public function unserialize(string $serialized): mixed;
}
