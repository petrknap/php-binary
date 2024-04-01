<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Exception;

use PetrKnap\Binary\SerializerInterface;

interface SerializerException extends BinaryException
{
    public function getSerializer(): SerializerInterface;
}
