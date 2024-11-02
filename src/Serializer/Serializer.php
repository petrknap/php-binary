<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

use Throwable;

/**
 * @internal shared logic
 */
abstract class Serializer implements SerializerInterface
{
    public function serialize(mixed $serializable): string
    {
        try {
            return $this->doSerialize($serializable);
        } catch (Exception\SerializerCouldNotSerializeData $exception) {
            throw $exception;
        } catch (Throwable $reason) {
            throw new Exception\SerializerCouldNotSerializeData(__METHOD__, $serializable, $reason);
        }
    }

    public function unserialize(string $serialized): mixed
    {
        try {
            return $this->doUnserialize($serialized);
        } catch (Exception\SerializerCouldNotUnserializeData $exception) {
            throw $exception;
        } catch (Throwable $reason) {
            throw new Exception\SerializerCouldNotUnserializeData(__METHOD__, $serialized, $reason);
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
