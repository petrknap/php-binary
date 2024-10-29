<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

interface SelfSerializerInterface extends OneWaySelfSerializerInterface
{
    /**
     * @param string $data binary representation of an instance
     *
     * @throws Exception\SerializerCouldNotUnserializeData
     */
    public static function fromBinary(string $data): self;
}
