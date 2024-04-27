<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use Stringable;

interface BinariableInterface extends Serializer\OneWaySelfSerializerInterface, Stringable
{
}
