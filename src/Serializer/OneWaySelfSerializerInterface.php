<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

interface OneWaySelfSerializerInterface
{
    /**
     * @return string binary representation of this instance
     *
     * @throws Exception\SerializerCouldNotSerializeData
     */
    public function toBinary(): string;
}
