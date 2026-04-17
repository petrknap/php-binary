<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

use RuntimeException;
use Throwable;

/**
 * @note this is public helper, this class is not supposed to implement {@see Exception}
 *
 * @template TData of mixed
 */
abstract class CouldNotProcessData extends RuntimeException
{
    /**
     * @param non-empty-string $method
     * @param TData $data may contain binary data
     */
    public function __construct(
        string $method,
        public readonly mixed $data,
        public readonly Throwable|null $reason = null,
    ) {
        parent::__construct(
            message: sprintf(
                '%s could not process %s',
                $method,
                is_string($data) ? sprintf('string(%d)', strlen($data)) : (is_object($data) ? get_class($data) : gettype($data)),
            ),
            previous: $reason
        );
    }
}
