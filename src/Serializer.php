<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @see Coder\Zlib
 * @see Serializer\Php
 */
final class Serializer extends Serializer\Serializer
{
    protected readonly Coder\CoderInterface $coder;
    protected readonly Serializer\SerializerInterface $serializer;

    public function __construct(
        Coder\CoderInterface|null $coder = null,
        Serializer\SerializerInterface|null $serializer = null,
    ) {
        $this->coder = $coder ?? new Coder\Zlib();
        $this->serializer = $serializer ?? new Serializer\Php();
    }

    protected function doSerialize(mixed $serializable): string
    {
        return $this->coder->encode($this->serializer->serialize($serializable));
    }

    protected function doUnserialize(string $serialized): mixed
    {
        return $this->serializer->unserialize($this->coder->decode($serialized));
    }
}
