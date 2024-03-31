<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

use PetrKnap\Binary\CoderInterface;
use PetrKnap\Binary\DecoderInterface;
use PetrKnap\Binary\EncoderInterface;

/**
 * @template TCoder of EncoderInterface|DecoderInterface
 */
interface CoderException extends BinaryException
{
    /**
     * @return TCoder
     */
    public function getCoder(): CoderInterface;
}
