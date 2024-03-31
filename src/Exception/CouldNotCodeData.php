<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

use PetrKnap\Binary\CoderInterface;
use PetrKnap\Binary\DecoderInterface;
use PetrKnap\Binary\EncoderInterface;
use RuntimeException;
use Throwable;

/**
 * @template TCoder of EncoderInterface|DecoderInterface
 *
 * @implements CoderException<TCoder>
 */
abstract class CouldNotCodeData extends RuntimeException implements CoderException
{
    /**
     * @param TCoder $coder
     */
    public function __construct(
        private readonly CoderInterface $coder,
        string $method,
        ?Throwable $reason = null,
    ) {
        parent::__construct(
            sprintf(
                '%s could not code string(%d)',
                $method,
                strlen($this->coder->getData()),
            ),
            previous: $reason
        );
    }

    public function getCoder(): CoderInterface
    {
        return $this->coder;
    }
}
