<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

use PetrKnap\Binary\SerializerInterface;
use RuntimeException;
use Throwable;

final class CouldNotUnserializeData extends RuntimeException implements SerializerException
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly string $data,
        ?Throwable $reason = null,
    ) {
        parent::__construct(
            sprintf(
                '%s could not unserialize string(%d)',
                $serializer::class,
                strlen($data)
            ),
            previous: $reason,
        );
    }

    public function getSerializer(): SerializerInterface
    {
        return $this->serializer;
    }

    public function getData(): string
    {
        return $this->data;
    }
}
