<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use Throwable;

class Serializer implements SerializerInterface
{
    public function __construct(
        protected readonly EncoderInterface $encoder,
        protected readonly DecoderInterface $decoder,
    ) {
    }

    public function serialize(mixed $serializable): string
    {
        try {
            $serialized = $this->doSerialize($serializable);
            return $this->encoder->withData($serialized)->zlib()->getData();
        } catch (Throwable $reason) {
            throw new Exception\CouldNotSerializeData($this, $serializable, $reason);
        }
    }

    public function unserialize(string $serialized): mixed
    {
        try {
            $serialized = $this->decoder->withData($serialized)->zlib()->getData();
            return $this->doUnserialize($serialized);
        } catch (Throwable $reason) {
            throw new Exception\CouldNotUnserializeData($this, $serialized, $reason);
        }
    }

    /**
     * Alternative to {@see serialize()}
     *
     * @throws Throwable
     */
    protected function doSerialize(mixed $serializable): string
    {
        return serialize($serializable);
    }

    /**
     * Alternative to {@see unserialize()}
     *
     * @throws Throwable
     */
    protected function doUnserialize(string $serialized): mixed
    {
        return unserialize($serialized);
    }
}
