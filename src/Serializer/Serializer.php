<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

use Throwable;

abstract class Serializer implements SerializerInterface
{
    public function serialize(mixed $serializable): string
    {
        try {
            return $this->doSerialize($serializable);
        } catch (Throwable $reason) {
            if ($reason instanceof Exception\CouldNotSerializeData) {
                throw $reason;
            }
            throw new Exception\CouldNotSerializeData(__METHOD__, $serializable, $reason);
        }
    }

    public function unserialize(string $serialized): mixed
    {
        try {
            return $this->doUnserialize($serialized);
        } catch (Throwable $reason) {
            if ($reason instanceof Exception\CouldNotUnserializeData) {
                throw $reason;
            }
            throw new Exception\CouldNotUnserializeData(__METHOD__, $serialized, $reason);
        }
    }

    /**
     * @throws Throwable
     */
    abstract protected function doSerialize(mixed $serializable): string;

    /**
     * @throws Throwable
     */
    abstract protected function doUnserialize(string $serialized): mixed;
}
