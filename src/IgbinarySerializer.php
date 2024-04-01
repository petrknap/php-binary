<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PetrKnap\Shorts\Exception\MissingRequirement;
use PetrKnap\Shorts\HasRequirements;

/**
 * @link https://www.php.net/manual/en/book.igbinary.php
 */
final class IgbinarySerializer extends Serializer implements HasRequirements
{
    public function __construct(EncoderInterface $encoder, DecoderInterface $decoder)
    {
        self::checkRequirements();
        parent::__construct($encoder, $decoder);
    }

    protected function doSerialize(mixed $serializable): string
    {
        $serialized = igbinary_serialize($serializable);
        if ($serialized === null) {
            throw new Exception\CouldNotSerializeData($this, $serializable);
        }
        return $serialized;
    }

    protected function doUnserialize(string $serialized): mixed
    {
        $serializable = igbinary_unserialize($serialized);
        if ($serializable === false) {
            throw new Exception\CouldNotUnserializeData($this, $serialized);
        }
        return $serializable;
    }

    public static function checkRequirements(): void
    {
        $functions = [
            'igbinary_serialize',
            'igbinary_unserialize',
        ];
        foreach ($functions as $function) {
            if (!function_exists($function)) {
                throw new MissingRequirement(self::class, 'function', $function);
            }
        }
    }
}
