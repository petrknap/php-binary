<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

use PetrKnap\Binary\SerializerInterface;
use RuntimeException;
use Throwable;

final class CouldNotSerializeData extends RuntimeException implements SerializerException
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly mixed $data,
        ?Throwable $reason = null,
    ) {
        parent::__construct(
            sprintf(
                '%s could not serialize %s',
                $serializer::class,
                is_object($data) ? $data::class : gettype($data),
            ),
            previous: $reason,
        );
    }

    public function getSerializer(): SerializerInterface
    {
        return $this->serializer;
    }

    public function getData(): mixed
    {
        return $this->data;
    }
}
