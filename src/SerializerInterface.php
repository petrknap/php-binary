<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

interface SerializerInterface
{
    /**
     * {@see serialize()} the serializable
     *
     * @throws Exception\CouldNotSerializeData
     */
    public function serialize(mixed $serializable): string;

    /**
     * {@see unserialize()} the serialized
     *
     * @throws Exception\CouldNotUnserializeData
     */
    public function unserialize(string $serialized): mixed;
}
