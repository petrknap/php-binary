<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

final class Binary
{
    public static function encode(string $data): Encoder
    {
        return new Encoder($data);
    }

    public static function decode(string $data): Decoder
    {
        return new Decoder($data);
    }
}
